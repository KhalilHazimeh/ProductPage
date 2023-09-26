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
                            <button type="button" id="openNavBtn" data-toggle="offcanvas" data-target="#myNav" class="btn-checkout" >
                                <i class="fa-solid fa-cart-plus" style="font-size: 31px; line-height: 36px; color: #191919; transition: .15s ease-in-out;"></i>
                                <div id="count-basket" class="count">0</div>
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
    <section class="info-checkout" style = "padding:50px 100px 50px 100px ">
        <div class="row">
            <div class="col-lg-8">
                <div class="information">
                    <form action="place_order.php" method="post">
                        <div class="row">
                                <label>Full Name * </label>
                                <div class="col-lg-6">
                                <input type= "text" name="name" required></input>
                            </div>
                                <label>Phone Number * </label>
                                <div class="col-lg-6">
                                <input type= "number" name="number" required></input>
                            </div>
                                <label>Email Address * </label>
                                <div class="col-lg-6">
                                <input type= "email" name="email" required></input>
                            </div>
                                <label>Address * </label>
                                <div class="col-lg-6">
                                <input type= "text" name="add" required></input>
                            </div>
                            </div>
                                <div class="col-lg-6 pt-4">
                                <button type="submit" class="btn-success" style="border:none;width:75%;padding:5%">Place Order</button>
                            </div>                        
                    </form>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="right-bar">
                    <h3>ORDER SUMMARY</h3>
                    <div class="cart-items">                     
                        <?php
                        $totalPrice = 0;
                        foreach ($_SESSION['cart_items'] as $productId => $item) {
                            $itemPrice = $item['Product_Price'];
                            $totalPrice += $itemPrice;

                            echo '<div class="item" data-index="' . $productId . '" id="item-' . $productId . '">';
                            echo 'Name: ' . $item['Product_Name'];
                            echo '<br>';
                            echo 'Option 1: ' . $item['Product_Option1'];
                            echo '<br>';
                            echo 'Option 2: ' . $item['Product_Option2'];
                            echo '<br>';
                            echo 'Price per unit: ' . $item['Product_Price'] . ' AED';
                            echo '<br>';
                            echo 'Quantity: ' . $item['Product_Quantity'];
                            echo '<br>';
                            echo 'Subtotal: ' . $itemPrice . ' AED';
                            echo '</li>';
                            echo '<div class="divider" style="border-top: 1px solid #ccc;margin: 10px 0;"></div>';
                        }
                        ?>
                    </div>
                    <hr>
                    <div>
                        Total Price: <?php echo $totalPrice; ?> AED
                    </div>
                </div>          
            </div>
        </div>

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