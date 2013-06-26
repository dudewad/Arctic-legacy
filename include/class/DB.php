<?php

class DB
{
    /**
     * @param $target           Associative Array    Required    An associative array of connection data divided into:
     *                          ["host"]     - The MySQL host address
     *                          ["user"]     - The user name for the DB
     *                          ["password"] - The password for the DB
     *                          ["name"]     - The name of the DB to connect to on the supplied host
     *
     * @return mysqli object    The actual connection object
     */
    function connection($target){
		//Connection vars
		$mysqli = mysqli_connect($target["host"], $target["user"], $target["password"], $target["name"]);
        if(mysqli_connect_errno($mysqli))
            return "DB connection failed: " . mysqli_connect_error();

		return $mysqli;
	} // end function connection();
}