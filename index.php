<?php
/**
 * Created by Layton Miller.
 * Date: 3/15/13
 * Time: 12:47 PM
 */
define("BASEDIR", __DIR__ . "/");

function __autoload($className){
    $className = BASEDIR . "include/class/" . str_replace("_", "/", $className) . ".php";
    require_once($className);
}

require_once(BASEDIR . "/include/config.php");
require_once(BASEDIR . "/include/script/IOCRegistration.php");

$app = Utility_IOC::build("Utility_App");
?>
<html class="<?php echo $app->getCurrentPageName(); ?>">
    <?php echo $app->head(); ?>
    <body>
        <?php
        echo $app->content();
        ?>
    </body>
</html>