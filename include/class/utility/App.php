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
                    <script src='js/module/Tanguer_Tooltip.js' type='text/javascript' ></script>
                    <script src='js/module/Tanguer_Calendar.js' type='text/javascript' ></script>
                    <script type='text/javascript' src='POC/js/test.js'></script>


                    <link href='css/style.css' media='all' rel='stylesheet' type='text/css' />
                    <link href='css/tooltip.css' rel='stylesheet' type='text/css' />
                    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
                    <link rel='stylesheet' type='text/css' href='POC/css/test-min.css' />
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



    public function setUserSession($user){
        if(!($user instanceof Person_User))
            throw new Exception("Error setting user in " . __CLASS__ . "::setUser - the passed object must be of type Person_User");
        $obj = $user->to_object();
        $_SESSION['user'] = $obj;
        String_String::setLanguage($user->getLanguage());
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