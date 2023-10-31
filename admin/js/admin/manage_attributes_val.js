var code_ajax = $("#code_ajax").val();
var pageno = 1;
var rowno = 0;

// function to convert hex color to RGB
function hexToRgb(hex) {
	// remove the "#" symbol
	hex = hex.replace("#", "");

	// convert to RGB
	const r = parseInt(hex.substring(0, 2), 16);
	const g = parseInt(hex.substring(2, 4), 16);
	const b = parseInt(hex.substring(4, 6), 16);

	return { r, g, b };
}

function getAttribute(pagenov, rownov) {
	$.busyLoadFull("show");
	var perpage = $('#perpage').val();
	var main_attribute_id = $('#main_attribute_id').val();
	// successmsg( "sdfs" );
	var count = 1;
	$.ajax({
		method: 'POST',
		url: 'get_attribute_conf_val_data.php',
		data: {
			code: code_ajax,
			page: pagenov,
			rowno: rownov,
			perpage: perpage,
			main_attribute_id: main_attribute_id
		},
		success: function (response) {
			$.busyLoadFull("hide");
			var parsedJSON = $.parseJSON(response);
			$("#cat_list").empty();

			$("#totalrowvalue").html(parsedJSON["totalrowvalue"]);
			$(".page_div").html(parsedJSON["page_html"]);

			var data = parsedJSON.data;
			$(data).each(function () {
				var color_icon = '';
				if (this.main_attr == 'Color') {
					var rgb = hexToRgb(this.attribute_value);
					var darkerColor = `rgb(${rgb.r * 0.8}, ${rgb.g * 0.8}, ${rgb.b * 0.8})`;
					var color_icon = '&nbsp;&nbsp;<label style="height:20px;width:20px;border-radius:20px;margin-bottom:-5px;background-color:' + this.attribute_value + ';border:1px solid ' + darkerColor + '"></label>';
				}
				var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.main_attr + '</td><td > ' + this.attribute_value + color_icon + '</td>';
				html += '<td><div class="d-flex"><button type="submit" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" name="delete" onclick=\'deletebrand(' + this.id + ',"' + this.attribute_value + '");\'>DELETE</button>';

				html += '<button  style=" margin-left: 10px;" type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'editbrand("' + this.id + '","' + this.attribute_value + '")\';>EDIT</button></div></td></tr>';
				$("#cat_list").append(html);

				count = count + 1;
			});



		}
	});
}


function attribute_set_product(pagenov) {
	$.busyLoadFull("show");
	var perpage = $('#perpage').val();
	var main_attribute_id = $('#main_attribute_id').val();
	// successmsg( "sdfs" );
	var count = 1;
	$.ajax({
		method: 'POST',
		url: 'get_attribute_conf_val_data.php',
		data: {
			code: code_ajax,
			page: pagenov,
			rowno: 0,
			perpage: perpage,
			main_attribute_id: main_attribute_id
		},
		success: function (response) {
			$.busyLoadFull("hide");
			var parsedJSON = $.parseJSON(response);
			$("#cat_list").empty();

			$("#totalrowvalue").html(parsedJSON["totalrowvalue"]);
			$(".page_div").html(parsedJSON["page_html"]);

			var data = parsedJSON.data;
			$(data).each(function () {
				var color_icon = '';
				if (this.main_attr == 'Color') {
					var rgb = hexToRgb(this.attribute_value);
					var darkerColor = `rgb(${rgb.r * 0.8}, ${rgb.g * 0.8}, ${rgb.b * 0.8})`;
					var color_icon = '&nbsp;&nbsp;<label style="height:20px;width:20px;border-radius:20px;margin-bottom:-5px;background-color:' + this.attribute_value + ';border:1px solid ' + darkerColor + '"></label>';
				}

				var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.main_attr + '</td><td > ' + this.attribute_value + color_icon + '</td>';
				html += '<td><div class="d-flex"><button type="submit" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" name="delete" onclick=\'deletebrand(' + this.id + ',"' + this.attribute_value + '");\'>DELETE</button>';

				html += '<button  style=" margin-left: 10px;" type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'editbrand("' + this.id + '","' + this.attribute_value + '")\';>EDIT</button></div></td></tr>';
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

		if (!namevalue) {
			successmsg("Please enter Attributes Name");
		}
		var main_attribute_id = $('#main_attribute_id').val();

		if (namevalue) {
			$.busyLoadFull("show");
			var form_data = new FormData();
			form_data.append('namevalue', namevalue);
			form_data.append('main_attribute_id', main_attribute_id);
			form_data.append('code', code_ajax);

			$.ajax({
				method: 'POST',
				url: 'add_attribute_conf_val_process.php',
				data: form_data,
				contentType: false,
				processData: false,
				success: function (response) {
					$.busyLoadFull("hide");
					$("#myModal").modal('hide');
					$('#attributes').val('');
					getAttribute(1, 0)
					successmsg(response);

				}
			});
		}

	});

	$("#update_attributes_btn").click(function (event) {
		event.preventDefault();

		var namevalue = $('#update_attributes').val();
		var attribute_id = $('#attribute_id').val();

		if (!namevalue) {
			successmsg("Please enter Attribute");
		}
		var main_attribute_id = $('#main_attribute_id').val();
		if (namevalue) {
			$.busyLoadFull("show");
			var form_data = new FormData();
			form_data.append('namevalue', namevalue);
			form_data.append('attribute_id', attribute_id);
			form_data.append('main_attribute_id', main_attribute_id);
			form_data.append('code', code_ajax);

			$.ajax({
				method: 'POST',
				url: 'edit_attribute_conf_val_process.php',
				data: form_data,
				contentType: false,
				processData: false,
				success: function (response) {
					$.busyLoadFull("hide");
					$("#myModalupdate").modal('hide');
					$('#update_attributes').val('');
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
	var main_attribute_id = $('#main_attribute_id').val();
	// successmsg( "sdfs" );
	var count = 1;
	$.ajax({
		method: 'POST',
		url: 'get_attribute_conf_val_data.php',
		data: {
			code: code_ajax,
			page: 1,
			rowno: 0,
			perpage: perpage,
			main_attribute_id: main_attribute_id
		},
		success: function (response) {
			$.busyLoadFull("hide");
			var parsedJSON = $.parseJSON(response);
			$("#cat_list").empty();

			$("#totalrowvalue").html(parsedJSON["totalrowvalue"]);
			$(".page_div").html(parsedJSON["page_html"]);

			var data = parsedJSON.data;
			$(data).each(function () {
				var color_icon = '';
				if (this.main_attr == 'Color') {
					var rgb = hexToRgb(this.attribute_value);
					var darkerColor = `rgb(${rgb.r * 0.8}, ${rgb.g * 0.8}, ${rgb.b * 0.8})`;
					var color_icon = '&nbsp;&nbsp;<label style="height:20px;width:20px;border-radius:20px;margin-bottom:-5px;background-color:' + this.attribute_value + ';border:1px solid ' + darkerColor + '"></label>';
				}

				var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.main_attr + '</td><td > ' + this.attribute_value + color_icon + '</td>';
				html += '<td><div class="d-flex"><button type="submit" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" name="delete" onclick=\'deletebrand(' + this.id + ',"' + this.attribute_value + '");\'>DELETE</button>';

				html += '<button  style=" margin-left: 10px;" type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'editbrand("' + this.id + '","' + this.attribute_value + '")\';>EDIT</button></div></td></tr>';
				$("#cat_list").append(html);

				count = count + 1;
			});



		}
	});
}

function editbrand(id, name) {
	$("#myModalupdate").modal('show');
	$("#attribute_id").val(id);
	$("#update_attributes").val(name);
}

function deletebrand(id, name) {
	var main_attribute_id = $('#main_attribute_id').val();
	xdialog.confirm('Are you sure want to delete?', function () {
		$.busyLoadFull("show");
		$.ajax({
			method: 'POST',
			url: 'delete_attribute_conf_val.php',
			data: { deletearray: id, code: code_ajax, main_attribute_id: main_attribute_id, name: name },
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


function back_page(id) {
	location.href = "manage_conf_attributes.php";
}


