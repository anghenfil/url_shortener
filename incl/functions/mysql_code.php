<?php
if(!defined("SC")){
	die("No script kiddies please!");
}
class mysql_code{
	function get_url($site){
		$server = 'mysql:dbname='.DB.';host='.HOST;
		$options  = array
            (
              PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            );		
		$db = new PDO($server, USER, PASSWORD, $options);
		$query = "SELECT ID, shorturl, siteurl FROM urls WHERE shorturl = :site";
		$stmt = $db->prepare($query);
		$stmt->bindParam(':site', $site, PDO::PARAM_STR);
		$stmt->execute();
		$count = $stmt->rowCount();
		if($count == 1){
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$rsite = $row['siteurl'];
				header("Location: $rsite");
			}
		}elseif($count > 1){
			require_once("incl/header.php");
			echo"Datenbank Fehler: Es wurden $count passende Datenbankeinträge gefunden.";
			require_once("incl/footer.php");
		}elseif($count == 0){
			require_once("incl/header.php");
			echo"Die angegebene URL scheint ungültig zu sein.";
			require_once("incl/footer.php");

		}else{
			require_once("incl/header.php");
			echo"Es ist ein unbekannter Datenbankfehler aufgetreten.";			
			require_once("incl/footer.php");
		}
	}
	function string_in_db($string_f_db, $tlong_url){
		$server = 'mysql:dbname='.DB.';host='.HOST;
		$options  = array
            (
              PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            );		
		$db = new PDO($server, USER, PASSWORD, $options);		
		$query = "INSERT INTO urls (shorturl, siteurl) VALUES (:shorturl, :siteurl)";
		$stmt = $db->prepare($query);
		$stmt->bindParam(':shorturl', $string_f_db);
		$stmt->bindParam(':siteurl', $tlong_url);
		$stmt->execute();
		//For Debugging: echo var_export($stmt->errorInfo());
		$short_url = SITE_URL.'/s/'.$string_f_db;
		echo'Shorten URL: <a href="'.$short_url.'">'.$short_url.'</a>';	
	}
	function is_in_db($url_to_check){
		$server = 'mysql:dbname='.DB.';host='.HOST;
		$options  = array
            (
              PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            );		
		$db = new PDO($server, USER, PASSWORD, $options);		
		$query = "SELECT ID, shorturl FROM urls WHERE shorturl = :url_to_check";
		$stmt = $db->prepare($query);
		$stmt->bindParam(':url_to_check', $url_to_check);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if(! $row){
			//ne = Not exists
			//e = exists
    		return("ne");
		}elseif($row){
			return("e");
		}
	}
}
?>