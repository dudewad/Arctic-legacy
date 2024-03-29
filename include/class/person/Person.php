<?php
/**
 * Author: Ghost
 * Date: 7/4/13
 */
 
class Person_Person implements Interface_Displayable{
    //Person_Person's ID
    protected $person_id;
    protected $first_name;
    protected $last_name;



    public function __construct($data){
        $this->setPersonID($data->person_id);
        $this->setFirstName($data->first_name);
        $this->setLastName($data->last_name);
    }



    /**
     * @return mixed
     */
    public function getPersonID(){
        return $this->person_id;
    }




    /**
     * @return String
     */
    public function getFirstName(){
        return $this->first_name;
    }



    /**
     * @return String
     */
    public function getLastName(){
        return $this->last_name;
    }


    /**
     * Get the full name of this Person object
     */
    public function getFullName(){
        return $this->first_name . " " . $this->last_name;
    }


    /**
     * @param   Integer      $person_id
     * @throws  Exception
     */
    public function setPersonID($person_id){
        if(!is_integer($person_id))
            throw new Exception("Invalid value passed to " . __FUNCTION__ . ". The passed value must be an integer, and a " . gettype($person_id) . " was passed.");
        $this->person_id = $person_id;
    }



    /**
     * @param   String      $first_name
     * @throws  Exception
     */
    public function setFirstName($first_name){
        if(!is_string($first_name))
            throw new Exception("Invalid value passed to " . __FUNCTION__ . ". The passed value must be a string, and a " . gettype($first_name) . " was passed.");
        $this->first_name = $first_name;
    }



    /**
     * @param   String      $last_name
     * @throws  Exception
     */
    public function setLastName($last_name){
        if(!is_string($last_name))
            throw new Exception("Invalid value passed to " . __FUNCTION__ . ". The passed value must be a string, and a " . gettype($last_name) . " was passed.");
        $this->last_name = $last_name;
    }



    /**
     * Convert this object to an object with accessible properties for echo to JSON, etc
     * @return stdClass
     */
    public function to_object(){
        $obj = new stdClass();
        $obj->person_id = $this->getPersonID();
        $obj->first_name = $this->getFirstName();
        $obj->last_name = $this->getLastName();
        return $obj;
    }
}
