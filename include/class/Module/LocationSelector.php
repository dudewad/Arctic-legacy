<?php
/**
 * Author: Ghost
 * Date: 12/1/13
 */

class Module_LocationSelector{
    public static $formID = 0;

    public function __construct(){
    }



    public function to_html_full(){
        $city = isset($_SESSION['location']['city']) ? $_SESSION['location']['city'] : null;
        $country = isset($_SESSION['location']['country']) ? $_SESSION['location']['country'] : null;
        $changeLocationString = String_String::getString("MISC_CHANGE_LOCATION",__CLASS__);
        $countryArgentina = String_String::getString("COUNTRY_ARGENTINA");
        $countryUnitedStates = String_String::getString("COUNTRY_UNITED_STATES");
        $indicatorURL = Utility_Constants::URL_ASSET_BASE . "/image/gui/gui-calendar-flyout-arrow-indicator19x10.png";
        $change = String_String::getString("MISC_SUBMIT_LOCATION_CHANGE",__CLASS__);
        $formID = $this->getNextFormID();
        $formAction = Utility_App::getCurrentPageURL();
        $html = <<<HTML
                <div class="lsel">
                    <div class="location">
                        <h3>$city, $country</h3>
                    </div>
                    <div class="change-location">
                        <a href="" class="change">
                            $changeLocationString
                            <span class="indicator"></span>
                        </a>
                        <div class="selector">
                            <img class="indicator" src="$indicatorURL" alt="">
                            <div class="country">
                                <form action="$formAction" method="post" id="lselForm$formID" >
                                    <input type="hidden" name="lsel" value="1" />
                                    <select name="country">
                                        <option value="0">$countryArgentina</option>
                                        <option value="1">$countryUnitedStates</option>
                                    </select>
                                    <input type="submit" name="lselSubmit$formID" value="$change" class="submit" />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
HTML;
        return $html;
    }



    private function getNextFormID(){
        $id = self::$formID;
        self::$formID++;
        return $id;
    }
}