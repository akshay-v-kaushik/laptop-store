<?php

	include "config.php";
	
	if(isset($_POST['search'])) {
		
		$search=$_POST['valuetosearch'];
		$search_result=mysqli_query($conn,"SET @p0='$search';")or die(mysqli_error($conn));
		$search_result=mysqli_query($conn,"CALL `SEARCH_INVENTORY`(@p0);") or die(mysqli_error($conn));
	}
	else {
			$query="SELECT lap_id as lapid, lap_name as lapname,lap_qty as lapqty,category as lapcategory,lap_price as lapprice FROM laptop";
			$search_result=filtertable($query);
	}
	
	function filtertable($query)
	{	$conn = mysqli_connect("localhost", "root", "", "laptopstore");
		$filter_result=mysqli_query($conn,$query);
		return $filter_result;
	}
	
?>

<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" type="text/css" href="table1.css">
<link rel="stylesheet" type="text/css" href="nav2.css">
<link rel="stylesheet" type="text/css" href="form2.css">
<title>
Inventory
</title>
</head>

<body>

<div class="sidenav">
			<h2 style="font-family:Arial; color:white; text-align:center;"> Laptop Store Management System </h2>
			
			<a href="empmainpage.php">Dashboard</a>
			
			<a href="emp-inventory.php">View Inventory</a>
			<a href="emp-pos1.php">Add New Sale</a>
			<button class="dropdown-btn">Customers
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="emp-customer.php">Add New Customer</a>
				<a href="emp-customer-view.php">View Customers</a>
			</div>
	</div>


	<?php
	
	include "config.php";
	session_start();

	$sql1="SELECT E_FNAME from EMPLOYEE WHERE E_ID='$_SESSION[user]'";
	$result1=$conn->query($sql1);
	$row1=$result1->fetch_row();
	
	$ename=$row1[0];
		
	?>

	<div class="topnav">
		<a href="logout1.php">Logout(signed in as <?php echo $ename; ?>)</a>
	</div>

	
	<center>
	
	<div class="head">
	<h2> LAPTOP INVENTORY </h2>
	</div>
	
	<form method="post">
	<input type="text" name="valuetosearch" placeholder="Enter any value to Search" style="width:400px; margin-left:250px;">&nbsp;&nbsp;&nbsp;
	<input type="submit" name="search" value="Search">
	<br><br>
	</form>
	
	</center>
	

	<table align="right" id="table1" style="margin-top:20px; margin-right:100px;">
		<tr>
			<th>Laptop ID</th>
			<th>Laptop Name</th>
			<th>Quantity Available</th>
			<th>Category</th>
			<th>Price</th>
			<th>Action</th>
		</tr>
		
	<?php
	
		if ($search_result->num_rows > 0) {
		
		while($row = $search_result->fetch_assoc()) {

		echo "<tr>";
			echo "<td>" . $row["lapid"]. "</td>";
			echo "<td>" . $row["lapname"] . "</td>";
			echo "<td>" . $row["lapqty"]. "</td>";
			echo "<td>" . $row["lapcategory"]. "</td>";
			echo "<td>" . $row["lapprice"] . "</td>";
			echo "<td align=center>";
						 
				echo "<a class='button1 edit-btn' href=emp-product-specs.php?id=".$row['lapid']."&name=".$row['lapname'].">Specs</a>";
			
		echo "</tr>";
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
