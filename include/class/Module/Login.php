<?php
/**
 * Author: Ghost
 * Date: 7/18/13
 */
 
class Module_Login{


    public function to_html_full($class = null){
        $logo = Utility_App::getURL("URL_MAIN") . "asset/image/gui/logo/logo-tanguer-gray-410x76.png";
        $loginURL = Utility_App::getURL("URL_CURRENT","a=login");
        $registerURL = Utility_App::getURL("URL_ACCOUNT","a=create");
        $loginSubtitle = String_String::getString("LOGIN_SUBTITLE");

        $createAccountCTA = String_String::getString("CTA_REGISTER");
        $usernameLabel = String_String::getString("FIELD_USERNAME");
        $passwordLabel = String_String::getString("FIELD_PASSWORD");
        $submitText = String_String::getString("FIELD_SUBMIT_LOGIN");
        $ctaButtonText = String_String::getString("BUTTON_REGISTER");

        $html = <<<HTML
            <div class='login $class'>
                <img class="logo" src="$logo" alt="Tánguer"/>
                <h2>$loginSubtitle</h2>
                <div class="row">
                    <form action="" method="post">
                        <div class="col-1-2">
                            <div class="label">
                                <label for="username">$usernameLabel</label>
                            </div>
                            <div class="label">
                                <label for="password">$passwordLabel</label>
                            </div>
                        </div>
                        <div class="col-1-2 end">
                            <input type="text" name="username" class="left"/>
                            <input type="password" name="password" class="left" />
                            <input type="submit" name="submit" value="$submitText" class="left submit" />
                        </div>
                        <div class="clear"></div>
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
