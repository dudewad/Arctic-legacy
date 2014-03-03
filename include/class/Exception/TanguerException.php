<?php
/**
 * Author: Ghost
 * Date: 2/27/14
 */
 
abstract class Exception_TanguerException extends Exception{
    /**
     * Nothing special about this constructor, just pass object data to super class
     * @param string    $message
     * @param int       $code
     * @param Exception $previous
     */
    public function __construct($message, $code, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }



    /**
     * Returns an HTML formatted string for display of the error message
     *
     * @return string   HTML formatted string containing the error message
     */
    public function getHTMLFormattedMessage(){
        return "<div class='errorMessage'><span class='icon'></span><p>" . $this->getMessage() . "</p></div>";
    }



    // custom string representation of object
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}
 