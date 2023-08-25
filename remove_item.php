<?php
session_start();

if (isset($_POST['item_id'])) {
    $item_id = $_POST['item_id'];
    
    if (isset($_SESSION['cart_items'][$item_id])) {
        unset($_SESSION['cart_items'][$item_id]);
    }

    $response = array('status' => 'success');
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
?>
