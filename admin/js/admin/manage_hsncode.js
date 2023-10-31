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

		url: 'get_hsncode_data.php',

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



				var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.hsn_code + '</td>';

				html += '<td><button style="" type="submit" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" name="delete" onclick=\'deletebrand("' + this.id + '","' + this.hsn_code + '")\';>DELETE</button>';



				html += '<button  style=" margin-left: 10px;" type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'editbrand("' + this.id + '","' + this.hsn_code + '","' + this.statuss + '")\';>EDIT</button></td></tr>';

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

		url: 'get_hsncode_data.php',

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



				var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.hsn_code + '</td>';


				html += '<td><button style="" type="submit" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" name="delete" onclick=\'deletebrand("' + this.id + '","' + this.hsn_code + '")\';>DELETE</button>';



				html += '<button  style=" margin-left: 10px;" type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'editbrand("' + this.id + '","' + this.hsn_code + '","' + this.statuss + '")\';>EDIT</button></td></tr>';

				$("#cat_list").append(html);



				count = count + 1;

			});







		}

	});

}





$(document).ready(function () {

	getAttribute(pageno, rowno);





	$("#add_hsncode_btn").click(function (event) {

		event.preventDefault();



		var hsn_code = $('#hsn_code').val();



		if (!hsn_code) {

			successmsg("Please enter HSN Code");

		}



		if (hsn_code) {

			$.busyLoadFull("show");

			var form_data = new FormData();

			form_data.append('hsn_code', hsn_code);

			form_data.append('code', code_ajax);



			$.ajax({

				method: 'POST',

				url: 'add_hsncode_process.php',

				data: form_data,

				contentType: false,

				processData: false,

				success: function (response) {

					$.busyLoadFull("hide");

					$("#myModal").modal('hide');

					$('#hsn_code').val('');

					getAttribute(1, 0)

					successmsg(response);



				}

			});

		}



	});



	$("#update_hsncode_btn").click(function (event) {

		event.preventDefault();



		var hsn_code = $('#update_hsn_code').val();

		var hsn_id = $('#hsn_id').val();

		var statuss = 1;// $('#status').val();



		if (!hsn_code) {

			successmsg("Please enter HSN Code");

		}

		/*	if(!statuss){
	
				successmsg("Please select status");
	
			}	*/



		if (hsn_code && statuss) {

			$.busyLoadFull("show");

			var form_data = new FormData();

			form_data.append('hsn_code', hsn_code);

			form_data.append('hsn_id', hsn_id);

			form_data.append('statuss', statuss);

			form_data.append('code', code_ajax);



			$.ajax({

				method: 'POST',

				url: 'edit_hsncode_process.php',

				data: form_data,

				contentType: false,

				processData: false,

				success: function (response) {

					$.busyLoadFull("hide");

					$("#myModalupdate").modal('hide');

					$('#update_hsn_code').val('');

					$('#hsn_id').val('');

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

		url: 'get_hsncode_data.php',

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



				var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.hsn_code + '</td>';


				html += '<td><button style="" type="submit" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" name="delete" onclick=\'deletebrand("' + this.id + '","' + this.hsn_code + '")\';>DELETE</button>';



				html += '<button  style=" margin-left: 10px;" type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'editbrand("' + this.id + '","' + this.hsn_code + '","' + this.statuss + '")\';>EDIT</button></td></tr>';

				$("#cat_list").append(html);



				count = count + 1;

			});

		}

	});

}



function editbrand(id, hsn_code, statuss) {

	$("#myModalupdate").modal('show');

	$("#hsn_id").val(id);

	$("#update_hsn_code").val(hsn_code);

	$("#status").val(statuss);

}



function deletebrand(id, hsn_code) {

	xdialog.confirm('Are you sure want to delete?', function () {

		$.busyLoadFull("show");

		$.ajax({

			method: 'POST',

			url: 'delete_hsncode.php',

			data: { deletearray: id, hsn_code: hsn_code, code: code_ajax },

			success: function (response) {

				$.busyLoadFull("hide");

				if (response == 'Failed to Delete.') {

					successmsg("Failed to Delete.");

				} else if (response == 'Deleted') {

					$("#tr" + id).remove();

					successmsg("HSN Code Deleted Successfully.");

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





