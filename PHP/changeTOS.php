<?php
/**
 * Created by PhpStorm.
 * User: Miraj
 * Date: 11/8/2018
 * Time: 10:40 AM
 */


include("connection.php");
session_start();

$q = 'UPDATE `customers` SET `TOS`="' . $_POST['TOS'] . '",`TERMS LOCATION`="' . $_POST['TOS_Location'] . '" WHERE `ID`="' . $_SESSION['id'] . '"';
mysqli_query($dbc, $q);

$_SESSION['tos'] = $_POST['TOS'];
$_SESSION['tosLocation'] = $_POST['TOS_Location'];

$_SESSION['status'] = 2;

?>