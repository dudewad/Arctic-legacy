<?php
/**
 * Created by Ghost.
 * Date: 6/14/13
 * Time: 8:45 PM
 */
//Some test comment
class App{
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
        $view = $this->config['path']['view'];
        //Include the current page file or revert to index
        $page = $baseDir . $view . $this->currentPage . ".php";
        if(file_exists($page))
            require_once($page);
        else
            require_once($baseDir . $view . "home.php");

        $this->currentPageContent = isset($pageContent) ? $pageContent : null;
        $this->tooltips = isset($tooltips) ? $tooltips : null;
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
        $data =  '<footer id="footer-primary">
                    <div class="cs row">
                        <div class="column third">
                            <h3>
                                <a class="logo" href="<?php $home ;?>"></a>
                            </h3>
                        </div><!-- /column -->
                        <div class="column two-thirds last center">
                        <small>
                        </small>
                        <ul class="inline">
                        </ul>
                        </div><!-- /column -->
                    </div><!-- /row -->
                </footer>';

        return $data;
    } //End footer()



    /**
     * @return string HTML string representing the site <head>
     */
    public function head(){
        $jsEnvVars = "var Tanguer_JSEnvVars = {};";
        foreach($this->config['jsEnvVars'] as $key => $val){
            $jsEnvVars .= "Tanguer_JSEnvVars." . $key . " = '" . $val . "';";
        }

        //Set the meta description
        switch($this->currentPage){
            default:
                $metaDesc = "";
                break;
        }

        $data = "<head>
                    <meta charset='utf-8' />
                    <meta http-equiv='X-UA-Compatible' content='IE=edge' />
                    <meta name='description' content='" . $metaDesc . "'/>
                    <script type='text/javascript'>
                        " . $jsEnvVars . "
                    </script>
                    <script src='js/jquery-1.10.1.min.js' type='text/javascript' ></script>
                    <script src='js/jquery.validate.min.js' type='text/javascript' ></script>
                    <script src='js/TANGUER_APP.js' type='text/javascript' ></script>
                    <script src='js/extensions/Tanguer_IOC.js' type='text/javascript' ></script>
                    <script src='js/extensions/Tanguer_JSONCall.js' type='text/javascript' ></script>
                    <script src='js/components/Tanguer_Tooltip.js' type='text/javascript' ></script>
                    <link href='css/style.css' media='all' rel='stylesheet' type='text/css' />
                    <link href='css/tooltip.css' rel='stylesheet' type='text/css' />
                    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
                    <link href='css/font-awesome.min.css' rel='stylesheet' type='text/css' />
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
     * @param $name String      Gets the URL form the config['url']['xxxx'] array if available.
     *                          Otherwise returns an empty string
     *
     * @return string           URL or empty string
     */
    public function getURL($name){
        return isset($this->config['url'][$name]) ? $this->config['url'][$name] : "";
    }



    /**
     * Print the site nav and return as HTML string
     *
     * @return string HTML String representing the site nav
     */
    private function nav(){
        $home = $this->getURL("main");
        $images = $this->getURL("images");

        $data = "<div class='nav'>
                    <div id='siteNav'>";
        //Currently we have no links in the header. Commented out for future use
                        /*<ul>";
        foreach ($this->config['nav']['links'] as $key => $value){
            $target = preg_split("/=/", $value);
            $check = isset($target[1]) ? $target[1] : "home";
            $class = $check == strtolower($this->currentPage) ? " class='currentPage'" : '';
            $data .= "<li $class ><a href='$value'>$key</a></li>";
        }
        $data .= "</ul>";*/
        $data .= "<a href='$home'><img src='" . $images . "logo.png' alt='Tanguer'/></a>";

        //Close nav
        $data .= "</div>";

        return $data;
    } //End nav()
}

?>