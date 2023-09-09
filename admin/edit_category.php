<?php
include("../product.php");
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logindb";
$db = new mysqli($servername, $username, $password, $dbname);
$category = new Category($db);

if (isset($_GET['edit_category_id']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $categoryId = $_GET["edit_category_id"];
    $title = $_POST["title"];

    $sql = "UPDATE categories SET category_name=? WHERE category_id=?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("si", $title, $categoryId);

    if ($stmt->execute()) { 
        $stmt->close();
        $db->close();
        header("Location:categories.php");
        exit();
    } else {
        $stmt->close();
        $db->close();
        echo "Error";
    }
}
?>
