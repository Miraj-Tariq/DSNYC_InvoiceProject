<?php
/**
 * Created by PhpStorm.
 * User: Miraj
 * Date: 11/7/2018
 * Time: 9:04 PM
 */

include("connection.php");
session_start();

$customerShipping = array();
$custID = '';
$temp = '';

$res = mysqli_query($dbc, 'SELECT ID FROM customers WHERE NAME="' . $_POST['custName'] . '"');
while ($row = mysqli_fetch_assoc($res)){
    $custID = $row['ID'];
}

$result = mysqli_query($dbc, 'SELECT * FROM customershipping WHERE `CUST ID`="' . $custID . '"');
$noOfShipping = $result->num_rows;

if($noOfShipping > 0){
    while ($row = mysqli_fetch_assoc($result)){
        $temp = $row['SHIPPING ADDRESS NAME'] . '|' . $row['SHIPPING ADDRESS 1'] . '|' . $row['SHIPPING ADDRESS 2'] . '|' . $row['SHIPPING ADDRESS 3'] . '|' . $row['SHIPPING COUNTRY'] . '|' . $row['SHIPPING ADDRESS ADDITIONAL'];

        $customerShipping[] = '<option value="' . $temp . '">' . $row['SHIPPING ADDRESS NAME'] . '</option>';
    }
    echo json_encode($customerShipping);
}
else{
    echo json_encode($customerShipping);
}

?>