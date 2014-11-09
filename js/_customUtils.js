function selection(typeV) {
	document.forms['formHidden'].typeF.value = typeV;
	document.forms['formHidden'].submit();
}

function selectRange(range, typeV) {
	document.forms['formHidden'].range.value = range;
	document.forms['formHidden'].typeF.value = typeV;
	document.forms['formHidden'].submit();
}

function changePage(page) {
	document.forms['formHidden'].limit.value = page;
	document.forms['formHidden'].submit();
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