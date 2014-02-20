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


    /**
     * Retrieves a string from one of the current language string files.
     *
     * @param string $str           REQUIRED    The name of the string constant to retrieve
     *
     * @param string $module                    The name of the module (if other than main) to retrieve the string for
     *
     * @param string $replacements              An array of string replacements to drop into the string as it is being
     *                                          retrieved. This is useful for strings that have built-in links, etc that
     *                                          require other strings be inserted into them. The raw strings will
     *                                          contain unescaped indeces where these items will be placed like so:
     *                                          "This {0} a string that has been {1} formatted."
     *                                          If we request the above string while passing the following array:
     *                                          [0] = "is"
     *                                          [1] = "properly"
     *                                          The returned result will be:
     *                                          "This is a string that has been properly formatted."
     *
     * @return string                           The requested string
     */
    public static function getString($str, $module = "TanguerApp", $replacements = null){
        //Set default language if none is set
        if(!isset(self::$language))
            self::setLanguage();

        $class = "String_" . self::$language . "_" . $module;
        $rawString = constant("$class::$str");
        if(isset($replacements) && count($replacements)){
            $rawString = self::formatString($rawString, $replacements);
        }
        return $rawString;
    }



    /**
     * Sets the language to the specified locale. If none is passed, assumes Argentine Spanish.
     *
     * @param string $language      The language to be set for this session.
     */
    public static function setLanguage($language = "es_AR"){
        $lang = strtoupper(str_replace("_","",$language));
        //Default to Argentine Spanish
        self::$language = file_exists(__DIR__ . "/" . $lang) ? $lang : "ESAR";
    }



    /**
     * Gets the currently set language for the application that was previously set using self::setLanguage.
     *
     * @return string
     */
    public static function getLanguage(){
        return strtoupper(str_replace("_","",self::$language));
    }



    /**
     * Formats a string by replacing special index indicators with items in the $items array.
     * Index indicators are notated with the format of the index number inside two brackers:
     * {x}
     * where "x" is the index number.
     *
     * @param string    $str        REQUIRED        The string to format
     *
     * @param array     $items      REQUIRED        The array of items to be placed into all available indeces
     *
     * @return string                               The final formatted string
     */
    private static function formatString($str, $items){
        $i = 0;
        $index = "{" . $i . "}";
        while(strpos($str,$index) !== false){
            $str = str_replace($index, $items[$i], $str);
            $index = "{" . ++$i . "}";
        }
        return $str;
    }
}