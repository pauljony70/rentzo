var code_ajax = $("#code_ajax").val();
var parentvalue = 0;

function add_banner_full_width(section1_image, section1_link, section1_type) {
	$("#myModalsection1").modal('show');
	$("#banner_link").val(section1_link);
	$("#banner_type").val(section1_type);
	$("#banner_section").val('section1');
	console.log(section1_link);
	console.log(section1_type);
}

function add_banner_section2(section1_link, section1_type) {
	$("#myModalsection1").modal('show');
	$("#banner_link").val(section1_link);
	$("#banner_type").val(section1_type);
	$("#banner_section").val('section2');
}

function add_banner_section3(type) {
	$("#myModal").modal('show');
	$("#bannerprod_type").val(type);
	$("#banner_section").val('section3');
}
function add_banner_section4(section1_link, section1_type) {
	$("#myModalsection1").modal('show');
	$("#banner_link").val(section1_link);
	$("#banner_type").val(section1_type);
	$("#banner_section").val('section4');
} function add_banner_section10(section1_link, section1_type) {
	$("#myModalsection1").modal('show');
	$("#banner_link").val(section1_link);
	$("#banner_type").val(section1_type);
	$("#banner_section").val('section10');
} function add_banner_section11(section1_link, section1_type) {
	$("#myModalsection1").modal('show');
	$("#banner_link").val(section1_link);
	$("#banner_type").val(section1_type);
	$("#banner_section").val('section11');
} function add_banner_section12(section1_link, section1_type) {
	$("#myModalsection1").modal('show');
	$("#banner_link").val(section1_link);
	$("#banner_type").val(section1_type);
	$("#banner_section").val('section12');
}

function add_banner_section6(section1_link, section1_type) {
	$("#myModalsection1").modal('show');
	$("#banner_link").val(section1_link);
	$("#banner_type").val(section1_type);
	$("#banner_section").val('section6');
}

function add_banner_section5(section1_link, section1_type, cat_id) {
	$("#myModalcat").modal('show');
	$("#banner_linkcat").val(section1_link);
	$("#banner_typecat").val(section1_type);
	$("#banner_sectioncat").val('section5');
	$("#cat" + cat_id).prop('checked', true);
}

function add_banner_section8(section1_img, section1_link, section1_type) {
	$("#myModalsection1").modal('show');
	$("#banner_link").val(section1_link);
	$("#banner_type").val(section1_type);
	$("#banner_section").val('section8');
}
function add_banner_section7(type) {
	$("#myModal").modal('show');
	$("#bannerprod_type").val(type);
	$("#banner_section").val('section7');
}

function add_section_title(type) {
	$("#myModaltitle").modal('show');
	$("#bannersection_type").val(type);
	$("#section_title").val();
}
function add_banner_section_four_banner(link, type) {
	$("#myModalsection1").modal('show');
	$("#banner_link").val(link);
	$("#banner_type").val(type);
	$("#banner_section").val('section_four_banner');
}

$(document).ready(function () {

	$("#add_banner_btn").click(function (event) {
		event.preventDefault();

		var banner_link = $('#banner_link').val();
		var banner_image = $('#banner_image').val();
		var banner_section = $('#banner_section').val();
		var banner_type = $('#banner_type').val();

		var valid = 'no';
		if (!banner_link) {
			successmsg("Please enter banner link");
		} else if (!banner_image) {
			successmsg("Please select Banner Image");
		} else {
			$.busyLoadFull("show");
			var file_data = $('#banner_image').prop('files')[0];
			var form_data = new FormData();
			form_data.append('banner_image', file_data);
			form_data.append('banner_link', banner_link);
			form_data.append('banner_section', banner_section);
			form_data.append('banner_type', banner_type);

			form_data.append('code', code_ajax);

			$.ajax({
				method: 'POST',
				url: 'add_new_homebanners_process.php',
				data: form_data,
				contentType: false,
				processData: false,
				success: function (response) {
					$.busyLoadFull("hide");
					successmsg(response);
					$("#myModalsection1").modal('hide');
					location.reload();

				}
			});
		}

	});

	$("#add_catbanner_btn").click(function (event) {
		event.preventDefault();

		var banner_link = $('#banner_linkcat').val();
		var banner_image = $('#banner_imagecat').val();
		var banner_section = $('#banner_sectioncat').val();
		var banner_type = $('#banner_typecat').val();
		var parent_cat = $(".check_category_limit:radio:checked").val();

		var valid = 'no';
		if (!parent_cat) {
			successmsg("Please select category");
		}/*else if(!banner_link){
				successmsg("Please enter banner link");
			}*/else if (!banner_image) {
			successmsg("Please select Banner Image");
		} else {
			$.busyLoadFull("show");
			var file_data = $('#banner_imagecat').prop('files')[0];
			var form_data = new FormData();
			form_data.append('banner_image', file_data);
			form_data.append('banner_link', banner_link);
			form_data.append('banner_section', banner_section);
			form_data.append('banner_type', banner_type);
			form_data.append('parent_cat', parent_cat);

			form_data.append('code', code_ajax);

			$.ajax({
				method: 'POST',
				url: 'add_new_homebanners_process.php',
				data: form_data,
				contentType: false,
				processData: false,
				success: function (response) {
					$.busyLoadFull("hide");
					successmsg(response);
					$("#myModalsection1").modal('hide');
					location.reload();

				}
			});
		}

	});


});


// AJAX call for autocomplete 
$(document).ready(function () {

	$("#search-box").keyup(function () {
		$.ajax({
			type: "POST",
			url: "add_home_banner_process.php",
			data: 'keyword=' + $(this).val(),
			beforeSend: function () {
				$("#search-box").css("background", "#FFF url(LoaderIcon.gif) no-repeat 165px");
			},
			success: function (data) {
				$("#suggesstion-box").show();
				$("#suggesstion-box").html(data);
				$("#search-box").css("background", "#FFF");
			}
		});
	});


	$("#add_product_btn").click(function (event) {
		event.preventDefault();

		var product_id = $("#product-id").val();
		var bannerprod_type = $("#bannerprod_type").val();

		if (!product_id) {
			successmsg("Please select Product");
		} else {
			$.busyLoadFull("show");
			var form_data = new FormData();
			form_data.append('product_id', product_id);
			form_data.append('code', code_ajax);
			form_data.append('bannerprod_type', bannerprod_type);

			$.ajax({
				method: 'POST',
				url: 'newhomepage_website.php',
				data: form_data,
				contentType: false,
				processData: false,
				success: function (response) {
					$.busyLoadFull("hide");
					$("#myModal").modal('hide');
					$("#product-id").val('');
					$("#search-box").val('');
					successmsg(response);
					location.reload();
				}
			});
		}

	});
	
	
	$("#add_title_btn").click(function (event) {
		event.preventDefault();

		var bannersection_type = $("#bannersection_type").val();
		var section_title = $("#section_title").val();

		if (!section_title) {
			successmsg("Please Add Title");
		} else {
			$.busyLoadFull("show");
			var form_data = new FormData();
			form_data.append('section_title', section_title);
			form_data.append('code', code_ajax);
			form_data.append('bannersection_type', bannersection_type);

			$.ajax({
				method: 'POST',
				url: 'newhomepage_website.php',
				data: form_data,
				contentType: false,
				processData: false,
				success: function (response) {
					$.busyLoadFull("hide");
					$("#myModaltitle").modal('hide');
					$("#section_title").val('');
					successmsg(response);
					location.reload();
				}
			});
		}

	});
	
});


//To select product name
function selectCountry(val, id) {
	$("#search-box").val(val);
	$("#product-id").val(id);
	$("#suggesstion-box").hide();
}



function delete_products(product_id) {
	xdialog.confirm('Are you sure want to delete?', function () {
		$.busyLoadFull("show");
		$.ajax({
			method: 'POST',
			url: 'get_popular_product_data_home.php',
			data: {
				code: code_ajax,
				type: 'delete_popular_product',
				product_id: product_id
			},
			success: function (response) {
				$.busyLoadFull("hide");
				if (response == 'Failed to Delete.') {
					successmsg("Failed to Delete.");
				} else if (response == 'Deleted') {
					$("#popdiv" + product_id).remove();
					successmsg("Popular Product Deleted Successfully.");
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