<?php
/**
 * Author: Ghost
 * Date: 1/12/14
 */
 
class Date_TanguerDateTime {



    /**
     * Takes a timestamp and converts it to a Tanguer-url-friendly date string in the ISO 8601 format.
     * Uses the currently set default timezone.
     * @param $timestamp
     * @return string ISO-8601 formated date string
     */
    public static function urlFriendlyDate($timestamp){
        return date("Y-m-d", $timestamp);
    }



    /**
     * Takes a timestamp and converts it to a Tanguer-url-friendly date string in the ISO 8601 format.
     * Uses the currently set default timezone.
     * @param $dateString   String  REQUIRED        The date string in ISO-8601 format to be converted to a timestamp
     * @return string ISO-8601 formated date string
     */
    public static function urlFriendlyDateToTimestamp($dateString){
        $parts = explode("-",$dateString);
        return mktime(0,0,0,$parts[1],$parts[2],$parts[0]);
    }



    private final function __construct(){}
    private final function __clone(){}
    public final function __wakeup(){}
}
