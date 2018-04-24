#!/usr/local/bin/php
<?php
/**
 * Created by PhpStorm.
 * User: Chuan
 * Date: 4/23/2018
 * Time: 6:58 PM
 */
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <!--====== USEFULL META ======-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Creative Portfolio & Agency Template is a simple Smooth Personal Portfolio and Agency Based Template" />
    <meta name="keywords" content="Personal, Portfolio, Agency, Onepage, Html, Business" />

    <!--====== TITLE TAG ======-->
    <title>SalesPro</title>

    <!--====== FAVICON ICON =======-->


    <!--====== STYLESHEETS ======-->
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/stellarnav.min.css">
    <link rel="stylesheet" href="css/progressbar.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--====== MAIN STYLESHEETS ======-->
    <link href="style.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">

    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        .dropbtn {
            background-color: #1aa3ff;
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .dropbtn:hover, .dropbtn:focus {
            background-color: #004d80;
        }

        #myInput {
            border-box: box-sizing;
            background-image: url('searchicon.png');
            background-position: 14px 12px;
            background-repeat: no-repeat;
            font-size: 16px;
            padding: 14px 20px 12px 45px;
            border: none;
            border-bottom: 1px solid #ddd;
        }

        #myInput:focus {outline: 3px solid #ddd;}

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f6f6f6;
            min-width: 230px;
            overflow: auto;
            border: 1px solid #ddd;
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown a:hover {background-color: #ddd}

        .show {display:block;}
    </style>
</head>

<body data-spy="scroll" data-target=".mainmenu-area" data-offset="90">

<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<!--- PRELOADER -->
<div class="preeloader">
    <div class="preloader-spinner"></div>
</div>

<!--SCROLL TO TOP-->
<a href="#home" class="scrolltotop"><i class="fa fa-long-arrow-up"></i></a>

<!--START TOP AREA-->
<header class="top-area" id="home">

    <div class="header-top-area">
        <!--MAINMENU AREA-->
        <div class="mainmenu-area" id="mainmenu-area">
            <div class="mainmenu-area-bg"></div>
            <nav class="navbar">
                <div class="container">
                    <div class="navbar-header">
                        <a href="" class="navbar-brand"><img src="img/logo.png" alt="logo"></a>
                    </div>
                    <div id="main-nav" class="stellarnav">
                        <ul id="nav" class="nav navbar-nav">
                            <li class="active"><a href="">home</a></li>

                            <li><a href="login.php">Log out</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <!--END MAINMENU AREA END-->
    </div>
</header>
<!--END TOP AREA-->



<!--SERVICE TOP AREA-->
<section class="service-top-area padding-100-50" id="features">
    <div class="container">

        <div class="row">
            <!-- The form -->



            <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
                <div class="single-service text-center wow fadeIn">
                    <div class="service-icon">
                        <div class="i fa fa-shopping-cart"></div>
                    </div>
                    <h3>View Orders</h3>
                    <p>Click to view my orders</p>
                    <a href="customer_view.php" class="read-more">View</a>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
                <div class="single-service text-center wow fadeIn">
                    <div class="service-icon">
                        <div class="i fa fa-puzzle-piece"></div>
                    </div>
                    <h3>Suggestions</h3>
                    <p>Items related to your orders, you might like</p>
                    <a href="customer_suggestion.php" class="read-more">Learn More</a>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                <div class="single-service text-center wow fadeIn">
                    <div class="service-icon">
                        <div class="i fa fa-line-chart"></div>
                    </div>
                    <h3>Trending</h3>
                    <p>Look up what people are buying</p>
                    <a href="customer_trending.php" class="read-more">Learn More</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--SERVICE TOP AREA END-->


<!--====== SCRIPTS JS ======-->
<script src="js/vendor/jquery-1.12.4.min.js"></script>
<script src="js/vendor/bootstrap.min.js"></script>

<!--====== PLUGINS JS ======-->
<script src="js/vendor/jquery.easing.1.3.js"></script>
<script src="js/vendor/jquery-migrate-1.2.1.min.js"></script>
<script src="js/vendor/jquery.appear.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/stellar.js"></script>
<script src="js/imagesloaded.pkgd.min.js"></script>
<script src="js/isotope.pkgd.min.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/stellarnav.min.js"></script>
<script src="js/contact-form.js"></script>
<script src="js/jquery.sticky.js"></script>

<!--===== ACTIVE JS=====-->
<script src="js/main.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTS_KEDfHXYBslFTI_qPJIybDP3eceE-A&sensor=false"></script>
<script src="js/maps.active.js"></script>
</body>

</html>

