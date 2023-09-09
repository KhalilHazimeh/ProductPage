<?php
include("../product.php");
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logindb";
$db = new mysqli($servername, $username, $password, $dbname);
$category = new Category($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["title"];

    if ($category->addCategory($name)) {
        header("Location: http://localhost/ProductPage/ProductPage/admin/categories.php");
    } else {
        echo "Failed to add product.";
    }
}
?>