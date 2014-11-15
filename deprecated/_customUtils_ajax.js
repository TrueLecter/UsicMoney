var typeOfSelection = "";
var range = 31536000;
var limit = 0;
var debug = "";
var typeB = "";
var sumB = 0;

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
		url: "selecter_ajax.php",
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
		url: "selecter_ajax.php",
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

function processResponce(result) {
	debug = result;
	if (sumB != result.sum) $('#totalValue').fadeOut(200);
	if (typeB != typeOfSelection) $('#typeMenu').fadeOut(200);
	$("#loader").fadeOut(200);
	$('#rangeMenu').html(result.rangeMenu);
	$('#totalValue').html("Баланс: " + result.sum + " грн.");
	if (sumB != result.sum) $('#totalValue').fadeIn(200);
	sumB = result.sum;
	$('#typeMenu').html(result.menu);
	if (typeB != typeOfSelection) $('#typeMenu').fadeIn(200);
	$('#tableV').html(result.table + result.pagination);
	$('#rangeMenu').fadeIn(200);
	$('#tableV').fadeIn(200);
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