var code_ajax = $("#code_ajax").val();
var pageno = 1;
var rowno = 0;


function getAttribute(pagenov, rownov) {
	$.busyLoadFull("show");
	var perpage = $('#perpage').val();
	// successmsg( "sdfs" );
	var count = 1;
	$.ajax({
		method: 'POST',
		url: 'get_currency_data.php',
		data: {
			code: code_ajax,
			page: pagenov,
			rowno: rownov,
			perpage: perpage
		},
		success: function (response) {
			$.busyLoadFull("hide");
			var parsedJSON = $.parseJSON(response);
			$("#cat_list").empty();

			$("#totalrowvalue").html(parsedJSON["totalrowvalue"]);
			$(".page_div").html(parsedJSON["page_html"]);

			var data = parsedJSON.data;
			$(data).each(function () {

				var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.name + '</td><td > ' + this.symbol + '</td>';
				html += '<td> <button type="submit" class= "btn btn-danger waves-effect waves-light waves-effect waves-light btn-sm pull-left" name="delete" onclick="deletebrand(' + this.id + ');">DELETE</button>';

				html += '<button  style=" margin-left: 10px;" type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'editbrand("' + this.id + '","' + this.name + '","' + this.symbol + '")\';>EDIT</button></td></tr>';
				$("#cat_list").append(html);

				count = count + 1;
			});



		}
	});
}


$(document).ready(function () {
	//getAttribute(pageno, rowno);


	$("#add_Currency").click(function (event) {
		event.preventDefault();

		var namevalue = $('#name').val();
		var symbol = $('#symbol').val();

		if (!namevalue) {
			successmsg("Please enter Currency");
		} else if (!symbol) {
			successmsg("Please enter Currency Symbol");
		} else {
			$.busyLoadFull("show");
			var form_data = new FormData();
			form_data.append('namevalue', namevalue);
			form_data.append('symbol', symbol);

			form_data.append('type', 'add_currency');
			form_data.append('code', code_ajax);

			$.ajax({
				method: 'POST',
				url: 'add_currency_process.php',
				data: form_data,
				contentType: false,
				processData: false,
				success: function (response) {
					$.busyLoadFull("hide");

					var data = $.parseJSON(response);
					if (data["status"] == "1") {
						successmsg(data["msg"]);
					} else {
						successmsg(response);
					}
					$("#myModal").modal('hide');

					getAttribute(1, 0)
					$('#name').val('');
					$('#symbol').val('');
				}
			});
		}

	});

	$("#update_currency").click(function (event) {
		event.preventDefault();

		var namevalue = $('#update_name').val();
		var attribute_id = $('#attribute_id').val();
		var update_symbol = $('#update_symbol').val();

		if (!namevalue) {
			successmsg("Please enter currency");
		} else if (!update_symbol) {
			successmsg("Please enter currency symbol");
		} else {
			$.busyLoadFull("show");
			var form_data = new FormData();
			form_data.append('namevalue', namevalue);
			form_data.append('attribute_id', attribute_id);
			form_data.append('update_symbol', update_symbol);
			form_data.append('type', 'update_currency');
			form_data.append('code', code_ajax);

			$.ajax({
				method: 'POST',
				url: 'add_currency_process.php',
				data: form_data,
				contentType: false,
				processData: false,
				success: function (response) {
					$.busyLoadFull("hide");
					var data = $.parseJSON(response);
					if (data["status"] == "1") {
						successmsg(data["msg"]);
					} else {
						successmsg(response);
					}
					$("#myModalupdate").modal('hide');
					$('#update_name').val('');
					$('#attribute_id').val('');
					$('#update_symbol').val('');
					getAttribute(1, 0);

				}
			});
		}

	});



});

function editbrand(id, name, symbol) {
	$("#myModalupdate").modal('show');
	$("#attribute_id").val(id);
	$("#update_name").val(name);
	$("#update_symbol").val(symbol);
}

function deletebrand(id) {
	xdialog.confirm('Are you sure want to delete?', function () {
		$.busyLoadFull("show");
		$.ajax({
			method: 'POST',
			url: 'add_currency_process.php',
			data: { deletearray: id, code: code_ajax, type: 'delete_currency' },
			success: function (response) {
				$.busyLoadFull("hide");
				var data = $.parseJSON(response);
				if (data["status"] == "1") {
					successmsg(data["msg"]);
				} else {
					successmsg(response);
				}
				getAttribute(1, 0);
			}
		});
	}, {
		style: 'width:420px;font-size:0.8rem;',
		buttons: {
			ok: 'yes ',
			cancel: 'no '
		},
		oncancel: function () {
			// console.warn('Cancelled!');
		}
	});
}




