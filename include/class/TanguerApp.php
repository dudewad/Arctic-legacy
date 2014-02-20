<?php
/**
 * Created by Ghost.
 * Date: 6/14/13
 * Time: 8:45 PM
 */
//Some test comment
class TanguerApp{
    //Whether or not the current App instance has set a timezone
    private static $hasTimezoneSet = false;
    //Will contain "Alert" objects that are generated by the application for output to the user
    private static $alerts = array();
    //Will contain a number of strings that are to be inserted into the DOM as modal objects
    private static $modals = array();
    //Contains sanitized inputs that came in via get/post
    private static $userInput;
    //Will contain data specific to the current view
    private static $viewData;




    /**
     * Constructor
     */
    public function __construct(){
        self::$userInput = new stdClass();
        //Start out by getting the user's session data all set up
        $generator = new Test_ObjectGenerator();
        $lang = "en_us";
        String_String::setLanguage($lang);
        $this->setDefaultTimezone();
        $appUser = $generator->getRandomUser($lang);

        $location = new stdClass();
        $location->city = "Rosario";
        $location->country = "Argentina";
        self::setUserLocation($location);

        //TODO: Need to handle form submission tasks en masse in their own method call (and likely their own class)
        if(isset($_REQUEST['t'])){
            switch(strtolower($_REQUEST['t'])){
                //Login request
                case Utility_Constants::REQUEST_TYPE_LOGIN:
                    break;
                //Location selection updated
                case Utility_Constants::REQUEST_TYPE_LOCATION_SELECTED:
                    $city = isset($_REQUEST['city']) ? $_REQUEST['city'] : $location->getCity();
                    $country = isset($_REQUEST['country']) ? $_REQUEST['country'] : $location->getCountry();
                    self::setAlert(new Alert_Standard("Location selection has been updated: " . $country . "," . $city));
                    break;
                //Account creation - start flow submitted
                case Utility_Constants::REQUEST_TYPE_ACCOUNT_CREATOR_START;
                    break;
                //Account creation - verification link from email clicked
                case Utility_Constants::REQUEST_TYPE_ACCOUNT_CREATOR_VERIFY;
                    break;
                //Account creation - finalization flow submitted
                case Utility_Constants::REQUEST_TYPE_ACCOUNT_CREATOR_FINALIZE;
                    break;
                default:
                    break;
            }
        }

        self::setUserSession($appUser);
        self::validateAndStoreInputs();
    }



    /**
     * Figures out which view needs to be loaded, and loads it. Returns the data as a string.
     */
    public static function loadView(){
        $view = isset($_REQUEST['v']) ? $_REQUEST['v'] : null;
        $viewData = "";
        switch($view){
            //Account-creator: start
            case "ac-s":
                require_once(Utility_Constants::DIR_VIEW_BASE . "accountCreator.php");
                break;
            //Default to "main" view
            case "m":
            default:
                require_once(Utility_Constants::DIR_VIEW_BASE . "main.php");
                break;
        }
        $viewData = self::$viewData;
        return <<<HTML
                <div class="content">
                    $viewData
                </div>
HTML;
    }



    public static function setViewData($data){
        self::$viewData = $data;
    }



    private static function validateAndStoreInputs(){
        //Date input
        if(isset($_GET['d'])){
            //In case of invalid date being passed, send the user to the current day.
            try{
                Security_InputValidator::validateDateISO8601($_GET['d']);
                self::$userInput->date = Date_TanguerDateTime::urlFriendlyDateToTimestamp($_GET['d']);
            }
            catch(Exception_SecurityInputValidatorException $e){
                self::$userInput->date = time();
            }
        }
        else{
            self::$userInput->date = time();
        }

        //Event ID input
        if(isset($_GET['e'])){
            //In case of invalid event being passed, send the user to today's calendar with a null event selection
            try{
                Security_InputValidator::validateEventID($_GET['e']);
                self::$userInput->eventID = $_GET['e'];
            }
            catch(Exception_SecurityInputValidatorException $e){
                self::$userInput->eventID = null;
            }
        }
        else{
            self::$userInput->eventID = null;
        }
    }



    /**
     * @return string HTML string representing the site footer div
     */
    public function footer(){
        $data =  '';

        return $data;
    } //End footer()



    /**
     * @return string HTML string representing the site <head>
     */
    public static function head(){
        $lang = strtoupper(str_replace("_","",String_String::getLanguage()));
        $base = Utility_Constants::URL_MAIN;
        $data = "<head>
                    <meta charset='utf-8' />
                    <meta http-equiv='X-UA-Compatible' content='IE=edge' />
                    <meta name='description' content='Tánguer'/>
                    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
                    <meta name='viewport' content='width=device-width, initial-scale=1, user-scalable=no' />

                    <script src='js/third-party/jquery-1.10.1.min.js' type='text/javascript' ></script>
                    <script src='js/third-party/jquery.validate.min.js' type='text/javascript' ></script>
                    <script src='js/third-party/head.core.min.js' type='text/javascript' ></script>
                    <script src='js/Tanguer_App.js' type='text/javascript' ></script>

                    <script src='js/extension/Tanguer_IOC.js' type='text/javascript' ></script>
                    <script src='js/extension/Tanguer_JSONCalls.js' type='text/javascript' ></script>
                    <script src='js/extension/Tanguer_GUI.js' type='text/javascript' ></script>
                    <script src='js/extension/Tanguer_Modal.js' type='text/javascript' ></script>
                    <script src='js/extension/Tanguer_String_" . $lang . ".js' type='text/javascript' ></script>
                    <script src='js/module/Tanguer_Alert.js' type='text/javascript' ></script>
                    <script src='js/module/Tanguer_Calendar.js' type='text/javascript' ></script>
                    <script src='js/module/Tanguer_LocationSelector.js' type='text/javascript' ></script>
                    <script src='js/module/Tanguer_AccountCreator.js' type='text/javascript' ></script>

                    <link type='text/css' rel='stylesheet' href='css/style.css' media='all' />
                    <!--<link type='text/css' rel='stylesheet' href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' />-->

                    <link type='text/css' rel='stylesheet' href='" . $base . "css/main.css' />
                </head>";

        return $data;
    } //End head()



    public static function printHeader(){
        $logoURL = Utility_Constants::URL_MAIN;
        $logo = Utility_Constants::URL_ASSET_BASE . "/image/gui/logo/logo-tanguer-header.png";
        $locationSelector = new Module_LocationSelector();
        $locationSelector = $locationSelector->to_html_full();
        $html = <<<HTML
            <div id="header">
                <div class="content clearfix">
                    <div class="logo-block">
                        <h2><a href="$logoURL" class="logo"><img class="logo" src="$logo" alt="Tánguer" /></a></h2>
                    </div>
                    <div class="nav-right">
                        $locationSelector
                    </div>
                </div>
            </div>
            <hr class="header-decoration" />
HTML;
        return $html;
    }



    public static function getCurrentPageURL() {
        $pageURL = 'http';
        if(isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
            $pageURL .= "s";
        }
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80"){
            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        }
        else{
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }
        $url = explode("?",$pageURL);
        return $url[0];
    }



    public static function alertsToHTML(){
        if(count(TanguerApp::$alerts) > 0){
            $html = "<div class='alerts'>
                        <div class='content'>";
            for($i = 0; $i < count(TanguerApp::$alerts); $i++){
                $alert = TanguerApp::$alerts[$i];
                if(isset($_SESSION['alert']['dismissed']) && in_array($alert->getAlertCode(),$_SESSION['alert']['dismissed'])){
                    continue;
                }
                $ao = new Output_Alert_Alert($alert);
                $class = str_replace("_","-",strtolower(get_class($alert)));
                $html .= $ao->to_html_full($class);
            }
            $html .= "</div></div>";
        }
        return empty($html) ? null : $html;
    }



    public static function setAlert(Alert_Alert $alert){
        array_push(TanguerApp::$alerts, $alert);
    }



    public static function modalsToHTML(){
        if(count(TanguerApp::$modals) > 0){
            $html = "<div id='modals' style='display:none;'>";
            foreach(TanguerApp::$modals as $key => $val){
                $html .= <<<HTML
                        <div class='modal' id="$key">
                            <div class='close'></div>
                            $val
                        </div>
HTML;
            }
            $html .= "</div>";
        }
        return empty($html) ? null : $html;
    }



    public static function setModal($modal, $id){
        TanguerApp::$modals[$id] = $modal;
    }




    public static function hasTimezoneSet(){
        return TanguerApp::$hasTimezoneSet;
    }

    /**
     * Returns the user's timezone
     */
    public static function setDefaultTimezone(){
        $case = null;
        $fail = false;

        //Set IP if we can get it
        if(Utility_Constants::APP_ENVIRONMENT == "production"){
            $ip = TanguerApp::getUserIP();
        }
        else{
            $ip = "50.159.48.157";
        }

        //Priority 1: check user's settings (session) for timezone
        if(TanguerApp::hasUserSession() && isset($_SESSION['timezone']) && strlen($_SESSION['timezone']) > 0){
            date_default_timezone_set($_SESSION['timezone']);
        }
        //Priority 2: Use IP-based timezone guessing using the IPInfoDB service
        //Note: for the start build this is merely a guess and will not take DST into account.
        else if($ip){
            //Use the API key to hit the ipinfodb server for ip timezone information
            $key = constant("Utility_Constants::API_IPINFODB_API_KEY");
            $cr = curl_init("http://api.ipinfodb.com/v3/ip-city/?key=" . $key . "&ip=" . $ip . "&format=json");
            curl_setopt($cr,CURLOPT_CONNECTTIMEOUT,1);
            curl_setopt($cr, CURLOPT_RETURNTRANSFER, true);
            $data = curl_exec($cr);
            curl_close($cr);
            $data = json_decode($data);
            $t = $data->timeZone;
            //The API returns "-" for the timezone setting for invalid IPs. Break here if IP is invalid and move to
            //next fallback.
            if($data->timeZone != "-" || empty($data->timeZone)){
                $arr = explode(':',$t);
                //Parse returned timezone to numeric value
                $hours = (int)$arr[0];
                $min = (int)$arr[1] / 60;
                if($hours < 0)
                $min = $min * -1;
                $timeOffset = ($hours + $min) * 3600;
                $timezone = timezone_name_from_abbr(null, $timeOffset, true);
                //Set timezone
                date_default_timezone_set($timezone);
                $_SESSION['timezone'] = $timezone;
                TanguerApp::setAlert(new Alert_Timezone("Uset IPInfoDB API service to set default timezone. Timezone is set to: <strong>" . date_default_timezone_get() . "</strong>"));
            }
            else
                $fail = true;
        }
        //Priority 3: Use selected city's timezone, if available
        //TODO: Once the database is up and running, get this implemented. Uncomment the setting of {$fail = false} so the final if statement won't get tripped when this succeeds.
        if($fail){
            TanguerApp::setAlert(new Alert_Timezone("Reached city timezone set, skipping..."));
            //$fail = false;
            //echo "Used the timezone of the selected city.";
        }
        //Priority Default: No other timezone data is available. We'll default to using Buenos Aires.
        if($fail){
            date_default_timezone_set("America/Buenos_Aires");
            TanguerApp::setAlert(new Alert_Timezone("Used system default of Buenos Aires for the timezone settings. Timezone is set to: <strong>" . date_default_timezone_get() . "</strong>"));
        }

        TanguerApp::$hasTimezoneSet = true;
    }



    public static function getTimezone(){
        if(isset($_SESSION['timezone'])){
            return $_SESSION['timezone'];
        }
        return 0;
    }



    /**
     * @param $view     String      The view to be linked to
     *
     * @param $q        String      Query string arguments to be appended to the URL
     *
     * @return string               URL or empty string
     */
    public static function getURL($view = null, $q = null){
        $url = Utility_Constants::URL_MAIN;
        if(isset($view))
            $url .= $view;
        if(isset($q))
            $url .= "?$q";

        return $url;
    }


    /**
     * Gets an HTML formatted anchor tag and uses any passed view, copy, target, and query string data to do so.
     * @param $view             String      The view to be linked to
     * @param $copy             String      The actual text to appear inside the anchor
     * @param null $target      String      "Window target", e.g. "_blank". Defaults to nothing
     * @param null $q           String      Query string arguments to be appended to the URL
     * @param null $class       String      The CSS class attribute to add to the anchor
     * @return string
     */
    public static function buildAnchor($view, $copy, $target = null, $q = null, $class = null){
        $url = self::getURL($view, $q);
        $anchor = "<a href='$url'";
        if(isset($target))
            $anchor .= " target='$target'";
        if(isset($class))
            $anchor .= " class='$class'";
        $anchor .= ">$copy</a>";
        return $anchor;
    }



    public static function getDynamicURL($dynamicString, $base = null){
        if(strtoupper($base) == "URL_CURRENT"){
            return $_SERVER["PHP_SELF"];
        }
        $url = isset($base) ? constant("Utility_Constants::" . strtoupper($base)) : constant("Utility_Constants::URL_MAIN");

        return $url . $dynamicString;
    }



    public static function setUserSession($user){
        if(!($user instanceof Person_User))
            throw new Exception("Error setting user in " . __CLASS__ . "::setUser - the passed object must be of type Person_User");
        $obj = $user->to_object();
        $_SESSION['user'] = $obj;
        String_String::setLanguage($user->getLanguage());
    }



    public static function getUserInput($input){
        switch($input){
            //Gets the date that the user is requesting as a timestamp
            case "date":
                return isset(self::$userInput->date) ? self::$userInput->date : null;
                break;
            default:
                return null;
                break;
        }
    }



    public static function hasUserSession(){
        return isset($_SESSION) && isset($_SESSION['user']);
    }



    public static function getUserSession(){
        return $_SESSION['user'];
    }



    public static function getUserIP(){
        //Check ip from share internet
        if (!empty($_SERVER['HTTP_CLIENT_IP'])){
            $ip=$_SERVER['HTTP_CLIENT_IP'];
        }
        //to check ip is pass from proxy
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else{
            $ip=$_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }



    /**
     * Set the user location in both the session and the DB
     * @param $data stdClass    REQUIRED        The data to set the user's location to.
     *                                          Takes city and country fields
     */
    public static function setUserLocation($data){
        $_SESSION['location']['city'] = isset($data->city) ? $data->city : null;
        $_SESSION['location']['country'] = isset($data->country) ? $data->country : null;
        //TODO: Set the user session in the DB
    }



    /**
     * Print the site nav and return as HTML string
     *
     * @return string HTML String representing the site nav
     */
    private function nav(){
    } //End nav()
}