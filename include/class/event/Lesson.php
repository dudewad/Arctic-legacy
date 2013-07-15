<?php
/**
 * Author: Ghost
 * Date: 6/19/13
 */
 
class Event_Lesson extends Event_EventInstructed{
    //Event type
    const E_TYPE = "Lesson";
    //Level of difficulty
    private $difficulty;
    //Topic of the lesson
    private $topic;



    /**
     * @param Array         $data
     * @param Location      $location
     * @param Array         $instructors
     * @throws Exception
     */
    public function __construct($data, $location, $instructors){
        parent::__construct($data, $location, $instructors);
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
     * @return Array
     */
    public function getTopic(){
        return $this->topic;
    }



    /**
     * Returns an array of the primary actors for this event
     * @return mixed
     */
    public function getPrimaryActors(){
        $arr = array();
        if($instructors = $this->getInstructors())
            $arr = $instructors;
        return $arr;
    }



    /**
     * @param String        $difficulty
     * @throws Exception
     */
    public function setDifficulty($difficulty){
        if(!is_string($difficulty))
            throw new Exception("Invalid value passed to " . __FUNCTION__ . ". The passed value must be a string, and a " . gettype($difficulty) . " was passed.");
        $this->difficulty = $difficulty;
    }



    /**
     * @param String        $topic
     * @throws Exception
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
