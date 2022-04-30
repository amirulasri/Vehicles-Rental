<?php
$host = "localhost";
$dbusername = "skproject";
$dbpass = "P]8zn5>'5@VQZS4u";
$dbname = "carrental";

$conn = mysqli_connect($host, $dbusername, $dbpass, $dbname);
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
