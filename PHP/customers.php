<?php
/**
 * Created by PhpStorm.
 * User: Miraj
 * Date: 11/5/2018
 * Time: 8:57 AM
 */

include("connection.php");

session_start();

$custJSON = array();
$ids = array();

$_SESSION['custName'] = $_POST['Cust_Name'];
$_SESSION['tos'] = $_POST['TOS'];
$_SESSION['tosLocation'] = $_POST['TOS_Location'];
$_SESSION['shippingName'] = $_POST['Sh_Name'];
$_SESSION['shippingAdd1'] = $_POST['Sh_Add1'];
$_SESSION['shippingAdd2'] = $_POST['Sh_Add2'];
$_SESSION['shippingAdd3'] = $_POST['Sh_Add3'];
$_SESSION['shippingCountry'] = $_POST['Sh_Country'];
$_SESSION['shippingAdditional'] = $_POST['Sh_Additional'];
$_SESSION['billingName'] = $_POST['Bl_Name'];
$_SESSION['billingAdd1'] = $_POST['Bl_Add1'];
$_SESSION['billingAdd2'] = $_POST['Bl_Add2'];
$_SESSION['billingAdd3'] = $_POST['Bl_Add3'];
$_SESSION['billingCountry'] = $_POST['Bl_Country'];
$_SESSION['marks'] = $_POST['marks'];
$_SESSION['status'] = 1;

$custJSON['custName'] = $_POST['Cust_Name'];
$custJSON['tos'] = $_POST['TOS'];
$custJSON['tosLocation'] = $_POST['TOS_Location'];
$custJSON['shippingName'] = $_POST['Sh_Name'];
$custJSON['shippingAdd1'] = $_POST['Sh_Add1'];
$custJSON['shippingAdd2'] = $_POST['Sh_Add2'];
$custJSON['shippingAdd3'] = $_POST['Sh_Add3'];
$custJSON['shippingCountry'] = $_POST['Sh_Country'];
$custJSON['shippingAdditional'] = $_POST['Sh_Additional'];
$custJSON['billingName'] = $_POST['Bl_Name'];
$custJSON['billingAdd1'] = $_POST['Bl_Add1'];
$custJSON['billingAdd2'] = $_POST['Bl_Add2'];
$custJSON['billingAdd3'] = $_POST['Bl_Add3'];
$custJSON['billingCountry'] = $_POST['Bl_Country'];
$custJSON['marks'] = $_POST['marks'];

$myfile = fopen("../JSON/custJSON.json", "w") or die("Unable to open file!");
fwrite($myfile, json_encode($custJSON));
fclose($myfile);

mysqli_query($dbc, "INSERT INTO customers (`NAME`, `TOS`, `TERMS LOCATION`, `SHIPPING ADDRESS NAME`, `SHIPPING ADDRESS 1`, `SHIPPING ADDRESS 2`, `SHIPPING ADDRESS 3`, `SHIPPING COUNTRY`, `SHIPPING ADDRESS ADDITIONAL`, `BILLING ADDRESS NAME`, `BILLING ADDRESS 1`, `BILLING ADDRESS 2`, `BILLING ADDRESS 3`, `BILLING COUNTRY`) VALUES('" . mysqli_real_escape_string($dbc, $_POST['Cust_Name']) . "', '" . mysqli_real_escape_string($dbc, $_POST['TOS']) . "', '" . mysqli_real_escape_string($dbc, $_POST['TOS_Location']) . "', '" . mysqli_real_escape_string($dbc, $_POST['Sh_Name']) . "', '" . mysqli_real_escape_string($dbc, $_POST['Sh_Add1']) . "', '" . mysqli_real_escape_string($dbc, $_POST['Sh_Add2']) . "', '" . mysqli_real_escape_string($dbc, $_POST['Sh_Add3']) . "', '" . mysqli_real_escape_string($dbc, $_POST['Sh_Country']) . "', '" . mysqli_real_escape_string($dbc, $_POST['Sh_Additional']) . "', '" . mysqli_real_escape_string($dbc, $_POST['Bl_Name']) . "', '" . mysqli_real_escape_string($dbc, $_POST['Bl_Add1']) . "', '" . mysqli_real_escape_string($dbc, $_POST['Bl_Add2']) . "', '" . mysqli_real_escape_string($dbc, $_POST['Bl_Add3']) . "', '" . mysqli_real_escape_string($dbc, $_POST['Bl_Country']) . "')") OR die("<br></br>ERROR: ".mysqli_error($dbc));

$q = "SELECT ID FROM `customers`";
$result = mysqli_query($dbc, $q);

while($row = mysqli_fetch_assoc($result)){
    $ids[] = $row['ID'];
}

$custID = max($ids);
$_SESSION['id'] = $custID;

$marks = array();
$marks = $_POST['marks'];
$marksLen = count($marks);

foreach ($marks as $mark){
    mysqli_query($dbc, "INSERT INTO customermarks (`CUST ID`, `MARKS`) VALUES('$custID', '$mark')") OR die("<br></br>ERROR: ".mysqli_error($dbc));
}

header('Location: generator.php');

?>