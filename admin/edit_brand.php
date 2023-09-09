<?php
include("../product.php");
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logindb";
$db = new mysqli($servername, $username, $password, $dbname);
$brand = new Brand($db);

if (isset($_GET['edit_brand_id']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $brandId = $_GET["edit_brand_id"];
    $title = $_POST["title"];

    $sql = "UPDATE brands SET brand_name=? WHERE brand_id=?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("si", $title, $brandId);

    if ($stmt->execute()) {
        $stmt->close();
        $db->close();
        header("Location:brands.php");
        exit();
    } else {
        $stmt->close();
        $db->close();
        echo "Error";
    }
}
?>
