<?
	function isValid($money, $name, $type){
		if (intval ($money ) <= 0){
    		return "Невірна сумма!";
	    }
	    if (empty($name)){
	    	return "Невірне ім'я!";
	    }
	    if (empty($type)){
	    	return "Невірний тип каси!";
    	} 
    	return "";
	}

	function minus($num) {
			return -1 * abs($num);
	}
	
	function doOperation($link, $table, $name, $money, $type, $comment){
		$timeStampV = time();
		$q = "INSERT INTO ".$table." (name, money, type, dateTime, comment, timeStamp) VALUES ('".mysqli_real_escape_string($link,$name)."', '".mysqli_real_escape_string($link,$money)."', '".mysqli_real_escape_string($link,$type)."', '".date('d-m-Y H:i:s')."', '".mysqli_real_escape_string($link,$comment)."', '$timeStampV') ";
		return mysqli_query($link,$q);
	}
?>