<?php
session_start();

if (isset($_POST['item_id'])) {
    $item_id = $_POST['item_id'];
    
    if (isset($_SESSION['cart_items'][$item_id])) {
        unset($_SESSION['cart_items'][$item_id]);
    }
}
?>
