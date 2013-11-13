<?php
/**
 * Author: Ghost
 * Date: 6/19/13
 */
//Destroy user session in test environment

@session_destroy();
define("BASEDIR", __DIR__ . "/../");
require_once(BASEDIR . "/include/config.php");
require_once(BASEDIR . "/include/script/Autoloader.php");
require_once(BASEDIR . "/include/script/IOCRegistration.php");

$APP = Utility_IOC::build("Utility_App");
$lang = "ESAR";
String_String::setLanguage($lang);
$generator = new Test_ObjectGenerator();
$selectedEvent = isset($_GET['e']) ? $_GET['e'] : null;
$eventToView = null;
$mainCalID = "mainCal";

$appUser = $generator->getRandomUser($lang);
//Languages can be "ESAR" or "ENUS"

$APP->setUserSession($appUser);
$cal = new Module_Calendar(time());

$numEvents = 8;//rand(4,10);
$eList = array();
for($i = 0; $i < $numEvents; $i++){
    array_push($eList, $generator->getSequencedEvent());
    if($eList[$i]->getId() == $selectedEvent)
        $eventToView = $eList[$i];
}

echo $cal->calendarPickerToHTML();

usort($eList, "sortByStartTime");
?>
<!DOCTYPE html>
<html lang="en">
<?php echo $APP->head(); ?>
<body>
<div class="content">
    <?php
        echo $cal->to_html_full_day($eList, time(), $eventToView, $mainCalID);
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