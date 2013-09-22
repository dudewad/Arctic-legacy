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
    public function to_html_calendar($class = null){
        $eventName = $this->data->getName();
        $banner = "<img src='" . Utility_AssetManager::getEventBanner($this->data->getID()) . "' alt='$eventName' class='banner' />";
        $description = $this->data->getDescription();
        $time = $this->data->getTimeRange();
        $price = "$" . $this->data->getPrice();
        $numAttendees = $this->data->getNumAttendees();
var_dump($numAttendees);
        $titleInfo = String_String::getString("EVENT_TITLE_INFORMATION");
        $titleDesc = String_String::getString("EVENT_TITLE_DESCRIPTION");
        $titleDay = String_String::getString("EVENT_TITLE_DAY");
        $titleTime = String_String::getString("EVENT_TITLE_TIME");
        $titlePrice = String_String::getString("EVENT_TITLE_COST");
        $titleLocation = String_String::getString("EVENT_TITLE_LOCATION");
        $locationOut = new Output_Location_Location($this->data->getLocation());
        $location = $locationOut->to_html_full();
        $social = null;

        if(Utility_App::hasUserSession()){
            $social = <<<HTML
            <div class="social">
                <div class="button">
                    Going?
                </div>
                <div class="">
                    $numAttendees people RSVP'd this event.
                </div>
            </div>
HTML;
        }

        $html = <<<HTML
            <div class='$class'>
                <div class="banner-container">
                    $banner
                </div>
                <div class="title">
                    <h2>$eventName</h2>
                </div>
                $social
                <div class="e-data">
                    <div class="col-left">
                        <div class="information">
                            <h2>$titleInfo</h2>
                            <div class="row">
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
                            <div class="clear"></div>
                        </div>
                        <div class="description">
                            <h2>$titleDesc</h2>
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
    public function to_html_thumb($url, $class = null){
        $event = $this->data;
        $id = $event->getId();
        $startTime = $this->startTime();
        $eventName = $event->getName();
        $location = $event->getLocation();
        $address = $location->getAddress();
        $eType = String_String::getString("EVENT_TYPE_" . strtoupper($event::E_TYPE));
        $actors = $this->getPrimaryActorsAsString();
        $price = "$" . $event->getPrice();

        $html = <<<HTML
            <div class='e th $class' data-event-id='$id'>
                <a href="$url">
                    <div class="e-content">
                        <div>
                            <div class="col-left">
                                <div class="time">
                                    $startTime -
                                </div>
                            </div>
                            <div class="col-center">
                                <div class="title">
                                    $eType: $eventName
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
                            <div class="col-right">
                                <span class="price">$price</span>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </a>
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