<?php
include("DB_connection.php");
$id = isset($_GET['product_id']) ? $_GET['product_id'] : 1;

$sql = "SELECT * FROM products WHERE id = " . $id;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
} else {
    echo "Product not found.";
    exit;
}


$query = "SELECT b.brand_name
        FROM brands b
        JOIN products p ON p.brand_id = b.brand_id
        WHERE p.id = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    
    $stmt->bind_result($brand_name);
    
    if ($stmt->fetch()) {
        $brand= $brand_name;
    } else {
        echo "Product not found or brand information not available.";
    }
    $stmt->close();


$sql2= " SELECT c.category_name
        FROM categories c
        JOIN product_categories pc ON c.category_id = pc.category_id
        WHERE pc.product_id = ".$id;

    $cat_result = $conn->query($sql2);
    
    $categories_array = array();

    while ($row = mysqli_fetch_assoc($cat_result)) {
        $categories_array[] = $row['category_name'];
    }
    
$conn->close();
?>
