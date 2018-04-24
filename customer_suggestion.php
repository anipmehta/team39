<?php
/**
 * Created by PhpStorm.
 * User: Chuan
 * Date: 4/23/2018
 * Time: 3:55 PM
 */
include "config.php";
session_start();
echo $_SESSION['userId'];
$filter = $_POST['filter'];
$startRange = $_POST['start'];
$endRange = $_POST['end'];
$queryString = 'with popitem as(
select *
from(
select item.stock_code, ITEM.name
from trans,item
where TRANS.ITEM_STOCK_CODE=ITEM.STOCK_CODE
group by item.stock_code,item.name, trans.price
order by sum(quantity) DESC)
where rownum<31)

select * from(
select distinct * from(
select NOT_PURCHASE.STOCK_CODE,not_purchase.name, price
from (
select * from(
select ITEM.STOCK_CODE,name, TR.price
from item join trans TR on ITEM.STOCK_CODE=TR.ITEM_STOCK_CODE
where TR.user_id='.$_SESSION['userId'].'
order by CAST(transaction_year AS INT) DESC, CAST(transaction_month AS INT) DESC, CAST(transaction_day AS INT) DESC)
where rownum<6) purchase, (
select * from popitem where popitem.stock_code not in (select * from(
select ITEM.STOCK_CODE
from item join trans on ITEM.STOCK_CODE=TRANS.ITEM_STOCK_CODE
where trans.user_id='.$_SESSION['userId'].'
order by CAST(transaction_year AS INT) DESC, CAST(transaction_month AS INT) DESC, CAST(transaction_day AS INT) DESC)
where rownum<6)) not_purchase
order by UTL_MATCH.EDIT_DISTANCE_SIMILARITY(purchase.name,not_purchase.name) DESC))
where rownum<100';

if(isset($filter)) {
    $queryString = 'with popitem as(
select *
from(
select item.stock_code, ITEM.name
from trans,item
where TRANS.ITEM_STOCK_CODE=ITEM.STOCK_CODE
group by item.stock_code,item.name, trans.price
order by sum(quantity) DESC)
where rownum<31)

select * from(select * from(
select distinct * from(
select NOT_PURCHASE.STOCK_CODE,not_purchase.name, price as P
from (
select * from(
select ITEM.STOCK_CODE,name, TR.price
from item join trans TR on ITEM.STOCK_CODE=TR.ITEM_STOCK_CODE
where TR.user_id=' .$_SESSION['userId'].'
order by CAST(transaction_year AS INT) DESC, CAST(transaction_month AS INT) DESC, CAST(transaction_day AS INT) DESC)
where rownum<6) purchase, (
select * from popitem where popitem.stock_code not in (select * from(
select ITEM.STOCK_CODE
from item join trans on ITEM.STOCK_CODE=TRANS.ITEM_STOCK_CODE
where trans.user_id='.$_SESSION['userId'].'
order by CAST(transaction_year AS INT) DESC, CAST(transaction_month AS INT) DESC, CAST(transaction_day AS INT) DESC)
where rownum<6)) not_purchase
order by UTL_MATCH.EDIT_DISTANCE_SIMILARITY(purchase.name,not_purchase.name) DESC))
where rownum<100) where P <= '.$endRange.' and P >='.$startRange;
}


//
$query = oci_parse($conn, $queryString);
$execute = oci_execute($query);
$dataRow = "";
if (!$execute) {
    $e = oci_error($query);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

while (($row = oci_fetch_array($query, OCI_BOTH)) != false) {
//    print "<tr>\n";
//    foreach ($row as $item) {
    // $dataRow = $dataRow . "<tr><td>" . $row['COUNTRY_NAME'] . "</td></tr>";
    $dataRow = $dataRow . "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td></tr>";
//        $dataRow = $dataRow . "<tr><td>" . $row1['TRANSACTION_MONTH'] . "</td></tr>";
//        echo "fgdf".$dataRow;
//        print "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
//    }
//    print "</tr>\n";
}
oci_free_statement($query);
oci_close($conn);
?>
<html>
<link rel="stylesheet" href="css/normalize.css">
<link rel="stylesheet" href="css/animate.css">
<link rel="stylesheet" href="css/stellarnav.min.css">
<link rel="stylesheet" href="css/progressbar.css">
<link rel="stylesheet" href="css/owl.carousel.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/font-awesome.min.css" rel="stylesheet">

<!--====== MAIN STYLESHEETS ======-->
<link href="style.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">
<style>
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
<body>
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
                            <li class="active"><a href="customer.php">home</a></li>

                            <li><a href="login.php">Log out</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <!--END MAINMENU AREA END-->
    </div>
</header>
<center>
    <div>
        <h3> You might want to to take a look at these...</h3>
        <div class = "row">
            <form class="example" action="customer_suggestion.php" method="post">
                <center>
                    <p> Select a price range : </p>
                </center>
                <input type="text" placeholder="Lower bound.." name="start">
                <input type="text" placeholder="Upper bound.." name="end">
                <input type="submit" class="button button1" name="filter"></input>
            </form>
            <div class="col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2 col-sm-12 col-xs-12">
                <table>
                    <tr>
                        <th>Item Code</th>
                        <th>Items</th>
                        <th>Price</th>
                    </tr>
                    <?php echo $dataRow;?>
                </table>
            </div>
        </div>
    </div>
</center>
</body>
</html>

