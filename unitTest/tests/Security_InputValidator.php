<?php
/**
 * Author: Ghost
 * Date: 3/2/14
 */

/**
 * Test email address validation against a valid email address
 */
$buffer .= "<h3>Testing method Security_InputValidator::validateEmail against valid email address.</h3>";
$test = Security_InputValidator::validateEmail("layton@desmill.com");
$buffer .= "Result: $test";

/**
 * Test email address validation against invalid email address
 */
$buffer .= "<h3>Testing method Security_InputValidator::validateEmail against invalid email address.</h3>";
try{
    $test = Security_InputValidator::validateEmail("laytondesmill.com");
}
catch(Exception $e){
    $test = 0;
}
$buffer .= "Result: $test";

/**
 * Test email address validation against invalid email address
 */
$buffer .= "<h3>Testing method Security_InputValidator::validateEmail against empty email address.</h3>";
try{
    $test = Security_InputValidator::validateEmail("");
}
catch(Exception $e){
    $test = 0;
}
$buffer .= "Result: $test";

/**
 * Test password validation against valid password. This method checks to see that the password is a valid
 * password with the system requirements
 */
$buffer .= "<h3>Testing method Security_InputValidator::validatePassword against a valid password.</h3>";
try{
    $test = Security_InputValidator::validatePassword("123abcABC!");
}
catch(Exception $e){}
$buffer .= "Result: $test";

/**
 * Test password validation against invalid password.
 */
$buffer .= "<h3>Testing method Security_InputValidator::validatePassword against an invalid password.</h3>";
try{
    $test = Security_InputValidator::validatePassword("123abc");
}
catch(Exception $e){
    $test = 0;
}
$buffer .= "Result: $test";

/**
 * Test password validation against empty password.
 */
$buffer .= "<h3>Testing method Security_InputValidator::validatePassword against an empty password.</h3>";
try{
    $test = Security_InputValidator::validatePassword("");
}
catch(Exception $e){
    $test = 0;
}
$buffer .= "Result: $test";