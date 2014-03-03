<?php
/**
 * Author: Ghost
 * Date: 7/12/13
 */
 
class String_ESAR_TanguerApp {

    //Login module related strings
    const LOGIN_SUBTITLE = "El sistema gratuito para organizar y encontrar tu baile";

    //Legal strings
    const TERMS_OF_SERVICE_TAGLINE = "Política de uso de Tánguer";

    //Date format for this language
    const DATE_FORMAT = "j/n/Y";

    //Country names
    const COUNTRY_ARGENTINA = "Argentina";
    const COUNTRY_UNITED_STATES = "Estados Unidos";

    //View constants for URLs (htaccess will deal with redirecting to the proper views)
    const VIEW_TERMS_OF_SERVICE             = "politica-de-uso";
    const VIEW_ACCOUNT_CREATOR_START        = "crear-cuenta";
    const VIEW_ACCOUNT_CREATOR_FINALIZE     = "finalizar-cuenta";
    const VIEW_ACCOUNT_MANAGER              = "cuenta";

    //Error constants
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

    //600 range - Calendar module

    //1200 range - AJAX errors
    //Invalid JSON request type specified.
    const E_1200        = "Invalid request type.";
    //A valid event ID must be passed.
    const E_1201        = "EID required";
}