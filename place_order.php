<?php
session_start();
include("DB_connection.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $address = $_POST['add'];

    $totalPrice = 0;
    foreach ($_SESSION['cart_items'] as $productId => $item) {
        $totalPrice += ($item['Product_Price'] * $item['Product_Quantity']);
    }

    $sql = "INSERT INTO orders (name, phone_number, email, address, total_price) 
            VALUES ('$name', '$number', '$email', '$address','$totalPrice')";
    if ($conn->query($sql) === TRUE) {
        $order_id = $conn->insert_id;

        foreach ($_SESSION['cart_items'] as $productId => $item) {
            $product_id = $item['Product_Id'];
            $option1_id = $item['Product_Option1_Id'];
            $option2_id = $item['Product_Option2_Id'];
            $quantity = $item['Product_Quantity'];
            $price = $item['Product_Price'];

            $sql = "INSERT INTO order_products (order_id, product_id, option1_id, option2_id, quantity, price) 
                    VALUES ('$order_id', '$product_id', '$option1_id', '$option2_id', '$quantity', '$price')";
            $conn->query($sql);
        }

        $_SESSION['cart_items'] = [];

        header("Location: checkout.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>
