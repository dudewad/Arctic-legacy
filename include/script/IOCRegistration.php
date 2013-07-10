<?php
/**
 * Author: Layton Miller
 * Contact: layton@newcarcity.com
 * Date: 5/22/13
 */

Utility_IOC::register("Utility_App", function(){
    global $config;
    $app = new Utility_App($config, "/../../../");
    return $app;
});