<?php
/**
 * Author: Layton Miller
 * Contact: layton@newcarcity.com
 * Date: 5/22/13
 */

IOC::register("App", function(){
    global $config;
    $app = new App($config, "/../../");
    return $app;
});