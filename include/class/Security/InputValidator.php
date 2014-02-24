<?php

/**
 * Author: Ghost
 * Date: 1/12/14
 */
final class Security_InputValidator{


    private final function __construct(){
    }



    /**
     * Validate an application event ID
     *
     * @param $eventID
     *
     * @return bool
     */
    public static function validateEventID($eventID){
        if(!is_int($eventID)){
            self::throwError(201);
        }
        return true;
    }



    private static function throwError($errorNumber){
        $const = "Utility_Constants::E_" . $errorNumber;
        if(defined($const))
            throw new Exception_SecurityInputValidatorException(constant($const), $errorNumber);
        //Default error
        throw new Exception_SecurityInputValidatorException("Utility_Constants::E_" . 200, $errorNumber);
    }



    /**
     * Validate a standard ISO8601 date. Allows leeway for length of month and day inputs
     *
     * @param $date
     *
     * @return bool
     */
    public static function validateDateISO8601($date){
        //ISO 8601 date strings require max 10 digits in the format [YYYY-MM-DD]
        //Will cheat and allow for 1 digit month or day values
        if(strlen($date) > 10 || substr($date, 4, 1) != "-" || (substr($date, 6, 1) != "-" && substr($date, 7, 1) != "-")){
            self::throwError(202);
        }

        //Removing the dashes will leave an integer if this is a valid date
        $date = str_replace("-", "", $date);
        if(!is_int($date)){
            self::throwError(202);
        }
        return true;
    }



    /**
     * Validate a standard application alert ID
     *
     * @param $alertID
     *
     * @return bool
     */
    public static function validateAlertID($alertID){
        if(!is_int($alertID)){
            self::throwError(203);
        }
        return true;
    }



    /**
     * Validate an email address conforming to IETF RFC 3696 - max length of 254 characters
     *
     * @param $email
     *
     * @return bool
     */
    public static function validateEmail($email){
        $regex = '/^[\w0-9.%+-]+\@[\w0-9.-]+\.[\w]{2,4}$/';
        if(strlen($email) > 254 || !preg_match($regex, $email)){
            self::throwError(204);
        }
        return true;
    }



    /**
     * Checks to see if the password conforms to the password policy
     *
     * @param $password                         String      REQUIRED    The password to be validated
     * @param $isNew                            Boolean                 Whether the user is setting a password, or if this is to be
     *                                          checked against an existing password in the database
     *
     * @return mixed
     */
    public static function validatePassword($password, $isNew = false){
        $regex = '/^[\w.!@#$%^&*()\-+=\s~]+$/';
        if(strlen($password) < 10 || !preg_match($regex, $password)){
            if($isNew)
                self::throwError(205);
            else
                self::throwError(206);
        }
        return true;
    }



    public final function __wakeup(){
    }



    private final function __clone(){
    }
}
