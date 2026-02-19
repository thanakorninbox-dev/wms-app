<?php

//<><><><><><><><> MAIN TRCLOUD <><><><><><><><>//
if(true){
	$isTest 		= "master";
	$server_url 	= "/wms/app/";
	$include_url	= $_SERVER['DOCUMENT_ROOT']."/wms/app/";

	$db_server		= "localhost";// usually localhost
	$db_user 		= "root";//usually root
	$db_pass		= "2618";
	$db_type		= "mysql"; //-- database type
	$db_database 	= "wms"; //-- database name main

	//~ $db_server2 = "";
	//~ $db_user2 	= "";
	//~ $db_pass2 	= "";
	//~ $db_type2 	= "";
	$db_database2 		= "wms2"; //-- database for client

	$db_server2 	= (!empty($db_server2))?$db_server2:$db_server;
	$db_user2 		= (!empty($db_user2))?$db_user2:$db_user;
	$db_pass2 		= (!empty($db_pass2))?$db_pass2:$db_pass;
	$db_type2 		= (!empty($db_type2))?$db_type2:$db_type;
	
	$time_zone 		= "Asia/Bangkok";

}

// global variables
$prop['limit'] = 3;

?>
