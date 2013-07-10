<?php
/**
 * This file sets all configuration options for the application.
 */
/*##############################################################
################################################################
________________________SETTINGS/MISC_________________________*/

//Settings below (if applicable)
$config['settings']['siteTitle'] = 'Tanguer';

//Destination recipient email address for contact form
$config['settings']['contactEmail'] = "info@tanguer.com";



/*##############################################################
################################################################
_____________________Filepath Settings________________________*/

//Location of the "Page View" directory relative to the base directory for the site
$config['path']['pageView'] = "/include/view/page/";

//Location of the "Module View" directory relative to the base directory for the site
$config['path']['pageView'] = "/include/view/page/";



/*##############################################################
################################################################
________________________MySQL Settings________________________*/

//MySQL database location
$config['db']['tanguer']['host'] = "127.0.0.1";

//MySQL database name
$config['db']['tanguer']['name'] = "tanguer";

//MySQL database user for the Tanguer db
$config['db']['tanguer']['user'] = "root";

//MySQL database password (for primary Tanguer DB)
$config['db']['tanguer']['password'] = "fmeffiness";



/*##############################################################
################################################################
________________________URL Array_____________________________*/

//Site Base URL (this will be used to build URLs)
$config['url']['main'] =  'http://localhost/tanguer/';

//Images directory reference
$config['url']['images'] = $config['url']['main'] . 'asset/image/';



/*##############################################################
################################################################
___________________________NAV MENU___________________________*/
//This section contains all required info for the nav menu of the site

//This array holds the name/url pairs of all links in the nav
//$config['nav']['links'] = array('Tanguer' => $config['url']['main']);



/*##############################################################
################################################################
______________JAVASCRIPT ENVIRONMENT VARIABLES________________*/
//Any variables placed in this array will be automatically added to the
//application's Javascript App environment variables for usage by the
//runtime application

$config['jsEnvVars']['baseURL'] = $config['url']['main'];

$config['jsEnvVars']['jsonRequest'] = $config['url']['main'] . "jsonRequest.php";