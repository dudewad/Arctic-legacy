<?php
/**
 * Author: Ghost
 * Date: 6/19/13
 */
require_once("Event.php");
 
class Milonga extends Event {
    //The ID of the DJ user
    private $djID;
    //Minimum age required
    private $min_age;

    public function __construct($milongaData, $location = null){
        parent::__construct($milongaData, $location);
        foreach($milongaData as $key => $val){
            if(property_exists($this, $key)){
                $this->$key = $val;
            }
        }
    }
}
