<?php
include("../product.php");
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logindb";
$db = new mysqli($servername, $username, $password, $dbname);
$brand = new Brand($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["title"];

    if ($brand->addBrand($name)) {
        header("Location: http://localhost/ProductPage/ProductPage/admin/brands.php");
    } else {
        echo "Failed to add product.";
    }
}
?>