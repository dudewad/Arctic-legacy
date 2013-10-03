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
 * ge = getEvent request
 */
//header("Content-type: application/json");
define("BASEDIR", __DIR__ . "/");
require_once(BASEDIR . "/include/config.php");
require_once(BASEDIR . "/include/script/Autoloader.php");
require_once(BASEDIR . "/include/script/IOCRegistration.php");

$APP = Utility_IOC::build("Utility_App");

$db = Utility_DB::connection($config["db"]["tanguer"]);
$data = new stdClass();

if(!isset($_REQUEST['t'])){
    exit("{'error':'No response type supplied in request.'}");
}

switch($_REQUEST['t']){
    /**
     * Event (e) request- asks for one event from the server
     */
    case "ge":
        if(!isset($_REQUEST['eid']))
            error(1201);
        /*$v = new stdClass();
        $v->make = $_REQUEST['mk'];
        $v->model = $_REQUEST['mdl'];
        $row = getEvoxImage($db, $v);
        $url = $config['url']['evox'] . "color_0320_032/" . $row['vif'] . "/" . $row['vif'] . "_cc0320_032_" . $row['code'] . ".jpg";
        $url = "http://www.newcarcity.com/images/img_lib/portal.evox.com/color_0320_032/" . $row['vif'] . "/" . $row['vif'] . "_cc0320_032_" . $row['code'] . ".jpg";
        $data->url = $url;
        $json = $jsonGen->genFromObject($data);*/
        exit(Utility_JSONGenerator::echoDocument('{e:"Hello World"}'));
        break;
    //Errors out meaning
    default:
        error(1200);
        break;
}

function error($e){
    exit(Utility_JSONGenerator::echoDocument("{'error':'" . constant("Utility_Constants::E_$e") . "',errno:'E_$e'}"));
}