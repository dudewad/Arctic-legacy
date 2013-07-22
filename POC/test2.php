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

?>

<!DOCTYPE html>
<html>
<head>
    <?php echo $APP->head(); ?>
    <script type="text/javascript" src="POC/js/test.js"></script>
    <!--<link rel='stylesheet' type='text/css' href='POC/css/test.css' />-->
    <link rel='stylesheet' type='text/css' href='POC/css/test-min.css' />
</head>
<body>
<div class="content">
    <div class="c ">
        <div class="th-list">
            <div class="e th lesson">
                <a href="http://localhost/tanguer/test?id=223165312">
                    <div class="e-content">
                        <div>
                            <div class="col-left">
                                <div class="time">
                                    21:00 -
                                </div>
                            </div>
                            <div class="col-center">
                                <div class="title">
                                    Clase: China Harbor
                                </div>
                                <div class="details">
                                    <div class="address">
                                        425 1st Ave
                                    </div>
                                    <div class="organizer">
                                        <strong>Profesor:</strong><br>Paola Jaime, Layton Miller
                                    </div>
                                </div>
                            </div>
                            <div class="col-right">
                                <span class="price">$88</span>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="c-e-disp">
            <div class="c-e-default">

            </div>
        </div>
    </div>    <div id="debug"> js no-mobile desktop no-ie tanguer-section w-1920 gt-240 gt-320 gt-480 gt-640 gt-768 gt-800 gt-1024 gt-1280 gt-1440 gt-1680 no-portrait landscape</div>
    </div>
    <div id="debug"></div>
    <script type="text/javascript">
        $APP = new TANGUER_APP();
    </script>
</div>
</body>
</html>