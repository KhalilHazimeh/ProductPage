<?php
include("../product.php");
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logindb";
$db = new mysqli($servername, $username, $password, $dbname);
$product = new Product($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST["name"];
    $price = $_POST["price"];
    $old_price = $_POST["oldPrice"];
    $image = ''; 
    $brand_id = $_POST["brandID"];
    $selectedCategories = isset($_POST['categories']) ? $_POST['categories'] : array();
    $optionIds = isset($_POST['product_options']) ? $_POST['product_options'] : array();
    $combinations = isset($_POST['combinations']) ? $_POST['combinations'] : array();

    if ($product->addProduct($id, $name, $price, $old_price, $image, $brand_id, $selectedCategories)) {
        $productId = $id;
    
        $insertedOptionIds = array();
    
        foreach ($optionIds as $optionId) {
            $insertOptionQuery = "INSERT INTO product_options (product_id, option_id) VALUES ($productId, $optionId)";
            echo($insertOptionQuery);
            $db->query($insertOptionQuery);
            if ($db->affected_rows > 0) {
                $insertedOptionIds[] = $optionId;
            }

        }
    
        for ($i = 0; $i < count($combinations); $i += 2) {
            $firstOptionValueId = (int)$combinations[$i];
            $secondOptionValueId = (int)$combinations[$i + 1];

            foreach ($insertedOptionIds as $optionId) {
                $insertCombinationQuery = "INSERT INTO product_option_combinations (product_id, first_option_id, first_option_value_id, second_option_id, second_option_value_id) VALUES ($productId, $optionId, $firstOptionValueId, $optionId, $secondOptionValueId)";
                echo($insertCombinationQuery);
                $db->query($insertCombinationQuery);
            }
        }
    
        //header("Location: http://localhost/ProductPage/ProductPage/admin/products.php");
        //exit; 
    } else {
        echo "Failed to add product.";
    }
}
?>
