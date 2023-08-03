<?php
include("variables.php");
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logindb";

$conn = new mysqli($servername, $username, $password, $dbname);

$userName = $_POST['username'];
$pwd = $_POST['password'];


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

    $sql = "SELECT COUNT(*) FROM users WHERE username = '$userName'";
    $result = $conn->query($sql);
    $count = $result->fetch_row()[0];
    if ($count>0){
        header("Location: http://localhost/ProductPage/ProductPage/product.php?".$id."?register=failed");
        exit();
    }
    else{
        $sql = "INSERT INTO users (username, pwd) VALUES (?, ?);";
        $stmt = $conn->prepare($sql);
        $stmt ->execute([$userName,$pwd]);
        $conn=null;
        $stmt=null;
        header("Location: http://localhost/ProductPage/ProductPage/product.php?id=".$id);
        exit();
        $_SESSION['loggedin'] = true;
    }
$conn->close();
?>
