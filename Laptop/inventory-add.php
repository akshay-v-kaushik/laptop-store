<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="nav2.css">
<link rel="stylesheet" type="text/css" href="form4.css">
<title>
Laptop
</title>
</head>

<body>

<div class="sidenav">
			<h2 style="font-family:Arial; color:white; text-align:center;"> Laptop Store Management System </h2>
			
			<a href="adminmainpage.php">Dashboard</a>
			<button class="dropdown-btn">Inventory
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="inventory-add.php">Add New Laptop</a>
				<a href="inventory-view.php">Manage Inventory</a>
			</div>
			<button class="dropdown-btn">Vendor
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="vendor-add.php">Add New Vendor</a>
				<a href="vendor-view.php">Manage Vendor</a>
			</div>
			<button class="dropdown-btn">Stock Purchase
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="purchase-add.php">Add New Stock Purchase</a>
				<a href="purchase-view.php">Manage Stock Purchases</a>
			</div>
			<button class="dropdown-btn">Employees
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="employee-add.php">Add New Employee</a>
				<a href="employee-view.php">Manage Employees</a>
			</div>
			<button class="dropdown-btn">Customers
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="customer-add.php">Add New Customer</a>
				<a href="customer-view.php">Manage Customers</a>
			</div>
			<a href="sales-view.php">View Sales Invoice Details</a>
			<a href="salesitems-view.php">View Sold Products Details</a>
			<a href="pos1.php">Add New Sale</a>
			<button class="dropdown-btn">Reports
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="stockreport.php">Laptops - Low Stock</a>
			</div>
	</div>


	<div class="topnav">
		<a href="logout.php">Logout</a>
	</div>
	
	<center>
	<div class="head">
	<h2> ADD LAPTOP DETAILS</h2>
	</div>
	</center>
	
	
	
	
	<div class="one">
		<div class="row">
			<form action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
				<div class="column">
					<p>
						<label for="lapid">Laptop ID:</label><br>
						<input type="number" name="lapid">
					</p>
					<p>
						<label for="lapname">Laptop Name:</label><br>
						<input type="text" name="lapname">
					</p>
					<p>
						<label for="qty">Quantity:</label><br>
						<input type="number" name="qty">
					</p>
					<p>
						<label for="cat">Category:</label><br>
						<select id="cat" name="cat">
								<option>MacBook</option>
								<option>Gaming</option>
								<option>Notebook</option>
								<option>Ultrabook</option>
								<option>Convertible</option>
						</select>
					</p>

					<p>
						<label for="sp">Price: </label><br>
						<input type="number" step="0.01" name="sp">
					</p>

					<p>
						<label for="cpu">CPU: </label><br>
						<input type="text" step="0.01" name="cpu">
					</p>
					<p>
						<label for="gpu">GPU: </label><br>
						<input type="text" step="0.01" name="gpu">
					</p>
					
				</div>
				<div class="column">
				
					

					<p>
						<label for="disp_size">Display Size: </label><br>
						<input type="text" step="0.01" name="disp_size">
					</p>
					
					<p>
						<label for="disp_res">Display Resolution: </label><br>
						<input type="text" step="0.01" name="disp_res">
					</p>

					<p>
						<label for="refresh_rate">Refresh Rate: </label><br>
						<input type="text" step="0.01" name="refresh_rate">
					</p>
					<p>
						<label for="ram">RAM: </label><br>
						<input type="text" step="0.01" name="ram">
					</p>
					<p>
						<label for="storage">Storage: </label><br>
						<input type="text" step="0.01" name="storage">
					</p>

					<p>
						<label for="battery">Battery: </label><br>
						<input type="text" step="0.01" name="battery">
					</p>
					
					<input type="file" name="image" value="Choose picture">
				</div>
				
			
			<input type="submit" name="add" value="Add Laptop">
			</form>
		<br>
		
		
	<?php
	
		include "config.php";

		 
		if(isset($_POST['add']))
		{
		$id = mysqli_real_escape_string($conn, $_REQUEST['lapid']);
		$name = mysqli_real_escape_string($conn, $_REQUEST['lapname']);
		$qty = mysqli_real_escape_string($conn, $_REQUEST['qty']);
		$category = mysqli_real_escape_string($conn, $_REQUEST['cat']);
		$sprice = mysqli_real_escape_string($conn, $_REQUEST['sp']);
		$cpu = mysqli_real_escape_string($conn, $_REQUEST['cpu']);
		$gpu = mysqli_real_escape_string($conn, $_REQUEST['gpu']);
		$disp_size = mysqli_real_escape_string($conn, $_REQUEST['disp_size']);
		$disp_res = mysqli_real_escape_string($conn, $_REQUEST['disp_res']);
		$refresh_rate = mysqli_real_escape_string($conn, $_REQUEST['refresh_rate']);
		$ram = mysqli_real_escape_string($conn, $_REQUEST['ram']);
		$storage = mysqli_real_escape_string($conn, $_REQUEST['storage']);
		$battery = mysqli_real_escape_string($conn, $_REQUEST['battery']);
		$file = addslashes(file_get_contents($_FILES['image']["tmp_name"]));
		$sql = "INSERT INTO laptop VALUES ($id, '$name', $qty,'$category',$sprice)";
		if(mysqli_query($conn, $sql)){
			$q2 = "INSERT INTO laptopspecs values($id, '$file', '$cpu', '$gpu', '$disp_size', '$disp_res', '$refresh_rate', '$ram', '$storage', '$battery')";
			if(mysqli_query($conn, $q2)){
				echo "<p style='font-size:8;'>Laptop details successfully added!</p>";
			}
		} else{
			echo "<p style='font-size:8; color:red;'>Error! Check details.</p>";
		}
		}
		 
		$conn->close();
	?>
		</div>
	</div>
			
</body>

<script>
	
		var dropdown = document.getElementsByClassName("dropdown-btn");
		var i;

			for (i = 0; i < dropdown.length; i++) {
			  dropdown[i].addEventListener("click", function() {
			  this.classList.toggle("active");
			  var dropdownContent = this.nextElementSibling;
			  if (dropdownContent.style.display === "block") {
			  dropdownContent.style.display = "none";
			  } else {
			  dropdownContent.style.display = "block";
			  }
			  });
			}
			
</script>

</html>


