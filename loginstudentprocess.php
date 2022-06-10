<?php
require_once('conn.php');
session_start();

if(!empty($_POST['ic']) && !empty($_POST['pwd'])){
    $ic = $_POST['ic'];
    $pwd = $_POST['pwd'];
    $querygetlogin = mysqli_query($conn, "SELECT icstudent, studentpass FROM student WHERE icstudent='$ic'");
    if(mysqli_num_rows($querygetlogin)){
        $getlogindata = mysqli_fetch_array($querygetlogin);
        $pwddb = $getlogindata['studentpass'];

        if(password_verify($pwd, $pwddb)){
            $_SESSION['customer'] = $ic;
            header('location: vehiclelist.php');
        }
    }else{
        die(header('location: login.php?log=1'));//ERROR MESSAGE TO LOGIN PAGE
    }
}