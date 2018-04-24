#!/usr/local/bin/php
<?php
/**
 * Created by PhpStorm.
 * User: Chuan
 * Date: 4/14/2018
 * Time: 12:39 PM
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



</head>

<body data-spy="scroll" data-target=".mainmenu-area" data-offset="90">


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


            <div class="col-md-6 col-lg-4 col-sm-6 col-xs-6">
                <div class="single-service text-center wow fadeIn">
                    <div class="service-icon">
                        <div class="i fa fa-search"></div>
                    </div>
                    <h3>Search</h3>
                    <p>Look up anything</p>
                    <a href="admin_search.php" class="read-more">View</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 col-sm-6 col-xs-6">
                <div class="single-service text-center wow fadeIn">
                    <div class="service-icon">
                        <div class="i fa fa-plus-circle"></div>
                    </div>
                    <h3>Add</h3>
                    <p>Add new entry</p>
                    <a href="admin_add.php" class="read-more">View</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 col-sm-6 col-xs-6">
                <div class="single-service text-center wow fadeIn">
                    <div class="service-icon">
                        <div class="i fa fa-bar-chart"></div>
                    </div>
                    <h3>Sales Trends</h3>
                    <p>Look what was most selling, and what did not sell alot</p>
                    <a href="admin_trends.php" class="read-more">View</a>
                </div>
            </div>

        </div>
    </div>
</section>
<!--SERVICE TOP AREA END-->


</body>

</html>

