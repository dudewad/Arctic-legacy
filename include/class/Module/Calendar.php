<?php
/**
 * Author: Ghost
 * Date: 7/9/13
 */
 
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
     * @param   $eventList  Array       An array of Event objects to display
     * @param   $day        Integer     Timestamp of the day to be displayed
     * @param   $class      String      The class of the outer-most HTML container element
     * @return  string                  Render the calendar as HTML
     * @throws  Exception
     */
    public function to_html_full_day($eventList, $day = null, $class = null){
        //Use today by default
        if(!$day){
            $day = time() + $this->timezoneOffset;
        }
        $dateCheck = date("dmY", $day);

        $thumbs = '<div class="th-list">' . $this->eventListToThumbs($eventList) . "</div>";

        //"Day" timeframe has a left column with thumbs, and main display area on the right
        $html = <<<HTML
            <div class="calendar $class">
                <div class="c-th">
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
     * @param $eventList
     * @return string
     * @throws Exception
     */
    private function eventListToThumbs($eventList){
        $html = "";
        $eOut = null;
        $mOut = null;
        $lOut = null;
        $pOut = null;
        $sOut = null;

        foreach($eventList as $e){
            //Require events
            if(!($e instanceof Event_Event))
                throw new Exception("All events passed to " . __CLASS__ . "::to_html_full_day() must be of type Event_Event.");
            if($e instanceof Event_Milonga){
                if(!$mOut)
                    $mOut = new Output_Event_Milonga($e);
                else
                    $mOut->setData($e);
                $eOut = $mOut;
            }
            if($e instanceof Event_Practica){
                if(!$pOut)
                    $pOut = new Output_Event_Practica($e);
                else
                    $pOut->setData($e);
                $eOut = $pOut;
            }
            if($e instanceof Event_Lesson){
                if(!$lOut)
                    $lOut = new Output_Event_Lesson($e);
                else
                    $lOut->setData($e);
                $eOut = $lOut;
            }
            if($e instanceof Event_Show){
                if(!$sOut)
                    $sOut = new Output_Event_Show($e);
                else
                    $sOut->setData($e);
                $eOut = $sOut;
            }
            $html .= $eOut->to_html_thumb();
        }

        return $html;
    }
}
