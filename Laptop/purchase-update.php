<?php
		include "config.php";
	
		if(isset($_GET['pid'])&&isset($_GET['vid'])&&isset($_GET['lid']))
		{
			$pid=$_GET['pid'];
			$vid=$_GET['vid'];
			$lid=$_GET['lid'];
			$qry1="SELECT * FROM purchase WHERE p_id='$pid' and ven_id='$vid' and lap_id='$lid'";
			$result = $conn->query($qry1);
			$row = $result->fetch_row();
		}
		
		 if( isset($_POST['update']))
		 {
			$pid=$_POST['pid'];
			$vid=$_POST['vid'];
			$lid=$_POST['lid'];
			$qty = $_POST['pqty'];
			$cost = $_POST['pcost'];
			$pdate = $_POST['pdate'];
			$mdate = $_POST['mdate'];
			 
		$sql="UPDATE purchase SET p_cost='$cost',p_qty='$qty',pur_date='$pdate',mfg_date='$mdate'
				where p_id='$pid' and ven_id='$vid' and lap_id='$lid'";
		if ($conn->query($sql))
		header("location:purchase-view.php");

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
Purchases
</title>
</head>

<body>

		<div class="sidenav">
		
	<?php 
			if( isset($_POST['update']))
		 {
			$pid=$_POST['pid'];
			$vid=$_POST['vid'];
			$lid=$_POST['lid'];
			$qty = $_POST['pqty'];
			$cost = $_POST['pcost'];
			$pdate = $_POST['pdate'];
			$mdate = $_POST['mdate'];
			
			$sql="UPDATE purchase SET p_cost='$cost',p_qty='$qty',pur_date='$pdate',mfg_date='$mdate'
				where p_id='$pid' and ven_id='$vid' and lap_id='$lid'";
			if (!($conn->query($sql)))
				echo "<p style='font-size:8; color:red;'>Error! Unable to update.</p>";
		 }
	?>
			<h2 style="font-family:Arial; color:white; text-align:center;"> Laptop Store Management System </h2>
			
			<a href="adminmainpage.php">Dashboard</a>
			<button class="dropdown-btn">Inventory
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="inventory-add.php">Add New Laptop</a>
				<a href="inventory-view.php">Manage Inventory</a>
			</div>
			<button class="dropdown-btn">Vendors
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="Vendor-add.php">Add New Vendor</a>
				<a href="Vendor-view.php">Manage Vendor</a>
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
				<a href="purchase-add.php">Add New Customer</a>
				<a href="purchase-view.php">Manage Customers</a>
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
	<h2> UPDATE PURCHASE DETAILS</h2>
	</div>
	</center>
	
	
	<div class="one">
		<div class="row">
			<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
				<div class="column">
					<p>
						<label for="pid">Purchase ID:</label><br>
						<input type="number" name="pid" value="<?php echo $row[0]; ?>" readonly>
					</p>
					<p>
						<label for="vid">Vendor ID:</label><br>
						<input type="number" name="vid" value="<?php echo $row[1]; ?>" readonly>
					</p>
					<p>
						<label for="lid">Laptop ID:</label><br>
						<input type="number" name="lid" value="<?php echo $row[2]; ?>" readonly>
					</p>
					<p>
						<label for="pqty">Purchase Quantity:</label><br>
						<input type="number" name="pqty" value="<?php echo $row[3]; ?>">
					</p>
				</div>
				
				<div class="column">
					<p>
						<label for="pcost">Purchase Cost:</label><br>
						<input type="number" step="0.01" name="pcost" value="<?php echo $row[4]; ?>">
					</p>
					
					
					<p>
						<label for="pdate">Date of Purchase:</label><br>
						<input type="date" name="pdate" value="<?php echo $row[5]; ?>">
					</p>
					<p>
						<label for="mdate">Manufacturing Date:</label><br>
						<input type="date" name="mdate" value="<?php echo $row[6]; ?>">
					</p>
				</div>
				
			<input type="submit" name="update" value="Update">
			</form>	
		</div>
	</div>

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