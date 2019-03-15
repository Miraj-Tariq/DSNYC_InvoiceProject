<?php
/**
 * Created by PhpStorm.
 * User: Miraj
 * Date: 11/8/2018
 * Time: 7:58 PM
 */

session_start();

$_SESSION['productsCount'] = $_SESSION['productsCount'] + 1;
echo $_SESSION['productsCount'];

?>