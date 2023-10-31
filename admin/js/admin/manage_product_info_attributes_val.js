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
		url: 'get_product_info_val_data.php',
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
				if (this.colour_code !== null && this.colour_code.startsWith("#")) {
					var rgb = hexToRgb(this.colour_code);
					var darkerColor = `rgb(${rgb.r * 0.8}, ${rgb.g * 0.8}, ${rgb.b * 0.8})`;
					var color_icon = '&nbsp;&nbsp;<label style="height:20px;width:20px;border-radius:20px;margin-bottom:-5px;background-color:' + this.colour_code + ';border:1px solid ' + darkerColor + '"></label>';
				}
				var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.main_attr + '</td><td > ' + this.attribute_value + '</td><td > ' + this.attribute_value_ar + '</td><td > ' + color_icon + '</td>';
				html += '<td><div class="d-flex"><button type="submit" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" name="delete" onclick=\'deleteProductInfoValue(' + this.id + ',"' + this.attribute_value + '");\'>DELETE</button>';

				html += '<button  style=" margin-left: 10px;" type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'editProductInfoValue("' + this.id + '","' + this.attribute_value + '","' + this.attribute_value_ar + '","' + this.colour_code + '")\';>EDIT</button></div></td></tr>';
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
		url: 'get_product_info_val_data.php',
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
				if (this.colour_code !== null && this.colour_code.startsWith("#")) {
					var rgb = hexToRgb(this.colour_code);
					var darkerColor = `rgb(${rgb.r * 0.8}, ${rgb.g * 0.8}, ${rgb.b * 0.8})`;
					var color_icon = '&nbsp;&nbsp;<label style="height:20px;width:20px;border-radius:20px;margin-bottom:-5px;background-color:' + this.colour_code + ';border:1px solid ' + darkerColor + '"></label>';
				}

				var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.main_attr + '</td><td > ' + this.attribute_value + '</td><td > ' + this.attribute_value_ar + '</td><td > ' + color_icon + '</td>';
				html += '<td><div class="d-flex"><button type="submit" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" name="delete" onclick=\'deleteProductInfoValue(' + this.id + ',"' + this.attribute_value + '");\'>DELETE</button>';

				html += '<button  style=" margin-left: 10px;" type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'editProductInfoValue("' + this.id + '","' + this.attribute_value + '","' + this.attribute_value_ar + '","' + this.colour_code + '")\';>EDIT</button></div></td></tr>';
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

		var valid = 1;
		var namevalue = $('#attributes').val();
		var namevalue_ar = $('#attributes_ar').val();
		var colour_code = $('#color-check-box').prop("checked");
		// Regular expression to match the hex color code pattern
		// var regex = /^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/;

		if (!namevalue) {
			successmsg("Please enter Attributes Name (ENG)");
			valid = 0;
		} else if (!namevalue_ar) {
			successmsg("Please enter Attributes Name (Arabic)");
			valid = 0;
		} else if (colour_code) {
			colour_code = $('#style1').val();
		} else {
			colour_code = '';
		}

		var main_attribute_id = $('#main_attribute_id').val();

		if (namevalue && namevalue_ar && valid == 1) {
			$.busyLoadFull("show");
			var form_data = new FormData();
			form_data.append('namevalue', namevalue);
			form_data.append('namevalue_ar', namevalue_ar);
			form_data.append('colour_code', colour_code);
			form_data.append('main_attribute_id', main_attribute_id);
			form_data.append('code', code_ajax);

			$.ajax({
				method: 'POST',
				url: 'add_product_info_val_process.php',
				data: form_data,
				contentType: false,
				processData: false,
				success: function (response) {
					$.busyLoadFull("hide");
					$("#myModal").modal('hide');
					$('#attributes').val('');
					$('#attributes_ar').val('');
					$('#color-check-box').prop("checked", false);
					document.getElementById('style1').style.cssText = 'display: none;';
					$("#style1").val('');
					getAttribute(1, 0)
					successmsg(response);
				}
			});
		}

	});

	$("#update_attributes_btn").click(function (event) {
		event.preventDefault();

		var valid = 1;
		var namevalue = $('#update_attributes').val();
		var namevalue_ar = $('#update_attributes_ar').val();
		var colour_code = $('#update-color-check-box').prop("checked");
		var attribute_id = $('#attribute_id').val();

		if (!namevalue) {
			successmsg("Please enter Attribute");
			valid = 0;
		} else if (!namevalue_ar) {
			successmsg("Please enter Attributes Name (Arabic)");
			valid = 0;
		} else if (colour_code) {
			colour_code = $('#style2').val();
		} else {
			colour_code = '';
		}

		var main_attribute_id = $('#main_attribute_id').val();
		if (namevalue && valid == 1) {
			$.busyLoadFull("show");
			var form_data = new FormData();
			form_data.append('namevalue', namevalue);
			form_data.append('namevalue_ar', namevalue_ar);
			form_data.append('colour_code', colour_code);
			form_data.append('attribute_id', attribute_id);
			form_data.append('main_attribute_id', main_attribute_id);
			form_data.append('code', code_ajax);

			$.ajax({
				method: 'POST',
				url: 'edit_product_info_val_process.php',
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
		url: 'get_product_info_val_data.php',
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
				if (this.colour_code !== null && this.colour_code.startsWith("#")) {
					var rgb = hexToRgb(this.colour_code);
					var darkerColor = `rgb(${rgb.r * 0.8}, ${rgb.g * 0.8}, ${rgb.b * 0.8})`;
					var color_icon = '&nbsp;&nbsp;<label style="height:20px;width:20px;border-radius:20px;margin-bottom:-5px;background-color:' + this.colour_code + ';border:1px solid ' + darkerColor + '"></label>';
				}

				var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.main_attr + '</td><td > ' + this.attribute_value + '</td><td > ' + this.attribute_value_ar + '</td><td > ' + color_icon + '</td>';
				html += '<td><div class="d-flex"><button type="submit" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" name="delete" onclick=\'deleteProductInfoValue(' + this.id + ',"' + this.attribute_value + '");\'>DELETE</button>';

				html += '<button  style=" margin-left: 10px;" type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'editProductInfoValue("' + this.id + '","' + this.attribute_value + '","' + this.attribute_value_ar + '","' + this.colour_code + '")\';>EDIT</button></div></td></tr>';
				$("#cat_list").append(html);

				count = count + 1;
			});



		}
	});
}

function editProductInfoValue(id, name, name_ar, colour_code) {
	$("#myModalupdate").modal('show');
	$("#attribute_id").val(id);
	$("#update_attributes").val(name);
	$("#update_attributes_ar").val(name_ar);
	if (colour_code !== null && colour_code.startsWith("#")) {
		$('#update-color-check-box').prop("checked", true);
		document.getElementById('style2').style.cssText = 'display: block;';
		$("#style2").val(colour_code);
	} else {
		$('#update-color-check-box').prop("checked", false);
		document.getElementById('style2').style.cssText = 'display: none;';
		$("#style2").val('');
	}
}

function deleteProductInfoValue(id, name) {
	var main_attribute_id = $('#main_attribute_id').val();
	xdialog.confirm('Are you sure want to delete?', function () {
		$.busyLoadFull("show");
		$.ajax({
			method: 'POST',
			url: 'delete_product_info_val.php',
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
	location.href = "manage_product_info_attributes.php";
}