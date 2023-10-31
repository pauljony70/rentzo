var code_ajax = $("#code_ajax").val();
var parentvalue = 0;



function getCategory(parentvalue) {
	$.busyLoadFull("show");
	//  successmsg( "sdfs" );
	var count = 1;
	$.ajax({
		method: 'POST',
		url: 'get_category_data.php',
		data: {
			code: code_ajax,
			parentid: parentvalue
		},
		success: function (response) {
			$.busyLoadFull("hide");
			var parsedJSON = JSON.parse(response);

			var data = parsedJSON.subcat;
			//   successmsg("data size "+data.length);
			var order = data.length;

			var count = 1;
			if (order != 0) {
				$("#cat_list").empty();
				$(data).each(function () {
					var btnactive = "";
					if (this.statuss == "0") {
						btnactive = '<span  class = "Pending">' + "Pending" + '</span>';
					} else if (this.statuss == "1") {
						btnactive = '<span  class = "Active">' + "Active " + '</span>';
					} else if (this.statuss == "3") {
						btnactive = '<span class = "Deactive">' + "Deactive" + '</span>';
					}
					var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td>' + this.orderno + '</td><td><img src="' + this.img + '" style="width: 72px; height: 72px;"></td><td> ' + this.name + '</td><td> ' + btnactive + '</td>';
					html += '<td> ';
					if (this.parent_count > 0) {
						html += '<button type="submit" class= "btn btn-danger btn-sm pull-left" id="sub_cat_btn" onclick="getCategoryclick(' + this.id + ');">View sub category</button>';
					} else {
						html += '<button type="submit" class= "btn btn-danger btn-sm pull-left" id="sub_cat_btn" onclick="successmsg(\'There is no sub category. Please create new one.\');">View sub category</button>';
					}

					html += '</td></tr>';
					$("#cat_list").append(html);

					count = count + 1;
				});

			} else {

			}
		}
	});
}


function getCategoryclick(parentvalue) {
	$.busyLoadFull("show");
	//  successmsg( "sdfs" );
	var count = 1;
	$.ajax({
		method: 'POST',
		url: 'get_category_data.php',
		data: {
			code: code_ajax,
			parentid: parentvalue
		},
		success: function (response) {
			$.busyLoadFull("hide");
			var parsedJSON = JSON.parse(response);

			var data = parsedJSON.subcat;
			//   successmsg("data size "+data.length);
			var order = data.length;

			var count = 1;
			if (order != 0) {
				$("#cat_list").empty();
				$(data).each(function () {
					var btnactive = "";
					if (this.statuss == "0") {
						btnactive = '<span  class = "Pending">' + "Pending" + '</span>';
					} else if (this.statuss == "1") {
						btnactive = '<span  class = "Active">' + "Active " + '</span>';
					} else if (this.statuss == "3") {
						btnactive = '<span class = "Deactive">' + "Deactive" + '</span>';
					}
					var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td>' + this.orderno + '</td><td><img src="' + this.img + '" style="width: 72px; height: 72px;"></td><td> ' + this.name + '</td><td> ' + btnactive + '</td>';
					html += '<td> ';
					if (this.parent_count > 0) {
						html += '<button type="submit" class= "btn btn-danger btn-sm pull-left" id="sub_cat_btn" onclick="getCategoryclick(' + this.id + ');">View sub category</button>';
					} else {
						html += '<button type="submit" class= "btn btn-danger btn-sm pull-left" id="sub_cat_btn" onclick="successmsg(\'There is no sub category. Please create new one.\');">View sub category</button>';
					}

					html += '</td></tr>';
					$("#cat_list").append(html);

					count = count + 1;
				});
				$("#last_cat").val(parentvalue);
				if (parentvalue != 0) { $("#li" + parentvalue).remove(); }
				$("#category_bradcumb").append('<li class="breadcrumb-item" id="li' + parentvalue + '" onclick="getCategory_bradcumb(' + parentvalue + ')">' + parsedJSON.parentv + '</li>');
			} else {

			}
		}
	});
}


function getCategory_bradcumb(parentvalue) {
	$.busyLoadFull("show");
	$("#last_cat").val(parentvalue);
	$("#li" + parentvalue).nextAll().remove();
	//  successmsg( "sdfs" );
	var count = 1;
	$.ajax({
		method: 'POST',
		url: 'get_category_data.php',
		data: {
			code: code_ajax,
			parentid: parentvalue
		},
		success: function (response) {
			$.busyLoadFull("hide");
			var parsedJSON = JSON.parse(response);

			var data = parsedJSON.subcat;
			//   successmsg("data size "+data.length);
			var order = data.length;

			var count = 1;
			if (order != 0) {
				$("#cat_list").empty();
				$(data).each(function () {
					var btnactive = "";
					if (this.statuss == "0") {
						btnactive = '<span  class = "Pending">' + "Pending" + '</span>';
					} else if (this.statuss == "1") {
						btnactive = '<span  class = "Active">' + "Active " + '</span>';
					} else if (this.statuss == "3") {
						btnactive = '<span class = "Deactive">' + "Deactive" + '</span>';
					}
					var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td>' + this.orderno + '</td><td><img src="' + this.img + '" style="width: 72px; height: 72px;"></td><td> ' + this.name + '</td><td> ' + btnactive + '</td>';
					html += '<td> ';
					if (this.parent_count > 0) {
						html += '<button type="submit" class= "btn btn-danger btn-sm pull-left" id="sub_cat_btn" onclick="getCategoryclick(' + this.id + ');">View sub category</button>';
					} else {
						html += '<button type="submit" class= "btn btn-danger btn-sm pull-left" id="sub_cat_btn" onclick="successmsg(\'There is no sub category. Please create new one.\');">View sub category</button>';
					}
					html += '</td></tr>';
					$("#cat_list").append(html);

					count = count + 1;
				});
			} else {

			}
		}
	});
}




$(document).ready(function () {
	getCategory(0);


	$("#add_category_btn").click(function (event) {
		event.preventDefault();

		var parent_cat = $(".check_category_limit:radio:checked").val();
		var namevalue = $('#name').val();
		var name_ar = $('#name').val();
		var cat_image = $('#cat_image').val();
		var valid = 'no';

		if ($("#make_parent_cat").prop('checked') == true) {
			var make_parent = 'yes';
			var valid = 'yes';
		} else {
			if ($('.check_category_limit:radio:checked').length == 0) {
				successmsg("Please select Parent Category");
			} else {
				var valid = 'yes';
			}
			var make_parent = 'no';
		}

		if (!namevalue) {
			successmsg("Please enter Category Name");
		} else
			if (!cat_image) {
				successmsg("Please select Category Image");
			} else

				if (namevalue && cat_image && valid == 'yes' && name_ar) {
					$.busyLoadFull("show");
					var file_data = $('#cat_image').prop('files')[0];
					var form_data = new FormData();
					form_data.append('file', file_data);
					form_data.append('parent_cat', parent_cat);
					form_data.append('namevalue', namevalue);
					form_data.append('make_parent', make_parent);
					form_data.append('code', code_ajax);
					form_data.append('name_ar', name_ar);
					$.ajax({
						method: 'POST',
						url: 'add_category_process.php',
						data: form_data,
						contentType: false,
						processData: false,
						success: function (response) {
							$.busyLoadFull("hide");
							successmsg(response);
							$("#li0").nextAll().remove();
							$("#myModal").modal('hide');
							var parentvalue = $("#last_cat").val();
							getCategoryclick(parentvalue);
							$('#name').val('');
							$('#cat_image').val('');
						}
					});
				}

	});

	$("#add_categogy_btn").click(function () {
		// $.busyLoadFull("show");
		var form_data = new FormData();

		form_data.append('get_category', 'yes');
		form_data.append('code', code_ajax);

		$.ajax({
			method: 'POST',
			url: 'get_category_data.php',
			data: form_data,
			contentType: false,
			processData: false,
			success: function (response) {
				//	removeloader();
				$("#new_cat_div").html(response);
				$("#myModal").modal('show');
			}
		});
	});


});


