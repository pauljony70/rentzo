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
		url: 'get_attribute_set_data.php',
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
				var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.name + '</td><td > ' + btnactive + '</td>';
				html += '<td> <button type="submit" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" name="delete" onclick="deletebrand(' + this.id + ');">DELETE</button>';

				html += '<button  style=" margin-left: 10px;" type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'editbrand("' + this.id + '","' + this.name + '","' + this.statuss + '")\';>EDIT</button></td></tr>';
				$("#cat_list").append(html);

				count = count + 1;
			});



		}
	});
}

function getProductInfoAttributes(pagenov, rownov) {
	$.busyLoadFull("show");

	$.ajax({
		method: 'POST',
		url: 'get_product_info_data.php',
		data: {
			code: code_ajax,
			page: pagenov,
			rowno: rownov,
			perpage: 100
		},
		success: function (response) {
			$.busyLoadFull("hide");
			var parsedJSON = $.parseJSON(response);
			$("#product_attributes_set_id").empty();

			var data = parsedJSON.data;
			$('#product_attributes_set_id').empty();
			$(data).each(function () {
				if (this.statuss === 1) {
					var newOption = new Option(this.attribute, this.id);
					// Append the new option to the select element
					$("#product_attributes_set_id").append(newOption);
				}
			});
			$("#product_attributes_set_id").multiselect('reload');
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
		url: 'get_attribute_set_data.php',
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
				var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.name + '</td><td > ' + btnactive + '</td>';
				html += '<td> <button type="submit" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" name="delete" onclick="deletebrand(' + this.id + ');">DELETE</button>';

				html += '<button  style=" margin-left: 10px;" type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'editbrand("' + this.id + '","' + this.name + '","' + this.statuss + '")\';>EDIT</button></td></tr>';
				$("#cat_list").append(html);

				count = count + 1;
			});



		}
	});
}


$(document).ready(function () {
	getAttribute(pageno, rowno);
	getProductInfoAttributes(pageno, rowno);

	$("#add_attribute_btn").click(function (event) {
		event.preventDefault();

		var namevalue = $('#name').val();
		var product_attributes_set = $('#product_attributes_set_id').val();

		if (!namevalue) {
			successmsg("Please enter Brand Name");
		}

		if (namevalue) {
			$.busyLoadFull("show");
			var form_data = new FormData();
			form_data.append('namevalue', namevalue);
			form_data.append('product_info_set_id', product_attributes_set);
			form_data.append('code', code_ajax);

			$.ajax({
				method: 'POST',
				url: 'add_attribute_set_process.php',
				data: form_data,
				contentType: false,
				processData: false,
				success: function (response) {
					$.busyLoadFull("hide");
					$("#myModal").modal('hide');
					$('#name').val('');
					getAttribute(1, 0)
					successmsg(response);
					$('#name').val('');
					$('#product_attributes_set_id').multiselect('reset');
					$('#product_attributes_set_id').multiselect('reload');
					intializeMultiSelectDesign();
				}
			});
		}

	});

	$("#update_attribute_btn").click(function (event) {
		event.preventDefault();

		var namevalue = $('#update_name').val();
		var attribute_id = $('#attribute_id').val();
		var product_attributes_set = $('#update_product_attributes_set_id').val();
		var statuss = $('#statuss').val();

		if (!namevalue) {
			successmsg("Please enter Brand Name");
		}
		if (!statuss) {
			successmsg("Please select Brand Status");
		}

		if (namevalue && statuss) {
			$.busyLoadFull("show");
			var form_data = new FormData();
			form_data.append('namevalue', namevalue);
			form_data.append('attribute_id', attribute_id);
			form_data.append('product_info_set_id', product_attributes_set);
			form_data.append('statuss', statuss);
			form_data.append('code', code_ajax);

			$.ajax({
				method: 'POST',
				url: 'edit_attribute_set_process.php',
				data: form_data,
				contentType: false,
				processData: false,
				success: function (response) {
					$.busyLoadFull("hide");
					$("#myModalupdate").modal('hide');
					$('#update_name').val('');
					$('#attribute_id').val('');
					var page = $(".pagination .active .current").text();
					getAttribute(page, 0)
					successmsg(response);

				}
			});
		}

	});

	$('#product_attributes_set_id').multiselect({
		columns: 3,
		search: true,
		selectAll: true,
		texts: {
			placeholder: 'Select Attribute',
			search: 'Search Attribute'
		},
		/* onOptionClick: function (element, option) {
			var maxSelect = 10;
			if ($(element).val()) {
				// too many selected, deselect this option
				if ($(element).val().length > maxSelect) {
					if ($(option).is(':checked')) {
						var thisVals = $(element).val();

						thisVals.splice(
							thisVals.indexOf($(option).val()), 1
						);

						$(element).val(thisVals);

						$(option).prop('checked', false).closest('li')
							.toggleClass('selected');
					}
				}
				// max select reached, disable non-checked checkboxes
				else if ($(element).val().length == maxSelect) {
					$(element).next('.ms-options-wrap')
						.find('li:not(.selected)').addClass('disabled')
						.find('input[type="checkbox"]')
						.attr('disabled', 'disabled');
				}
				// max select not reached, make sure any disabled
				// checkboxes are available
				else {
					$(element).next('.ms-options-wrap')
						.find('li.disabled').removeClass('disabled')
						.find('input[type="checkbox"]')
						.removeAttr('disabled');
				}
			}
		} */

	});

	$('#update_product_attributes_set_id').multiselect({
		columns: 3,
		search: true,
		selectAll: true,
		texts: {
			placeholder: 'Select Attribute',
			search: 'Search Attribute'
		}
	});

	setTimeout(() => {
		intializeMultiSelectDesign();
	}, 500);
});



function perpage_filter() {
	$.busyLoadFull("show");
	var perpage = $('#perpage').val();
	// successmsg( "sdfs" );
	var count = 1;
	$.ajax({
		method: 'POST',
		url: 'get_attribute_set_data.php',
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
					btnactive = '<span class = "Active">' + "Active " + '</span>';
				} else if (this.statuss == "3") {
					btnactive = '<span class = "Deactive">' + "Deactive" + '</span>';
				}
				var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.name + '</td><td > ' + btnactive + '</td>';
				html += '<td> <button type="submit" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" name="delete" onclick="deletebrand(' + this.id + ');">DELETE</button>';

				html += '<button  style=" margin-left: 10px;" type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'editbrand("' + this.id + '","' + this.name + '","' + this.statuss + '")\';>EDIT</button></td></tr>';
				$("#cat_list").append(html);

				count = count + 1;
			});



		}
	});
}

const intializeMultiSelectDesign = () => {
	document.getElementById('myModal').querySelector('#ms-list-1').classList.add('form-control', 'p-0');
	document.getElementById('myModal').querySelector('#ms-list-1').getElementsByTagName('button')[0].classList.add('w-100', 'h-100', 'm-0', 'pl-2');
	document.getElementById('myModal').querySelector('#ms-list-1').getElementsByTagName('button')[0].style.cssText = 'border: 0; border-radius: 5px;';
	document.getElementById('myModal').querySelector('.ms-options').getElementsByTagName('input')[0].classList.add('form-control');
	document.getElementById('myModal').querySelector('.ms-selectall.global').classList.add('btn', 'btn-sm', 'btn-dark', 'waves-effect', 'waves-light');
	document.getElementById('myModalupdate').querySelector('#ms-list-2').classList.add('form-control', 'p-0');
	document.getElementById('myModalupdate').querySelector('#ms-list-2').getElementsByTagName('button')[0].classList.add('w-100', 'h-100', 'm-0', 'pl-2');
	document.getElementById('myModalupdate').querySelector('#ms-list-2').getElementsByTagName('button')[0].style.cssText = 'border: 0; border-radius: 5px;';
	document.getElementById('myModalupdate').querySelector('.ms-options').getElementsByTagName('input')[0].classList.add('form-control');
	document.getElementById('myModalupdate').querySelector('.ms-selectall.global').classList.add('btn', 'btn-sm', 'btn-dark', 'waves-effect', 'waves-light');
}

function editbrand(id, name, statuss) {
	$.busyLoadFull("show");
	// Set default selected values
	var defaultValues = [];
	$("#myModalupdate").modal('show');
	$("#attribute_id").val(id);
	$("#update_name").val(name);
	$("#statuss").val(statuss);
	$.ajax({
		method: 'POST',
		url: 'get_product_info_data.php',
		data: {
			code: code_ajax,
			page: 1,
			rowno: 0,
			attribute_set_id: id,
			perpage: 100
		},
		success: function (response) {
			$.busyLoadFull("hide");
			var parsedJSON = $.parseJSON(response);
			$("#product_attributes_set_id").empty();

			var data = parsedJSON.data;
			if (data !== '') {
				data.forEach(element => {
					defaultValues.push(element.product_info_set_id);
				});
			}
			$.ajax({
				method: 'POST',
				url: 'get_product_info_data.php',
				data: {
					code: code_ajax,
					page: 1,
					rowno: 0,
					perpage: 100
				},
				success: function (response) {
					var parsedJSON = $.parseJSON(response);
					$("#update_product_attributes_set_id").empty();

					var data = parsedJSON.data;
					$('#update_product_attributes_set_id').empty();
					$(data).each(function () {
						if (this.statuss === 1) {
							var newOption = new Option(this.attribute, this.id);
							if (defaultValues.includes(this.id)) {
								newOption.selected = true;
							}
							// Append the new option to the select element
							$("#update_product_attributes_set_id").append(newOption);
						}
					});
					$("#update_product_attributes_set_id").multiselect('reload');

					console.log(defaultValues);
					intializeMultiSelectDesign();
				}
			});
		}
	});
}

function deletebrand(id) {
	xdialog.confirm('Are you sure want to delete?', function () {
		$.busyLoadFull("show");
		$.ajax({
			method: 'POST',
			url: 'delete_attribute_set.php',
			data: { deletearray: id, code: code_ajax },
			success: function (response) {
				$.busyLoadFull("hide");
				if (response == 'Failed to Delete.') {
					successmsg("Failed to Delete.");
				} else if (response == 'Deleted') {
					$("#tr" + id).remove();
					successmsg("Attribute Set Deleted Successfully.");
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




