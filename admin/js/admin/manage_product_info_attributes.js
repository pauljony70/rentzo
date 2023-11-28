var code_ajax = $("#code_ajax").val();
var pageno = 1;
var rowno = 0;


function getProductInfoAttributes(pagenov, rownov) {
	$.busyLoadFull("show");
	var perpage = $('#perpage').val();
	// successmsg( "sdfs" );
	var count = 1;
	$.ajax({
		method: 'POST',
		url: 'get_product_info_data.php',
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

				var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.attribute + '</td>';
				html += '<td><div class="d-flex"><button type="submit" class= "btn btn-dark waves-effect waves-light btn-sm pull-left" name="delete" onclick="view_attr_value(' + this.id + ');">View</button>';
				html += '<button style=" margin-left: 10px;" type="submit" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" name="delete" onclick="deleteAttribute(' + this.id + ');">DELETE</button>';

				html += '<button style=" margin-left: 10px;" type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'editAttribute("' + this.id + '","' + this.attribute + '","' + this.attribute_ar + '","' + this.statuss + '")\';>EDIT</button></div></td></tr>';
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
		url: 'get_product_info_data.php',
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

				var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.attribute + '</td>';
				html += '<td><div class="d-flex"><button type="submit" class= "btn btn-dark waves-effect waves-light btn-sm pull-left" name="delete" onclick="view_attr_value(' + this.id + ');">View</button>';
				html += '<button style=" margin-left: 10px;" type="submit" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" name="delete" onclick="deleteAttribute(' + this.id + ');">DELETE</button>';

				html += '<button  style=" margin-left: 10px;" type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'editAttribute("' + this.id + '","' + this.attribute + '","' + this.attribute_ar + '","' + this.statuss + '")\';>EDIT</button></div></td></tr>';
				$("#cat_list").append(html);

				count = count + 1;
			});



		}
	});
}

$(document).ready(function () {
	getProductInfoAttributes(pageno, rowno);

	$("#add_attributes_btn").click(function (event) {
		event.preventDefault();

		var namevalue = $('#attributes').val();
		var namevalue_ar = '';

		if (!namevalue) {
			successmsg("Please enter Attributes Name");
		} 
		if (namevalue) {
			$.busyLoadFull("show");
			var form_data = new FormData();
			form_data.append('namevalue', namevalue);
			form_data.append('namevalue_ar', namevalue_ar);
			form_data.append('code', code_ajax);

			$.ajax({
				method: 'POST',
				url: 'add_product_info_attribute_process.php',
				data: form_data,
				contentType: false,
				processData: false,
				success: function (response) {
					$.busyLoadFull("hide");
					$("#myModal").modal('hide');
					$('#attributes').val('');
					$('#attributes_ar').val('');
					getProductInfoAttributes(1, 0)
					successmsg(response);
				}
			});
		}

	});

	$("#update_attributes_btn").click(function (event) {
		event.preventDefault();

		var namevalue = $('#update_attributes').val();
		var namevalue_ar = '';
		var attribute_id = $('#attribute_id').val();
		var statuss = 1;

		if (!namevalue) {
			successmsg("Please enter Attribute");
		}


		if (namevalue && statuss) {
			$.busyLoadFull("show");
			var form_data = new FormData();
			form_data.append('namevalue', namevalue);
			form_data.append('namevalue_ar', namevalue_ar);
			form_data.append('attribute_id', attribute_id);
			form_data.append('statuss', statuss);
			form_data.append('code', code_ajax);

			$.ajax({
				method: 'POST',
				url: 'edit_product_info_attribute_process.php',
				data: form_data,
				contentType: false,
				processData: false,
				success: function (response) {
					$.busyLoadFull("hide");
					$("#myModalupdate").modal('hide');
					$('#update_attributes').val('');
					$('#update_attributes_ar').val('');
					$('#attribute_id').val('');
					var page = $(".pagination .active .current").text();
					getProductInfoAttributes(page, 0)
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
		url: 'get_product_info_data.php',
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

				var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.attribute + '</td>';
				html += '<td><div class="d-flex"><button type="submit" class= "btn btn-dark waves-effect waves-light btn-sm pull-left" name="delete" onclick="view_attr_value(' + this.id + ');">View</button>';
				html += '<button style=" margin-left: 10px;" type="submit" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" name="delete" onclick="deleteAttribute(' + this.id + ');">DELETE</button>';

				html += '<button style=" margin-left: 10px;" type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'editAttribute("' + this.id + '","' + this.attribute + '","' + this.attribute_ar + '","' + this.statuss + '")\';>EDIT</button></div></td></tr>';
				$("#cat_list").append(html);

				count = count + 1;
			});



		}
	});
}

function editAttribute(id, name, name_ar, statuss) {
	$("#myModalupdate").modal('show');
	$("#attribute_id").val(id);
	$("#update_attributes").val(name);
	$("#update_attributes_ar").val(name_ar);
	// $("#status").val(statuss);
}

function deleteAttribute(id) {
	xdialog.confirm('Are you sure want to delete?', function () {
		$.busyLoadFull("show");
		$.ajax({
			method: 'POST',
			url: 'delete_product_info_attribute.php',
			data: { deletearray: id, code: code_ajax },
			success: function (response) {
				$.busyLoadFull("hide");
				if (response == 'Failed to Delete.') {
					successmsg("Failed to Delete.");
				} else if (response == 'Deleted') {
					getProductInfoAttributes(1, 0);
					// $("#tr" + id).remove();
					successmsg("Attribute Deleted Successfully.");
				} else {
					successmsg(response);
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

function view_attr_value(id) {
	location.href = "manage_product_info_attributes_val.php?attribute_id=" + id;
}