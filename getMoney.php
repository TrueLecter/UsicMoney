<?php
include "config/database.php";
$timeStampV = time();
$num = (isset($HTTP_POST_VARS['moneyF'])) ? $HTTP_POST_VARS['moneyF'] : 0;
function minus($num) {
	return -1 * abs($num);
}
$q = "INSERT INTO usicMoney (name, money, type, timeStamp, dateTime, comment) VALUES ('" . $HTTP_POST_VARS[nameF] . "', " . minus($num) . ", '" . $HTTP_POST_VARS[typeF] . "', '" . $timeStampV . "', '" . date('Y-m-d H:i:s') . "', 'Інкасація коштів') ";
$res = mysqli_query($link, $q);
if ($res) {
	header("Location: incasation.php?success=true");
} else {
	header("Location: incasation.php?success=false");
}
?>