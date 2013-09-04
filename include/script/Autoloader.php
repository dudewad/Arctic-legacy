<?php
/**
 * Author: Ghost
 * Date: 9/2/13
 */

function __autoload($className){
    $className = BASEDIR . "include/class/" . str_replace("_", "/", $className) . ".php";
    if(!file_exists($className)){
        throw new Exception("Bad class name - cannot autoload file: " . $className . " as it does not exist.");
    }
    else{
        require_once($className);
    }
}