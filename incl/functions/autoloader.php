<?php
//The Function File.
if(!defined("SC")){
	die("No script kiddies please!");
}
function __autoload($class_name) {
    include $class_name . '.php';
}
?>