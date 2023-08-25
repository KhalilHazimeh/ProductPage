<?php
/*include("DB_connection.php");
$id = isset($_GET['product_id']) ? $_GET['product_id'] : 1;

$query = "SELECT size_id, size FROM sizes WHERE product_id = $id";

$result = mysqli_query($conn, $query);

if (!$result) {
    die('Query execution failed.');
}

$sizes_array = array();

while ($row = mysqli_fetch_assoc($result)) {
    $sizes_array[$row['size_id']] = $row['size'];
}

mysqli_close($conn);*/