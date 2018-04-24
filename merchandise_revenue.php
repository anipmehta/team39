#!/usr/local/bin/php
<?php
/**
 * Created by PhpStorm.
 * User: Chuan
 * Date: 4/23/2018
 * Time: 8:29 PM
 */
include("config.php");
include("fusioncharts.php");
session_start();
$xLabel = "Month(in numbers)";
$yLabel = "Total Sales";
$labelGraph = "Sales trends of last year";
echo $_SESSION['userId'];
$queryString = 'select * from(
                    select transaction_month, sum(quantity) total_quantity
                    from trans,item
                    where TRANS.ITEM_STOCK_CODE=ITEM.STOCK_CODE and  item_stock_code =\''.$_SESSION['userId'].'\'
                    group by transaction_year,transaction_month
                    order by transaction_year, CAST(transaction_month AS INT))
                    where rownum<13';
$query = oci_parse($conn, $queryString);
$execute = oci_execute($query);
if (!$execute) {
    $e = oci_error($query);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
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
    <link  rel="stylesheet" type="text/css" href="css/style.css" />
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
    <script src="js/fusioncharts.js"></script>
    <style>
        .custom-select {
            position: relative;
            font-family: Arial;
        }
        .custom-select select {
            display: none; /*hide original SELECT element:*/
        }
        .select-selected {
            background-color: DodgerBlue;
        }
        /*style the arrow inside the select element:*/
        .select-selected:after {
            position: absolute;
            content: "";
            top: 14px;
            right: 10px;
            width: 0;
            height: 0;
            border: 6px solid transparent;
            border-color: #fff transparent transparent transparent;
        }
        /*point the arrow upwards when the select box is open (active):*/
        .select-selected.select-arrow-active:after {
            border-color: transparent transparent #fff transparent;
            top: 7px;
        }
        /*style the items (options), including the selected item:*/
        .select-items div,.select-selected {
            color: #ffffff;
            padding: 8px 16px;
            border: 1px solid transparent;
            border-color: transparent transparent rgba(0, 0, 0, 0.1) transparent;
            cursor: pointer;
            user-select: none;
        }
        /*style items (options):*/
        .select-items {
            position: absolute;
            background-color: DodgerBlue;
            top: 100%;
            left: 0;
            right: 0;
            z-index: 99;
        }
        /*hide the items when the select box is closed:*/
        .select-hide {
            display: none;
        }
        .select-items div:hover {
            background-color: rgba(0, 0, 0, 0.1);
        }
        * {
            box-sizing: border-box;
        }

        /* Style the search field */
        form.example input[type=text] {
            padding: 10px;
            font-size: 17px;
            border: 1px solid grey;
            float: left;
            width: 80%;
            background: #f1f1f1;
        }

        /* Style the submit button */
        form.example button {
            float: left;
            width: 20%;
            padding: 10px;
            background: #2196F3;
            color: white;
            font-size: 17px;
            border: 1px solid grey;
            border-left: none; /* Prevent double borders */
            cursor: pointer;
        }

        form.example button:hover {
            background: #0b7dda;
        }

        /* Clear floats */
        form.example::after {
            content: "";
            clear: both;
            display: table;
        }
        .dropbtn {
            background-color: #4CAF50;
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .dropbtn:hover, .dropbtn:focus {
            background-color: #3e8e41;
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
                            <li class="active"><a href="merchandise.php">home</a></li>

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

<section class="team-area padding-100-70" id="team">
    <div class="container">
        <div class="row">


            <div class="col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2 col-sm-12 col-xs-12">
                <center>
                <h3>Revenue for<br>last year</h3>
                </center>
            </div><br><br>
                 <?php

                    // Form the SQL query that returns the top 10 most populous countries


                    // If the query returns a valid response, prepare the JSON string

                    // The `$arrData` array holds the chart attributes and data
                    $arrData = array(
                        "chart" => array(
                            "caption" => $labelGraph,
                            "showValues"=> "0",
                            "xaxisname" => $xLabel,
                            "yaxisname" =>  $yLabel,
                            "theme"=> "ocean"
                        )
                    );

                    $arrData["data"] = array();
                 while (($row = oci_fetch_array($query, OCI_BOTH)) != false){
                 //        echo $row[0];
                     array_push($arrData["data"], array(
                             "label" => $row[0],
                             "value" => $row[1],
//                "link" => "countryDrillDown.php?Country=".$row["Code"]
                         )
                     );
                 }
                 $jsonEncodedData = json_encode($arrData);

                 /*Create an object for the column chart. Initialize this object using the FusionCharts PHP class constructor. The constructor is used to initialize the chart type, chart id, width, height, the div id of the chart container, the data format, and the data source. */

                 $columnChart = new FusionCharts("column2D", "myFirstChart" , 600, 300, "chart-1", "json", $jsonEncodedData);

                 // Render the chart
                 $columnChart->render();

                 // Close the database connection
                 oci_free_statement($query);
                 oci_close($conn);

                 ?>
            <br><br>
            <center>
            <div id="chart-1">
<!--                select * from(
                    select transaction_month, sum(quantity) total_quantity
                    from trans,item
                    where TRANS.ITEM_STOCK_CODE=ITEM.STOCK_CODE and  item_stock_code ='22423'
                    group by transaction_year,transaction_month
                    order by transaction_year, CAST(transaction_month AS INT))
                    where rownum<13;
                    -->
            </div>
            </center>
        </div>
    </div>
</section>



</body>

</html>



