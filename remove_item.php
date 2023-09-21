<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    if (isset($_SESSION['cart_items'][$product_id])) {
        // Remove the item from the cart
        unset($_SESSION['cart_items'][$product_id]);
        $response = array('status' => 'success');
        echo json_encode($response);
        exit;
    } else {
        $response = array('status' => 'error', 'message' => 'Item not found in cart.');
        echo json_encode($response);
        exit;
    }
} else {
    $response = array('status' => 'error', 'message' => 'Invalid request.');
    echo json_encode($response);
    exit;
}
?>
