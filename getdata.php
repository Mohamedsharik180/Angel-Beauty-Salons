<?php
require_once("includes/configure.php");
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
	width: 99%; 
	display: block;
	margin: 20px auto 0 auto;
	/*height:240px;
	background: #f9f9f9;
	border: 1px solid #CE1E2E;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;

	box-shadow:  0px 0px 2px #dadada, inset 0px -3px 0px #e6e6e6;*/
}
.content {
	padding: 0px 28px 23px;
} 
.watermark{
	
	position:absolute;
	z-index:-1;
	text-align:center;
	margin: 50px auto 0 auto;

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
	font-size: 13px;
	color: #8e8d8d;
	padding: 11px 10px 10px 50px;
	background-color: #fdfdfd;
	width: 250px;
	display: block;
	margin: 0;
	box-shadow: inset 2px 2px 4px #f1f1f1;
}

.email-field { background: url(images/email.png) no-repeat; 
-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;

	box-shadow:  0px 0px 2px #dadada;
}

.password-field { background: url(images/password.png) no-repeat;
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
	font-size:11px;
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

input[type="radio"] {
  margin-top: -1px;
  vertical-align: middle;
  display: table-cell;
    vertical-align: middle
}

</style>
<title>Retrieve Data</title>
<script src="jscript/jquery-1.8.0.min.js"  language="javascript"></script>
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen">
</head>
<body style="margin:0px">
<div class="header"><img src="images/logo.png"  style="margin-left: auto;  margin-right: auto;display:block;"/></div>
<!-- <div class="watermark" style="width:100%;"><img src="images/watermark.png" ></img></div> -->
<div class="account-container">
	<div class="content" >
		<form name="frm_promotion" id="frm_promotion" method="post" >
			<table width="100%" cellspacing="1" cellpadding="0" align="center">
				<tbody>
				<tr height="33">
					<td colspan="2" style="color:white;font-family:verdana;color:red;font-size:12;font-weight:bold;padding-top:50px;" align="center" id='message'></td>
				</tr>
				</tbody>
			</table>
		</form>
	</div> 
</div>
</body>
</html>
<script>
$(document).ready(function(){
	if (typeof(Storage) !== "undefined") {
		if (localStorage.getItem("LSformAnswers") === null) {
			$("#message").html("No data available in local storage.");
			$("#message").css({"font-size":"13px","font-family":"verdana","color":"red","font-weight":"bold"});
			$("#message").fadeIn(600);
		} else {
			var formData = localStorage.getItem('LSformAnswers');
			console.log(formData);
			$.ajax({
				type: "POST",
				//dataType: "json",
				url: "ajxsavelocaldata",
				data: {'formData':formData},
				success: function(data){
//					alert('Items added '+data);
					if(data=="success") {
		//					localStorage.setItem('LSformAnswers', []);
		//					localStorage.removeItem('LSformAnswers');
						
						//$('#audit_count').html(0);
						$("#message").html("Data retrieved successfully");
						$("#message").css({"font-size":"13px","font-family":"verdana","color":"green","font-weight":"bold"});
						$("#message").fadeIn(600);	
						
						localStorage.clear();
						alert("Data retrieved successfully");
						console.log("clear data");

						//console.log("LocStreAudit "+localStorage.getItem("StreLocalAudit"));
					}
					else {
						alert("Unfortunately some error occured while saving data");
						$("#message").html("Unfortunately some error occured while saving data");
						$("#message").css({"font-size":"13px","font-family":"verdana","color":"red","font-weight":"bold"});
						$("#message").fadeIn(600);
					}
				},
				error: function(xhr, textStatus, errorThrown) {
					console.log(xhr.status);
					if(xhr.status==0) {
						alert("Network connection lost. Please check your network connection");
						$("#message").html("Network connection lost. Please check your network connection");
						$("#message").css({"font-size":"13px","font-family":"verdana","color":"red","font-weight":"bold"});
						$("#message").fadeIn(600);
					}
					
				}
			});
		}
	}
}); 
</script>