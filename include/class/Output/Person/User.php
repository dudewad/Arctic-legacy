<?php
/**
 * Author: Ghost
 * Date: 7/10/13
 */
 
class Output_Person_User extends Output_Person_Person{
    private $data;

    public function __construct(Person_Person $data){
        $this->data = $data;
    }



    /**
     * Format the full version of the object to HTML
     * @param $class    String      The class of the outer-most HTML container element
     * @return string
     */
    public function to_html_full($class = "user-disp"){
        return parent::to_html_full($class);
    }



    /**
     * Format the thumbnail version of the object to HTML
     * @param $class    String      The class of the outer-most HTML container element
     * @return string
     */
    public function to_html_thumb($class = "user-disp"){
        return parent::to_html_thumb($class);
    }
}
