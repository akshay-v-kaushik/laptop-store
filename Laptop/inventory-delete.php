<?php
	include "config.php";
		$id = $_GET['id'];
		$sql="DELETE FROM laptop where lap_id=$id";
		$result = $conn->query($sql);
		if ($result)
		header("location:inventory-view.php");
		else
		echo "error";
		
	
?>