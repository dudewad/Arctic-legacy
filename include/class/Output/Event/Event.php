<?php
/**
 * Author: Ghost
 * Date: 7/10/13
 */
 
abstract class Output_Event_Event implements Interface_OutputBase, Interface_OutputEvent {
    protected $data;


    public function __construct(Event_Event $data = null){
        $this->data = $data;
    }

    /**
     * Format the a JSON representation of this object, typically for AJAX calls
     * @return string
     */
    public function to_JSON(){
        return json_encode($this->data->to_object());
    }



    /**
     * Format the full version of the object to HTML
     * @param $class    String      The class of the outer-most HTML container element
     * @return string
     */
    public function to_html_full($class = null){
        $html = <<<HTML
            <div class='e-disp-f $class'>
            </div>
HTML;

        return $html;
    }



    /**
     * Format the thumbnail version of the object to HTML
     * @param $class    String      The class of the outer-most HTML container element
     * @return string
     */
    public function to_html_thumb($class = null){
        $event = $this->data;
        $startTime = $this->startTime();
        $eventName = $event->getName();
        $location = $event->getLocation();
        $address = $location->getAddress();
        $eType = String_String::getString("EVENT_TYPE_" . strtoupper($event::E_TYPE));
        $actors = $this->getPrimaryActorsAsString();

        $html = <<<HTML
            <div class='e th $class'>
                <div class="stripe">
                    <div class="title">
                        <div class="col-left">
                            $startTime -
                        </div>
                        <div class="col-right">
                            $eType: $eventName
                            <div class="details">
                                <div class="address">
                                    $address
                                </div>
                                <div class="organizer">
                                    $actors
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
HTML;

        return $html;
    }


    /**
     * @return String   The start time formatted as a string
     */
    protected function startTime(){
        return date("G:i", $this->data->getDateStart());
    }


    /**
     * @return String   The end time formatted as a string
     */
    protected function endTime(){
        return date("G:i", $this->data->getDateEnd());
    }



    /**
     * @param $data Event_Event     Allow recycling of this output object
     */
    public function setData(Event_Event $data){
        $this->data = $data;
    }



    /**
     * Returns a string representation of the primary actors for this event, including a prefix of actor type
     * @return String
     */
    abstract protected function getPrimaryActorsAsString();
}
