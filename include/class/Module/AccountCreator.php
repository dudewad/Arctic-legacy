<?php
/**
 * Author: Ghost
 * Date: 2/5/14
 */
 
class Module_AccountCreator{



    public function to_html_full_create($class = null){
        $logo = Utility_Constants::URL_ASSET_BASE . "/image/gui/logo/logo-tanguer-title-gray.png";
        $html = <<<HTML
                <div class="ac $class">
                    <div class="title">
                        <img src="$logo" class="logo" />
                        <h1>Create an account</h1>
                    </div>
                    <div class="row form-content">
                        <form>
                            <div class="column col-1-2">
                                <label for="email">
                                    <p>Email</p>
                                    <input type="text" name="email" placeholder="Email"/>
                                </label>
                                <label for="password">
                                    <p>Password</p>
                                    <input type="password" name="password" placeholder="Password"/>
                                </label>
                                <label for="verify-password">
                                    <p>Verify Password</p>
                                    <input type="password" name="verify-password" placeholder="Verify password"/>
                                </label>
                            </div>
                            <div class="column col-1-2">
                                <span class="cta-container">
                                    <a href="" class="cta">Create Account</a>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
HTML;
        return $html;
    }
}
