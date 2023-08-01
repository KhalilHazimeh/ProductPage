<?php
include ("variables.php");

// Start or resume the session
session_start();

//$allCartItems = $_SESSION['cart_items'] ?? [];
if(!isset($_SESSION['cart_items'])) {
    $_SESSION['cart_items'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $product = array(
    'Product_Id' => $_POST['product_id'],
    'Product_Price' => $_POST['price'],
    'Product_Quantity' => $_POST['quantity'],
    'Product_Size' => $_POST['size'],
    'Product_Flavor' => $_POST['flavor'],
    );

    $_SESSION['cart_items'][$_POST['product_id']] = $product;
    

    header('Location: http://localhost/ProductPage/ProductPage/product.php?id='.$id);
    exit();
    }

?>



