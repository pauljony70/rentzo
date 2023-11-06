var code_ajax = $("#code_ajax").val();

var pageno = 1;

var rowno = 0;





function getBrand(pagenov, rownov) {

	$.busyLoadFull("show");

	var perpage = $('#perpage').val();

	// successmsg( "sdfs" );

	var count = 1;

	$.ajax({

		method: 'POST',

		url: 'get_manage_events.php',

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

					btnactive = '<span class = "Active">' + "Active " + '</span>';

				} else if (this.statuss == "3") {

					btnactive = '<span class = "Deactive">' + "Deactive" + '</span>';

				}

				var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td> ' + this.cat_name + '</td><td > ' + this.name + '</td><td><img src="' + this.img + '" style="height: 72px;"></td>';

				html += '<td> <button type="submit" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" name="delete" onclick="deletebrand(' + this.id + ');">DELETE</button></td></tr>';

				$("#cat_list").append(html);



				count = count + 1;

			});







		}

	});

}





function brand_product(pagenov) {

	$.busyLoadFull("show");

	var perpage = $('#perpage').val();

	// successmsg( "sdfs" );

	var count = 1;

	$.ajax({

		method: 'POST',

		url: 'get_manage_events.php',

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

					btnactive = '<span class = "Active">' + "Active " + '</span>';

				} else if (this.statuss == "3") {

					btnactive = '<span class = "Deactive">' + "Deactive" + '</span>';

				}

				var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td> ' + this.cat_name + '</td><td > ' + this.name + '</td><td><img src="' + this.img + '" style="height: 72px;"></td>';

				html += '<td> <button type="submit" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" name="delete" onclick="deletebrand(' + this.id + ');">DELETE</button></td></tr>';

				$("#cat_list").append(html);



				count = count + 1;

			});







		}

	});

}





$(document).ready(function () {

	getBrand(pageno, rowno);





	$("#add_brand_btn").click(function (event) {

		event.preventDefault();



		var namevalue = $('#name').val();

		var name_ar = $('#name_ar').val();

		var brand_image = $('#brand_image').val();



		if (!namevalue) {

			successmsg("Please enter Brand Name");

		} else if (!name_ar) {

			successmsg("Please enter Brand Arabic Name");

		} else

			if (!brand_image) {

				successmsg("Please select Brand Image");

			} else



				if (namevalue && brand_image && name_ar) {

					$.busyLoadFull("show");

					var file_data = $('#brand_image').prop('files')[0];

					var form_data = new FormData();

					form_data.append('brand_image', file_data);

					form_data.append('namevalue', namevalue);

					form_data.append('code', code_ajax);

					form_data.append('name_ar', name_ar);



					$.ajax({

						method: 'POST',

						url: 'add_brand_process.php',

						data: form_data,

						contentType: false,

						processData: false,

						success: function (response) {

							$.busyLoadFull("hide");

							$("#myModal").modal('hide');

							$('#name').val('');

							$('#name_ar').val('');

							$('#brand_image').val('');

							getBrand(1, 0)

							successmsg(response);

						}

					});

				}



	});



	$("#update_brand_btn").click(function (event) {

		event.preventDefault();



		var namevalue = $('#update_name').val();

		var update_name_ar = $('#update_name_ar').val();

		var brand_id = $('#brand_id').val();

		var statuss = $('#status').val();



		if (!namevalue) {

			successmsg("Please enter Brand Name");

		} else if (!update_name_ar) {

			successmsg("Please enter Brand Arabic Name");

		} else

			if (!statuss) {

				successmsg("Please select Category status");

			} else



				if (namevalue && statuss && update_name_ar) {

					$.busyLoadFull("show");

					var file_data = $('#update_brand_image').prop('files')[0];

					var form_data = new FormData();

					form_data.append('brand_image', file_data);

					form_data.append('namevalue', namevalue);

					form_data.append('update_name_ar', update_name_ar);

					form_data.append('brand_id', brand_id);

					form_data.append('statuss', statuss);

					form_data.append('code', code_ajax);



					$.ajax({

						method: 'POST',

						url: 'edit_brand_process.php',

						data: form_data,

						contentType: false,

						processData: false,

						success: function (response) {

							$.busyLoadFull("hide");

							$("#myModalupdate").modal('hide');

							$('#update_name').val('');

							$('#update_brand_image').val('');

							$('#brand_id').val('');



							var page = $(".pagination .active .current").text();

							getBrand(page, 0)

							successmsg(response);

							$('#update_name_ar').val('');

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

		url: 'get_manage_events.php',

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

				var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td> ' + this.cat_name + '</td><td > ' + this.name + '</td><td><img src="' + this.img + '" style="height: 72px;"></td>';

				html += '<td> <button type="submit" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" name="delete" onclick="deletebrand(' + this.id + ');">DELETE</button></td></tr>';
				$("#cat_list").append(html);



				count = count + 1;

			});

		}

	});

}



function editbrand(id, name, statuss, update_name_ar) {

	$("#myModalupdate").modal('show');

	$("#brand_id").val(id);

	$("#update_name").val(name);

	$("#update_name_ar").val(update_name_ar);

	$("#status").val(statuss);

}



function deletebrand(id) {



	xdialog.confirm('Are you sure want to delete?', function () {

		$.busyLoadFull("show");

		$.ajax({

			method: 'POST',

			url: 'delete_events.php',

			data: { id: id, code: code_ajax },

			success: function (response) {

				$.busyLoadFull("hide");

				if (response == 'Failed to Delete.') {

					successmsg("Failed to Delete.");

				} else if (response == 'Deleted') {

					$("#tr" + id).remove();

					successmsg("Deleted Event Successfully.");

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



function assign_brand_btn() {

	var delete_brand_id = $('#delete_brand_id').val();

	var brand_assign_id = $('#brand_assign_id').val();



	if (delete_brand_id && brand_assign_id) {



		var form_data = new FormData();

		form_data.append('delete_brand_id', delete_brand_id);

		form_data.append('brand_assign_id', brand_assign_id);

		form_data.append('code', code_ajax);



		$.ajax({

			method: 'POST',

			url: 'delete_brand.php',

			data: form_data,

			contentType: false,

			processData: false,

			success: function (response) {

				$("#tr" + delete_brand_id).remove();

				successmsg("Brand Deleted Successfully.");

				$("#myModalbrandassign").modal('hide');

			}

		});

	} else {

		successmsg("Invalid Request!");

	}



}









