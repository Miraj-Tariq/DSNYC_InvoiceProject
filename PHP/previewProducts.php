<?php
/**
 * Created by PhpStorm.
 * User: Miraj
 * Date: 11/18/2018
 * Time: 12:52 PM
 */

include("connection.php");

session_start();

$_SESSION['productsMemory'] = [];

$previewProductsHTML = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" type="text/css" href="CSS/style.css" >

    <title>TEMPLATE</title>
</head>
<body>
<div class="btnDiv">
    <button class="button" onclick="window.location.href = \'PHP/generator.php\';return false;">GO BACK</button>
</div>';

$productsCount = count($_POST['dsxs']);

for($i = 0; $i < $productsCount;$i++){
    if(!empty($_POST['dsxs'][$i])){
        $res = mysqli_query($dbc, 'SELECT * FROM products WHERE DSX="' . $_POST['dsxs'][$i] . '"');
        while ($row = mysqli_fetch_assoc($res)){
            $_SESSION['productsMemory'][] = ['dsx'=>$_POST['dsxs'][$i],'quantity'=>$_POST['quantities'][$i],'price'=>$_POST['prices'][$i],'priceChange'=>$_POST['priceChanges'][$i]];

            $previewProductsHTML = $previewProductsHTML . '<div id="preview_section">
        <div class="preview_section_heading">
            PRODUCT [' . $row['DSX'] . ']
        </div>
        <table>
            <colgroup>
                <col style="width: 50%;">
                <col style="width: 50%;">
            </colgroup>
            <tr>
                <td><b>CUSTOMER\'s ITEM NO:</b>&nbsp;&nbsp;&nbsp;' . $row['CUST ITEM NO'] . '</td>
                <td><b>CUSTOMER\'s PO DESCRIPTION:</b>&nbsp;&nbsp;&nbsp;' . $row['CUST PO DESC'] . '</td>
            </tr>
        </table>

        <table>
            <tr>
                <td><b>MATERIAL:</b>&nbsp;&nbsp;&nbsp;' . $row['MATERIAL'];

            if(!empty($row['DESC 1'])){
                $previewProductsHTML = $previewProductsHTML . ', ' . $row['DESC 1'];
            }
            if(!empty($row['DESC 2'])){
                $previewProductsHTML = $previewProductsHTML . ', ' . $row['DESC 2'];
            }
            if(!empty($row['DESC 3'])){
                $previewProductsHTML = $previewProductsHTML . ', ' . $row['DESC 3'];
            }
            if(!empty($row['DESC 4'])){
                $previewProductsHTML = $previewProductsHTML . ', ' . $row['DESC 4'];
            }

            $previewProductsHTML = $previewProductsHTML . '.</td>
            </tr>
        </table>

        <table>
            <colgroup>
                <col style="width: 33.333333%;">
                <col style="width: 33.333333%;">
                <col style="width: 33.333333%;">
            </colgroup>
            <tr>
                <td><b>HTSUS NO:</b>&nbsp;&nbsp;&nbsp;' . $row['HTSUS NO'] . '</td>
                <td><b>UNIT OF SALE:</b>&nbsp;&nbsp;&nbsp;';

            if ($row['UNIT'] == 'P'){
                $previewProductsHTML = $previewProductsHTML . 'Per Piece';
            }
            else if ($row['UNIT'] == 'S'){
                $previewProductsHTML = $previewProductsHTML . 'Per Set';
            }
            else if ($row['UNIT'] == 'C'){
                $previewProductsHTML = $previewProductsHTML . 'Per Case';
            }

            $previewProductsHTML = $previewProductsHTML . '</td>
                <td><b>PRICE PER UNIT:</b>&nbsp;&nbsp;&nbsp;$ ' . $row['PRICE'] . '</td>
            </tr>
        </table>

        <table>
            <tr>
                <td><b>MANUFACTURER INFO:</b>&nbsp;&nbsp;&nbsp;' . $row['MANUFACTURER NAME'];

            if(!empty($row['ADDRESS 1'])){
                $previewProductsHTML = $previewProductsHTML . ', ' . $row['ADDRESS 1'];
            }
            if(!empty($row['ADDRESS 2'])){
                $previewProductsHTML = $previewProductsHTML . ', ' . $row['ADDRESS 2'];
            }
            if(!empty($row['ADDRESS 3'])){
                $previewProductsHTML = $previewProductsHTML . ', ' . $row['ADDRESS 3'];
            }
            if(!empty($row['COUNTRY'])){
                $previewProductsHTML = $previewProductsHTML . ', ' . $row['COUNTRY'];
            }

            $previewProductsHTML = $previewProductsHTML . '.</td>
            </tr>
        </table>

        <table>
            <colgroup>
                <col style="width: 50%;">
                <col style="width: 50%;">
            </colgroup>
            <tr>
                <td><b>MID CODE:</b>&nbsp;&nbsp;&nbsp;' . $row['MID'] . '</td>
                <td><b>DESCRIPTION FOR DOCS:</b>&nbsp;&nbsp;&nbsp;' . $row['DESC FOR DOCS'] . '</td>
            </tr>
            <tr>
                <td><b>NET WEIGHT:</b>&nbsp;&nbsp;&nbsp;' . $row['NET WT'] . ' KG</td>
                <td><b>GROSS WEIGHT:</b>&nbsp;&nbsp;&nbsp;' . $row['GROSS WT'] . ' KG</td>
            </tr>
            <tr>
                <td><b>QUANTITY PER CASE:</b>&nbsp;&nbsp;&nbsp;' . $row['QUANTITY'] . '</td>
                <td><b>DIMENSIONS:</b>&nbsp;&nbsp;&nbsp;' . $row['DIM L'] . ' x ' . $row['DIM W'] . ' x ' . $row['DIM H'] . '&nbsp;&nbsp;&nbsp;(L x W x H)</td>
            </tr>
        </table>
    </div>';


        }
    }
}

$previewProductsHTML = $previewProductsHTML . '</body>
</html>';

$myfile = fopen("../previewProducts.html", "w") or die("Unable to open file!");
fwrite($myfile, $previewProductsHTML);
fclose($myfile);

//header('Location: ../previewProducts.html');

?>