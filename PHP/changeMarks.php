<?php
/**
 * Created by PhpStorm.
 * User: Miraj
 * Date: 11/8/2018
 * Time: 1:07 PM
 */

include("connection.php");
session_start();

$q = 'DELETE FROM `customermarks` WHERE `CUST ID`="' . $_SESSION['id'] . '"';
mysqli_query($dbc, $q);

$marks = array();
$marks = $_POST['marks'];

foreach ($marks as $mark){
    mysqli_query($dbc, "INSERT INTO customermarks (`CUST ID`, `MARKS`) VALUES('" . $_SESSION['id'] . "', '$mark')") OR die("<br></br>ERROR: ".mysqli_error($dbc));
}

$_SESSION['marks'] = $_POST['marks'];
$_SESSION['status'] = 2;

?>