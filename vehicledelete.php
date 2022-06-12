<?php
include('conn.php');
session_start();
if (!isset($_SESSION['admin'])) {
    die(header('location: login'));
}
if(isset($_GET['idvehicle'])){
    $adminuser = $_SESSION['admin'];
    $idvehicle = $_GET['idvehicle'];
    $querydeletevehicle = mysqli_query($conn, "DELETE FROM `vehicles` WHERE idvehicle='$idvehicle' AND adminuser='$adminuser'");
    if($querydeletevehicle){
        header('location: vehiclemanager.php');
    }else{
        echo "<script>alert('Failed to delete vehicle. MySQL ERROR CODE: ".mysqli_errno($conn)."')</script>";
    }
}else{
    header('location: studentdetail.php');
}