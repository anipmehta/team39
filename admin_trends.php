#!/usr/local/bin/php
<?php
/**
 * Created by PhpStorm.
 * User: Chuan
 * Date: 4/23/2018
 * Time: 1:46 PM
 */
include("config.php");
include("fusioncharts.php");

$query = null;
$execute = null;
$row = null;
$filter = null;
$search_value =  $_POST['search'];
$filter = $_POST['filter'];
$dataRow = "";
$xLabel = "";
$yLabel = "";
$labelGraph = "";

if($filter=='Days'){
    $labelGraph = 'Top 10 Busiest Days';
    $xLabel = 'Day';
    $yLabel = 'Total Revenue';
    $queryString = 'select * from(
                                 select transaction_year, transaction_month,transaction_day,sum(price*quantity) as revenue
                                 from trans
                                 group by transaction_year, transaction_month,transaction_day
                                 order by sum(price*quantity) DESC)
                                 where rownum<11';
}
elseif($filter == 'Hour'){
    $labelGraph = 'Top 10 Busiest Hours';
    $xLabel = 'Hour';
    $yLabel = 'Total Revenue during that hour';
    $queryString = 'select * from (select transaction_hour, sum(price*quantity) as revenue
                            from trans
                            group by transaction_hour
                            order by sum(price*quantity) DESC ) where rownum < 11';
}

elseif($filter == 'Item'){
    $xLabel = 'Item';
    $yLabel = 'Total Sales';
    $labelGraph = 'Top 10 Highly purchased Item';
    $queryString = 'select *
                                     from(
                                     select item_stock_code, ITEM.name, sum(quantity) total_quantity
                                     from trans,item
                                     where TRANS.ITEM_STOCK_CODE=ITEM.STOCK_CODE
                                     group by item_stock_code,item.name
                                     order by sum(quantity) DESC)
                                     where rownum<11';
}

elseif ($filter == 'Country'){
    $xLabel = 'Country';
    $yLabel = 'Total Revenue';
    $labelGraph = 'Sales Analysis on the basis of Country';
    $queryString = 'select *
    from (select country.name, sum(price*quantity) as revenue
from trans,person,country
where trans.user_id=person.user_id and person.country_name=country.name
group by country.name
order by sum(price*quantity) DESC)';
}
$query = oci_parse($conn, $queryString);
$execute = oci_execute($query);
if (!$execute) {
    $e = oci_error($query);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
?>
<!--<html xmlns="http://www.w3.org/1999/html">-->
<!--<head>-->
<!--    <title>FusionCharts XT - Column 2D Chart - Data from a database</title>-->
<!--    <link  rel="stylesheet" type="text/css" href="css/style.css" />-->
<!---->
<!--    <!--  Include the `fusioncharts.js` file. This file is needed to render the chart. Ensure that the path to this JS file is correct. Otherwise, it may lead to JavaScript errors. -->-->
<!---->
<!--    <script src="js/fusioncharts.js"></script>-->
<!--</head>-->
<!--<body>-->

<!--<center><div id="chart-1"><!-- Fusion Charts will render here--></div></center>-->
<!--</body>-->
<!--</html>-->
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
                            <li class="active"><a href="admin.php">home</a></li>

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
                    <form class="example" action="admin_trends.php" method="post">
                        <center>
                            <p>
                                <input class="w3-radio" type="radio" name="filter" value="Days" checked>
                                <label>Busiest Days</label>
                                <!-- select * from(
                                 select transaction_year, transaction_month,transaction_day,sum(price*quantity) as revenue
                                 from trans
                                 group by transaction_year, transaction_month,transaction_day
                                 order by sum(price*quantity) DESC)
                                 where rownum<11; -->
                                &nbsp;&nbsp;
                                <input class="w3-radio" type="radio" name="filter" value="Hour">
                                <label>Busiest Hours</label>
                                <!-- select * from (select transaction_hour, sum(price*quantity) as revenue
                                 from trans
                                 group by transaction_hour
                                 order by sum(price*quantity) DESC ) where rownum < 11;-->
                                &nbsp;&nbsp;
                                <input class="w3-radio" type="radio" name="filter" value="Item" >
                                <label>Items in demand</label>
                                &nbsp;&nbsp;
                                <!-- select *
                                     from(
                                     select item_stock_code, ITEM.name, sum(quantity) total_quantity
                                     from trans,item
                                     where TRANS.ITEM_STOCK_CODE=ITEM.STOCK_CODE
                                     group by item_stock_code,item.name
                                     order by sum(quantity) DESC)
                                     where rownum<11;
                                     -->
                                <input class="w3-radio" type="radio" name="filter" value="Country" >
                                <label>Country-Revenue</label></p>
                            <!--
                             select * from (select country.name, sum(price*quantity) as revenue
                             from trans,person,country
                             where trans.user_id=person.user_id and person.country_name=country.name
                             group by country.name
                             order by sum(price*quantity) DESC) where rownum < 11;
                             -->

                            <!-- <input type="text" placeholder="Search.." name="search"> -->

                            <input type="submit">

                        </center>
                    </form>
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
                    // Push the data into the array

                    while (($row = oci_fetch_array($query, OCI_BOTH)) != false){
//        echo $row[0];
                        if($filter == 'Hour'){
                            array_push($arrData["data"], array(
                                    "label" => $row[0],
                                    "value" => $row[1],
//                "link" => "countryDrillDown.php?Country=".$row["Code"]
                                )
                            );
                        }
                        elseif ($filter == 'Days'){
                            array_push($arrData["data"], array(
                                    "label" => $row[0]."/".$row[1]."/".$row[2],
                                    "value" => $row[3],
//                "link" => "countryDrillDown.php?Country=".$row["Code"]
                                )
                            );
                        }
                        elseif ($filter == 'Item'){
                            array_push($arrData["data"], array(
                                    "label" => $row[1],
                                    "value" => $row[2],
//                "link" => "countryDrillDown.php?Country=".$row["Code"]
                                )
                            );
                        }
                        elseif ($filter == 'Country'){
                            array_push($arrData["data"], array(
                                    "label" => $row[0],
                                    "value" => $row[1],
//                "link" => "countryDrillDown.php?Country=".$row["Code"]
                                )
                            );
                        }

                    }

                    //    /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

                    $jsonEncodedData = json_encode($arrData);

                    /*Create an object for the column chart. Initialize this object using the FusionCharts PHP class constructor. The constructor is used to initialize the chart type, chart id, width, height, the div id of the chart container, the data format, and the data source. */

                    $columnChart = new FusionCharts("column2D", "myFirstChart" , 600, 300, "chart-1", "json", $jsonEncodedData);

                    // Render the chart
                    $columnChart->render();

                    // Close the database connection
                    //oci_free_statement($query);
                    //oci_close($conn);



                    ?>


                    <br><br>
                    <div id="chart-1"><!-- Fusion Charts will render here--></div></center>
                </center>

            </div>
        </div>
    </div>
</section>



<script>
    /* When the user clicks on the button,
    toggle between hiding and showing the dropdown content */

    function clickeddate(){
        document.getElementById("searchfilter").innerHTML = "date";
        document.getElementById("myDropdown").classList.toggle("show");
    }
    function clickedprice(){
        document.getElementById("searchfilter").innerHTML = "price";
        document.getElementById("myDropdown").classList.toggle("show");
    }
    function clickedcounrtry(){
        document.getElementById("searchfilter").innerHTML = "country";
        document.getElementById("myDropdown").classList.toggle("show");
    }
    function clickeditem(){
        document.getElementById("searchfilter").innerHTML = "item";
        document.getElementById("myDropdown").classList.toggle("show");
    }
    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
    }

    function filterFunction() {
        var input, filter, ul, li, a, i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        div = document.getElementById("myDropdown");
        a = div.getElementsByTagName("a");
        for (i = 0; i < a.length; i++) {
            if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
                a[i].style.display = "";
            } else {
                a[i].style.display = "none";
            }
        }
    }
</script>
<script>
    var x, i, j, selElmnt, a, b, c;
    /*look for any elements with the class "custom-select":*/
    x = document.getElementsByClassName("custom-select");
    for (i = 0; i < x.length; i++) {
        selElmnt = x[i].getElementsByTagName("select")[0];
        /*for each element, create a new DIV that will act as the selected item:*/
        a = document.createElement("DIV");
        a.setAttribute("class", "select-selected");
        a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
        x[i].appendChild(a);
        /*for each element, create a new DIV that will contain the option list:*/
        b = document.createElement("DIV");
        b.setAttribute("class", "select-items select-hide");
        for (j = 1; j < selElmnt.length; j++) {
            /*for each option in the original select element,
            create a new DIV that will act as an option item:*/
            c = document.createElement("DIV");
            c.innerHTML = selElmnt.options[j].innerHTML;
            c.addEventListener("click", function(e) {
                /*when an item is clicked, update the original select box,
                and the selected item:*/
                var i, s, h;
                s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                h = this.parentNode.previousSibling;
                for (i = 0; i < s.length; i++) {
                    if (s.options[i].innerHTML == this.innerHTML) {
                        s.selectedIndex = i;
                        h.innerHTML = this.innerHTML;
                        break;
                    }
                }
                h.click();
            });
            b.appendChild(c);
        }
        x[i].appendChild(b);
        a.addEventListener("click", function(e) {
            /*when the select box is clicked, close any other select boxes,
            and open/close the current select box:*/
            e.stopPropagation();
            closeAllSelect(this);
            this.nextSibling.classList.toggle("select-hide");
            this.classList.toggle("select-arrow-active");
        });
    }
    function closeAllSelect(elmnt) {
        /*a function that will close all select boxes in the document,
        except the current select box:*/
        var x, y, i, arrNo = [];
        x = document.getElementsByClassName("select-items");
        y = document.getElementsByClassName("select-selected");
        for (i = 0; i < y.length; i++) {
            if (elmnt == y[i]) {
                arrNo.push(i)
            } else {
                y[i].classList.remove("select-arrow-active");
            }
        }
        for (i = 0; i < x.length; i++) {
            if (arrNo.indexOf(i)) {
                x[i].classList.add("select-hide");
            }
        }
    }
    /*if the user clicks anywhere outside the select box,
    then close all select boxes:*/
    document.addEventListener("click", closeAllSelect);
</script>

</body>

</html>


