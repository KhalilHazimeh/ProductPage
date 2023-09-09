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
            return $result->fetch_assoc();
            // $row = $result->fetch_assoc();
            // $this->name = $row['name'];
            // $this->price = $row['price'];
            // $this->old_price = $row['old-price'];
            // $this->image = $row['image'];
            // $this->brand_id = $row['brand_id'];
            // $this->brand_name = $row['brand_name'];
            // return true;
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

    $query = "SELECT p.id, p.name, p.price, p.`old-price`, b.brand_name,
    GROUP_CONCAT(DISTINCT c.category_name ORDER BY c.category_name ASC) AS categories
    FROM products p
    LEFT JOIN product_categories pc ON p.id = pc.product_id
    LEFT JOIN categories c ON pc.category_id = c.category_id
    LEFT JOIN brands b ON p.brand_id = b.brand_id
    GROUP BY p.id"; 

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

public function addProduct($id, $name, $price, $old_price, $image, $brand_id, $selectedCategories) {
    //$id = intval($id);
    $name = $this->conn->real_escape_string($name);
    $price = floatval($price);
    $old_price = floatval($old_price);
    $image = $this->conn->real_escape_string($image);
    $brand_id = intval($brand_id);

    $query = "INSERT INTO `products`(`id`, `name`, `price`, `old-price`, `image`, `brand_id`) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("issdis", $id, $name, $price, $old_price, $image, $brand_id);

    if ($stmt->execute()) {
        $productId = $stmt->insert_id;
        foreach ($selectedCategories as $categoryId) {
            $categoryQuery = "INSERT INTO `product_categories`(`product_id`, `category_id`) VALUES (?, ?)";
            $categoryStmt = $this->conn->prepare($categoryQuery);
            $categoryStmt->bind_param("ii", $productId, $categoryId);
            
            if (!$categoryStmt->execute()) {
                return false;
            }
        }
        return $productId;
    } else {
        return false;
    }
}



public function deleteProduct($id) {
    $categoryQuery = "DELETE FROM `product_categories` WHERE product_id = ?";
    $categoryStmt = $this->conn->prepare($categoryQuery);
    $categoryStmt->bind_param("i", $id);

    $sizeQuery = "DELETE FROM `sizes` WHERE product_id = ?";
    $sizeStmt = $this->conn->prepare($sizeQuery);
    $sizeStmt->bind_param("i", $id);
    
    $productQuery = "DELETE FROM `products` WHERE id = ?";
    $productStmt = $this->conn->prepare($productQuery);
    $productStmt->bind_param("i", $id);

    $this->conn->begin_transaction();
    
    if ($categoryStmt->execute()) {
        if ($sizeStmt->execute()) {
            if ($productStmt->execute()) {
                $this->conn->commit();
                return true;
        }
    }
}
}

public function deleteAllProduct() {
    $query = "DELETE FROM products";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// Inside your Product class
public function getProductWithSizesAndFlavors($productId) {
    $productQuery = "SELECT * FROM products WHERE id = $productId";
    $productResult = $this->conn->query($productQuery);
    
    if ($productResult->num_rows > 0) {
        $productData = $productResult->fetch_assoc();
        
        $sizesQuery = "SELECT size_id, size FROM sizes WHERE product_id = $productId";
        $sizesResult = $this->conn->query($sizesQuery);
        $sizes = array();
        
        while ($sizeRow = $sizesResult->fetch_assoc()) {
            $sizeId = $sizeRow['size_id'];
            
            $flavorsQuery = "SELECT flavor FROM falvors WHERE size_id = $sizeId";
            $flavorsResult = $this->conn->query($flavorsQuery);
            $flavors = array();
            
            while ($flavorRow = $flavorsResult->fetch_assoc()) {
                $flavors[] = $flavorRow['flavor'];
            }
            
            $sizeRow['flavors'] = $flavors;
            $sizes[] = $sizeRow;
        }
        
        $productData['sizes'] = $sizes;
        return $productData;
    } else {
        return false;
    }
}


}
class Brand{
    private $conn;
    private $table_name = "brands";

    public $brand_id;
    public $brand_name;

    public function __construct($db) {
        $this->conn = $db;
    }

public function getAllBrands() {

    $query = "SELECT * FROM brands"; 
    $result = $this->conn->query($query);

        $brands = [];
        $count=0;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $brands[] = $row;
                $count++;
            }
        }

        return ['brands' => $brands, 'count' => $count];
}

public function addBrand($name) {
    $name = $this->conn->real_escape_string($name);

    $query = "INSERT INTO `brands`(`brand_name`) VALUES ('$name');";
    if ($this->conn->query($query)) {
        return true;
    } else {
        return false;
    }
}

public function deleteBrand($id) {
    $query = "DELETE FROM `brands` WHERE brand_id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}
}

class Category{
    private $conn;
    private $table_name = "categories";

    public $category_id;
    public $category_name;

    public function __construct($db) {
        $this->conn = $db;
    }

public function getAllCategories() {

    $query = "SELECT * FROM categories"; 
    $result = $this->conn->query($query);

        $categories = [];
        $count=0;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row;
                $count++;
            }
        }

        return ['categories' => $categories, 'count' => $count];
}

public function addCategory($name) {
    $name = $this->conn->real_escape_string($name);

    $query = "INSERT INTO `categories`(`category_name`) VALUES ('$name');";
    if ($this->conn->query($query)) {
        return true;
    } else {
        return false;
    }
}

public function deleteCategory($id) {
    $query = "DELETE FROM `categories` WHERE category_id = ?";
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
