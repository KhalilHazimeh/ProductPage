<?php
session_start();

$cartItems = [];
if (isset($_SESSION['cart_items']) && is_array($_SESSION['cart_items'])) {
    foreach ($_SESSION['cart_items'] as $id => $item) {
        $cartItems[] = [
            'Product_Name' => $item['Product_Name'],
            'Product_Size' => $item['Product_Size'],
            'Product_Quantity' => $item['Product_Quantity'],
            'Product_Flavor' => $item['Product_Flavor'],
            'Product_Price' => $item['Product_Price']
        ];
    }
}

//$htmlCartItems = '<div></div>'

$response = ['cartItems' => $cartItems];

header('Content-Type: application/json');
echo json_encode($response);
?>
