<?php
/**
 * Tánguer "main/default" view (Home page)
 * Prepare the view
 */
$viewData = "";
$generator = new Test_ObjectGenerator();
$eventToView = null;
$mainCalID = "mainCal";

$date = TanguerApp::getUserInput("date");
$cal = new Module_Calendar($date);

$numEvents = 8;//rand(4,10);
$eList = array();
$selectedEvent = TanguerApp::getUserInput("eventID");
for($i = 0; $i < $numEvents; $i++){
    array_push($eList, $generator->getSequencedEvent());
    if($eList[$i]->getId() == $selectedEvent)
        $eventToView = $eList[$i];
}

usort($eList, "sortByStartTime");

$locationSelector = new Module_LocationSelector();
$accountCreator = new Module_AccountCreator();
TanguerApp::setModal($accountCreator->to_html_full_create(), "ac-start");

$calPicker = $cal->calendarPickerMonthToHTML($date, date_default_timezone_get());
$locSelector = $locationSelector->to_html_full();
$cal = $cal->to_html_full_day($eList, time(), $eventToView, $mainCalID);



/**
 * Generate the view
 */
$viewData = <<<HTML
    <div class="clearfix">
        $calPicker
        $locSelector
    </div>
    $cal
HTML;



/**
 * Set the view in the App object
 */
TanguerApp::setViewData($viewData);
?>