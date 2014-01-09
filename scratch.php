<?php
/**
 * Author: Ghost
 * Date: 1/5/14
 */
define("BASEDIR", __DIR__ . "/");
require_once(BASEDIR . "/include/script/Autoloader.php");
require_once(BASEDIR . "/include/script/IOCRegistration.php");

$pw = Utility_IOC::build("Security_Password");
/*
$password = "boobies";
$hash = $pw->createHash($password);
echo $hash;
echo "<br>Hash length is: " . strlen($hash);
echo "<br>";*/
$otherHash = "sha256:1000:RJrkT3V2OKXfHyCruBJ021xz3YXziZOB:d0pk54y9Esm94Iq1NfYAe5n2JF/fTTLP";
echo $pw->validatePassword("boobies", $otherHash) ? "Password is valid" : "Password is invalid";