<?php
//$curl = curl_init("http://api.ipinfodb.com/v3/ip-city/?key=14985c7991a26fcb7c4becc0274dacbc15fc63f7aa02e1da1eb825cf6099ab7b&ip=50.159.48.157&format=json");
//$data = curl_exec($curl);
session_destroy();
define("BASEDIR", __DIR__ . "/../");
require_once(BASEDIR . "/include/script/Autoloader.php");
require_once(BASEDIR . "/include/script/IOCRegistration.php");

$APP = Utility_IOC::build("TanguerApp");

//TanguerApp::setDefaultTimezone();
$curl = curl_init("http://api.ipinfodb.com/v3/ip-city/?key=14985c7991a26fcb7c4becc0274dacbc15fc63f7aa02e1da1eb825cf6099ab7b&ip=10.0.0.1&format=json");
$data = curl_exec($curl);