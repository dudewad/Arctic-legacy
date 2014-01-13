<?php
/**
 * Author: Ghost
 * Date: 1/12/14
 */

define("BASEDIR", __DIR__ . "/../../");
require_once(BASEDIR . "/include/script/Autoloader.php");
require_once(BASEDIR . "/include/script/IOCRegistration.php");

$generator = new Test_ObjectGenerator();

$location = $generator->getRandomLocation();
var_dump($location);

$countryName = $location->getCountry();
$stateName = $location->getState();
$cityName = $location->getCity();
$zip = $location->getZip();
$streetAddress = $location->getAddress();
$placeName = $location->getName();


$c = mysql_connect("localhost","tanguer_admin","Tanguero1");
mysql_select_db("tanguer",$c);

$countryQuery = "INSERT INTO v_country SET country_name = '$countryName'";
$stateQuery = "INSERT INTO v_state SET state_name = '$stateName'";
$cityQuery = "INSERT INTO v_city SET city_name = '$cityName'";
$zipQuery = "INSERT INTO v_zip SET zip = '$zip'";
$streetAddressQuery = "INSERT INTO v_street_address SET street_address = '$streetAddress'";
$placeNameQuery = "INSERT INTO v_place_name SET place_name = '$placeName'";


//Insert Country
$q = mysql_query($countryQuery);
$countryID = mysql_insert_id();
if($countryID === 0){
    $q = mysql_query("SELECT country_id FROM v_country WHERE country_name = '$countryName'");
    if(mysql_errno()){
        exit("failed at country query");
    }
    $obj = mysql_fetch_object($q);
    $countryID = $obj->country_id;
}

//Insert State
$q = mysql_query($stateQuery);
$stateID = mysql_insert_id();
if($stateID === 0){
    $q = mysql_query("SELECT state_id FROM v_state WHERE state_name = '$stateName'");
    if(mysql_errno()){
        exit("failed at state query");
    }
    $obj = mysql_fetch_object($q);
    $stateID = $obj->state_id;
}

// Insert city
$q = mysql_query($cityQuery);
$cityID = mysql_insert_id();
if($cityID === 0){
    $q = mysql_query("SELECT city_id FROM v_city WHERE city_name = '$cityName'");
    if(mysql_errno()){
        exit("failed at city query");
    }
    $obj = mysql_fetch_object($q);
    $cityID = $obj->city_id;
}

// Insert street address
$q = mysql_query($streetAddressQuery);
$streetAddressID = mysql_insert_id();
if($streetAddressID === 0){
    $q = mysql_query("SELECT street_address_id FROM v_street_address WHERE street_address = '$streetAddress'");
    if(mysql_errno()){
        exit("failed at street address query");
    }
    $obj = mysql_fetch_object($q);
    $streetAddressID = $obj->street_address_id;
}

// Insert zip
$q = mysql_query($zipQuery);
$zipID = mysql_insert_id();
if($zipID === 0){
    $q = mysql_query("SELECT zip_id FROM v_zip WHERE zip = '$zip'");
    if(mysql_errno()){
        exit("failed at zip query");
    }
    $obj = mysql_fetch_object($q);
    $zipID = $obj->zip;
}

// Insert place name
$q = mysql_query($placeNameQuery);
$placeNameID = mysql_insert_id();
if($placeNameID === 0){
    $q = mysql_query("SELECT place_name_id FROM v_place_name WHERE place_name = '$placeName'");
    if(mysql_errno()){
        exit("failed at place name query");
    }
    $obj = mysql_fetch_object($q);
    $placeNameID = $obj->place_name_id;
}


//Build location based off the new location
$locationQuery = "INSERT INTO location SET place_name_id = '$placeNameID', country_id = '$countryID', state_id = '$stateID', city_id  = '$cityID', street_address_id = '$streetAddressID', zip_id = '$zipID'";
$q = mysql_query($locationQuery);
$locationID = mysql_insert_id();
if($locationID === 0){
    $q = mysql_query("SELECT location_id FROM location WHERE place_name_id = '$placeNameID' && country_id = '$countryID' && state_id = '$stateID' && city_id  = '$cityID' && street_addres_id = '$streetAddressID' && zip_id = '$zipID'");
    if(mysql_errno()){
        exit("failed at location query");
    }
    $obj = mysql_fetch_object($q);
    $locationID = $obj->location_id;
}
$locationQuery = "SELECT
                        location.location_id,
                        v_place_name.place_name,
                        v_street_address.street_address,
                        v_city.city_name,
                        v_state.state_name,
                        v_country.country_name,
                        v_zip.zip
                    FROM
                        location,
                        v_place_name,
                        v_street_address,
                        v_city,
                        v_state,
                        v_country,
                        v_zip
                    WHERE
                        location.location_id = '14' &&
                        location.place_name_id = v_place_name.place_name_id &&
                        location.street_address_id = v_street_address.street_address_id &&
                        location.city_id = v_city.city_id &&
                        location.state_id = v_state.state_id &&
                        location.country_id = v_country.country_id &&
                        location.zip_id = v_zip.zip_id;";
echo $locationQuery;
$result = mysql_query($locationQuery);
$locationData = mysql_fetch_object($result);



echo "Country ID: $countryID<br />";
echo "State ID: $stateID<br />";
echo "City ID: $cityID<br />";
echo "Street Address ID: $streetAddressID<br />";
echo "Zip ID: $zipID<br />";
echo "Place Name ID: $placeNameID<br />";
echo "Newly inserted/selected DB location listed below:";
var_dump($locationData);

/*

$fn = $p->getFirstName();
$ln = $p->getLastName();
$personQuery = "INSERT INTO person SET first_name = '$fn', last_name = '$ln'";
mysql_query($personQuery);

*/