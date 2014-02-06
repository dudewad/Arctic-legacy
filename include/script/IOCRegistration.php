<?php
/**
 * Author: Layton Miller
 * Contact: layton@newcarcity.com
 * Date: 5/22/13
 */

//Global Tanguer App object
Utility_IOC::register("TanguerApp", function(){
    return new TanguerApp();
});

//Security: password object
Utility_IOC::register("Security_Password", function(){
    $settings = new stdClass();
    $settings->PBKDF2_HASH_ALGORITHM = Utility_Constants::PBKDF2_HASH_ALGORITHM;
    $settings->PBKDF2_ITERATIONS = Utility_Constants::PBKDF2_ITERATIONS;
    $settings->PBKDF2_SALT_BYTE_SIZE = Utility_Constants::PBKDF2_SALT_BYTE_SIZE;
    $settings->PBKDF2_HASH_BYTE_SIZE = Utility_Constants::PBKDF2_HASH_BYTE_SIZE;
    $settings->HASH_SECTIONS = Utility_Constants::HASH_SECTIONS;
    $settings->HASH_ALGORITHM_INDEX = Utility_Constants::HASH_ALGORITHM_INDEX;
    $settings->HASH_ITERATION_INDEX = Utility_Constants::HASH_ITERATION_INDEX;
    $settings->HASH_SALT_INDEX = Utility_Constants::HASH_SALT_INDEX;
    $settings->HASH_PBKDF2_INDEX = Utility_Constants::HASH_PBKDF2_INDEX;
    return new Security_Password($settings);
});