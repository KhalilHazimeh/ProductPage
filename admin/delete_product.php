<?php
include("../product.php");
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logindb";
$db = new mysqli($servername, $username, $password, $dbname);
$product = new Product($db);



if (isset( $_GET['delete_product_id'])) {
    if ($product->deleteProduct($_GET['delete_product_id'])) {
        header('Location: http://localhost/ProductPage/ProductPage/admin/products.php');
        exit;
    }
}
?>