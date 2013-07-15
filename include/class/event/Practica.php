<?php
/**
 * Author: Ghost
 * Date: 7/4/13
 */

class Event_Practica extends Event_EventInstructedDJd {
    //Event type
    const E_TYPE = "Practica";
    //Level of difficulty
    private $difficulty;
    //Topic of the event
    private $topic;



    /**
     * @param Array     $data
     * @param Location  $location
     * @param Array     $instructors
     * @param Array     $djs
     */
    public function __construct($data, $location, $instructors = null, $djs = null){
        parent::__construct($data, $location, $instructors, $djs);
        if(isset($data['difficulty']))
            $this->setDifficulty($data['difficulty']);
        if(isset($data['topic']))
            $this->setTopic($data['topic']);
    }



    /**
     * @return String
     */
    public function getDifficulty(){
        return $this->difficulty;
    }



    /**
     * @return String
     */
    public function getTopic(){
        return $this->topic;
    }



    /**
     * @return Array
     */
    public function getPrimaryActors(){
        $arr = array();
        if($instructors = $this->getInstructors())
            $arr = $instructors;
        else if($djs = $this->getDJs())
            $arr = $djs;
        return $arr;
    }



    /**
     * @param   String     $difficulty
     * @throws  Exception
     */
    public function setDifficulty($difficulty){
        if(!is_string($difficulty))
            throw new Exception("Invalid value passed to " . __FUNCTION__ . ". The passed value must be a string, and a " . gettype($difficulty) . " was passed.");
        $this->difficulty = $difficulty;
    }



    /**
     * @param   mixed       $topic
     * @throws  Exception
     */
    public function setTopic($topic){
        if(!is_string($topic))
            throw new Exception("Invalid value passed to " . __FUNCTION__ . ". The passed value must be a string, and a " . gettype($topic) . " was passed.");
        $this->topic = $topic;
    }



    /**
     * Convert to an object for functions like to_JSON() to quickly iterate, etc.
     * @return stdClass
     */
    public function to_object(){
        $obj = parent::to_object();
        $obj->difficulty = $this->getDifficulty();
        $obj->topic = $this->getTopic();
        return $obj;
    }
}