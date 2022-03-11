<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="nav2.css">
<link rel="stylesheet" type="text/css" href="form4.css">
<title>
Vendor
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
	<h2> ADD VENDOR DETAILS</h2>
	</div>
	</center>

	
	
	<div class="one row">
		
			<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
				<div class="column">
					<p>
						<label for="vid">Vendor ID:</label><br>
						<input type="number" name="vid">
					</p>
					<p>
						<label for="vname">Vendor Name:</label><br>
						<input type="text" name="vname">
					</p>
					<p>
						<label for="vadd">Address:</label><br>
						<input type="text" name="vadd">
					</p>
					
					
				</div>
				<div class="column">
					<p>
						<label for="vphno">Phone Number:</label><br>
						<input type="number" name="vphno">
					</p>
					
					<p>
						<label for="vmail">Email Address </label><br>
						<input type="text" name="vmail">
					</p>
					
				</div>
				
			
			<input type="submit" name="add" value="Add Vendor">
			</form>
		<br>
		
		
	<?php
			include "config.php";
			 
			if(isset($_POST['add']))
			{
			$id = mysqli_real_escape_string($conn, $_REQUEST['vid']);
			$name = mysqli_real_escape_string($conn, $_REQUEST['vname']);
			$add = mysqli_real_escape_string($conn, $_REQUEST['vadd']);
			$phno = mysqli_real_escape_string($conn, $_REQUEST['vphno']);
			$mail = mysqli_real_escape_string($conn, $_REQUEST['vmail']);

			 
			$sql = "INSERT INTO vendor VALUES ($id, '$name','$add',$phno, '$mail')";
			if(mysqli_query($conn, $sql)){
				echo "<p style='font-size:8;'>Vendor details successfully added!</p>";
			} else{
				echo "<p style='font-size:8; color:red;'>Error! Check details.</p>";
			}
			}
			 
			$conn->close();
	?>
	
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