<?php
session_start();
include("variables.php");
$host = 'localhost';
$dbname = 'logindb';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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
        header("Location: http://localhost/ProductPage/ProductPage/product.php?id=".$id);
        exit();
    } else {
        echo "Invalid username or password.";
    }
}
$conn->close();
?>
