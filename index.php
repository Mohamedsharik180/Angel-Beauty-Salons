<?php

require_once("includes/configure.php");
require_once("includes/common_functions.php");
include ("newslettter.php");


if(isset($_POST['txtbx_email'])&& $_POST['txtbx_email']!="mohamedsharik619@gmail.com" && isset($_POST['txtbx_pass']) && $_POST['txtbx_pass']!="Shai@619")
{
	//echo "entered";
	 $login_username =stripslashes(addslashes(trim($_POST['txtbx_email'])));
	 $login_password =md5(stripslashes(addslashes(trim($_POST['txtbx_pass']))));
	$Obj = new ClassCmnFunctions;
	$Arrpostdata = array("type"=>"login","username"=>$login_username,"password"=>$login_password);
	//print_r($Obj->funCurl($Arrpostdata));
	$ArrCurlResponse = json_decode($Obj->funCurl($Arrpostdata),TRUE);
	//print_r($ArrCurlResponse);
	if($ArrCurlResponse["error"]) {
		$loginerror_message= $ArrCurlResponse["message"];
	} else {
		 $_SESSION['sespromouser_id']=$ArrCurlResponse["user_id"];
		header("Location: form.php");
		exit;
	}
}

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body{
	background:url(images/bk1.png) repeat-x top;
}
.header{
padding:10px;
}
.account-container {
	width: 67%; 
	display: block;
	margin: 85px auto 0 auto;
	height:240px;
	background: purple;
	border: 6px solid black;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	

	box-shadow:  0px 0px 2px #dadada, inset 0px -3px 0px #e6e6e6;
}
.content {
	padding: 0px 28px 23px;
} 
.watermark{
	
	position:absolute;
	z-index:-1;
	text-align:center;
	/*margin: 50px auto 0 auto;*/

}

.login-fields {
	
}

.login-fields .field {
	margin-bottom: 1.25em;
}

.login-fields label {
	display: none;
}

.login-fields input {
	font-family: 'Open Sans';
	font-size: 5px;
	color: #8e8d8d;
	padding: 11px 10px 10px 30px;
	background-color: #fdfdfd;
	border:solid;
	border-color:#000000;
	width: 250px;
	display: block;
	margin: 0;
	box-shadow: inset 2px 2px 2px #f1f1f1;
}

.email-field { /*background: url(images/email.png) no-repeat; */
-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	border-radius:2px

	box-shadow:  0px 0px 2px #dadada;
}

.password-field { /*background: url(images/password.png) no-repeat;*/
-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;

	box-shadow:  0px 0px 2px #dadada;
}
.login-actions {
	float: left;
	width: 100%;
	margin-top: -1em;
	margin-bottom: 1.25em;
}


[class^="icon-"]:before, [class*=" icon-"]:before {
  font-family: FontAwesome;
  font-weight: normal;
  font-style: normal;
  display: inline-block;
  text-decoration: inherit;
}
input[type="text"],
input[type="password"],
textarea {
	color:black;
	width: 90%;
	font-family:verdana;
	font-size:10px;
}

input {
  height: auto;
}
#txtbx_email:-moz-placeholder{
  color: #cdc9ca;
}
#txtbx_pass:-moz-placeholder {
  color: #cdc9ca;
}
#txtbx_email:-webkit-input-placeholder{
  color: #cdc9ca;
}
#txtbx_pass:-webkit-input-placeholder {
  color: #cdc9ca;
}
#txtbx_email:-ms-input-placeholder{
  color: #cdc9ca;
}
#txtbx_pass:-ms-input-placeholder{
  color: #cdc9ca;
}

input[type="text"],
input[type="password"]{
  background-color: #ffffff;
  border: 1px solid #cccccc;
  -webkit-border-radius: 3px;
     -moz-border-radius: 3px;
          border-radius: 3px;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
     -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
          box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  -webkit-transition: border linear 0.2s, box-shadow linear 0.2s;
     -moz-transition: border linear 0.2s, box-shadow linear 0.2s;
      -ms-transition: border linear 0.2s, box-shadow linear 0.2s;
       -o-transition: border linear 0.2s, box-shadow linear 0.2s;
          transition: border linear 0.2s, box-shadow linear 0.2s;
}

input[type="text"]:focus {
  border-color: rgba(82, 168, 236, 0.8);
  outline: 0;
  outline: thin dotted \9;
  /* IE6-9 */

  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6);
     -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6);
          box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6);
}
input[type="password"]:focus {
  border-color: rgba(82, 168, 236, 0.8);
  outline: 0;
  outline: thin dotted \9;
  /* IE6-9 */

  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6);
     -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6);
          box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6);
}

</style>
<title> User Login</title>
<script src="jscript/jquery-1.8.0.min.js"  language="javascript"></script>
</head>
<body style="margin:0px">
<div class="header"><img src="images/logo.jpg" width="200" height="66"  style="margin-left: auto;  margin-right: auto;display:block;"/></div>
<!-- <div class="watermark" style="width:100%;"><img src="images/watermark.png" ></img></div> -->
<div class="account-container">
	<div class="content" >
		<form name="frm_login_user" id="frm_login_user" method="post" action="index.php">
			<div><h3><font face="verdana" color="black">User Login</font></h3>
				<div id="message" style="margin-top:-20px;height:20px"><font color="black" face="verdana" size="2px"><b><?php echo $loginerror_message?></b></font></div>
			</div>
			<div class="login-fields">
			  <div class="field">
					<label for="email">Email:</label>
						<input type="text" id="txtbx_email" name="txtbx_email" placeholder="Email" class="email-field" />
			  </div> <!-- /field -->
				<div id="pass-message" style="opacity:0;">
				</div>
				<div style="height:10px"></div>
				<div class="field">
					<label for="password">Password:</label>
					<input type="password" id="txtbx_pass" name="txtbx_pass" value="" placeholder="Password" class="password-field"/>
				</div>
			</div> 
			<br>
			<div class="login-actions"><img src="images/login.png" width="169" height="49" id="login-button" style="cursor:pointer;margin-left: auto;  margin-right: auto;display:block;"></div> 
		</form>
	</div> 
</div>
</body>
</html>
<script>

$(document).ready(function(){
	$('#txtbx_email').focus();		
	$('input').keypress(function(event){

            if(event.keyCode == 13)
            {
                $('#login-button').trigger('click');
            }
        });

	$("#login-button").click(function(){ 
			var x = $.trim($('#txtbx_email').val());			
			var atpos=x.indexOf("@");
			var dotpos=x.lastIndexOf(".");
			if($.trim($('#txtbx_email').val())=="")
			{		
//				$("#mess-div").fadeOut(10);
				$("#message").html("Please enter email address");
				$("#txtbx_email").css({"border-color":"red"});
				$("#message").css({"font-size":"13px","font-family":"verdana","color":"red","font-weight":"bold"});
				$("#message").fadeIn(600);				
				$('#txtbx_email').focus();
				$('#txtbx_email').val('');					
				return false;
			}
			else if (atpos<1 || dotpos<atpos+3 || dotpos+2>=x.length)
			{
//				$("#mess-div").fadeOut(10);
				$("#message").html("Please enter a valid email address");
				$("#txtbx_email").css({"border-color":"red"});
				$("#message").css({"font-size":"13px","font-family":"verdana","color":"red","font-weight":"bold"});
				$("#message").fadeIn(600);				
				$('#txtbx_email').focus();						
				return false;
			}
			else if($.trim($('#txtbx_pass').val())=="")
			{
				$("#message").html("Please enter password");
				$("#txtbx_pass").css({"border-color":"red"});
				$("#message").css({"font-size":"13px","font-family":"verdana","color":"red","font-weight":"bold"});
				$("#message").fadeIn(600);	
				$('#txtbx_pass').focus();
				$('#txtbx_pass').val('');
				return false;
			}			
			else
			{
                           
				$("#frm_login_user").submit();
                                return true;
			}
		
	});
		$("#txtbx_email").keypress(function(event){
//				$("#mess-div").fadeOut(1000);
			if(event.keyCode != 13)
				$("#message").fadeOut(1000);
			 else
				$("#message").fadeOut(2000);
			
		});
		$("#txtbx_pass").keypress(function(event){
//				$("#mess-div").fadeOut(1000);
			if(event.keyCode != 13)
				$("#message").fadeOut(1000);
			else
				$("#message").fadeOut(2000);
			
		});
}); 


</script>


