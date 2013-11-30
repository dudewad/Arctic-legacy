<?php
/**
 * Author: Ghost
 * Date: 7/18/13
 */
 
class Module_Login{


    public function to_html_full($class = null){
        $logo = Utility_Constants::URL_ASSET_BASE . "image/gui/logo/logo-tanguer-large-gray.png";
        $loginURL = Utility_App::getURL("URL_CURRENT","a=login");
        $registerURL = Utility_App::getURL("URL_ACCOUNT","a=create");
        $loginSubtitle = String_String::getString("LOGIN_SUBTITLE");

        $createAccountCTA = String_String::getString("CTA_REGISTER",__CLASS__);
        $usernameLabel = String_String::getString("FIELD_USERNAME",__CLASS__);
        $passwordLabel = String_String::getString("FIELD_PASSWORD",__CLASS__);
        $submitText = String_String::getString("FIELD_SUBMIT_LOGIN",__CLASS__);
        $ctaButtonText = String_String::getString("BUTTON_REGISTER",__CLASS__);

        $html = <<<HTML
            <div class='login $class'>
                <img class="logo" src="$logo" alt="Tánguer"/>
                <h2>$loginSubtitle</h2>
                <div class="row">
                    <form action="" method="post">
                        <div class="row clearfix">
                            <div class="col-2-5">
                                <label for="username">$usernameLabel</label>
                            </div>
                            <div class="col-3-5">
                                <input type="text" name="username"/>
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
                    <a href="$registerURL" class="cta">$ctaButtonText</a>
                </span>
            </div>
HTML;

        return $html;
    }



    public function to_html_thumb($class){

    }
}
