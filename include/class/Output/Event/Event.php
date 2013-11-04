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
     * Format the calendar view version of the object to HTML
     * @param $class    String      The class of the outer-most HTML container element
     * @return string
     */
    public function to_html_quick_view($class = null){
        $eventName = $this->data->getName();
        $banner = "<img src='" . Utility_AssetManager::getEventBanner($this->data->getID()) . "' alt='$eventName' class='banner' />";
        $description = $this->data->getDescription();
        $time = $this->data->getTimeRange();
        $price = "$" . $this->data->getPrice();
        $numAttendees = $this->data->getNumAttendees();
        $titleInfo = String_String::getString("EVENT_TITLE_INFORMATION",__CLASS__);
        $titleDesc = String_String::getString("EVENT_TITLE_DESCRIPTION",__CLASS__);
        $titleDay = String_String::getString("EVENT_TITLE_DAY",__CLASS__);
        $titleTime = String_String::getString("EVENT_TITLE_TIME",__CLASS__);
        $titlePrice = String_String::getString("EVENT_TITLE_COST",__CLASS__);
        $titleLocation = String_String::getString("EVENT_TITLE_LOCATION",__CLASS__);
        $locationOut = new Output_Location_Location($this->data->getLocation());
        $location = $locationOut->to_html_full();
        $social = null;
        $actors = "";
        if($this->data->hasDJs()){
            $actors .= "";
        }
        if($this->data->hasInstructors()){
            $actors .= "";
        }
        if($this->data->hasPerformers()){
            $actors .= "";
        }

        $html = <<<HTML
            <div class='e $class'>
                <div class="banner-container">
                    $banner
                </div>
                <div>
                    <h2>$eventName</h2>
                </div>
                <div class="e-data clearfix">
                    <div class="col-left">
                        <div class="information">
                            <h3>$titleInfo</h3>
                            <div class="row clearfix">
                                <div class="column col-1-2">
                                    <table>
                                        <tr>
                                            <td class="label">
                                                $titleDay
                                            </td>
                                            <td class="text-right content">
                                                Test
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label">
                                                $titleTime
                                            </td>
                                            <td class="text-right content">
                                                $time
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label">
                                                $titlePrice
                                            </td>
                                            <td class="text-right content">
                                                $price
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="column col-1-2 end">
                                    <table>
                                        <tr>
                                            <td class="label">
                                                $titleLocation
                                            </td>
                                            <td class="text-right content">
                                                $location
                                            </td>
                                        </tr>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <div class="description">
                            <h3>$titleDesc</h3>
                            <p>$description</p>
                        </div>
                    </div>
                    <div class="col-right">

                    </div>
                </div>
            </div>
HTML;

        return $html;
    }



    /**
     * Format the thumbnail version of the object to HTML
     * @param $url      String      The URL this thumb references
     * @param $class    String      The class of the outer-most HTML container element
     * @return string
     */
    public function to_html_thumb($url = "", $class = null){
        $event = $this->data;
        $id = $event->getId();
        $startTime = $this->startTime();
        $eventName = $event->getName();
        $location = $event->getLocation();
        $address = $location->getAddress();
        $eType = String_String::getString("EVENT_TYPE_" . strtoupper($event::E_TYPE),__CLASS__);
        $actors = $this->getPrimaryActorsAsString();
        $price = "$" . $event->getPrice();

        $html = <<<HTML
            <li class='e th $class' data-event-id='$id'>
                <a href="$url">
                    <div class="container">
                        <div class="labels">
                            <div class="col-time">
                                <div class="time">
                                    $startTime -
                                </div>
                            </div>
                            <div class="col-price">
                                $price
                            </div>
                        </div>
                        <div class="content-padding">
                            <div class="e-content clearfix">
                                <div class="col-data">
                                    <div>
                                        <h3>$eType: $eventName</h3>
                                    </div>
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
                        </div>
                    </div>
                </a>
            </li>
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
     * Returns the class name of the top-most ancestor class
     * @return string
     */
    protected final function getTopAncestorClassName(){
        return __CLASS__;
    }



    /**
     * Returns a string representation of the primary actors for this event, including a prefix of actor type
     * @return String
     */
    abstract protected function getPrimaryActorsAsString();
}
