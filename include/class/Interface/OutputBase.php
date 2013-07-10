<?php
/**
 * Author: Ghost
 * Date: 7/8/13
 */
 
interface Interface_OutputBase {

    /**
     * Format the a JSON representation of this object, typically for AJAX calls
     * @return string
     */
    public function to_JSON();



    /**
     * Format the full version of the object to HTML
     * @param $class    String      The class of the outer-most HTML container element
     * @return string
     */
    public function to_html_full($class);



    /**
     * Format the thumbnail version of the object to HTML
     * @param $class    String      The class of the outer-most HTML container element
     * @return string
     */
    public function to_html_thumb($class);
}
