<?php
/**
 * Author: Ghost
 * Date: 7/9/13
 */
require_once("Login.php");
 
class Module_Calendar{

    //Timezone offset will be relative to the city that the user has selected
    private $timezoneOffset;



    /**
     * @param $timezoneOffset   Integer     Timestamp of the user's registered city's timezone offset from GMT
     */
    public function __construct($timezoneOffset){
        $this->timezoneOffset = $timezoneOffset;
    }

    /**
     * Formats the calendar to it's full HTML view for a single day
     * @param   $eventList  Array           An array of Event objects to display
     * @param   $day        Integer         Timestamp of the day to be displayed
     * @param   $event      Event_Event     The event to be viewed, if applicable. This typically will only be set if the
     *                                      user has Javascript disabled, as this data is brought in via AJAX otherwise
     * @param   $class      String          The class of the outer-most HTML container element
     * @return  string                      Render the calendar as HTML
     * @throws  Exception
     */
    public function to_html_full_day($eventList, $day = null, $event = null, $class = null){
        $selectedID = null;
        $dateCheck = date("dmY", $day);

        //Use today by default
        if(!$day){
            $day = time() + $this->timezoneOffset;
        }

        if(isset($event)){
            $eObj = null;
            switch(get_class($event)){
                case "Event_Milonga":
                    $eObj = new Output_Event_Milonga($event);
                    break;
                case "Event_Lesson":
                    $eObj = new Output_Event_Lesson($event);
                    break;
                case "Event_Practica":
                    $eObj = new Output_Event_Practica($event);
                    break;
                case "Event_Show":
                    $eObj = new Output_Event_Show($event);
                    break;
            }
            $default = $eObj->to_html_calendar();
            $selectedID = $event->getId();
        }
        else{
            $login = new Module_Login();
            $default = $login->to_html_full();
        }

        $thumbs = $this->eventListToThumbs($eventList, $selectedID);

        //"Day" timeframe has a left column with thumbs, and main display area on the right
        $html = <<<HTML
            <div class="c full-day $class">
                <div class="c-e-disp full">
                    <div class="e-container">
                        $default
                    </div>
                </div>
                <div class="th-list">
                    $thumbs
                </div>
            </div>
HTML;

        return $html;
    }



    public function to_html_list($class = null){
        /**
         * @param $class    String      The class of the outer-most HTML container element
         * @return string   Render the calendar as HTML
         */
    }



    public function to_JSON(){
        $json = "";
        return $json;
    }


    /**
     * Take an event list and turn it into HTML thumbnails and return as an HTML string.
     * @param $eventList    Array       Required        An array of Event_Event objects
     *
     * @param $selectedID   Integer     Optional        The ID of the event in the set that is to be rendered with a
     *                                                  "selected" class. This is for when a user loads a page with an
     *                                                  event selected, namely with JS disabled.
     * @return string
     * @throws Exception
     */
    private function eventListToThumbs($eventList, $selectedID = null){
        $html = "";
        $eOut = null;
        $mOut = null;
        $lOut = null;
        $pOut = null;
        $sOut = null;

        foreach($eventList as $e){
            //Require events
            if(!($e instanceof Event_Event))
                throw new Exception("All events passed to " . __CLASS__ . "::eventListToThumbs() must be of type Event_Event.");

            if($e instanceof Event_Milonga){
                if(isset($mOut))
                    $mOut->setData($e);
                else
                    $mOut = new Output_Event_Milonga($e);
                $eOut = $mOut;
            }
            if($e instanceof Event_Practica){
                if(isset($pOut))
                    $pOut->setData($e);
                else
                    $pOut = new Output_Event_Practica($e);
                $eOut = $pOut;
            }
            if($e instanceof Event_Lesson){
                if(isset($lOut))
                    $lOut->setData($e);
                else
                    $lOut = new Output_Event_Lesson($e);
                $eOut = $lOut;
            }
            if($e instanceof Event_Show){
                if(isset($sOut))
                    $sOut->setData($e);
                else
                    $sOut = new Output_Event_Show($e);
                $eOut = $sOut;
            }

            $id = $e->getID();
            $url = Utility_App::getURL("URL_MAIN","e=$id");
            $selected = ($id == $selectedID) ? "selected" : null;
            $html .= $eOut->to_html_thumb($url, $selected);
        }

        return $html;
    }
}