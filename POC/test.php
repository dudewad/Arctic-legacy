<?php
/**
 * Author: Ghost
 * Date: 6/19/13
 */
//Destroy user session in test environment
//@session_destroy();
session_start();
define("BASEDIR", __DIR__ . "/../");
require_once(BASEDIR . "/include/script/Autoloader.php");
require_once(BASEDIR . "/include/script/IOCRegistration.php");

$APP = Utility_IOC::build("TanguerApp");
$lang = "ESAR";
String_String::setLanguage($lang);
TanguerApp::setDefaultTimezone();
$generator = new Test_ObjectGenerator();
$selectedEvent = isset($_GET['e']) ? $_GET['e'] : null;
$eventToView = null;
$mainCalID = "mainCal";

$appUser = $generator->getRandomUser($lang);
//Languages can be "ESAR" or "ENUS"

$APP->setUserSession($appUser);

$creator = new Module_CreateAccount();
$htmlTagClass = Utility_Constants::APP_GUI_MODE == "dev" ? "devMode" : "";
?>
<!DOCTYPE html>
    <html lang="en" class="<?php echo $htmlTagClass;?>">
<?php echo TanguerApp::head(); ?>
<body>
<div class="content">
    <?php
        echo $creator->to_html_full_create();
    ?>
    <div id="debug"></div>
</div>
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