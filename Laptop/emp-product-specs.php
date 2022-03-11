<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="table1.css">
<link rel="stylesheet" type="text/css" href="form5.css">
<link rel="stylesheet" type="text/css" href="columns.css">
<link rel="stylesheet" type="text/css" href="nav2.css">
<title>Laptop</title>
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

	<div class="topnav">
		<a href="logout.php">Logout</a>
	</div>
	
	<center>
	<div class="head">
	<h2> LAPTOP INVENTORY </h2>
	<br>
	<hr>
	
	</div>
	</center>
	
	
	<?php
	include "config.php";
	
		$id = $_GET['id'];
		// $name = $_GET['name'];
		$sql1 = "SELECT lap_name FROM laptop WHERE lap_id=$id";
		$result1 = $conn->query($sql1);
		$row1 = $result1->fetch_assoc();
		$sql = "SELECT lap_id, lap_image, cpu, gpu, disp_size, disp_res, refresh_rate, ram, storage, battery FROM laptopspecs where lap_id = $id";
		$result = $conn->query($sql);	
		// mysqli_query($conn, $sql);	
		$row = $result->fetch_assoc();

		echo '
			<div class="one">
				<div class="row">
					<div class="column">
						<br>
						<div class="column1">
							<p class="words">Laptop ID:</p>
						</div>
						<div class="column2">
							<p class="words">'.$row['lap_id'].'</p>
						</div>
						<div class="column1">
							<p class="words">Laptop Name:</p>
						</div>
						<div class="column2">
							<p class="words">'.$row1['lap_name'].'</p>
						</div>
						<div class="column1">
							<p class="words">Laptop CPU:</p>
						</div>
						<div class="column2">
							<p class="words">'.$row['cpu'].'</p>
						</div>
						<div class="column1">
							<p class="words">Laptop GPU:</p>
						</div>
						<div class="column2">
							<p class="words">'.$row['gpu'].'</p>
						</div>
						<div class="column1">
							<p class="words">Laptop Display:</p>		
						</div>
						<div class="column2">
							<p class="words">'.$row['disp_size']."&nbsp;&nbsp;&nbsp;".$row['disp_res']."&nbsp;&nbsp;&nbsp;&nbsp;".$row['refresh_rate'].'</p>	
						</div>	
						<div class="column1">
							<p class="words">Laptop RAM:</p>
						</div>
						<div class="column2">
							<p class="words">'.$row['ram'].'</p>
						</div>
						<div class="column1">
							<p class="words">Laptop Storage:</p>
						</div>
						<div class="column2">
							<p class="words">'.$row['storage'].'</p>
						</div>
						
						<div class="column1">
							<p class="words">Laptop Battery:</p>
						</div>
						<div class="column2">
							<p class="words">'.$row['battery'].'</p>
						</div>

					</div>

					<div class="column">
						<img class="images" src="data:image;base64,'.base64_encode($row['lap_image']).'" alt="Image" style="margin-left:100px;width:300px; height:250px;margin-top:80px;" ;
					</div>
				</div>			
			</div>
			<br>
			<br>
			<br>
			<hr>
			<br>
			<a class="button1 del-btn" href="emp-inventory.php" style="width:20%;  margin:0 auto; display:block;">Back</a>
		';

		// echo '<table align="right" id="table1" style="margin-right:50px; width:80%; margin-left:50px;">
		// 	<tr>
		// 	<th>Laptop ID</th>
		// 	<th>Laptop Name</th>
		// 	<th>CPU</th>
		// 	<th>GPU</th>
		// 	<th>Display Size</th>
		// 	<th>Display Resolution</th>
		// 	<th>Refresh Rate</th>
		// 	<th>RAM</th>
		// 	<th>Storage</th>		
		// 	<th>Battery</th>	
		// 	<th>Action</th>
		// 	</tr>';
		
		// echo "<tr>";
		// echo "<td>" .$row['lap_id']. "</a></td>";
		// echo "<td>" . $name . "</td>";
		// echo "<td>".$row['cpu']."</td>";
		// echo "<td>".$row['gpu']."</td>";
		// echo "<td>".$row['disp_size']."</td>";
		// echo "<td>".$row['disp_res']."</td>";
		// echo "<td>".$row['refresh_rate']."</td>";
		// echo "<td>".$row['ram']."</td>";
		// echo "<td>".$row['storage']."</td>";
		// echo "<td>".$row['battery']."</td>"; 		
		// echo "<td align=center>";		 
		// echo "<a class='button1 edit-btn' href=inventory-update.php>Edit</a>";
		// echo "</td>";
		// echo "</tr>";
		// echo "</table>";


		// echo '<br>';

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
