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
		url: 'get_attribute_conf_data.php',
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
				html += '<td><div class="d-flex"> <button type="submit" class= "btn btn-dark waves-effect waves-light btn-sm pull-left" name="delete" onclick="view_attr_value(' + this.id + ');">View</button>';
				html += '<button style=" margin-left: 10px;" type="submit" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" name="delete" onclick="deletebrand(' + this.id + ');">DELETE</button>';

				html += '<button  style=" margin-left: 10px;" type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'editbrand("' + this.id + '","' + this.attribute + '","' + this.attribute_ar + '","' + this.statuss + '")\';>EDIT</button></div></td></tr>';
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
		url: 'get_attribute_conf_data.php',
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

				var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.attribute + '</td>';
				html += '<td><div class="d-flex"> <button type="submit" class= "btn btn-dark waves-effect waves-light btn-sm pull-left" name="delete" onclick="view_attr_value(' + this.id + ');">View</button>';
				html += '<button style=" margin-left: 10px;" type="submit" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" name="delete" onclick="deletebrand(' + this.id + ');">DELETE</button>';

				html += '<button  style=" margin-left: 10px;" type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'editbrand("' + this.id + '","' + this.attribute + '","' + this.attribute_ar + '","' + this.statuss + '")\';>EDIT</button></div></td></tr>';
				$("#cat_list").append(html);

				count = count + 1;
			});



		}
	});
}


$(document).ready(function () {
	getAttribute(pageno, rowno);


	$("#add_attributes_btn").click(function (event) {
		event.preventDefault();

		var namevalue = $('#attributes').val();
		var namevalue_ar = '';

		if (!namevalue) {
			successmsg("Please enter Attribute (ENG)");
		}

		if (namevalue) {
			$.busyLoadFull("show");
			var form_data = new FormData();
			form_data.append('namevalue', namevalue);
			form_data.append('namevalue_ar', namevalue_ar);
			form_data.append('code', code_ajax);

			$.ajax({
				method: 'POST',
				url: 'add_attribute_conf_process.php',
				data: form_data,
				contentType: false,
				processData: false,
				success: function (response) {
					$.busyLoadFull("hide");
					$("#myModal").modal('hide');
					$('#attributes').val('');
					$('#attributes_ar').val('');
					getAttribute(1, 0)
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
		var statuss = 1;// $('#status').val();

		if (!namevalue) {
			successmsg("Please enter Attribute (ENG)");
		} 
		/*	if(!statuss){
				successmsg("Please select status");
			}	*/

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
				url: 'edit_attribute_conf_process.php',
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
					getAttribute(page, 0)
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
		url: 'get_attribute_conf_data.php',
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

				var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.attribute + '</td>';
				html += '<td><div class="d-flex"> <button type="submit" class= "btn btn-dark waves-effect waves-light btn-sm pull-left" name="delete" onclick="view_attr_value(' + this.id + ');">View</button>';
				html += '<button style=" margin-left: 10px;" type="submit" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" name="delete" onclick="deletebrand(' + this.id + ');">DELETE</button>';

				html += '<button  style=" margin-left: 10px;" type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'editbrand("' + this.id + '","' + this.attribute + '","' + this.attribute_ar + '","' + this.statuss + '")\';>EDIT</button></div></td></tr>';
				$("#cat_list").append(html);

				count = count + 1;
			});



		}
	});
}

function editbrand(id, name, name_ar, statuss) {
	$("#myModalupdate").modal('show');
	$("#attribute_id").val(id);
	$("#update_attributes").val(name);
	$("#update_attributes_ar").val(name_ar);
	$("#status").val(statuss);
}

function deletebrand(id) {
	xdialog.confirm('Are you sure want to delete?', function () {
		$.busyLoadFull("show");
		$.ajax({
			method: 'POST',
			url: 'delete_attribute_conf.php',
			data: { deletearray: id, code: code_ajax },
			success: function (response) {
				$.busyLoadFull("hide");
				if (response == 'Failed to Delete.') {
					successmsg("Failed to Delete.");
				} else if (response == 'Deleted') {
					$("#tr" + id).remove();
					successmsg("Attribute Deleted Successfully.");
				} else {
					//$("#myModalbrandassign").modal('show');
					//$("#myModalbrandassigndivy").html(response);
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

function assign_attribute_btn() {
	var delete_attribute_id = $('#delete_attribute_id').val();
	var attribute_assign_id = $('#attribute_assign_id').val();

	if (delete_attribute_id && attribute_assign_id) {
		$.busyLoadFull("show");
		var form_data = new FormData();
		form_data.append('delete_attribute_id', delete_attribute_id);
		form_data.append('attribute_assign_id', attribute_assign_id);
		form_data.append('code', code_ajax);

		$.ajax({
			method: 'POST',
			url: 'delete_attribute_set.php',
			data: form_data,
			contentType: false,
			processData: false,
			success: function (response) {
				$.busyLoadFull("hide");
				$("#tr" + delete_attribute_id).remove();
				successmsg("Attribute Set Deleted Successfully.");
				$("#myModalbrandassign").modal('hide');
			}
		});
	} else {
		successmsg("Please select Attribute Set");
	}

}


function view_attr_value(id) {
	location.href = "manage_conf_attributes_val.php?attribute_id=" + id;
}


