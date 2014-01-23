<?php
/**
 * Author: Ghost
 * Date: 7/18/13
 *
 * List in a single-line array what env. variables are to be exported to SCSS
 * @SCSSEXPORT = ["URL_ASSET_BASE","APP_ENVIRONMENT","APP_GUI_MODE"];
 */

class Utility_Constants {
    /* Specify "test" or "production" for application behavior switching in applicable areas*/
    const APP_ENVIRONMENT = "test";
    /* Specify "dev" or "production" for the production gui or the easy-on-the-eyes dark dev theme */
    const APP_GUI_MODE = "test";

    //URL CONSTANTS
    const URL_MAIN = "http://10.0.0.17/tanguer/";
    const URL_ACCOUNT = "http://10.0.0.17/tanguer/test";
    const URL_JSON_BASE = "http://10.0.0.17/tanguer/jsonRequest.php";
    const URL_ASSET_BASE = "http://10.0.0.17/tanguer/asset/";



    //DIRECTORY CONSTANTS
    const DIR_EVENT_BANNER = "asset/image/event/banner/";



    /**
     * Javascript Constants
     */
    const JS_BREAKPOINT_TABLET_PORTRAIT = 768;



    //API constants
    const API_IPINFODB_API_KEY = "14985c7991a26fcb7c4becc0274dacbc15fc63f7aa02e1da1eb825cf6099ab7b";



    //Password constants. These constants may be changed without breaking existing hashes - current
    //passwords are stored with all settings readable.
    const PBKDF2_HASH_ALGORITHM = "sha256";
    const PBKDF2_ITERATIONS = 1000;
    const PBKDF2_SALT_BYTE_SIZE = 24;
    const PBKDF2_HASH_BYTE_SIZE = 24;
    const HASH_SECTIONS = 4;
    const HASH_ALGORITHM_INDEX = 0;
    const HASH_ITERATION_INDEX = 1;
    const HASH_SALT_INDEX = 2;
    const HASH_PBKDF2_INDEX = 3;



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
    public final function __wakeup(){}
}