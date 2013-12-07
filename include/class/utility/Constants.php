<?php
/**
 * Author: Ghost
 * Date: 7/18/13
 */

class Utility_Constants {
    /* Specify "test" or "production" for application behavior switching in applicable areas*/
    const APP_ENVIRONMENT = "production";

    //URL CONSTANTS
    const URL_MAIN = "http://www.tanguer.net/";
    const URL_ACCOUNT = "http://www.tanguer.net/";
    const URL_JSON_BASE = "http://www.tanguer.net/jsonRequest.php";
    const URL_ASSET_BASE = "http://www.tanguer.net/asset/";



    //DIRECTORY CONSTANTS
    const DIR_EVENT_BANNER = "asset/image/event/banner/";



    /**
     * Javascript Constants
     */
    const JS_BREAKPOINT_TABLET_PORTRAIT = 768;



    //API constants
    const API_IPINFODB_API_KEY = "14985c7991a26fcb7c4becc0274dacbc15fc63f7aa02e1da1eb825cf6099ab7b";



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