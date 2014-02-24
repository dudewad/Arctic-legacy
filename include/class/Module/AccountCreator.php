<?php
/**
 * Author: Ghost
 * Date: 2/5/14
 */
 
class Module_AccountCreator implements Interface_HasForms{
    //Data related to a previous submission will be stored here for use in subsequent
    //flows or repeating previous flows with error reporting, etc.
    private static $submissionData = null;
    //Any form validation errors go here
    private static $validationErrors = array();



    public function to_html_full_create($class = null){
        $logo = Utility_Constants::URL_ASSET_BASE . "/image/gui/logo/logo-tanguer-title-gray.png";
        $formAction = TanguerApp::getURL(String_String::getString("VIEW_ACCOUNT_CREATOR_START"));
        $dataPostType = Utility_Constants::REQUEST_TYPE_POST_ACCOUNT_CREATOR_START;
        $arr = array();
        //Href for formatted TOS string
        $arr[0] = TanguerApp::buildAnchor(  String_String::getString("VIEW_TERMS_OF_SERVICE"),
                                            String_String::getString("TERMS_OF_SERVICE_TAGLINE"),
                                            "_blank");
        //TOS string to be formatted into legal
        $TOS = String_String::getString("CONTENT_START_ACCOUNT_DISCLAIMER", __CLASS__, $arr);
        $startTitle = String_String::getString("TITLE_START", __CLASS__);
        $email = $emailPlaceholder = String_String::getString("FIELD_EMAIL", __CLASS__);
        $password = $passwordPlaceholder = String_String::getString("FIELD_PASSWORD", __CLASS__);
        $verify = $verifyPlaceholder = String_String::getString("FIELD_VERIFY_PASSWORD", __CLASS__);
        $createAcct = String_String::getString("FIELD_CREATE_ACCOUNT_SUBMIT", __CLASS__);
        $emailClass = $passwordClass = $passwordVerifyClass = "";

        if(self::hasValidationErrors()){
            $errors = self::getValidationErrors();
            for($i = 0; $i < count($errors); $i++){
                switch($errors[$i]->getCode()){
                    case 204:
                        $emailClass = "error";
                        break;
                }
            }
        }

        $html = <<<HTML
                <div class="ac-start $class">
                    <div class="title">
                        <img src="$logo" class="logo" />
                        <h1>$startTitle</h1>
                    </div>
                    <div class="row form-content">
                        <form action="$formAction" method="post">
                            <input type="hidden" name="t" value="$dataPostType"/>
                            <div class="column col-1-2 col-2-left">
                                <div class="col-content vr">
                                    <label for="email" class="$emailClass">
                                        <p>$email</p>
                                        <div class="input-bg">
                                            <input type="text" name="email" placeholder="$emailPlaceholder"/>
                                        </div>
                                    </label>
                                    <label for="password" class="$passwordClass">
                                        <p>$password</p>
                                        <div class="input-bg">
                                            <input type="password" name="password" placeholder="$passwordPlaceholder"/>
                                        </div>
                                    </label>
                                    <label for="verifyPassword" class="$passwordVerifyClass">
                                        <p class="">$verify</p>
                                        <div class="input-bg">
                                            <input type="password" name="verifyPassword" placeholder="$verifyPlaceholder"/>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="column col-1-2 col-2-right end">
                                <div class="col-content">
                                    <span class="cta-container">
                                        <input type="submit" class="cta" value="$createAcct" />
                                    </span>
                                    <p>
                                       $TOS
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
HTML;
        return $html;
    }



    /**
     * Prints the "Your account is ready" view of the account creator object.
     *
     * @param $email    string      REQUIRED    The email address that the notification email was sent to
     *
     * @param null $class                       Any additional CSS classes to be added to the outer container
     *
     * @return string                           The HTML formatted content
     */
    public function to_html_full_ready($email, $class = null){
        $logo = Utility_Constants::URL_ASSET_BASE . "/image/gui/logo/logo-tanguer-title-gray.png";
        $title = String_String::getString("TITLE_READY", __CLASS__);
        $arr = array();
        //User's email address
        $arr[0] = "<span class='accent'>$email</span>";
        $content1 = String_String::getString("CONTENT_READY_BODY_1", __CLASS__, $arr);
        $content2 = String_String::getString("CONTENT_READY_BODY_2", __CLASS__);

        $html = <<<HTML
                <div class="ac-start $class">
                    <div class="title">
                        <img src="$logo" class="logo" />
                        <h1>$title</h1>
                    </div>
                    <div class="text-center">
                        <h3>$content1</h3>
                        <p>$content2</p>
                    </div>
                </div>
HTML;
        return $html;
    }



    public static function getValidationErrors(){
        return self::$validationErrors;
    }



    public static function getSubmissionData(){
        return self::$submissionData;
    }



    public static function setSubmissionData($data){
        self::$submissionData = $data;
    }



    public static function hasValidationErrors(){
        return count(self::$validationErrors) ? true : false;
    }



    /**
     * Static validation function for the "start" flow sequence submission validation
     */
    public static function validateStartSubmission(){
        //Reset the validationErrors array
        self::$validationErrors = array();

        //Verify email
        try{
            Security_InputValidator::validateEmail($_POST['email']);
        }
        catch(Exception_SecurityInputValidatorException $e){
            array_push(self::$validationErrors,$e);
        }
        //Verify password
        try{
            Security_InputValidator::validatePassword($_POST['password'],true);
            Security_InputValidator::validatePassword($_POST['verifyPassword'],true);
        }
        catch(Exception_SecurityInputValidatorException $e){
            array_push(self::$validationErrors,$e);
        }
        //Verify that both passwords are the same
        if($_POST['password'] != $_POST['verifyPassword']){
            array_push(self::$validationErrors,new Exception_AuthenticationException(Utility_Constants::E_301, 301));
        }

        return count(self::$validationErrors) ? false : true;
    }
}
