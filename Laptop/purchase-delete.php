<?php
	include "config.php";
	$pid=$_GET['pid'];
	$vid=$_GET['vid'];
	$lid=$_GET['lid'];
				
	$sql="DELETE FROM purchase where p_id='$pid' and ven_id='$vid' and lap_id='$lid'";

	if ($conn->query($sql))
	header("location:purchase-view.php");
	else
	echo "error";
?>