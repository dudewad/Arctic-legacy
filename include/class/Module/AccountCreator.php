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
        $emailError = $passwordError = $passwordVerifyError = "";

        if(self::hasValidationErrors()){
            $errors = self::getValidationErrors();
            for($i = 0; $i < count($errors); $i++){
                $e = $errors[$i];
                switch($e->getCode()){
                    case 204:
                        $emailClass = "error";
                        $emailError = $e->getHTMLFormattedMessage();
                        break;
                    case 205:
                    case 206:
                        $passwordClass = $passwordVerifyClass = "error";
                        $passwordError = $passwordVerifyError = $e->getHTMLFormattedMessage();
                        break;
                    case 301:
                        $passwordClass = $passwordVerifyClass = "error";
                        $passwordError = $passwordVerifyError = $e->getHTMLFormattedMessage();
                        break;
                }
            }
        }

        $html = <<<HTML
                <div class="ac-s $class" data-tanguer_module="ac">
                    <div class="title">
                        <img src="$logo" class="logo" />
                        <h1>$startTitle</h1>
                    </div>
                    <div class="row form-content">
                        <form action="$formAction" method="post" class="clearfix" data-form_variant="ac-s">
                            <input type="hidden" name="t" value="$dataPostType"/>
                            <div class="column col-1-2 col-2-left">
                                <div class="col-content vr">
                                    <label for="email" class="$emailClass">
                                        <p>$email</p>
                                        $emailError
                                        <div class="input-bg">
                                            <input type="text" name="email" placeholder="$emailPlaceholder"/>
                                        </div>
                                    </label>
                                    <label for="password" class="$passwordClass">
                                        <p>$password</p>
                                        $passwordError
                                        <div class="input-bg">
                                            <input type="password" name="password" placeholder="$passwordPlaceholder"/>
                                        </div>
                                    </label>
                                    <label for="verifyPassword" class="$passwordVerifyClass">
                                        <p class="">$verify</p>
                                        $passwordVerifyError
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
                <div class="ac-r $class" data-tanguer_module="ac">
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



    /**
     * "Finalize your account" flow
     *
     * @param null $class      The CSS class to be applied to the outer div of this element
     *
     * @return string
     */
    public function to_html_full_finalize($class = null){
        $logo = Utility_Constants::URL_ASSET_BASE . "/image/gui/logo/logo-tanguer-title-gray.png";
        $formAction = TanguerApp::getURL(String_String::getString("VIEW_ACCOUNT_CREATOR_FINALIZE"));
        $dataPostType = Utility_Constants::REQUEST_TYPE_POST_ACCOUNT_CREATOR_FINALIZE;
        $title = String_String::getString("TITLE_FINALIZE", __CLASS__);
        $content1 = String_String::getString("CONTENT_FINALIZE_BODY_1", __CLASS__);
        $firstName = $firstNamePlaceholder = String_String::getString("FIELD_FIRST_NAME", __CLASS__);
        $lastName = $lastNamePlaceholder = String_String::getString("FIELD_LAST_NAME", __CLASS__);
        $submit = String_String::getString("FIELD_FINALIZE_ACCOUNT_SUBMIT", __CLASS__);
        $firstNameClass = $lastNameClass = "";
        $firstNameError = $lastNameError = "";

        if(self::hasValidationErrors()){
            $errors = self::getValidationErrors();
            for($i = 0; $i < count($errors); $i++){
                $e = $errors[$i];
                switch($e->getCode()){
                    case 204:
                        $emailClass = "error";
                        $emailError = $e->getHTMLFormattedMessage();
                        break;
                    case 205:
                    case 206:
                        $passwordClass = $passwordVerifyClass = "error";
                        $passwordError = $passwordVerifyError = $e->getHTMLFormattedMessage();
                        break;
                }
            }
        }

        $html = <<<HTML
                <div class="ac-f $class" data-tanguer_module="ac">
                    <div class="title">
                        <img src="$logo" class="logo" />
                        <h1>$title</h1>
                    </div>
                    <div class="text-center">
                        <h3>$content1</h3>
                    </div>
                    <div class="row form-content">
                        <form action="$formAction" method="post" class="clearfix" data-form_variant="ac-f">
                            <input type="hidden" name="t" value="$dataPostType"/>
                            <div class="column col-1-2 col-2-left">
                                <div class="col-content vr">
                                    <label for="firstName" class="$firstNameClass">
                                        <p>$firstName</p>
                                        $firstNameError
                                        <div class="input-bg">
                                            <input type="text" name="firstName" placeholder="$firstNamePlaceholder"/>
                                        </div>
                                    </label>
                                    <label for="lastName" class="$passwordClass">
                                        <p>$lastName</p>
                                        $lastNameError
                                        <div class="input-bg">
                                            <input type="text" name="lastName" placeholder="$lastNamePlaceholder"/>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="column col-1-2 col-2-right end">
                                <div class="col-content">
                                    <span class="cta-container">
                                        <input type="submit" class="cta" value="$submit" />
                                    </span>
                                </div>
                            </div>
                        </form>
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



    /**
     * Static validation function for the "start" flow sequence submission
     */
    public static function validateStartSubmission(){
        //Reset the validationErrors array
        self::clearValidationErrors();

        //Verify email
        try{
            Security_InputValidator::validateEmail($_POST['email']);
        }
        catch(Exception_SecurityInputValidatorException $e){
            self::setValidationError($e);
        }
        //Verify password
        try{
            Security_InputValidator::validatePassword($_POST['password'],true);
            Security_InputValidator::validatePassword($_POST['verifyPassword'],true);
        }
        catch(Exception_SecurityInputValidatorException $e){
            self::setValidationError($e);
        }
        //Verify that both passwords are the same
        if($_POST['password'] != $_POST['verifyPassword']){
            self::setValidationError(new Exception_AuthenticationException(Utility_Constants::E_301, 301));
        }

        return !self::hasValidationErrors();
    }



    /**
     * Static validation function for when a user "verifies" their new account by clicking through an email
     * verification link
     */
    public static function validateVerificationSubmission(){
        //Reset the validationErrors array
        self::clearValidationErrors();

        //Require email and activation token
        if( !isset($_GET['email'])
            || !isset($_GET['token'])){
            self::setValidationError(new Exception_AuthenticationException(Utility_Constants::E_302, 302));
            return !self::hasValidationErrors();
        }
        try{
            Security_InputValidator::validateEmail($_GET['email']);
        }
        catch(Exception_SecurityInputValidatorException $e){
            self::setValidationError($e);
        }
        //TODO: CRITICAL FOR LAUNCH - Verification submission needs token checking against active database records.

        return !self::hasValidationErrors();
    }



    /**
     * Static validation function for the "finalize" flow sequence submission
     */
    public static function validateFinalizeSubmission(){
        //Reset the validationErrors array
        self::clearValidationErrors();

        //Verify that both names were given
        if( !isset($_POST['firstName'])
            || empty($_POST['firstName'])
            || !isset($_POST['lastName'])
            || empty($_POST['lastName'])){
            self::setValidationError(new Exception_AuthenticationException(Utility_Constants::E_101, 101));
            return !self::hasValidationErrors();
        }
        //Verify first name
        try{
            Security_InputValidator::validateFirstName($_POST['firstName']);
        }
        catch(Exception_SecurityInputValidatorException $e){
            self::setValidationError($e);
        }
        //Verify last name
        try{
            Security_InputValidator::validateFirstName($_POST['lastName']);
        }
        catch(Exception_SecurityInputValidatorException $e){
            self::setValidationError($e);
        }

        return !self::hasValidationErrors();
    }
}
