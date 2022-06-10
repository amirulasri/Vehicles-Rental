<?php
include('conn.php');
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

        .navbar{
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
                                <a class="nav-link active" aria-current="page" href="#">Home</a>
                            </li>
                            <li class="nav-item spacers">
                                <a class="nav-link" href="#">Info</a>
                            </li>
                            <li class="nav-item spacers">
                                <a class="nav-link" href="booking.php">Booking</a>
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
            <div class="innershape1">
                <div class="homeshape1">
                </div>
            </div>
            <div class="innershape2">
                <div class="homeshape2">
                </div>
            </div>
            <div class="picture1pos">
                <img class="imageintro" src="car2.png" alt="" srcset="" width="800">
            </div>
            <h2 class="hometitlepos">Vehicles Rental System</h2>
            <div class="container">
                <div class="formreg">
                    <form action="registerprocess">
                        <h1>Register & Order Now</h1>
                        <div class="row row-cols-2">
                            <div class="col">
                                <label for="">IC Number</label>
                                <input type="text" name="icnumber" id="" class="form-control">
                            </div>
                            <div class="col">
                                <label for="">Password</label>
                                <input type="password" name="studpassword" id="" class="form-control">
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col">
                                <label for="">Email Address</label>
                                <input type="email" name="studaddress" id="" class="form-control"><br>
                                <label for="">Full Name</label>
                                <input type="text" name="studname" id="" class="form-control"><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="">License</label>
                                <input type="license" name="studaddress" id="" class="from-control"><br>
                                
                            </div>
                            <div class="col">
                                <label for="">Phone Number </label>
                                <input type="phone" name="studaddress" id="" class="from-control">
                                
                            </div>

                        </div>

                        <div class="row"><br>
                            <div class="col"><br>
                                <input type="submit" value="SUBMIT" />
                            </div>
                    
                        </div>
                        <br>
                        
                    </form>
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