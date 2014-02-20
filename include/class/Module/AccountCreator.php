<?php
/**
 * Author: Ghost
 * Date: 2/5/14
 */
 
class Module_AccountCreator{



    public function to_html_full_create($class = null){
        $logo = Utility_Constants::URL_ASSET_BASE . "/image/gui/logo/logo-tanguer-title-gray.png";
        $formAction = TanguerApp::getURL(String_String::getString("VIEW_ACCOUNT_CREATOR_START"));
        $dataPostType = Utility_Constants::REQUEST_TYPE_ACCOUNT_CREATOR_START;
        $arr = array();
        //Href for formatted TOS string
        $arr[0] = TanguerApp::buildAnchor(  String_String::getString("VIEW_TERMS_OF_SERVICE"),
                                            String_String::getString("TERMS_OF_SERVICE_TAGLINE"),
                                            "_blank");
        //TOS string to be formatted into legal
        $TOS = String_String::getString("MISC_CREATE_ACCOUNT_DISCLAIMER", __CLASS__, $arr);
        $startTitle = String_String::getString("TITLE_START", __CLASS__);
        $email = String_String::getString("FIELD_EMAIL", __CLASS__);
        $password = String_String::getString("FIELD_PASSWORD", __CLASS__);
        $verify = String_String::getString("FIELD_VERIFY_PASSWORD", __CLASS__);
        $createAcct = String_String::getString("FIELD_CREATE_ACCOUNT_SUBMIT", __CLASS__);

        $html = <<<HTML
                <div class="ac-start $class">
                    <div class="title">
                        <img src="$logo" class="logo" />
                        <h1>$startTitle</h1>
                    </div>
                    <div class="row form-content">
                        <form action="$formAction" method="post" >
                            <input type="hidden" name="t" value="$dataPostType"/>
                            <div class="column col-1-2 col-2-left">
                                <div class="col-content vr">
                                    <label for="email">
                                        <p>$email</p>
                                        <div class="input-bg">
                                            <input type="text" name="email" placeholder="$email"/>
                                        </div>
                                    </label>
                                    <label for="password">
                                        <p>$password</p>
                                        <div class="input-bg">
                                            <input type="password" name="password" placeholder="$password"/>
                                        </div>
                                    </label>
                                    <label for="verify-password clearfix">
                                        <p>$verify</p>
                                        <div class="input-bg">
                                            <input type="password" name="verify-password" placeholder="$verify"/>
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
}
