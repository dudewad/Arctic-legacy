<?php
/**
 * Author: Ghost
 * Date: 7/4/13
 */
require_once("Event.php");

abstract class Event_DJd extends Event{
    //Array of djs (as Person objects)
    private $djs;


    /**
     * @param Array             $data
     * @param Location|null     $location
     * @param Array|null        $djs
     */
    public function __construct($data, $location, $djs = null){
        parent::__construct($data, $location);

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
}
