<?php
/**
 * Author: Ghost
 * Date: 7/4/13
 */
require_once("Person.php");

class User extends Person{
    private $user_id;
    private $email;



    public function __construct($data){
        parent::__construct($data);
        $this->setEmail($data['email']);
        $this->setUserID($data['user_id']);
    }



    /**
     * @return String
     */
    public function getEmail(){
        return $this->email;
    }



    /**
     * @return Integer
     */
    public function getID(){
        return $this->user_id;
    }



    /**
     * @param   String      $email
     * @throws  Exception
     */
    public function setEmail($email){
        if(!is_string($email))
            throw new Exception("Invalid value passed to " . __FUNCTION__ . ". The passed value must be a string, and a " . gettype($email) . " was passed.");
        $this->email = $email;
    }



    /**
     * @param   Integer     $user_id
     * @throws  Exception
     */
    public function setUserID($user_id){
        if(!is_int($user_id))
            throw new Exception("Invalid value passed to " . __FUNCTION__ . ". The passed value must be an integer, and a " . gettype($user_id) . " was passed.");
        $this->user_id = $user_id;
    }
}