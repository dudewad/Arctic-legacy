<?php
/**
 * Author: Ghost
 * Date: 2/21/14
 */
 
class Utility_SubmssionHandler {
    /**
     * Handles all submissions for the Tánguer application
     */
    public static function handleSubmissions(){
        if(isset($_REQUEST['t'])){
            switch(strtolower($_REQUEST['t'])){



                //Login request
                case Utility_Constants::REQUEST_TYPE_POST_LOGIN:
                    break;



                //Location selection updated
                case Utility_Constants::REQUEST_TYPE_POST_LOCATION_SELECTED:
                    $city = isset($_REQUEST['city']) ? $_REQUEST['city'] : "Buenos Aires";
                    $country = isset($_REQUEST['country']) ? $_REQUEST['country'] : "Argentina";
                    TanguerApp::setAlert(new Alert_Standard("Location selection has been updated: " . $country . "," . $city));
                    break;



                //Account creation - start flow submitted
                case Utility_Constants::REQUEST_TYPE_POST_ACCOUNT_CREATOR_START;
                    if(Module_AccountCreator::validateStartSubmission() === true){
                        $submissionData = new stdClass();
                        $submissionData->email = $_POST['email'];
                        Module_AccountCreator::setSubmissionData($submissionData);
                    }
                    else{
                        //Form submission was flawed in some way, gracefully handle the errors
                        $arr = Module_AccountCreator::getValidationErrors();
                        for($i = 0 ; $i < count($arr); $i++){
                            $error = $arr[$i];
                            TanguerApp::setAlert(new Alert_Standard($error->getMessage()));
                        }
                    }
                    break;



                //Account creation - verification link from email clicked
                case Utility_Constants::REQUEST_TYPE_POST_ACCOUNT_CREATOR_VERIFY;
                    break;



                //Account creation - finalization flow submitted
                case Utility_Constants::REQUEST_TYPE_POST_ACCOUNT_CREATOR_FINALIZE;
                    break;



                default:
                    break;
            }
        }
    }


    private final function __construct(){}
    private final function __clone(){}
    public final function __wakeup(){}
}
 