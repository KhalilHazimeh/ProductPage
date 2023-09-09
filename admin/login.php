<?php
session_start();
include("../DB_connection.php");

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
        $_SESSION['username']= $_POST['username'];
        header("Location:products.php");
        exit();
    } else {
        header("Location: http://localhost/ProductPage/ProductPage/admin?status=failed");
        exit();
    }
}
$conn->close();
?>
