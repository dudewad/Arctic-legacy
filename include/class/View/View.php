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
        return <<<HTML
                <div class="content">
                    $this->buffer
                </div>
HTML;
    }



    protected final function setBuffer($data){
        $this->buffer = $data;
    }
}