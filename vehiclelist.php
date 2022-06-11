<?php
include('conn.php');
session_start();
if (!isset($_SESSION['customer'])) {
    die("NO SESSION");
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
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <script src="jquery/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
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
                                <a class="nav-link" aria-current="page" href="#">Home</a>
                            </li>
                            <li class="nav-item spacers">
                                <a class="nav-link active" href="#">Info</a>
                            </li>
                            <li class="nav-item spacers">
                                <a class="nav-link" href="booking.php">Booking</a>
                            </li>
                            <li class="nav-item spacers">
                                <a class="nav-link" href="login.php">Login</a>
                            </li>

                            <li class="nav-item">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="uppershape"></div>
            <br><br><br><br><br><br>
            <h1 class="titlecenter">VEHICLES</h1><br>
            <div class="container">
                <div class="carcentercatalog">
                    <?php
                    $querygetlistcar = mysqli_query($conn, "SELECT * FROM vehicles ORDER BY idvehicle DESC");
                    while ($getcardata = mysqli_fetch_array($querygetlistcar)) {
                    ?>
                        <div class="carcatelog" onclick="carmodalopener(<?php echo $getcardata['idvehicle'] ?>)">
                            <div class="carcontent">
                                <img class="carimg" src="<?php echo $getcardata['imagepath'] ?>" alt=""><br><br>
                                <h5><?php echo $getcardata['model'] ?></h5>
                                <div class="cardetail">
                                    <p style="margin: 0;">Plate No: <?php echo $getcardata['plateno'] ?> <br> Color: <?php echo $getcardata['color']; ?> <br> Type: <?php echo $getcardata['type'] ?></p>
                                    <?php
                                    //CHECK IF VEHICLE IN USE
                                    $plateno = $getcardata['plateno'];
                                    $querycheckavailable = mysqli_query($conn, "SELECT COUNT(plateno) FROM booking WHERE plateno='$plateno'");
                                    $bookcount = mysqli_fetch_array($querycheckavailable)[0];
                                    if($bookcount == 0){
                                        echo '<span class="badge rounded-pill bg-success">Available</span>';
                                    }else{
                                        $querygetlastrecord = mysqli_query($conn, "SELECT MAX(bookid) FROM booking WHERE plateno='$plateno'");
                                        echo '<span class="badge rounded-pill bg-danger">In Use</span>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="pricedisplayouter">
                                <div class="pricedisplay">
                                    <div><strong>RM <?php echo $getcardata['priceperhour'] ?> / hr</strong></div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Car SELCTOR-->
    <div class="modal fade" id="carmodalselctor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Vehicle Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="carmodalcontent">
                </div>
            </div>
        </div>
    </div>

    <script>
        var carmodalselctor = new bootstrap.Modal(document.getElementById('carmodalselctor'), {
            keyboard: false
        })

        function carmodalopener(carid) {
            if (carid.length == 0) {
                document.getElementById("carmodalcontent").innerHTML = "";
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("carmodalcontent").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "ajaxmodalcarselect.php?carid=" + carid, true);
                xmlhttp.send();
            }
            carmodalselctor.toggle();
        }
    </script>

    <script src="jquery/jquery.js"></script>
    <script src="js/popper.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>