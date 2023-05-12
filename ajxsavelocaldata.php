<?php
require_once("includes/configure.php");
require_once("includes/common_functions.php");
$Obj = new ClassCmnFunctions;

$Arrpostdata = array("type"=>"savelocalstoragedata","formData"=>$_POST['formData']);
$ArrCurlResponse = json_decode($Obj->funCurl($Arrpostdata),TRUE);

if(!$ArrCurlResponse["error"]) 
	die("success");
else
	die("failure");