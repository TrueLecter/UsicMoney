<?php
	//Loading configs
	include "config/database.php";
	include "config/config.php";
	header("Content-type: application/json");

	$valueV = $_REQUEST[typeF];
	if (empty($valueV)) {
		$tra = "Загальні кошти";
	} else {
		$tra = $translation["$valueV"];
	}							
	$menu = '<a href="#" class="dropdown-toggle" data-toggle="dropdown">'."$tra";
	$menu .= '<b class="caret"></b></a><ul class="dropdown-menu">';
	foreach ($translation as $key => $value) {
		if ($key != $valueV) {
			$menu.= '<li><a href="#" onclick="selection(' . "'" . $key . "'" . ')">' . $value . '</a></li>';
		}
	}
	$menu.='</ul>';

	$rangeMenu='<a href="#" class="dropdown-toggle" data-toggle="dropdown">Проміжок<b class="caret"></b></a>
	<ul class="dropdown-menu">
	<li><a href="#" onclick="selectRange(604800);">Тиждень</a></li>
	<li><a href="#" onclick="selectRange(2592000);">Місяць</a></li>
	<li><a href="#" onclick="selectRange(31536000);">Рік</a></li>
	<li><a href="#" onclick="selectRange('.time().');">Весь час</a></li>
	</ul>';

	$r = time();
	$limit = 0;
	if (isset($_REQUEST[range])) {
		$r = $_REQUEST[range];
	}
	$r = time() - $r;
	if (isset($_REQUEST[limit])) {
		$limit = $_REQUEST[limit];
	}
	if (!empty($_REQUEST[typeF]) && $_REQUEST[typeF] != "") {
		$t = $_REQUEST[typeF];
		$res = mysqli_query($link, "SELECT * FROM `".$table."` WHERE type='$t' AND timeStamp > " . $r . " ORDER BY timeStamp DESC LIMIT " . ($limit * $perPage) . "," . (($limit + 1) * $perPage));
		$q = mysqli_query($link, "SELECT COUNT(*) as num FROM `".$table."` WHERE type='$t' AND timeStamp > " . $r . " ORDER BY timeStamp DESC");
		$s = mysqli_query($link, "SELECT SUM(money) AS sum FROM `".$table."` WHERE type='$t'");
	} else {
		$re = "SELECT * FROM `".$table."` WHERE timeStamp > " . $r . " ORDER BY timeStamp DESC LIMIT " . ($limit * $perPage) . "," . (($limit + 1) * $perPage);
		$res = mysqli_query($link, "SELECT * FROM `".$table."` WHERE timeStamp > " . $r . " ORDER BY timeStamp DESC LIMIT " . ($limit * $perPage) . "," . (($limit + 1) * $perPage));
		$q = mysqli_query($link, "SELECT COUNT(*) as num FROM `".$table."` WHERE timeStamp > " . $r . " ORDER BY timeStamp DESC");
		$s = mysqli_query($link, "SELECT SUM(money) AS sum FROM `".$table."`");
	}
	$count = mysqli_fetch_array($q);
	$count = $count['num'];
	$sum = mysqli_fetch_array($s);
	$sum = $sum['sum'];

	$totalpage = ceil($count / $perPage);
	$currentpage = $limit+1;
	$firstpage = 1;
	$lastpage = $totalpage;
	$loopcounter = ((($currentpage + 2) <= $lastpage) ? ($currentpage + 2) : $lastpage);
	$startCounter = ((($currentpage - 2) >= 3) ? ($currentpage - 2) : 1);

	$table = '<div class="wrapper"><div class="table" style="border-radius: 10px;">
	<div class="row header">
	<div class="cell">ПІБ</div>
	<div class="cell">Кошти</div>
	<div class="cell">Дата та час</div>
	</div>';

	$i = 0;
	while ($i < $perPage && $row = mysqli_fetch_array($res)) {
		if ($row["timeStamp"] > $r) {
			$tooltip = $row["comment"];
			if ($row["money"] < 0) {
				$table.= '<div class="row the-tooltip top right sky-blue" style="background: none repeat scroll 0% 0% #FF905A;"><div class="cell">'.strip_tags($row["name"]).'</div><div class="cell">'.strip_tags($row["money"]).'</div><div class="cell">'.strip_tags($row["dateTime"]).'</div><div>'. strip_tags($tooltip).'</div></div>';
			} else {
				$table.= '<div class="row the-tooltip top right sky-blue"><div class="cell">'.strip_tags($row["name"]).'</div><div class="cell">'.strip_tags($row["money"]).'</div><div class="cell">'.strip_tags($row["dateTime"]).'</div><div>'. strip_tags($tooltip).'</div></div>';
			}
		}
		$i = $i + 1;
	}
	$table.= "</div>";

	$pagination = '<div class="pagination pagination-info">';
	if ($totalpage > 1) {
		$pagination.= '<ul><li><a href="#" onclick="changePage(0)"><i class="fui-arrow-left"></i><i class="fui-arrow-left"></i></a></li>';
		for ($i = $startCounter; $i <= $loopcounter; $i++) {
			if ($i == ($limit + 1)) {
				$pagination.= '<li class="active"><a  href="#">' . $i . '</a></li>';
			} else {
				$pagination.= '<li><a  href="#" onclick="changePage(' . ($i - 1) . ')">' . $i . '</a></li>';
			}
		}
		$pagination.= '<li><a href="#" onclick="changePage(' . ($totalpage - 1) . ')"><i class="fui-arrow-right"></i><i class="fui-arrow-right"></i></a></li>';
		$pagination.= '</ul>';
	}
	$pagination.= '</div>';

	//Creation JSON
	$response =  array('menu' => $menu, 'table' => $table, 'pagination' => $pagination, 'sum' => $sum, 'rangeMenu' => $rangeMenu);
	$response = json_encode($response);

	echo $response;
?>