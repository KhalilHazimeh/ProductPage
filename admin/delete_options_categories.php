<?php
include("../product.php");
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logindb";
$db = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete_option_id'])) {
        $delete_option_id = $_POST['delete_option_id'];
        $sql2 = "DELETE FROM options WHERE id = $delete_option_id";
        $db->query($sql2); // Execute the query without checking the result
            header("Location: http://localhost/ProductPage/ProductPage/admin/options_categories.php");
            exit;
            }
    }

?>