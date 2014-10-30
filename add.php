<html>
<head>
	<title>Status</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>
<body>
	<a href="index.php">return</a>
	<p></p>
	<?
		$link = mysql_connect('mysql.hostinger.ru','u885629350_roooo','123456');
		mysql_select_db('u885629350_usic');
		mysql_set_charset('utf8');
		$timeStampV = time(); 
		/*echo "$HTTP_POST_VARS[nameF]</br>";
		echo "$HTTP_POST_VARS[moneyF]</br>";
		echo "$HTTP_POST_VARS[typeF]</br>";
		echo "$HTTP_POST_VARS[dateTimeF]</br>";
		echo "$HTTP_POST_VARS[commentF]</br>";
		*/
		$q = " INSERT INTO usicMoney (name, money, type, dateTime, comment, timeStamp) VALUES ('$HTTP_POST_VARS[nameF]', '$HTTP_POST_VARS[moneyF]', '$HTTP_POST_VARS[typeF]', '$HTTP_POST_VARS[dateTimeF]', '$HTTP_POST_VARS[commentF]', '$timeStampV') ";
		$res = mysql_query($q ,$link);
		//echo "$q"."</br>";
		if($res) { 
    		header("Location: index.php?success=true");
		} else {
			header("Location: index.php?success=false");
		}
	?>
</body>
</html>
