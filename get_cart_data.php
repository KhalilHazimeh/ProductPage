<?php
session_start();

$cartItems = [];
if (isset($_SESSION['cart_items']) && is_array($_SESSION['cart_items'])) {
    foreach ($_SESSION['cart_items'] as $id => $item) {
        $cartItems[] = [
            'Proudct_Id' =>  $id,
            'Product_Name' => $item['Product_Name'],
            'Product_Option1' => $item['Product_Option1'],
            'Product_Quantity' => $item['Product_Quantity'],
            'Product_Option2' => $item['Product_Option2'],
            'Product_Price' => $item['Product_Price']
        ];
    }
}

//$htmlCartItems = '<div></div>'

$response = ['cartItems' => $cartItems];

header('Content-Type: application/json');
echo json_encode($response);
?>
