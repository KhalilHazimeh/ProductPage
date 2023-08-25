<?php
include("../product.php");
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logindb";
$db = new mysqli($servername, $username, $password, $dbname);
$product = new Product($db);

if (isset($_GET['edit_product_id']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $productId = $_GET["edit_product_id"];
    $title = $_POST["title"];
    $price = $_POST["price"];
    $oldPrice = $_POST["oldPrice"];
    $brandId = $_POST["brandId"];

    $sql = "UPDATE products SET name=?, price=?, `old-price`=?, brand_id=? WHERE id=?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("ssdii", $title, $price, $oldPrice, $brandId, $productId);

    if ($stmt->execute()) {
        $stmt->close();
        $db->close();
        header("Location: http://localhost/ProductPage/ProductPage/admin/products.php");
        exit();
    } else {
        $stmt->close();
        $db->close();
        echo "Error";
    }
}
?>
