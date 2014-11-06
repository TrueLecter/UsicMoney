<?
	$host = '';
	$user = '';
	$password = '';
	$db = '';
        $table = 'usicMoney';
	$link = mysqli_connect($host, $user, $password, $db);
        $q = 'create table if not exists '.$table.' (`name` text, `money` double, `type` text, `dateTime` text, `comment` text, `timeStamp` int, `id` int NOT NULL AUTO_INCREMENT, PRIMARY KEY(id))';
        mysqli_query($link, $q);
?>		
=======
	$host = 'mysql.hostinger.ru';
	$user = 'u885629350_roooo';
	$password = '123456';
	$db = 'u885629350_usic';
	$link = mysqli_connect($host, $user, $password, $db);
?>
