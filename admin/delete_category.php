<?php
include("../product.php");
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logindb";
$db = new mysqli($servername, $username, $password, $dbname);
$category = new Category($db);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete_category_id'])) {
        $category_id = $_POST['delete_category_id'];
        $deleteProductCategoryQuery = "DELETE FROM product_categories WHERE category_id=?";
        $deleteProductCategoryStmt = $db->prepare($deleteProductCategoryQuery);
        $deleteProductCategoryStmt->bind_param("i", $categoryId);
        if ($deleteProductCategoryStmt->execute()) {
            $deleteProductCategoryStmt->close();
            if ($category->deleteCategory($category_id)) {
                header('Location: http://localhost/ProductPage/ProductPage/admin/categories.php');
                exit;
            } else {
                echo "Error deleting brand.";
            }
    }
}
}
?>