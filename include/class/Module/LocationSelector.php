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
        $title = String_String::getString("MODULE_TITLE",__CLASS__);
        $changeLocationString = String_String::getString("MISC_CHANGE_LOCATION",__CLASS__);
        $countryLabel = String_String::getString("LABEL_COUNTRY",__CLASS__);
        $cityLabel = String_String::getString("LABEL_CITY",__CLASS__);
        $countryArgentina = String_String::getString("COUNTRY_ARGENTINA");
        $countryUnitedStates = String_String::getString("COUNTRY_UNITED_STATES");
        $indicatorURL = Utility_Constants::URL_ASSET_BASE . "/image/gui/gui-calendar-flyout-arrow-indicator19x10.png";
        $change = String_String::getString("MISC_SUBMIT_LOCATION_CHANGE",__CLASS__);
        $moduleID = $this->getNextFormID();
        $formAction = Utility_App::getCurrentPageURL();
        $html = <<<HTML
                <div class="lsel" id="lsel$moduleID">
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
                            <h3>$title</h3>
                            <form action="$formAction" method="post" id="lselForm$moduleID" >
                                <input type="hidden" name="lsel" value="1" />
                                <label for="country">$countryLabel</label>
                                <select name="country">
                                    <option value="0">$countryArgentina</option>
                                    <option value="1">$countryUnitedStates</option>
                                </select>
                                <label for="city">$cityLabel</label>
                                <select name="city">
                                    <option value="0">Buenos Aires</option>
                                    <option value="1">Rosario</option>
                                </select>
                                <input type="submit" name="lselSubmit$moduleID" value="$change" class="submit" />
                            </form>
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