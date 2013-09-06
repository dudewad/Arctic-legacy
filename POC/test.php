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
String_String::setLanguage("ENUS");
$generator = new Test_ObjectGenerator();

$appUser = $generator->getRandomUser();
//Languages can be "ESAR" or "ENUS"

$APP->setUserSession($appUser);

//$mOut = new Output_Base_Event_Milonga($m);
//$eOut = new Output_Event_Milonga($m);
$cal = new Module_Calendar(time());

$numEvents = rand(4,10);
$eList = array();
for($i = 0; $i < $numEvents; $i++){
    array_push($eList, $generator->getRandomEvent());
}

usort($eList, "sortByStartTime");

$eventToView = isset($_GET['e']) ? $eList[0] : null;
?>
<!DOCTYPE html>
<html>
<?php echo $APP->head(); ?>
<body>
<div class="content">
    <?php
        echo $cal->to_html_full_day($eList, time(), $eventToView);
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