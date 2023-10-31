var code_ajax = $("#code_ajax").val();
var pageno = 1;

function getBuyFromTurkeyOrders(pagenov) {
	$.busyLoadFull("show");
	var perpage = $('#perpage').val();
	$.ajax({
		method: 'POST',
		url: 'get_buy_from_turkey_orders.php',
		data: {
			code: code_ajax,
			page: pagenov,
			perpage: perpage
		},
		success: function (response) {
			$.busyLoadFull("hide");
			var parsedJSON = $.parseJSON(response);
			$("#cat_list").empty();
			$("#totalrowvalue").html(parsedJSON["totalrowvalue"]);
			$(".page_div").html(parsedJSON["page_html"]);

			var data = parsedJSON.data;
			$(data).each(function (index) {
				var btnactive = "";
				var btns = "";
				if (this.status == "requested") {
					btnactive = `<div class="badge badge-soft-warning badge-pill text-capitalize font-13"><b>${this.status}</b></div>`;
					btns =
						`<div class="dropdown">
							<button class="btn btn-dark waves-effect waves-light dropdown-toggle w-100" type="button" data-toggle="dropdown">Select<span class="caret"></span></button>
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item" href="place-other-country-order.php?id=${this.id}"><i class="fa fa-edit"></i> Place Order</a>
								<a class="dropdown-item" href="#" onclick="openrejectOrderModal('${this.id}', '${this.fullname}', '${this.phone}', '${this.email}', '${this.product_link}')"><i class="fa fa-trash"></i> Reject</a>
							</div>
						</div>`;
				} else if (this.status == "processed") {
					btnactive = `<div class="badge badge-soft-info badge-pill text-capitalize font-13"><b>${this.status}</b></div>`;
				} else if (this.status == "ordered") {
					btnactive = `<div class="badge badge-soft-success badge-pill text-capitalize font-13"><b>${this.status}</b></div>`;
					btns =
						`<div class="dropdown">
							<button class="btn btn-dark waves-effect waves-light dropdown-toggle w-100" type="button" data-toggle="dropdown">Select<span class="caret"></span></button>
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item" href="edit_other_country_order.php?orderid=${this.order_id}"><i class="fa fa-edit"></i> Edit Order</a>
							</div>
						</div>`;
				} else if (this.status == "rejected") {
					btnactive = `<div class="badge badge-soft-danger badge-pill text-capitalize font-13"><b>${this.status}</b></div>`;
				}
				var html =
					`<tr id="tr${this.id}">
						<td>${index + 1}</td>
						<td><img src="${this.product_img_1}" style="height: 72px;"></td>
						<td>
							<p class="mb-0 text-dark"><span class="text-dark font-weight-bold">Order ID: </span> ${this.order_id}</p>
							<p class="mb-0 text-dark"><span class="text-dark font-weight-bold">Order Date: </span> ${this.created_at}</p>
						</td>
						<td>
							<p class="mb-0 text-dark"><span class="text-dark font-weight-bold">Fullname: </span> ${this.fullname}</p>
							<p class="mb-0 text-dark"><span class="text-dark font-weight-bold">Phone: </span> ${this.phone}</p>
							<p class="mb-0 text-dark"><span class="text-dark font-weight-bold">Email: </span> ${this.email}</p>
						</td>
						<td>
							<p class="mb-0 text-dark"><span class="text-dark font-weight-bold">Product Size: </span> ${this.product_size}</p>
							<p class="mb-0 text-dark"><span class="text-dark font-weight-bold">Product Quantity: </span> ${this.product_quantity}</p>
							<p class="mb-0 text-dark"><span class="text-dark font-weight-bold">Product Colour: </span> ${this.product_color}</p>
						</td>
						<td>${this.product_des}</td>
						<td>${btnactive}</td>
						<td>${btns}</td>
					</tr>`;
				$("#cat_list").append(html);
			});
		}
	});
}

$(document).ready(function () {
	getBuyFromTurkeyOrders(pageno);
	$("#reject_order_btn").click(function (event) {
		event.preventDefault();

		var orderId = $('#order_id').val();
		var name = $('#name').val();
		var phone = $('#phone').val();
		var email = $('#email').val();
		xdialog.confirm('Are you sure to reject?', function () {
			$.busyLoadFull("show");
			$.ajax({
				method: 'POST',
				url: 'reject_other_country_orders.php',
				data: {
					code: code_ajax,
					order_id: orderId,
					name: name,
					phone: phone,
					email: email,
					message: tinymce.get("rejection_reason").getContent()
				},
				success: function (response) {
					var data = JSON.parse(response);
					$.busyLoadFull("show");
					if (data.status == 1) {
						$("#myModal").modal('hide');
						successmsg(data.message);
					} else {
						$("#myModal").modal('hide');
						successmsg(data.message);
					}
					perpage_filter();
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
	});
});

function perpage_filter() {
	$.busyLoadFull("show");
	var perpage = $('#perpage').val();
	$.ajax({
		method: 'POST',
		url: 'get_buy_from_turkey_orders.php',
		data: {
			code: code_ajax,
			page: 1,
			perpage: perpage
		},
		success: function (response) {
			$.busyLoadFull("hide");
			var parsedJSON = $.parseJSON(response);
			$("#cat_list").empty();


			$("#totalrowvalue").html(parsedJSON["totalrowvalue"]);
			$(".page_div").html(parsedJSON["page_html"]);

			var data = parsedJSON.data;
			$(data).each(function (index) {
				var btnactive = "";
				var btns = "";
				if (this.status == "requested") {
					btnactive = `<div class="badge badge-soft-warning badge-pill text-capitalize font-13"><b>${this.status}</b></div>`;
					btns =
						`<div class="dropdown">
							<button class="btn btn-dark waves-effect waves-light dropdown-toggle w-100" type="button" data-toggle="dropdown">Select<span class="caret"></span></button>
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item" href="place-other-country-order.php?id=${this.id}"><i class="fa fa-edit"></i> Place Order</a>
								<a class="dropdown-item" href="#" onclick="openrejectOrderModal('${this.id}', '${this.fullname}', '${this.phone}', '${this.email}', '${this.product_link}')"><i class="fa fa-trash"></i> Reject</a>
							</div>
						</div>`;
				} else if (this.status == "processed") {
					btnactive = `<div class="badge badge-soft-info badge-pill text-capitalize font-13"><b>${this.status}</b></div>`;
				} else if (this.status == "ordered") {
					btnactive = `<div class="badge badge-soft-success badge-pill text-capitalize font-13"><b>${this.status}</b></div>`;
					btns =
						`<div class="dropdown">
							<button class="btn btn-dark waves-effect waves-light dropdown-toggle w-100" type="button" data-toggle="dropdown">Select<span class="caret"></span></button>
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item" href="edit_other_country_order.php?orderid=${this.order_id}"><i class="fa fa-edit"></i> Edit Order</a>
							</div>
						</div>`;
				} else if (this.status == "rejected") {
					btnactive = `<div class="badge badge-soft-danger badge-pill text-capitalize font-13"><b>${this.status}</b></div>`;
				}
				var html =
					`<tr id="tr${this.id}">
						<td>${index + 1}</td>
						<td><img src="${this.product_img_1}" style="height: 72px;"></td>
						<td>
							<p class="mb-0 text-dark"><span class="text-dark font-weight-bold">Order ID: </span> ${this.order_id}</p>
							<p class="mb-0 text-dark"><span class="text-dark font-weight-bold">Order Date: </span> ${this.created_at}</p>
						</td>
						<td>
							<p class="mb-0 text-dark"><span class="text-dark font-weight-bold">Fullname: </span> ${this.fullname}</p>
							<p class="mb-0 text-dark"><span class="text-dark font-weight-bold">Phone: </span> ${this.phone}</p>
							<p class="mb-0 text-dark"><span class="text-dark font-weight-bold">Email: </span> ${this.email}</p>
						</td>
						<td>
							<p class="mb-0 text-dark"><span class="text-dark font-weight-bold">Product Size: </span> ${this.product_size}</p>
							<p class="mb-0 text-dark"><span class="text-dark font-weight-bold">Product Quantity: </span> ${this.product_quantity}</p>
							<p class="mb-0 text-dark"><span class="text-dark font-weight-bold">Product Colour: </span> ${this.product_color}</p>
						</td>
						<td>${this.product_des}</td>
						<td>${btnactive}</td>
						<td>${btns}</td>
					</tr>`;
				$("#cat_list").append(html);
			});
		}
	});
}

function openrejectOrderModal(id, name, phone, email, product_link) {
	$("#myModal").modal('show');
	$("#order_id").val(id);
	$("#name").val(name);
	$("#phone").val(phone);
	$("#email").val(email);
	var rejection_reason =
		`<p>We regret to inform you that your order for <a href="${product_link}" traget="_blank">[Product Name/Link]</a> has been canceled. We apologize for any inconvenience caused.</p>

		<p>Due to unforeseen circumstances, we are unable to fulfill your order at this time. We understand that this may be disappointing for you, and we sincerely apologize for any inconvenience caused.</p>
		
		<p>If you have already made a payment for the order, rest assured that a refund will be processed back to your original payment method. The refund should reflect in your account within [number of days].</p>
		
		<p>We value your patronage and hope that you will consider shopping with us again in the future. If you have any questions or need further assistance, please don't hesitate to reach out to our customer support team at [contact information].</p>
		
		<p>Once again, we apologize for any inconvenience this may have caused.</p>`;

	tinymce.get("rejection_reason").setContent(rejection_reason);
}

if ($("#rejection_reason")) {
	tinymce.init({
		selector: "textarea#rejection_reason",
		theme: "modern",
		height: 200,
		menubar: false,
		toolbar: "bold italic fontsizeselect link"
	});
}
