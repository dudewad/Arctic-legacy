<?php
/**
 * Author: Ghost
 * Date: 6/19/13
 */
require_once("Event_Instructed.php");
 
class Lesson extends Event_Instructed{
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
        parent::__construct($data, $location);
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
}
