<?php
/**
 * Author: Ghost
 * Date: 7/9/13
 */
require_once("Login.php");
 
class Module_Calendar{
    //A prefix for all form IDs to help guarantee unique DOM IDs
    const formIDPrefix = "c";
    //The Calendar module will give each form a unique numeric ID
    public static $formID = 0;
    //Stores the URL that the modal sort will point to
    private $modalSortURL = null;
    //Stores the date that the modal sort will effect
    private $modalSortDate = null;



    /**
     * Constructor
     */
    public function __construct(){}



    /**
     * Formats the calendar to it's full HTML view for a single day
     * @param   $eventList  Array           An array of Event objects to display
     * @param   $date       Integer         Timestamp of the day to be displayed
     * @param   $event      Event_Event     The event to be viewed, if applicable. This typically will only be set if the
     *                                      user has Javascript disabled, as this data is brought in via AJAX otherwise
     * @param   $domID      String          The DOM ID to be applied to the calendar object, if applicable
     * @param   $class      String          The class of the outer-most HTML container element
     * @return  string                      Render the calendar as HTML
     * @throws  Exception
     */
    public function to_html_full_day($eventList, $date = null, $event = null, $domID = null, $class = null){
        $eObj = null;
        $selectedID = null;
        //Use today by default
        if(!$date){
            $date = time();
        }
        $sort = $this->sorterToHTML(TanguerApp::getCurrentPageURL(), $date);

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
                <div class="c full-day disp $class" id="$domID">
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
     * @param null $date        Integer     REQUIRED    A UTC Timestamp representing the day/month to be displayed
     * @param null $timezone    String      REQUIRED    A string identifier for the timezone that the calendar picker will be in
     * @return string
     * @throws Exception_ModuleCalendarException
     */
    public function calendarPickerMonthToHTML($date, $timezone){
        //Use specified timezone if applicable. Will reset timezone at end of function.
        $oldTimezone = date_default_timezone_get();
        date_default_timezone_set($timezone);
        //If today is the day, this sets the calendar's "Day of the week" to say "Today" in the applicable language
        if(date("jnY") == date("jnY",$date))
            $dayOfWeek = mb_strtoupper(String_String::getString("DAY_TODAY",__CLASS__),"UTF-8");
        //Selected date - numeric value, no leading zeros
        $day = date("j", $date);
        //Target month for calendar - numeric value, no leading zeros
        $month = date("n", $date);
        //Target year for calendar - Four-digit numeric value
        $year = date("Y", $date);
        //First day of the month as a timestamp
        $firstDayTimestamp = mktime(0,0,0,$month,1,$year);
        //The first day in the month in question as an integer from 0-6
        $firstDayInMonth = date("w", $firstDayTimestamp);
        //The date that the calendar starts on as a unix timestamp
        $calStartDate = $firstDayInMonth > 0 ? $this->getCalendarStartDay($month, $year) : $firstDayTimestamp;
        //Number of days in the target month
        $daysInMonth = date("t", $firstDayTimestamp);
        //Number of days from the beginning of the calendar to the last day of the month - for displaying days that
        //aren't part of this month
        $lastDayInMonth = $firstDayInMonth + $daysInMonth;
        //CSS class - Sets whether or not a date picker box is from the current month, or the previous/next month
        $dateClass = "othMon";
        $selected = null;
        //The date that is currently selected as a number from the start date of the calendar. Takes into account days
        //showing from the previous month
        $selectedDate = $day + $firstDayInMonth - 1;
        //Controls and GUI items. Start by calculating the timestamp for both the next and previous months, and
        //generating the applicable URL strings to arrive at that calendar system.
        $prevMonth = $month > 1 ? $month - 1 : 12;
        $prevMonthYear = $prevMonth == 12 ? $year - 1 : $year;
        $nextMonth = $month < 12 ? $month + 1 : 1;
        $nextMonthYear = $nextMonth == 1 ? $year + 1 : $year;
        $indicator = Utility_Constants::URL_ASSET_BASE . "/image/gui/gui-calendar-flyout-arrow-indicator19x10.png";
        $prevMonthURLDate = Date_TanguerDateTime::urlFriendlyDate(mktime(0,0,0,$prevMonth,1,$prevMonthYear));
        $nextMonthURLDate = Date_TanguerDateTime::urlFriendlyDate(mktime(0,0,0,$nextMonth,1,$nextMonthYear));
        $nextMonthURL = TanguerApp::getDynamicURL($nextMonthURLDate);
        $previousMonthURL = TanguerApp::getDynamicURL($prevMonthURLDate);
        //Get URLS for "tomorrow" and "yesterday" as well
        $tomorrow = Date_TanguerDateTime::urlFriendlyDate($date + 86400);
        $yesterday = Date_TanguerDateTime::urlFriendlyDate($date - 86400);
        $tomorrowURL = TanguerApp::getDynamicURL($tomorrow);
        $yesterdayURL = TanguerApp::getDynamicURL($yesterday);
        //Localized days (textual values)
        $days = array(String_String::getString("DAY_SUNDAY",__CLASS__),
            String_String::getString("DAY_MONDAY",__CLASS__),
            String_String::getString("DAY_TUESDAY",__CLASS__),
            String_String::getString("DAY_WEDNESDAY",__CLASS__),
            String_String::getString("DAY_THURSDAY",__CLASS__),
            String_String::getString("DAY_FRIDAY",__CLASS__),
            String_String::getString("DAY_SATURDAY",__CLASS__)
        );
        //Localized months (textual values)
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
        //Date display strings
        $dayOfWeek = isset($dayOfWeek) ? $dayOfWeek : mb_strtoupper($days[date('w',$date)],"UTF-8");
        $fullDisplayDate = date(String_String::getString("SETTING_DATE_FORMAT",__CLASS__),$date);

        //Build table header
        $header = "<div class='header clearfix'>";
        for($i = 0; $i < count($days); $i++){
            $header .= "<div class='cell'>" . substr($days[$i],0,1) . "</div>";
        }
        $header .= "</div>";

        //Build the table body
        $daysListed = 0;
        $isLastWeek = false;
        $calDay = null;
        $calMonth = null;
        $calYear = null;

        $generating = true;
        $previewCells = "<div class='body'>";
        $visualizerCells = "<div class='body'>";

        if($firstDayInMonth > 0){
            $visualizerCells .= "<div class='othMonContainer'>";
        }

        $hasOthMonContainer = false;
        $currentDate = $calStartDate;
        //Generate the body of the calendar
        while($generating){
            if($daysListed == $firstDayInMonth){
                $dateClass = "curMon";
                //Close 'previous month' container div
                if($firstDayInMonth > 0)
                    $visualizerCells .= "</div>";
                //Update month and year
                $calMonth = date("n", $currentDate);
                $calYear = date("Y", $currentDate);
            }
            else if($daysListed == $lastDayInMonth){
                $dateClass = "othMon";
                $visualizerCells .= "<div class='othMonContainer'>";
                $hasOthMonContainer = true;
                //Update month and year
                $calMonth = date("n", $currentDate);
                $calYear = date("Y", $currentDate);
            }
            $calDay = date("j", $currentDate);
            $selected = $daysListed == $selectedDate ? "selected" : null;
            //New rows every 7 days
            $clearClass = $daysListed % 7 ? null : "rowStart";
            $urlDate = Date_TanguerDateTime::urlFriendlyDate($currentDate);
            $url = TanguerApp::getDynamicURL($urlDate);

            //Generate the cell
            $previewCells .= "<div class='cell $dateClass $selected $clearClass'></div>";
            $visualizerCells .= "<a href='$url' class='cell $dateClass $selected $clearClass' data-month='$calMonth' data-day='$calDay' data-year='$calYear'><span>$calDay</span></a>";
            $daysListed++;
            //We have to check for the two days a year that DST rolls over
            $dstOffset = date("G", $currentDate + 86400);
            //Means we lost an hour
            if($dstOffset == 1){
                $currentDate += 82800;
            }
            //Means we gained an hour
            else if($dstOffset == 23){
                $currentDate += 90000;
            }
            else{
                $currentDate += 86400;
            }
            if($daysListed > $lastDayInMonth - 1)
                $isLastWeek = true;
            if($isLastWeek && !($daysListed % 7)){
                $generating = false;
                //Close 'previous month' container div
                if($hasOthMonContainer)
                    $visualizerCells .= "</div>";
            }
        }
        $previewCells .= "</div>";
        $visualizerCells .= "</div>";

        $html = <<<HTML
                <div class="c-picker-wrapper clearfix">
                    <div class="c picker month">
                        <div class="preview">
                            $previewCells
                        </div>
                        <div class="visualizer">
                            <img class="indicator" src="$indicator" alt="" />
                            <div class="controls">
                                <a href="$previousMonthURL" class="previous"></a>
                                <a href="$nextMonthURL" class="next"></a>
                            </div>
                            <h3>$monthName</h3>
                            $header
                            $visualizerCells
                        </div>
                    </div>
                    <div class="c d-disp">
                        <div class="controls">
                            <a href="$yesterdayURL" class="previous"></a>
                            <a href="$tomorrowURL" class="next"></a>
                        </div>
                        <div class="d-content">
                            <h2>$dayOfWeek</h2>
                            <h3>$fullDisplayDate</h3>
                        </div>
                    </div>
                </div>
HTML;

        date_default_timezone_set($oldTimezone);

        return $html;
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
            $url = TanguerApp::getURL("URL_MAIN","e=$id");
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
     * Returns the start date as a timestamp for a calendar beginning on a sunday for the passed month/year
     * @param $month
     * @param $year
     * @return bool|string
     */
    private function getCalendarStartDay($month, $year){
        $prevMonth = $month > 1 ? $month - 1 : 12;
        $prevMonthYear = $prevMonth < 12 ? $year : $year - 1;
        $firstDayInMonth = date("w", mktime(0,0,0,$month,1,$year));
        $startDay = date("t", mktime(0,0,0,$prevMonth,1,$prevMonthYear)) - $firstDayInMonth + 1;
        return mktime(0,0,0,$prevMonth,$startDay,$prevMonthYear);
    }



    /**
     * Prints the calendar sorter to HTML
     * @param $url
     * @param $date
     * @return string
     */
    private function sorterToHTML($url, $date){
        $submitButtonText = String_String::getString("SORT_SORT_SUBMIT",__CLASS__);
        $sortOptionsText = String_String::getString("SORT_SORT_OPTIONS",__CLASS__);
        $milongaDisplay = String_String::getString("EVENT_TYPE_MILONGA","Output_Event_Event");
        $lessonDisplay = String_String::getString("EVENT_TYPE_LESSON","Output_Event_Event");
        $practicaDisplay = String_String::getString("EVENT_TYPE_PRACTICA","Output_Event_Event");
        $showDisplay = String_String::getString("EVENT_TYPE_SHOW","Output_Event_Event");
        $formID = "eTypeSort" . $this->getNextFormID();
        TanguerApp::setModal($this->advancedSortModalToHTML($url, $date),"e-s-adv");
        $html = <<<HTML
                <div class="s">
                    <div class="s-adv">
                        <a href="" class="button adv"><span>$sortOptionsText</span></a>
                    </div>
                    <form action='#' method='post' class="e-s" id="$formID">
                        <label class="milonga checked hasIndicator" data-sort-type="milonga">
                            <input type='checkbox' name='milonga' checked/>
                            $milongaDisplay
                        </label>
                        <label class="lesson checked hasIndicator" data-sort-type="lesson">
                            <input type='checkbox' name='lesson' checked/>
                            $lessonDisplay
                        </label>
                        <label class="practica checked hasIndicator" data-sort-type="practica">
                            <input type='checkbox' name='practica' checked/>
                            $practicaDisplay
                        </label>
                        <label class="show checked hasIndicator" data-sort-type="show">
                            <input type='checkbox' name='show' checked/>
                            $showDisplay
                        </label>
                        <input type="submit" class="button" value="$submitButtonText"/>
                    </form>
                </div>
HTML;
        return $html;
    }



    /**
     * Returns and HTML string for an advanced sort form for the calendar
     * @param string $url       The form action URL
     * @param string $date      The date that the sort action is working on
     * @return string
     */
    private function advancedSortModalToHTML($url, $date){
        $submitButtonText = String_String::getString("SORT_SORT_SUBMIT",__CLASS__);
        $html = <<<HTML
                <div class="e-s-adv">
                    <h3>Additional Sort Options</h3>
                    <form action="$url" method="post" class="s-adv-form" >
                        <input type="hidden" name="date" value="$date" >
                        <select name="param">
                            <option value="start_time">Time</option>
                            <option value="price">Price</option>
                            <option value="event_type">Event Type</option>
                        </select>
                        <label><input type="radio" name="sO" value="asc" checked="true" /><span>Ascending</span></label>
                        <label><input type="radio" name="sO" value="desc" /><span>Descending</span></label>
                        <input type="submit" class="button" value="$submitButtonText"/>
                    </form>
                </div>
HTML;
        return $html;
    }



    /**
     * Retrieves an ID for the form for a calendar form element that is being output to HTML. Auto-increments the
     * local static variable self::$formID
     * @return int
     */
    private function getNextFormID(){
        $id = self::$formID;
        self::$formID++;
        return constant("self::formIDPrefix") . $id;
    }
}