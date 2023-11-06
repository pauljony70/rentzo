var code_ajax = $("#code_ajax").val();
var parentvalue = 0;

function editCategory(id, order, statuss, count_order, parentid, cat_name_ar, sub_title, sub_title_ar) {
	var name = $("#names" + id).text();
	$("#cat_order").attr('max', (count_order - 1));
	$("#myModalupdate").modal('show');
	$("#cat_id_update").val(id);
	$("#update_name").val(name);
	$("#update_name_ar").val(cat_name_ar);
	$("#update_sub_title").val(sub_title);
	$("#update_sub_title_ar").val(sub_title_ar);
	$("#cat_order").val(order);
	$("#statuss").val(statuss);
	if (parentid == 0) {
		$(".catbanners").show();
	} else {
		$(".catbanners").hide();
		$('#web_banner').val('');
		$('#app_banner').val('');
	}

}

function deleteCategory(cat_id) {

	xdialog.confirm('Are you sure want to delete?', function () {
		$.busyLoadFull("show");
		$.ajax({
			method: 'POST',
			url: 'delete_category.php',
			data: { code: code_ajax, cat_id: cat_id },
			success: function (response) {
				$.busyLoadFull("hide");
				if (response == 'Failed to Delete.') {
					successmsg("Failed to Delete.");
				} else if (response == 'Deleted') {
					$("#tr" + cat_id).remove();
					successmsg("Category Deleted Successfully.");
					var parentvalue = $("#last_cat").val();
					getCategoryclick(parentvalue);
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
					if (this.img) {
						var img1 = '<img src="' + this.img + '" style="height: 72px;">';
					} else { var img1 = '-'; }

					if (this.web_banner) {
						var img2 = '<img src="' + this.web_banner + '" style="height: 72px;">';
					} else { var img2 = '-'; }

					if (this.app_banner) {
						var img3 = '<img src="' + this.app_banner + '" style="height: 72px;">';
					} else { var img3 = '-'; }

					var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td>' + this.orderno + '</td><td>' + img1 + '</td><td>' + img2 + '</td><td>' + img3 + '</td><td> ' + this.name + '</td><td> ' + btnactive + '</td>';
					html += '<td> <div class="dropdown"> <button class="btn btn-dark waves-effect waves-light dropdown-toggle w-100" type="button" data-toggle="dropdown">Select<span class="caret"></span></button> <div class="dropdown-menu dropdown-menu-right">';
					if (this.parent_count > 0) {
						html += '<a id="sub_cat_btn" class="dropdown-item" href="javascript: void(0);" onclick="getCategoryclick(' + this.id + ');"><i class="fa fa-eye"></i> View sub category</a>';
					} else {
						html += '<a id="sub_cat_btn" class="dropdown-item" href="javascript: void(0);" onclick="successmsg(\'There is no sub category. Please create new one.\');"><i class="fa fa-eye"></i> View sub category</button>';
					}

					html += '<a class="dropdown-item" name="delete" href="javascript: void(0);" onclick="deleteCategory(' + this.id + ');"><i class="fa fa-trash"></i> Delete</a>';

					html += '<a href="javascript: void(0);" class="dropdown-item" name="edit" onclick=\'editCategory("' + this.id + '","' + this.orderno + '","' + this.statuss + '","' + this.count_order + '","' + this.parentid + '","' + this.cat_name_ar + '","' + this.sub_title + '", "' + this.sub_title_ar + '")\';><i class="fa fa-edit"></i> Edit</a><span id="names' + this.id + '"  style="display:none">' + this.name + '</span>';

					html += '</div></div></td></tr>';

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
					if (this.img) {
						var img1 = '<img src="' + this.img + '" style="height: 72px;">';
					} else { var img1 = '-'; }

					if (this.web_banner) {
						var img2 = '<img src="' + this.web_banner + '" style="height: 72px;">';
					} else { var img2 = '-'; }

					if (this.app_banner) {
						var img3 = '<img src="' + this.app_banner + '" style="height: 72px;">';
					} else { var img3 = '-'; }

					var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td>' + this.orderno + '</td><td>' + img1 + '</td><td>' + img2 + '</td><td>' + img3 + '</td><td> ' + this.name + '</td><td> ' + btnactive + '</td>';
					html += '<td> <div class="dropdown"> <button class="btn btn-dark waves-effect waves-light dropdown-toggle w-100" type="button" data-toggle="dropdown">Select<span class="caret"></span></button> <div class="dropdown-menu dropdown-menu-right">';

					if (this.parent_count > 0) {
						html += '<a id="sub_cat_btn" class="dropdown-item" href="javascript: void(0);" onclick="getCategoryclick(' + this.id + ');"><i class="fa fa-eye"></i> View sub category</a>';
					} else {
						html += '<a id="sub_cat_btn" class="dropdown-item" href="javascript: void(0);" onclick="successmsg(\'There is no sub category. Please create new one.\');"><i class="fa fa-eye"></i> View sub category</button>';
					}

					html += '<a class="dropdown-item" name="delete" href="javascript: void(0);" onclick="deleteCategory(' + this.id + ');"><i class="fa fa-trash"></i> Delete</a>';

					html += '<a href="javascript: void(0);" class="dropdown-item" name="edit" onclick=\'editCategory("' + this.id + '","' + this.orderno + '","' + this.statuss + '","' + this.count_order + '","' + this.parentid + '","' + this.cat_name_ar + '","' + this.sub_title + '", "' + this.sub_title_ar + '")\';><i class="fa fa-edit"></i> Edit</a><span id="names' + this.id + '"  style="display:none">' + this.name + '</span>';

					html += '</div></div></td></tr>';

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
					if (this.img) {
						var img1 = '<img src="' + this.img + '" style="height: 72px;">';
					} else { var img1 = '-'; }

					if (this.web_banner) {
						var img2 = '<img src="' + this.web_banner + '" style="height: 72px;">';
					} else { var img2 = '-'; }

					if (this.app_banner) {
						var img3 = '<img src="' + this.app_banner + '" style="height: 72px;">';
					} else { var img3 = '-'; }

					var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td>' + this.orderno + '</td><td>' + img1 + '</td><td>' + img2 + '</td><td>' + img3 + '</td><td> ' + this.name + '</td><td> ' + btnactive + '</td>';
					html += '<td> <div class="dropdown"> <button class="btn btn-dark waves-effect waves-light dropdown-toggle w-100" type="button" data-toggle="dropdown">Select<span class="caret"></span></button> <div class="dropdown-menu dropdown-menu-right">';

					if (this.parent_count > 0) {
						html += '<a id="sub_cat_btn" class="dropdown-item" href="javascript: void(0);" onclick="getCategoryclick(' + this.id + ');"><i class="fa fa-eye"></i> View sub category</a>';
					} else {
						html += '<a id="sub_cat_btn" class="dropdown-item" href="javascript: void(0);" onclick="successmsg(\'There is no sub category. Please create new one.\');"><i class="fa fa-eye"></i> View sub category</button>';
					}

					html += '<a class="dropdown-item" name="delete" href="javascript: void(0);" onclick="deleteCategory(' + this.id + ');"><i class="fa fa-trash"></i> Delete</a>';

					html += '<a href="javascript: void(0);" class="dropdown-item" name="edit" onclick=\'editCategory("' + this.id + '","' + this.orderno + '","' + this.statuss + '","' + this.count_order + '","' + this.parentid + '","' + this.cat_name_ar + '","' + this.sub_title + '", "' + this.sub_title_ar + '")\';><i class="fa fa-edit"></i> Edit</a><span id="names' + this.id + '"  style="display:none">' + this.name + '</span>';

					html += '</div></div></td></tr>';

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
		var name_ar = '';
		var sub_title = $('#sub_title').val();
		var sub_title_ar = '';
		var cat_image = $('#cat_image').val();
		//var commission_fees = $('#commission_fees').val();
		//var web_banner = $('#web_banner').val();
		//var app_banner = $('#app_banner').val();

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

		if (valid == 'no') {

		} else if (!namevalue) {
			successmsg("Please enter Category Name (ENG)");
		} else if (!sub_title) {
			successmsg("Please enter Sub Title (ENG)");
		} 
		/*else if(!commission_fees){
				successmsg("Please enter Commission fees");
			}else if(isNaN(commission_fees)){
				successmsg("Commission fees should be numeric");
			}*/
		else if (!cat_image) {
			successmsg("Please select Category Image");
		} else {
			$.busyLoadFull("show");
			var file_data = $('#cat_image').prop('files')[0];
			var web_banner = $('#web_banner').prop('files')[0];
			var app_banner = $('#app_banner').prop('files')[0];
			var form_data = new FormData();
			form_data.append('file', file_data);
			form_data.append('web_banner', web_banner);
			form_data.append('app_banner', app_banner);
			form_data.append('parent_cat', parent_cat);
			form_data.append('namevalue', namevalue);
			form_data.append('name_ar', name_ar);
			form_data.append('sub_title', sub_title);
			form_data.append('sub_title_ar', sub_title_ar);
			form_data.append('make_parent', make_parent);
			//form_data.append('commission_fees', commission_fees);
			form_data.append('code', code_ajax);

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
					$('#name_ar').val('');
					$('#sub_title').val('');
					$('#sub_title_ar').val('');
					$('#cat_image').val('');
					$('#web_banner').val('');
					$('#app_banner').val('');
				}
			});
		}

	});

	$("#update_category_btn").click(function (event) {
		event.preventDefault();

		var cat_order = $("#cat_order").val();
		var namevalue = $('#update_name').val();
		var update_name_ar = '';
		var update_sub_title = $('#update_sub_title').val();
		var update_sub_title_ar = '';
		var cat_image = $('#cat_image_update').val();
		var statuss = $('#statuss').val();
		//var update_commission_fees = $('#update_commission_fees').val();
		var cat_id_update = $('#cat_id_update').val();

		if (!cat_order) {
			successmsg("Please select Parent Category");
		} else if (!namevalue) {
			successmsg("Please enter Category Name");
		} else if (!update_sub_title) {
			successmsg("Please enter Sub Title");
		} else if (!statuss) {
			successmsg("Please select Category status");
		}/*else if(!update_commission_fees){
				successmsg("Please enter Commission fees");
			}else if(isNaN(update_commission_fees)){
				successmsg("Commission fees should be numeric");
			}*/else {
			$.busyLoadFull("show");
			var file_data = $('#cat_image_update').prop('files')[0];
			var web_banner_update = $('#web_banner_update').prop('files')[0];
			var app_banner_update = $('#app_banner_update').prop('files')[0];

			var form_data = new FormData();
			form_data.append('file', file_data);
			form_data.append('app_banner', app_banner_update);
			form_data.append('web_banner', web_banner_update);
			form_data.append('namevalue', namevalue);
			form_data.append('update_name_ar', update_name_ar);
			form_data.append('sub_title', update_sub_title);
			form_data.append('sub_title_ar', update_sub_title_ar);
			form_data.append('statuss', statuss);
			form_data.append('cat_id_update', cat_id_update);
			form_data.append('cat_order', cat_order);
			//form_data.append('commission_fees', update_commission_fees);
			form_data.append('code', code_ajax);

			$.ajax({
				method: 'POST',
				url: 'edit_category_process.php',
				data: form_data,
				contentType: false,
				processData: false,
				success: function (response) {
					$.busyLoadFull("hide");
					successmsg(response);
					$("#myModalupdate").modal('hide');
					var parentvalue = $("#last_cat").val();
					getCategoryclick(parentvalue);
					$('#cat_image_update').val('');
					$('#web_banner_update').val('');
					$('#app_banner_update').val('');
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

function assign_brand_btn() {
	var delete_cat_id = $('#delete_cat_id').val();
	var cat_assign_id = $(".check_category_limit_assign:radio:checked").val();

	if (delete_cat_id && cat_assign_id) {
		$.busyLoadFull("show");
		var form_data = new FormData();
		form_data.append('delete_cat_id', delete_cat_id);
		form_data.append('cat_assign_id', cat_assign_id);
		form_data.append('code', code_ajax);

		$.ajax({
			method: 'POST',
			url: 'delete_category.php',
			data: form_data,
			contentType: false,
			processData: false,
			success: function (response) {
				removeloader();
				$("#tr" + delete_cat_id).remove();
				successmsg("Category Deleted Successfully.");
				$("#myModalbrandassign").modal('hide');
			}
		});
	} else {
		successmsg("Please select Category");
	}

}
