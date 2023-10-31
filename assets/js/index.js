var csrfName = $(".txt_csrfname").attr("name"); //
var csrfHash = $(".txt_csrfname").val(); // CSRF hash
var site_url = $(".site_url").val(); // CSRF hash 
var user_id = $("#user_id").val();
var recent_id = $("#recent_id").val();


$(function () {
  window.onload = get_home_products("New");
  window.onload = get_home_products("Popular");
  window.onload = get_home_products("Recommended");
  window.onload = get_home_products("Offers");
  window.onload = get_home_bottom_products("home_bottom");
  window.onload = get_home_recent_products(recent_id);
  window.onload = get_home_bottom_banner();
});

function get_home_products(type) {
  $.ajax({
    method: "get",
    url: site_url + "get_home_products",
    data: { type: type, [csrfName]: csrfHash },
    success: function (response) {
      //hideloader();
      var parsedJSON = JSON.parse(response);
      var order = parsedJSON.length;
      var product_html = "";
      var count = 1;
      var add_class = "";

      if (order != 0) {
        $("#" + type + "_products").empty();
        $(parsedJSON).each(function () {
          if (count == 16) {
            add_class = "last_product";
          }
          product_html +=
            '<div class="col my-2 px-2 ' +
            add_class +
            '"> <a href="' +
            site_url +
            this.web_url +
            "?pid=" +
            this.id +
            "&sku=" +
            this.sku +
            "&sid=" +
            this.vendor_id +
            '"> <div class="card"><div class="d-flex align-items-center justify-content-center"> <img src="' +
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
            ')" class="far fa-heart"></i></div>';
			if(this.offpercent.replace(/\D/g, '') != 0)
			{
				product_html +='<div class="cardTopBaner shadow"><p class="mb-0">'+ this.offpercent +'</p></div>';
			}
			product_html +='<div class="card-body"><h5 href="#" class="card-title">' +
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
            ')"	class="btn btn-primary addToCart"><i class="fas fa-shopping-cart"></i></a></div></div></div></a></div> ';
          count++;
        });
      } else {
        //product_html = "No Record Found.";
      }
      $("#" + type + "_products").html(product_html);
    },
  });
}

function get_home_bottom_products(type) {
  $.ajax({
    method: "get",
    url: site_url + "get_home_products",
    data: { type: type, [csrfName]: csrfHash },
    success: function (response) {
      //hideloader();
      var parsedJSON = JSON.parse(response);
      var order = parsedJSON.length;
      var product_html = "";
	
      if (order != 0) {
        $("#" + type + "_products").empty();
        $(parsedJSON).each(function () {
          product_html +=
            '<div class="col-12 col-md-6 col-xl-3"> <div class="alsoVi"><div class="Vi-image"><img src="' +
            this.imgurl +
            '" class="img-fluid" alt=""></div>';
          product_html +=
            '<div class="Vi-text"> <div class="Vi-pTitle"><h5>' +
            this.name +
            "</h5></div>";
          product_html +=
            '<div class="Vi-price"><div><span class=" text-muted">' + def_price + '</span><h2>' +
            this.price +
            "</h2></div> <div>";
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
            ')" class="btn btn-primary addToCart"><i class="fas fa-shopping-cart"></i></a></div></div></div></div></div> ';
        });
      } else {
        //product_html = "No Record Found.";
      }
      $("#" + type + "_products").html(product_html);
    },
  });
}

function get_home_bottom_products(type) {
  $.ajax({
    method: "get",
    url: site_url + "get_home_products",
    data: { type: type, [csrfName]: csrfHash },
    success: function (response) {
      //hideloader();
      var parsedJSON = JSON.parse(response);
      var order = parsedJSON.length;
      var product_html = "";
      if (order != 0) {
        $("#" + type + "_products").empty();
        // $(parsedJSON).each(function () {
        //   product_html +=
        //     '<div class="col-md-4 col-xl-3"> <div class="col-md-4 col-xl-3"><img src="' +
        //     this.imgurl +
        //     '" class="card-img-top px-1 pt-1" alt="">';
        //   product_html +=
        //     '<div class="Vi-text"> <div class="Vi-pTitle"><h5>' +
        //     this.name +
        //     "</h5></div>";
        //   product_html +=
        //     '<div class="Vi-price"><div><span class=" text-muted">Price</span><h2>' +
        //     this.mrp +
        //     '</h2></div> <div><a href="#" class="btn btn-primary addToCart"><i class="fas fa-shopping-cart"></i></a></div></div></div></div></div> ';
        // });
        $(parsedJSON).each(function () {
          product_html +=
            '<div class="col me-3 me-xxl-0"> <a href="' +
            site_url +
            this.web_url +
            "?pid=" +
            this.id +
            "&sku=" +
            this.sku +
            "&sid=" +
            this.vendor_id +
            '"> <div class="card p-1 position-relative"><div class=" d-flex align-items-center justify-content-center"><img src="' +
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
            ')" class="far fa-heart"></i></div>';
			if(this.offpercent.replace(/\D/g, '') != 0)
			{
				product_html +='<div class="cardTopBaner shadow"><p class="mb-0">'+ this.offpercent +'</p></div>';
			}
			product_html +='<div class="card-body"><h5 href="#" class="card-title">' +
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
        //product_html = "No Record Found.";
      }
      $("#" + type + "_products").html(product_html);
    },
  });
}

function get_home_cat_products(type) {
  $.ajax({
    method: "get",
    url: site_url + "get_home_cat_products",
    data: { type: type, [csrfName]: csrfHash },
    success: function (response) {
      //hideloader();
      var parsedJSON = JSON.parse(response);
      var order = parsedJSON.length;
      var product_html = "";
      if (order != 0) {
        $("#cat_product" + type).empty();
        $(parsedJSON).each(function () {
          product_html +=
            '<div class="col-4 mb-xxl-1" id="pBCard"> <a href="' +
            site_url +
            this.web_url +
            "?pid=" +
            this.id +
            "&sku=" +
            this.sku +
            "&sid=" +
            this.vendor_id +
            '"> <div class="card p-1 position-relative m-auto"><div class="d-flex align-items-center justify-content-center"><img src="' +
            this.imgurl +
            '" class="card-img-top" alt=""></div>';
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
            ')" class="far fa-heart"></i></div>';
			if(this.offpercent.replace(/\D/g, '') != 0)
			{
				product_html +='<div class="cardTopBaner shadow"><p class="mb-0">'+ this.offpercent +'</p></div>';
			}
			product_html +='<div class="card-body"><h5 href="#" class="card-title">' +
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
      $("#cat_product" + type).html(product_html);
    },
  });
}

function get_home_recent_products(recent_id) {
  //alert(recent_id);
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
        $("#recent_product").empty();
        $(parsedJSON).each(function () {
          product_html +=
            '<div class="col my-2 px-2" id="pBCard"> <a href="' +
            site_url +
            this.web_url +
            "?pid=" +
            this.id +
            "&sku=" +
            this.sku +
            "&sid=" +
            this.vendor_id +
            '"> <div class="card p-1 position-relative m-auto"><div class="d-flex align-items-center justify-content-center"><img src="https://marurang.in/media/' +
            this.imgurl +
            '" class="card-img-top" alt=""></div>';
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
            ')" class="far fa-heart"></i></div>';
			if(this.offpercent.replace(/\D/g, '') != 0)
			{
				product_html +='<div class="cardTopBaner shadow"><p class="mb-0">'+ this.offpercent +'</p></div>';
			}
			product_html +='<div class="card-body"><h5 href="#" class="card-title">' +
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
        //product_html = "No Record Found.";
      }
      //alert(product_html);
      $("#recent_product").html(product_html);
    },
  });
}

function get_home_bottom_banner() {
  $.ajax({
    method: "get",
    url: site_url + "get_home_bottom_banner",
    data: { [csrfName]: csrfHash },
    success: function (response) {
      //hideloader();
      var parsedJSON = JSON.parse(response);
      var order = parsedJSON.length;
      var product_html = "";
      if (order != 0) {
        $("#home_bottom_banner").empty();
        $(parsedJSON).each(function () {
          product_html +=
            '<div class="col-12 col-md-4"><div class="offerCard shadow"><a href="' +
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

function redirect_to_link(link) {
  location.href = link;
}
