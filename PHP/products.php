<?php
/**
 * Created by PhpStorm.
 * User: Miraj
 * Date: 11/9/2018
 * Time: 5:02 PM
 */

include("connection.php");

session_start();

$productData = array();

$productData['id']                  = $_SESSION['id'];
$productData['Cust_Name']           = $_SESSION['custName'];
$productData['DSX']                 = $_POST['DSX1'] . $_POST['DSX2'];
$productData['Cust_Item_No']        = $_POST['Cust_Item_No'];
$productData['Cust_PO_Desc']        = $_POST['Cust_PO_Desc'];
$productData['Prod_Material1']      = $_POST['Prod_Material1'];
$productData['Prod_Material2']      = $_POST['Prod_Material2'];
$productData['Prod_Material3']      = $_POST['Prod_Material3'];
$productData['Prod_Material4']      = $_POST['Prod_Material4'];
$productData['Prod_Material5']      = $_POST['Prod_Material5'];
$productData['HTS'] = $_POST['HTS1'] . '.' . $_POST['HTS2'] . '.' . $_POST['HTS3'];

if ($_POST['Prod_Unit'] == 'Per Piece'){
    $productData['Prod_Unit'] = 'P';
}
elseif ($_POST['Prod_Unit'] == 'Per Set'){
    $productData['Prod_Unit'] = 'S';
}
else{
    $productData['Prod_Unit'] = 'C';
}

$productData['Prod_Price']          = $_POST['Prod_Price'];
$productData['Manf_Name']           = $_POST['Manf_Name'];
$productData['Manf_Add1']           = $_POST['Manf_Add1'];
$productData['Manf_Add2']           = $_POST['Manf_Add2'];
$productData['Manf_Add3']           = $_POST['Manf_Add3'];
$productData['Manf_Country']        = $_POST['Manf_Country'];
$productData['Prod_MID']            = $_POST['Prod_MID'];
$productData['Prod_Custom_Docs']    = $_POST['Prod_Custom_Docs'];
$productData['Prod_GW']             = $_POST['Prod_GW'];
$productData['Prod_NW']             = $_POST['Prod_NW'];
$productData['Prod_Qt']             = $_POST['Prod_Qt'];
$productData['Prod_Dim_L']          = $_POST['Prod_Dim_L'];
$productData['Prod_Dim_W']          = $_POST['Prod_Dim_W'];
$productData['Prod_Dim_H']          = $_POST['Prod_Dim_H'];

mysqli_query($dbc, "INSERT INTO products (`CUST ID`, `DSX`, `CUST ITEM NO`, `CUST PO DESC`, `MATERIAL`, 
`DESC 1`, `DESC 2`, `DESC 3`, `DESC 4`, `HTSUS NO`, `UNIT`, `PRICE`, `MANUFACTURER NAME`, `ADDRESS 1`, `ADDRESS 2`, 
`ADDRESS 3`, `COUNTRY`, `MID`, `DESC FOR DOCS`, `GROSS WT`, `NET WT`, `QUANTITY`, `DIM L`, `DIM W`, `DIM H`) VALUES('" .
    $_SESSION['id'] . "', '" . $productData['DSX'] . "', '" . $productData['Cust_Item_No'] . "', '" .
    $productData['Cust_PO_Desc'] . "', '" . $productData['Prod_Material1'] . "', '" . $productData['Prod_Material2'] .
    "', '" . $productData['Prod_Material3'] . "', '" . $productData['Prod_Material4'] . "', '" .
    $productData['Prod_Material5'] . "', '" . $productData['HTS'] . "', '" . $productData['Prod_Unit'] . "', '" .
    $productData['Prod_Price'] . "', '" . $productData['Manf_Name'] . "', '" . $productData['Manf_Add1'] . "', '" .
    $productData['Manf_Add2'] . "', '" . $productData['Manf_Add3'] . "', '" . $productData['Manf_Country'] . "', '" .
    $productData['Prod_MID'] . "', '" . $productData['Prod_Custom_Docs'] . "', '" . $productData['Prod_GW'] . "', '" .
    $productData['Prod_NW'] . "', '" . $productData['Prod_Qt'] . "', '" . $productData['Prod_Dim_L'] . "', '" .
    $productData['Prod_Dim_W'] . "', '" . $productData['Prod_Dim_H'] . "')") OR die("<br></br>ERROR: ".mysqli_error($dbc));

$_SESSION['products'][] = $productData;

$_SESSION['productsMemory'][] = ['dsx'=>$productData['DSX'], 'quantity'=>'',
    'price'=>$productData['Prod_Price'], 'priceChange'=>''];


header('Location: generator.php');

?>