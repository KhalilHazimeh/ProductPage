<?php
include("../product.php");
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logindb";
$db = new mysqli($servername, $username, $password, $dbname);
$product = new Product($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = Null; // auto-increment
    $name = $_POST["name"];
    $price = $_POST["price"];
    $old_price = $_POST["oldPrice"];
    $image = ''; 
    $brand_id = $_POST["brandID"];
    $selectedCategories = isset($_POST['categories']) ? $_POST['categories'] : array();
    $optionIds = isset($_POST['product_options']) ? $_POST['product_options'] : array();
    $combinations = isset($_POST['combinations']) ? $_POST['combinations'] : array();
    $firstOptionId = 0;
    $secondOptionId = 0;
    if ($productId = $product->addProduct($id, $name, $price, $old_price, $image, $brand_id, $selectedCategories)) {
    
        $insertedOptionIds = array();
    
        foreach ($optionIds as $key => $optionId) {
            if($key == 0){
                $firstOptionId = $optionId;
            }
            if($key == 1){
                $secondOptionId = $optionId;
            }
            else{
                $secondOptionId = 'NULL';
            }
            $insertOptionQuery = "INSERT INTO product_options (product_id, option_id) VALUES ($productId, $optionId)";
            $db->query($insertOptionQuery);
            if ($db->affected_rows > 0) {
                $insertedOptionIds[] = $optionId;
            }
        }

        for ($i = 0; $i < count($combinations[$firstOptionId]); $i++) {
            $firstOptionValueId = (int)$combinations[$firstOptionId][$i];
            $secondOptionValueId = 'Null';
            if(isset($combinations[$secondOptionId][$i])){
                $secondOptionValueId = (int)$combinations[$secondOptionId][$i];
            }

            $insertCombinationQuery = "INSERT INTO product_option_combinations (product_id, first_option_id, first_option_value_id, second_option_id, second_option_value_id) VALUES ($productId, $firstOptionId, $firstOptionValueId, $secondOptionId, $secondOptionValueId)";
            $db->query($insertCombinationQuery);
        }
    
        header("Location: products.php");
        exit; 
    } else {
        echo "Failed to add product.";
    }
}
?>
