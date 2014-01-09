<?php
/**
 * Author: Ghost
 * Date: 7/4/13
 */

abstract class Event_EventDJd extends Event_Event{
    //Array of djs (as Person_Person objects)
    private $djs;


    /**
     * @param stdClass                  $data
     * @param Location_Location|null    $location
     * @param Array|null                $djs
     */
    public function __construct($data, $location, $djs = null){
        parent::__construct($data, $location);
        $this->setDJs($djs);
    }



    /**
     * @return Array|null
     */
    public function getDJs(){
        return $this->djs;
    }



    /**
     * @param   Array|null       $djs
     * @throws  Exception
     */
    public function setDJs($djs){
        if(count($djs) < 1){
            $this->djs = null;
            return;
        }

        //Verify that all objects in the array are People objects
        for($i = 0; $i < count($djs); $i++){
            if(!($djs[$i] instanceof Person_Person))
                throw new Exception("Invalid object passed at array index " . $i . " in " . __FUNCTION__ . ". All objects in the djs array must be of type Person_Person, and an item with type " . gettype($djs[$i]) . " was passed.");
        }

        $this->djs = $djs;
    }


    /**
     * Convert to an object for functions like to_JSON() to quickly iterate, etc.
     * @return stdClass
     */
    public function to_object(){
        $obj = parent::to_object();
        $djs = $this->getDJs();
        $djObjects = array();
        if($djs && is_array($djs) && count($djs > 0)){
            foreach($djs as $dj){
                if($dj instanceOf Person_Person)
                    array_push($djObjects, $dj->to_object());
            }
        }
        $obj->djs = $djObjects;
        return $obj;
    }
}
