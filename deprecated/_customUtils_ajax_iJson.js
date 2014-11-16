var typeOfSelection = "";
var range = 31536000;
var limit = 0;
var debug = "";
var typeB = "";
var sumB = 0;

var dataMsg = "";
var resultM = "";

function sendMoney() {
	var msg = $("#form").serialize();
	disableForm();
	$.ajax({
		type: "POST",
		url: "add_ajax.php",
		data: msg,
		dataType: 'json',
		success: function(data) {
			if (data.msg == "") {
				$("#result").html(data.errorV);
				$("#result").animate({
					color: 'red'
				}, 500);
			} else {
				$("#result").html(data.msg);
				$("#result").animate({
					color: 'green'
				}, 500);	
			}
			enableForm();
		},
		error: function(xhr, ajaxOptions, thrownError) {
			$("#result").html("Помилка виконання запиту!");
			$("#result").animate({
				color: 'red'
			}, 500);
			resultM = thrownError + "\nAO  = " + ajaxOptions + "\nxhr.responseText=" + xhr.responseText;
			enableForm();
		}
	});
	return false;
}

function getMoney() {
	var msg = $("#form").serialize();
	dataMsg = msg;
	disableForm();
	$.ajax({
		type: "POST",
		url: "getMoney_ajax.php",
		data: msg,
		dataType: 'json',
		success: function(data) {
			if (data.msg == "") {
				$("#result").html(data.errorV);
				$("#result").animate({
					color: 'red'
				}, 500);
			} else {
				$("#result").html(data.msg);
				$("#result").animate({
					color: 'green'
				}, 500);
			}
			enableForm();
			resultM = data;
		},
		error: function(xhr, ajaxOptions, thrownError) {
			$("#result").html("Помилка виконання запиту!");
			$("#result").animate({
				color: 'red'
			}, 500);
			resultM = thrownError + "\nAO  = " + ajaxOptions + "\nxhr=" + xhr;
			enableForm();
		}
	});
	return false;
}

function disableForm() {
	$("#submitB").hide(300);
}

function enableForm() {
	$("#submitB").show(300);
}

function selection(typeV) {
	typeB = typeOfSelection;
	typeOfSelection = typeV;
	limit = 0;
	sendRequest();
}

function selectRange(rangeV) {
	range = rangeV;
	sendRequest();
}

function changePage(pageV) {
	limit = pageV;
	sendRequest();
}

function sendRequest() {
	//$('#rangeMenu').fadeOut(200);
	//$('#totalValue').fadeOut(200);
	//$('#typeMenu').fadeOut(200);
	$("#loader").fadeIn(200);
	$('#tableV').fadeOut(300);
	$.ajax({
		type: "POST",
		url: "includes/selecter_ajax_iJson.php",
		data: "typeF=" + typeOfSelection + "&range=" + range + "&limit=" + limit,
		dataType: 'json',
		success: function(data) {
			processResponce(data);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			retry();
		}
	});
}

function retry() {
	$.ajax({
		type: "POST",
		url: "includes/selecter_ajax_iJson.php",
		data: "typeF=" + typeOfSelection + "&range=" + range + "&limit=" + limit,
		dataType: 'json',
		success: function(data) {
			processResponce(data);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(xhr.responseText);
			alert(thrownError);
		}
	});
}

function processResponce(resultJSON) {
	result = resultJSON;
	debug = result;
	if (sumB != result.sum) $('#totalValue').fadeOut(200);
	if (typeB != typeOfSelection) $('#typeMenu').fadeOut(200);
	$("#loader").fadeOut(200);
	$('#rangeMenu').html(processRangeMenu(result.rangeMenu));
	$('#totalValue').html("Баланс: " + result.sum + " грн.");
	if (sumB != result.sum) $('#totalValue').fadeIn(200);
	sumB = result.sum;
	$('#typeMenu').html(processMenu(result.menu));
	if (typeB != typeOfSelection) $('#typeMenu').fadeIn(200);
	$('#tableV').html(processsTable(result.table) + processsPaging(result.pagination));
	$('#rangeMenu').fadeIn(200);
	$('#tableV').fadeIn(200);
}

function processsPaging(menu) {
	var inHtml = "<div class=\"pagination pagination-info\">\n<ul><li><a href=\"#\" onclick=\"changePage(0)\"><i class=\"fui-arrow-left\"></i><i class=\"fui-arrow-left\"></i></a></li>\n";
	for (var key in menu) {
		if (key == "total") {
			continue;
		}
		if (menu[key]["active"] == "true") {
			inHtml = inHtml + "<li class=\"active\"><a  href=\"#\">" + menu[key]["caption"] + "</a></li>";
		} else {
			inHtml = inHtml + "<li><a  href=\"#\" onclick=\"changePage(" + menu[key]["page"] + ")\">" + menu[key]["caption"] + "</a></li>";
		}
	}
	return inHtml + "<li><a href=\"#\" onclick=\"changePage(" + menu["total"] + ")\"><i class=\"fui-arrow-right\"></i><i class=\"fui-arrow-right\"></i></a></li></ul></div>";
}

function processsTable(menu) {
	var inHtml = "<div class=\"wrapper\"><div class=\"table\" style=\"border-radius: 10px;\">\n<div class=\"row header\">\n<div class=\"cell\">ПІБ</div>\n<div class=\"cell\">Кошти</div>\n<div class=\"cell\">Дата та час</div></div>\n";
	for (var key in menu) {
		var tt1 = "";
		var tt2 = "";
		if (tooltipCheck(menu[key]["tt"])) {
			tt1 = " the-tooltip top right sky-blue";
			tt2 = "<div>" + menu[key]["tt"] + "</div>";
		}
		if (menu[key]["minus"] == " ") {
			inHtml = inHtml + "\n<div class=\"row" + tt1 + "\" style=\"background: none repeat scroll 0% 0% #FF905A;\"><div class=\"cell\">" + menu[key]["name"] + "</div><div class=\"cell\">" + menu[key]["money"] + "</div><div class=\"cell\">" + menu[key]["date"] + "</div>" + tt2 + "</div>";
		} else {
			inHtml = inHtml + "\n<div class=\"row" + tt1 + "\"><div class=\"cell\">" + menu[key]["name"] + "</div><div class=\"cell\">" + menu[key]["money"] + "</div><div class=\"cell\">" + menu[key]["date"] + "</div>" + tt2 + "</div>";
		}
	}
	return inHtml + "</div>";
}

function tooltipCheck(str) {
	if (!$.trim(str)) {
		return false;
	} else {
		return true;
	}
}

function processMenu(menu) {
	var inHtml = "<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">" + menu.selected + "<b class=\"caret\"></b></a><ul class=\"dropdown-menu\">";
	for (var key in menu) {
		if (key != 'selected') {
			inHtml = inHtml + "<li><a href=\"#\" onclick=\"selection('" + menu[key]['key'] + ")'\">" + menu[key]['value'] + "</a></li>";
		}
	}
	return inHtml + "</ul>";
}

function processRangeMenu(menu) {
	return "<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Проміжок<b class=\"caret\"></b></a><ul class=\"dropdown-menu\"><li><a href=\"#\" onclick=\"selectRange(" + menu[0]["range"] + ");\">" + menu[0]["caption"] + "</a></li>\n<li><a href=\"#\" onclick=\"selectRange(" + menu[1]["range"] + ");\">" + menu[1]["caption"] + "</a></li>\n<li><a href=\"#\" onclick=\"selectRange(" + menu[2]["range"] + ");\">" + menu[2]["caption"] + "</a></li>\n<li><a href=\"#\" onclick=\"selectRange(" + menu[3]["range"] + ");\">" + menu[3]["caption"] + "</a></li>\n</ul>";
}

function formatInt(wt) {
	if (wt < 10) {
		return "0" + wt;
	} else {
		return wt;
	}
}

function printDate(element) {
	var myDate = new Date();
	var day = formatInt(myDate.getDate());
	var month = formatInt(myDate.getMonth() + 1);
	var hour = formatInt(myDate.getHours());
	var min = formatInt(myDate.getMinutes());
	var sec = formatInt(myDate.getSeconds());
	var formated_date = day + "-" + month + "-" + myDate.getFullYear();
	var formated_time = hour + ":" + min + ":" + sec;
	element.value = formated_date + " " + formated_time;
}