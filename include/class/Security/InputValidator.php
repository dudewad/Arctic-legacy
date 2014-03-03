<?php

/**
 * Author: Ghost
 * Date: 1/12/14
 */
final class Security_InputValidator{
    //Common regex patterns
    const HAS_SYMBOL            = '/[.!@#$%^&*()\-_+=\s~]+/';
    const HAS_LOWER_CASE        = '/[a-z]+/';
    const IS_VALID_EMAIL           = '/^[\w0-9.%+-]+\@[\w0-9.-]+\.[\w]{2,4}$/';
    const HAS_UPPER_CASE        = '/[A-Z]+/';
    const HAS_WHITE_SPACE       = '/\s/';



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
     * Validate an email address
     *
     * @param $email
     *
     * @return bool
     */
    public static function validateEmail($email){
        if( strlen($email) > 254
            || !preg_match(self::IS_VALID_EMAIL, $email)){
            self::throwError(204);
        }
        return true;
    }



    /**
     * Checks to see if the password conforms to the password policy
     *
     * @param $password     String      REQUIRED    The password to be validated
     * @param $isNew        Boolean                 Whether the user is setting a password, or if this is to be
     *                                              checked against an existing password in the database
     *
     * @return mixed
     */
    public static function validatePassword($password, $isNew = false){
        if( strlen($password) < 8
            || !preg_match(self::HAS_SYMBOL, $password)
            || !preg_match(self::HAS_LOWER_CASE, $password)
            || !preg_match(self::HAS_UPPER_CASE, $password)){
            if($isNew)
                self::throwError(205);
            else
                self::throwError(206);

            return false;
        }
        return true;
    }



    /**
     * Checks to be sure a first name input is valid
     *
     * @param $name  String      REQUIRED        The name to check
     */
    public static function validateFirstName($name){
        if(preg_match(self::HAS_WHITE_SPACE, $name) !== false){
            self::throwError(102);
        }
    }



    /**
     * Checks to be sure a first name input is valid
     *
     * @param $name  String      REQUIRED        The name to check
     */
    public static function validateLastName($name){
        if(preg_match(self::HAS_WHITE_SPACE, $name) !== false){
            self::throwError(103);
        }
    }



    public final function __wakeup(){
    }



    private final function __clone(){
    }
}
