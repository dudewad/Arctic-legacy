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
    /* Specify "dev" or "production" for the production gui for the easy-on-the-eyes dark dev theme */
    const APP_GUI_MODE = "dev";

    //URL CONSTANTS
    const URL_MAIN          = "http://10.0.0.17/tanguer/";
    const URL_JSON_BASE     = "http://10.0.0.17/tanguer/j";
    const URL_ASSET_BASE    = "http://10.0.0.17/tanguer/asset/";



    //DIRECTORY CONSTANTS
    const DIR_VIEW_BASE         = "include/view/";
    const DIR_EVENT_BANNER      = "asset/image/event/banner/";



    //Data post type constants
    const REQUEST_TYPE_GET_CALENDAR_QUICK_EVENT = "gcqe";
    const REQUEST_TYPE_GET_CALENDAR_FULL_DAY = "gcfd";
    const REQUEST_TYPE_POST_CALENDAR_SORT_FULL_DAY = "pcsfd";
    const REQUEST_TYPE_POST_LOCATION_SELECTED = "lsel";
    const REQUEST_TYPE_POST_ACCOUNT_CREATOR_VERIFY = "ac-v";
    const REQUEST_TYPE_POST_ACCOUNT_CREATOR_FINALIZE = "ac-f";
    const REQUEST_TYPE_POST_ACCOUNT_CREATOR_START = "ac-s";
    const REQUEST_TYPE_POST_EVENT_ADVANCED_SORT = "e-s-adv";
    const REQUEST_TYPE_POST_LOGIN = "l";
    const REQUEST_TYPE_POST_LOGIN_FIRST_TIME = "l-f";



    /**
     * Javascript Constants
     */
    const JS_BREAKPOINT_TABLET_PORTRAIT = 768;



    //API constants
    const API_IPINFODB_API_KEY  = "14985c7991a26fcb7c4becc0274dacbc15fc63f7aa02e1da1eb825cf6099ab7b";



    //Password constants. These constants may be changed without breaking existing hashes - current
    //passwords are stored with all settings readable.
    const PBKDF2_HASH_ALGORITHM     = "sha256";
    const PBKDF2_ITERATIONS         = 1000;
    const PBKDF2_SALT_BYTE_SIZE     = 24;
    const PBKDF2_HASH_BYTE_SIZE     = 24;
    const HASH_SECTIONS             = 4;
    const HASH_ALGORITHM_INDEX      = 0;
    const HASH_ITERATION_INDEX      = 1;
    const HASH_SALT_INDEX           = 2;
    const HASH_PBKDF2_INDEX         = 3;



    /**
     * Error constants
     */
    //100 range - General application errors
    //Default/unknown general application error
    const E_100         = "Unknown error occurred.";
    //Form field required
    const E_101         = "Field cannot be empty.";
    //Invalid first name submitted
    const E_102         = "Invalid first name value submitted.";
    //Invalid last name submitted
    const E_103         = "Invalid last name value submitted.";

    //200 range - SecurityInputValidator exceptions
    //Default/unknown SecurityInputValidator error
    const E_200         = "Invalid input.";
    //Invalid Event ID
    const E_201         = "Invalid event ID. The ID must be an integer.";
    //Invalid Date string
    const E_202         = "Invalid ISO 8601 date string. String required must be in format [YYYY-MM-DD].";
    //Invalid Alert ID
    const E_203         = "Invalid alert ID. The ID must be an integer.";
    //Invalid Email address
    const E_204         = "Invalid email address. A properly formatted email address is required to continue.";
    //Invalid password (when setting password) does not conform to publicly available password policy
    const E_205         = "Invalid password. The password does not meet the password requirements.";
    //Invalid password (before checking the DB). This error allows us to avoid a round trip to the DB because
    //the password does not conform to the publicly known password policy (which is why it's safe to fire right
    //away, since time-constant password checks aren't necessary against invalid passwords unless our hacker is
    //too stupid to look up our password requirements)
    const E_206         = "Invalid password entered.";

    //300 range - Authentication exceptions
    //Default/unknown authentication error
    const E_300         = "Authentication failed.";
    //Setting user password impossible - passwords don't match
    const E_301         = "Cannot create password- the passwords do not match!";
    //Invalid Account verification information
    const E_302         = "Could not verify account - required information was missing.";

    //600 range - Calendar module

    //1200 range - AJAX errors
    //Invalid JSON request type specified.
    const E_1200        = "Invalid request type.";
    //A valid event ID must be passed.
    const E_1201        = "EID required";



    private final function __construct(){}
    private final function __clone(){}
    public final function __wakeup(){}
}