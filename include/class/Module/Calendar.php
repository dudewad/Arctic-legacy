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
     * @param   $domID      String          The DOM ID to be applied to the calendar object, if applicable
     * @param   $class      String          The class of the outer-most HTML container element
     * @return  string                      Render the calendar as HTML
     * @throws  Exception
     */
    public function to_html_full_day($eventList, $day = null, $event = null, $domID = null, $class = null){
        $html = "";
        $default = "";
        $eObj = null;
        $selectedID = null;
        $dateCheck = date("dmY", $day);
        $sort = $this->sorterToHTML(Utility_App::getCurrentPageURL());

        //Use today by default
        if(!$day){
            $day = time() + $this->timezoneOffset;
        }

        if(isset($event)){
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
            $selectedID = $event->getId();
            $default = $eObj->to_html_quick_view();
        }
        else{
            $login = new Module_Login();
            $default = $login->to_html_full();
        }

        $thumbs = $this->eventListToThumbs($eventList, $selectedID, $default);
        $templates = "";


        //"Day" timeframe has a left column with thumbs, and main display area on the right
        $html = <<<HTML
                <div class="c full-day $class" id="$domID">
                    $sort
                    $thumbs
                </div>
HTML;

        return $html;
    }



    /**
     * @param $class    String      The class of the outer-most HTML container element
     * @return string   Render the calendar as HTML
     */
    public function to_html_list($class = null){
    }



    public function to_JSON(){
        $json = "";
        return $json;
    }


    /**
     * Take an event list and turn it into HTML thumbnails and return as an HTML string.
     * @param $eventList    Array           Required        An array of Event_Event objects
     *
     * @param $selectedID   Integer         Optional        The ID of the event in the set that is to be rendered with a
     *                                                      "selected" class. This is for when a user loads a page with an
     *                                                      event selected, namely with JS disabled.
     *
     * @param $defaultData  String          Optional        An HTML string defining the data to be displayed by default.
     *                                                      This could be an event, or anything else such as a login dialog
     *                                                      or an advertisement.
     *
     * @return string
     * @throws Exception
     */
    private function eventListToThumbs($eventList, $selectedID = null, $defaultData = null){
        $html = "<ul class='th-list clearfix'>";
        $eOut = null;
        $mOut = null;
        $lOut = null;
        $pOut = null;
        $sOut = null;
        $isSelectedEvent = false;

        //If no event was passed, add the default data that was passed to the beginning of the list.
        if(!$selectedID){
            $html .= "<li class='c-e-disp full'>" . $defaultData . "</li>";
        }

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
            $isSelectedEvent = $id == $selectedID;
            $url = Utility_App::getURL("URL_MAIN","e=$id");
            $selected = $isSelectedEvent ? "selected" : null;
            $html .= $eOut->to_html_thumb($url, $selected);

            //Add the selected event if there is one
            if($isSelectedEvent){
                $html .= "<li class='c-e-disp full' data-event-id='" . $e->getId() . "'>" . $defaultData . "</li>";
            }
        }

        $html .= "</ul>";

        return $html;
    }



    /**
     * @param null $day     The day to mark as "selected". Defaults to today.
     * @param null $month   The month to be viewed. Defaults to the current month.
     * @param null $year    The year to be viewed. Defaults to the current year.
     * @return string
     * @throws Exception_ModuleCalendarException
     */
    public function calendarPickerMonthToHTML($day = null, $month = null, $year = null){
        //Require month, if passed, to be a number between 1 and 12
        if(isset($month) && (!is_int($month) || $month < 1 || $month > 12))
            throw(new Exception_ModuleCalendarException(utf8_encode("Error in " . __METHOD__ . ': $month must be an integer between 1 and 12.')));
        //Require year, if passed, to be four digit number
        if(isset($year) && (!is_int($year) || strlen((string)$year) !== 4))
            throw(new Exception_ModuleCalendarException(utf8_encode("Error in " . __METHOD__ . ': $year must be a four digit integer.')));
        //Selected date
        $day = isset($day) ? $day : date("j");
        //Target month for calendar
        $month = isset($month) ? $month : date("n");
        //Target year for calendar
        $year = isset($year) ? $year : date("Y");
        //First day of the month as a timestamp
        $firstDayTimestamp = strtotime("$month/1/$year");
        //The first day in the month in question as an integer from 0-6
        $firstDayInMonth = date("w", $firstDayTimestamp);
        //The date that the calendar starts on as a unix timestamp
        $calStartDate = $firstDayInMonth > 0 ? $this->getCalendarStartDay($month, $year) : $firstDayTimestamp;
        //Number of days in the target month
        $daysInMonth = date("t", $firstDayTimestamp);
        //Number of days from the beginning of the calendar to the last day of the month - for displaying days that
        //aren't part of this month
        $lastDayInMonth = $firstDayInMonth + $daysInMonth;
        $prevMonth = $month > 1 ? $month - 1 : 12;
        $nextMonth = $month < 12 ? $month + 1 : 1;
        //CSS class - Sets whether or not a date picker box is from the current month, or the previous/next month
        $dateClass = "othMon";
        $selected = null;
        $selectedDate = $day + $firstDayInMonth - 1;
        //Localized days (textual values)
        $days = array(String_String::getString("DAY_SUNDAY",__CLASS__),
            String_String::getString("DAY_MONDAY",__CLASS__),
            String_String::getString("DAY_TUESDAY",__CLASS__),
            String_String::getString("DAY_WEDNESDAY",__CLASS__),
            String_String::getString("DAY_THURSDAY",__CLASS__),
            String_String::getString("DAY_FRIDAY",__CLASS__),
            String_String::getString("DAY_SATURDAY",__CLASS__)
        );

        $months = array(String_String::getString("MONTH_JANUARY",__CLASS__),
            String_String::getString("MONTH_FEBRUARY",__CLASS__),
            String_String::getString("MONTH_MARCH",__CLASS__),
            String_String::getString("MONTH_APRIL",__CLASS__),
            String_String::getString("MONTH_MAY",__CLASS__),
            String_String::getString("MONTH_JUNE",__CLASS__),
            String_String::getString("MONTH_JULY",__CLASS__),
            String_String::getString("MONTH_AUGUST",__CLASS__),
            String_String::getString("MONTH_SEPTEMBER",__CLASS__),
            String_String::getString("MONTH_OCTOBER",__CLASS__),
            String_String::getString("MONTH_NOVEMBER",__CLASS__),
            String_String::getString("MONTH_DECEMBER",__CLASS__),
        );
        $monthName = $months[$month - 1];

        //Build table header
        $header = "<div class='header clearfix'>";
        for($i = 0; $i < count($days); $i++){
            $header .= "<div class='cell'>" . substr($days[$i],0,1) . "</div>";
        }
        $header .= "</div>";

        //Build the table body
        $daysListed = 0;
        $isLastWeek = false;
        $calDay = date("j", $calStartDate);
        $calMonth = date("j", $calStartDate);
        $calYear = date("j", $calStartDate);

        $generating = true;
        $previewCells = "<div class='body'>";
        $visualizerCells = "<div class='body'>";
        while($generating){
            if($daysListed == $firstDayInMonth){
                $dateClass = "curMon";
                $calDay = 1;
            }
            else if($daysListed == $lastDayInMonth){
                $dateClass = "othMon";
                $calDay = 1;
            }
            $selected = $daysListed == $selectedDate ? "selected" : null;
            //New rows every 7 days
            $clearClass = $daysListed % 7 ? null : "rowStart";

            //Generate the cell
            $previewCells .= "<div class='cell $dateClass $selected $clearClass'></div>";
            $visualizerCells .= "<div class='cell $dateClass $selected $clearClass' data-month='$calMonth' data-day='$calDay' data-year='$calYear'><span>$calDay</span></div>";
            $daysListed++;
            $calDay++;
            if($daysListed > $lastDayInMonth - 1)
                $isLastWeek = true;
            if($isLastWeek && !($daysListed % 7)){
                $generating = false;
            }
        }
        $previewCells .= "</div>";
        $visualizerCells .= "</div>";

        $indicator = Utility_App::getURL("URL_MAIN") . "asset/image/gui/gui-calendar-flyout-arrow-indicator19x10.png";
        $html = <<<HTML
                <div class="c picker month">
                    <div class="controls">
                        <a href="" class="previous"></a>
                        <a href="" class="next"></a>
                    </div>
                    <div class="preview">
                        $previewCells
                    </div>
                    <div class="visualizer">
                        <img class="indicator" src="$indicator" alt="" />
                        <h3>$monthName</h3>
                        $header
                        $visualizerCells
                    </div>
                </div>
HTML;

        return $html;
    }


    /**
     * Returns the start date as a timestamp for a calendar beginning on a sunday for the passed month/year
     * @param $month
     * @param $year
     * @return bool|string
     */
    private function getCalendarStartDay($month, $year){
        $prevMonth = $month > 1 ? $month - 1 : 12;
        $prevMonthYear = $month < 12 ? $year : $year - 1;
        $firstDayInMonth = date("w", strtotime("$month/1/$year"));
        $startDay = date("t", strtotime("$prevMonth/1/$prevMonthYear")) - $firstDayInMonth + 1;
        return strtotime("$prevMonth/$startDay/$prevMonthYear");
    }



    private function sorterToHTML(){
        $advancedSort = $this->advancedSortModalToHTML();
        $html = <<<HTML
                <form action='#' method='post' class="sort">
                    <a href="" class="button advanced"><span>Sort Options</span></a>
                    <label class="milonga checked hasIndicator">
                        <input type='checkbox' name='milonga' checked/>
                        Milonga
                    </label>
                    <label class="lesson checked hasIndicator">
                        <input type='checkbox' name='lesson' checked/>
                        Lesson
                    </label>
                    <label class="practica checked hasIndicator">
                        <input type='checkbox' name='practica' checked/>
                        Practica
                    </label>
                    <label class="show checked hasIndicator">
                        <input type='checkbox' name='show' checked/>
                        Show
                    </label>
                    <input type="submit" class="button" value="Sort"/>
                </form>
                $advancedSort
HTML;
        return $html;
    }


    private function advancedSortModalToHTML(){
        $html = <<<HTML
                <div class="sort advanced" style="display:none;"></div>
HTML;
        return $html;
    }
}