<?php

//Loading configs
include "../config/database.php";
include "../config/selectionConfig.php";
include "../config/config.php";
header("Content-type: application/json");

$valueV = $_REQUEST[typeF];
if (empty($valueV)) {
	$tra = "Загальні кошти";
} else {
	$tra = $translation["$valueV"];
}
$menu = array('selected' => $tra);
foreach ($translation as $key => $value) {
	if ($key != $valueV) {
		$menu[] = array('key' => $key, 'value' => $value);
	}
}

$rangeMenu = array(0 => array("range" => 604800, "caption" => "Тиждень"), 1 => array("range" => 2592000, "caption" => "Місяць"), 2 => array("range" => 31536000, "caption" => "Рік"), 3 => array("range" => time(), "caption" => "Весь час"),);
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
	$res = mysqli_query($link, "SELECT * FROM `" . $table . "` WHERE type='$t' AND timeStamp > " . $r . " ORDER BY timeStamp DESC LIMIT " . ($limit * $perPage) . "," . (($limit + 1) * $perPage));
	$q = mysqli_query($link, "SELECT COUNT(*) as num FROM `" . $table . "` WHERE type='$t' AND timeStamp > " . $r . " ORDER BY timeStamp DESC");
	$s = mysqli_query($link, "SELECT SUM(money) AS sum FROM `" . $table . "` WHERE type='$t'");
} else {
	$re = "SELECT * FROM `" . $table . "` WHERE timeStamp > " . $r . " ORDER BY timeStamp DESC LIMIT " . ($limit * $perPage) . "," . (($limit + 1) * $perPage);
	$res = mysqli_query($link, "SELECT * FROM `" . $table . "` WHERE timeStamp > " . $r . " ORDER BY timeStamp DESC LIMIT " . ($limit * $perPage) . "," . (($limit + 1) * $perPage));
	$q = mysqli_query($link, "SELECT COUNT(*) as num FROM `" . $table . "` WHERE timeStamp > " . $r . " ORDER BY timeStamp DESC");
	$s = mysqli_query($link, "SELECT SUM(money) AS sum FROM `" . $table . "`");
}

$count = mysqli_fetch_array($q);
$count = $count['num'];
$sum = mysqli_fetch_array($s);
$sum = $sum['sum'];

$totalpage = ceil($count / $perPage);
$currentpage = $limit + 1;
$firstpage = 1;
$lastpage = $totalpage;
$loopcounter = ((($currentpage + 2) <= $lastpage) ? ($currentpage + 2) : $lastpage);
$startCounter = ((($currentpage - 2) >= 3) ? ($currentpage - 2) : 1);

$table = array();

$i = 0;
while ($i < $perPage && $row = mysqli_fetch_array($res)) {
	if ($row["timeStamp"] > $r) {
		$tooltip = $row["comment"];
		if ($row["money"] < 0) {
			$table[] = array('name' => strip_tags($row["name"]), 'money' => strip_tags($row["money"]), 'date' => strip_tags($row["dateTime"]), 'tt' => strip_tags($tooltip), 'minus' => " ");
		} else {
			$table[] = array('name' => strip_tags($row["name"]), 'money' => strip_tags($row["money"]), 'date' => strip_tags($row["dateTime"]), 'tt' => strip_tags($tooltip));
		}
	}
	$i = $i + 1;
}
if ($i == 0) {
	$table = array('empty' => "true");
}

$pagination = array('total' => $totalpage - 1);
if ($totalpage > 1) {
	for ($i = $startCounter; $i <= $loopcounter; $i++) {
		if ($i == ($limit + 1)) {
			$pagination[] = array('caption' => $i, 'active' => "true");
		} else {
			$pagination[] = array('page' => ($i - 1), 'caption' => $i);
		}
	}
}

$response = array('menu' => $menu, 'table' => $table, 'pagination' => $pagination, 'sum' => $sum, 'rangeMenu' => $rangeMenu);
if ($debug) {
	include "pJson.php";
	echo _format_json(json_encode($response, 128));
} else {
	echo json_encode($response, 128);
}
?>