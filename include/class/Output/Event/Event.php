<?php
/**
 * Author: Ghost
 * Date: 7/10/13
 */
 
abstract class Output_Event_Event implements Interface_OutputBase, Interface_OutputEvent {
    private $data;


    public function __construct(Event_Lesson $data){
        $this->data = $data;
    }

    /**
     * Format the a JSON representation of this object, typically for AJAX calls
     * @return string
     */
    public function to_JSON(){
        return json_encode($this->data->to_object());
    }



    /**
     * Format the full version of the object to HTML
     * @param $class    String      The class of the outer-most HTML container element
     * @return string
     */
    public function to_html_full($class){
        $html = <<<HTML
            <div class='e-disp-f $class'>
                Hello World
            </div>
HTML;

        return $html;
    }



    /**
     * Format the thumbnail version of the object to HTML
     * @param $class    String      The class of the outer-most HTML container element
     * @return string
     */
    public function to_html_thumb($class){
        $html = <<<HTML
            <div class='e-disp-th $class'>
                Hello World
            </div>
HTML;

        return $html;
    }



    /**
     * Format the calendar-full version of the object to HTML
     * @param $class    String      The class of the outer-most HTML container element
     * @return string
     */
    public function to_html_calendar($class){
        $html = <<<HTML
            <div class='event-display $class'>
                Hello World, this is a $class event.
            </div>
HTML;

        return $html;
    }
}
