<?php
/**
 * Author: Ghost
 * Date: 1/12/14
 */
 
class Exception_SecurityInputValidatorException extends Exception_TanguerException{
    // Redefine the exception so message isn't optional
    public function __construct($message, $code = 200, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}