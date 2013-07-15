<?php
/**
 * Author: Ghost
 * Date: 7/13/13
 */
define("BASEDIR", __DIR__ . "/../");
require_once(BASEDIR . "/include/config.php");
function __autoload($className){
    $className = BASEDIR . "include/class/" . str_replace("_", "/", $className) . ".php";
    if(!file_exists($className)){
        throw new Exception("Bad class name - cannot autoload file: " . $className . " as it does not exist.");
    }
    else{
        require_once($className);
    }
}
require_once(BASEDIR . "/include/script/IOCRegistration.php");

$APP = Utility_IOC::build("Utility_App");

echo String_String::getString("EVENT_TYPE_MILONGA");