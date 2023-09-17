<?php
session_start();
$loggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'];
require '../product.php';
$conn = new mysqli("localhost", "root", "", "logindb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$product = new Product($conn);

$editedProduct = null;
$selectedCategoryIDs = array();

if(isset($_GET['showEditModal']) && isset($_GET['id'])){
	$editedProduct = $product->getProduct($_GET['id']);
	$product_id = $_GET['id'];
	$selectedCategoriesQuery = "SELECT category_id FROM product_categories WHERE product_id = $product_id";
	$selectedCategoriesResult = $conn->query($selectedCategoriesQuery);

	$selectedCategoryIDs = array();
	while ($row = $selectedCategoriesResult->fetch_assoc()) {
		$selectedCategoryIDs[] = $row['category_id'];
	}
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
                            <a title="Login" data-bs-toggle="modal" data-bs-target="#exampleModal" href="index.php">
                                <i class="fa-solid fa-right-to-bracket" style="color: #68367f; margin-right: 10px;"></i>
                                <?php
                                if ($loggedIn) {
                                    echo 'Welcome '.$_SESSION['username'];
                                }
                                ?>
                            </a>
                        </li>
                    </ul>
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
                        <h2>Manage <b>Employees</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Product</span></a>
                        <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete All Products</span></a>
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
                        <th>Name</th>
                        <th>Price</th>
                        <th>Old Price</th>
                        <th>Brand Name</th>
                        <th>Categories</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $categoriesQuery = "SELECT category_id, category_name FROM categories";
                    $categoriesResult = $conn->query($categoriesQuery);
                    $categories = $categoriesResult->fetch_all(MYSQLI_ASSOC);
                    $product = new Product($conn);
                    $productData = $product->getAllProductValues();
                    $allProducts = $productData['products'];
                    $productCount = $productData['count'];
                    foreach ($allProducts as $product){
                        echo '<tr id="' .$product['id']. '">';
                        echo '<td>';
                        echo '<span class="custom-checkbox">';
                        echo '<input type="checkbox" id="checkbox'.$product['id'].'" name="options[]" value="1">';
                        echo '<label for="checkbox'.$product['id'].'"></label>';
                        echo '</span>';
                        echo '</td>';
                        echo'<td>'.$product['name'].'</td>';
                        echo '<td>'.$product['price'].'</td>';
                        echo '<td>'.$product['old-price'].'</td>';
                        echo '<td>'.$product['brand_name'].'</td>';
                        echo '<td>'.$product['categories'].'</td>';
                        echo '<td>';
                        echo '<a href="products.php?showEditModal=1&id='.$product['id'].'" data-id="'.$product['id'].'" class="edit"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>';
                        echo '<a href="products.php?showDeleteModal=1&id='.$product['id'].'" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
            <div class="clearfix">
                <div class="hint-text">Showing <b><?php echo $productCount?></b> out of <b><?php echo $productCount?></b> entries</div>
                <ul class="pagination">
                    <li class="page-item disabled"><a href="#">Previous</a></li>
                    <li class="page-item active"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item"><a href="#" class="page-link">Next</a></li>
                </ul>
            </div>
        </div>
    </main>
</div>
<div id="editEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content" style="width:800px">
            <form action="edit_product.php" method="POST">
                <input type="hidden" name="edit_product_id" value="<?php echo isset($editedProduct) ? $editedProduct['id'] : ''; ?>">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Product</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#general">General Info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#options">Product Options</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#combinations">Combinations</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div id="general" class="tab-pane fade active">
						<div class="form-group">
							<label>Title</label>
							<input name="title" type="text" class="form-control" required value="<?php echo isset($editedProduct) ? $editedProduct['name'] : ''; ?>">
						</div>
						<div class="form-group">
							<label>Price</label>
							<input name="price"  type="text" class="form-control" required value="<?php echo isset($editedProduct) ? $editedProduct['price'] : ''; ?>">
						</div>
						<div class="form-group">
							<label>Old Price</label>
							<input name="oldPrice" type="text" class="form-control" required value="<?php echo isset($editedProduct) ? $editedProduct['old-price'] : ''; ?>">
						</div>
						<div class="form-group">
							<label>Brand :</label>
							<select name='brandID' class="form-control" required>
								<option value="">Select a Brand</option>
								<?php
								$query = "SELECT brand_id, brand_name FROM brands";
								$result = $conn->query($query);
								if (isset($editedProduct)) {
									$editedBrandID = $editedProduct['brand_id'];
								} else {
									$editedBrandID = null;
								}
								while ($row = $result->fetch_assoc()) {
									$selected = ($row['brand_id'] == $editedBrandID) ? "selected" : "";
									echo "<option " . $selected . " value='" . $row['brand_id'] . "'>" . $row['brand_name'] . "</option>";
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label>Categories:</label><br>
							<?php
							foreach ($categories as $category) {
								echo '<label>';
								echo '<input type="checkbox" name="categories[]" value="' . $category['category_id'] . '"';
							
								if (isset($selectedCategoryIDs) && in_array($category['category_id'], $selectedCategoryIDs)) {
									echo ' checked';
								}
							
								echo '> ' . $category['category_name'];
								echo '</label><br>';
							}
							?>
						</div>						                        
					</div>
                        <div id="options" class="tab-pane fade">
						<div class="form-group">
                                <label>Product Options:</label><br>
                                <?php
                                if (isset($editedProduct)) {
                                    $product_id = $editedProduct['id'];
                                    $queryOption = "SELECT * FROM options";
                                    $result = $conn->query($queryOption);
                                    
                                    $queryExistingValues = "SELECT option_id FROM product_options WHERE product_id = $product_id";
                                    $resultExistingValues = $conn->query($queryExistingValues);
                                    $existingOptionIDs = array();

                                    if ($resultExistingValues->num_rows > 0) {
                                        while ($row = $resultExistingValues->fetch_assoc()) {
                                            $existingOptionIDs[] = $row['option_id'];
                                        }
                                    }
                                    
                                    foreach ($result as $row) {
                                        $checked = in_array($row['id'], $existingOptionIDs) ? 'checked' : '';
                                        echo '<label>';
                                        echo '<input type="checkbox" name="product_options[]" value="' . $row['id'] . '" ' . $checked . '> ' . $row['name'];
                                        echo '</label><br>';
                                    }
                                }
                                ?>
                            </div>                        
						</div>
                        <div id="combinations" class="tab-pane fade">
							<?php
							if (isset($editedProduct)) {
								$product_id = $editedProduct['id'];
								$queryExistingCombinations = "SELECT poc.*, o1.name AS first_option_name, o2.name AS second_option_name
															FROM product_option_combinations poc
															LEFT JOIN options o1 ON poc.first_option_id = o1.id
															LEFT JOIN options o2 ON poc.second_option_id = o2.id
															WHERE product_id = $product_id";

								$resultExistingCombinations = $conn->query($queryExistingCombinations);
								$row = $resultExistingCombinations->fetch_assoc();
								$firstOptionName = $row['first_option_name'];
								$secondOptionName = $row['second_option_name'];

								echo '<table id="combinationsTable" class="table">';
								echo '<thead>';
								echo '<tr>';
								echo '<th colspan="2">'. $firstOptionName .'</th>';
								if (!empty($row['second_option_name'])) {
								echo '<th>'. $secondOptionName .'</th>';
								}
								echo '<th id="actionHeaderPlaceholder"></th>';
								echo '</tr>';
								echo '</thead>';
								echo '<tbody>';

								$resultExistingCombinations->data_seek(0);
								$rowCount = 0;
								while ($row = $resultExistingCombinations->fetch_assoc()) {
									echo '<tr>';
									echo '<td>';
									echo '<select class="form-control" name="combinations[' . $row['first_option_id'] . '][]" id="selectOptionValues-' . $row['first_option_id'] .'">';
							
									// Fetch option values for the first option based on first_option_id
									$queryOptionValues = "SELECT * FROM option_values WHERE option_id = " . $row['first_option_id'];
									$resultOptionValues = $conn->query($queryOptionValues);
							
									while ($optionValue = $resultOptionValues->fetch_assoc()) {
										$valueId = $optionValue['id'];
										$valueName = $optionValue['value_name'];
										$selected = ($valueId == $row['first_option_value_id']) ? 'selected' : '';
										echo '<option value="' . $valueId . '" ' . $selected . '>' . $valueName . '</option>';
									}
							
									echo '</select>';
									echo '</td>';
									echo '<td>';
									if (!empty($row['second_option_name'])) {
										echo '<select class="form-control" name="combinations[' . $row['second_option_id'] . '][]" id="selectOptionValues-' . $row['first_option_id'] .'">';
							
										$queryOptionValues = "SELECT * FROM option_values WHERE option_id = " . $row['second_option_id'];
										$resultOptionValues = $conn->query($queryOptionValues);
							
										while ($optionValue = $resultOptionValues->fetch_assoc()) {
											$valueId = $optionValue['id'];
											$valueName = $optionValue['value_name'];
											$selected = ($valueId == $row['second_option_value_id']) ? 'selected' : '';
											echo '<option value="' . $valueId . '" ' . $selected . '>' . $valueName . '</option>';
										}
							
										echo '</select>';
									} 

									echo '</td>';
									if ($rowCount === 0) {
										echo '<td><button class="btn btn-success add-row"><i class="fa fa-plus"></i></button></td>';
									} else {
										echo '<td><button class="btn btn-danger remove-row"><i class="fa fa-minus"></i></button></td>';
									}
									
									echo '</tr>';
									$rowCount++;
								}
								echo '</tbody>';
								echo '</table>';
							}
							?>
						</div>
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

<div id="deleteEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
		<form action="delete_product.php" method="POST">
		<input type="hidden" name="delete_product_id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
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

<div id="addEmployeeModal" class="modal fade">
    <div class="modal-dialog" >
        <div class="modal-content" style="width:800px">
            <form method="post" action="add_product.php">
			<input type="hidden" name="form_submitted" value="1">
                <div class="modal-header">
                    <h4 class="modal-title">Add Product</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#general">General Info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#options">Product Options</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#combinations">Combinations</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="general" class="tab-pane fade active">
						<div class="form-group">
							<label>Name</label>
							<input name='name' type="text" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Price</label>
							<input name='price' type="text" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Old Price</label>
							<input name='oldPrice' type="text" class="form-control" required>
						</div>
                        <div class="form-group">
							<label>Brand :</label>
							<select name='brandID' class="form-control" required>
								<option value="">Select a Brand</option>
								<?php
								$query = "SELECT * FROM brands";
								$result = $conn->query($query);
								while ($row = $result->fetch_assoc()) {
									$selected = (isset($_POST['brandID']) && $_POST['brandID'] == $row['brand_id']) ? "selected" : "";
									echo "<option value='" . $row['brand_id'] . "'>" . $row['brand_name'] . "</option>";
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label>Categories:</label><br>
							<?php
							foreach ($categories as $category) {
								echo '<label>';
								echo '<input type="checkbox" name="categories[]" value="' . $category['category_id'] . '"> ' . $category['category_name'];
								echo '</label><br>';
							}
							?>
						</div>			
                    </div>
                        <div id="options" class="tab-pane fade">
                            <div class="form-group">
                                <label>Options:</label><br>
                                <?php
								$queryOption = "SELECT * FROM options";
								$result = $conn->query($queryOption);
                                foreach ($result as $row) {
                                    echo '<label>';
                                    echo '<input type="checkbox" name="product_options[]" value="' . $row['id'] . '"> ' . $row['name'];
                                    echo '</label><br>';
                                }
                                ?>
                            </div>
                        </div>

						<div id="combinations" class="tab-pane fade">
							<table id="combinationsTable" class="table">
								<thead>
									<th id="actionHeaderPlaceholder"></th>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>


<script>
$(document).ready(function () {
	$(".nav-link.active").click()
	var selectedOptions = [];
	var selectElements = {};
	selectedOptions = $('input[name="product_options[]"]:checked');
	var combinationsTable = $('#combinationsTable');
	var tableHead = combinationsTable.find('thead');
	var tableBody = combinationsTable.find('tbody');

	function loadOptionValues(optionID, callback) {
		if (selectElements[optionID]) {
			callback(selectElements[optionID]);
		} else {
			$.ajax({
				url: 'fetch_option_values.php',
				method: 'POST',
				data: { optionID: optionID },
				dataType: 'json',
				success: function (response) {
					var selectElementGenerated = generateSelectElement(response, optionID);
					selectElements[optionID] = selectElementGenerated;
					callback(selectElementGenerated);
				},
				error: function (xhr, status, error) {
					console.error('Error fetching option values: ' + error);
				}
			});
		}
	}

	function generateSelectElement(response, optionID) {
		var selectElement = '<select class="form-control" name="combinations['+optionID+'][]" id="selectOptionValues-' + optionID + '">';
		$.each(response, function (index, optionValue) {
			var optionElement = '<option value="' + optionValue.id + '">' + optionValue.value_name + '</option>';
			selectElement += optionElement;
		});
		selectElement += '</select>';
		return selectElement;
	}

	function updateCombinationsTable() {
		selectedOptions = $('input[name="product_options[]"]:checked');
		var combinationsTable = $('#combinationsTable');
		var tableHead = combinationsTable.find('thead');
		var tableBody = combinationsTable.find('tbody');

		tableHead.empty();
		tableBody.empty();

		if (selectedOptions.length > 0) {
			selectedOptions.each(function () {
				var optionID = $(this).val();
				var optionName = $(this).closest('label').text().trim();
				tableHead.append('<th>' + optionName + '</th>');
			});

			tableHead.append('<th>Action</th>');

			if (selectedOptions.length > 0) {
				var newRow = '<tr>';
				selectedOptions.each(function () {
					var optionID = $(this).val();
					loadOptionValues(optionID, function (selectHTML) {
						newRow += '<td>' + selectHTML + '</td>';
						if (newRow.split('<td>').length - 1 === selectedOptions.length) {
							newRow += '<td><button class="btn btn-success add-row"><i class="fa fa-plus"></i></button></td>';
							newRow += '</tr>';
							tableBody.append(newRow);
						}
					});
				});
			}
		}
	}
	tableBody.on('click', '.add-row', function () {
		var newRow = '<tr>';
		var promises = [];

		selectedOptions.each(function () {
			var optionID = $(this).val();
			var promise = new Promise(function (resolve) {
				loadOptionValues(optionID, function (selectHTML) {
					newRow += '<td>' + selectHTML + '</td>';
					resolve();
				});
			});
			promises.push(promise);
		});

		Promise.all(promises).then(function () {
			newRow += '<td><button class="btn btn-danger remove-row"><i class="fa fa-minus"></i></button></td>';
			newRow += '</tr>';
			tableBody.append(newRow);
		});

		return false;
	});


	tableBody.on('click', '.remove-row', function () {
		$(this).closest('tr').remove();
	});

	$('input[name="product_options[]"]').change(function () {
		updateCombinationsTable();
	});
});
</script>


<?php 
	if(isset($_GET['showEditModal'])){
?>
		<script>
			$("#editEmployeeModal").modal('show')
		</script>
<?php
	}
?>

<?php 
	if(isset($_GET['showDeleteModal'])){
?>
		<script>
			$("#deleteEmployeeModal").modal('show')
		</script>
<?php
	}
?>
</body>
</html>
<?php
$conn->close();

?>
