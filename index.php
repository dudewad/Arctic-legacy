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

$u = new stdClass();
$u->user_id = 201301;
$u->person_id = 201301;
$u->first_name = "Layton";
$u->last_name = "Miller";
$u->email = "layton@desmill.com";
$u->language = "es_AR";
$user = new Person_User($u);
$_SESSION['user'] = $user;

$APP = Utility_IOC::build("TanguerApp");
$lang = "es_AR
";
String_String::setLanguage($lang);
TanguerApp::setDefaultTimezone();

$location = new stdClass();
$location->city = "Rosario";
$location->country = "Argentina";
TanguerApp::setUserLocation($location);
$generator = new Test_ObjectGenerator();
$selectedEvent = isset($_GET['e']) ? $_GET['e'] : null;
$eventToView = null;
$mainCalID = "mainCal";

if(isset($_REQUEST['lsel'])){
    $city = isset($_REQUEST['city']) ? $_REQUEST['city'] : $location->city;
    $country = isset($_REQUEST['country']) ? $_REQUEST['country'] : $location->country;
    TanguerApp::setAlert(new Alert_Standard("Location selection has been updated: " . $country . "," . $city));
}

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

usort($eList, "sortByStartTime");

$locationSelector = new Module_LocationSelector();

$date = isset($_GET['d']) ? $_GET['d'] : time();

if(Utility_Constants::APP_GUI_MODE == "dev")
    $htmlTagClass = "devMode";
?>
    <!DOCTYPE html>
    <html lang="en" class="<?php echo $htmlTagClass;?>">
    <?php echo $APP->head(); ?>
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