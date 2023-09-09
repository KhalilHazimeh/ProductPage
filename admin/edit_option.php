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
    $value = $_POST["value"];

    $sql = "UPDATE option_values SET option_id=?, value_name=? WHERE id=?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("isi", $title, $value, $editOptionId);

    if ($stmt->execute()) { 
        $stmt->close();
        $db->close();
        header("Location:options.php");
        exit();
    } else {
        $stmt->close();
        $db->close();
        echo "Error";
    }
}
?>
