<?php

$id = isset($_POST['product_id']) ? $_POST['product_id'] : 1;
include("DB_connection.php");

$valueId = $_POST['valueId'];

$sql = "SELECT second_option_value_id, value_name FROM product_option_combinations
        JOIN option_values ON product_option_combinations.second_option_value_id = option_values.id
        WHERE first_option_value_id = $valueId AND product_id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $values = array();
    while ($row = $result->fetch_assoc()) {
        $values[] = array(
            'id' => $row['second_option_value_id'],
            'name' => $row['value_name']
        );
    }
    echo json_encode($values);
} else {
    echo "No values found";
}
?>