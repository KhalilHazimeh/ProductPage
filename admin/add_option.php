<?php
include("../product.php");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logindb";
$db = new mysqli($servername, $username, $password, $dbname);

// Check for database connection errors
if ($db->connect_error) {
    die("Database connection failed: " . $db->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $optionId = $_POST["option_id"];
    $valueName = $_POST["value_name"];
    
    $queryCheck = "SELECT id FROM option_values WHERE value_name = ?";
    $stmtCheck = $db->prepare($queryCheck);
    $stmtCheck->bind_param("s", $valueName);
    $stmtCheck->execute();
    
    if ($stmtCheck->fetch()) {
        echo "Value name already exists. Please choose a different one.";
    } else {
        $queryInsert = "INSERT INTO option_values (option_id, value_name) VALUES (?, ?)";
        $stmtInsert = $db->prepare($queryInsert);
        $stmtInsert->bind_param("is", $optionId, $valueName);
    
        if ($stmtInsert->execute()) {
            header("Location: http://localhost/ProductPage/ProductPage/admin/options.php");
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
