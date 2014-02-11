<?php
/**
 * Author: Ghost
 * Date: 6/19/13
 */
session_start();
define("BASEDIR", __DIR__ . "/");
require_once(BASEDIR . "/include/script/Autoloader.php");
require_once(BASEDIR . "/include/script/IOCRegistration.php");
Utility_IOC::build("TanguerApp");
?>
    <!DOCTYPE html>
    <html lang="en" class="<?php echo Utility_Constants::APP_GUI_MODE == "dev" ? "devMode" : "";?>">
    <?php echo TanguerApp::head(); ?>
    <body>
        <?php
        echo TanguerApp::alertsToHTML();
        echo TanguerApp::printHeader();
        echo TanguerApp::loadView();
        echo TanguerApp::modalsToHTML();
        ?>
        <div id="debug"></div>
    </body>
    </html>
<?php


/**
 * Useful Usort for sorting a list of events by their start times
 * @param Event_Event $a
 * @param Event_Event $b
 * @return int
 */
function sortByStartTime(Event_Event $a,Event_Event $b){
    $aStart = $a->getDateStart();
    $bStart = $b->getDateStart();
    if($aStart == $bStart){
        return 0;
    }
    return ($aStart < $bStart) ? -1 : 1;
}