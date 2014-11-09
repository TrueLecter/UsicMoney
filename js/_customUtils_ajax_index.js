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
			enableForm();
		}
	});
	return false;
}

function disableForm(){
	$("#submitB").hide(100);
	//$("#spinningSquaresG").show();
}

function enableForm(){
	$("#submitB").show(100);
	//$("#spinningSquaresG").hide();
}