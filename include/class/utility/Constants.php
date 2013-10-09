<?php
/**
 * Author: Ghost
 * Date: 7/18/13
 */

class Utility_Constants {
    //URL CONSTANTS
    /* For remote testing:
    const URL_MAIN = "http://10.0.0.17/tanguer/";
    const URL_ACCOUNT = "http://10.0.0.17/tanguer/test";
    const URL_JSON_BASE = "http://10.0.0.17/tanguer/jsonRequest.php";
*/

    /*For local testing:*/
    const URL_MAIN = "http://localhost/tanguer/";
    const URL_ACCOUNT = "http://localhost/tanguer/test";
    const URL_JSON_BASE = "http://localhost/tanguer/jsonRequest.php";




    //DIRECTORY CONSTANTS
    const DIR_EVENT_BANNER = "asset/image/event/banner/";


    /**
     * Javascript Constants
     */
    const JS_BREAKPOINT_TABLET_PORTRAIT = 768;


    /**
     * Error constants
     */
    //Ajax errors are 1200 range
    //Error 1200: Invalid JSON request type specified.
    const E_1200 = "Invalid t value.";
    //Error 1201: A valid event ID must be passed.
    const E_1201 = "EID required";



    private final function __construct(){}
    private final function __clone(){}
}