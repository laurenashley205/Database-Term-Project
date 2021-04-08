<?php

	function random_num(){
	
	//generate user id 
	$text = "";
	$length = 7;
	
	for($i=0;$i<$length;$i++){
		$text.= rand(0,9);
	}
	echo "success";
	return $text;
}
	
?>