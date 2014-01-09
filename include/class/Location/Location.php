<?php
/**
 * Author: Ghost
 * Date: 6/19/13
 */

final class Location_Location implements Interface_Displayable{
    private $name;
    private $address;
    private $city;
    private $state;
    private $zip;
    private $country;



    /**
     * @param $address  stdClass     An associative array containing all location data
     */
    public function __construct($address){
        $this->setName($address->name);
        $this->setAddress($address->address);
        $this->setCity($address->city);
        $this->setState($address->state);
        $this->setZip($address->zip);
        $this->setCountry($address->country);
    }



    /**
     * @return String
     */
    public function getAddress(){
        return $this->address;
    }



    /**
     * @return String
     */
    public function getCity(){
        return $this->city;
    }



    /**
     * @return String
     */
    public function getName(){
        return $this->name;
    }



    /**
     * @return String
     */
    public function getState(){
        return $this->state;
    }



    /**
     * @return String
     */
    public function getCountry(){
        return $this->country;
    }



    /**
     * @return String
     */
    public function getZip(){
        return $this->zip;
    }



    /**
     * @param   String      $address
     * @throws  Exception
     */
    public function setAddress($address){
        if(!is_string($address))
            throw new Exception("Invalid value passed to " . __FUNCTION__ . ". The passed value must be a string, and a " . gettype($address) . " was passed.");
        $this->address = $address;
    }



    /**
     * @param   String      $city
     * @throws  Exception
     */
    public function setCity($city){
        if(!is_string($city))
            throw new Exception("Invalid value passed to " . __FUNCTION__ . ". The passed value must be a string, and a " . gettype($city) . " was passed.");
        $this->city = $city;
    }



    /**
     * @param   String      $country
     * @throws  Exception
     */
    public function setCountry($country){
        if(!is_string($country))
            throw new Exception("Invalid value passed to " . __FUNCTION__ . ". The passed value must be a string, and a " . gettype($country) . " was passed.");
        $this->country = $country;
    }



    /**
     * @param   String      $name
     * @throws  Exception
     */
    public function setName($name){
        if(!is_string($name))
            throw new Exception("Invalid value passed to " . __FUNCTION__ . ". The passed value must be a string, and a " . gettype($name) . " was passed.");
        $this->name = $name;
    }



    /**
     * @param   String      $state
     * @throws  Exception
     */
    public function setState($state){
        if(!is_string($state))
            throw new Exception("Invalid value passed to " . __FUNCTION__ . ". The passed value must be a string, and a " . gettype($state) . " was passed.");
        $this->state = $state;
    }



    /**
     * @param   String       $zip
     * @throws  Exception
     */
    public function setZip($zip){
        if(!is_string($zip))
            throw new Exception("Invalid value passed to " . __FUNCTION__ . ". The passed value must be a string, and a " . gettype($zip) . " was passed.");
        $this->zip = $zip;
    }



    /**
     * Convert to an object for functions like to_JSON() to quickly iterate, etc.
     * @return stdClass
     */
    public function to_object(){
        $obj = new stdClass();
        $obj->address = $this->getAddress();
        $obj->city = $this->getCity();
        $obj->name = $this->getName();
        $obj->state = $this->getState();
        $obj->country = $this->getCountry();
        $obj->zip = $this->getZip();
        return $obj;
    }



    public function to_JSON(){

    }
}