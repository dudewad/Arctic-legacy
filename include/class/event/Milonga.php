<?php
/**
 * Author: Ghost
 * Date: 6/19/13
 */
require_once("Event_DJd.php");
 
class Milonga extends Event_DJd{
    //Minimum age required
    private $min_age;



    /**
     * @param Array         $data
     * @param Location      $location
     * @param Array|null    $djs
     */
    public function __construct($data, $location, $djs = null){
        parent::__construct($data, $location, $djs);
        $this->setMinAge($data['min_age']);
    }



    /**
     * @return Integer
     */
    public function getMinAge(){
        return $this->min_age;
    }



    /**
     * @param   Integer     $min_age
     * @throws  Exception
     */
    public function setMinAge($min_age){
        if(!is_int($min_age))
            throw new Exception("Invalid value passed to " . __FUNCTION__ . ". The passed value must be an integer, and a " . gettype($min_age) . " was passed.");

        $this->min_age = $min_age;
    }
}
