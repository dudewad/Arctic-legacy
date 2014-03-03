<?php
/**
 * Author: Ghost
 * Date: 2/22/14
 */
 
abstract class View_View {
    private $buffer;


    /**
     * Constructor should be extended
     */
    public function __construct(){}



    /**
     * Returns the view
     * @return String       The view formatted into an HTML string
     */
    public final function getBuffer(){
        $interruptions =  TanguerApp::loadInterruptions();
        return <<<HTML
                <div class="content">
                    $interruptions
                    $this->buffer
                </div>
HTML;
    }



    /**
     * When a view is constructed, it needs to finish by calling this method ($this->setBuffer) which stores the view
     * markup to be later output to the DOM.
     *
     * @param $data
     */
    protected final function setBuffer($data){
        $this->buffer = $data;
    }
}