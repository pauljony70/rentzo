$(document).ready(function () {
  $(".minus").click(function () {
    var $input = $(this).parent().find("input");
    var count = parseInt($input.val()) - 1;
    count = count < 1 ? 1 : count;
    $input.val(count);
    $input.change();
    return false;
  });
  $(".plus").click(function () {
    var $input = $(this).parent().find("input");
    $input.val(parseInt($input.val()) + 1);
    $input.change();
    return false;
  });
});

var csrfName = $(".txt_csrfname").attr("name"); //
var csrfHash = $(".txt_csrfname").val(); // CSRF hash
var site_url = $(".site_url").val(); // CSRF hash

function delete_cart(prod_id, user_id, qouteid) {
  $.ajax({
    method: "post",
    url: site_url + "deleteProductCart",
    data: {
      language: default_language,
      pid: prod_id,
      devicetype: 2,
      user_id: user_id,
      qouteid: qouteid,
      [csrfName]: csrfHash,
    },
    success: function (response) {
      //hideloader();
      //$(".table").load(location.href + " .table");
      location.reload();
    },
  });
}
function add_product_qty(
  prod_id,
  sku,
  vendor_id,
  user_id,
  qty,
  referid,
  devicetype,
  qouteid
) {
  $.ajax({
    method: "post",
    url: site_url + "addProductCart",
    data: {
      language: default_language,
      pid: prod_id,
      sku: sku,
      sid: vendor_id,
      user_id: user_id,
      qty: qty,
      referid: referid,
      devicetype: 2,
      qouteid: qouteid,
      [csrfName]: csrfHash,
    },
    success: function (response) {
      //hideloader();
      //$(".table").load(location.href + " .table");
      //alert(response.msg);
      location.reload();
	  // Swal.fire({
			 // position: "center",
			 // title: response.msg,
			 // showConfirmButton: false,
			 // confirmButtonColor: '#ff5400',
			 // timer: 3000
		 // })
		 // setTimeout(function(){
		   // location.reload();
		// }, 2000);
	  
    },
  });
}
