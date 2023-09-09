<?php
session_start();
$loggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'];
require '../product.php';
$conn = new mysqli("localhost", "root", "", "logindb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$category = new Category($conn);
if(isset($_GET['showEditModal']) && isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "SELECT * FROM categories WHERE category_id = '" . $_GET['id'] . "'";
    $result = $conn->query($query);
    $editedCategory = $result->fetch_assoc();
}if(isset($_GET['showDeleteModal']) && isset($_GET['id'])){
    $id = $_GET['id'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Products Managment Page</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
<link rel="stylesheet" href="../css/all.css" />
<body>
<section class="free_shipping_alert">
        <div>Enjoy FREE SHIPPING on orders over 80 AED</div>
    </section>
    <section class="top-nav-bar">
            <div class="top-nav">
                <div class="row justify-content-between">
                    <div class="col-lg-6">
                    <div class="top-nav-left d-none d-lg-block">
                        <span>Dr Nutrition UAE</span>
                    </div>
                    </div>
                    <div class="col-lg-6">
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
                                <a  title="Login" data-bs-toggle="modal" data-bs-target="#exampleModal"  href="">
                                    <i class="fa-solid fa-right-to-bracket"style="color: #68367f; margin-right: 10px;"></i>
                                    My Account
                                </a>
                            </li>
                        <li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<div class="row">
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="products.php">
                                Products
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="categories.php">
                                Categories
                            </a>
                        </li>
						<li class="nav-item">
                            <a class="nav-link" href="brands.php">
                                Brands
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="options_categories.php">
                                Options Categories
                            </a>
                        </li>
						<li class="nav-item">
                            <a class="nav-link" href="options.php">
                                Options
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
			<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2>Manage <b>Categories</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addCategoryModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Category</span></a>
						<a href="#deleteCategoryModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete All Category</span></a>						
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
						<th>
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
						</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $categoryData = $category->getAllCategories();
                    $allCats = $categoryData['categories'];
                    $catsCount = $categoryData['count'];
                    foreach ($allCats as $category){
						echo '<tr id="' .$category['category_id']. '">';
						echo '<td>';
                        echo '<span class="custom-checkbox">';
                        echo '<input type="checkbox" id="checkbox'.$category['category_id'].'" name="options[]" value="1">';
								echo '<label for="checkbox'.$category['category_id'].'"></label>';
							echo '</span>';
						echo '</td>';
                        echo '<td>'.$category['category_id'].'</td>' ;
                        echo'<td>'.$category['category_name'].'</td>';
						echo '<td>';
                        echo '<a href="categories.php?showEditModal=1&id='.$category['category_id'].'" data-id="'.$category['category_id'].'" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>';
                        echo '<a href="categories.php?showDeleteModal=1&id='.$category['category_id'].'"class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>';
                        echo '</td>';
                    echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
			<div class="clearfix">
                <div class="hint-text">Showing <b><?php echo $catsCount?></b> out of <b><?php echo $catsCount?></b> entries</div>
                <ul class="pagination">
                    <li class="page-item disabled"><a href="#">Previous</a></li>
                    <li class="page-item active"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item "><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">4</a></li>
                    <li class="page-item"><a href="#" class="page-link">5</a></li>
                    <li class="page-item"><a href="#" class="page-link">Next</a></li>
                </ul>
            </div>
        </div>
    </div>
		<!-- Edit Modal HTML -->
		<div id="editCategoryModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="edit_category.php?edit_category_id=<?php echo $editedCategory['category_id']; ?>" method="POST">
                <input type="hidden" name="edit_category_id" value="<?php echo $editedCategory['category_id']; ?>">
					<div class="modal-header">						
						<h4 class="modal-title">Edit Category</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Title</label>
							<input name="title" type="text" class="form-control" required value="<?php echo $editedCategory['category_name']; ?>">
						</div>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="submit" class="btn btn-info">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
	<!-- Edit Modal HTML -->
	<div id="addCategoryModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="post" action="add_category.php">
					<div class="modal-header">						
						<h4 class="modal-title">Add Category</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
                    <div class="modal-body">					
                        <div class="form-group">
							<label>Category Name</label>
							<input name="title" type="text" class="form-control" required>
						</div>
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-success" value="Add">
					</div>
					<div class="modal-footer">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
	<!-- Delete Modal HTML -->
	<div id="deleteCategoryModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
            <form action="delete_category.php" method="POST">
            <input type="hidden" name="delete_category_id" value="<?php echo $_GET['id']; ?>">
					<div class="modal-header">						
						<h4 class="modal-title">Delete Category</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<p>Are you sure you want to delete these Records?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <button type="submit" class="btn btn-danger">Delete</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src= "../js/mainj.js"></script>
    <?php 
		if(isset($_GET['showEditModal'])){
	?>
			<script>
				$("#editCategoryModal").modal('show')
			</script>
	<?php
		}
	?>
    <?php 
		if(isset($_GET['showDeleteModal'])){
	?>
			<script>
				$("#deleteCategoryModal").modal('show')
			</script>
	<?php
		}
	?>
</body>
</html>
<?php
$conn->close();
?>
