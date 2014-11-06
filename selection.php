<!DOCTYPE html>
<html>
	<head>
		<title>UsicMoney</title>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/flat-ui.css" rel="stylesheet">
		<link href="css/table.css" rel="stylesheet">
		<link href="css/custom.css" rel="stylesheet">
		<link href="css/the-tooltip.css" rel="stylesheet" />
		<link rel="icon" type="image/x-icon" href="https://usic.at/favicon.ico">
		<script src="js/_customUtils.js"></script>
		</head>
	<body>
		<form action="selection.php" method="POST" id="formHidden">
			<input type="hidden" name="typeF" id="valueH" value=<? echo "'".$HTTP_POST_VARS["typeF"]."'"?>>
			<? 
				if (isset($HTTP_POST_VARS["range"])){
                                        if ($HTTP_POST_VARS["range"] == 0){
                                                $r = time();
                                        }
					$r = $HTTP_POST_VARS["range"];
				} else {
					$r = time();
				}
                   
				echo '<input type="hidden" name="range" value="'.$r.'">';
				?>
			<input type="hidden" name="limit" value="0">
			<input type="submit" id="submitH" style="display:none;">
		</form>
		<div  style="padding-right: 5px; padding-left:5px;">
		<!-- navbar -->
		<nav class="navbar navbar-inverse" role="navigation">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-5">
				<span class="sr-only">UsicMoney</span>
				</button>
				<a class="navbar-brand" href="index.php">UsicMoney</a>
			</div>
			<div class="collapse navbar-collapse" id="navbar-collapse-5">
				<ul class="nav navbar-nav">
					<li><a href="index.php">&#1042;&#1085;&#1077;&#1089;&#1077;&#1085;&#1085;&#1103; &#1082;&#1086;&#1096;&#1090;&#1110;&#1074;</a></li>
					<li><a href="incasation.php">&#1030;&#1085;&#1082;&#1072;&#1089;&#1072;&#1094;&#1110;&#1103;</a></li>
					<li class="active"><a href="#">&#1050;&#1072;&#1089;&#1080;</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Проміжок<b class="caret"></b></a>
						<ul class="dropdown-menu"><?
							echo '
							<li><a href="#" onclick="selectRange(604800,'."'".$HTTP_POST_VARS[typeF]."'".');">Тиждень</a></li>
							<li><a href="#" onclick="selectRange(2592000,'."'".$HTTP_POST_VARS[typeF]."'".');">Місяць</a></li>
							<li><a href="#" onclick="selectRange(31536000,'."'".$HTTP_POST_VARS[typeF]."'".');">Рік</a></li>
							';?>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<? $translation = array();
								$translation['tea']="Чайок";
								$translation['cass']="Принтер";
								$valueV = $HTTP_POST_VARS[typeF];
								if(empty($valueV)){
								$tra="Загальні кошти";
								} else {
								$tra = $translation["$valueV"];
								}echo "$tra";
								 echo '<b class="caret"></b></a>
								<ul class="dropdown-menu">';	
								foreach ($translation as $key => $value) {
									if ($key != $valueV){
									echo '<li><a href="#" onclick="selection('."'".$key."'".')">'.$value.'</a></li>';
								}}
								echo '</ul>' ?>
					</li>
					<li><a href='#' id="totalValue"></a></li>
				</ul>
			</div>
		</nav>
		<center>
			<div>
				<?
					include "config/database.php";
					$perPage = 12;
					$r = time();
					$limit = 0;
					if (isset($HTTP_POST_VARS[range])){
						$r = $HTTP_POST_VARS[range];
					}
                                        $r = time() - $r;
					if (isset($HTTP_POST_VARS[limit])){
						$limit = $HTTP_POST_VARS[limit];
					}
					if (!empty($HTTP_POST_VARS[typeF]) && $HTTP_POST_VARS[typeF]!=""){
						$t = $HTTP_POST_VARS[typeF];
						$res = mysqli_query($link, "SELECT * FROM `usicMoney` WHERE type='$t' AND timeStamp > ".$r." ORDER BY timeStamp DESC LIMIT ".($limit*$perPage).",".(($limit+1)*$perPage));		
						$q = mysqli_query($link, "SELECT COUNT(*) as num FROM `usicMoney` WHERE type='$t' AND timeStamp > ".$r." ORDER BY timeStamp DESC");		
						$s = mysqli_query($link,"SELECT SUM(money) AS sum FROM `usicMoney` WHERE type='$t'");
					} else {
                        $re = "SELECT * FROM `usicMoney` WHERE timeStamp > ".$r." ORDER BY timeStamp DESC LIMIT ".($limit*$perPage).",".(($limit+1)*$perPage);
						$res = mysqli_query($link, "SELECT * FROM `usicMoney` WHERE timeStamp > ".$r." ORDER BY timeStamp DESC LIMIT ".($limit*$perPage).",".(($limit+1)*$perPage));
						$q = mysqli_query($link, "SELECT COUNT(*) as num FROM `usicMoney` WHERE timeStamp > ".$r." ORDER BY timeStamp DESC");
						$s = mysqli_query($link,"SELECT SUM(money) AS sum FROM `usicMoney`");
					}
					$count = mysqli_fetch_array($q);
					$count = $count['num'];
					$sum = mysqli_fetch_array($s);
					$sum = $sum['sum'];
					echo '<div class="wrapper"><div class="table" style="border-radius: 10px;">
					<div class="row header">
					  <div class="cell">
					    ПІБ
					  </div>
					  <div class="cell">
					    Кошти
					  </div>
					  <div class="cell">
					    Дата та час
					  </div>
					  <div class="cell" style="display : none;">
					    timeStamp
					  </div>
					  <div class="cell" style="display : none;">
					  	id
					  </div>
					</div>';
                                        //echo '<div class="row"> '.$re.' </div>';
					$i = 0;
					while ($i < $perPage && $row = mysqli_fetch_array($res)){
						if ($row["timeStamp"] > $r){
					 		$tooltip = $row["comment"];
							if ($row["money"]<0){ 		
					 			echo '<div class="row the-tooltip top right sky-blue" style="background: none repeat scroll 0% 0% #FF905A;"><div class="cell">', strip_tags($row["name"]), '</div><div class="cell">', strip_tags($row["money"]), /*"</div><td>, $row["type"], </td>",*/'</div><div class="cell">', strip_tags($row["dateTime"]), '</div>'/*'<div class="cell" style="display:none;">', $row["timeStamp"], '</div><div class="cell" style="display:none;">', $row["id"], '</div>'*/,'<div>'.strip_tags($tooltip).'</div></div>'."\n";	
					 		} else {
					 			echo '<div class="row the-tooltip top right sky-blue"><div class="cell">',strip_tags( $row["name"]), '</div><div class="cell">', strip_tags($row["money"]), /*"</div><td>, $row["type"], </td>",*/'</div><div class="cell">', strip_tags($row["dateTime"]), '</div>'/*<div class="cell" style="display:none;">', $row["timeStamp"], '</div><div class="cell" style="display:none;">', $row["id"], '</div>'*/,'<div>'. strip_tags($tooltip).'</div></div>'."\n";
					 		}
					 	}
					 	$i = $i+1;
					}
					echo "</div>";
					$totalpage      = ceil($count / $perPage);
					$currentpage    = (isset($_POST['page']) ? $_POST['page'] : 1);
					$firstpage      = 1;
					$lastpage       = $totalpage;
					$loopcounter = ( ( ( $currentpage + 2 ) <= $lastpage ) ? ( $currentpage + 2 ) : $lastpage );
					$startCounter =  ( ( ( $currentpage - 2 ) >= 3 ) ? ( $currentpage - 2 ) : 1 );
					echo '<div class="pagination pagination-info">';
						if($totalpage > 1)
						           {
						               $pagination .= '<ul><li><a href="#" onclick="changePage(0)"><i class="fui-arrow-left"></i><i class="fui-arrow-left"></i></a></li>';
						               for($i = $startCounter; $i <= $loopcounter; $i++)
						               {
						               		if ($i == ($limit+1)){
						                    	$pagination .= '<li class="active"><a  href="#">'.$i.'</a></li>';
						                    } else {
						                    	$pagination .= '<li><a  href="#" onclick="changePage('.($i-1).')">'.$i.'</a></li>';
						                    }
						               }
						               $pagination .= '<li><a href="#" onclick="changePage('.($totalpage-1).')"><i class="fui-arrow-right"></i><i class="fui-arrow-right"></i></a></li>';
						               $pagination .= '</ul>';
						           }
						echo $pagination;
					echo '</div>';
					?>
			</div>
		</center>
		</br>
		<script type="text/javascript">
			document.getElementById("totalValue").innerHTML=<? echo "'Баланс:". round($sum, 2) ." грн.'"; ?>;
		</script>
		<script src="js/jquery.min.js"></script>
		<script src="js/flat-ui.min.js"></script>
		<script src="js/application.js"></script>
		<script src="js/the-tooltip.js"></script>
	</body>
</html>		