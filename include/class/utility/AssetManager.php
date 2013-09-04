<?php
/**
 * Author: Ghost
 * Date: 9/1/13
 */
 
class Utility_AssetManager {
    private final function __construct(){}
    private final function __clone(){}

    /**
     * @param $id           Integer     Required   The ID of the event whose banner is being requested
     * @return string
     */
    public static function getEventBanner($id){
        return Utility_Constants::URL_MAIN . Utility_Constants::DIR_EVENT_BANNER . $id . ".jpg";
    }
}