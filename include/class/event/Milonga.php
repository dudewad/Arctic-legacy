<?php
/**
 * Author: Ghost
 * Date: 6/19/13
 */
 
class Event_Milonga extends Event_EventDJd{
    //Event type
    const E_TYPE = "Milonga";
    //Minimum age required
    private $min_age;



    /**
     * @param stdClass              $data
     * @param Location_Location     $location
     * @param Array|null            $djs
     */
    public function __construct($data, $location, $djs = null){
        parent::__construct($data, $location, $djs);
        $this->setMinAge($data->min_age);
    }



    /**
     * @return Integer
     */
    public function getMinAge(){
        return $this->min_age;
    }



    /**
     * @return Array
     */
    public function getPrimaryActors(){
        $arr = array();
        if($djs = $this->getDJs())
            $arr = $djs;
        return $arr;
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



    /**
     * Convert to an object for functions like to_JSON() to quickly iterate, etc.
     * @return stdClass
     */
    public function to_object(){
        $obj = parent::to_object();
        $obj->min_age = $this->getMinAge();
        return $obj;
    }
}
