<?php
class random{
	function rand_string($anz_stell){
		$pool = array_merge(range(0,12), range('a','z'), range('A', 'Z'));
		$rstring = "";
		$anzi = count($pool) -1; //-1 because $pool[0].
		for($i = 1; $i != $anz_stell; $i++){
			$rstring .= $pool[mt_rand(0, $anzi)];
		}
		return $rstring;
	}
}
?>