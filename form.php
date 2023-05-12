<?php

require_once("includes/configure.php");
require_once("includes/common_functions.php");
include("session_check.php");
$SiteDbConnection=mysql_connect(DATABASE_SERVER, DBUSER, DBPASS,1);
mysql_select_db(MASTER_DATABASE,$SiteDbConnection);
$userid = $_SESSION['sespromouser_id'];

$sqlvisitqry = "select date_format(opened_visit_month,'%Y-%m-%d') as opened_visit_month from tbl_visit_settings where open_type='data_upload' and countries<>'' order by date_format(opened_visit_month,'%Y-%m-%d') DESC limit 1";
$sqlvisit = mysql_query($sqlvisitqry);
if(mysql_num_rows($sqlvisit)>0)
{
	while($fetchvisit=mysql_fetch_array($sqlvisit))
	{
		$opened_visit_month = $fetchvisit['opened_visit_month'];
	} 
}

list($fullyear,$month,$date)=explode("-",$opened_visit_month);
$year=substr($fullyear,2,2);
$tblsuffix="_".$month."_".$year;
$tbloutlets = "tbl_outlets_master".$tblsuffix;
$tblpromo = "tbl_promotion_data";

//Get outlet details from outlets master
$currentdate = date("Y-m-d");
$scheduledatecondn = " AND '".$currentdate."' >= scheduled_date AND '".$currentdate."' <= scheduled_to_date";
$sqloutletqry="select outlet_code, outlet_name from $tbloutlets where user_access like '%^".$userid."^%' $scheduledatecondn order by outlet_code ASC";
//$sqloutlet=mysql_query($sqloutletqry);
$outlet_code="Null";
$outlet_name="Null";
echo mysql_num_rows($sqloutlet);
if(mysql_num_rows($sqloutlet)>0)
{
	while($fetchoutlet=mysql_fetch_array($sqloutlet))
	{
		$outlet_code = $fetchoutlet['outlet_code'];
		$outlet_name = $fetchoutlet['outlet_name'];
		

		$Arroutlets[$outlet_code] = $outlet_name;
		
	}
}

//First outlet code
//$outletcode = key($Arroutlets);


$sqlidqry="select count(id) as count from $tblpromo";
$sqlid=mysql_query($sqlidqry);
if(mysql_num_rows($sqlid)>0)
{
	while($fetchid=mysql_fetch_array($sqlid))
	{
		$id=$fetchid['count'] +1;
	}
}
//First outlet code
$outletcode = key($Arroutlets);



$currentdate = date("Y-m-d");

$Arrcat = array();
$Obj = new ClassCmnFunctions;

$_SESSION['outlet']=$outletcode;
$Arrpostdata = array("type"=>"getuserformdata","user_id"=>$userid);

$ArrCurlResponse = json_decode($Obj->funCurl($Arrpostdata),TRUE);
$Arroutlets = $Arroutletauditcnt = array();
$outletcode='';
if(!$ArrCurlResponse["error"]) {
	//$Arroutlets = $ArrCurlResponse["outlets"];
	$Arroutletauditcnt = $ArrCurlResponse["outletauditcnt"];
	
}
//echo ($Arroutletauditcnt['count']);*/

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

.multiselecterror1, .multiselecterror2, .multiselecterror3, .multiselecterror4 {
	display: inline-block;
	padding: 6px 12px;
	margin-bottom: 0;
	font-size: 14px;
	font-weight: 0;
	line-height: 1.42857143;
	text-align: left;
	white-space: nowrap;
	vertical-align: middle;
	-ms-touch-action: manipulation;
	touch-action: manipulation;
	cursor: pointer;
	-webkit-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
	background-image: none;
	border: 1px solid transparent;
		border-top-color: transparent;
		border-right-color: transparent;
		border-bottom-color: transparent;
		border-left-color: transparent;
	border-radius: 4px;
	border-color: gray;
}

</style>
<title>Lexus form</Form></title>
<!-- <script src="jscript/jquery-1.8.0.min.js"  language="javascript"></script> -->
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen">
<link rel="stylesheet" href="style/bootstrap.min-3.3.5.css">
<script type="text/javascript" src="jscript/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="jscript/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="jscript/webcam.min.js"></script>
<script type="text/javascript" src="jscript/bootstrap.min-3.3.5.js"></script>
<script type="text/javascript" src="jscript/bootstrap-multiselect.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="style/bootstrap-multiselect.css">
</head>
<body style="margin:0px">
<div class="header"><img src="images/logo.jpg" width="204" height="71"  style="margin-left: auto;  margin-right: auto;display:block;"/></div>
<!-- <div class="watermark" style="width:100%;"><img src="images/watermark.png" ></img></div> -->
<div class="account-container">
	<div class="content" >
		<form name="frm_electro" id="frm_electro" method="post" >
			<input type="hidden" name="id" id="id" value="<?php echo $id; ?>" class="ignore">
			<input type="hidden" name="user_id" id="user_id" value="<?php echo $userid; ?>" class="ignore">
			<input type="hidden" name="latitude" id="latitude" value="" class="ignore">
			<input type="hidden" name="longitude" id="longitude" value="" class="ignore">
			
			<!-- <h3><font face="verdana" color="black">User Login</font></h3> -->
			<div>
				<table width="100%" cellspacing="1" cellpadding="0" align="center">
					<tr>
						<td align="right"><a href="logout.php" style="font-family:verdana;color:black;font-size:13px;color:blue;"><b>Logout</b></a></td>
					</tr>
					<tr><td align='center' height="5px"></td></tr>
				</table>
			</div>
			<div>
				
				<table width="100%" cellspacing="1" cellpadding="0" align="center">
					<tr>
						<td align="left" style="font-family:verdana;color:black;font-size:12px;">Successful Entries: <span class="success_message" id='audit_count' style="font-size:14px;"><?php echo $Arroutletauditcnt['count']; ?></span></td>
						<td align='right' height="25px" id='gps_coordinate' class="gps_coordinate" style='display:none;font-family:verdana;color:black;font-size:11px;width:85%;' colspan='2'>
							<b>Lat: </b><span id='lat' class='lat'></span>&nbsp;&nbsp;<b>Long: </b><span id='long' class='long'></span>
						</td>
					</tr>
				</table>
			</div>
			<table width="100%" cellspacing="1" cellpadding="0" align="center">
				<tbody>
					<tr height="33" bgcolor="#EF4750">
						<td colspan="3" align="center" bgcolor="#330066" style="color:white;font-family:verdana;color:white;font-size:12;font-weight:bold;">LEXUS </td>
					</tr>
					<tr height="33" bgcolor="#f9b5b8">
						<td width="50%" align="right" bgcolor="#CCCC33" style="display:;font-family:verdana;color:black;font-size:13px;padding-right:10px;">Outlet Name </td>
						<td width="50%" colspan="3" align="center" bgcolor="#CCCC00" style="display:;font-family:verdana;color:black;font-size:12px;">MoHAMED SHARIK										  </td>
					</tr>
					<tr height="33" bgcolor="#f9b5b8">
						<td width="50%" align="right" bgcolor="#CCCC33" style="display:;font-family:verdana;color:black;font-size:13px;padding-right:10px;">Region </td>
						<td width="50%" colspan="3" align="center" bgcolor="#CCCC00" style="display:;font-family:verdana;color:black;font-size:12px;">United Arab Emirates										  </td>
					</tr>
					<tr height="33" bgcolor="#f9b5b8">
						<td width="50%" align="right" bgcolor="#CCCC33" style="display:;font-family:verdana;color:black;font-size:13px;padding-right:10px;">Date </td>
						<div id="current_date"></p>
				  </td>
					</tr>
					
					<tr height="33" bgcolor="#f9b5b8">
						<td width="50%" align="right" bgcolor="#CCCC00" style="display:;font-family:verdana;color:black;font-size:13px;padding-right:10px;">Category</td>
						<td style="display:;font-family:verdana;color:black;font-size:12px;" width="50%" align="center" colspan="3">
							<select name="category" id="category"  style="width:100%;height:100%;font-size:11px;height:35px;">
							<option value="select">Select</option>
							<option value="1">porche</option>
							<option value="2">ferrari</option>
							<option value="3">Toyato</option>
							<?php
								echo $sqlcatqry="select category_code, category_name as catname from tbl_category_master_07_21";
								
								$sqlcat=mysql_query($sqlcatqry);
								if(mysql_num_rows($sqlcat)>0)
								{
									while($fetchcat=mysql_fetch_array($sqlcat))
									{
										
										
										echo "<option value=".$fetchcat['category_code'].">".$fetchcat['catname']."</option>";
										
									}
								}

								
								?>
							</select>						</td>
					</tr>
					<tr height="33" bgcolor="#f9b5b8">
						<td width="50%" align="right" bgcolor="#CCCC00" style="display:;font-family:verdana;color:black;font-size:13px;padding-right:10px;">Brand</td>
						<td style="display:;font-family:verdana;color:black;font-size:12px;" width="50%" align="center" 
						>
							<select name="quantity" id="quantity" style="width:100%;height:100%;font-size:11px;height:35px;">
							<option value="">Select</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
						</select>						</td>
					</tr>
					
					<tr height="33" bgcolor="#f9b5b8">
						<td width="50%" align="right" bgcolor="#CCCC00" style="display:;font-family:verdana;color:black;font-size:13px;padding-right:10px;">Model Number</td>
						<td style="display:;font-family:verdana;color:black;font-size:12px;" width="50%" align="center" 
						>
							<select name="quantity" id="quantity" style="width:100%;height:100%;font-size:11px;height:35px;">
							<option value="">Select</option>
							<option value="1">1236</option>
							<option value="2">2345</option>
							<option value="3">3478</option>
						</select>						</td>
					</tr>
					<tr height="33" bgcolor="#f9b5b8">
						<td width="50%" align="right" bgcolor="#CCCC00" style="display:;font-family:verdana;color:black;font-size:13px;padding-right:10px;">Quantity</td>
						<td style="display:;font-family:verdana;color:black;font-size:12px;" width="50%" align="center" 
						>
							<select name="quantity" id="quantity" style="width:100%;height:100%;font-size:11px;height:35px;">
							<option value="">Select</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
						</select>						</td>
					</tr>
					<tr height="33" bgcolor="#f9b5b8">
						<td width="50%" align="right" bgcolor="#CCCC00" style="display:;font-family:verdana;color:black;font-size:13px;padding-right:10px;">Selling Price</td>
						<td style="display:;font-family:verdana;color:black;font-size:12px;"  colspan="3" width="50%" align="center"><input type="number"  name="rrp" id="rrp"  style="width:100%;height:100%;font-size:11px;height:35px;"></input></td>
					</tr>
					<tr height="33" bgcolor="#f9b5b8">
						<td width="50%" align="right" bgcolor="#CCCC00" style="display:;font-family:verdana;color:black;font-size:13px;padding-right:10px;">Offer Price</td>
						<td style="display:;font-family:verdana;color:black;font-size:12px;" width="50%" colspan="3" align="center"><input type="number" name="offer" id="offer"  style="width:100%;height:100%;font-size:11px;height:35px;"></input></td>
					</tr>
					<tr height="33" bgcolor="#f9b5b8" >
						
							<td width='25%'  align="right" bgcolor="#CCCC00" style="display:;font-family:verdana;color:black;font-size:13px;padding-right:10px;"> Name</td>
							<td style="display:;font-family:verdana;color:black;font-size:12px;" colspan="3"width="50%" align="center"><input type="text" name="custname" id="custname" rows="" cols=""  style="width:100%;font-size:11px;height:35px;"></input></td>
					</tr>
					<tr height="33" bgcolor="#f9b5b8" >
						
							<td width='25%'  align="right" bgcolor="#CCCC00" style="display:;font-family:verdana;color:black;font-size:13px;padding-right:10px;"> Contact no</td>
							
							<td style="display:;font-family:verdana;color:black;font-size:12px;" width="50%" align="center">
							<div id="contacthide" width='100%'>
							<input type="text" name="country" id="country" value="+971" style="width:15.5%;font-size:11px;height:35px;" readonly></input>
							<input type="text" name="con" id="con"   maxlength='7' style="width:68.5%;font-size:11px;height:35px;"></input>
							</div>						</td>
							
							<input type="hidden" name="contact" id="contact" value="" class="ignore">
							<script></script>
					</tr>
					
					<tr height="33" bgcolor="#f9b5b8" >
						
							<td width='25%'  align="right" bgcolor="#CCCC00" style="display:;font-family:verdana;color:black;font-size:13px;padding-right:10px;"> E-mail</td>
							<td style="display:;font-family:verdana;color:black;font-size:12px;" width="50%" align="center"><input type="text" name="email" id="email" rows="" cols="" style="width:100%;font-size:11px;height:35px;" onBlur="checkEmail(this)"></input></td>
					</tr>
					<tr height="33" bgcolor="#f9b5b8" >
						
							<td width='25%'  align="right" bgcolor="#CCCC00" style="display:;font-family:verdana;color:black;font-size:13px;padding-right:10px;"> Customer feedback</td>
							<td style="display:;font-family:verdana;color:black;font-size:12px;" width="50%" align="center"><textarea  name="feedback" id="feedback" rows="" cols="" style="width:100%;font-size:11px;height:35px;"></textarea></td>
					</tr>
					
					<tr height="33" bgcolor="#f9b5b8">
						<td width="50%" align="right" bgcolor="#CCCC00" style="display:;font-family:verdana;color:black;font-size:13px;padding-right:10px;"> Invoice Image</td>
						<td bgcolor="#CCCC00">
						<div>
      						<label for="fileToUpload">Take or select photo(s)</label><br />
      						<input type="file" name="invoiceimg" id="invoiceimg" onChange="fileSelected(this,'detail2','invoiceimage');" accept="image/*" capture="camera" />
   						  </div>
    						<div id="details2"><input type="hidden" name="invoiceimage" id="invoiceimage" value="" class="ignore"></div>
    						<div>
      						
    						<div id="progress"></div>					  </td>
					</tr>
					
					<tr height="33" bgcolor="#f9b5b8">
						<td width="50%" align="right" bgcolor="#CCCC00" style="display:;font-family:verdana;color:black;font-size:13px;padding-right:10px;">User Sales</td>
						<td id="anal" name="anal" style="display:;font-family:verdana;color:black;font-size:12px;" width="50%" align="center"><input type="text" name="analysis" id="analysis" rows="" cols="" style="width:100%;font-size:11px;height:35px;" value='0' readonly></input></td>
				  </tr>
					<tr>
					<tr height="33" bgcolor="#f9b5b8">
						<td width="50%" align="right" bgcolor="#CCCC00" style="display:;font-family:verdana;color:black;font-size:13px;padding-right:10px;">User Target</td>
						<td id="anal" name="anal" style="display:;font-family:verdana;color:black;font-size:12px;" width="50%" align="center"><input type="text" name="analysis" id="analysis" rows="" cols="" style="width:100%;font-size:11px;height:35px;" value='0' readonly></input></td>
				  </tr>
					<tr>
					<tr height="33" bgcolor="#f9b5b8">
						<td width="50%" align="right" bgcolor="#CCCC00" style="display:;font-family:verdana;color:black;font-size:13px;padding-right:10px;">Sales Analysis</td>
						<td id="anal" name="anal" style="display:;font-family:verdana;color:black;font-size:12px;" width="50%" align="center"><input type="text" name="analysis" id="analysis" rows="" cols="" style="width:100%;font-size:11px;height:35px;" value='0' readonly></input></td>
				  </tr>
					<tr>
						<td colspan='2' align='right' height="25px" id='gps_coordinate' class="gps_coordinate" style='display:none;font-family:verdana;color:black;font-size:11px;'>
							<b>Lat: </b><span id='lat' class='lat'></span>&nbsp;&nbsp;<b>Long: </b><span id='long' class='long'></span>						</td>
					</tr>
					
					<tr><td colspan='2' align='center' height="5px"></td></tr>

					<tr id='savebtn'><td></td>
					<td align='center'> <!-- <input type="button" value="Save" name="btn_save" id="btn_save" class="button75 ignore"> -->
					  <input type="button" value="Main Menu" name="btn_save_upload" id="btn_save_upload" class="button75 ignore" style="width:100px;font-size:13px;">
					  <input type="button" value="Save" name="btn_save_upload" id="btn_save_upload" class="button75 ignore" style="width:100px;font-size:13px;"></td></tr><!-- Save & Upload -->
					<tr id='loading' style='display:none'><td colspan='2' align='center' style="display:;font-family:verdana;color:black;font-size:13px;padding-right:10px;"><img src='images/ajax_wait.gif' alt="Loading">Data Progressing.. Please wait..</td></tr>
					<tr><td colspan='2' align='center' height="10px"></td></tr>
					<tr><td colspan='2' align='center' height="10px" id="message"><font color="red" face="verdana" size="2px"><b></b></td></tr>
					<tr id='savebtn'><td></td>
					<td align='center'> <!-- <input type="button" value="Save" name="btn_save" id="btn_save" class="button75 ignore"> --></td>
					</tr><!-- Save & Upload -->
					<tr><td colspan='2' align='center' height="10px"></td></tr>
					<tr><td colspan='2' align='center' height="10px" id="message"><font color="red" face="verdana" size="2px"><b></b></td></tr>
				</tbody>
		  </table>
		</form>
	</div> 
</div>
</body>
</html>
<script>


//var storecode = "<?php echo $outletcode; ?>";
//console.log(storecode);
var user_id = "<?php echo $userid; ?>";
var month="<?php echo $tblsuffix;?>";
/*var Arrstauditcnt = <?php echo json_encode($Arroutletauditcnt) ?>;*/
var arrlocstorecnt = {};
	
function fileSelected(filenam,msg,input) {
 
 //var count = filenam.files[0].length;
 //console.log(count);
 
	   msg.innerHTML = "";

	 //  for (var index = 0; index < count; index ++)

	 //  {

			  var file = filenam.files[0];

			  var fileSize = 0;

			  if (file.size > 1024 * 1024)

					 fileSize = (Math.round(file.size * 100 / (1024 * 1024)) / 100).toString() + 'MB';

			  else

					 fileSize = (Math.round(file.size * 100 / 1024) / 100).toString() + 'KB';
					 

			  msg.innerHTML += 'Name: ' + file.name ;
			  console.log(document.getElementById(input).value=file.name);
			  msg.innerHTML += '<p>';

	   //}

}

function uploadFile(filenam,category,storecode,model,type) {

 var fd = new FormData();
 var path=storecode+'/'+category+'/'+model+"/"+type+"/";

 //var count = filenam.length;
//console.log(count);
 //for (var index = 0; index < count; index ++)

 //{

		var file = filenam;

		fd.append('myFile', file);

// }
	  
	   
//echo "Your file is uploaded with ".$user." name"; 
fd.append('path',path);
fd.append('category',category);
fd.append('store',storecode);

	   console.log(fd.getAll('myFile')) ;
	  // return fd;

 var xhr = new XMLHttpRequest();
 
 xhr.upload.addEventListener("progress", uploadProgress, false);

 xhr.addEventListener("load", uploadComplete, false);

 xhr.addEventListener("error", uploadFailed, false);

 xhr.addEventListener("abort", uploadCanceled, false);

 xhr.open("POST", "saveimage.php");
 

 xhr.send(fd);

}

function uploadProgress(evt) {

 if (evt.lengthComputable) {

   var percentComplete = Math.round(evt.loaded * 100 / evt.total);

   document.getElementById('progress').innerHTML = percentComplete.toString() + '%';

 }

 else {

   document.getElementById('progress').innerHTML = 'unable to compute';

 }

}

function uploadComplete(evt) {

 /* This event is raised when the server send back a response */

 alert(evt.target.responseText);

}

function uploadFailed(evt) {

 alert("There was an error attempting to upload the file.");

}

function uploadCanceled(evt) {

 alert("The upload has been canceled by the user or the browser dropped the connection.");

}

/*function getBase64Image(img) {
    var canvas = document.createElement("canvas");
    canvas.width = img.width;
    canvas.height = img.height;

    var ctx = canvas.getContext("2d");
    ctx.drawImage(img, 0, 0);

    var dataURL = canvas.toDataURL("image/png");

    return dataURL.replace(/^data:image\/(png|jpg);base64,/, "");
}*/







function funshowerrormessage(ctrlname, message) {
		$("#message").html(message);
		$("#"+ctrlname).css({"border-color":"red"});
		$("#message").css({"font-size":"13px","font-family":"verdana","color":"red","font-weight":"bold"});
		$("#message").fadeIn(600);				
		$('#'+ctrlname).focus();
		//$('#'+ctrlname).val('');
		return false;
	}
	function checkEmail(str)
{
	if(str.value!="")
	{
		var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if(!re.test(str.value))
	funshowerrormessage('email','Please enter a valid email address');

	}
    
    //alert("Please enter a valid email address");
}
var formdata = [];
var out="";
$(document).ready(function(){

	$('#store_code').change(function(){
		var selectedstorecode = $(this).val();
		 //console.log(selectedcategory);
		 $.ajax({
			 type: "POST",
			 url: "getchangedata.php",
			 data: { 'store_code' : selectedstorecode,'user_id':user_id } 
		 }).done(function(data){
			 $("#anal").html(data);
			 
		 });

		
	 });
	 
	

	$('#category').change(function(){
		
       var selectedcategory = $(this).val();
		//console.log(selectedcategory);
        $.ajax({
            type: "POST",
            url: "getchangedata.php",
            data: { 'category' : selectedcategory } 
        }).done(function(data){
            $("#model").html(data);
        });
    });
	

	

	$("#btn_save").click(function(){ 
		var x = $.trim($('#store_loc').val());
		formvalidate("save");
	});

	$("#btn_save_upload").click(function(){ 
		formvalidate("saveupload");
	});

	

	//Allow numeric validation only
	$('#rrp').on('input', function (event) {
		this.value = this.value.replace(/[^\d*\.?\d*$]/g, '');
	});
	$('#offer').on('input', function (event) {
		this.value = this.value.replace(/[^\d*\.?\d*$]/g, '');
	});
	$('#con').on('input', function (event) {
		this.value = this.value.replace(/[^0-9]/g, '');
	});
	$('#code').on('input', function (event) {
		this.value = this.value.replace(/[^0-9]/g, '');
	});
	
	
	

	
	



	function formvalidate(comefrom){
		var city = $.trim($('#city').val()).toUpperCase();
		var country = $.trim($('#country').val()).toUpperCase();
		
		if($.trim($('#category').val())=="select"||$.trim($('#category').val())=="")
		{
			funshowerrormessage('category','Please select category');
		}
		//else if ($('input[name="gender"]:checked').length == 0)
		else if($.trim($('#modelno').val())=="select"||$.trim($('#modelno').val())=="")
		{
			funshowerrormessage('modelno','Please select model number');
		}
		else if($.trim($('#quantity').val())=="select"||$.trim($('#quantity').val())=="")
		{
			funshowerrormessage('quantity','Please select quantity');
		}
		else if($.trim($('#rrp').val())=="")
		{
			funshowerrormessage('errp','Please enter RRP');
		}
		else if($.trim($('#custname').val())=="")
		{
			
			funshowerrormessage('custname','Please enter customer name');
		}
		else if($.trim($('#code').val())==""||$.trim($('#con').val())=="")
		{
			
			funshowerrormessage('code','Please enter contact no.');
		}
		else if($.trim($('#email').val())=="")
		{
			
			funshowerrormessage('email','Please enter email address');
		}
		else if($.trim($('#feedback').val())=="")
		{
			
			funshowerrormessage('feedback','Please enter feedback');
		}
		
		else if($.trim($('#invoiceimg').val())=="")
		{
			
			funshowerrormessage('invoiceimg','Please take image');
		}
		
		
		else
		{
			var img1= document.getElementById('comimg').files[0];
			var img2= document.getElementById('invoiceimg').files[0];
			document.getElementById('contact').value=document.getElementById('country').value+document.getElementById('code').value+document.getElementById('con').value;
			var element=document.getElementById('country');
			element. parentNode. removeChild(element);
			element=document.getElementById('code');
			element. parentNode. removeChild(element);
			element=document.getElementById('con');
			element. parentNode. removeChild(element);
			//console.log(img1);
			var cat=document.getElementById('category').value;
			var stcode=document.getElementById('store_code').value;
			var select=document.getElementById('modelno');
			var model = select.options[select.selectedIndex].value;
			
			
			var form_electro_data = $('#frm_electro').serializeArray();
			
			//console.log(form_electro_data);
			localStorage.removeItem('LSformAnswers');
			//Local storage data
			if (typeof(Storage) !== "undefined") {
				//alert("entered") ;
				// Parse the serialized data back into an aray of objects
				formdata = JSON.parse(localStorage.getItem('LSformAnswers')) || formdata;
				//console.log("1st");
				//console.log(formdata);
				// Push the new data (whether it be an object or anything else) onto the array
				//var currenttimestamp = parseInt(Date.now()/1000);
				var today = new Date();
				var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
				var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
				var currenttimestamp = date+' '+time;
				//console.log(currenttimestamp);
				form_electro_data.push({name: 'added_date', value: currenttimestamp});
				formdata.push(form_electro_data);
				// Alert the array value
				//alert(formdata);  // Should be something like [Object array]
				// Re-serialize the array back into a string and store it in localStorage
				localStorage.setItem('LSformAnswers', JSON.stringify(formdata));
	//				console.log(JSON.parse(localStorage.getItem('LSformAnswers')));


				


				//image converting

			/*	bannerImage1 = document.getElementById('comimg');
				imgData1 = getBase64Image(bannerImage1);
				localStorage.setItem("imgData1", imgData1);

				bannerImage2 = document.getElementById('invoiceimg');
				imgData2 = getBase64Image(bannerImage2);
				localStorage.setItem("imgData2", imgData2);*/






	//			$('#frm_promotion > input:text:not(".ignore")').val(''); 
	//			$('#frm_promotion > select:text:not(".ignore")').val('');
				//Reset form
				$('#frm_electro').find('input, select, textarea').not(".ignore").val('');
				
				
				answerobj = JSON.parse(localStorage.getItem('LSformAnswers'));
				//console.log("2nd");
				//console.log(answerobj);
	//			$('#audit_count').html(answerobj.length);

				if(comefrom=="save") {
					$("#message").html("Data saved successfully");
					$("#message").css({"font-size":"11px","font-family":"verdana","color":"green","font-weight":"bold"});
					$("#message").fadeIn(600);	
					$("#message").fadeOut(5000);
					$('#store_loc').focus();
				}

				if(comefrom=="saveupload") {
					$('#savebtn').hide();
					$('#loading').show();
					//$formdata1 = new FormData(document.getElementById(frm_electro));
					var formData = localStorage.getItem('LSformAnswers');
					formData=formData.replace(/\\/g, '');
					var image1=localStorage.getItem('imgData1');
					var image2=localStorage.getItem('imgData2');
					var user = $.trim($('#user_id').val());
					//console.log(user);
					//console.log(formData);
					var proceed=true;
					//console.log(proceed);
//					if($.trim($('#latitude').val())=="") {
//						if (confirm("GPS doesn't tracked this audit. Do you want to submit without GPS?") == true) {
//						  proceed=true;
//						console.log(proceed);
//						} else {
//						  proceed=false;
//						  console.log(proceed);
//						}
//					}
					if(proceed) {
						console.log(formData);
						//console.log(user);
						//console.log(formData);
						$.ajax({
							type: "POST",
							//dataType: "json",
							url: "ajxsavedata.php",
							 data: {
								 'formData':formData,
								 'user_id':user
								 },
							 
							success: function(data){
								alert('Items added '+data);
								console.log(data);
								if(data=="success") {
								
				//					//localStorage.setItem('LSformAnswers', []);
				//					localStorage.removeItem('LSformAnswers');
									var fd1=uploadFile(img1,cat,stcode,model,"competor");
									//imgsave(fd1);
									var fd2=uploadFile(img2,cat,stcode,model,"invoice");
									//imgsave(fd2);
									formdata = [];

									var contacthide = document.getElementById('contacthide');
    								let country =document.createElement('input');
									country.id="country";
									country.name="country";
									country.type="text"; 
									country.value="+971" ;
									country.style="width:15.5%;font-size:11px;height:35px;";
									country.readOnly="readonly";
									contacthide.appendChild(country);

									let code =document.createElement('input');
									code.id="code";
									code.name="code";
									code.type="text"; 
									code.value="" ;
									code.style="width:15.5%;font-size:11px;height:35px;";
									code.maxlength='2';
									contacthide.appendChild(code);
									let con =document.createElement('input');
									con.id="code";
									con.name="code";
									con.type="text"; 
									con.value="" ;
									con.style="width:68.5%;font-size:11px;height:35px;";
									con.maxlength='7';
									contacthide.appendChild(con);

    								


									//$('#audit_count').html(0);
									$("#message").html("Data synced to server successfully");
									$("#message").css({"font-size":"13px","font-family":"verdana","color":"green","font-weight":"bold"});
									$("#message").fadeIn(600);	
									$("#message").fadeOut(5000);
									$('#store_loc').focus();
									$('#savebtn').show();
									$('#loading').hide();
									$(".multiselecterror1 .multiselecterror2 .multiselecterror3 .multiselecterror4").css("border-color", "gray");
									$(document).ajaxStop(function(){
    									window.location.reload();
									});
									//Increase successful entries count
									/*if(localStorage.getItem("StreLocalAudit") === null) {
										if(Arrstauditcnt[$('#store_code').val()]!=undefined)
											Arrstauditcnt[$('#store_code').val()] = parseInt(Arrstauditcnt[$('#store_code').val()])+1;
										else
											Arrstauditcnt[$('#store_code').val()]=1;
									} else {
										LocStreAudit = JSON.parse(localStorage.getItem('StreLocalAudit'));
										if(LocStreAudit[$('#store_code').val()]==undefined) {
											if(Arrstauditcnt[$('#store_code').val()]!=undefined)
												Arrstauditcnt[$('#store_code').val()] = parseInt(Arrstauditcnt[$('#store_code').val()])+1;
											else
												Arrstauditcnt[$('#store_code').val()]=1;
										}
										else {
											if(Arrstauditcnt[$('#store_code').val()]!=undefined)
												Arrstauditcnt[$('#store_code').val()] = parseInt(Arrstauditcnt[$('#store_code').val()])+parseInt(LocStreAudit[$('#store_code').val()])+1;
											else
												Arrstauditcnt[$('#store_code').val()]=parseInt(LocStreAudit[$('#store_code').val()])+1;
										}
									}
		//							if(Arrstauditcnt[$('#store_code').val()]!=undefined)
		//								Arrstauditcnt[$('#store_code').val()] = parseInt(Arrstauditcnt[$('#store_code').val()])+1;
		//							else {
		//								Arrstauditcnt[$('#store_code').val()]=1;
		//								console.log(Arrstauditcnt);
		//							}
									//$('#audit_count').html(Arrstauditcnt[$('#store_code').val()]);
									localStorage.clear();
									alert("Data uploaded successfully");
									console.log("clear data");

									//console.log("LocStreAudit "+localStorage.getItem("StreLocalAudit"));*/
								}
								else {
									alert("unfortunately some error occured while saving data");
									storeLocalAudit();
	//								$('#savebtn').show();
	//								$('#loading').hide();
	//								
	//								//Locally store audit count
	//								if(localStorage.getItem("StreLocalAudit") === null) {
	//									console.log("error "+1);
	//									//var store = $('#store_code').val();
	//									//console.log(store);
	//									arrlocstorecnt[$('#store_code').val()] = 1;
	//									//console.log(arrlocstorecnt);
	//									localStorage.setItem('StreLocalAudit', JSON.stringify(arrlocstorecnt));
	//									//console.log(localStorage.getItem('StreLocalAudit'));
	//									LocStreAudit = JSON.parse(localStorage.getItem('StreLocalAudit'));
	//									console.log(LocStreAudit[$('#store_code').val()]);
	//								}
	//								else {
	//									console.log("error "+2);
	//									//localStorage.setItem('StreLocalAudit', [{$('#store_code').val():1}]);
	//									LocStreAudit = JSON.parse(localStorage.getItem('StreLocalAudit'));
	//									//console.log(LocStreAudit);
	//									if(LocStreAudit[$('#store_code').val()]==undefined)
	//										arrlocstorecnt[$('#store_code').val()] = 1;
	//									else
	//										arrlocstorecnt[$('#store_code').val()] = parseInt(LocStreAudit[$('#store_code').val()])+1;
	//
	//									localStorage.setItem('StreLocalAudit', JSON.stringify(arrlocstorecnt));
	//									LocStreAudit = JSON.parse(localStorage.getItem('StreLocalAudit'));
	//								}
	//								console.log(LocStreAudit);
								}
							},
							error: function(xhr, textStatus, errorThrown) {
								
								console.log(xhr.status);
								if(xhr.status==0) {
									alert("Network connection lost. Data saved in local.");
								}
								storeLocalAudit();
	//							$('#savebtn').show();
	//							$('#loading').hide();
	//
	//							//Locally store audit count
	//							if(localStorage.getItem("StreLocalAudit") === null) {
	//								console.log("error "+1);
	//								//var store = $('#store_code').val();
	//								//console.log(store);
	//								arrlocstorecnt[$('#store_code').val()] = 1;
	//								//console.log(arrlocstorecnt);
	//								localStorage.setItem('StreLocalAudit', JSON.stringify(arrlocstorecnt));
	//								//console.log(localStorage.getItem('StreLocalAudit'));
	//								LocStreAudit = JSON.parse(localStorage.getItem('StreLocalAudit'));
	//								console.log(LocStreAudit[$('#store_code').val()]);
	//							}
	//							else {
	//								console.log("error "+2);
	//								//localStorage.setItem('StreLocalAudit', [{$('#store_code').val():1}]);
	//								LocStreAudit = JSON.parse(localStorage.getItem('StreLocalAudit'));
	//								//console.log(LocStreAudit);
	//								if(LocStreAudit[$('#store_code').val()]==undefined)
	//									arrlocstorecnt[$('#store_code').val()] = 1;
	//								else
	//									arrlocstorecnt[$('#store_code').val()] = parseInt(LocStreAudit[$('#store_code').val()])+1;
	//
	//								localStorage.setItem('StreLocalAudit', JSON.stringify(arrlocstorecnt));
	//								LocStreAudit = JSON.parse(localStorage.getItem('StreLocalAudit'));
	//							}
	//							console.log(LocStreAudit);
							}
						});
					} else {
						console.log("GPS empty");
						storeLocalAudit();
					}
				}
			} else {
			  console.log("Sorry! No Web Storage support..");
			  alert("Sorry! No Web Storage support..");
			}
		}
	}

	//Store data locally
	function storeLocalAudit() {
		$('#savebtn').show();
		$('#loading').hide();
		if (typeof(Storage) !== "undefined") {
			//Locally store audit count
			if(localStorage.getItem("StreLocalAudit") === null) {
				console.log("error "+1);
				//var store = $('#store_code').val();
				//console.log(store);
				arrlocstorecnt[$('#store_code').val()] = 1;
				//console.log(arrlocstorecnt);
				localStorage.setItem('StreLocalAudit', JSON.stringify(arrlocstorecnt));
				//console.log(localStorage.getItem('StreLocalAudit'));
				LocStreAudit = JSON.parse(localStorage.getItem('StreLocalAudit'));
				console.log(LocStreAudit[$('#store_code').val()]);
			}
			else {
				console.log("error "+2);
				//localStorage.setItem('StreLocalAudit', [{$('#store_code').val():1}]);
				LocStreAudit = JSON.parse(localStorage.getItem('StreLocalAudit'));
				//console.log(LocStreAudit);
				if(LocStreAudit[$('#store_code').val()]==undefined)
					arrlocstorecnt[$('#store_code').val()] = 1;
				else
					arrlocstorecnt[$('#store_code').val()] = parseInt(LocStreAudit[$('#store_code').val()])+1;

				localStorage.setItem('StreLocalAudit', JSON.stringify(arrlocstorecnt));
				LocStreAudit = JSON.parse(localStorage.getItem('StreLocalAudit'));
			}
			console.log(LocStreAudit);
		} else {
		  console.log("Sorry! No Web Storage support..");
		  alert("Sorry! No Web Storage support..");
		}
	}

	function getLocation() {
//	 console.log("getLocation");
	  if (navigator.geolocation) {
		navigator.geolocation.watchPosition(showPosition, showError);
	  } else { 
		//x.innerHTML = "Geolocation is not supported by this browser.";
		alert("Geolocation is not supported by this browser.");
	  }
	}
		
	function showPosition(position) {
		//console.log(position);
		$('#frm_electro').find('input, select, textarea').not(".ignore").prop("disabled", false);
		currentlatitude = position.coords.latitude;
		currentlongitude = position.coords.longitude;
		$.trim($('#latitude').val(currentlatitude));
		$.trim($('#longitude').val(currentlongitude));
		if(currentlatitude!='' && currentlongitude!='') {
			$(".lat").html(currentlatitude);
			$(".long").html(currentlongitude);
			$(".gps_coordinate").fadeIn(600);
		} else {
			$(".gps_coordinate").fadeOut(600);
		}
		//"Latitude: " + position.coords.latitude + "<br>Longitude: " + position.coords.longitude
	//    console.log("Latitude: " + position.coords.latitude);
	//	console.log("Longitude: " + position.coords.longitude);
	}

	function showError(error) {
		console.log(error);
		console.log(error.code);
		//console.log("Sorry! No Web Storage support..");
		switch (error.code) {
			case error.PERMISSION_DENIED:
				errtxt = "User denied the request for Geolocation."
				break;
			case error.POSITION_UNAVAILABLE:
				errtxt = "Location information is unavailable."
				break;
			case error.TIMEOUT:
				errtxt = "The request to get user location timed out."
				break;
			default:
				errtxt = "An unknown error occurred on location track."
				break;
		}
		alert(error.message);
		$(".lat").html("");
		$(".long").html("");
		$.trim($('#latitude').val(""));
		$.trim($('#longitude').val(""));
		$(".gps_coordinate").fadeOut(600);
		//$('#frm_promotion').find('input, select, textarea').not(".ignore").prop("disabled", true);
		console.log(errtxt);
		return false;
	}

	//call geolocation function when page loads
	getLocation();
	//setInterval(function() {
	//	//Call location tracking function every 1 min
	//	console.log("call from setInterval");alert("call from setInterval");
	//    getLocation();
	//}, 60000); 

}); 
</script>