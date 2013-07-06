<?php
/**
 * Author: Ghost
 * Date: 7/4/13
 */
require_once("Event_Performed.php");

class Show extends Event_Performed{
    /**
     * @param Array         $data
     * @param Location      $location
     * @param Array         $performers
     */
    public function __construct($data, $location, $performers){
        parent::__construct($data, $location, $performers);
    }
}