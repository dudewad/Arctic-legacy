<?php
/**
 * Author: Ghost
 * Date: 7/4/13
 */
require_once("Event.php");

class Event_Instructed_DJd extends Event{
    //Array of instructors (as Person objects)
    private $instructors;
    //Array of djs (as Person objects)
    private $djs;



    public function __construct($data, $location, $instructors, $djs){
        parent::__construct($data, $location);

        if(isset($instructors))
            $this->setInstructors($instructors);

        if(isset($djs))
            $this->setDJs($djs);
    }



    /**
     * @return Array
     */
    public function getDJs(){
        return $this->djs;
    }



    /**
     * @return Array
     */
    public function getInstructors(){
        return $this->instructors;
    }



    /**
     * @param   Array       $djs
     * @throws  Exception
     */
    public function setDJs(array $djs){
        //Require that there at least 1 dj to set this
        if(count($djs) < 1)
            throw Exception("Invalid array passed to method " . __FUNCTION__ . ". The passed array must contain at least one Person object.");

        //Verify that all objects in the array are People objects
        for($i = 0; $i < count($djs); $i++){
            if(!($djs[$i] instanceof Person))
                throw new Exception("Invalid object passed at array index " . $i . " in " . __FUNCTION__ . ". All objects in the djs array must be of type Person, and an item with type " . gettype($djs[$i]) . " was passed.");
        }

        $this->djs = $djs;
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
