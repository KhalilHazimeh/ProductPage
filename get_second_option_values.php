<?php

$id = isset($_POST['product_id']) ? $_POST['product_id'] : 1;
include("DB_connection.php");

$valueId = $_POST['valueId'];

$sql = "SELECT second_option_value_id FROM product_option_combinations WHERE first_option_value_id = $valueId AND product_id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $values = array();
    while ($row = $result->fetch_assoc()) {
        $valueId = $row['second_option_value_id'];
        $nameSql = "SELECT value_name FROM option_values WHERE id = $valueId";

        $nameResult = $conn->query($nameSql);

        if ($nameResult->num_rows > 0) {
            while ($nameRow = $nameResult->fetch_assoc()) {
                $values[] = $nameRow['value_name'];
            }
        }
    }
    echo json_encode($values);
} else {
    echo "No values found";
}
?>