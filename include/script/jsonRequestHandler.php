<?php
/**
 * Author: Layton Miller
 * Contact: layton@desmill.com
 * Date: 10/2/13
 *
 * This file handles all JSON requests for the application.
 * All requests must come in with a "t" parameter, indicating
 * the "type" of  json request this is. The different types
 * are listed in Utility_Constants. Individual casing is handled
 * by the switch statement below, but submissions are handled by
 * the global app object.
 */

$data = new stdClass();
$generator = new Test_ObjectGenerator();

if(!isset($_REQUEST['t'])){
    error();
}

switch($_REQUEST['t']){



    /**
     * Event (e) request- asks for one event from the server
     */
    case Utility_Constants::REQUEST_TYPE_GET_CALENDAR_QUICK_EVENT:
        if(!isset($_GET['eid']))
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
    case Utility_Constants::REQUEST_TYPE_GET_CALENDAR_FULL_DAY:
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
    case Utility_Constants::REQUEST_TYPE_POST_CALENDAR_SORT_FULL_DAY:
        $date = isset($_POST['d']) ? $_POST ['d'] : time();
        //TODO: Replace with actual code - this is placeholder stuff
        $cal = new Module_Calendar($date);
        $mainCalID = md5(microtime() . time());
        $numEvents = 8;
        $eList = array();
        for($i = 0; $i < $numEvents; $i++){
            array_push($eList, $generator->getSequencedEvent());
        }
        usort($eList, "sortByStartTime");

        $data = new stdClass();
        $data->html = $cal->to_html_full_day($eList, time(), null, $mainCalID);
        exit(Utility_JSONGenerator::echoDocument($data));
        break;



    /**
     * Create Account Start flow was submitted
     */
    case Utility_Constants::REQUEST_TYPE_POST_ACCOUNT_CREATOR_START:
        //Form checking and validation was already handled by application object on construction.
        //Module will contain static hasValidationErrors() flag
        $ac = new Module_AccountCreator();
        $data = new stdClass();
        if($ac::hasValidationErrors()){
            //With errors, display the original flow (start flow)
            $data->html = $ac->to_html_full_create();
        }
        else{
            $submissionData = Module_AccountCreator::getSubmissionData();
            $data->html = $ac->to_html_full_ready($submissionData->email);
        }
        exit(Utility_JSONGenerator::echoDocument($data));
        break;



    //Errors out by default
    default:
        TanguerApp::jsonError();
        break;
}



//Output complete. All switch cases should exit automatically but this is a failsafe.
die();