<?php
include("../product.php");
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logindb";
$db = new mysqli($servername, $username, $password, $dbname);
$product = new Product($db);

$selectedCategories = isset($_POST['categories']) ? $_POST['categories'] : array();


if (isset($_POST['edit_product_id']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $productId = $_POST["edit_product_id"];
    $title = $_POST["title"];
    $price = $_POST["price"];
    $oldPrice = $_POST["oldPrice"];
    $brandId = $_POST["brandID"];

    $sql = "UPDATE products SET name=?, price=?, `old-price`=?, brand_id=? WHERE id=?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("ssdii", $title, $price, $oldPrice, $brandId, $productId);

    if ($stmt->execute()) {
        $deleteCategoriesQuery = "DELETE FROM product_categories WHERE product_id=?";
        $deleteStmt = $db->prepare($deleteCategoriesQuery);
        $deleteStmt->bind_param("i", $productId);
        $deleteStmt->execute();
        $deleteStmt->close();
    
        foreach ($selectedCategories as $categoryId) {
            $categoryInsertQuery = "INSERT INTO product_categories (product_id, category_id) VALUES (?, ?)";
            $categoryInsertStmt = $db->prepare($categoryInsertQuery);
            $categoryInsertStmt->bind_param("ii", $productId, $categoryId);
            $categoryInsertStmt->execute();
            $categoryInsertStmt->close();
        }

        $sizes = explode(',', $_POST['sizes']);

        $deleteSizesQuery = "DELETE FROM sizes WHERE product_id=?";
        $deleteSizesStmt = $db->prepare($deleteSizesQuery);
        $deleteSizesStmt->bind_param("i", $productId);
        $deleteSizesStmt->execute();
        $deleteSizesStmt->close();

        foreach ($sizes as $size) {
            $sizeInsertQuery = "INSERT INTO sizes (size, product_id) VALUES (?, ?)";
            $sizeInsertStmt = $db->prepare($sizeInsertQuery);
            $sizeInsertStmt->bind_param("is", $size , $productId);
            $sizeInsertStmt->execute();
            $sizeInsertStmt->close();
        }
    
        $db->close();
        header("Location:products.php");
        exit();
    } else {
        $stmt->close();
        $db->close();
        echo "Error";
    }
}
?>
