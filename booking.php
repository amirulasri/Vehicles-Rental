<?php
include('conn.php');
session_start();
if (!isset($_SESSION['customer'])) {
    die("NO SESSION");
    //die(header('location: login'));
}
$plateno = "";
$type = "";
if (isset($_GET['plateno']) && isset($_GET['type'])) {
    $plateno = $_GET['plateno'];
    $type = $_GET['type'];

    $queryvehicle = mysqli_query($conn, "SELECT * FROM vehicles WHERE plateno='$plateno'");
    if (mysqli_num_rows($queryvehicle) > 0) {
        $getvehicledata = mysqli_fetch_array($queryvehicle);

        $plateno = $getvehicledata['plateno'];
        $model = $getvehicledata['model'];
        $color = $getvehicledata['color'];
        $type = $getvehicledata['type'];
        $priceperhour = $getvehicledata['priceperhour'];
        $imagepath = $getvehicledata['imagepath'];
        $adminvehiclemanager = $getvehicledata['adminuser'];
    } else {
        die(header('location: booking.php'));
    }
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
    <script src="js/moment.js"></script>
    <script src="jquery/jquery.js"></script>
    <script src="js/popper.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <style>
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
            background: url('loginbg.jpg') no-repeat center center fixed;
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
                                <a class="nav-link" aria-current="page" href="#">Home</a>
                            </li>
                            <li class="nav-item spacers">
                                <a class="nav-link" href="#">Info</a>
                            </li>
                            <li class="nav-item spacers">
                                <a class="nav-link active" href="booking.php">Booking</a>
                            </li>
                            <li class="nav-item spacers">
                                <a class="nav-link" href="#">Log Out</a>
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
                <h1>Booking</h1>
                <hr>
                <form id="bookform" action="bookprocess.php" method="POST">
                    <table>
                        <tr>
                            <td>TYPE VEHICLE : </td>
                            <td>PLATE NUMBER : </td>
                        </tr>
                        <tr>
                            <td><input type="text" class="form-control" value="<?php echo $type ?>" name="vtype" readonly></td>
                            <td><input type="text" value="<?php echo $plateno ?>" name="plateno" class="form-control" readonly></td>
                        </tr>
                        <tr>
                            <td>ENTERY DATE : </td>
                            <td>HOUR : </td>
                        </tr>
                        <tr>
                            <td><input type="date" id="datestart" value="<?php echo date('Y-m-d') ?>" name="datestart" class="form-control"></td>
                            <td><input type="number" onchange="getPrice()" oninput="getPrice()" id="hours" value="1" min="1" name="hour" class="form-control"></td>
                        </tr>
                        <tr>
                            <?php
                            if (isset($_GET['plateno'])) {
                            ?>
                                <td colspan="2" align="right">
                                    <h4 id="pricedisplay">Total: RM<?php echo $priceperhour ?></h4><input type="submit" name="booksubmit" class="btn btn-primary" value="BOOK">
                                </td>
                            <?php } ?>
                        </tr>
                    </table>
                </form>
            </center>
        </div><br>
        <div class="container">
            <?php
            if (!isset($_GET['plateno'])) {
            ?>
                <div class="alert alert-danger" role="alert">
                    To fill this form, choose vehicle from <a href="vehiclelist.php" class="alert-link">list</a>
                </div>
            <?php } ?>
        </div>
    </div>
    <style>
        td {
            padding: 5px;
        }
    </style>
    <script>
        let totalprice = <?php echo $priceperhour ?>;
        let hours = 1;
        let startDate = "<?php echo date('Y-m-d') ?>";
        function getPrice() {
            startDate = document.getElementById("datestart").value;
            hours = document.getElementById("hours").value;
            let endDate = moment(startDate, 'YYYY-MM-DD').add(hours, 'hours').format('HH:mm');

            if (hours.length != 0) {
                var pricecar = <?php echo $priceperhour ?>;
                totalprice = parseInt(hours) * parseFloat(pricecar);
                document.getElementById("pricedisplay").innerHTML = "Total: RM" + totalprice.toFixed(2);
            }
        }

        var vehiclemodalselctor = new bootstrap.Modal(document.getElementById('vehiclemodalselctor'), {
            keyboard: false
        })
    </script>
</body>

</html>