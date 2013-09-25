<?php
/**
 * Author: Ghost
 * Date: 7/13/13
 * Allows program to access strings independent of language. Note that this relies on string files in the same directory.
 * If you are seeing strings in a different language than expected, or the default language (es-AR) then be sure to
 * check the directory structure.
 */

class String_String {
    private static $language;

    private final function __construct(){}
    private final function __clone(){}

    public static function getString($str, $module = "Utility_App"){
        //Set default language if none is set
        if(!isset(self::$language))
            self::setLanguage();

        $class = "String_" . self::$language . "_" . $module;
        return constant("$class::$str");
    }

    public static function setLanguage($language = null){
        //Default to Argentine Spanish
        self::$language = file_exists(__DIR__ . "/" . $language) ? $language : "ESAR";
    }
}