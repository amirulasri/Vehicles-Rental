<?php
include('conn.php');
session_start();
if (!isset($_SESSION['admin'])) {
    die(header('location: login'));
}
if (isset($_POST['submitvehicle']) && isset($_SESSION['vehicletempidupdate']) && isset($_SESSION['vehicleimgpathtemp'])) {
    $idvehicle = $_SESSION['vehicletempidupdate'];
    $oldimagefile = $_SESSION['vehicleimgpathtemp'];
    $adminuser = $_SESSION['admin'];

    //UNSET TEMP SESSION
    unset($_SESSION['vehicletempidupdate']);
    unset($_SESSION['vehicleimgpathtemp']);

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

    if ($file_size > 5097152) {
        $errors[] = 'File size must be excately 5 MB';
        die("<script>alert('Vehicle picture size must below 5MB'); window.location='vehiclemanager.php'</script>");
    }

    if (empty($errors) == true) {
        //CONTINUE TO EDIT CAR TO DATABASE
        $newimagename = $type.'-'.$idvehicle.'-'.$image;
        $queryaddcar = mysqli_query($conn, "UPDATE `vehicles` SET `plateno`='$plateno', `model`='$vehiclemodel', `color`='$color', `type`='$type', `priceperhour`='$priceperhour', `imagepath`='uploadedimg/$newimagename' WHERE idvehicle='$idvehicle' AND adminuser='$adminuser'");
        if($queryaddcar){
            unlink($oldimagefile);
            move_uploaded_file($temp_name, "uploadedimg/" . $newimagename);
            header('location: vehiclemanager.php');
        }else{
            echo "<script>alert('Failed to update vehicle data. MySQL ERROR CODE: ".mysqli_errno($conn)."'); window.location='vehiclemanager.php';</script>";
        }
        
    } else {
        print_r($errors);
    }
}
