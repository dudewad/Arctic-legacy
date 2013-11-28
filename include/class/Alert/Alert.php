<?php
/**
 * Author: Ghost
 * Date: 11/27/13
 */
abstract class Alert_Alert implements Interface_Displayable{
    private $message = "";
    private $alertCode = null;


    public function __construct(stdClass $data){
        $this->message = $data->message;
        $this->code = $data->code;
    }

    public function getMessage(){
        return $this->message;
    }

    public function getAlertCode(){
        return $this->code;
    }

    public function to_object(){}
}