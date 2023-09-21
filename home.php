<?php
session_start();
include("head.php");
$loggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'];
require 'product.php';
$conn = new mysqli("localhost", "root", "", "logindb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$product_id = isset($_GET['product_id']) ? $_GET['product_id'] : 1;
$productInfo = new Product($conn);
$product = $productInfo->getProduct($product_id);
if ($product) {
?>
<!DOCTYPE html>
<html lang="en">
<body>
    <section class="free_shipping_alert">
        <div>Enjoy FREE SHIPPING on orders over 80 AED</div>
    </section>
    <section class="top-nav-bar">
            <div class="top-nav">
                <div class="row justify-content-between">
                    <div class="col-xl-6 col-lg-6">
                    <div class="top-nav-left d-none d-lg-block">
                        <span>Dr Nutrition UAE</span>
                    </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                    <div class="top-nav-right">
                        <ul class="list-inline top-nav-right-list">
                            <li>
                                <a title="Contact" href="#">
                                    <i class="fa-solid fa-phone" style="color: #68367f; margin-right: 10px;"></i>
                                    Contact
                                </a>
                            </li>
                            <li>
                                <a title="AED" href="">
                                    <i class="fa-solid fa-money-bill " style="color: #68367f; margin-right: 10px;"></i>
                                    AED
                                </a>
                            </li>
                            <li>
                                <a  title="Login" data-bs-toggle="modal" data-bs-target="#exampleModal"  href="<?php echo $loggedIn ? "home.php?logout=1" : "login.php"; ?>">
                                    <i class="fa-solid fa-right-to-bracket"style="color: #68367f; margin-right: 10px;"></i>
                                    <?php echo $loggedIn ? "My Account" : "Login"; ?>
                                </a>
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action= "login.php" method="post" >
                                                <?php
                                                    if (isset($_GET['status']) && $_GET['status'] === 'failed') {
                                                        echo '<p style="color: red;">Incorrect username or password.</p>';
                                                    }
                                                ?>
                                                    <div class="row">
                                                        <div class="col-xl-12 col-lg-12" style="padding-bottom: 20px;">
                                                            <div class="row">
                                                                <div class="col-xl-4 col-lg-4">
                                                                    <label for="Username" style="font-size: 20px; padding-right: 20px;">Username</label>
                                                                </div>
                                                                <div class="col-xl-8 col-lg-8">
                                                                    <input name="username" type="text" class="Username">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12 col-lg-12" style="padding-bottom: 20px;">
                                                            <div class="row">
                                                                <div class="col-xl-4 col-lg-4">
                                                                    <label for="password" style="font-size: 20px; padding-right: 20px;">Password</label>
                                                                </div>
                                                                <div class="col-xl-8 col-lg-8">
                                                                    <input name="password" type="text" class="password">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12 col-lg-12" style="padding-bottom: 20px;">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <input type="submit" value="Login">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a  data-bs-target="#exampleModalToggle" data-bs-toggle="modal">
                                    <i class="fa-solid fa-right-to-bracket"style="color: #68367f; margin-right: 10px;"></i>
                                    Register
                                </a>
                                <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Register</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                                <form action= "register.php" method="post" >
                                                <?php
                                                    if (isset($_GET['register']) && $_GET['register'] === 'failed') {
                                                        echo '<p style="color: red;">Username not available.</p>';
                                                    }
                                                ?>
                                                    <div class="row">
                                                        <div class="col-xl-12 col-lg-12" style="padding-bottom: 20px;">
                                                            <div class="row">
                                                                <div class="col-xl-4 col-lg-4">
                                                                    <label for="Username" style="font-size: 20px; padding-right: 20px;">Username</label>
                                                                </div>
                                                                <div class="col-xl-8 col-lg-8">
                                                                    <input name="username" type="text" class="Username">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12 col-lg-12" style="padding-bottom: 20px;">
                                                            <div class="row">
                                                                <div class="col-xl-4 col-lg-4">
                                                                    <label for="password" style="font-size: 20px; padding-right: 20px;">Password</label>
                                                                </div>
                                                                <div class="col-xl-8 col-lg-8">
                                                                    <input name="password" type="text" class="password">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12 col-lg-12" style="padding-bottom: 20px;">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <input type="submit" value="Register">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                    </div>
                                </div>
                                </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
    <header class="header-wrap">
        <div class="header-wrap-inner">
                <div class="row flex-nowrap justify-content-between position-relative">
                    <div class="col-xl-3 col-lg-3 header-column-left">
                        <a title="Dr Nutrition UAE | Online Supplement & Nutrition Store" href="https://drnutrition.com/en-ae" class="header-logo">
                            <img  src="images/headerlogo.png" alt="logo">
                        </a>
                    </div>
                    <div class="col-xl-7 col-lg-7 header-search-wrap">
                        <div class="header-search">
                            <form class="searchform">
                                <div class="header-search-form">
                                    <input type="text" name="query" id="searchInput" autocomplete="off" placeholder="Search for porducts" class="form-control search-imput">
                                    <div class="header-search-icon">
                                        <button onclick="searchText()" class="btn btn-search">
                                            <i class="fa-solid fa-magnifying-glass" style="color: white;"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 header-column-right d-flex">
                        <div class="header-cart">
                            <div class="icon-wrap">
                                <i class="fa-solid fa-cart-plus" style="font-size: 31px; line-height: 36px; color: #191919; transition: .15s ease-in-out;"></i>
                                <div id="count-basket" class="count">0</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section class="nav-wrap">
            <div class="navigation-inner">
                <div class="category-nav">
                    <div class="category-nav-inner">
                        All Categories
                        <i class="fa-solid fa-bars" style="padding-left: 50px; font-size: 20px;"></i>
                    </div>
                </div>
                <div class="navbar-sec">
                <nav class="navbar">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Offers&Stacks</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ">Health Packages</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ">Stores</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ">BMI Calculator</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ">Book Appointment</a>
                        </li>
                    </ul>
                </nav>
            </div>
            </div>        
    </section>
    <section class="info">
        <form id= "addToCartForm">
            <input type="hidden" name="product_id" value= "<?php echo $id ?>">
            <input type="hidden" name="name" value= "<?php echo $product['name']; ?>">
            <input type="hidden" name="price" value="<?php  echo $product['price']; ?>">
            <input type="hidden" name="quantity" value="1">
            <input type="hidden" name="size" value= "<?php 'Size' ?>">
            <input type="hidden" name="flavor" value= "<?php 'Flavor' ?>">
        <div class="info">
            <div class="row">
                <div class="col-xl-4 col-lg-4 image-box">
                    <img class=" product-img img-fluid" src="<?php echo $product['image'];?>" alt="">
                </div>
                <div class="col-xl-5 col-lg-5 details">
                    <div class="details-info">
                        <h3 id="product-title"><?php echo $product['name']; ?></h3>
                        <span class="free-delivery"><i class="las la-truck"></i>
                            Free Delivery On Orders Above AED&nbsp;80
                        </span>
                        <p id="brand-title">Brand: <?php echo $product['brand_name']; ?></p>
                    </div>
                    <div class="details-info-middle">
                        <div class="product-variants">
                        <?php 
                        $sql_option_id = "SELECT option_id FROM product_options WHERE product_id = $product_id";
                        $result_option_id = $conn->query($sql_option_id);
                        $idArray = array();
                        if ($result_option_id->num_rows > 0) {
                            while ($row_option_id = $result_option_id->fetch_assoc()) {
                                $id = $row_option_id['option_id'];
                                $idArray[]=$row_option_id['option_id'];
                                
                                echo '<div class="form-group variant-custom-selection">';
                                echo '<div class="row">';
                                echo '<div class="col-lg-6">';
                                
                                $sql_option_name = "SELECT name FROM options WHERE id = $id";
                                $result_option_name = $conn->query($sql_option_name);
                                if ($result_option_name->num_rows > 0) {
                                    $row_option_name = $result_option_name->fetch_assoc();
                                    echo '<label>' . $row_option_name['name'] . '</label>';
                                }
                                
                                echo '</div>';
                                echo '<div class="col-lg-14">';
                                echo '<ul id="optionList'.$id.'" class="list-inline form-custom-radio custom-selection">';

                                $printedValueNames = array();

                                if ($id == $idArray[0]) {
                                    $optionQuery = "SELECT first_option_value_id FROM product_option_combinations WHERE product_id = $product_id AND first_option_id= $id";
                                    $result = $conn->query($optionQuery);
                                    if ($result->num_rows > 0) {
                                        while ($row_size = $result->fetch_assoc()) {
                                            $value_id = $row_size['first_option_value_id'];
                                            $valueQuery = "SELECT value_name FROM option_values WHERE id = $value_id";
                                            $valueResult = $conn->query($valueQuery);
                                            if ($valueResult->num_rows > 0) {
                                                $valueRow = $valueResult->fetch_assoc();
                                                $value_name = $valueRow['value_name'];
                                                
                                                if (!in_array($value_name, $printedValueNames)) {
                                                    echo '<li id="li_size_'.$value_id.'" data-id="'.$value_id.'" class="option1">';
                                                    echo '<span href="#" class="option-label">' . $value_name . ' </span>';
                                                    echo '</li>';
                                                    
                                                    $printedValueNames[] = $value_name;
                                                }
                                            }
                                        }
                                echo '</ul>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                                }
                            }
                            elseif ($id == $idArray[1]) {
                            echo '<div class="optionList2"></div>';
                        }
                    }
                    }
                    ?>
                    </div>

                    <div class="bullet-points">
                        <ul>
                            <li>28 g Protein Per 30 g Serving (May vary from flavor to another)</li> 
                            <li>0 sugar &amp; 0 carb &amp; 0 fat</li> 
                            <li>Rapidly Absorbed</li> 
                            <li>Supports Muscle Growth</li> 
                            <li>Supports muscle recovery</li>
                        </ul>
                    </div> 
                    <div class="additional-info-new">
                        <ul>
                            <li class="sku">
                                <label>Barcode:</label> 
                                <span>6290360501499</span>
                            </li> 
                            <li class="sku">
                                <label>Item No:</label> 
                                <span>AE-00015681</span>
                            </li> 
                            <li class="sku">
                                <label>Dimensions:</label> 
                                <span>21</span> 
                                <span>×</span> 
                                <span>31</span> 
                                <span>×</span> 
                                <span>21</span> 
                                <span>CM</span>
                            </li> 
                            <li class="sku">
                                <label>Weight:</label> 
                                <span>1.82</span> 
                                <span>KG</span>
                            </li> 
                            <li>
                                <label>Categories:</label> 
                                <div>
                                    <?php
                                        echo '<ul class="list-inline form-custom-radio custom-selection">';
                                        $categoryNames = $productInfo->getProductCategories($product_id);
                                        foreach ($categoryNames  as $categoryName) {
                                            echo '<li class="">';
                                            echo '<span href="#" class="option-label">' . $categoryName . ' </span>';
                                            echo '</li>';
                                        }
                                        echo '</ul>';                                            
                                    ?>
                                    </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        <div class="col-xl-3 col-lg-3 right-side-bar">
            <aside class="right-sidebar for-product-show">
                <div class="details-info-middle right-product-details">
                    <div class="product-price d-none d-md-block">
                        <span class="pricee">AED <span id="originalPrice"><?php echo $product['price'];?></span> </span>
                        <span class="previous-price">AED <?php echo $product['old-price']; ?></span>
                    </div>
                    <div class="details-info-middle-actions">
                        <div class="number-picker">
                            <label for="qty">Quantity</label> 
                            <button type="button" onclick="decrement()" class="btn btn-number btn-minus">
                                <i class="fa-solid fa-minus"></i>
                            </button> 
                            <span id="counter">1</span>
                            <button type="button" onclick="increment()" class="btn btn-number btn-plus">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </div>
                    <div>
                        <button id ="addToCartButton" class="btn-add-to-cart">
                            <i class="fa-solid fa-cart-shopping"></i>
                            Add to Cart
                        </button>
                        <div class="btn-add-to-cart" id="loading" style="display: none;">Loading...</div>
                        <div id="message"></div>
                    </div>
                    </div>
                    <div>
                        <button type="button" id="openNavBtn" data-toggle="offcanvas" data-target="#myNav" class="btn-checkout">
                            <i class="fa-solid fa-money-check-dollar"></i>   
                            Continue to Checkout
                        </button>
                        <div class="offcanvas offcanvas-end" tabindex="-1" id="myNav">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title">Your Basket</h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div id="offcanvas-body" class="offcanvas-body">
                                <div id= "offcanvas-cart">
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
        </aside>
    </div>
</div>
</div>
</form>
</section>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.min.js"></script>
    <script src="js/mainj.js?v=<?php echo time()?>"></script>
    <script type="text/javascript">
        var productId = <?php echo $product_id; ?>;
    </script>
</body>
</html>
<?php
} else {
    // Failed to retrieve product details
    echo "Product not found.";
}
$conn->close();

?>
