<?php
include("../product.php");
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logindb";
$db = new mysqli($servername, $username, $password, $dbname);
$product = new Product($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete_product_id'])) {
        $delete_product_id = $_POST['delete_product_id'];
        $sql2 = "DELETE FROM products WHERE id = $delete_product_id";
        $db->query($sql2); 
            header("Location: http://localhost/ProductPage/ProductPage/admin/products.php");
            exit;
            }
    }

?>
