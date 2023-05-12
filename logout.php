<?php
include("includes/configure.php");

//// Unset all of the session variables.
//if(isset($_SESSION['sesUserType']) && $_SESSION['sesUserType']=="Client")
// $page="login.php";
//else
$page=HTTP_ROOT_FOLDER;

$_SESSION['sespromouser_id']='';
unset($_SESSION['sespromouser_id']);
//session_unset();

//Finally, destroy the session.
//session_destroy();
//Finally, unset the cookie.
setcookie ("userid", "", time() - 3600);
setcookie ("clientid", "", time() - 3600);
setcookie ("logid", "", time() - 3600);
setcookie ("dbname", "", time() - 3600);
setcookie ("privileges", "", time() - 3600);

//function used to delete the given cookie
header("Location: index.php");
exit;
?>