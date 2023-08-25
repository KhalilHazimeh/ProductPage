<?php
include("../product.php");
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logindb";
$db = new mysqli($servername, $username, $password, $dbname);
$product = new Product($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id= $_POST['id'];
    $name = $_POST["name"];
    $price = $_POST["price"];
    $old_price = $_POST["oldPrice"];
    $image =' ';
    $brand_id = $_POST["brandID"];

    if ($product->addProduct($id, $name, $price, $old_price, $image, $brand_id)) {
        header("Location: http://localhost/ProductPage/ProductPage/admin/products.php");
    } else {
        echo "Failed to add product.";
    }
}
?>