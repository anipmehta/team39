#!/usr/local/bin/php
<?php
/**
 * Created by PhpStorm.
 * User: Chuan
 * Date: 4/22/2018
 * Time: 3:44 PM
 */
$conn = oci_connect($username = 'chuan', $password = 'UNCBiostat2018!', $connection_string = '//oracle.cise.ufl.edu/orcl');

if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
echo "Connected";
$server_name = "https://www.cise.ufl.edu/~tpathak/team39";