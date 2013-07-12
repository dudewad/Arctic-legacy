<?php
/**
 * Author: Ghost
 * Date: 7/9/13
 */
 
class Output_Event_Show extends Output_Event_Event{
    const E_TYPE = "Show";
    protected $data;


    public function __construct(Event_Show $data){
        $this->data = $data;
    }



    /**
     * Format the full version of the object to HTML
     * @param $class    String      The class of the outer-most HTML container element
     * @return string
     */
    public function to_html_full($class = "show"){
        return parent::to_html_full($class);
    }



    /**
     * Format the thumbnail version of the object to HTML
     * @param $class    String      The class of the outer-most HTML container element
     * @return string
     */
    public function to_html_thumb($class = "show"){
        return parent::to_html_thumb($class);
    }



    /**
     * Format the calendar-full version of the object to HTML
     * @param $class    String      The class of the outer-most HTML container element
     * @return string
     */
    public function to_html_calendar($class = "show"){
        return parent::to_html_calendar($class);
    }
}
