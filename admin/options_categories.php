<?php
session_start();
$loggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'];
require '../product.php';
$conn = new mysqli("localhost", "root", "", "logindb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_GET['showEditModal']) && isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "SELECT * FROM options WHERE id = '" . $_GET['id'] . "'";
    $result = $conn->query($query);
    $editedOption = $result->fetch_assoc();
}if(isset($_GET['showDeleteModal']) && isset($_GET['id'])){
    $id = $_GET['id'];
}
$query = "SELECT * FROM options";
$result = $conn->query($query);
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
</head>

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
                                <a  title="Login" data-bs-toggle="modal" data-bs-target="#exampleModal"  href="index.php">
                                    <i class="fa-solid fa-right-to-bracket"style="color: #68367f; margin-right: 10px;"></i>
									<?php
										if ($loggedIn) {
											echo 'Welcome '.$_SESSION['username'];
										}
										?>
                                </a>
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
						<h2>Manage <b>Option Categories</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addOptionModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Option</span></a>
						<a href="#deleteOptionModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete All Options</span></a>						
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
                        <th>Option</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
					 foreach ($result as $row) {
                        echo '<tr>';
                        echo '<td>';
                        echo '<span class="custom-checkbox">';
                        echo '<input type="checkbox" id="checkbox' . $row['id'] . '" name="options[]" value="1">';
                        echo '<label for="checkbox' . $row['id'] . '"></label>';
                        echo '</span>';
                        echo '</td>';
                        echo '<td>' . $row['id'] . '</td>';
                        $optionName = $row['name'];
                        echo '<td>' . $optionName . '</td>';                        
                        echo '<td>';
                        echo '<a href="options_categories.php?showEditModal=1&id='.$row['id'].'" data-id="' . $row['id'] . '" class="edit"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>';
                        echo '<a href="options_categories.php?showDeleteModal=1&id='.$row['id'].'" data-id="' . $row['id'] . '" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
    </div>
		<!-- Edit Modal HTML -->
		<div id="editOptionModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
                <form action="edit_options_category.php?edit_option_id=<?php echo $editedOption['id']; ?>" method="POST">
					<input type="hidden" name="edit_option_id" value="<?php echo $editedOption['id']; ?>">
					<div class="modal-header">						
						<h4 class="modal-title">Edit Option</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
                        <label>Title</label>
                            <input name="title" type="text" class="form-control" required value="<?php echo $editedOption['name']; ?>">
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

	<!-- Delete Modal HTML -->
	<div id="deleteOptionModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
            <form action="delete_options_categories.php" method="POST">
            <input type="hidden" name="delete_option_id" value="<?php echo $_GET['id']; ?>">
					<div class="modal-header">						
						<h4 class="modal-title">Delete Product</h4>
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

<div id="addOptionModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="add_option_category.php">
                <div class="modal-header">
                    <h4 class="modal-title">Add Option</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Option :</label>
                        <input name="value" type="text" class="form-control" required placeholder="Enter option value">
                    </div>
                    <!-- Other form fields as needed -->
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-success" value="Add">
                </div>
            </form>
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
				$("#editOptionModal").modal('show')
			</script>
	<?php
		}
	?>
        <?php 
		if(isset($_GET['showDeleteModal'])){
	?>
			<script>
				$("#deleteOptionModal").modal('show')
			</script>
	<?php
		}
	?>
</body>
</html>
<?php
$conn->close();

?>
