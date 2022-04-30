<?php
include('../conn.php');
session_start();
if (!isset($_SESSION['customer'])) {
    //echo "NO SESSION";
    //die(header('location: login'));
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
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <style>
        a {
            text-decoration: none;
        }

        .spacercard {
            padding: 10px;
            display: inline-block;
        }

        .spacers{
            padding-right: 40px;
        }
    </style>
</head>

<body>

    <div class="wrapper d-flex align-items-stretch">

        <!-- Page Content  -->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Vehicles Rental</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item spacers">
                                <a class="nav-link active" aria-current="page" href="#">Home</a>
                            </li>
                            <li class="nav-item spacers">
                                <a class="nav-link" href="#">Link</a>
                            </li>
                            <li class="nav-item dropdown spacers">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Dropdown
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </li>
                            <li class="nav-item spacers">
                                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                            </li>
                            <li class="nav-item">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <br><br><br>
            <h2 class="mb-4 titleposition" id="titles">Vehicles</h2>

            <br>
            <div id="products" class="listproduct">
                <?php
                $queryvehicles = mysqli_query($conn, "SELECT * FROM vehicles ORDER BY idvehicle DESC");
                while($vehicledata = mysqli_fetch_array($queryvehicles)){
                ?>
                <div class="spacercard">
                    <div class="card" style="width: 18rem;">
                        <img src="<?php echo $vehicledata['imagepath'] ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $vehicledata['model'] ?></h5>
                            <p class="card-text">RM <?php echo $vehicledata['priceperhour'] ?> / Hour</p>
                            <a href="#" class="btn btn-primary">Book now</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <script src="../jquery/jquery.js"></script>
    <script src="../js/popper.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>
</body>

</html>