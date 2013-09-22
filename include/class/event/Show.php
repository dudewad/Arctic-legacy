<?php
/**
 * Author: Ghost
 * Date: 7/4/13
 */

class Event_Show extends Event_EventPerformed{
    //Event type
    const E_TYPE = "Show";



    /**
     * @param Array         $data
     * @param Location_Location      $location
     * @param Array         $performers
     */
    public function __construct($data, $location, $performers){
        parent::__construct($data, $location, $performers);
    }



    /**
     * @return Array
     */
    public function getPrimaryActors(){
        $arr = array();
        if($performers = $this->getPerformers())
            $arr = $performers;
        return $arr;
    }



    /**
     * Convert to an object for functions like to_JSON() to quickly iterate, etc.
     * @return stdClass
     */
    public function to_object(){
        $obj = parent::to_object();
        return $obj;
    }
}