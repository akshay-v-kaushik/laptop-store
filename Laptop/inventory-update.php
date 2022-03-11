<?php
	include "config.php";
	
	if(isset($_GET['id']))
	{
		$id=$_GET['id'];
		$qry1="SELECT * FROM laptop WHERE lap_id='$id'";
		$qry2 = "SELECT * FROM laptopspecs WHERE lap_id='$id'";
		$result = $conn->query($qry1);
		$result2 = $conn->query($qry2);
		$row = $result->fetch_row();
		$row2 = $result2->fetch_row();

	}
?>
<?php
if(isset($_POST['update'])){
	if( isset($_POST['lapname'])||isset($_POST['qty'])||isset($_POST['cat'])||isset($_POST['sp'])||isset($_POST['cpu'])||isset($_POST['disp_size'])
		||isset($_POST['disp_res'])||isset($_POST['refresh_rate'])||isset($_POST['ram'])||isset($_POST['storage'])||isset($_POST['battery'])) {
		$id=$_POST['lapid'];
		$name=$_POST['lapname'];
		$qty=$_POST['qty'];
		$cat=$_POST['cat'];
		$price=$_POST['sp'];
		$cpu = $_POST['cpu'];
		$gpu = $_POST['gpu'];
		$disp_size = $_POST['disp_size'];
		$disp_res = $_POST['disp_res'];
		$refresh_rate = $_POST['refresh_rate'];
		$ram = $_POST['ram'];
		$storage = $_POST['storage'];
		$battery = $_POST['battery'];


	$sql="UPDATE laptop SET lap_name='$name',lap_qty='$qty',category='$cat',lap_price='$price' where lap_id='$id'";
	$sql2 = "UPDATE laptopspecs SET  cpu='$cpu', gpu='$gpu', disp_size='$disp_size', disp_res='$disp_res', refresh_rate='$refresh_rate', ram='$ram',storage='$storage',battery='$battery' WHERE lap_id='$id'";
	if ($conn->query($sql))
	{	echo "hello";
		if($conn->query($sql2)){
		header("location:product-specs.php?id=".$id);
		}
	}
	else
	echo "<p style='font-size:8;color:red;'>Error! Unable to update.</p>";
}
}


?>

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
	<h2> UPDATE LAPTOP DETAILS</h2>
	</div>
	</center>
	<div class="one">
		<div class="row">
			<form action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
				<div class="column">
					<p>
						<label for="lapid">Laptop ID:</label><br>
						<input type="number" name="lapid" value="<?php echo $row[0]; ?>" readonly>
					</p>
					<p>
						<label for="lapname">Laptop Name:</label><br>
						<input type="text" name="lapname" value="<?php echo $row[1]; ?>">
					</p>
					<p>
						<label for="qty">Quantity:</label><br>
						<input type="number" name="qty" value="<?php echo $row[2]; ?>">
					</p>
					<p>
						<label for="cat">Category:</label><br>
						<select id="cat" name="cat" >
								<option>MacBook</option>
								<option>Gaming</option>
								<option>Notebook</option>
								<option>Ultrabook</option>
								<option>Convertible</option>
						</select>
					</p>

					<p>
						<label for="sp">Price: </label><br>
						<input type="number" step="0.01" name="sp" value="<?php echo $row[4]; ?>">
					</p>

					<p>
						<label for="cpu">CPU: </label><br>
						<input type="text" step="0.01" name="cpu" value="<?php echo $row2[2]; ?>">
					</p>
					<p>
						<label for="gpu">GPU: </label><br>
						<input type="text" step="0.01" name="gpu" value="<?php echo $row2[3]; ?>">
					</p>
					
				</div>
				<div class="column">
				
					

					<p>
						<label for="disp_size">Display Size: </label><br>
						<input type="text" step="0.01" name="disp_size" value="<?php echo $row2[4]; ?>">
					</p>
					
					<p>
						<label for="disp_res">Display Resolution: </label><br>
						<input type="text" step="0.01" name="disp_res" value="<?php echo $row2[5]; ?>">
					</p>

					<p>
						<label for="refresh_rate">Refresh Rate: </label><br>
						<input type="text" step="0.01" name="refresh_rate" value="<?php echo $row2[6]; ?>">
					</p>
					<p>
						<label for="ram">RAM: </label><br>
						<input type="text" step="0.01" name="ram" value="<?php echo $row2[7]; ?>">
					</p>
					<p>
						<label for="storage">Storage: </label><br>
						<input type="text" step="0.01" name="storage" value="<?php echo $row2[8]; ?>">
					</p>

					<p>
						<label for="battery">Battery: </label><br>
						<input type="text" step="0.01" name="battery" value="<?php echo $row2[9]; ?>">
					</p>
					
				</div>
				
			
			<input type="submit" name="update" value="Update Laptop" href=>
			</form>
	<!-- <div class="one">
		<div class="row">
			<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
				<div class="column">
				<p>
					<label for="lapid">Laptop ID:</label><br>
					<input type="number" name="lapid" value="<?php echo $row[0]; ?>" readonly>
				</p>
				<p>
					<label for="lapname">Laptop Name:</label><br>
					<input type="text" name="lapname" value="<?php echo $row[1]; ?>">
				</p>
				<p>
					<label for="qty">Quantity:</label><br>
					<input type="number" name="qty" value="<?php echo $row[2]; ?>">
				</p>
				<p>
					<label for="cat">Category:</label><br>
					<input type="text" name="cat" value="<?php echo $row[3]; ?>">
				</p>
				</div>
				
				<div class="column">
				<p>
					<label for="sp">Price: </label><br>
					<input type="number" step="0.01" name="sp" value="<?php echo $row[4]; ?>">
				</p>
				</div>
		
				<input type="submit" name="update" value="Update">
				</form> -->
		
	
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