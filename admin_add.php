#!/usr/local/bin/php
<?php
/**
 * Created by PhpStorm.
 * User: Chuan
 * Date: 4/22/2018
 * Time: 7:46 PM
 */
$conn = oci_connect($username = 'chuan', $password = 'UNCBiostat2018!', $connection_string = '//oracle.cise.ufl.edu/orcl');

if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
echo "Connected";
//echo $type;
$query = null;
$execute = null;
$row = null;
if(isset($_POST["item"])){
    $id=  $_POST['id'];
    $desc = $_POST['desc'];
    $queryString = 'INSERT INTO ITEM VALUES('.$id.',\''.$desc.'\')';
    echo $queryString;
    $query = oci_parse($conn, $queryString);
    $execute = oci_execute($query);
    if (!$execute) {
        $e = oci_error($query);
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }
}

elseif(isset($_POST["cust"])){
    $id=  $_POST['id'];
    $pass = $_POST['pass'];
    $country = $_POST['country'];
    echo "Entered if";
    $queryString = 'INSERT INTO CUSTOMER VALUES('.$id.','.$pass.')';
    $query = oci_parse($conn, $queryString);
    $execute = oci_execute($query);
    if (!$execute) {
        $e = oci_error($query);
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }
    $updateQuery = 'UPDATE PERSON SET COUNTRY_NAME = \''.$country.'\'WHERE USER_ID='.$id;
    echo $updateQuery;
    $query2 = oci_parse($conn, $updateQuery);
    $execute2 = oci_execute($query2);
    if (!$execute2) {
        $e = oci_error($query2);
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }
}
elseif (isset($_POST["merchand"])){
    $id=  $_POST['id'];
    $pass = $_POST['pass'];
    $country = $_POST['country'];
    $queryString = 'INSERT INTO MERCHANDISE VALUES('.$id.','.$pass.')';
    echo $queryString;
    $query = oci_parse($conn, $queryString);
    $execute = oci_execute($query);
    if (!$execute) {
        $e = oci_error($query);
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }
//
    $updateQuery = 'UPDATE PERSON SET COUNTRY_NAME = \''.$country.'\'WHERE USER_ID='.$id;
    echo $updateQuery;
    $query2 = oci_parse($conn, $updateQuery);
    $execute2 = oci_execute($query2);
    if (!$execute2) {
        $e = oci_error($query2);
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }
}
//echo $filter;
//$country = 'United Kingdom';
//echo $country;

    echo $queryString;
//echo "SELECT * FROM MERCHANDISE WHERE STOCKCODE =\"".$user."\" AND PASSCODE=\"".$pass."\"";



oci_free_statement($query);
oci_close($conn);
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

    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        hr {
            color:blue;
            display: block;
            margin-top: 0.5em;
            margin-bottom: 0.5em;
            margin-left: auto;
            margin-right: auto;
            border-style: inset;
            border-width: 5px;
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

<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->



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

            <div class="contact-form mb50 wow fadeIn">
                <h2>Add</h2>
                <form action="admin_add.php" id="contact-form" method="post">
                    <div class="form-group" id="name-field">
                        <div class="form-input">
                            <input type="text" class="form-control" id="form-name" name="id" placeholder="ID.." required>
                        </div>
                    </div>
                    <div class="form-group" id="name-field">
                        <div class="form-input">
                            <input type="text" class="form-control" id="form-name" name="pass" placeholder="Password.." required>
                        </div>
                    </div>
                    <div class="form-group" id="name-field">
                        <div class="form-input">
                            <input type="text" class="form-control" id="form-name" name="country" placeholder="Country.." required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Add to Customer" name="cust">
                        <input type="submit" value="Add to Merchandise" name="merchand">
<!--                        <button type="submit">Add to Customer</button>-->
<!--                        <button type="submit">Add to Merchandise</button>-->
                    </div>
                </form>
                <hr><br><br><br>
                <form action="admin_add.php" id="contact-form2" method="post">
                    <div class="form-group" id="name-field">
                        <div class="form-input">
                            <input type="text" class="form-control" id="form-name" name="id" placeholder="Stock ID.." required>
                        </div>
                    </div>
                    <div class="form-group" id="name-field">
                        <div class="form-input">
                            <input type="text" class="form-control" id="form-name" name="desc" placeholder="Descriptiion.." required>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Add to Items" name="item">


                    </div>
                </form>

            </div>



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

</body>

</html>

