<?php
include('conn.php');
session_start();
if (!isset($_SESSION['customer'])) {
    die(header('location: login'));
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Vehicle Rental</title>
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
                                <a class="nav-link" aria-current="page" href="index.php">Home</a>
                            </li>
                            <li class="nav-item spacers">
                                <a class="nav-link active" href="#">Info</a>
                            </li>
                            <li class="nav-item spacers">
                                <a class="nav-link" href="booking.php">Booking</a>
                            </li>
                            <li class="nav-item spacers">
                                <a class="nav-link" href="logout.php">Logout</a>
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
                <div class="vehiclecentercatalog">
                    <?php
                    $querygetlistvehicle = mysqli_query($conn, "SELECT * FROM vehicles ORDER BY idvehicle DESC");
                    while ($getvehicledata = mysqli_fetch_array($querygetlistvehicle)) {
                    ?>
                        <div class="vehiclecatelog" onclick="vehiclemodalopener(<?php echo $getvehicledata['idvehicle'] ?>)">
                            <div class="vehiclecontent">
                                <img class="vehicleimg" src="<?php echo $getvehicledata['imagepath'] ?>" alt=""><br><br>
                                <h5><?php echo $getvehicledata['model'] ?></h5>
                                <div class="vehicledetail">
                                    <p style="margin: 0;">Plate No: <?php echo $getvehicledata['plateno'] ?> <br> Color: <?php echo $getvehicledata['color']; ?> <br> Type: <?php echo $getvehicledata['type'] ?></p>
                                    <?php
                                    //CHECK IF VEHICLE IN USE
                                    $plateno = $getvehicledata['plateno'];
                                    $querycheckavailable = mysqli_query($conn, "SELECT COUNT(plateno) FROM booking WHERE plateno='$plateno'");
                                    $bookcount = mysqli_fetch_array($querycheckavailable)[0];
                                    $datetimenow = date('Y-m-d H:i:s');
                                    if($bookcount == 0){
                                        echo '<span class="badge rounded-pill bg-success">Available</span>';
                                    }else{
                                        $querygetlastrecord = mysqli_query($conn, "SELECT MAX(idbook) FROM booking WHERE plateno='$plateno'");
                                        $lastbookidforvehicle = mysqli_fetch_array($querygetlastrecord)[0];

                                        $querylastbookdata = mysqli_query($conn, "SELECT * FROM booking WHERE idbook = '$lastbookidforvehicle'");
                                        $getlastbookdata = mysqli_fetch_array($querylastbookdata);
                                        $bookstarttime = $getlastbookdata['booktime']; //START DATE TIME
                                        $hour = $getlastbookdata['hour'];
                                        $bookenddate = date('Y-m-d H:i:s', strtotime($bookstarttime. " + $hour hours"));  //END DATE TIME

                                        if(($datetimenow > $bookstarttime) && ($datetimenow < $bookenddate)){
                                            echo '<span class="badge rounded-pill bg-danger">In Use</span>';
                                        }else{
                                            echo '<span class="badge rounded-pill bg-success">Available</span>';
                                        }
                                        
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="pricedisplayouter">
                                <div class="pricedisplay">
                                    <div><strong>RM <?php echo $getvehicledata['priceperhour'] ?> / hr</strong></div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal vehicle SELCTOR-->
    <div class="modal fade" id="vehiclemodalselctor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Vehicle Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="vehiclemodalcontent">
                </div>
            </div>
        </div>
    </div>
    <!-- Modal vehicle RECEIPT-->
    <div class="modal fade" id="vehiclemodalreceipt" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Book History</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="vehiclereceiptcontent">
                </div>
            </div>
        </div>
    </div>

    <script>
        var vehiclemodalselctor = new bootstrap.Modal(document.getElementById('vehiclemodalselctor'), {
            keyboard: false
        })

        var vehiclemodalreceipt = new bootstrap.Modal(document.getElementById('vehiclemodalreceipt'), {
            keyboard: false
        })

        function vehiclemodalopener(vehicleid) {
            if (vehicleid.length == 0) {
                document.getElementById("vehiclemodalcontent").innerHTML = "";
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("vehiclemodalcontent").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "ajaxmodalvehicleselect.php?vehicleid=" + vehicleid, true);
                xmlhttp.send();
            }
            vehiclemodalselctor.toggle();
        }

        <?php
        if(isset($_GET['book'])){
            $idbook = $_GET['book'];
            $querycheckbook = mysqli_query($conn, "SELECT * FROM booking WHERE idbook = '$idbook'");
            if(mysqli_num_rows($querycheckbook) > 0){
                ?>
                vehiclereceiptopener(<?php echo $idbook ?>);
                <?php
            }
        }
        ?>

        function vehiclereceiptopener(idbook) {
            if (idbook.length == 0) {
                document.getElementById("vehiclereceiptcontent").innerHTML = "";
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("vehiclereceiptcontent").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "ajaxmodalbookreceipt.php?book=" + idbook, true);
                xmlhttp.send();
            }
            vehiclemodalreceipt.toggle();
        }
    </script>

    <script src="jquery/jquery.js"></script>
    <script src="js/popper.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>