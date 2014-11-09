<?
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
		$q = "INSERT INTO ".$table." (name, money, type, dateTime, comment, timeStamp) VALUES ('".mysqli_real_escape_string($link,$_REQUEST[nameF])."', '".mysqli_real_escape_string($link,$_REQUEST[moneyF])."', '".mysqli_real_escape_string($link,$_REQUEST[typeF])."', '".date('d-m-Y H:i:s')."', '".mysqli_real_escape_string($link,$_REQUEST[commentF])."', '$timeStampV') ";
		$res = mysqli_query($link,$q);
		if($res) {
    		$response =  array('msg' => "Запит виконано успішно!");
		} else {
    		$response =  array('errorV' => "Помилка виконання запиту!", 'msg' => "");
		}
	}
	echo json_encode($response);
?>