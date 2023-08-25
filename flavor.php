<?php 
/*include("DB_connection.php");
$id = isset($_GET['product_id']) ? $_GET['product_id'] : 1;


$query = "SELECT sizes.size_id, flavor_id, flavor FROM falvors
        INNER JOIN sizes ON falvors.size_id = sizes.size_id
        INNER JOIN products ON sizes.product_id = products.id
        WHERE products.id = $id";


$result = mysqli_query($conn, $query);

if (!$result) {
    die('Query execution failed.');
}

$flavors_array = array();

while ($row = mysqli_fetch_assoc($result)) {
    $flavors_array[$row['flavor_id'].":".$row['size_id']] = $row['flavor'];
}

mysqli_close($conn);*/
?>