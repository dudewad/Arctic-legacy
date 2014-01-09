<?php
/**
 * Author: Ghost
 * Date: 12/1/13
 */
define("BASEDIR", __DIR__ . "/../");
require_once(BASEDIR . "/include/script/Autoloader.php");
require_once(BASEDIR . "/include/script/IOCRegistration.php");

$APP = Utility_IOC::build("TanguerApp");

echo "<h2>Benchmark test of printing one million constants from the constants class vs one million references to the constant for efficiency purposes</h2>";

$timeStart = time() + microtime();
echo "Starting benchmark test at: " . $timeStart . "<br>";
$str = "";
for($i = 0; $i < 1000000; $i++){
    $str .= Utility_Constants::URL_ASSET_BASE;
}
$timeEnd = time() + microtime();
$elapsedTime = $timeEnd - $timeStart;
echo "Ending benchmark test at: " . $timeEnd . "<br>";
echo "Time elapsed during benchmark printing of one million constants: " . $elapsedTime . "<br>";



echo "<br><br>";

$timeStart = time() + microtime();
echo "Starting benchmark test at: " . $timeStart . "<br>";
$str = "";

$base = Utility_Constants::URL_ASSET_BASE;
for($i = 0; $i < 1000000; $i++){
    $str .= $base;
}

$timeEnd = time() + microtime();
$elapsedTime2 = $timeEnd - $timeStart;
echo "Ending benchmark test at: " . $timeEnd . "<br>";
echo "Time elapsed during benchmark printing of one million references: " . $elapsedTime2 . "<br>";


echo "<br><br>";

echo "Time difference (time of test two minus time of test one): " . ($elapsedTime2 - $elapsedTime);