<?php
include('conn.php');
session_start();
if (!isset($_SESSION['admin'])) {
    die(header('location: login'));
}
if (isset($_POST['submitvehicle'])) {

    $adminuser = $_SESSION['admin'];

    $vehiclemodel = $_POST['vehiclemodel'];
    $plateno = $_POST['plateno'];
    $color = $_POST['color'];
    $priceperhour = $_POST['priceperhour'];
    $type = $_POST['type'];

    $image = $_FILES['vehiclepicture']['name'];
    $temp_name = $_FILES["vehiclepicture"]["tmp_name"];
    $file_ext = strtolower(end(explode('.', $_FILES['vehiclepicture']['name'])));
    $file_size = $_FILES['vehiclepicture']['size'];
    $expensions = array("jpeg", "jpg", "png", "gif");
    if (in_array($file_ext, $expensions) === false) {
        $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
        die("<script>alert('Extension not allowed, please choose a JPEG or PNG file.'); window.location='vehiclemanager.php'</script>");
    }

    if ($file_size > 2097152) {
        $errors[] = 'File size must be excately 2 MB';
        die("<script>alert('Vehicle picture size must below 2MB'); window.location='vehiclemanager.php'</script>");
    }

    if (empty($errors) == true) {
        //CONTINUE TO ADD CAR TO DATABASE
        $queryaddcar = mysqli_query($conn, "INSERT INTO `vehicles`(`idvehicle`, `plateno`, `model`, `color`, `type`, `priceperhour`, `imagepath`, `adminuser`) VALUES (NULL,'$plateno','$vehiclemodel','$color','$type','$priceperhour','','$adminuser')");
        if($queryaddcar){
            $lastvehicleid = mysqli_insert_id($conn);
            $newimagename = $image."-$type-".$lastvehicleid;
            $queryupdateimagepath = mysqli_query($conn, "UPDATE `vehicles` SET imagepath = 'uploadedimg/$newimagename' WHERE idvehicle='$lastvehicleid'");
            move_uploaded_file($temp_name, "uploadedimg/" . $newimagename);
            header('location: vehiclemanager.php');
        }else{
            echo "<script>alert('Failed to insert vehicle data. MySQL ERROR CODE: ".mysqli_errno($conn)."'); window.location='vehiclemanager.php';</script>";
        }
        
    } else {
        print_r($errors);
    }
}
