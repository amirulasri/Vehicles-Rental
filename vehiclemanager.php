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
                                <a class="nav-link" aria-current="page" href="studentdetail.php">Detail</a>
                            </li>
                            <li class="nav-item spacers">
                                <a class="nav-link" href="searching.php">Search</a>
                            </li>
                            <li class="nav-item spacers">
                                <a class="nav-link active" href="#">Manage Vehicle</a>
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
                <h2>Manage Vehicle</h2>
                <div class="container">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modaladdvehicle">Add New Vehicle +</button><br><br>
                    <table border="1" width="80%" align="center" class="table table-bordered">
                        <tr style="background-color:#142e59; color:white ;font-weight: bolder; text-align:center">
                            <td></td>
                            <td> PLATE NUMBER </td>
                            <td> MODEL </td>
                            <td> COLOR </td>
                            <td> TYPE VEHICLE </td>
                            <td> PRICE PER HOUR </td>
                            <td> Manage </td>
                        </tr>
                        <?php
                        $queryvehicle = mysqli_query($conn, "SELECT * FROM `vehicles`");
                        while ($getvehicledata = mysqli_fetch_array($queryvehicle)) {
                        ?>
                            <tr>
                                <td><img class="vehicleimgadmin" src="<?php echo $getvehicledata['imagepath'] ?>" alt=""></td>
                                <td><?php echo $getvehicledata['plateno'] ?></td>
                                <td><?php echo $getvehicledata['model'] ?></td>
                                <td><?php echo $getvehicledata['color'] ?></td>
                                <td><?php echo $getvehicledata['type'] ?></td>
                                <td>RM <?php echo $getvehicledata['priceperhour'] ?></td>
                                <td><button class="btn btn-primary">Edit</button> <button class="btn btn-danger">Delete</button></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </center>
        </div>
    </div>
    <!-- MODAL ADD VEHICLE -->
    <div class="modal fade" id="modaladdvehicle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new vehicle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addvehicleform" action="vehicleaddprocess.php" enctype="multipart/form-data" method="POST">
                        <div class="mb-3">
                            <label for="vehiclepicture" class="form-label">Vehicle picture</label>
                            <input class="form-control" type="file" id="vehiclepicture" name="vehiclepicture" required>
                        </div>
                        <div class="mb-3">
                            <label for="vehiclemodel" class="form-label">Vehicle Model/Name</label>
                            <input type="text" name="vehiclemodel" class="form-control" id="vehiclemodel" required>
                        </div>
                        <div class="mb-3">
                            <label for="vehiclemodel" class="form-label">Vehicle Type</label>
                            <select name="type" id="type" class="form-control" required>
                                <option value="">Choose Type</option>
                                <option value="Car">Car</option>
                                <option value="Motocycle">Motocycle</option>
                                <option value="Bicycle">Bicycle</option>
                                <option value="Scooter">Scooter</option>
                                <option value="Other">Others</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="plateno" class="form-label">Plate number</label>
                            <input type="text" name="plateno" class="form-control" id="plateno" required>
                        </div>
                        <div class="mb-3">
                            <label for="color" class="form-label">Color</label>
                            <input type="text" name="color" class="form-control" id="color" required>
                        </div>
                        <div class="mb-3">
                            <label for="priceperhour" class="form-label">Price Per Hour</label>
                            <input type="number" name="priceperhour" class="form-control" id="priceperhour" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="submitvehicle" form="addvehicleform" class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>
    </div>
    <script src="jquery/jquery.js"></script>
    <script src="js/popper.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>