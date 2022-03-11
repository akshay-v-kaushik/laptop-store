<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="nav2.css">
<link rel="stylesheet" type="text/css" href="table1.css">
<title>
Purchases
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
	<h2> STOCK PURCHASE LIST</h2>
	</div>
	</center>
	
	<table align="right" id="table1" style="margin-right:100px;">
		<tr>
			<th>Purchase ID</th>
			<th>Vendor ID</th>
			<th>Laptop ID</th>
			<th>Laptop Name</th>
			<th>Quantity</th>
			<th>Cost of Purchase</th>
			<th>Date of Purchase</th>
			<th>Manufacturing Date</th>

			<th>Action</th>
		</tr>
		
	<?php

	include "config.php";
	$sql = "SELECT p_id,ven_id,lap_id,p_qty,p_cost,pur_date,mfg_date FROM purchase";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
	
	while($row = $result->fetch_assoc()) {
		
		$sql1="SELECT lap_name from laptop where lap_id=".$row["lap_id"];
		$result1 = $conn->query($sql1);
		
		while($row1 = $result1->fetch_assoc()) {

			echo "<tr>";
				echo "<td>" . $row["p_id"]. "</td>";
				echo "<td>" . $row["ven_id"]. "</td>";
				echo "<td>" . $row["lap_id"]. "</td>";
				echo "<td>" . $row1["lap_name"] . "</td>";
				echo "<td>" . $row["p_qty"]. "</td>";
				echo "<td>" . $row["p_cost"]. "</td>";
				echo "<td>" . $row["pur_date"]. "</td>";
				echo "<td>" . $row["mfg_date"] . "</td>";
				echo "<td align=center>";		 
				echo "<a class='button1 edit-btn' href=purchase-update.php?pid=".$row['p_id']."&vid=".$row['ven_id']."&lid=".$row['lap_id'].">Edit</a>";
				echo "<a class='button1 del-btn' href=purchase-delete.php?pid=".$row['p_id']."&vid=".$row['ven_id']."&lid=".$row['lap_id'].">Delete</a>";
				echo "</td>";
			echo "</tr>";
		}
	}
	echo "</table>";
} 
	$conn->close();
	
	?>
	
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
