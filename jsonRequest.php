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
 * gqe = getQuickEvent request
 */
define("BASEDIR", __DIR__ . "/");
require_once(BASEDIR . "/include/config.php");
require_once(BASEDIR . "/include/script/Autoloader.php");
require_once(BASEDIR . "/include/script/IOCRegistration.php");
$APP = Utility_IOC::build("Utility_App");
$lang = "ESAR";
String_String::setLanguage($lang);

//$db = Utility_DB::connection($config["db"]["tanguer"]);
$data = new stdClass();
$generator = new Test_ObjectGenerator();

if(!isset($_REQUEST['t'])){
    exit("{'error':'No response type supplied in request.'}");
}

switch($_REQUEST['t']){
    /**
     * Event (e) request- asks for one event from the server
     */
    case "gqe":
        if(!isset($_REQUEST['eid']))
            error(1201);
        $e = $generator->getSequencedEvent($_REQUEST['eid']);
        $class = "Output_" . get_class($e);
        $output = new $class($e);
        $data = new stdClass();
        $data->html = $output->to_html_quick_view();
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