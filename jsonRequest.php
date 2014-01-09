<?php
/**
 * Author: Layton Miller
 * Contact: layton@desmill.com
 * Date: 10/2/13
 *
 * This file handles all json responses for the application.
 * All requests must come in with a "t" parameter, indicating the "type" of  json request this is.
 * The different types are listed below - as more are added they should be added here, AND KEPT IN ALPHABETICAL ORDER!!
 * For more information on each request type, see the switch statement below.
 *
 * cgqe     calendar getQuickEvent request
 * cfd      calendar full day request
 * csfd     calendar sortFullDay request
 */
define("BASEDIR", __DIR__ . "/");
require_once(BASEDIR . "/include/script/Autoloader.php");
require_once(BASEDIR . "/include/script/IOCRegistration.php");
$APP = Utility_IOC::build("TanguerApp");
$lang = "ESAR";
String_String::setLanguage($lang);

$data = new stdClass();
$generator = new Test_ObjectGenerator();

if(!isset($_REQUEST['t'])){
    exit("{'error':'No response type supplied in request.'}");
}

switch($_REQUEST['t']){
    /**
     * Event (e) request- asks for one event from the server
     */
    case "cgqe":
        if(!isset($_REQUEST['eid']))
            error(1201);
        $e = $generator->getSequencedEvent($_REQUEST['eid']);
        $class = "Output_" . get_class($e);
        $output = new $class($e);
        $data = new stdClass();
        $data->html = $output->to_html_quick_view();
        exit(Utility_JSONGenerator::echoDocument($data));
        break;
    /**
     * fullDay request- asks for list of events for one full day from the server at the specified date
     */
    case "cfd":
        //TODO: Replace with actual code - this is placeholder stuff
        $cal = new Module_Calendar($_REQUEST['d']);
        $mainCalID = md5(microtime() . time());
        $numEvents = 8;
        $eList = array();
        $eventToView = null;
        for($i = 0; $i < $numEvents; $i++){
            array_push($eList, $generator->getSequencedEvent());
            if(isset($_REQUEST['selectedEvent']))
                if($eList[$i]->getId() == $_REQUEST['selectedEvent'])
                    $eventToView = $eList[$i];
        }
        usort($eList, "sortByStartTime");

        $data = new stdClass();
        $data->html = $cal->to_html_full_day($eList, time(), $eventToView, $mainCalID);
        exit(Utility_JSONGenerator::echoDocument($data));
        break;
    /**
     * sortFullDay request- asks for list of events for one full day from the server sorted accordingly
     */
    case "csfd":
        //TODO: Replace with actual code - this is placeholder stuff
        $cal = new Module_Calendar($_REQUEST['d']);
        $mainCalID = md5(microtime() . time());
        $numEvents = 8;
        $eList = array();
        $eventToView = null;
        for($i = 0; $i < $numEvents; $i++){
            array_push($eList, $generator->getSequencedEvent());
            if(isset($_REQUEST['selectedEvent']))
                if($eList[$i]->getId() == $_REQUEST['selectedEvent'])
                    $eventToView = $eList[$i];
        }
        usort($eList, "sortByStartTime");

        $data = new stdClass();
        $data->html = $cal->to_html_full_day($eList, time(), $eventToView, $mainCalID);
        exit(Utility_JSONGenerator::echoDocument($data));
        break;
    //Errors out by default
    default:
        error(1200);
        break;
}

function error($e){
    $error = new stdClass();
    $error->error = constant("Utility_Constants::E_$e");
    $error->errno = "E_" . $e;
    exit(Utility_JSONGenerator::echoDocument($error));
}




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