<?php
class forms{
	function short_form(){
		?>
			<form method="POST">
			Shorten a URL:
			<input id="urltoshort" type="text" name="urltoshort">
			<input type="submit" name="shortsubmit" value="Short!">
			</form>
	<?php
	if(isset($_POST['shortsubmit'])){
		global $long_url;
		$long_url = $_POST['urltoshort'];
		$r_string = new random();
		$short_string = $r_string->rand_string(8);
		//if isn't in db: 
		$dbaction = new mysql_code();
		if($dbaction->is_in_db($short_string) == "ne"){
		$dbaction->string_in_db($short_string, $long_url);
		}elseif($dbaction->is_in_db($short_string) == "e"){
			while($dbaction->is_in_db($short_string) == "e"){
				$short_string = $r_string->rand_string(8);
			}
		}
	}
	}
}
?>