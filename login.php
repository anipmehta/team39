#!/usr/local/bin/php
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login V2</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <style>

        .button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        .button1 {border-radius: 12px;}
        .button1:hover {
            background: #2196F3;
            color: white;
        }
    </style>
    <!--===============================================================================================-->
</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <form class="login100-form validate-form" action="validUser.php" method="post">
					<span class="login100-form-title p-b-26">
						Welcome
					</span>
                <span class="login100-form-title p-b-26">
						Group-39
					</span>

                <div class="wrap-input100 validate-input">
                    <input class="input100" type="text" name="username" placeholder=" Username">

                </div>

                <div class="wrap-input100 validate-input" >

                    <input class="input100" type="password" name="pass" placeholder = "password">

                </div>

                <form class="w3-container w3-card-4">

                    <p>
                        <input class="w3-radio" type="radio" name="user" value="Customer" checked>
                        <label>Customer</label></p>
                    <p>
                        <input class="w3-radio" type="radio" name="user" value="Merchandise">
                        <label>Merchandise</label></p>
                    <p>
                        <input class="w3-radio" type="radio" name="user" value="Admin" >
                        <label>Admin</label></p>
                    <input type="submit" class="button button1" onclick="valid"/>
                </form>
                <center>


                </center>
            </form>
        </div>
    </div>
</div>


<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">


</body>
</html>