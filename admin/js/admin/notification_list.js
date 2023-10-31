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

		url: 'get_notification_list_data.php',

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

				var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.noti_title + '</td><td > ' + this.noti_body + '</td>';

				html += '<td> <button type="submit" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" name="delete" onclick="deletebrand(' + this.id + ');">DELETE</button></td></tr>';

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

		url: 'get_notification_list_data.php',

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

				var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.noti_title + '</td><td > ' + this.noti_body + '</td>';

				html += '<td> <button type="submit" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" name="delete" onclick="deletebrand(' + this.id + ');">DELETE</button></td></tr>';

				$("#cat_list").append(html);



				count = count + 1;

			});

		}

	});

}





$(document).ready(function () {

	getAttribute(pageno, rowno);

});







function perpage_filter() {

	$.busyLoadFull("show");

	var perpage = $('#perpage').val();

	// successmsg( "sdfs" );

	var count = 1;

	$.ajax({

		method: 'POST',

		url: 'get_notification_list_data.php',

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

				var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.noti_title + '</td><td > ' + this.noti_body + '</td>';

				html += '<td> <button type="submit" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" name="delete" onclick="deletebrand(' + this.id + ');">DELETE</button></td></tr>';

				$("#cat_list").append(html);



				count = count + 1;

			});

		}

	});

}



function editbrand(id, name, plan_value) {

	$("#myModalupdate").modal('show');

	$("#plan_id").val(id);

	$("#update_name").val(name);

	$("#update_plan_value").val(plan_value);

}



function deletebrand(id) {

	xdialog.confirm('Are you sure want to delete?', function () {

		$.busyLoadFull("show");

		$.ajax({

			method: 'POST',

			url: 'delete_notification.php',

			data: { deletearray: id, code: code_ajax },

			success: function (response) {

				$.busyLoadFull("hide");

				if (response == 'Failed to Delete.') {

					successmsg("Failed to Delete.");

				} else if (response == 'Deleted') {

					$("#tr" + id).remove();

					successmsg("Notification Deleted Successfully.");

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









