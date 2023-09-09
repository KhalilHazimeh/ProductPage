<?php
session_start();
include("DB_connection.php");
$id = isset($_GET['product_id']) ? $_GET['product_id'] : 1;


function authenticateUser($username, $password, $conn) {
    $sanitizedUsername = $conn->real_escape_string($username);
    $sanitizedPassword = $conn->real_escape_string($password);

    $query = "SELECT * FROM users WHERE username = '$sanitizedUsername' AND pwd = '$sanitizedPassword'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredUsername = $_POST['username'];
    $enteredPassword = $_POST['password'];

    if (authenticateUser($enteredUsername, $enteredPassword, $conn)) {
        $_SESSION['loggedin'] = true;
        header("Location:products.php");
        exit();
    } else {
        header("Location: http://localhost/ProductPage/ProductPage/home.php?status=failed");
        exit();
    }
}
$conn->close();
?>
