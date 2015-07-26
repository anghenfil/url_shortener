<?php
if(!defined("SC")){
	die("No script kiddies please!");
}
class forms{
	function short_form(){
	if(!isset($_GET['shortsubmit']))	{
		?>
			<form class="shortform" method="GET" autocomplete="off">
			<input class="shortform_url" text="Test" placeholder="Paste a URL to short it" name="urltoshort" >
			<input class="shortform_submit" type="submit" name="shortsubmit" value="Short!">
			</form>
	<?php
	}
	elseif(isset($_GET['shortsubmit'])){
		$siteurl = $_GET["urltoshort"];
    	if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$siteurl)) {
      		?>
      		<form class="shortform" method="GET" autocomplete="off">
			<input class="shortform_url" text="Test" placeholder="Please insert a valid URL." name="urltoshort">
			<input class="shortform_submit" type="submit" name="shortsubmit" value="Short!">
			</form>	
			<?php
    	}else{
			$long_url = $_GET['urltoshort'];
			$r_string = new random();
			$short_string = $r_string->rand_string(8);
			//if isn't in db: 
			$dbaction = new mysql_code();
			if($dbaction->is_in_db($short_string) == "ne"){
				$shortenurl = $dbaction->string_in_db($short_string, $long_url);
			}elseif($dbaction->is_in_db($short_string) == "e"){
				echo'An Error occurred. Please try again.';
			}
			?>
			<form class="shortform" method="GET" autocomplete="off">
			<input class="shortform_url" text="Test" value="<?php echo $shortenurl; ?>" name="urltoshort">
			<input class="shortform_submit" type="submit" name="shortsubmit" value="Short!">
			</form>		
			<?php
		}
	}
	}
}
?>
