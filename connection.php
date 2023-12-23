<?php

$host = "localhost";
$username = "root";
$password = "";
$dbname = "guests_db";

$con = mysqli_connect($host, $username, $password, $dbname);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>
