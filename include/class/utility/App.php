<?php
/**
 * Created by Ghost.
 * Date: 6/14/13
 * Time: 8:45 PM
 */
//Some test comment
class Utility_App{
    //Contains the app config
    private $config;
    //Will contain the name of the current page
    private $currentPage;
    //Will contain all current page content
    private $currentPageContent;
    //Will contain tooltips for the page
    private $tooltips;
    //Whether or not the current App instance has set a timezone
    private static $hasTimezoneSet = false;




    /**
     * @param $config   Array           The config array for the site
     *
     * @param $baseDir  String          The location of the base directory relative to this file
     *
     * Constructor
     */
    public function __construct($config, $baseDir){
        $this->config = $config;
        $this->currentPage = isset($_REQUEST['p']) ? $_REQUEST['p'] : 'home';
        $view = $this->config['path']['pageView'];
        //Include the current page file or revert to index
        $page = $baseDir . $view . $this->currentPage . ".php";
        /*if(file_exists($page))
            require_once($page);
        else
            require_once($baseDir . $view . "home.php");

        $this->currentPageContent = isset($pageContent) ? $pageContent : null;
        $this->tooltips = isset($tooltips) ? $tooltips : null;*/
    } //End __construct



    /**
     * @return string HTML string representing the content for this page
     */
    public function content(){
        $data = "<div id='content'>" . $this->currentPageContent . "</div>";
        $data .= $this->tooltips;
        return $data;
    } //End content()



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
    public function head(){
        //Set the meta description
        switch($this->currentPage){
            default:
                $metaDesc = "";
                break;
        }
        //TODO: Remove the text.css on deployment, as well as un-comment the google fonts reference
        $data = "<head>
                    <meta charset='utf-8' />
                    <meta http-equiv='X-UA-Compatible' content='IE=edge' />
                    <meta name='description' content='" . $metaDesc . "'/>
                    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
                    <meta name='viewport' content='width=device-width', initial-scale='1', user-scalable='no' />

                    <script src='js/third-party/jquery-1.10.1.min.js' type='text/javascript' ></script>
                    <script src='js/third-party/jquery.validate.min.js' type='text/javascript' ></script>
                    <script src='js/third-party/head.core.min.js' type='text/javascript' ></script>
                    <script src='js/Tanguer_App.js' type='text/javascript' ></script>
                    <script src='js/extension/Tanguer_IOC.js' type='text/javascript' ></script>
                    <script src='js/extension/Tanguer_JSONCalls.js' type='text/javascript' ></script>
                    <script src='js/extension/Tanguer_GUI.js' type='text/javascript' ></script>
                    <script src='js/module/Tanguer_Tooltip.js' type='text/javascript' ></script>
                    <script src='js/module/Tanguer_Calendar.js' type='text/javascript' ></script>
                    <script type='text/javascript' src='POC/js/test.js'></script>


                    <link type='text/css' rel='stylesheet' href='css/style.css' media='all' />
                    <link type='text/css' rel='stylesheet' href='css/tooltip.css' />
                    <!--<link type='text/css' rel='stylesheet' href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' />-->
                    <link type='text/css' rel='stylesheet' href='POC/css/test-min.css' />
                </head>";

        return $data;
    } //End head()



    /**
     * Return the name of the current page
     * @return string The name of the current page
     */
    public function getCurrentPageName(){
        return $this->currentPage;
    } //End getCurrentPageName()



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
        return $pageURL;
    }



    public static function hasTimezoneSet(){
        return Utility_App::$hasTimezoneSet;
    }


    /**
     * Returns the user's timezone
     */
    public static function setDefaultTimezone(){
        $case = null;
        $fail = false;

        //Set IP if we can get it
        if(Utility_Constants::APP_ENVIRONMENT == "test"){
            $ip = "50.159.48.157";
            //date_default_timezone_set("America/Los_Angeles");
            //Utility_App::$hasTimezoneSet = true;
            //turn;
        }
        else{
            $ip = Utility_App::getUserIP();
        }

        //Priority 1: check user's settings (session) for timezone
        if(Utility_App::hasUserSession() && isset($_SESSION['timezone']) && strlen($_SESSION['timezone']) > 0){
            date_default_timezone_set($_SESSION['timezone']);
            echo "Used user session to set default timezone.";
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
            }
            else
                $fail = true;
        }
        //Priority 3: Use selected city's timezone, if available
        //TODO: Once the database is up and running, get this implemented. Uncomment the setting of {$fail = false} so the final if statement won't get tripped when this succeeds.
        if($fail){
            //$fail = false;
            //echo "Used the timezone of the selected city.";
        }
        //Priority Default: No other timezone data is available. We'll default to using Buenos Aires.
        if($fail){
            date_default_timezone_set("America/Buenos_Aires");
            echo "Used system default of Buenos Aires for the timezone settings.";
        }

        Utility_App::$hasTimezoneSet = true;
    }



    /**
     * @param $page     String      The page to be linked to
     *
     * @param $q        String      Query string arguments to be appended to the URL
     *
     * @return string               URL or empty string
     */
    public static function getURL($page = null, $q = null){
        if(strtoupper($page) == "URL_CURRENT"){
            return $_SERVER["PHP_SELF"];
        }
        $url = constant("Utility_Constants::" . strtoupper($page));
        if($q)
            $url .= "?$q";
        return $url;
    }



    public static function setUserSession($user){
        if(!($user instanceof Person_User))
            throw new Exception("Error setting user in " . __CLASS__ . "::setUser - the passed object must be of type Person_User");
        $obj = $user->to_object();
        $_SESSION['user'] = $obj;
        String_String::setLanguage($user->getLanguage());
    }



    public static function hasUserSession(){
        return isset($_SESSION);
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
     * Print the site nav and return as HTML string
     *
     * @return string HTML String representing the site nav
     */
    private function nav(){
        /*$home = $this->getURL("main");
        $images = $this->getURL("images");

        $data = "<div class='nav'>
                    <div id='siteNav'>";
        //Currently we have no links in the header. Commented out for future use
                        <ul>";
        foreach ($this->config['nav']['links'] as $key => $value){
            $target = preg_split("/=/", $value);
            $check = isset($target[1]) ? $target[1] : "home";
            $class = $check == strtolower($this->currentPage) ? " class='currentPage'" : '';
            $data .= "<li $class ><a href='$value'>$key</a></li>";
        }
        $data .= "</ul>";
        $data .= "<a href='$home'><img src='" . $images . "logo.png' alt='Tanguer'/></a>";

        //Close nav
        $data .= "</div>";

        return $data;*/
    } //End nav()
}