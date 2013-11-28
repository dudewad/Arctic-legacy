<?php
/**
 * Author: Ghost
 * Date: 11/27/13
 */

class Output_Alert_Alert implements Interface_OutputBase{
    private $data = null;



    /**
     * @param Alert_Alert $alert    REQUIRED
     */
    public function __construct(Alert_Alert $alert){
        $this->data = $alert;
    }



    /**
     * @return string|void
     */
    public function to_JSON(){
        //Requires implementation... will do once it is needed.
    }



    /**
     * Format the full version of the object to HTML
     * @param string $class     OPTIONAL    The CSS class of the object when printed
     * @return string|void
     */
    public function to_html_full($class = ""){
        $message = $this->data->getMessage();
        $html = <<<HTML
                <div class="alert $class">
                    <span class="icon"></span>$message <a class="dismiss" href="">Dismiss</a>
                </div>
HTML;
        return $html;
    }



    /**
     * There is no thumbnail version presently- use this as an alias for to_html_full
     * @param string $class
     * @return string|void
     */
    public function to_html_thumb($class = ""){
        return $this->to_html_full($class);
    }
}
