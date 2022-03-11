<?php
	include "config.php";
	$sql="DELETE FROM vendor where ven_id='$_GET[id]'";
	if ($conn->query($sql))
	header("location:vendor-view.php");
	else
	echo "error";
?>