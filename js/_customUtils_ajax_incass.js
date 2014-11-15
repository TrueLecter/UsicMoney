var dataMsg = "";
var resultM = "";

function getMoney() {
	var msg = $("#form").serialize();
	dataMsg = msg;
	disableForm();
	$.ajax({
		type: "POST",
		data: msg,
		url: "includes/getMoney_ajax.php",
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
			resultM = thrownError;
			enableForm();
		}
	});
	return false;
}

function disableForm(){
	$("#submitB").hide(300);
}

function enableForm(){
	$("#submitB").show(300);
}