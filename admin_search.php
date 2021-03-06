#!/usr/local/bin/php
<?php //include("config.php"); ?>
<?php
/**
 * Created by PhpStorm.
 * User: Chuan
 * Date: 4/22/2018
 * Time: 12:16 PM
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
$filter = null;
//echo $conn;
$search_value =  $_POST['search'];
$filter = $_POST['filter'];
//echo $filter;
//$country = 'United Kingdom';
//echo $country;
$dataRow = "";
    if($filter=='Country'){
        $queryString = 'select * from(select * from trans natural join person where person.country_name=\'' . $search_value . '\' ) where rownum < 100';
    }
    elseif($filter == 'Item'){
        $queryString = 'select * from(select * from trans natural join person where trans.item_stock_code=\'' . $search_value . '\' ) where rownum < 100';
    }
    elseif($filter == 'Price'){
        $queryString = 'select * from(select * from trans natural join person where trans.price=\'' . $search_value . '\' ) where rownum < 100';
    }
    elseif($filter == 'Date'){
        $queryString = 'select * from(select * from trans natural join person where trans.transaction_time LIKE \'%' . $search_value . '%\' ) where rownum < 100';
    }

//    echo $queryString;
//echo "SELECT * FROM MERCHANDISE WHERE STOCKCODE =\"".$user."\" AND PASSCODE=\"".$pass."\"";
    $query = oci_parse($conn, $queryString);
    $execute = oci_execute($query);
    if (!$execute) {
        $e = oci_error($query);
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }

    while (($row = oci_fetch_array($query, OCI_BOTH)) != false) {
//    print "<tr>\n";
//    foreach ($row as $item) {
//    echo $row[0]."\n";
       // $dataRow = $dataRow . "<tr><td>" . $row['COUNTRY_NAME'] . "</td></tr>";
$dataRow = $dataRow . "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$row[5]</td><td>$row[6]</td><td>".$row['COUNTRY_NAME']."</td></tr>";
//        $dataRow = $dataRow . "<tr><td>" . $row1['TRANSACTION_MONTH'] . "</td></tr>";
//        echo "fgdf".$dataRow;
//        print "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
//    }
//    print "</tr>\n";
}
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


         table {
             border-collapse: collapse;
             width: 100%;
         }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {background-color:#f5f5f5;}

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



                   <br><br>


                <form class="example" action="admin_search.php" method="post">
                    <center>
                    <p>
                        <input class="w3-radio" type="radio" name="filter" value="Country" checked>
                        <label>Country</label>
                        &nbsp;&nbsp;
                        <input class="w3-radio" type="radio" name="filter" value="Date">
                        <label>Date</label>
                        &nbsp;&nbsp;
                        <input class="w3-radio" type="radio" name="filter" value="Price" >
                        <label>Price</label>
                    &nbsp;&nbsp;
                        <input class="w3-radio" type="radio" name="filter" value="Item" >
                        <label>Item</label></p>
                    </center>
                    <input type="text" placeholder="Search.." name="search">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
                <h4>Results</h4>
                <table>
                <tr>
                    <th>User Id</th>
                    <th>Transaction Id</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Date</th>
                    <th>Stock Code</th>
                    <th>Month</th>
                    <th>Country</th>
                </tr>
                <?php echo $dataRow;?>
                </table>
            </div>
        </div>
    </div>
</section>
</body>

</html>



