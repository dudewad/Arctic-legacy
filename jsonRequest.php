<?php
/**
 * Author: Layton Miller
 * Contact: layton@desmill.com
 * Date: 9/2/13
 *
 * This file handles all json responses for the application.
 * All requests must come in with a "t" parameter, indicating the "type" of  json request this is.
 * The different types are listed below - as more are added they should be added here, AND KEPT IN ALPHABETICAL ORDER!!
 * For more information on each request type, see the switch statement below.
 *
 * ge = getEvent request
 */
header("Content-type: application/json");
define("BASEDIR", __DIR__ . "/");
require_once(BASEDIR . "/includes/config.php");
require_once(BASEDIR . "/include/script/Autoloader.php");
require_once(BASEDIR . "/includes/class/DB.php");
require_once(BASEDIR . "/includes/class/JSONGenerator.php");

$jsonGen = new JSONGenerator();
$db = DB::connection($config["db"]["tanguer"]);
$data = new stdClass();

if(!isset($_REQUEST['t'])){
    exit("{'error':'No response type supplied in request.'}");
}

switch($_REQUEST['t']){
    /**
     * Event (e) request- asks for one event from the server
     */
    case "e":
        if(!isset($_REQUEST['id'])){
            exit($jsonGen->echoDocument("{'error':'Missing '}"));
        }
        require_once(BASEDIR . "/includes/procedures/evox_image.php");
        $v = new stdClass();
        $v->make = $_REQUEST['mk'];
        $v->model = $_REQUEST['mdl'];
        $row = getEvoxImage($db, $v);
        $url = $config['url']['evox'] . "color_0320_032/" . $row['vif'] . "/" . $row['vif'] . "_cc0320_032_" . $row['code'] . ".jpg";
        $url = "http://www.newcarcity.com/images/img_lib/portal.evox.com/color_0320_032/" . $row['vif'] . "/" . $row['vif'] . "_cc0320_032_" . $row['code'] . ".jpg";
        $data->url = $url;
        $json = $jsonGen->genFromObject($data);
        exit($jsonGen->echoDocument($json));
        break;
    default:
        exit($jsonGen->echoDocument("{'error':'Unrecognized response type requested.'}"));
        break;
}