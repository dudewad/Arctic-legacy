<?php
/**
 * Author: Ghost
 * Date: 6/19/13
 */
//Destroy user session in test environment
//@session_destroy();
session_start();
define("BASEDIR", __DIR__ . "/");
require_once(BASEDIR . "/include/script/Autoloader.php");
require_once(BASEDIR . "/include/script/IOCRegistration.php");

Utility_IOC::build("TanguerApp");

$generator = new Test_ObjectGenerator();
$eventToView = null;
$mainCalID = "mainCal";

if(isset($_REQUEST['lsel'])){
    $city = isset($_REQUEST['city']) ? $_REQUEST['city'] : $location->getCity();
    $country = isset($_REQUEST['country']) ? $_REQUEST['country'] : $location->getCountry();
    TanguerApp::setAlert(new Alert_Standard("Location selection has been updated: " . $country . "," . $city));
}

$date = TanguerApp::getUserInput("date");
$cal = new Module_Calendar($date);

$numEvents = 8;//rand(4,10);
$eList = array();
$selectedEvent = TanguerApp::getUserInput("eventID");
for($i = 0; $i < $numEvents; $i++){
    array_push($eList, $generator->getSequencedEvent());
    if($eList[$i]->getId() == $selectedEvent)
        $eventToView = $eList[$i];
}

usort($eList, "sortByStartTime");

$locationSelector = new Module_LocationSelector();
$accountCreator = new Module_AccountCreator();
TanguerApp::setModal($accountCreator->to_html_full_create(), "ac");

$htmlTagClass = Utility_Constants::APP_GUI_MODE == "dev" ? "devMode" : "";
?>
    <!DOCTYPE html>
    <html lang="en" class="<?php echo $htmlTagClass;?>">
    <?php echo TanguerApp::head(); ?>
    <body>
        <?php
        echo TanguerApp::alertsToHTML();
        echo TanguerApp::printHeader();
        ?>
    <div class="content">
        <div class="clearfix">
            <?php
            echo $cal->calendarPickerMonthToHTML($date, date_default_timezone_get());
            echo $locationSelector->to_html_full();
            ?>
        </div>
        <?php
        echo $cal->to_html_full_day($eList, time(), $eventToView, $mainCalID);
        ?>
        <div id="debug"></div>
    </div>
        <?php
        echo TanguerApp::modalsToHTML();
        ?>
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