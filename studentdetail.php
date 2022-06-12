<?php
include('conn.php');
session_start();
if (!isset($_SESSION['admin'])) {
    die(header('location: login'));
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Car Rental</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <style>
        a {
            text-decoration: none;
        }

        .spacercard {
            padding: 10px;
            display: inline-block;
        }

        .spacers {
            padding-right: 40px;
        }

        .navbar {
            height: auto;
        }

        body {
            background: url('detail1.png') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            background-size: cover;
            -o-background-size: cover;
        }
    </style>
</head>

<body>

    <div>

        <!-- Page Content  -->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
                <div class="container-fluid">
                    <img src="logoUTeM.png" alt="logo">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item spacers">
                                <a class="nav-link active" aria-current="page" href="#">Detail</a>
                            </li>
                            <li class="nav-item spacers">
                                <a class="nav-link" href="searching.php">Search</a>
                            </li>
                            <li class="nav-item spacers">
                                <a class="nav-link" href="vehiclemanager.php">Manage Vehicle</a>
                            </li>
                            <li class="nav-item spacers">
                                <a class="nav-link" href="logout.php">Log Out</a>
                            </li>

                            <li class="nav-item">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <br><br><br><br><br>
            <center>
                <h2>DETAIL STUDENTS</h2>
                <div class="container">
                    <table border="1" width="80%" align="center" class="table table-bordered">
                        <tr style="background-color:#142e59; color:white ;font-weight: bolder; text-align:center">
                            <td> IC NUMBER </td>
                            <td> PHONE NUMBER </td>
                            <td> LESEN </td>
                            <td> PLATE NUMBER </td>
                            <td> ENTERY DATE </td>
                            <td> TYPE VEHICLE </td>
                            <td> HOUR </td>
                            <td> PRICE </td>
                        </tr>
                        <?php
                        $querybook = mysqli_query($conn, "SELECT * FROM `booking` INNER JOIN `student` ON booking.icstudent=student.icstudent INNER JOIN `vehicles` ON booking.plateno=vehicles.plateno");
                        while ($getbookdata = mysqli_fetch_array($querybook)) {
                            $price = $getbookdata['hour'] * $getbookdata['priceperhour'];
                        ?>
                            <tr>
                                <td><?php echo $getbookdata['icstudent'] ?></td>
                                <td><?php echo $getbookdata['phoneno'] ?></td>
                                <td><?php echo $getbookdata['license'] ?></td>
                                <td><?php echo $getbookdata['plateno'] ?></td>
                                <td><?php echo $getbookdata['booktime'] ?></td>
                                <td><?php echo $getbookdata['type'] ?></td>
                                <td><?php echo $getbookdata['hour'] ?></td>
                                <td>RM <?php echo $price ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </center>
        </div>
    </div>
    <script src="jquery/jquery.js"></script>
    <script src="js/popper.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>