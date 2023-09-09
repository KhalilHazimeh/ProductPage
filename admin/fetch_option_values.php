<?php
include("../product.php");
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logindb";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['optionID'])) {
    $optionID = $_POST['optionID'];
    
    $query = "SELECT id, value_name FROM option_values WHERE option_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $optionID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        $optionValues = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($optionValues);
    } else {
        echo json_encode([]);
    }
} else {
    echo json_encode([]);
}

$stmt->close();
$conn->close();
?>
