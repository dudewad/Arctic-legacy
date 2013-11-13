<?php
/**
 * Author: Ghost
 * Date: 11/12/13
 */
 
class Exception_ModuleCalendarException extends Exception{
    // Redefine the exception so message isn't optional
    public function __construct($message, $code = 605, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    // custom string representation of object
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}