<!DOCTYPE html>
<html>

<head>
    <title>Car Rental</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
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
            <h2 style="margin: 0;">Admin</h2>
            <br>
            <form id="mylogin" name="mylogin" method="post" action="loginadminprocess.php">
                <div class="row">
                    <div class="col">
                        Username :
                        <input type="text" class="form-control" name="username" placeholder="Enter username">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        Password :
                        <input type="password" name="pwd" class="form-control" placeholder="Enter Password">
                    </div>
                </div>
                <div class="row" style="padding-bottom: 5px;">
                    <div class="col" style="text-align: right;"><br>
                        <input type="submit" class="btn btn-primary" value="LOGIN">
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

</body>

</html>