var code_ajax = $("#code_ajax").val();
var pageno = 1;

function getTransactions(pagenov) {
	$.busyLoadFull("show");
	var perpage = $('#perpage').val();
	var user_id = $('#user_id').val();
	var search_namevalue = $('#search_name').val();
	var payment_type = $('#payment_type').val();
	var from_date = $('#from_date').val();
	var to_date = $('#to_date').val();
	$.ajax({
		method: 'POST',
		url: 'get_wallet_transactions.php',
		data: {
			code: code_ajax,
			page: pagenov,
			perpage: perpage,
			user_id: user_id,
			search_namevalue: search_namevalue,
			payment_type: payment_type,
			from_date: from_date,
			to_date: to_date
		},
		success: function (response) {
			$.busyLoadFull("hide");
			var parsedJSON = $.parseJSON(response);
			$("#cat_list").empty();
			$("#totalrowvalue").html(parsedJSON["totalrowvalue"]);
			$(".page_div").html(parsedJSON["page_html"]);

			var data = parsedJSON.data;
			$(data).each(function (index) {
				var orderDetails = "";
				if (this.order_id != null) {
					orderDetails =
						`<p class="mb-0 text-dark"><span class="text-dark font-weight-bold">Order ID: </span> ${this.order_id}</p>
						<p class="mb-0 text-dark"><span class="text-dark font-weight-bold">Product name: </span> ${this.prod_name} (${this.prod_id})</p>
						<p class="mb-0 text-dark"><span class="text-dark font-weight-bold">Order by: </span> ${this.order_by_name} (${this.order_by})</p>`;
				} else {
				}
				var html =
					`<tr id="tr${this.id}">
						<td>${((pagenov - 1) * perpage) + index + 1}</td>
						<td>
							<p class="mb-0 text-dark"><span class="text-dark font-weight-bold">Fullname: </span> ${this.fullname}</p>
							<p class="mb-0 text-dark"><span class="text-dark font-weight-bold">Phone: </span> ${this.phone}</p>
							<p class="mb-0 text-dark"><span class="text-dark font-weight-bold">Email: </span> ${this.email}</p>
						</td>
						<td>
							${orderDetails}
						</td>
						<td>
							<p class="mb-0 text-dark"><span class="text-dark font-weight-bold">Transaction ID: </span> ${this.transaction_id}</p>
							<p class="mb-0 text-dark"><span class="text-dark font-weight-bold">Transaction date: </span> ${moment(this.transaction_date).format('DD MMM, YYYY h:mm a')}</p>
						</td>
						<td>
							<div class="badge ${this.transaction_type == 'cr' ? 'badge-soft-success' : 'badge-soft-danger'} badge-pill font-13"><b>${this.transaction_type == 'cr' ? '+' : '-'} ${this.amount}</b></div>
						</td>
						<td>${this.remark}</td>
					</tr>`;
				$("#cat_list").append(html);
			});
		}
	});
}

$("#searchName").click(function(event) {
	event.preventDefault();
	getTransactions(1);
});


$(document).ready(function () {
	getTransactions(pageno);
	$(".select_data").select2();
	document.getElementsByClassName('select2-container--default')[0].classList.add('mr-1');
});