<?php
/**
 * Author: Ghost
 * Date: 1/6/14
 *
 * Performs password creation, hashing, and verification using PBKDF2 standards on sha256
 * encryption. Settings are stored in the application constant file and should be passed as
 * a settings object.
 * Some of this uses open source code, copyright below.
 *
 *
 *
 * Password Hashing With PBKDF2 (http://crackstation.net/hashing-security.htm).
 * Copyright (c) 2013, Taylor Hornby
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * 1. Redistributions of source code must retain the above copyright notice,
 * this list of conditions and the following disclaimer.
 *
 * 2. Redistributions in binary form must reproduce the above copyright notice,
 * this list of conditions and the following disclaimer in the documentation
 * and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 */
 
class Security_Password {
    private $PBKDF2_HASH_ALGORITHM;
    private $PBKDF2_ITERATIONS;
    private $PBKDF2_SALT_BYTE_SIZE;
    private $PBKDF2_HASH_BYTE_SIZE;
    private $HASH_SECTIONS;
    private $HASH_ALGORITHM_INDEX;
    private $HASH_ITERATION_INDEX;
    private $HASH_SALT_INDEX;
    private $HASH_PBKDF2_INDEX;



    /**
     * Constructor requires settings. All settings must be present or this will fail.
     * @param $settings
     */
    public function __construct($settings){
        $this->PBKDF2_HASH_ALGORITHM = $settings->PBKDF2_HASH_ALGORITHM;
        $this->PBKDF2_ITERATIONS = $settings->PBKDF2_ITERATIONS;
        $this->PBKDF2_SALT_BYTE_SIZE = $settings->PBKDF2_SALT_BYTE_SIZE;
        $this->PBKDF2_HASH_BYTE_SIZE = $settings->PBKDF2_HASH_BYTE_SIZE;
        $this->HASH_SECTIONS = $settings->HASH_SECTIONS;
        $this->HASH_ALGORITHM_INDEX = $settings->HASH_ALGORITHM_INDEX;
        $this->HASH_ITERATION_INDEX = $settings->HASH_ITERATION_INDEX;
        $this->HASH_SALT_INDEX = $settings->HASH_SALT_INDEX;
        $this->HASH_PBKDF2_INDEX = $settings->HASH_PBKDF2_INDEX;
    }



    /**
     * Creates a hashed password using the following format:
     * algorithmName:iterations:salt:hash
     *
     * @param $password
     * @return string
     */
    public function createHash($password){
        //Formats a hashed password like so: algorithm:iterations:salt:hash
        $salt = base64_encode(mcrypt_create_iv($this->PBKDF2_SALT_BYTE_SIZE, MCRYPT_DEV_URANDOM));
        return $this->PBKDF2_HASH_ALGORITHM . ":" . $this->PBKDF2_ITERATIONS . ":" .  $salt . ":" .
        base64_encode($this->pbkdf2(
            $this->PBKDF2_HASH_ALGORITHM,
            $password,
            $salt,
            $this->PBKDF2_ITERATIONS,
            $this->PBKDF2_HASH_BYTE_SIZE,
            true
        ));
    }



    /**
     * Validates a password. Password must come into this function as it is created by the createHash function with
     * all applicable sections.
     * @param $password
     * @param $correct_hash
     * @return bool
     */
    public function validatePassword($password, $correct_hash){
        $params = explode(":", $correct_hash);
        if(count($params) < $this->HASH_SECTIONS)
            return false;
        $pbkdf2 = base64_decode($params[$this->HASH_PBKDF2_INDEX]);
        return $this->slowEquals(
            $pbkdf2,
            $this->pbkdf2(
                $params[$this->HASH_ALGORITHM_INDEX],
                $password,
                $params[$this->HASH_SALT_INDEX],
                (int)$params[$this->HASH_ITERATION_INDEX],
                strlen($pbkdf2),
                true
            )
        );
    }



    /**
     * Compares two strings in length-constant time. This mitigates timing attacks.
     * @param $a
     * @param $b
     * @return bool
     */
    private function slowEquals($a, $b){
        $diff = strlen($a) ^ strlen($b);
        for($i = 0; $i < strlen($a) && $i < strlen($b); $i++){
            $diff |= ord($a[$i]) ^ ord($b[$i]);
        }
        return $diff === 0;
    }



    /**
     * PBKDF2 key derivation function as defined by RSA's PKCS #5: https://www.ietf.org/rfc/rfc2898.txt
     * @param $algorithm
     * @param $password
     * @param $salt
     * @param $count
     * @param $key_length
     * @param bool $raw_output
     * @return string
     */
    private function pbkdf2($algorithm, $password, $salt, $count, $key_length, $raw_output = false){
        $algorithm = strtolower($algorithm);
        if(!in_array($algorithm, hash_algos(), true))
            trigger_error('PBKDF2 ERROR: Invalid hash algorithm.', E_USER_ERROR);
        if($count <= 0 || $key_length <= 0)
            trigger_error('PBKDF2 ERROR: Invalid parameters.', E_USER_ERROR);

        if (function_exists("hash_pbkdf2")){
            // The output length is in NIBBLES (4-bits) if $raw_output is false!
            if (!$raw_output) {
                $key_length = $key_length * 2;
            }
            return hash_pbkdf2($algorithm, $password, $salt, $count, $key_length, $raw_output);
        }

        $hash_length = strlen(hash($algorithm, "", true));
        $block_count = ceil($key_length / $hash_length);

        $output = "";
        for($i = 1; $i <= $block_count; $i++){
            // $i encoded as 4 bytes, big endian.
            $last = $salt . pack("N", $i);
            // first iteration
            $last = $xorsum = hash_hmac($algorithm, $last, $password, true);
            // perform the other $count - 1 iterations
            for ($j = 1; $j < $count; $j++){
                $xorsum ^= ($last = hash_hmac($algorithm, $last, $password, true));
            }
            $output .= $xorsum;
        }

        if($raw_output)
            return substr($output, 0, $key_length);
        else
            return bin2hex(substr($output, 0, $key_length));
    }
}