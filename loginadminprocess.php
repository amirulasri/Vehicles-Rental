<?php
require_once('conn.php');
session_start();

if (!empty($_POST['username']) && !empty($_POST['pwd'])) {
    $username = $_POST['username'];
    $pwd = $_POST['pwd'];
    $querygetlogin = mysqli_query($conn, "SELECT adminuser, adminpass FROM admin WHERE adminuser='$username' AND adminpass='$pwd'");
    if (mysqli_num_rows($querygetlogin) > 0) {
        $_SESSION['admin'] = $username;
        header('location: studentdetail.php');
    } else {
        die(header('location: loginadmin.php?log=1')); //ERROR MESSAGE TO LOGIN PAGE
    }
}
