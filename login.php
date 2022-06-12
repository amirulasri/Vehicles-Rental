<!DOCTYPE html>
<html>

<head>
    <title>Car Rental</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style/style.css">
    <script src="jquery/jquery.js"></script>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <style>
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

<body><br><br><br><br>
    <div class="kotak_login">
        <div class="kotak-login2">
            <h2 style="margin: 0;">Login</h2>
            <br>
            <?php
            $info = "";
            if (isset($_GET['log'])) {
                $info = $_GET['log'];
            }
            if ($info == 1) {
                echo "<div class='alert alert-danger fade show' role='alert'>
                         Login failed. Try again
                      </div>";
            }
            if ($info == 2) {
                echo "<div class='alert alert-success fade show' role='alert'>
                         Register successfully. Login to continue
                      </div>";
            }
            ?>
            <form id="mylogin" name="mylogin" method="post" action="loginstudentprocess.php">
                <div class="row">
                    <div class="col">
                        IC Number :
                        <input type="text" class="form-control" name="ic" placeholder="Enter IC Number" required>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        Password :
                        <input type="password" name="pwd" class="form-control" placeholder="Enter Password" required>
                    </div>
                </div>
                <div class="row" style="padding-bottom: 5px;">
                    <div class="col" style="text-align: right;"><br>
                        <input type="submit" class="btn btn-primary" value="LOGIN">
                    </div>
                </div>
                <div class="row">
                    <div class="col" style="text-align: left;">
                        <input type="button" onclick="window.location='loginadmin.php'" class="btn btn-primary" value="ADMIN">
                    </div>
                    <div class="col" style="text-align: right;">
                        <input type="button" class="btn btn-primary" onclick="window.location='index.php'" value="REGISTER">
                    </div>
                </div>
                <br>
            </form>
        </div>
    </div>

    <style>
        td {
            padding: 5px;
        }

        .kotak_login {
            margin-top: 100px;
            width: 100%;
            padding: 0 20px;
        }

        .kotak-login2 {
            border-top: 5px solid #00e0dc;
            max-width: 500px;
            margin: 0 auto;
            border-radius: 0.5em;
            background: rgba(176, 176, 176, 0.1);
            padding: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            min-height: 350px;
        }
    </style>
    <script>
        $(".alert").delay(5000).slideUp(200, function() {
            $(this).alert('close');
        });
    </script>

</body>

</html>