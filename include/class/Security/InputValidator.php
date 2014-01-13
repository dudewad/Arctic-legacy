<?php
/**
 * Author: Ghost
 * Date: 1/12/14
 */
 
final class Security_InputValidator {



    public static function validateEventID($eventID){
        if(!is_int($eventID)){
            self::throwError(201);
        }
        return true;
    }



    public static function validateDateISO8601($date){
        //ISO 8601 date strings require 10 digits in the format [YYYY-MM-DD]
        if(strlen($date) > 10 || substr($date,4,1) != "-" || (substr($date,6,1) != "-" && substr($date,7,1) != "-")){
            self::throwError(202);
        }
        $vals = explode("-", $date);

        for($i = 0; $i < count($vals); $i++){
            $item = $vals[$i];
            if(!is_numeric($item)){
                self::throwError(202);
            }
        }
        return true;
    }



    public static function validateAlertID($alertID){
        if(!is_int($alertID)){
            self::throwError(203);
        }
        return true;
    }



    private static function throwError($errorNumber){
        switch($errorNumber){
            //Event ID error
            case 201:
                throw new Exception_SecurityInputValidatorException("Invalid event ID. The ID must be an integer.", $errorNumber);
                break;
            //ISO 8601 date string error
            case 202:
                throw new Exception_SecurityInputValidatorException("Invalid ISO 8601 date string. String required must be in format [YYYY-MM-DD].", $errorNumber);
                break;
            //Alert ID error
            case 203:
                throw new Exception_SecurityInputValidatorException("Invalid alert ID. The ID must be an integer.", $errorNumber);
                break;
            //Code '200' or no error is a generic input validator error
            default:
                throw new Exception_SecurityInputValidatorException("Unidentified " . __CLASS__ . " error.", $errorNumber);
                break;
        }
    }



    private final function __construct(){}
    private final function __clone(){}
    public final function __wakeup(){}
}
