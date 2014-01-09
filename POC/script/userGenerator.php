<?php
/**
 * Author: Ghost
 * Date: 1/5/14
 */

//Requires a number of users
if(!isset($_GET['numUsers'])){
    exit('Error: You must provide the number of users to generate as $_GET["numUsers"]. Exiting.');
}

define("BASEDIR", __DIR__ . "/../../");
require_once(BASEDIR . "/include/script/Autoloader.php");
require_once(BASEDIR . "/include/script/IOCRegistration.php");


$generator = new Test_ObjectGenerator();
$password = Utility_IOC::build("Security_Password");

$emails = array();
$users = array();
$people = array();


for($i = 0; $i < $_GET['numUsers']; $i++){
    $u = $generator->getRandomUser();
    $email = $u->getEmail();
    while(in_array($email, $emails)){
        $u = $generator->getRandomUser();
        $email = $u->getEmail();
    }
    $params = array();
    $params['first_name'] = $u->getFirstName();

    $p = new Person_Person($u);
    array_push($emails, $email);
    array_push($users, $u);
    array_push($people, $p);
}


$c = mysql_connect("localhost","root","");
mysql_select_db("tanguer",$c);

for($i = 0; $i < count($people); $i++){
    $p = $people[$i];
    $u = $users[$i];

    //Create person object, run query
    $fn = $p->getFirstName();
    $ln = $p->getLastName();
    $personQuery = "INSERT INTO person SET first_name = '$fn', last_name = '$ln'";
    mysql_query($personQuery);

    //Create user object from person, run query
    $id = mysql_insert_id();
    $pw = $password->createHash($fn.$ln);
    $email = $u->getEmail();
    $userQuery = "INSERT INTO user SET person_id = '$id', password = '$pw', email = '$email'";
    //echo $userQuery . "<br>";
    //echo $personQuery . "<br>";
    mysql_query($userQuery);


}