<?php
error_reporting(-1);
define("SC", "TRUE"); //Define Secure Check Variable
require("config.php"); //include config
require("incl/functions/autoloader.php"); //include function autoloader
if(isset($_GET['site'])){
	$reqsite = $_GET['site'];
	//here must be the mysql code, which gets the url from the requestet site
	//and here it is^^
	$geturl = new mysql_code();
	$geturl->get_url($reqsite);
}else{
	require_once("incl/header.php"); //include header
	$forms = new forms();
	$forms->short_form();	
	require_once("incl/footer.php"); //include footer
}
?>