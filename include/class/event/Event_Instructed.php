<?php
/**
 * Author: Ghost
 * Date: 7/4/13
 */
require_once("Event.php");

abstract class Event_Instructed extends Event{
    //Array of instructors (as Person objects)
    private $instructors;


    /**
     * @param Array             $data
     * @param Location|null     $location
     * @param Array|null        $instructors
     */
    public function __construct($data, $location, $instructors = null){
        parent::__construct($data, $location);

        if(isset($instructors))
            $this->setInstructors($instructors);
    }

    /**
     * @return Array
     */
    public function getInstructors(){
        return $this->instructors;
    }



    /**
     * @param  Array        $instructors
     * @throws Exception
     */
    public function setInstructors(array $instructors){
        //Verify that all objects in the array are People objects
        for($i = 0; $i < count($instructors); $i++){
            if(!($instructors[$i] instanceof Person))
                throw new Exception("Invalid object passed at array index " . $i . " in " . __FUNCTION__ . ". All objects in the instructors array must be of type Person, and an item with type " . gettype($instructors[$i]) . " was passed.");
        }
        $this->instructors = $instructors;
    }
}
