<?php
error_reporting(-1);
define("SC", "TRUE"); //Define Secure Check Variable
require("config.php"); //include config
require("incl/functions/autoloader.php"); //include function autoloader
require("incl/functions/mysql_code.php");
if(isset($_GET['site'])){
	$reqsite = $_GET['site'];
	//here must be the mysql code, which gets the url from the requestet site
	$geturl = new mysql_code();
	$geturl->get_url($reqsite);
}else{
	require_once("incl/header.php"); //include header
	$forms = new forms();
	$forms->short_form();	
	require_once("incl/footer.php"); //include footer
}
?>