<?php
/**
 * Author: Ghost
 * Date: 7/9/13
 */
 
class Output_Event_Practica extends Output_Event_Event{
    private $data;


    public function __construct(Event_Practica $data){
        $this->data = $data;
    }



    /**
     * Format the full version of the object to HTML
     * @param $class    String      The class of the outer-most HTML container element
     * @return string
     */
    public function to_html_full($class = "practica"){
        return parent::to_html_calendar($class);
    }



    /**
     * Format the thumbnail version of the object to HTML
     * @param $class    String      The class of the outer-most HTML container element
     * @return string
     */
    public function to_html_thumb($class = "practica"){
        return parent::to_html_calendar($class);
    }



    /**
     * Format the calendar-full version of the object to HTML
     * @param $class    String      The class of the outer-most HTML container element
     * @return string
     */
    public function to_html_calendar($class = "practica"){
        return parent::to_html_calendar($class);
    }
}
