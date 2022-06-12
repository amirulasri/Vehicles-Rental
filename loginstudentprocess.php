<?php
require_once('conn.php');
session_start();

if (!empty($_POST['ic']) && !empty($_POST['pwd'])) {
    $ic = $_POST['ic'];
    $pwd = $_POST['pwd'];
    $querygetlogin = mysqli_query($conn, "SELECT icstudent, studentpass FROM student WHERE icstudent='$ic' AND studentpass='$pwd'");
    if (mysqli_num_rows($querygetlogin) > 0) {
        $_SESSION['customer'] = $ic;
        header('location: vehiclelist.php');
    } else {
        die(header('location: login.php?log=1')); //ERROR MESSAGE TO LOGIN PAGE
    }
}
