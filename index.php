<?php
/**
 * Created by Layton Miller.
 * Date: 3/15/13
 * Time: 12:47 PM
 */
define("BASEDIR", __DIR__ . "/");
include_once(BASEDIR . "/include/config.php");
include_once(BASEDIR . "/include/class/App.php");
include_once(BASEDIR . "/include/class/Location.php");
include_once(BASEDIR . "/include/class/IOC.php");
include_once(BASEDIR . "/include/class/Views.php");
include_once(BASEDIR . "/include/script/IOCRegistration.php");

$app = IOC::build("App");
?>
<html class="<?php echo $app->getCurrentPageName();?>">
    <?php echo $app->head(); ?>
    <body>
        <?php
        echo $app->content();
        ?>
    </body>
</html>