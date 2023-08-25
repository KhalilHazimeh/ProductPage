<?php

session_start();

if(!isset($_SESSION['cart_items'])) {
    $_SESSION['cart_items'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $product = array(
    'Product_Id' => $_POST['product_id'],
    'Product_Name' => $_POST['name'],
    'Product_Price' => $_POST['price'],
    'Product_Quantity' => $_POST['quantity'],
    'Product_Size' => $_POST['size'],
    'Product_Flavor' => $_POST['flavor'],
    );

    $productId = md5($product['Product_Name'] . $product['Product_Size'] . $product['Product_Flavor']);
    if (isset($_SESSION['cart_items'][$productId])) {
        $_SESSION['cart_items'][$productId]['Product_Quantity'] += $product['Product_Quantity'];
        $_SESSION['cart_items'][$productId]['Product_Price'] = $product['Product_Price'];
    } else {
        $_SESSION['cart_items'][$productId] = $product;
    }
    $response = array('status' => 'success', 'message' => 'Product added to cart successfully!');
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
    }

?>



