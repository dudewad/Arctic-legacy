<?php
/**
 * Author: Ghost
 * Date: 7/18/13
 */
 
class Module_Login implements Interface_HasForms{
    //Data related to a previous submission will be stored here for use in subsequent
    //flows or repeating previous flows with error reporting, etc.
    private static $submissionData = null;
    //Any form validation errors go here
    private static $validationErrors = array();
    //Special flag for when logins should be disabled
    private static $disableLogins = false;


    public static function to_html_full($class = null){
        $logo = Utility_Constants::URL_ASSET_BASE . "image/gui/logo/logo-tanguer-large-gray.png";
        $formAction = Utility_Constants::URL_MAIN;
        $dataPostType = Utility_Constants::REQUEST_TYPE_POST_LOGIN;
        $dataAttrs = new stdClass();
        $dataAttrs->flow_start = "ac";
        $registerAnchor = TanguerApp::buildAnchor(  String_String::getString("VIEW_ACCOUNT_CREATOR_START"),
                                                    String_String::getString("BUTTON_REGISTER",__CLASS__),
                                                    null,
                                                    null,
                                                    "cta",
                                                    $dataAttrs);
        $loginSubtitle = String_String::getString("LOGIN_SUBTITLE");

        $createAccountCTA = String_String::getString("CTA_REGISTER",__CLASS__);
        $usernameLabel = String_String::getString("FIELD_USERNAME",__CLASS__);
        $passwordLabel = String_String::getString("FIELD_PASSWORD",__CLASS__);
        $submitText = String_String::getString("FIELD_SUBMIT_LOGIN",__CLASS__);

        $submissionData = self::getSubmissionData();
        $defaultEmail = isset($submissionData->email) ? $submissionData->email : "";

        $html = <<<HTML
            <div class='login $class'>
                <img class="logo" src="$logo" alt="Tánguer"/>
                <h2>$loginSubtitle</h2>
                <div class="row">
                    <form action="$formAction" method="post">
                        <input type="hidden" name="t" value="$dataPostType"/>
                        <div class="row clearfix">
                            <div class="col-2-5">
                                <label for="username">$usernameLabel</label>
                            </div>
                            <div class="col-3-5">
                                <input type="text" name="email" value="$defaultEmail"/>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-2-5">
                                <label for="password">$passwordLabel</label>
                            </div>
                            <div class="col-3-5">
                                <input type="password" name="password" />
                            </div>
                        </div>
                        <div class="row clearfix">
                            <input type="submit" name="submit" value="$submitText" class="submit" />
                        </div>
                    </form>
                </div>
                <hr />
                <h3>$createAccountCTA</h3>
                <span class="cta-container">
                    $registerAnchor
                </span>
            </div>
HTML;

        return $html;
    }


    public static function to_html_first_login($class = null){
        $logo = Utility_Constants::URL_ASSET_BASE . "image/gui/logo/logo-tanguer-title-gray.png";
        $formAction = Utility_Constants::URL_MAIN;
        $dataPostType = Utility_Constants::REQUEST_TYPE_POST_LOGIN_FIRST_TIME;
        $loginSubtitle = String_String::getString("FIRST_LOGIN_SUBTITLE",__CLASS__);

        $usernameLabel = String_String::getString("FIELD_USERNAME",__CLASS__);
        $passwordLabel = String_String::getString("FIELD_PASSWORD",__CLASS__);
        $submitText = String_String::getString("FIELD_SUBMIT_LOGIN",__CLASS__);

        $submissionData = self::getSubmissionData();
        $defaultEmail = isset($submissionData->email) ? $submissionData->email : "";
        $token = isset($submissionData->token) ? $submissionData->token : "";

        $html = <<<HTML
            <div class='login first $class' data-modal-start="true">
                <div class='title'>
                    <img class="logo" src="$logo" alt="Tánguer"/>
                    <h1>$loginSubtitle</h1>
                </div>
                <div class="row">
                    <form action="$formAction" method="post">
                        <input type="hidden" name="t" value="$dataPostType"/>
                        <input type="hidden" name="token" value="$token"/>
                        <div class="row clearfix">
                            <div class="col-2-5">
                                <label for="email">$usernameLabel</label>
                            </div>
                            <div class="col-3-5">
                                <input type="text" name="email" value="$defaultEmail"/>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-2-5">
                                <label for="password">$passwordLabel</label>
                            </div>
                            <div class="col-3-5">
                                <input type="password" name="password" />
                            </div>
                        </div>
                        <div class="row clearfix">
                            <input type="submit" name="submit" value="$submitText" class="submit" />
                        </div>
                    </form>
                </div>
            </div>
HTML;

        return $html;
    }



    public static function hasDisabledLogins(){
        return self::$disableLogins;
    }



    public static function disableLogins(){
        self::$disableLogins = true;
    }



    public static function getValidationErrors(){
        return self::$validationErrors;
    }



    public static function getSubmissionData(){
        return isset(self::$submissionData) ? self::$submissionData : null;
    }



    public static function setSubmissionData($data){
        self::$submissionData = $data;
    }



    public static function hasValidationErrors(){
        return count(self::$validationErrors) ? true : false;
    }



    public static function setValidationError($e){
        if(is_a($e, "Exception"))
            array_push(self::$validationErrors, $e);
        else
            Throw new Exception("Invalid item passed to " . __CLASS__ . "." . __METHOD__ . ". Item must be of type Exception.");
    }



    /**
     * Resets the array of validation errors
     */
    public static function clearValidationErrors(){
        self::$validationErrors = array();
    }
}
