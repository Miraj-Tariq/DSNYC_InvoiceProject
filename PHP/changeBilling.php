<?php
/**
 * Created by PhpStorm.
 * User: Miraj
 * Date: 11/8/2018
 * Time: 11:23 AM
 */

include("connection.php");
session_start();

$q = 'UPDATE `customers` SET `BILLING ADDRESS NAME`="' . $_POST['Bl_Name'] . '",`BILLING ADDRESS 1`="' . $_POST['Bl_Add1'] . '", `BILLING ADDRESS 2`="' . $_POST['Bl_Add2'] . '", `BILLING ADDRESS 3`="' . $_POST['Bl_Add3'] . '", `BILLING COUNTRY`="' . $_POST['Bl_Country'] . '" WHERE `ID`="' . $_SESSION['id'] . '"';
mysqli_query($dbc, $q);

$_SESSION['billingName'] = $_POST['Bl_Name'];
$_SESSION['billingAdd1'] = $_POST['Bl_Add1'];
$_SESSION['billingAdd2'] = $_POST['Bl_Add2'];
$_SESSION['billingAdd3'] = $_POST['Bl_Add3'];
$_SESSION['billingCountry'] = $_POST['Bl_Country'];

$_SESSION['status'] = 2;

?>