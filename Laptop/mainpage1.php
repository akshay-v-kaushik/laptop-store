<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" type="text/css" href="login1.css">
<div class="header">
<h1>Laptop Store Management System</h1>
 <p style="margin-top:-20px;line-height:1;font-size:30px;"> Database Management System Project</p>
 <p style="margin-top:-20px;line-height:1;font-size:20px;">Department of Information Science and Engineering</p>
</div>
<title>
Laptopia
</title>
</head>

<body style="font-family:Arial;
	background-image:url('bg.png');
	background-size:cover;
	overflow:hidden;
	background-position-y: -180px;">

	<br><br><br><br>
	<div class="container">
		<form method="post" action="">
			<div id="div_login">
				<h1>Employee Login</h1>
				<center>
				<div>
					<input type="text" class="textbox" id="uname" name="uname" placeholder="Username" />
				</div>
				<div>
					<input type="password" class="textbox" id="pwd" name="pwd" placeholder="Password"/>
				</div>
				<div>
					<input type="submit" value="Submit" name="submit" id="submit" />
					<input type="submit" value="Click here for Admin Login" name="psubmit" id="submit" />
				</div>
			 
				
	<?php
				
		include "config.php";

		if(isset($_POST['submit'])){

			$uname = mysqli_real_escape_string($conn,$_POST['uname']);
			$password = mysqli_real_escape_string($conn,$_POST['pwd']);

			if ($uname != "" && $password != ""){

				$sql="SELECT e_id FROM emplogin WHERE e_username='$uname' AND e_pass='$password'";
				$result = $conn->query($sql);
				$row = $result->fetch_row();
				if(!$row) {
					echo "<p style='color:red;'>Invalid username or password!</p>";
				}
				else {
				
					$emp=$row[0];
					session_start();
					$_SESSION['user']=$emp;
					header("location:empmainpage.php");
				}
			}
		}
				
		if(isset($_POST['psubmit']))
		{
			header("location:index.php");
		}
	?>

		</center> 
			</div>
		</form>
	</div>
	<div class=footer>
	<br>
	1RN19IS002 and 1RN19IS019
	<br><br>
	</div>

</body>

</html>