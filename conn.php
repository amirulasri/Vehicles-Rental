<?php
$host = "localhost";
$dbusername = "sabrina";
$dbpass = "sabrina1104";
$dbname = "carrental";

$conn = mysqli_connect($host, $dbusername, $dbpass, $dbname);
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
