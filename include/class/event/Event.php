<?php
/**
 * Author: Ghost
 * Date: 6/19/13
 */

abstract class Event_Event implements Interface_Displayable{
    //Event type
    const E_TYPE = "Event";
    //Event's ID
    protected $id;
    //Event's description
    protected $description;
    //Whether the organizing user has confirmed this event will happen
    protected $confirmed;
    //Must be a location object
    protected $location;
    //Event's display name
    protected $name;
    //UserID of the organizing user
    protected $organizer_id;
    //Event's parent ID, if applicable
    protected $parent_id;
    //Event end time
    protected $date_end;
    //Event start time
    protected $date_start;
    //Event price
    protected $price;
    //Event repeat cycle
    protected $repeat;
    //Number of people going to this event
    protected $num_attendees;



    /**
     * @param $data  Array             An associative array containing all event data except location
     *
     * @param $location   Location_Location          A location object containing all data for this event
     */
    public function __construct($data, $location = null){
        //Required items
        $this->setId($data["id"]);
        $this->setName($data["name"]);
        $this->setPrice($data["price"]);
        $this->setDateStart($data["date_start"]);
        $this->setDateEnd($data["date_end"]);
        $this->setOrganizerId($data["organizer_id"]);
        $this->setConfirmed($data["confirmed"]);
        $this->setDescription($data["description"]);
        $this->setNumAttendees($data["num_attendees"]);
        //Optional items
        if(isset($data['parent_id']))
            $this->setParentId($data["parent_id"]);
        if(isset($location))
            $this->setLocation($location);
        if(isset($data['repeat']))
            $this->setRepeat($data["repeat"]);
    }



    /**
     * @return mixed
     */
    public function getPrice(){
        return $this->price;
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
    public function getConfirmed(){
        return $this->confirmed;
    }



    /**
     * @return Location_Location|null
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
    public function getOrganizerId(){
        return $this->organizer_id;
    }



    /**
     * @return mixed
     */
    public function getParentId(){
        return $this->parent_id;
    }



    /**
     * @return mixed
     */
    public function getDateEnd(){
        return $this->date_end;
    }



    /**
     * Returns the times of the event as a string, e.g. 21:00 - 01:00
     * @return mixed
     */
    public function getTimeRange(){
        return date("H:i", $this->getDateStart()) . " - " . date("H:i", $this->getDateEnd());
    }



    /**
     * @return mixed
     */
    public function getDateStart(){
        return $this->date_start;
    }



    /**
     * @return mixed
     */
    public function getRepeat(){
        return $this->repeat;
    }



    /**
     * @return mixed
     */
    public function getDescription(){
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getNumAttendees(){
        return $this->num_attendees;
    }



    /**
     * @param mixed $id
     * @throws Exception
     */
    public function setId($id){
        if(!is_int($id))
            throw new Exception("Invalid value passed to " . __FUNCTION__ . ". The passed value must be an integer, and a " . gettype($id) . " was passed.");
        $this->id = $id;
    }



    /**
     * @param int $confirmed
     * @throws Exception
     */
    public function setConfirmed($confirmed){
        if($confirmed !== (int) 0 && $confirmed !== (int) 1)
            throw new Exception("Invalid value passed to " . __FUNCTION__ . ". The passed value must be an integer of either 0 or 1.");
        $this->confirmed = $confirmed;
    }



    /**
     * @param Location_Location $location
     */
    public function setLocation(Location_Location $location){
        $this->location = $location;
    }



    /**
     * @param String $name
     * @throws Exception
     */
    public function setName($name){
        if(!is_string($name))
            throw new Exception("Invalid value passed to " . __FUNCTION__ . ". The passed value must be a string, and a " . gettype($name) . " was passed.");
        $this->name = $name;
    }



    /**
     * @param int $organizer_id
     * @throws Exception
     */
    public function setOrganizerId($organizer_id){
        if(!is_int($organizer_id))
            throw new Exception("Invalid value passed to " . __FUNCTION__ . ". The passed value must be an integer, and a " . gettype($organizer_id) . " was passed.");
        $this->organizer_id = $organizer_id;
    }



    /**
     * @param int $parent_id
     * @throws Exception
     */
    public function setParentId($parent_id){
        if(!is_int($parent_id))
            throw new Exception("Invalid value passed to " . __FUNCTION__ . ". The passed value must be an integer, and a " . gettype($parent_id) . " was passed.");
        $this->parent_id = $parent_id;
    }



    /**
     * @param int $date_start
     * @throws Exception
     * This is a timestamp and therefore contains both date and time. We use the term "date_start" to
     * clarify that this is indeed date and not just time.
     */
    public function setDateStart($date_start){
        if(!is_int($date_start))
            throw new Exception("Invalid value passed to " . __FUNCTION__ . ". The passed value must be an integer, and a " . gettype($date_start) . " was passed.");
        $this->date_start = $date_start;
    }



    /**
     * @param int $date_end
     * @throws Exception
     * This is a timestamp and therefore contains both date and time. We use the term "date_end" to
     * clarify that this is indeed date and not just time.
     */
    public function setDateEnd($date_end){
        if(!is_int($date_end))
            throw new Exception("Invalid value passed to " . __FUNCTION__ . ". The passed value must be an integer, and a " . gettype($date_end) . " was passed.");
        $this->date_end = $date_end;
    }



    /**
     * @param int $price
     * @throws Exception
     */
    public function setPrice($price){
        if(!is_numeric($price))
            throw new Exception("Invalid value passed to " . __FUNCTION__ . ". The passed value must be an integer, and a " . gettype($price) . " was passed.");
        $this->price = $price;
    }



    /**
     * @param String $repeat
     * @throws Exception
     */
    public function setRepeat($repeat){
        if(!is_string($repeat))
            throw new Exception("Invalid value passed to " . __FUNCTION__ . ". The passed value must be a string, and a " . gettype($repeat) . " was passed.");
        $this->repeat = $repeat;
    }



    /**
     * @param mixed $description
     */
    public function setDescription($description){
        $this->description = $description;
    }



    /**
     * @param mixed $num_attendees
     */
    public function setNumAttendees($num_attendees){
        $this->num_attendees = $num_attendees;
    }



    public function to_object(){
        $obj = new stdClass();
        $obj->id = $this->getId();
        $obj->description = $this->getDescription();
        $obj->confirmed = $this->getConfirmed();
        $obj->location = $this->getLocation()->to_object();
        $obj->name = $this->getName();
        $obj->organizer_id = $this->getOrganizerId();
        $obj->parent_id = $this->getParentId();
        $obj->date_end = $this->getDateEnd();
        $obj->date_start = $this->getDateStart();
        $obj->price = $this->getPrice();
        $obj->repeats = $this->getRepeat();
        $obj->numAttendees = $this->getNumAttendees();
        return $obj;
    }



    /**
     * @return Array
     */
    abstract public function getPrimaryActors();



    /**
     * @return Array
     */
    public function to_JSON(){
        return json_encode($this->to_object());
    }
}