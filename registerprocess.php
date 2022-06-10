<?php
include('conn.php');
if(isset($_POST['submitregister'])){
    $ic = $_POST['icnumber'];
    $pwd = $_POST['studpassword'];
    $email = $_POST['studemail'];
    $name = $_POST['studname'];
    $license = $_POST['studlicense'];
    $phoneno = $_POST['studphoneno'];

    //ENCRYPT PASSWORD
    $securedpassword = password_hash($pwd, PASSWORD_DEFAULT);

    $queryregister = mysqli_query($conn, "INSERT INTO `student`(`icstudent`, `studentpass`, `name`, `phoneno`, `email`, `license`) VALUES ('$ic','$securedpassword','$name','$phoneno', '$email', '$license')");
    if($queryregister){
        header('location: login.php?log=2');
    }else{
        echo"<script>alert('Registration failed! ERROR DB CODE: ".mysqli_errno($conn)."'); window.location='index'</script>";
    }
}else{
    echo "Wrong Request";
}