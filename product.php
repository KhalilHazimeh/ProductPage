<?php
class Product {
    private $conn;
    private $table_name = "products";

    public $id;
    public $name;
    public $price;
    public $old_price;
    public $image;
    public $brand_id;
    public $brand_name;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getProduct($id) {
        $query = "SELECT p.*, b.brand_name FROM " . $this->table_name . " p
        LEFT JOIN brands b ON p.brand_id = b.brand_id
        WHERE p.id = $id LIMIT 1";
        $result = $this->conn->query($query);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $this->name = $row['name'];
            $this->price = $row['price'];
            $this->old_price = $row['old-price'];
            $this->image = $row['image'];
            $this->brand_id = $row['brand_id'];
            $this->brand_name = $row['brand_name'];
            return true;
        }

        return false;
        }

public function getProductCategories($id){
    $query = "SELECT c.category_name
            FROM categories c
            JOIN product_categories pc ON c.category_id = pc.category_id
            WHERE pc.product_id =$id";
    $categ = $this->conn->query($query);

    $categoryNames = [];

    if ($categ && $categ->num_rows > 0) {
        while ($row = $categ->fetch_assoc()) {
            $categoryNames[] = $row['category_name'];
        }
    }

    return $categoryNames;
}


public function getProductSizes($id) {
    $query = "SELECT size_id,size FROM sizes WHERE product_id = $id";
    $result = $this->conn->query($query);

    $sizes = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $sizes[$row['size_id']] = $row['size'];
        }
    }

    return $sizes;
}

public function getProductFlavors($id) {
    $query = "SELECT sizes.size_id, flavor_id, flavor FROM falvors
    INNER JOIN sizes ON falvors.size_id = sizes.size_id
    INNER JOIN products ON sizes.product_id = products.id
    WHERE products.id = $id";
    $result = $this->conn->query($query);

    $flavors = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $flavors[$row['flavor_id'].":".$row['size_id']] = $row['flavor'];
        }
    }
    return $flavors;

}
public function getAllProductValues() {

    $query = "SELECT * FROM products"; 
    $result = $this->conn->query($query);

        $products = [];
        $count=0;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
                $count++;
            }
        }

        return ['products' => $products, 'count' => $count];
}

public function addProduct($id,$name, $price, $old_price, $image, $brand_id) {
    $id = intval($id);
    $name = $this->conn->real_escape_string($name);
    $price = floatval($price);
    $old_price = floatval($old_price);
    $image = $this->conn->real_escape_string($image);
    $brand_id = intval($brand_id);

    $query = "INSERT INTO `products`(`id`, `name`, `price`, `old-price`, `image`, `brand_id`) VALUES ($id, '$name', $price, $old_price, '$image', $brand_id);";
    if ($this->conn->query($query)) {
        return true;
    } else {
        return false;
    }
}

public function deleteProduct($id) {
    $query = "DELETE FROM `products` WHERE id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

}
?>
