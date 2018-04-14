<?php
/**
 * Created by PhpStorm.
 * User: Chuan
 * Date: 4/14/2018
 * Time: 11:29 AM
 */
$user = $_POST['username'];
$pass = $_POST['pass'];
$conn = oci_connect($username = 'chuan', $password = 'UNCBiostat2018!', $connection_string = '//oracle.cise.ufl.edu/orcl');

if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Prepare the statement

$query = oci_parse($conn, "SELECT * FROM CUSTOMER WHERE CUSTOMER_ID=".$user."AND PASSCODE=".$pass);
$execute = oci_execute($query);
$row = oci_num_rows($execute);
echo $execute;
if($execute==1) {
    header('Location: http://localhost:63342/team39/admin.php');
    echo "Login success with username " . $user . "and password " . $pass;
}
else {
    echo "Login Failed";
}
