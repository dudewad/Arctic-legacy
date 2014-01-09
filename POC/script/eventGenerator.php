<?php
/**
 * Author: Ghost
 * Date: 1/5/14
 */

define("BASEDIR", __DIR__ . "/../");
require_once(BASEDIR . "/include/script/Autoloader.php");
require_once(BASEDIR . "/include/script/IOCRegistration.php");


$generator = new Test_ObjectGenerator();

$e = $generator->getRandomEvent();