<?php
/**
 * Author: Ghost
 * Date: 6/19/13
 */
require_once("Event.php");
 
class Lesson extends Event{
    //Array of instructor IDs
    private $instructors;
    //Level of difficulty
    private $difficulty;
    //Topic of the lesson
    private $topic;

    public function __construct($lessonData, $location = null){
        parent::__construct($lessonData, $location);
        foreach($lessonData as $key => $val){
            if(property_exists($this, $key)){
                //Instructors must be an array
                if($key == "instructors" && !is_array($key)){
                    throw(new Exception("instructors must be an array."));
                    continue;
                }
                $this->$key = $val;
            }
        }
    }
}
