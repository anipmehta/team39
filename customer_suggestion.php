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
$queryString = 'with popitem as(
select *
from(
select item.stock_code, ITEM.name
from trans,item
where TRANS.ITEM_STOCK_CODE=ITEM.STOCK_CODE
group by item.stock_code,item.name
order by sum(quantity) DESC)
where rownum<31)

select * from(
select NOT_PURCHASE.STOCK_CODE,not_purchase.name
from (
select * from(
select ITEM.STOCK_CODE,name
from item join trans on ITEM.STOCK_CODE=TRANS.ITEM_STOCK_CODE
where trans.user_id='.$_SESSION['userId'].'
order by CAST(transaction_year AS INT) DESC, CAST(transaction_month AS INT) DESC, CAST(transaction_day AS INT) DESC)
where rownum<6) purchase, (
select * from popitem where popitem.stock_code not in (select * from(
select ITEM.STOCK_CODE
from item join trans on ITEM.STOCK_CODE=TRANS.ITEM_STOCK_CODE
where trans.user_id='.$_SESSION['userId'].'
order by CAST(transaction_year AS INT) DESC, CAST(transaction_month AS INT) DESC, CAST(transaction_day AS INT) DESC)
where rownum<6)) not_purchase
order by UTL_MATCH.EDIT_DISTANCE_SIMILARITY(purchase.name,not_purchase.name) DESC)
where rownum<6';

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
    $dataRow = $dataRow . "<tr><td>$row[0]</td><td>$row[1]</td></tr>";
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
<body>
<center>
    <div>
        <table>
            <?php echo $dataRow;?>
        </table>
    </div>

</center>
</body>
</html>

