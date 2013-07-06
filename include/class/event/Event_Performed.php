<?php
/**
 * Author: Ghost
 * Date: 7/4/13
 */
require_once("Event.php");

abstract class Event_Performed extends Event{
    //Array of instructors (as Person objects)
    private $performers;


    /**
     * @param Array             $data
     * @param Location|null     $location
     * @param Array|null        $performers
     */
    public function __construct($data, $location, $performers = null){
        parent::__construct($data, $location);

        if(isset($performers))
            $this->setPerformers($performers);
    }

    /**
     * @return Array
     */
    public function getPerformers(){
        return $this->performers;
    }



    /**
     * @param  Array        $instructors
     * @throws Exception
     */
    public function setPerformers(array $instructors){
        //Verify that all objects in the array are People objects
        for($i = 0; $i < count($instructors); $i++){
            if(!($instructors[$i] instanceof Person))
                throw new Exception("Invalid object passed at array index " . $i . " in " . __FUNCTION__ . ". All objects in the performers array must be of type Person, and an item with type " . gettype($instructors[$i]) . " was passed.");
        }
        $this->performers = $instructors;
    }
}
