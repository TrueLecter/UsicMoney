<?php
	header("Content-type: application/json");
	include "config/database.php";
	if (intval ($_REQUEST[moneyF] ) <= 0){
    	$response =  array('errorV' => "Невірна сумма!", 'msg' => "");
    } else if (empty($_REQUEST[nameF])){
    	$response  = array('errorV' => "Невірне ім'я!", 'msg' => "");
    } else if (empty($_REQUEST[typeF])){
    	$response  = array('errorV' => "Невірний тип каси!", 'msg' => "");
    } else {
		$timeStampV = time();
		$num = $_REQUEST['moneyF'];
		function minus($num) {
			return -1 * abs($num);
		}
		$q = "INSERT INTO ".$table." (name, money, type, timeStamp, dateTime, comment) VALUES ('" . $_REQUEST[nameF] . "', " . minus($num) . ", '" . $_REQUEST[typeF] . "', '" . $timeStampV . "', '" . date('d-m-Y H:i:s') . "', 'Інкасація коштів') ";
		$res = mysqli_query($link, $q);
		if($res) {
        	$response =  array('msg' => "Гроші знято!");
		} else {
        	$response =  array('errorV' => "Помилка виконання запиту!", 'msg' => "");
		}
	}
	echo json_encode($response);
?>