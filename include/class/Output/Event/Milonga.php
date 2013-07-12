<?php
/**
 * Author: Ghost
 * Date: 7/8/13
 */
 
class Output_Event_Milonga extends Output_Event_Event{
    const E_TYPE = "Milonga";
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
     * @param $class    String      The class of the outer-most HTML container element
     * @return string
     */
    public function to_html_thumb($class = "milonga"){
        return parent::to_html_thumb($class);
    }



    /**
     * Format the calendar-full version of the object to HTML
     * @param $class    String      The class of the outer-most HTML container element
     * @return string
     */
    public function to_html_calendar($class = "milonga"){
        return parent::to_html_calendar($class);
    }
}