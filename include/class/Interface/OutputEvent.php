<?php
/**
 * Author: Ghost
 * Date: 7/9/13
 */
 
interface Interface_OutputEvent {

    /**
     * Format the calendar-full version of the object to HTML
     * @param $class    String      The class of the outer-most HTML container element
     * @return string
     */
    public function to_html_quick_view($class);
}
