<?php
session_start();
echo "TEST";
define("BASEDIR", __DIR__ . "/../../");
require_once(BASEDIR . "/include/script/Autoloader.php");
require_once(BASEDIR . "/include/script/IOCRegistration.php");

$APP = Utility_IOC::build("TanguerApp");

TanguerApp::setDefaultTimezone();
echo "<br>IP Address is: <strong>" . TanguerApp::getUserIP() . "</strong>";
echo "<br>Your timezone is: <strong>" . date_default_timezone_get() . "</strong>";