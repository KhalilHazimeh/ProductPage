<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logindb";

$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn) {
    die('Database connection failed.');
}


?>