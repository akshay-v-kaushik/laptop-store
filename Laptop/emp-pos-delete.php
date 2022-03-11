<?php
	include "config.php";
	$sql="DELETE FROM sales_items where sale_id='$_GET[slid]' and lap_id='$_GET[lid]'";
	if ($conn->query($sql)){
	header("location:emp-pos1.php");
	exit();
	}
	else
	echo "Error";
?>


