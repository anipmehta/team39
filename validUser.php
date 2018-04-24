#!/usr/local/bin/php
<?php
/**
 * Created by PhpStorm.
 * User: Chuan
 * Date: 4/14/2018
 * Time: 11:29 AM
 */
session_start();
$user = $_POST['username'];
$pass = $_POST['pass'];
$type = $_POST['user'];
$_SESSION['userId'] = null;

$conn = oci_connect($username = 'chuan', $password = 'UNCBiostat2018!', $connection_string = '//oracle.cise.ufl.edu/orcl');

if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
echo $type;
$query = null;
$execute = null;
$row = null;
echo $pass;
//echo "SELECT * FROM MERCHANDISE WHERE STOCKCODE =\"".$user."\" AND PASSCODE=\"".$pass."\"";
if($type == 'Admin'){
    $query = oci_parse($conn, "SELECT * FROM ADMIN WHERE ADMIN_ID='".$user."' AND PASSCODE='".$pass."'");
    $execute = oci_execute($query);
    $row = oci_num_rows($execute);
}
else if ($type == 'Merchandise'){
    $query = oci_parse($conn, "SELECT * FROM MERCHANDISE WHERE STOCKCODE='".$user."' AND PASSCODE='".$pass."'");
    $execute = oci_execute($query);
    $row = oci_num_rows($execute);
}
else{
    $query = oci_parse($conn, "SELECT * FROM CUSTOMER WHERE CUSTOMER_ID=".$user." AND PASSCODE='".$pass."'");
    $execute = oci_execute($query);
    $row = oci_num_rows($execute);
}

$i = 0;
while (oci_fetch_array($query, OCI_ASSOC+OCI_RETURN_NULLS)) {
    $i = $i + 1;
}

// Prepare the statement

echo $execute;
echo $execute;
if($type=='Customer'){
    if($execute>0 and $i == 1) {
        $_SESSION['userId'] = $user;
        header('Location: http://localhost:63342/team39/customer.php');
        echo "Login success with username " . $user . "and password " . $pass;
    }
    else {
        echo "Login Failed";
    }
}
else if($type=='Admin'){
    if($execute>0 and $i == 1) {
        $_SESSION['userId'] = $user;
        header('Location: http://localhost:63342/team39/admin.php');
        echo "Login success with username " . $user . "and password " . $pass;
    }
    else {
        echo "Login Failed";
    }
}
else if($type=='Merchandise') {
    $_SESSION['userId'] = $user;
    if($execute>0 and $i == 1) {
        header('Location: http://localhost:63342/team39/merchandise.php');
    } else {
        echo "Login Failed";
    }
}
echo $execute;

