<?php
/**
 * Created by PhpStorm.
 * User: Chuan
 * Date: 4/14/2018
 * Time: 11:29 AM
 */
$user = $_POST['username'];
$pass = $_POST['pass'];
$type = $_POST['user'];
$conn = oci_connect($username = 'chuan', $password = 'UNCBiostat2018!', $connection_string = '//oracle.cise.ufl.edu/orcl');

if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
echo $type;
$query = null;
$execute = null;
$row = null;
if($type == 'Admin'){
    echo $user;
    echo $pass;
    $query = oci_parse($conn, "SELECT * FROM SUPERUSER WHERE ID=".$user."AND PASSCODE=".$pass);
    $execute = oci_execute($query);
    $row = oci_num_rows($execute);
    echo "rfegrgfe".$row;
}
elseif ($type == 'Merchandise'){
    $query = oci_parse($conn, "SELECT * FROM MERCHANDISE WHERE STOCKCODE=".$user."AND PASSCODE=".$pass);
    $execute = oci_execute($query);
    $row = oci_num_rows($execute);
}
else{
    $query = oci_parse($conn, "SELECT * FROM ".$type." WHERE CUSTOMER_ID=".$user."AND PASSCODE=".$pass);
    $execute = oci_execute($query);
    $row = oci_num_rows($execute);
}

// Prepare the statement

echo $execute;
echo $execute;
if($type=='Customer'){
    if($execute>0) {
        header('Location: http://localhost:63342/team39/customer.html?_ijt=jna571ddv0b1ct882kri1h59q2');
        echo "Login success with username " . $user . "and password " . $pass;
    }
    else {
        echo "Login Failed";
    }
}
else if($type=='Admin'){
    echo "admin ". $execute;
    if($execute>0) {
        header('Location: http://localhost:63342/team39/admin.html?_ijt=jna571ddv0b1ct882kri1h59q2');
        echo "Login success with username " . $user . "and password " . $pass;
    }
    else {
        echo "Login Failed";
    }
}
else if($type=='Merchandise') {
    header('Location: http://localhost:63342/team39/merchandise.html?_ijt=jna571ddv0b1ct882kri1h59q2');
}
echo $execute;

