<?php
/**
 * Author: Ghost
 * Date: 7/8/13
 */
 
class Output_Event_Milonga extends Output_Event_Event{
    protected $data;


    public function __construct(Event_Milonga $data){
        parent::__construct($data);
    }



    /**
     * Format the full version of the object to HTML
     * @param $class    String      The class of the outer-most HTML container element
     * @return string
     */
    public function to_html_full($class = "milonga"){
        return parent::to_html_full($class);
    }



    /**
     * Format the thumbnail version of the object to HTML
     * @param $url      String      The URL this thumb references
     * @param $class    String      The class of the outer-most HTML container element
     * @return string
     */
    public function to_html_thumb($url, $class = null){
        $class = isset($class) ? $class . " milonga" : "milonga";
        return parent::to_html_thumb($url, $class);
    }



    /**
     * Format the calendar-full version of the object to HTML
     * @param $class    String      The class of the outer-most HTML container element
     * @return string
     */
    public function to_html_calendar($class = "milonga"){
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

        $actorName = String_String::getString("ACTOR_NAME_DJ",$this->getTopAncestorClassName());
        return "<strong>$actorName:</strong><br />" . $actors;
    }
}