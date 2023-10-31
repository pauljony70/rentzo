var code_ajax = $("#code_ajax").val();
var pageno = 1;
var rowno = 0;


function get_email_template(pagenov, rownov) {
	$.busyLoadFull("show");
	var perpage = $('#perpage').val();
	// successmsg( "sdfs" );
	var count = 1;
	$.ajax({
		method: 'POST',
		url: 'get_email_template_data.php',
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

				var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.email_title + '</td><td > ' + this.email_subject + '</td>';
				// html += '<td> <button type="submit" class= "btn btn-danger btn-sm pull-left" name="delete" onclick="delete_records(' + this.id + ');">DELETE</button>';

				html += '<td><button type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'edit_records("' + this.id + '")\';>EDIT</button></td></tr>';
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
		url: 'get_email_template_data.php',
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

				var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.email_title + '</td><td > ' + this.email_subject + '</td>';
				//html += '<td> <button type="submit" class= "btn btn-danger btn-sm pull-left" name="delete" onclick="delete_records(' + this.id + ');">DELETE</button>';

				html += '<td><button type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'edit_records("' + this.id + '")\';>EDIT</button></td></tr>';
				$("#cat_list").append(html);

				count = count + 1;
			});
		}
	});
}


$(document).ready(function () {
	get_email_template(pageno, rowno);


	$("#add_template_btn").click(function (event) {
		event.preventDefault();

		var email_title = $('#email_title').val();
		var email_subject = $('#email_subject').val();
		var email_content = tinyMCE.get('email_content').getContent();

		if (!email_title) {
			successmsg("Please enter template title.");
		} else if (!email_subject) {
			successmsg("Please enter template title.");
		} else if (!email_content) {
			successmsg("Please enter template details.");
		} else if (email_content && email_title && email_subject) {
			$.busyLoadFull("show");
			var form_data = new FormData();
			form_data.append('email_title', email_title);
			form_data.append('email_subject', email_subject);
			form_data.append('email_content', email_content);
			form_data.append('type', 'add');
			form_data.append('code', code_ajax);

			$.ajax({
				method: 'POST',
				url: 'add_email_template_process.php',
				data: form_data,
				contentType: false,
				processData: false,
				success: function (response) {
					$.busyLoadFull("hide");
					$("#myModal").modal('hide');
					$('#email_title').val('');
					$('#email_subject').val('');
					$('#email_content').val('');
					get_email_template(1, 0)
					successmsg(response);

				}
			});
		}

	});

	$("#update_policy_btn").click(function (event) {
		event.preventDefault();

		var update_title = $('#update_title').val();
		var update_policy_content = tinyMCE.get('update_policy_content').getContent();
		var attribute_id = $('#attribute_id').val();
		var statuss = $('#status').val();

		if (!update_title) {
			successmsg("Please enter Title");
		}
		if (!update_policy_content) {
			successmsg("Please enter Policy");
		}

		if (!statuss) {
			successmsg("Please select status");
		}
		if (update_policy_content && update_title && statuss) {
			$.busyLoadFull("show");
			var form_data = new FormData();
			form_data.append('update_title', update_title);
			form_data.append('policy_content', update_policy_content);
			form_data.append('attribute_id', attribute_id);
			form_data.append('statuss', statuss);
			form_data.append('code', code_ajax);

			$.ajax({
				method: 'POST',
				url: 'edit_policy_process.php',
				data: form_data,
				contentType: false,
				processData: false,
				success: function (response) {
					$.busyLoadFull("hide");
					$("#myModalupdate").modal('hide');
					$('#update_country').val('');
					$('#update_policy_content').val('');
					$('#attribute_id').val('');
					var page = $(".pagination .active .current").text();
					get_email_template(page, 0)
					successmsg(response);

				}
			});
		}

	});

	if ($("#email_content").length > 0) {
		tinymce.init({
			selector: "textarea#email_content",
			theme: "modern",
			height: 300,
			plugins: [
				"advlist lists print",
				"wordcount code fullscreen",
				"save table directionality emoticons paste textcolor"
			],
			toolbar: " undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",

		});
	}


});



function perpage_filter() {
	$.busyLoadFull("show");
	var perpage = $('#perpage').val();
	// successmsg( "sdfs" );
	var count = 1;
	$.ajax({
		method: 'POST',
		url: 'get_email_template_data.php',
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

				var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.email_title + '</td><td > ' + this.email_subject + '</td>';
				// html += '<td> <button type="submit" class= "btn btn-danger btn-sm pull-left" name="delete" onclick="delete_records(' + this.id + ');">DELETE</button>';

				html += '<td><button type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'edit_records("' + this.id + '")\';>EDIT</button></td></tr>';
				$("#cat_list").append(html);

				count = count + 1;
			});



		}
	});
}

function edit_records(id) {
	location.href = "edit_email_template.php?id=" + id;
}

function delete_records(id) {
	xdialog.confirm('Are you sure want to delete?', function () {
		$.busyLoadFull("show");
		$.ajax({
			method: 'POST',
			url: 'get_email_template_data.php',
			data: { deletearray: id, code: code_ajax },
			success: function (response) {
				$.busyLoadFull("hide");
				if (response == 'Failed to Delete.') {
					successmsg("Failed to Delete.");
				} else if (response == 'Deleted') {
					$("#tr" + id).remove();
					successmsg("Email template deteled successfully.");
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






