<?php
	header("Content-type: application/json");
	include "../config/database.php";
	include "operation.php";
	$errorV = isValid($_REQUEST[moneyF],$_REQUEST[nameF],$_REQUEST[typeF]);
	if ($errorV == ""){
		if(doOperation($link, $table, $_REQUEST['nameF'], minus($_REQUEST['moneyF']), $_REQUEST['typeF'], 'Інкасація коштів')) {
    		$response =  array('msg' => "Гроші знято!");
		} else {
        	$response =  array('errorV' => "Помилка виконання запиту!", 'msg' => "");
		}
	} else {
		$response = array('errorV' => $errorV, 'msg' => "");
	}
	echo json_encode($response);
?>