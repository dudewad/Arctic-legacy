<?php
/**
 * Author: Ghost
 * Date: 6/19/13
 */

final class Location {
    private $name;
    private $address;
    private $city;
    private $state;
    private $zip;

    /**
     * @param $address  Assoc Array     An associative array containing all location data
     */
    public function __construct($address){
        foreach($address as $key => $val){
            if(property_exists($this, $key)){
                $this->$key = $val;
            }
        }
    }

    /**
     * @return string
     */
    public function getAddress(){
        return $this->address;
    }

    /**
     * @return string
     */
    public function getCity(){
        return $this->city;
    }

    /**
     * @return string
     */
    public function getName(){
        return $this->name;
    }

    /**
     * @return string
     */
    public function getState(){
        return $this->state;
    }

    /**
     * @return string
     */
    public function getZip(){
        return $this->zip;
    }
}