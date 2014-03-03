<?php
/**
 * Author: Ghost
 * Date: 11/12/13
 */
 
class Exception_ModuleCalendarException extends Exception_TanguerException{
    // Redefine the exception so message isn't optional
    public function __construct($message, $code = 605, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}