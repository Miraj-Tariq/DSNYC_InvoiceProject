<?php
/**
 * Created by PhpStorm.
 * User: Miraj
 * Date: 11/8/2018
 * Time: 12:34 AM
 */

include("connection.php");

session_start();

$_SESSION['marks'] = array();

$shArray = explode('|', $_POST['custShipping']);
$_SESSION['shippingName'] = $shArray[0];
$_SESSION['shippingAdd1'] = $shArray[1];
$_SESSION['shippingAdd2'] = $shArray[2];
$_SESSION['shippingAdd3'] = $shArray[3];
$_SESSION['shippingCountry'] = $shArray[4];
$_SESSION['shippingAdditional'] = $shArray[5];


$res = mysqli_query($dbc, 'SELECT * FROM customers WHERE NAME="' . $_POST['custName'] . '"');
while ($row = mysqli_fetch_assoc($res)){
    $_SESSION['id'] = $row['ID'];
    $_SESSION['custName'] = $row['NAME'];
    $_SESSION['tos'] = $row['TOS'];
    $_SESSION['tosLocation'] = $row['TERMS LOCATION'];
    $_SESSION['billingName'] = $row['BILLING ADDRESS NAME'];
    $_SESSION['billingAdd1'] = $row['BILLING ADDRESS 1'];
    $_SESSION['billingAdd2'] = $row['BILLING ADDRESS 2'];
    $_SESSION['billingAdd3'] = $row['BILLING ADDRESS 3'];
    $_SESSION['billingCountry'] = $row['BILLING COUNTRY'];

    $res1 = mysqli_query($dbc, 'SELECT * FROM customermarks WHERE `CUST ID`="' . $row['ID'] . '"');

    while($r = mysqli_fetch_assoc($res1)){
        $_SESSION['marks'][] = $r['MARKS'];
    }

    $_SESSION['status'] = 2;
}


?>