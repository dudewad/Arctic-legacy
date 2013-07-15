<?php
/**
 * Author: Ghost
 * Date: 7/9/13
 */
 
class Output_Event_Lesson extends Output_Event_Event{
    protected $data;


    public function __construct(Event_Lesson $data){
        $this->data = $data;
    }



    /**
     * Format the full version of the object to HTML
     * @param $class    String      The class of the outer-most HTML container element
     * @return string
     */
    public function to_html_full($class = "lesson"){
        return parent::to_html_full($class);
    }



    /**
     * Format the thumbnail version of the object to HTML
     * @param $class    String      The class of the outer-most HTML container element
     * @return string
     */
    public function to_html_thumb($class = "lesson"){
        return parent::to_html_thumb($class);
    }



    /**
     * Format the calendar-full version of the object to HTML
     * @param $class    String      The class of the outer-most HTML container element
     * @return string
     */
    public function to_html_calendar($class = "lesson"){
        return parent::to_html_calendar($class);
    }



    /**
     * Returns a string representation of the primary actors for this event, including a prefix of actor type
     * @param   $max        Integer         The maximum number of actors to return in the string
     * @return  String
     */
    protected function getPrimaryActorsAsString($max = 2){
        $e = $this->data;
        $actorList = $e->getPrimaryActors();
        //Start with an empty string
        $actors = "";
        //Base-0, so max needs to be smaller
        $max--;
        for($i = 0; $i < count($actorList); $i++){
            if($i > $max){
                $actors .= " (...)";
                break;
            }
            if(strlen($actors)) $actors .= ", ";
            $a = $actorList[$i];
            if($a instanceof Person_Person){
                $actors .= $a->getFullName();
            }
        }
        $actorName = String_String::getString("ACTOR_NAME_TEACHER");
        return "<strong>$actorName:</strong><br />" . $actors;
    }
}