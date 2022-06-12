<?php
require_once('conn.php');
session_start();

if(!empty($_POST['username']) && !empty($_POST['pwd'])){
    $username = $_POST['username'];
    $pwd = $_POST['pwd'];
    $querygetlogin = mysqli_query($conn, "SELECT adminuser, adminpass FROM admin WHERE adminuser='$username'");
    if(mysqli_num_rows($querygetlogin)){
        $getlogindata = mysqli_fetch_array($querygetlogin);
        $pwddb = $getlogindata['adminpass'];

        if(password_verify($pwd, $pwddb)){
            $_SESSION['admin'] = $username;
            header('location: studentdetail.php');
        }
    }else{
        die(header('location: loginadmin.php?log=1'));//ERROR MESSAGE TO LOGIN PAGE
    }
}