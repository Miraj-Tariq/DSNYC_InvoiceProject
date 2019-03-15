<?php
/**
 * Created by PhpStorm.
 * User: Miraj
 * Date: 11/5/2018
 * Time: 11:46 AM
 */

include("../PHP/connection.php");

$prodDesc1 = 'Hello World';
echo $prodDesc1;

$temp = '$prodDesc' . (string)(1);

echo $$temp;

exit();


$testArr = Array();
$testArr[0][0] = 1;
$testArr[0][1] = 2;
$testArr[0][2] = 3;
$testArr[1][0] = 4;
$testArr[1][1] = 5;
$testArr[1][2] = 6;
$testArr[2][0] = 7;
$testArr[2][1] = 8;
$testArr[2][2] = 9;
$testArr[3][0] = 10;
$testArr[3][1] = 11;
$testArr[3][2] = 12;


echo count($testArr);












/************************************************************************************************************
$testArr = Array();
$extArr = ['name'=>'Tariq', 'age'=>57];

$testArr[0]['name'] = 'Miraj';
$testArr[0]['age'] = 29;

$testArr[1]['name'] = 'Anfal';
$testArr[1]['age'] = 28;

$testArr[2]['name'] = 'Furqan';
$testArr[2]['age'] = 25;

$testArr[3]['name'] = 'Moneeb';
$testArr[3]['age'] = 27;

$testArr[] = $extArr;

$len = sizeof($testArr);
echo $len . '<br>';

foreach ($testArr as $item) {
    echo $item['name'] . '<br>';
    echo $item['age'] . '<br>';
}
*/






/************************************************************************************************************
$ID = $_GET['custName'];
echo $ID . '<br>';
echo "SELECT ID FROM customers WHERE NAME=" . $ID;

$res = mysqli_query($dbc, 'SELECT ID FROM customers WHERE NAME="' . $ID . '"');
echo($res->num_rows);
while ($row = mysqli_fetch_assoc($res)){
    $custID = $row['ID'];
    echo '<br>' . $custID;
}
*/






/*******************************************************************************************************
$ar1 = array();
$ar2 = array();

$ar1[]['number'] = 1;
$ar1[]['number'] = 2;
$ar1[]['number'] = 3;
$ar1[]['number'] = 4;
$ar1[]['number'] = 5;

echo count($ar1);
echo "<br>";

foreach ($ar1 as $i){
    echo $i['number'];
}
*/







/***********************************************************************************************************
session_start();

$ar = array();
$ar = $_POST['n'];

echo count($ar);

foreach ($ar as $elem){
    echo $elem;
}
*/



/***********************************************************************************************************
$custJSON = array();

$custJSON['custName'] = "Miraj Tariq";
$custJSON['tos'] = "ABC";
$custJSON['tosLocation'] = "NY";

echo $custJSON->custName;


$myfile = fopen("test.json", "w") or die("Unable to open file!");
fwrite($myfile, json_encode($custJSON));
fclose($myfile);
*/
?>

