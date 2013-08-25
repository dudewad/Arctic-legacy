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
    private static $strings;
    private static $reflector;

    private final function __construct(){}
    private final function __clone(){}

    public static function getString($str){
        //Set default language if none is set
        if(!isset(self::$language))
            self::setLanguage();
        //Only instantiate the reflection class once
        if(!self::$reflector)
            self::$reflector = new ReflectionClass(self::$strings);
        return self::$reflector->getConstant($str);
    }

    public static function setLanguage($language = null){
        //Default to Argentine Spanish
        if(file_exists(__DIR__ . "/Strings" . $language . ".php")){
            self::$language = $language;
        }
        else{
            self::$language = "ESAR";
        }

        //Set strings file
        if(!isset(self::$strings)){
            $class = "String_Strings" . self::$language;
            self::$strings = new $class();
        }
    }
}
