<?php
/**
 * Author: Ghost
 * Date: 2/21/14
 */
 
class Exception_AuthenticationException extends Exception_TanguerException{
    // Redefine the exception so message isn't optional
    public function __construct($message, $code = 300, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}