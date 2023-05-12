<?php
session_cache_limiter(FALSE);
session_start();
error_reporting(0);
define("LOCAL_SERVER_NAME","localhost");
if(substr_count($_SERVER['SERVER_NAME'],LOCAL_SERVER_NAME)>0)
{
	define("RUN_ON","local");
} else {
	define("RUN_ON","live");
}
//have to comment from here

define("LOCAL_SERVER_NAME","localhost");
define("NIC_SERVER_NAME","nichetrackers.com");
if(substr_count($_SERVER['SERVER_NAME'],LOCAL_SERVER_NAME)>0)
{
	error_reporting(0);
	define("DATABASE_SERVER","localhost");
	define("DBUSER","root");
	define("DBPASS","");
	define("MASTER_DATABASE","nlt_electrolux");
	define("NLTADMIN_DATABASE","imladmin_01");

	define("SYSTEM_ROOT_PATH",addslashes($_SERVER["DOCUMENT_ROOT"])."/promotion/");
	define("HTTP_ROOT_FOLDER","http://127.0.0.1:5500/lexus.php");
	define("RUN_ON","local");
}
?>