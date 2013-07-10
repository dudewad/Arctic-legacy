<?php
/**
 * Author: Ghost
 * Date: 7/9/13
 */
class Output_Person_Person implements Interface_OutputBase{
    private $data;

    public function __construct(Person_Person $data){
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
            <div class='person-disp $class'>
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
            <div class='person-disp $class'>
                Hello World
            </div>
HTML;

        return $html;
    }
}
