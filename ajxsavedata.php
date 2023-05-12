<?php
require_once("includes/configure.php");
require_once("includes/common_functions.php");
$Obj = new ClassCmnFunctions;
//echo '<script>alert("Welcome to Geeks for Geeks")</script>';
$Arrpostdata = array("type"=>"saveuserformdata","user_id"=>$_POST['user_id'],"formData"=>$_POST['formData']);
//echo '<script>console.log('.$_POST['formData'].')</script>';
$ArrCurlResponse = json_decode($Obj->funCurl($Arrpostdata),TRUE);

if(!$ArrCurlResponse["error"]) 
	die("success");
else
	die("failure");
?>
