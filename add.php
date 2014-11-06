<?
		include "config/database.php";
		$timeStampV = time();
                if (intval ($HTTP_POST_VARS[moneyF] )< 0){
                  header("Location: index.php?success=false");
                  die("");
                }
		$q = " INSERT INTO usicMoney (name, money, type, dateTime, comment, timeStamp) VALUES ('".mysqli_real_escape_string($link,$HTTP_POST_VARS[nameF])."', '".mysqli_real_escape_string($link,$HTTP_POST_VARS[moneyF])."', '".mysqli_real_escape_string($link,$HTTP_POST_VARS[typeF])."', '".date('d-m-Y H:i:s')."', '".mysqli_real_escape_string($link,$HTTP_POST_VARS[commentF])."', '$timeStampV') ";
		$res = mysqli_query($link,$q);
		if($res) { 
    		  header("Location: index.php?success=true");
		} else {
			header("Location: index.php?success=false");
		}
	?>