var csrfName = $(".txt_csrfname").attr("name"); //
var csrfHash = $(".txt_csrfname").val(); // CSRF hash
var site_url = $(".site_url").val(); // CSRF hash
var user_id = $("#user_id").val(); // CSRF hash
var recent_id = $("#recent_id").val(); // CSRF hash
$(function () {
  window.onload = get_home_bottom_banner();
  //window.onload = get_product_attributes();
  window.onload = recent_product_details(recent_id);
  window.onload = related_product();
  window.onload = upsell_product();
});

$(document).ready(function () {
  // Check Radio-box
  $(".rating input:radio").attr("checked", false);

  $(".rating input").click(function () {
    $(".rating span").removeClass("checked");
    $(this).parent().addClass("checked");
  });

  $("input:radio").change(function () {
    var userRating = this.value;
    //alert(userRating);
  });
});

function apply_city(event) {
  ///var total_value = $('#product-price').html();
  var city = $("#city option:selected").val();
  event.preventDefault();

  $.ajax({
    method: "post",
    url: site_url + "apply_city",
    data: { language: default_language, city_id: city, [csrfName]: csrfHash },
    success: function (response) {
      //hideloader();
      $("#city_time").html(
        "Estimated Delivery Time : " +
          response.Information.estimated_delivery_time
      );
	  $("#basic_fee").html(
        "Delivery Charges : " +
          response.Information.basic_fee
      );
      //alert(response.msg);
      //location.reload();
    },
  });
}

function apply_coupon(event) {
  ///var total_value = $('#product-price').html();
  var coupon_code = $("#coupon_code").val();
  var total_value = $("#product-price")
    .html()
    .replace(/[^0-9.]/gi, "");
  event.preventDefault();

  if (coupon_code != "") {
    $.ajax({
      method: "post",
      url: site_url + "apply_coupon",
      data: {
        language: default_language,
        coupon_code: coupon_code,
        price: total_value,
        [csrfName]: csrfHash,
      },
      success: function (response) {
        if (response.status == 1) {
          var total_value = $("#product-price").html(
            response.Information.coupon_discount
          );
		  $(".dis_text").show();
		  $(".dis_text").html(
			"Total Savings : <b>" +
			  response.Information.payable_amount + "Off</b>"
		  );
        }
		
        //hideloader();
        Swal.fire({
          position: "center",
          //icon: "success",
          title: response.msg,
          showConfirmButton: false,
          confirmButtonColor: "#ff5400",
          timer: 3000,
        });

        setTimeout(function () {
          // window.location.reload(1);
        }, 2000);
        //alert(response.msg);
        //location.reload();
      },
    });
  }
}

function recent_product_details(recent_id) {
  $.ajax({
    method: "post",
    url: site_url + "recent_products",
    data: {
      language: default_language,
      devicetype: "1",
      product_ids: recent_id,
      [csrfName]: csrfHash,
    },
    success: function (response) {
      //hideloader();
      var parsedJSON = response.Information;
      var order = parsedJSON.length;
      var product_html = "";
      if (order != 0) {
        $("#recent_product_details").empty();
        $(parsedJSON).each(function () {
          product_html +=
            '<div class="col-6 col-sm-6 col-md-3 col-lg-3 col-xl-3 col-xxl-2 col-xxxl-2 px-1 mb-6"><div class="card"><a href="' +
            site_url +
            this.web_url +
            "?pid=" +
            this.id +
            "&sku=" +
            this.sku +
            "&sid=" +
            this.vendor_id +
            '"><img src='+ site_url +'media/' +
            this.imgurl +
            ' class="card-img-top" alt="..."><div class="card-body"><h5 class="card-title fs-6 mb-0">' +
            this.name +'</h5><p class="card-text text-muted">' + def_price + '</p><h6>'+
            this.price +'</h6></div></a></div></div>';
			
			
			
        });
      } else {
        //product_html = "No Record Found.";
      }
      $("#recent_product_details").html(product_html);
    },
  });
}

function related_product() {
  var pid = $("#pid").val();
  var sid = $("#sid").val();

  $.ajax({
    method: "post",
    url: site_url + "get_related_products",
    data: {
      language: default_language,
      devicetype: 2,
      pid: pid,
      sid: sid,
      [csrfName]: csrfHash,
    },
    success: function (response) {
      //hideloader();
      var parsedJSON = response.Information;
      var order = parsedJSON.length;
      var product_html = "";
      if (order != 0) {
        $("#related_product").empty();
        $(parsedJSON).each(function () {
          product_html +=
            '<div class="swiper-slide col"> <a href="' +
            site_url +
            this.web_url +
            "?pid=" +
            this.id +
            "&sku=" +
            this.sku +
            "&sid=" +
            this.vendor_id +
            '"> <div class="card position-relative"><div class=" d-flex justify-content-center"><img src="https://marurang.in/media/' +
            this.imgurl +
            '" class="card-img-top px-1 pt-1" alt=""></div>';
          product_html += '<div class="favourite shadow">';
          product_html +=
            '<i onclick="add_to_wishlist(event,' +
            "'" +
            this.id +
            "','" +
            this.sku +
            "','" +
            this.vendor_id +
            "','" +
            user_id +
            "','1','0','2'," +
            "'" +
            user_id +
            "'" +
            ')"	class="far fa-heart"></i></div><div class="card-body"><h5 href="#" class="card-title">' +
            this.name +
            "</h5>";
          product_html +=
            '<p class="card-text text-muted">' + def_price + '</p><div class="cardBelow "><h6>' +
            this.price +
            "</h6>";
          product_html +=
            '<a onclick="add_to_cart_product(event,' +
            "'" +
            this.id +
            "','" +
            this.sku +
            "','" +
            this.vendor_id +
            "','" +
            user_id +
            "','1','0','2'," +
            "'" +
            user_id +
            "'" +
            ')" class="btn btn-primary addToCart"><i class="fas fa-shopping-cart"></i></a></div></div></div></a></div> ';
        });
      } else {
		$('#sameProd').hide();  
        //product_html = "No Record Found.";
      }
      $("#related_product").html(product_html);
    },
  });
}

// function upsell_product() {
//     var pid = $("#pid").val();
//     var sid = $("#sid").val();

//     $.ajax({
//         method: "post",
//         url: site_url + "get_upsell_products",
//         data: {
//             language: 1,
//             devicetype: 2,
//             pid: pid,
//             sid: sid,
//             [csrfName]: csrfHash,
//         },
//         success: function(response) {
//             //hideloader();
//             var parsedJSON = response.Information;
//             var order = parsedJSON.length;
//             var product_html = "";
//             if (order != 0) {
//                 $("#upsell_product").empty();
//                 $(parsedJSON).each(function() {
//                     product_html +=
//                         '<div class="col mb-2 mb-md-1 mb-xl-0 px-1"> <a href="' +
//                         site_url +
//                         this.web_url +
//                         "?pid=" +
//                         this.id +
//                         "&sku=" +
//                         this.sku +
//                         "&sid=" +
//                         this.vendor_id +
//                         '"> <div class="card shadow position-relative"><img src="https://fleekmart.com/media/' +
//                         this.imgurl +
//                         '" class="card-img-top px-1 pt-1" alt="">';
//                     product_html +=
//                         '<div class="favourite shadow"><i class="far fa-heart"></i></div><div class="card-body"><h5 href="#" class="card-title">' +
//                         this.name +
//                         "</h5>";
//                     product_html +=
//                         '<p class="card-text text-muted">Price</p><div class="cardBelow "><h6>' +
//                         this.mrp +
//                         '</h6><a href="#" class="btn btn-primary addToCart"><i class="fas fa-shopping-cart"></i></a></div></div></div></a></div> ';
//                 });
//             } else {
//                 //product_html = "No Record Found.";
//             }
//             $("#upsell_product").html(product_html);
//         },
//     });
// }

function upsell_product() {
  var pid = $("#pid").val();
  var sid = $("#sid").val();

  $.ajax({
    method: "post",
    url: site_url + "get_upsell_products",
    data: {
      language: default_language,
      devicetype: 2,
      pid: pid,
      sid: sid,
      [csrfName]: csrfHash,
    },
    success: function (response) {
      //hideloader();
      var parsedJSON = response.Information;
      var order = parsedJSON.length;
      var product_html = "";
      if (order != 0) {
        $("#upsell_product").empty();
        $(parsedJSON).each(function () {
          product_html +=
            '<div class="col mb-2 mb-md-1 mb-xl-0 px-1"> <a href="' +
            site_url +
            this.web_url +
            "?pid=" +
            this.id +
            "&sku=" +
            this.sku +
            "&sid=" +
            this.vendor_id +
            '"> <div class="card position-relative"><div class="d-flex justify-content-center"> <img src="https://marurang.in/media/' +
            this.imgurl +
            '" class="card-img-top px-1 pt-1" alt=""></div>';
          product_html += '<div class="favourite shadow">';
          product_html +=
            '<i onclick="add_to_wishlist(event,' +
            "'" +
            this.id +
            "','" +
            this.sku +
            "','" +
            this.vendor_id +
            "','" +
            user_id +
            "','1','0','2'," +
            "'" +
            user_id +
            "'" +
            ')"	class="far fa-heart"></i></div><div class="card-body"><h5 href="#" class="card-title">' +
            this.name +
            "</h5>";
          product_html +=
            '<p class="card-text text-muted">' + def_price +'</p><div class="cardBelow "><h6>' +
            this.price +
            "</h6>";
          product_html +=
            '<a onclick="add_to_cart_product(event,' +
            "'" +
            this.id +
            "','" +
            this.sku +
            "','" +
            this.vendor_id +
            "','" +
            user_id +
            "','1','0','2'," +
            "'" +
            user_id +
            "'" +
            ')" class="btn btn-primary addToCart"><i class="fas fa-shopping-cart"></i></a></div></div></div></a></div> ';
        });
      } else {
        //product_html = "No Record Found.";
      }
      $("#upsell_product").html(product_html);
    },
  });
}

function add_to_cart_products(
  event,
  pid,
  sku,
  vendor_id,
  user_id,
  qty,
  referid,
  devicetype,
  qouteid
) {
  event.preventDefault();

	var qty = $('#select_qty').val();
	if(qty == '')
	{
		 Swal.fire({
          position: "center",
          //icon: "success",
          title: "Please Select Qty",
          showConfirmButton: true,
          confirmButtonText: "ok",
          confirmButtonColor: "#ff5400",
          timer: 3000,
        });	
	}
	else
	{
  $.ajax({
    method: "post",
    url: site_url + "addProductCart",
    data: {
      language: default_language,
      pid: pid,
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
      // alert('dd');
      //$("#id01").show();
      addto_cart_count();

      if (response.msg == "Product attribute mandotary") {
        Swal.fire({
          position: "center",
          //icon: "success",
          title: "Please Select Attributes",
          showConfirmButton: true,
          confirmButtonText: "ok",
          confirmButtonColor: "#ff5400",
          timer: 3000,
        });
      } else {
        Swal.fire({
          position: "center",
          //icon: "success",
          title: response.msg,
          showConfirmButton: true,
          confirmButtonColor: "#ff5400",
          confirmButtonText: "View Cart",
          timer: 3000,
        }).then((result) => {
          if (result.isConfirmed) {
            window.location = site_url + "cart";
          }
        });
      }
      //location.href = site_url + "cart";
      /*if (confirm('Add to Cart Product Successfully?')) {
			  // Save it!
			   location.href=site_url+'cart';
			  console.log('View Cart');
			} else {
			  // Do nothing!
			  console.log('Continue Shopping');
			}*/
    },
  });
	}
}

function add_to_wishlist0(
  event,
  pid,
  sku,
  vendor_id,
  user_id,
  qty,
  referid,
  devicetype
) {
  event.preventDefault();

  $.ajax({
    method: "post",
    url: site_url + "addProductWishlist",
    data: {
      language: default_language,
      pid: pid,
      sku: sku,
      sid: vendor_id,
      user_id: user_id,
      qty: qty,
      referid: referid,
      devicetype: 2,
      [csrfName]: csrfHash,
    },
    success: function (response) {
      //hideloader();
      //alert('ddd');
      //$('#id01').show();
      /*if (confirm('Add to Cart Product Successfully?')) {
			  // Save it!
			   location.href=site_url+'cart';
			  console.log('View Cart');
			} else {
			  // Do nothing!
			  console.log('Continue Shopping');
			}*/
    },
  });
}

function get_product_attributes(tag) {
  //var attr_name = $(tag).attr("attribute-label");
  //alert($("#"+attr_name+"_attr_id").val());
  $("#" + tag + "_attr_id").attr("checked", true);

  var numberOfChecked = $(".product_attributes:checkbox:checked").length;
  var totalCheckboxes = $(".product_attributes:checkbox").length;
  if (totalCheckboxes == numberOfChecked) {
    var attribute_array = [];

    $.each($(".attribute-values:checked"), function () {
      var attributes_id = $(this).attr("attribute-label");

      attribute_array.push({
        attr_id: $("#" + attributes_id + "_attr_id").val(),
        attr_name: attributes_id,
        attr_value: $(this).val(),
      });
    });
    var pid = $("#pid").val();
    var sku = $("#sku").val();
    var sid = $("#sid").val();
    var user_id = $("#user_id").val();
    var qoute_id = $("#qoute_id").val();
    var jsons = JSON.stringify(attribute_array);
	var buy_now = '';
	var add_to_cart = '';
	if(default_language == '1')
	{
		buy_now = 'اشتري الآن';
		add_to_cart = 'أضف إلى السلة';
	}
	else
	{
		buy_now = 'Buy Now';
		add_to_cart = 'Add to Cart';
	}
    $.ajax({
      method: "post",
      url: site_url + "getProductPrice",
      data: {
        pid: pid,
        sku: sku,
        sid: sid,
        contentType: "application/json",
        config_attr: jsons,
        language: default_language,
        [csrfName]: csrfHash,
      },
      success: function (response) {
        //hideloader();
        // alert(response);
        var parsedJSON = response.Information;
        var product_html = "";
        $(".pBtns").empty();

        $(parsedJSON).each(function () {
          // alert();
          
		  if(this.product_price == '')
		  {
			 $('.pBtns').hide();
			 $('#cart_btns').html('<button class="btn-border-disable fs-4" disabled>Out of Stock</button>');
		  }
		  else
		  {
			 
			 $("#product-price").html(this.product_price); 
			  $("#mrp").html("MRP : "+this.product_mrp);
			  var discount =  (this.product_mrp.replace(/\D/g, '')) - (this.product_price.replace(/\D/g, ''));
			  $("#total_saving").html('JD'+discount);
			 $('.pBtns').show();  
		  }
		  
          product_html +=
            '<button class="btn-solid" onclick="add_to_cart_product_buy(event,' +
            "'" +
            pid +
            "','" +
            this.product_attr_sku +
            "','" +
            sid +
            "','" +
            user_id +
            "','1','0','2'," +
            "'" +
            qoute_id +
            "'" +
            ')">'+ buy_now +'</button>';
          product_html +=
            '<button class="btn-border" onclick="add_to_cart_products(event,' +
            "'" +
            pid +
            "','" +
            this.product_attr_sku +
            "','" +
            sid +
            "','" +
            user_id +
            "','1','0','2'," +
            "'" +
            qoute_id +
            "'" +
            ')">'+ add_to_cart +'</button>';
        });
        $(".pBtns").html(product_html);
      },
    });
  }
}

function get_home_bottom_banner() {
  $.ajax({
    method: "get",
    url: site_url + "get_home_bottom_banner",
    data: {
      [csrfName]: csrfHash,
    },
    success: function (response) {
      //hideloader();
      var parsedJSON = JSON.parse(response);
      var order = parsedJSON.length;
      var product_html = "";
      if (order != 0) {
        $("#home_bottom_banner").empty();
        $(parsedJSON).each(function () {
          product_html +=
            '<div class="col-12 col-md-4 mb-0"><div class="offerCard shadow"><a href="' +
            this.link +
            '"><img src="' +
            this.image +
            '" class="img-fluid" alt=""></a> </div> </div>';
        });
      } else {
        // product_html = "No Record Found.";
      }
      $("#home_bottom_banner").html(product_html);
    },
  });
}

$("#review_form").submit(function (event) {
  event.preventDefault();

  var ProductReview = $("#ProductReview").val();
  var reviewtitle = $("#reviewtitle").val();
  var pid = $("#pid").val();
  var user_id = $("#user_id").val();
  var rating = $("input[name='rating1']:checked").val();
if(rating == undefined)
{
	//alert('dddd'+rating);
	$("#error_msg").html('Please Select Rating Stars.');
}
   
  $.ajax({
    method: "post",
    url: site_url + "addProductReview",
    data: {
      language: default_language,
      pid: pid,
      user_id: user_id,
      review_title: reviewtitle,
      review_comment: ProductReview,
      review_rating: rating,
      [csrfName]: csrfHash,
    },
    success: function (response) {

	   $("#error_msg").html(response.msg);
      //hideloader();
      //alert(response.msg);
      //location.reload();
      Swal.fire({
        position: "center",
        //icon: "success",
        title: response.msg,
        showConfirmButton: false,
        confirmButtonColor: "#ff5400",
        timer: 3000,
      });
      setTimeout(function () {
        location.reload();
      }, 2000);
    },
  });
});
