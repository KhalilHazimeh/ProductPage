<?php
include("../product.php");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logindb";
$db = new mysqli($servername, $username, $password, $dbname);

if ($db->connect_error) {
    die("Database connection failed: " . $db->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $valueName = $_POST["value"];
    
    $queryCheck = "SELECT id FROM options WHERE name = ?";
    $stmtCheck = $db->prepare($queryCheck);
    $stmtCheck->bind_param("s", $valueName);
    $stmtCheck->execute();
    
    if ($stmtCheck->fetch()) {
        echo "Value name already exists. Please choose a different one.";
    } else {
        $queryInsert = "INSERT INTO options (name) VALUES (?)";
        $stmtInsert = $db->prepare($queryInsert);
        $stmtInsert->bind_param("s", $valueName);
    
        if ($stmtInsert->execute()) {
            header("Location: http://localhost/ProductPage/ProductPage/admin/options_categories.php");
            exit;
        } else {
            echo "Error inserting data into the database: " . $stmtInsert->error;
        }
    }
} else {
    echo "Invalid option ID.";
}
$db->close();
?>
