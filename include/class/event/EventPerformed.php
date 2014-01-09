<?php
/**
 * Author: Ghost
 * Date: 7/4/13
 */

abstract class Event_EventPerformed extends Event_Event{
    //Array of instructors (as Person_Person objects)
    private $performers;


    /**
     * @param stdClass                  $data
     * @param Location_Location|null    $location
     * @param Array|null                $performers
     */
    public function __construct($data, $location, $performers = null){
        parent::__construct($data, $location);
        $this->setPerformers($performers);
    }

    /**
     * @return Array
     */
    public function getPerformers(){
        return $this->performers;
    }



    /**
     * @param   Array|null       $performers
     * @throws  Exception
     */
    public function setPerformers($performers){
        if(count($performers) < 1){
            $this->performers = null;
            return;
        }

        //Verify that all objects in the array are People objects
        for($i = 0; $i < count($performers); $i++){
            if(!($performers[$i] instanceof Person_Person))
                throw new Exception("Invalid object passed at array index " . $i . " in " . __FUNCTION__ . ". All objects in the performers array must be of type Person_Person, and an item with type " . gettype($performers[$i]) . " was passed.");
        }

        $this->performers = $performers;
    }



    /**
     * Convert to an object for functions like to_JSON() to quickly iterate, etc.
     * @return stdClass
     */
    public function to_object(){
        $obj = parent::to_object();

        $performers = $this->getPerformers();
        $performerObjects = array();
        if($performers && is_array($performers) && count($performers > 0)){
            foreach($performers as $performer){
                if($performer instanceOf Person_Person)
                    array_push($performerObjects, $performer->to_object());
            }
        }
        $obj->performers = $performerObjects;

        return $obj;
    }
}
