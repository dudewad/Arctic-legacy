<?php
/**
 * Author: Ghost
 * Date: 12/1/13
 *
 * This module handles output for the Tánguer Location Selector. Includes auto-incrementing unique form IDs to carefree
 * usage to avoid DOM collisions.
 */

class Module_LocationSelector{
    //A prefix for all form IDs to help guarantee unique DOM IDs
    const formIDPrefix = "lsel";
    //The LocationSelector module will give each form a unique numeric ID
    public static $formID = 0;



    /**
     * Constructor
     */
    public function __construct(){}


    /**
     * Prints the location selector to HTML with unique form IDs
     *
     * @param   null    $class  String      A DOM class to add to the outer container
     * @return  string
     */
    public function to_html_full($class = null){
        $formAction = TanguerApp::getCurrentPageURL();
        $dataPostType = Utility_Constants::REQUEST_TYPE_LOCATION_SELECTED;
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
        $html = <<<HTML
                <div class="lsel clearfix $class" id="lsel$moduleID">
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
                                <input type="hidden" name="t" value="$dataPostType" />
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



    /**
     * Retrieves an ID for the form for a location selector element that is being output to HTML. Auto-increments the
     * local static variable self::$formID
     * @return int
     */
    private function getNextFormID(){
        $id = self::$formID;
        self::$formID++;
        return constant("self::formIDPrefix") . $id;
    }
}