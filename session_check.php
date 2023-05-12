<?php
if(!isset($_SESSION['sespromouser_id']) || trim($_SESSION['sespromouser_id'])=="")
{
	header("Location: index.php");
	exit;
}
?>