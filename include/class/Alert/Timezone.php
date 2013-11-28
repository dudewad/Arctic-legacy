<?php
/**
 * Author: Ghost
 * Date: 11/27/13
 */
 
class Alert_Timezone extends Alert_Alert {
    public function __construct($message){
        $data = new stdClass();
        $data->code = 101;
        $data->message = $message;
        parent::__construct($data);
    }
}
