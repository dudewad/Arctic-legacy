<?php
session_start();
echo "TEST";
define("BASEDIR", __DIR__ . "/../../");
require_once(BASEDIR . "/include/script/Autoloader.php");
require_once(BASEDIR . "/include/script/IOCRegistration.php");

$APP = Utility_IOC::build("Utility_App");

Utility_App::setDefaultTimezone();
echo "<br>IP Address is: <strong>" . Utility_App::getUserIP() . "</strong>";
echo "<br>Your timezone is: <strong>" . date_default_timezone_get() . "</strong>";