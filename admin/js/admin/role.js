var code_ajax = $("#code_ajax").val();
var parentvalue = 0;



function editRoles(id) {
	if (id) {
		$.ajax({
			method: 'POST',
			url: 'get_role_data.php',
			data: { code: code_ajax, role_id: id, type: "roles_edit" },
			success: function (response) {
				$.busyLoadFull("hide");
				$("#update_category_form").html(response);
				$("#myModalupdate").modal('show');
			}
		});

	}

}

function deleteRoles(role_id) {

	xdialog.confirm('Are you sure want to delete?', function () {
		$.busyLoadFull("show");
		$.ajax({
			method: 'POST',
			url: 'get_role_data.php',
			data: { code: code_ajax, role_id: role_id, type: "delete" },
			success: function (response) {
				$.busyLoadFull("hide");
				if (response == 'Failed to Delete.') {
					successmsg("Failed to Delete.");
				} else if (response == 'Deleted') {
					$("#tr" + role_id).remove();
					successmsg("Role Deleted Successfully.");
					var parentvalue = $("#last_cat").val();
					getrolesclick(parentvalue);
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



function getroles() {
	$.busyLoadFull("show");
	//  successmsg( "sdfs" );
	var count = 1;
	$.ajax({
		method: 'POST',
		url: 'get_role_data.php',
		data: {
			code: code_ajax,
			type: "get"
		},
		success: function (response) {
			$.busyLoadFull("hide");
			var parsedJSON = JSON.parse(response);

			var data = parsedJSON.details;
			//   successmsg("data size "+data.length);
			var order = data.length;

			var count = 1;
			if (order != 0) {
				$("#cat_list").empty();
				$(data).each(function () {
					var btnactive = "";

					var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td>' + this.title + '</td><td> ' + this.premission + '</td>';
					html += '<td> ';

					html += '<button type="submit" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" name="delete" onclick="deleteRoles(' + this.id + ');">DELETE</button>';

					html += '<button  style=" margin-left: 10px;" type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'editRoles("' + this.id + '")\';>EDIT</button></td></tr>';
					$("#cat_list").append(html);

					count = count + 1;
				});

			} else {

			}
		}
	});
}







$(document).ready(function () {
	getroles();


	$("#add_role_btn").click(function (event) {
		event.preventDefault();

		var namevalue = $('#name').val();

		if (!namevalue) {
			successmsg("Please enter Role title");
		} else if ($('.premission:checkbox:checked').length == 0) {
			successmsg("Please select atleast one module");
		} else {
			$.busyLoadFull("show");

			var selected = new Array();

			$(".premission:checkbox:checked").each(function () {
				selected.push($(this).val());
			});
			var form_data = new FormData();

			form_data.append('namevalue', namevalue);
			form_data.append('modules', selected);
			form_data.append('code', code_ajax);
			form_data.append('type', "add");

			$.ajax({
				method: 'POST',
				url: 'get_role_data.php',
				data: form_data,
				contentType: false,
				processData: false,
				success: function (response) {
					$.busyLoadFull("hide");
					successmsg(response);
					getroles();
					$("#myModal").modal('hide');
					$('#name').val('');
					$(".premission").prop('checked', false);
				}
			});
		}

	});



});



function assign_role_btn() {
	var delete_role_id = $('#delete_role_id').val();
	var role_assign_id = $("#assign_role").val();

	if (delete_role_id && role_assign_id) {
		$.busyLoadFull("show");
		var form_data = new FormData();
		form_data.append('delete_role_id', delete_role_id);
		form_data.append('role_assign_id', role_assign_id);
		form_data.append('code', code_ajax);
		form_data.append('type', 'assign_role');

		$.ajax({
			method: 'POST',
			url: 'get_role_data.php',
			data: form_data,
			contentType: false,
			processData: false,
			success: function (response) {
				$.busyLoadFull("hide");
				if (response == 'done') {
					$("#tr" + delete_role_id).remove();
					successmsg("Role Deleted Successfully.");
					$("#myModalbrandassign").modal('hide');
				} else {
					successmsg("Please try again.");
				}
			}
		});
	} else {
		successmsg("Please select Role");
	}

}
