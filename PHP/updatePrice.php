<?php
/**
 * Created by PhpStorm.
 * User: Miraj
 * Date: 11/10/2018
 * Time: 2:23 PM
 */

include("connection.php");
session_start();

$productPrice = '';

$res = mysqli_query($dbc, 'SELECT PRICE FROM products WHERE DSX="' . $_POST['dsx'] . '"');
while ($row = mysqli_fetch_assoc($res)){
    $productPrice = $row['PRICE'];
}

echo json_encode($productPrice);

?>