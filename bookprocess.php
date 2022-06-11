<?php
include('conn.php');
session_start();
if (!isset($_SESSION['customer'])) {
    die("NO SESSION");
    //die(header('location: login'));
}
if(isset($_POST['booksubmit'])){
    $plateno = $_POST['plateno'];
    $startdate = $_POST['datestart'];
    $hours = $_POST['hour'];
    $icstudent = $_SESSION['customer'];

    //GET VEHICLE ADMIN
    $querygetlistvehicle = mysqli_query($conn, "SELECT * FROM vehicles WHERE plateno='$plateno'");
    $getvehicledata = mysqli_fetch_array($querygetlistvehicle);
    $adminvehiclemanager = $getvehicledata['adminuser'];

    $queryinsertbook = mysqli_query($conn, "INSERT INTO `booking`(`idbook`, `bookdate`, `hour`, `icstudent`, `plateno`, `adminuser`) VALUES (NULL,'$startdate','$hours','$icstudent','$plateno','$adminvehiclemanager')");
    if($queryinsertbook){
        $lastid = mysqli_insert_id($conn);
        header('location: vehiclelist.php?book='.$lastid);
    }else{
        echo "<script>alert('BOOK ERROR. MySQL ERROR CODE: ".mysqli_errno($conn)."')</script>";
    }
}