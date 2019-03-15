<?php
/**
 * Created by PhpStorm.
 * User: Miraj
 * Date: 11/8/2018
 * Time: 1:52 PM
 */

include("connection.php");
session_start();

$q = 'INSERT INTO `customershipping`(`CUST ID`, `SHIPPING ADDRESS NAME`, `SHIPPING ADDRESS 1`, `SHIPPING ADDRESS 2`, `SHIPPING ADDRESS 3`, `SHIPPING COUNTRY`, `SHIPPING ADDRESS ADDITIONAL`) VALUES ("' . $_SESSION['id'] . '","' . $_POST['Sh_Name'] . '","' . $_POST['Sh_Add1'] . '","' . $_POST['Sh_Add2'] . '","' . $_POST['Sh_Add3'] . '","' . $_POST['Sh_Country'] . '","' . $_POST['Sh_Additional'] . '")';
mysqli_query($dbc, $q);

$_SESSION['shippingName'] = $_POST['Sh_Name'];
$_SESSION['shippingAdd1'] = $_POST['Sh_Add1'];
$_SESSION['shippingAdd2'] = $_POST['Sh_Add2'];
$_SESSION['shippingAdd3'] = $_POST['Sh_Add3'];
$_SESSION['shippingCountry'] = $_POST['Sh_Country'];
$_SESSION['shippingAdditional'] = $_POST['Sh_Additional'];

$_SESSION['status'] = 2;

?>