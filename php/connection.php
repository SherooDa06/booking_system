<?php

// This file is required for PHP to connect to the SQL server

$username = "enterusernamehere";
$password = "enterpasswordhere";
$serverName = "localhost";
$dbName = "tutor_booking";

$connection = mysqli_connect($serverName, $username, $password, $dbName);
if(!$connection) die ("Unable to connect do SQL: ");

?>