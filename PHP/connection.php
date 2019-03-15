<?php
/**
 * Created by PhpStorm.
 * User: Miraj
 * Date: 11/1/2018
 * Time: 8:11 PM
 */

$hostname = "localhost";
//********************************************************************************************
$username = "root";
$psd = "";
$dbname = "designsourcedatabase";

$dbc = mysqli_connect($hostname, $username, $psd, $dbname) OR die("couldn't connect to the database '".$dbname."'<br></br>ERROR: ".mysqli_connect_error());

mysqli_set_charset($dbc, "utf8");


?>