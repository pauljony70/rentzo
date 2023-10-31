var code_ajax = $("#code_ajax").val();
var pageno = 1;
var rowno = 0;


function getCommission(pagenov, rownov) {
	$.busyLoadFull("show");
	var perpage = $('#perpage').val();
	// successmsg( "sdfs" );
	var count = 1;
	$.ajax({
		method: 'POST',
		url: 'get_commission_data.php',
		data: {
			code: code_ajax,
			page: pagenov,
			rowno: rownov,
			type: 'get_data',
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
				var btnactive = "";
				if (this.statuss == "1") {
					btnactive = '<span class = "Active">' + "Active " + '</span>';
				} else if (this.statuss == "0") {
					btnactive = '<span class = "Deactive">' + "Deactive" + '</span>';
				}
				var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.price_from + '</td><td > ' + this.price_to + '</td><td > ' + this.commission + '</td><td > ' + btnactive + '</td>';
				html += '<td> <button type="submit" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" name="delete" onclick="delete_commission(' + this.id + ');">DELETE</button>';

				html += '<button  style=" margin-left: 10px;" type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'edit_commission("' + this.id + '","' + this.price_from + '","' + this.price_to + '","' + this.commission + '","' + this.statuss + '")\';>EDIT</button></td></tr>';
				$("#cat_list").append(html);

				count = count + 1;
			});



		}
	});
}


function brand_product(pagenov) {
	getCommission(pagenov, 0);
}


$(document).ready(function () {
	getCommission(pageno, rowno);


	$("#add_commission_btn").click(function (event) {
		event.preventDefault();

		var price_range_from = $('#price_range_from').val();
		var price_range_to = $('#price_range_to').val();
		var commission_percentage = $('#commission_percentage').val();

		if (!price_range_from) {
			successmsg("Please enter Price Range From");
		} else if (!price_range_to) {
			successmsg("Please enter Price Range TO");
		} else if (!commission_percentage) {
			successmsg("Please enter Commission");
		} else if (price_range_from && price_range_to && commission_percentage) {
			$.busyLoadFull("show");
			var form_data = new FormData();
			form_data.append('price_range_from', price_range_from);
			form_data.append('price_range_to', price_range_to);
			form_data.append('commission_percentage', commission_percentage);
			form_data.append('type', "add_commission");
			form_data.append('code', code_ajax);

			$.ajax({
				method: 'POST',
				url: 'add_commission_process.php',
				data: form_data,
				contentType: false,
				processData: false,
				success: function (response) {
					$.busyLoadFull("hide");
					$("#myModal").modal('hide');
					getCommission(1, 0)
					successmsg(response);
					$('#add_commission_form')[0].reset();

				}
			});
		}

	});

	$("#update_commission_btn").click(function (event) {
		event.preventDefault();

		var price_range_from = $('#price_range_from1').val();
		var price_range_to = $('#price_range_to1').val();
		var commission_percentage = $('#commission_percentage1').val();
		var commission_id = $('#commission_id').val();
		var statuss = $('#statuss').val();

		if (!price_range_from) {
			successmsg("Please enter Price Range From");
		} else if (!price_range_to) {
			successmsg("Please enter Price Range TO");
		} else if (!commission_percentage) {
			successmsg("Please enter Commission");
		} else if (commission_id && price_range_from && price_range_to && commission_percentage) {
			$.busyLoadFull("show");
			var form_data = new FormData();
			form_data.append('commission_id', commission_id);
			form_data.append('price_range_from', price_range_from);
			form_data.append('price_range_to', price_range_to);
			form_data.append('commission_percentage', commission_percentage);
			form_data.append('type', "update_commission");
			form_data.append('statuss', statuss);
			form_data.append('code', code_ajax);

			$.ajax({
				method: 'POST',
				url: 'add_commission_process.php',
				data: form_data,
				contentType: false,
				processData: false,
				success: function (response) {
					$.busyLoadFull("hide");
					$("#myModalupdate").modal('hide');
					getCommission(1, 0)
					successmsg(response);
					$('#update_commission_form')[0].reset();

				}
			});
		}

	});



});



function perpage_filter() {
	getCommission(pageno, 0);
}

function edit_commission(id, price_from, price_to, commission, statuss) {
	$("#myModalupdate").modal('show');
	$("#commission_id").val(id);
	$("#price_range_from1").val(price_from);
	$("#price_range_to1").val(price_to);
	$("#commission_percentage1").val(commission);
	$("#statuss").val(statuss);
}

function delete_commission(id) {

	xdialog.confirm('Are you sure want to delete?', function () {
		$.busyLoadFull("show");
		$.ajax({
			method: 'POST',
			url: 'add_commission_process.php',
			data: { deletearray: id, code: code_ajax, type: "delete_commission" },
			success: function (response) {
				$.busyLoadFull("hide");
				if (response == 'Failed to Delete.') {
					successmsg("Failed to Delete.");
				} else if (response == 'Deleted') {
					$("#tr" + id).remove();
					successmsg("Commission Deleted Successfully.");
				}
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




