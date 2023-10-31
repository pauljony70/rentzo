var code_ajax = $("#code_ajax").val();
var pageno = 1;
var rowno = 0;


function getOfferProducts(pagenov) {
	$.busyLoadFull("show");
	var perpage = $('#perpage').val();
	// successmsg( "sdfs" );
	var count = 1;
	$.ajax({
		method: 'POST',
		url: 'get_offer_product_data.php',
		data: {
			code: code_ajax,
			page: pagenov,
			rowno: 0,
			perpage: perpage,
			offer: 1
		},
		success: function (response) {
			$.busyLoadFull("hide");
			var parsedJSON = $.parseJSON(response);
			$("#cat_list").empty();

			$("#totalrowvalue").html(parsedJSON["totalrowvalue"]);
			$(".page_div").html(parsedJSON["page_html"]);

			var data = parsedJSON.tbl_html;
			$(data).each(function (index) {
				var btnactive = "";
				if (this.offer_status == "Active") {
					btnactive = `<div class="badge badge-soft-success badge-pill font-13"><b>${this.offer_status}</b></div>`;
				} else if (this.offer_status == "Inactive") {
					btnactive = `<div class="badge badge-soft-danger badge-pill font-13"><b>${this.offer_status}</b></div>`;
				} else if (this.offer_status == "Not Started") {
					btnactive = `<div class="badge badge-soft-warning badge-pill font-13"><b>${this.offer_status}</b></div>`;
				}
				var html =
					`<tr id="tr${this.product_unique_id}">
						<td><input class="product-id-check" type="checkbox" name="product_ids[]" value="${this.product_unique_id}"></td>
						<td>${++index}</td>
						<td><img src="${this.featured_img}" style="height: 72px;"></td>
						<td>${this.product_unique_id}</td>
						<td>${this.prod_name}</td>
						<td>${this.offer_start_date}</td>
						<td>${this.offer_end_date}</td>
						<td>${btnactive}</td>
					</tr>`;

				$("#cat_list").append(html);
			});
		}
	});
}


function formatProduct(product) {
	if (!product.id) {
		return product.text;
	}
	const productId = product.id;
	const productTitle = product.text;
	const $product = $(
		`<div class="d-flex align-items-center"><img src="${product.Poster}" class="product-image" /><div class="product-title">${productTitle} (${productId})</div></div>`
	);
	return $product;
}

$(document).ready(function () {
	getOfferProducts(pageno, rowno);

	$("#add_offer_btn").click(function (event) {
		event.preventDefault();

		var start_date = $('#start_date').val();
		var end_date = $('#end_date').val();
		var product_ids = $('#select2-remote-data').val();

		if (!start_date) {
			successmsg("Please select start date");
		} else if (!end_date) {
			successmsg("Please select end date");
		} else if (!product_ids) {
			successmsg("Please select products");
		} else {
			if (start_date && end_date && product_ids) {
				$.busyLoadFull("show");
				var form_data = new FormData();
				form_data.append('code', code_ajax);
				form_data.append('start_date', start_date);
				form_data.append('end_date', end_date);
				form_data.append('product_ids', product_ids);

				$.ajax({
					method: 'POST',
					url: 'update_offers.php',
					data: form_data,
					contentType: false,
					processData: false,
					success: function (response) {
						var parsedJSON = $.parseJSON(response);
						$.busyLoadFull("hide");
						$("#myModal").modal('hide');
						$('#start_date').val('');
						$('#end_date').val('');
						$('#select2-remote-data').val(null).trigger('change');
						getOfferProducts(1, 0);
						successmsg(parsedJSON.message);
					}
				});
			}
		}
	});

	$("#searchName").click(function (event) {
		event.preventDefault();
		var search_namevalue = $('#search_name').val();
		var perpage = $('#perpage').val();

		if (search_namevalue == "" || search_namevalue == null) {
			successmsg("Please enter search text");
		} else {
			$.busyLoadFull("show");
			$.ajax({
				method: 'POST',
				url: 'get_offer_product_data.php',
				data: {
					code: code_ajax,
					page: 1,
					rowno: 0,
					perpage: perpage,
					prod_name: search_namevalue,
					offer: 1
				},
				success: function (response) {
					$.busyLoadFull("hide");
					var parsedJSON = $.parseJSON(response);
					$("#cat_list").empty();

					$("#totalrowvalue").html(parsedJSON["totalrowvalue"]);
					$(".page_div").html(parsedJSON["page_html"]);

					var data = parsedJSON.tbl_html;
					if (data.length > 0) {
						$(data).each(function (index) {
							var btnactive = "";
							if (this.offer_status == "Active") {
								btnactive = `<div class="badge badge-soft-success badge-pill font-13"><b>${this.offer_status}</b></div>`;
							} else if (this.offer_status == "Inactive") {
								btnactive = `<div class="badge badge-soft-danger badge-pill font-13"><b>${this.offer_status}</b></div>`;
							} else if (this.offer_status == "Not Started") {
								btnactive = `<div class="badge badge-soft-warning badge-pill font-13"><b>${this.offer_status}</b></div>`;
							}
							var html =
								`<tr id="tr${this.product_unique_id}">
								<td><input class="product-id-check" type="checkbox" name="product_ids[]" value="${this.product_unique_id}"></td>
								<td>${++index}</td>
								<td><img src="${this.featured_img}" style="height: 72px;"></td>
								<td>${this.product_unique_id}</td>
								<td>${this.prod_name}</td>
								<td>${this.offer_start_date}</td>
								<td>${this.offer_end_date}</td>
								<td>${btnactive}</td>
							</tr>`;

							$("#cat_list").append(html);
						});
					} else {
						successmsg("No product found. Please try again");
					}
				}
			});

		}

	});

	$('#select2-remote-data').select2({
		placeholder: 'Search for products...',
		minimumInputLength: 1,
		closeOnSelect: false,
		multiple: true,
		escapeMarkup: function (m) {
			return m;
		},
		allowClear: false,
		ajax: {
			method: 'POST',
			url: 'get_offer_product_data.php',
			dataType: 'json',
			dataType: 'json',
			delay: 250,
			data: function (params) {
				return {
					code: code_ajax,
					prod_name: params.term,
					page: 1,
					rowno: 0,
					perpage: 100,
					offer: 0
				}
			},
			processResults: function (data, params) {
				if (data.status) {
					return {
						results: data.tbl_html.map(function (product) {
							return {
								id: product.product_unique_id,
								text: product.prod_name,
								Poster: product.featured_img
							};
						})
					};
				} else {
					return {
						results: []
					};
				}
			},
			cache: true
		},
		templateResult: formatProduct,
		templateSelection: function (selectedProduct) {
			return selectedProduct.text;
		},
	});

	$('#start_date').flatpickr({
		weekStart: 0,
		enableTime: true,
		dateFormat: "Y-m-d H:i",
		minDate: "today",
	});
	$('#end_date').flatpickr({
		weekStart: 0,
		enableTime: true,
		dateFormat: "Y-m-d H:i",
		minDate: "today",
	});

	$("#select-all").click(function () {
		if (this.checked) {
			$('.product-id-check').prop('checked', true);
			$('.delete-btn').prop("disabled", false);
		} else {
			$('.product-id-check').prop('checked', false);
			$('.delete-btn').prop("disabled", true);
		}
	});

	$(document).on('click', '.product-id-check', function () {
		var checkbox = $(".product-id-check");
		$('#select-all').prop('checked', false);
		if (checkbox.length == checkbox.filter(":checked").length) {
			$('#select-all').prop('checked', true);
		}
		if (checkbox.filter(":checked").length >= 1) {
			// $('#generate_btn').prop("disabled", false);
			$('.delete-btn').prop("disabled", false);
		} else {
			// $('#generate_btn').prop("disabled", true);
			$('.delete-btn').prop("disabled", true);
		}
	});

	$('.delete-btn').click(function () {
		var checkedValues = [];
		$(".product-id-check:checked").each(function () {
			checkedValues.push($(this).val());
		});

		$.busyLoadFull("show");
		var form_data = new FormData();
		form_data.append('code', code_ajax);
		form_data.append('product_ids', checkedValues);

		$.ajax({
			method: 'POST',
			url: 'update_offers.php',
			data: form_data,
			contentType: false,
			processData: false,
			success: function (response) {
				var parsedJSON = $.parseJSON(response);
				$.busyLoadFull("hide");
				$('#select-all').prop('checked', false);
				getOfferProducts(1, 0);
				successmsg(parsedJSON.message);
			}
		});
	});
});