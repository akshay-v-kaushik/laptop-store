<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="nav2.css">
<link rel="stylesheet" type="text/css" href="form3.css">
<link rel="stylesheet" type="text/css" href="table3.css">
<title>
New Sales
</title>
</head>

<body>

<<div class="sidenav">
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
	<h2> POINT OF SALE</h2>
	</div>
	</center>
	

	<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
		<center>
		
		<select id="cid" name="cid">
        <option value="0">*Select Customer Name</option>
					
					
	<?php	
			
		include "config.php";
		$qry="SELECT c_fname,c_lname,c_id FROM customer";
		$result= $conn->query($qry);
		echo mysqli_error($conn);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo "<option value=".$row["c_id"].">".$row["c_fname"]." ".$row["c_lname"]."</option>";
			}
		}
	?>
		
    </select>
	&nbsp;&nbsp;
	<input type="submit" name="custadd" value="Add to Proceed.">
	</form>
	
		
	<?php
	
  
				session_start();

		
		$qry1="SELECT id from admin where a_username='$_SESSION[user]'";
		$result1=$conn->query($qry1);
		$row1=$result1->fetch_row();
		$eid=$row1[0];		
			
			
			
		if(isset($_POST['custadd'])) {

			if(isset($_POST['cid'])){
				$cid=$_POST['cid'];	
				$_SESSION['c_id']=$cid;			
			}

				 if($cid!=0){				
				$qry2="INSERT INTO sales(c_id,e_id) VALUES ('$cid','$eid')"; 
				if(!($result2=$conn->query($qry2))) {
					echo "<p style='font-size:8; color:red;'>Invalid! Enter valid Customer ID to record Sales.</p>";
				}
				
			}
				else
				echo "<script>alert('Select Customer')</script>";

				
				
		}
		
	?>
		<br><br><br>
	</center>
	

	
	
			<div class="one row" style="margin-right:500px;">
			<form method="post">
			<center>	
		<form method="post">
			<select id="lap" name="lap">
			<option value="0" selected="selected">Select Laptop</option>
					
					
	<?php	
		$qry3="SELECT lap_name FROM laptop";
		$result3 = $conn->query($qry3);
		echo mysqli_error($conn);
		if ($result3->num_rows > 0) {
			while($row4 = $result3->fetch_assoc()) {
				
				echo "<option>".$row4["lap_name"]."</option>";
			}
		}
	?>
		
    </select>
	&nbsp;&nbsp;
	<input type="submit" name="search" value="Search">
	<?php
	
		if(isset($_POST['search'])) {
					if(! empty($_POST['lap'])){
					$lap=$_POST['lap'];
					$qry4="SELECT * FROM laptop where lap_name='$lap'";
					$result4=$conn->query($qry4); 
					$row4 = $result4 -> fetch_row();
					}		
					else
					echo "<script>alert('Select Laptop')</script>";
			}
			

	?>
	</form>
	<br><br><br>
	<center>
					<div class="column">
					
					<label for="lapid">Laptop ID:</label>
					<input type="number" name="lapid" value="<?php if(isset($row4[0])&& $_POST['lap']!=0){echo $row4[0];} else echo ""; ?>"readonly ><br><br>
					
					<label for="lpname">Laptop Name:</label>
					<input type="text" name="lpname" value="<?php if(isset($row4[1])&& $_POST['lap']!=0){ echo $row4[1];} else echo ""; ?>" readonly><br><br>
					
					</div>
					<div class="column">
					
					<label for="lcat">Category:</label>
					<input type="text" name="lcat" value="<?php if(isset($row4[3])&& $_POST['lap']!=0){ echo $row4[3];} else echo ""; ?>" readonly><br><br>
					
				
					</div>
					<div class="column">
					
					<label for="lqty">Quantity Available:</label>
					<input type="number" name="lqty" value="<?php if(isset($row4[2])&& $_POST['lap']!=0){echo $row4[2];}else echo ""; ?>" readonly><br><br>
					
					<label for="lprice">Price of One Unit:</label>
					<input type="number" name="lprice" value="<?php if(isset($row4[4])&& $_POST['lap']!=0){echo $row4[4];} else echo ""; ?>" readonly><br><br>
					
					</div>
					<label for="lcqty">Quantity Required:</label>
					<input type="number" name="lcqty" default="0">
					&nbsp;&nbsp;&nbsp;
					<input type="submit" name="add" value="Add Laptop">&nbsp;&nbsp;&nbsp;		
		
		</form>
	</div>

<?php
	if(isset($_POST['add'])) {
					// if($_POST['lap']!=0){
			
					$qry5="select sale_id from sales ORDER BY sale_id DESC LIMIT 1";
					$result5=$conn->query($qry5); 
					$row5=$result5->fetch_row();
					$sid=$row5[0];
					echo mysqli_error($conn);
			
					$lid=$_POST['lapid'];
					$aqty=$_POST['lqty'];
					$qty=$_POST['lcqty'];
					
					if($qty>$aqty||$qty==0||empty($qty))
					{echo "<script>alert('Quantity Invalid')</script>";
						
					}
					else {
					$price=$_POST['lprice']*$qty;
					$qry6="INSERT INTO sales_items(`sale_id`,`lap_id`,`sale_qty`,`tot_price`) VALUES($sid,$lid,$qty,$price)";
					$result6 = mysqli_query($conn,$qry6);                    
					echo mysqli_error($conn);
					
					
					}
				}	
				?>

	<div class="one row" style="margin-right:500px;">
				
		<?php

			if(isset($_POST['custadd'])||isset($_POST['add'])||isset($_POST['search'])){
			$q="SELECT c_fname, c_lname FROM CUSTOMER WHERE C_ID=$_SESSION[c_id]";
			$r=$conn->query($q);
			$rw=$r->fetch_row();
			$c_name=$rw[0]." ".$rw[1];

			echo "<label for='custname'>Customer Name:</label>
			<input type='text' name='custname' value='$c_name' readonly><br><br>";
			}
			if(empty($sid))
			{
				$sql ="SHOW TABLE STATUS LIKE 'sales'";
	
				if(!$result = $conn->query($sql)){
				die('There was an error running the query [' . $conn->error . ']');
				}
				$row = $result->fetch_assoc();
				$sid=$row['Auto_increment']-1;
			}
				
				echo "<table align='left' id='table1'>
				<tr>
					<th>Laptop ID</th>
					<th>Laptop Name</th>
					<th>Quantity</th>
					<th>Price</th>
					<th>Total Price</th>
					<th>Action</th>
				</tr>";

				$qry1 = "SELECT lap_id,sale_qty,tot_price FROM sales_items where sale_id=$sid";
				$result1 = $conn->query($qry1);
				$sum=0;

				if ($result1->num_rows > 0) {
		
				while($row1 = $result1->fetch_assoc()) {
			
				$lapid=$row1["lap_id"];
				$qry2 = "SELECT lap_name,lap_price FROM laptop where lap_id=$lapid";
				$result2 = $conn->query($qry2);
				$row2=$result2->fetch_row();
				
				echo "<tr>";
					echo "<td>" . $row1["lap_id"]. "</td>";
					echo "<td>" . $row2[0] . "</td>";
					echo "<td>" . $row1["sale_qty"]. "</td>";
					echo "<td>" . $row2[1] . "</td>";
					echo "<td>" . $row1["tot_price"]. "</td>";
					echo "<td align=center>";
					echo "<a name='delete' class='button1 del-btn' href=pos-delete.php?lid=".$row1['lap_id']."&slid=".$sid.">Delete</a>";
					echo "</td>";
				echo "</tr>";
				}
				echo "</table>";
			}


			
				$res=mysqli_query($conn,"SET @p0=$sid;");
				$res=mysqli_query($conn,"CALL `TOTAL_AMT`(@p0,@p1);") or die(mysqli_error($conn));
				$res=mysqli_query($conn,"SELECT @p1 as TOTAL;");
				
				while($row3=mysqli_fetch_array($res))
				{
					$tot=$row3['TOTAL'];
				}
				
				echo "<table align='left' id='table1'>
					
				<tr style='background-color: #f2f2f2;'>
				<td>Total</td>
				<td>";echo $tot;
				echo "</td>
				</tr>
				</table>";	
		?>

	</div>

	<div class="one" style="background-color:white;">
		<form method=post>
		<!-- <a name='pos1' class='button1 view-btn' href=pos1.php?sid=".$sid.">Go Back to Sales Page</a>  -->
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		

		<a name='pos1' class='button1 view-btn' href='bill.php' >Complete Order</a> 


		<!-- <input type='submit' name='complete_refresh' value='Complete Order'>

		<?php
			// if(isset($_POST['complete_refresh']))
			// {
			// 	echo '<meta http-equiv = "refresh" content = "5	; url = bill.php" />';
			// }
		?> -->



		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

		<input type='submit' name='cancel' value='Cancel Order'><br>
		<!-- <a name='cancel' class='button1 view-btn' href=pos1.php>Cancel</a> -->
		</form>
		</div>

	<?php
		if(isset($_POST['cancel']))
		{
			$qr1="DELETE FROM `SALES` WHERE SALE_ID=$sid";
			$del_res=$conn->query($qr1);
			if($del_res)
			{
				echo("<meta http-equiv='refresh' content='0'>");
			}
			else
			echo "Failed to cancel";
		}
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