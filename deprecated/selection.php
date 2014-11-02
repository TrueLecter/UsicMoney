<!DOCTYPE html>
<html>
	<head>
		<?
			?>
		<script type="text/javascript">
			function selection(typeV){
				document.forms['formHidden'].typeF.value=typeV; 
				document.forms['formHidden'].submit();
			   }
			function selectRange(range, typeV){
				document.forms['formHidden'].range.value = range;
				document.forms['formHidden'].typeF.value=typeV; 
				document.forms['formHidden'].submit();
			}
		</script>
		<title>UsicMoney</title>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<link href="bootstrap.min.css" rel="stylesheet">
		<link href="flat-ui.css" rel="stylesheet">
		<link href="custom.css" rel="stylesheet">
		<link href="css/the-tooltip.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="http://www.kryogenix.org/code/browser/nicetitle/nicetitle.css">
		<link rel="icon" type="image/x-icon" href="https://usic.at/favicon.ico">
		<style type="text/css">
			[tooltip]:before {
			/* needed - do not touch */
			content: attr(tooltip);
			position: absolute;
			opacity: 0;
			/* customizable */
			transition: all 0.15s ease;
			padding: 10px;
			color: #333;
			border-radius: 10px;
			box-shadow: 2px 2px 1px silver;    
			}
			[tooltip]:hover:before {
			/* needed - do not touch */
			opacity: 1;
			/* customizable */
			background: yellow;
			margin-top: -50px;
			margin-left: 20px;    
			}
		</style>
		<style type="text/css">
			.wrapper {
			margin: 0 auto;
			padding: 40px;
			max-width: 800px;
			}
			.table {
			margin: 0 0 40px 0;
			width: 100%;
			box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
			display: table;
			}
			@media screen and (max-width: 580px) {
			.table {
			display: block;
			}
			}
			.row {
			display: table-row;
			background: #f6f6f6;
			}
			.row:nth-of-type(odd) {
			background: #e9e9e9;
			}
			.row.header {
			font-weight: 900;
			color: #ffffff;
			background: #2980b9;
			border-top-left-radius: 10px !important;
			border-top-right-radius: 10px !important;
			}
			@media screen and (max-width: 580px) {
			.row {
			padding: 8px 0;
			display: block;
			}
			}
			.cell {
			padding: 6px 12px;
			display: table-cell;
			}
			@media screen and (max-width: 580px) {
			.cell {
			padding: 2px 12px;
			display: block;
			}
			}
		</style>
	</head>
	<body>
		<form action="selection.php" method="POST" id="formHidden">
			<input type="hidden" name="typeF" id="valueH">
			<input type="hidden" name="range" value="604800">
			<input type="hidden" name="limit" value="20">
			<input type="submit" id="submitH" style="display:none;">
		</form>
		<div  style="padding-right: 5px; padding-left:5px;">
		<!-- navbar -->
		<nav class="navbar navbar-inverse" role="navigation">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-5">
				<span class="sr-only">UsicMoney</span>
				</button>
				<a class="navbar-brand" href="#">UsicMoney</a>
			</div>
			<div class="collapse navbar-collapse" id="navbar-collapse-5">
				<ul class="nav navbar-nav">
					<li><a href="index.php">&#1042;&#1085;&#1077;&#1089;&#1077;&#1085;&#1085;&#1103; &#1082;&#1086;&#1096;&#1090;&#1110;&#1074;</a></li>
					<li><a href="#">&#1030;&#1085;&#1082;&#1072;&#1089;&#1072;&#1094;&#1110;&#1103;</a></li>
					<li class="active"><a href="#">&#1050;&#1072;&#1089;&#1080;</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Проміжок<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<!--<option value="604800" selected>Тиждень</option>
								<option value="2592000">Місяць</option>
								<option value="31536000">Рік</option>--><?
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
			<!-- /.navbar-collapse -->
		</nav>
		<center>
			<div>
				<?
					$link = mysqli_connect('mysql.hostinger.ru','u885629350_roooo','123456','u885629350_usic');
					$r = 0;
					if (isset($HTTP_POST_VARS[range])){
						$r = time() - $HTTP_POST_VARS[range];
					}
					$limit = "";
					if (isset($HTTP_POST_VARS[typeF])){
						$t = $HTTP_POST_VARS[typeF];
						$res = mysqli_query($link, "SELECT * FROM `usicMoney` WHERE type='$t' "."$limit");		
					} else {
						$res = mysqli_query($link, "SELECT * FROM `usicMoney` "."$limit");
					} echo '<div class="wrapper"><div class="table" style="border-radius: 10px;">
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
					/*echo "<table>";
					echo '<tr>
					<td>
						<div class="cell">ПІБ</div>
					</td>
					<td>
						<div class="cell">Кошти</div>
					</td>
					<td>
						<div class="cell">Тип каси</div>
					</td>
					<td>
						<div class="cell">Дата та час</div>
					</td>
					<td>
						<div class="cell">timeStamp</div>
					</td>
					<td>
						<div class="cell">id</div>
					</td>
					</tr>';*/
					$total = 0;
					$totalFull = 0;
						while ($row = mysqli_fetch_array($res)){
					  		$totalFull = $totalFull + $row["money"];
					  		if ($row["timeStamp"] > $r){
					  			$tooltip = $row["comment"];
					  			echo '<div class="row the-tooltip top right sky-blue"><div class="cell">', $row["name"], '</div><div class="cell">', $row["money"], /*"</div><td>, $row["type"], </td>",*/'</div><div class="cell">', $row["dateTime"], '</div><div class="cell" style="display:none;">', $row["timeStamp"], '</div><div class="cell" style="display:none;">', $row["id"], '</div><div>'.$tooltip.'</div></div>';
					  			$total = $total + $row["money"];
					  		}
					  	}
					  	/*echo '<tr> 
					  		<td  colspan = "7">'. $total .'</td>
					  		</tr>';
							echo "</table>";
						*/	
						echo "</div>";
					?>
			</div>
		</center>
		</br>	<!--
			<div style="display: block; padding:2.5%;"></div>
			<h3>Показати наявні записи</h3>
			<div style="display: block; padding:1.5%;"></div>
			<form name="selectForm" action="selection.php" method="post">
				<table>
					<tr>
						<td>
							<select name="typeF" data-toggle="select" class="form-control select select-primary mrs mbm" style="margin-bottom: 20px;" >
								<option value="cass" selected>Каса</option>
								<option value="tea">Чайок</option>
							</select>
						</td>
						<td>
							<select name="range" data-toggle="select" class="form-control select select-primary mrs mbm" style="margin-bottom: 20px;" >
								<option value="604800" selected>Тиждень</option>
								<option value="2592000">Місяць</option>
								<option value="31536000">Рік</option>
							</select>
						</td>
						<td><input type="submit" value="Показати список"  class="btn btn-info"  style="margin-bottom: 20px;"></td>
					</tr>
				</table>
			</form>-->
		<script type="text/javascript">
			document.getElementById("totalValue").innerHTML=<? echo "'Баланс: $totalFull грн.'"; ?>;
		</script>
		<script src="vendor/jquery.min.js"></script>
		<script src="flat-ui.min.js"></script>
		<script src="application.js"></script>
		<script src="js/min/the-tooltip.js"></script>
	</body>
</html>
