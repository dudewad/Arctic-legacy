<?php
/**
 * Author: Ghost
 * Date: 6/19/13
 */
 
abstract class Event {
    //Event cost
    protected $cost;
    //Event's ID
    protected $id;
    //Whether the organizing user has confirmed this event will happen
    protected $isConfirmed;
    //Must be a location object
    protected $location;
    //Event's display name
    protected $name;
    //UserID of the organizing user
    protected $organizerID;
    //Event's parent ID, if applicable
    protected $parentID;
    //Event end time
    protected $timeEnd;
    //Event start time
    protected $timeStart;

    /**
     * @param $eventData  Assoc Array     An associative array containing all event data except location
     *
     * @param $location   Location        A location object containing all data for this event
     */
    public function __construct($eventData, $location = null){
        foreach($eventData as $key => $val){
            if(property_exists($this, $key)){
                $this->$key = $val;
            }
        }

        if(isset($location))
            $this->location = $location;
    }

    /**
     * @return mixed
     */
    public function getCost(){
        return $this->cost;
    }

    /**
     * @return mixed
     */
    public function getId(){
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getIsConfirmed(){
        return $this->isConfirmed;
    }

    /**
     * @return \Location|null
     */
    public function getLocation(){
        return $this->location;
    }

    /**
     * @return mixed
     */
    public function getName(){
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getOrganizerID(){
        return $this->organizerID;
    }

    /**
     * @return mixed
     */
    public function getParentID(){
        return $this->parentID;
    }

    /**
     * @return mixed
     */
    public function getTimeEnd(){
        return $this->timeEnd;
    }

    /**
     * @return mixed
     */
    public function getTimeStart(){
        return $this->timeStart;
    }
}
