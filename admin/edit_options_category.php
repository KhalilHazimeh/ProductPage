<?php
include("../product.php");
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logindb";
$db = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $editOptionId = $_POST["edit_option_id"];
    $title = $_POST["title"];

    $sql = "UPDATE options SET name=? WHERE id=?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("si", $title, $editOptionId);

    if ($stmt->execute()) { 
        $stmt->close();
        $db->close();
        header("Location:options_categories.php");
        exit();
    } else {
        $stmt->close();
        $db->close();
        echo "Error";
    }
}
?>
