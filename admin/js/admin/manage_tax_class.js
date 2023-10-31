var code_ajax = $("#code_ajax").val();
var pageno = 1;
var rowno = 0;


function getTaxClass(pagenov, rownov) {
	$.busyLoadFull("show");
	var perpage = $('#perpage').val();
	// successmsg( "sdfs" );
	var count = 1;
	$.ajax({
		method: 'POST',
		url: 'get_tax_class_data.php',
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
				var btnactive = "";
				if (this.statuss == "0") {
					btnactive = '<span class = "Pending">' + "Pending" + '</span>';
				} else if (this.statuss == "1") {
					btnactive = '<spanclass = "Active">' + "Active " + '</span>';
				} else if (this.statuss == "3") {
					btnactive = '<span class = "Deactive">' + "Deactive" + '</span>';
				}

				var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.name + '</td><td > ' + this.percent + '</td><td > ' + btnactive + '</td>';
				html += '<td> <button type="submit" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" name="delete" onclick="deletetaxclass(' + this.id + ');">DELETE</button>';

				html += '<button  style=" margin-left: 10px;" type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'edittaxclass("' + this.id + '","' + this.name + '","' + this.percent + '","' + this.statuss + '")\';>EDIT</button></td></tr>';
				$("#cat_list").append(html);

				count = count + 1;
			});



		}
	});
}

function attribute_set_product(pagenov) {
	$.busyLoadFull("show");
	var perpage = $('#perpage').val();
	// successmsg( "sdfs" );
	var count = 1;
	$.ajax({
		method: 'POST',
		url: 'get_tax_class_data.php',
		data: {
			code: code_ajax,
			page: pagenov,
			rowno: 0,
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
				if (this.statuss == "0") {
					btnactive = '<span class = "Pending">' + "Pending" + '</span>';
				} else if (this.statuss == "1") {
					btnactive = '<spanclass = "Active">' + "Active " + '</span>';
				} else if (this.statuss == "3") {
					btnactive = '<span class = "Deactive">' + "Deactive" + '</span>';
				}

				var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.name + '</td><td > ' + this.percent + '</td><td > ' + btnactive + '</td>';
				html += '<td> <button type="submit" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" name="delete" onclick="deletetaxclass(' + this.id + ');">DELETE</button>';

				html += '<button  style=" margin-left: 10px;" type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'edittaxclass("' + this.id + '","' + this.name + '","' + this.percent + '","' + this.statuss + '")\';>EDIT</button></td></tr>';
				$("#cat_list").append(html);

				count = count + 1;
			});
		}
	});
}


$(document).ready(function () {
	getTaxClass(pageno, rowno);


	$("#add_tax_btn").click(function (event) {
		event.preventDefault();

		var tax_label = $('#tax_label').val();
		var namevalue = $('#name').val();

		if (!tax_label) {
			successmsg("Please enter Tax Label");
		}
		if (!namevalue) {
			successmsg("Please enter Tax Class");
		}

		if (namevalue && tax_label) {
			$.busyLoadFull("show");
			var form_data = new FormData();
			form_data.append('tax_label', tax_label);
			form_data.append('namevalue', namevalue);
			form_data.append('code', code_ajax);

			$.ajax({
				method: 'POST',
				url: 'add_tax_class_process.php',
				data: form_data,
				contentType: false,
				processData: false,
				success: function (response) {
					$.busyLoadFull("hide");
					$("#myModal").modal('hide');
					$('#name').val('');
					$('#tax_label').val('');
					getTaxClass(1, 0)
					successmsg(response);

				}
			});
		}

	});

	$("#update_tax_btn").click(function (event) {
		event.preventDefault();

		var update_label = $('#update_label').val();
		var namevalue = $('#update_name').val();
		var attribute_id = $('#attribute_id').val();
		var statuss = $('#statuss').val();

		if (!update_label) {
			successmsg("Please enter Tax Label");
		}

		if (!namevalue) {
			successmsg("Please enter Tax Class");
		}
		if (!statuss) {
			successmsg("Please select status");
		}

		if (namevalue && update_label && statuss) {
			$.busyLoadFull("show");
			var form_data = new FormData();
			form_data.append('update_label', update_label);
			form_data.append('namevalue', namevalue);
			form_data.append('attribute_id', attribute_id);
			form_data.append('statuss', statuss);
			form_data.append('code', code_ajax);

			$.ajax({
				method: 'POST',
				url: 'edit_tax_class_process.php',
				data: form_data,
				contentType: false,
				processData: false,
				success: function (response) {
					$.busyLoadFull("hide");
					$("#myModalupdate").modal('hide');
					$('#update_label').val('');
					$('#update_name').val('');
					$('#attribute_id').val('');
					var page = $(".pagination .active .current").text();
					getTaxClass(page, 0)
					successmsg(response);

				}
			});
		}

	});



});



function perpage_filter() {
	$.busyLoadFull("show");
	var perpage = $('#perpage').val();
	// successmsg( "sdfs" );
	var count = 1;
	$.ajax({
		method: 'POST',
		url: 'get_tax_class_data.php',
		data: {
			code: code_ajax,
			page: 1,
			rowno: 0,
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
				if (this.statuss == "0") {
					btnactive = '<span class = "Pending">' + "Pending" + '</span>';
				} else if (this.statuss == "1") {
					btnactive = '<spanclass = "Active">' + "Active " + '</span>';
				} else if (this.statuss == "3") {
					btnactive = '<span class = "Deactive">' + "Deactive" + '</span>';
				}
				var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.name + '</td><td > ' + this.percent + '</td><td > ' + btnactive + '</td>';
				html += '<td> <button type="submit" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" name="delete" onclick="deletetaxclass(' + this.id + ');">DELETE</button>';

				html += '<button  style=" margin-left: 10px;" type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'edittaxclass("' + this.id + '","' + this.name + '","' + this.percent + '","' + this.statuss + '")\';>EDIT</button></td></tr>';
				$("#cat_list").append(html);

				count = count + 1;
			});



		}
	});
}

function edittaxclass(id, name, percent, statuss) {
	$("#myModalupdate").modal('show');
	$("#attribute_id").val(id);
	$("#update_label").val(name);
	$("#update_name").val(percent);
	$("#statuss").val(statuss);
}

function deletetaxclass(id) {
	xdialog.confirm('Are you sure want to delete?', function () {
		$.busyLoadFull("show");
		$.ajax({
			method: 'POST',
			url: 'delete_tax_class.php',
			data: { deletearray: id, code: code_ajax },
			success: function (response) {
				$.busyLoadFull("hide");
				if (response == 'Failed to Delete.') {
					successmsg("Failed to Delete.");
				} else if (response == 'Deleted') {
					$("#tr" + id).remove();
					successmsg("Tax Class Deleted Successfully.");
				} else {
					$("#myModalbrandassign").modal('show');
					$("#myModalbrandassigndivy").html(response);
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






