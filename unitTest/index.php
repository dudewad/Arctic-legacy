<?php
/**
 * Author: Ghost
 * Date: 3/2/14
 */
session_start();
define("BASEDIR", __DIR__ . "/../");
require_once(BASEDIR . "/include/script/Autoloader.php");
require_once(BASEDIR . "/include/script/IOCRegistration.php");
require("./unitTestConfig.php");
$buffer = "";

foreach($modulesToTest as $module){
    $buffer .= "<br><br>******************Starting unit test of module: $module**********************<br><br>";
    switch($module){
        case "Security_InputValidator":
            require("tests/Security_InputValidator.php");
            break;
    }
    $buffer .= "<br><br>******************Ending unit test of module: $module**********************<br><br>";
}

?>

<html>

<head>
    <title>Tánguer Unit Testing</title>
</head>

<body style="background:#000; color:#09f;">
<?php echo $buffer; ?>
</body>
</html>