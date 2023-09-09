<?php
include("../product.php");
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logindb";
$db = new mysqli($servername, $username, $password, $dbname);
$brand = new Brand($db);



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete_brand_id'])) {
        $brand_id = $_POST['delete_brand_id'];
        if ($brand->deleteBrand($brand_id)) {
            header('Location: http://localhost/ProductPage/ProductPage/admin/brands.php');
            exit;
        } else {
            echo "Error deleting brand.";
        }
    }
}
?>