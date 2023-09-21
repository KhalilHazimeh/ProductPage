<?php
include("../product.php");
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logindb";
$db = new mysqli($servername, $username, $password, $dbname);
$product = new Product($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["title"];

    $getProductIdQuery = "SELECT id FROM products WHERE name = '$name'";
    $result = $db->query($getProductIdQuery);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id = $row["id"];

        $deleteCombinationsQuery = "DELETE FROM product_option_combinations WHERE product_id = $id";
        $db->query($deleteCombinationsQuery);
        $deleteOptioQuery = "DELETE FROM product_options WHERE product_id = $id";
        $db->query($deleteOptioQuery);

        $price = $_POST["price"];
        $old_price = $_POST["oldPrice"];
        $image = ''; 
        $brand_id = $_POST["brandID"];
        $selectedCategories = isset($_POST['categories']) ? $_POST['categories'] : array();
        $optionIds = isset($_POST['product_options']) ? $_POST['product_options'] : array();
        $combinations = isset($_POST['combinations']) ? $_POST['combinations'] : array();
        $firstOptionId = 0;
        $secondOptionId = 0;

        $updateProductQuery = "UPDATE products SET name = '$name', price = $price, `old-price` = $old_price, image = '$image', brand_id = $brand_id WHERE id = $id";
        echo($updateProductQuery);
        $db->query($updateProductQuery);

        foreach ($optionIds as $key => $optionId) {
            if ($key == 0) {
                $firstOptionId = $optionId;
            }
            if ($key == 1) {
                $secondOptionId = $optionId;
            }
            else{
                $secondOptionId = 'NULL';
            }
            $updateOptionQuery = "INSERT INTO product_options (product_id, option_id) VALUES($id, $optionId)";
            $db->query($updateOptionQuery);
        }

        for ($i = 0; $i < count($combinations[$firstOptionId]); $i++) {
            $firstOptionValueId = (int)$combinations[$firstOptionId][$i];
            $secondOptionValueId = 'Null';
            if (isset($combinations[$secondOptionId][$i])) {
                $secondOptionValueId = (int)$combinations[$secondOptionId][$i];
            }

            $insertCombinationQuery = "INSERT INTO product_option_combinations (product_id, first_option_id, first_option_value_id, second_option_id, second_option_value_id) VALUES ($id, $firstOptionId, $firstOptionValueId, $secondOptionId, $secondOptionValueId)";
            $db->query($insertCombinationQuery);
        }

        header("Location: products.php");
        exit;
    } else {
        echo "Product not found.";
    }
}
?>
