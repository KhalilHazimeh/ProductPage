<?php
include("../product.php");
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logindb";
$db = new mysqli($servername, $username, $password, $dbname);
$product = new Product($db);



    if ($product->deleteAllProduct()) {
        header('Location: http://localhost/ProductPage/ProductPage/admin/products.php');
        exit;
    }
?>