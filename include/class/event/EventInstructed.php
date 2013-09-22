<?php
/**
 * Author: Ghost
 * Date: 7/4/13
 */

abstract class Event_EventInstructed extends Event_Event{
    //Array of instructors (as Person_Person objects)
    private $instructors;


    /**
     * @param Array             $data
     * @param Location_Location|null     $location
     * @param Array|null        $instructors
     */
    public function __construct($data, $location, $instructors = null){
        parent::__construct($data, $location);
        $this->setInstructors($instructors);
    }

    /**
     * @return Array
     */
    public function getInstructors(){
        return $this->instructors;
    }



    /**
     * @param  Array|null        $instructors
     * @throws Exception
     */
    public function setInstructors($instructors){
        if(!is_array($instructors)){
            $this->instructors = null;
            return;
        }
        //Verify that all objects in the array are People objects
        for($i = 0; $i < count($instructors); $i++){
            if(!($instructors[$i] instanceof Person_Person))
                throw new Exception("Invalid object passed at array index " . $i . " in " . __FUNCTION__ . ". All objects in the instructors array must be of type Person_Person, and an item with type " . gettype($instructors[$i]) . " was passed.");
        }
        $this->instructors = $instructors;
    }


    /**
     * Convert to an object for functions like to_JSON() to quickly iterate, etc.
     * @return stdClass
     */
    public function to_object(){
        $obj = parent::to_object();
        $instructors = $this->getInstructors();
        $instructorObjects = array();
        if($instructors && count($instructors > 0)){
            foreach($instructors as $instructor){
                if($instructor instanceOf Person_Person)
                    array_push($instructorObjects, $instructor->to_object());
            }
        }
        $obj->instructors = $instructorObjects;
        return $obj;
    }
}
