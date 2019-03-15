<?php
/**
 * Created by PhpStorm.
 * User: Miraj
 * Date: 11/6/2018
 * Time: 9:24 AM
 */

session_start();
session_destroy();

header('Location: generator.php');

?>