var code_ajax = $("#code_ajax").val();
var pageno = 1;
var rowno = 0;


function getTaxClass(pagenov, rownov) {
	$.busyLoadFull("show");
	var perpage = $('#perpage').val();
	var ticket_id = $('#ticket_id').val();
	// successmsg( "sdfs" );
	var count = 1;
	$.ajax({
		method: 'POST',
		url: 'get_ticket_replay_data.php',
		data: {
			code: code_ajax,
			page: pagenov,
			rowno: rownov,
			perpage: perpage,
			ticket_id: ticket_id
		},
		success: function (response) {
			$.busyLoadFull("hide");
			var parsedJSON = $.parseJSON(response);
			$("#cat_list").empty();

			$("#totalrowvalue").html(parsedJSON["totalrowvalue"]);
			$(".page_div").html(parsedJSON["page_html"]);

			var data = parsedJSON.data;
			$(data).each(function () {
				var btnactive = "";
				if (this.statuss == "0") {
					btnactive = '<span class = "Pending">' + "Pending" + '</span>';
				} else if (this.statuss == "1") {
					btnactive = '<spanclass = "Active">' + "Active " + '</span>';
				} else if (this.statuss == "3") {
					btnactive = '<span class = "Deactive">' + "Deactive" + '</span>';
				}

				var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.subject + '</td><td > ' + this.content + '</td><td > ' + this.type + '</td><td > ' + this.create_at + '</td><</tr>';
				$("#cat_list").append(html);

				count = count + 1;
			});



		}
	});
}

function attribute_set_product(pagenov) {
	$.busyLoadFull("show");
	var perpage = $('#perpage').val();
	var ticket_id = $('#ticket_id').val();
	// successmsg( "sdfs" );
	var count = 1;
	$.ajax({
		method: 'POST',
		url: 'get_ticket_replay_data.php',
		data: {
			code: code_ajax,
			page: pagenov,
			rowno: 0,
			perpage: perpage,
			ticket_id: ticket_id
		},
		success: function (response) {
			$.busyLoadFull("hide");
			var parsedJSON = $.parseJSON(response);
			$("#cat_list").empty();

			$("#totalrowvalue").html(parsedJSON["totalrowvalue"]);
			$(".page_div").html(parsedJSON["page_html"]);

			var data = parsedJSON.data;
			$(data).each(function () {

				var btnactive = "";
				if (this.statuss == "0") {
					btnactive = '<span class = "Pending">' + "Pending" + '</span>';
				} else if (this.statuss == "1") {
					btnactive = '<spanclass = "Active">' + "Active " + '</span>';
				} else if (this.statuss == "3") {
					btnactive = '<span class = "Deactive">' + "Deactive" + '</span>';
				}

				var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.subject + '</td><td > ' + this.content + '</td><td > ' + this.type + '</td><td > ' + this.create_at + '</td><</tr>';
				$("#cat_list").append(html);

				count = count + 1;
			});
		}
	});
}


$(document).ready(function () {
	getTaxClass(pageno, rowno);


	$("#add_days_btn").click(function (event) {
		event.preventDefault();

		var title = $('#title').val();
		var desc = $('#desc').val();
		var ticket_id = $('#ticket_id').val();

		if (!title) {
			successmsg("Please enter Title");
		}
		if (!desc) {
			successmsg("Please enter desc"); 
		}

		if (title && desc) {
			$.busyLoadFull("show");
			var form_data = new FormData();
			form_data.append('title', title);
			form_data.append('desc', desc);
			form_data.append('ticket_id', ticket_id);
			form_data.append('code', code_ajax);

			$.ajax({
				method: 'POST',
				url: 'add_ticket_replay_process.php',
				data: form_data,
				contentType: false,
				processData: false,
				success: function (response) {
					$.busyLoadFull("hide");
					$("#myModal").modal('hide');
					$('#title').val('');
					$('#desc').val('');
					getTaxClass(1, 0)
					successmsg(response);

				}
			});
		}

	});

	


});



function perpage_filter() {
	$.busyLoadFull("show");
	var perpage = $('#perpage').val();
	var ticket_id = $('#ticket_id').val();
	// successmsg( "sdfs" );
	var count = 1;
	$.ajax({
		method: 'POST',
		url: 'get_ticket_replay_data.php',
		data: {
			code: code_ajax,
			page: 1,
			rowno: 0,
			perpage: perpage,
			ticket_id: ticket_id
		},
		success: function (response) {
			$.busyLoadFull("hide");
			var parsedJSON = $.parseJSON(response);
			$("#cat_list").empty();

			$("#totalrowvalue").html(parsedJSON["totalrowvalue"]);
			$(".page_div").html(parsedJSON["page_html"]);

			var data = parsedJSON.data;
			$(data).each(function () {

				var btnactive = "";
				if (this.statuss == "0") {
					btnactive = '<span class = "Pending">' + "Pending" + '</span>';
				} else if (this.statuss == "1") {
					btnactive = '<spanclass = "Active">' + "Active " + '</span>';
				} else if (this.statuss == "3") {
					btnactive = '<span class = "Deactive">' + "Deactive" + '</span>';
				}
				var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.subject + '</td><td > ' + this.content + '</td><td > ' + this.type + '</td><td > ' + this.create_at + '</td><</tr>';
				$("#cat_list").append(html);

				count = count + 1;
			});



		}
	});
}







