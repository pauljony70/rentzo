var csrfName = $(".txt_csrfname").attr("name"); //
var csrfHash = $(".txt_csrfname").val(); // CSRF hash
var site_url = $(".site_url").val(); // CSRF hash
var language = 1;
var devicetype = 1;
var selectVal = ""; //$("#sort_data_id option:selected").val(); 
var hidden_brandid = $("#hidden_brandid").val();
$(function () {
  window.onload = get_brand_product(hidden_brandid, "", 0);
});

$(document).on('change', '#sort_data_id', function() {
   var selectVal = $("#sort_data_id option:selected").val();
	var id = $(this).children(":selected").attr("id");
  get_brand_product(hidden_brandid, id, 0);
});
// $("#sort_data_id").on("change", function () {

  // var selectVal = $("#sort_data_id option:selected").val();
  // get_brand_product(hidden_brandid, selectVal, 0);
// });

function get_brand_product(brand_id, sortby, pageno) {
  $.ajax({
    method: "post",
    url: site_url + "brand_prod",
    data: {
      brand_id: brand_id,
      sortby: sortby,
      pageno: pageno,
      [csrfName]: csrfHash,
      language: language,
      devicetype: devicetype,
    },
    success: function (response) {
      //hideloader();
      var parsedJSON = response.Information;
      var user_id = $("#user_id").val();
      var order = parsedJSON.length;
      var product_html = "";
      if (order != 0) {
        $("#brand_product").empty();
        $(parsedJSON).each(function () {
          product_html +=
            '<div class="col mb-4"><a href="' +
            site_url +
            this.web_url +
            "?pid=" +
            this.id +
            "&sku=" +
            this.sku +
            "&sid=" +
            this.vendor_id +
            '"><div class="card p-1 shadow position-relative"><div class=" d-flex justify-content-center align-items-center"><img src="https://marurang.in/media/' +
            this.imgurl +
            '"class="card-img-top" alt=""></div><div class="favourite shadow">';
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
            ')" class="far fa-heart"></i></div><div class="card-body"><h5 href="#" class="card-title">' +
            this.name +
            '</h5><p class="card-text text-muted">' + def_price +'</p><div class="cardBelow "><h6>' +
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
            ')"	class="btn btn-primary addToCart"><i class="fas fa-shopping-cart"></i></a></div></div></div></a></div>';
          // product_html += '<div class="col-6 col-sm-4 col-xl-3 mb-4"><a href="'+site_url+this.web_url+'?pid='+this.id+'&sku='+this.sku+'&sid='+this.vendor_id+'"><div class="card p-1 shadow position-relative"><img src="https://fleekmart.com/media/'+this.imgurl+'" height="200px" class="card-img-top" alt=""><div class="favourite shadow"><i class="far fa-heart"></i></div><div class="card-body"><h5 href="#" class="card-title">'+this.name+'</h5><p class="card-text text-muted">Price</p><div class="cardBelow "><h6>'+this.price+'</h6><a href="#" class="btn btn-primary addToCart"><i class="fas fa-shopping-cart"></i></a></div></div></div></a></div>';
        });
        var result = Paging(
          response.pageno,
          35,
          response.total_product,
          "page-link shadow",
          "myDisableClass page-link shadow"
        );
        $(".pagingDiv").html(result);
      } else {
        product_html = "No Record Found.";
      }
      $("#brand_product").html(product_html);
    },
  });
}

$(document).ready(function () {
  $(".pagingDiv").on("click", "a", function () {
    var pages = $(this).attr("pn") - 1;
    get_brand_product(hidden_brandid, "", pages);
  });
});

function Paging(
  PageNumber,
  PageSize,
  TotalRecords,
  ClassName,
  DisableClassName
) {
  var ReturnValue = "";

  var TotalPages = Math.ceil(TotalRecords / PageSize);
  if (+PageNumber > 1) {
    if (+PageNumber == 2)
      ReturnValue =
        ReturnValue +
        "<li class='page-item'><a pn='" +
        (+PageNumber - 1) +
        "' class='" +
        ClassName +
        "' aria-label='Previous'><i aria-hidden='true' class='fas fa-angle-left'></i></a> </li>  ";
    else {
      ReturnValue = ReturnValue + "<li class='page-item'><a pn='";
      ReturnValue =
        ReturnValue +
        (+PageNumber - 1) +
        "' class='" +
        ClassName +
        "' aria-label='Previous'><i aria-hidden='true' class='fas fa-angle-left'></i></a> </li>  ";
    }
  } else
    ReturnValue =
      ReturnValue +
      "<li class='page-item'><span class='" +
      DisableClassName +
      "' aria-label='Previous'><i aria-hidden='true' class='fas fa-angle-left'></i></span></a>   ";
  if (+PageNumber - 3 > 1)
    ReturnValue =
      ReturnValue +
      "<li class='page-item'><a pn='1' class='" +
      ClassName +
      "'>1</a></li> ...  ";
  for (var i = +PageNumber - 3; i <= +PageNumber; i++)
    if (i >= 1) {
      if (+PageNumber != i) {
        ReturnValue = ReturnValue + "<li class='page-item'><a pn='";
        ReturnValue =
          ReturnValue + i + "' class='" + ClassName + "'>" + i + "</a> </li> ";
      } else {
        ReturnValue =
          ReturnValue +
          "<li class='page-item active'><span class='" +
          DisableClassName +
          "'>" +
          i +
          "</span> </li>";
      }
    }
  for (var i = +PageNumber + 1; i <= +PageNumber + 3; i++)
    if (i <= TotalPages) {
      if (+PageNumber != i) {
        ReturnValue = ReturnValue + "<li class='page-item'><a pn='";
        ReturnValue =
          ReturnValue + i + "' class='" + ClassName + "'>" + i + "</a> </li> ";
      } else {
        ReturnValue =
          ReturnValue +
          "<li class='page-item active'><span class='" +
          DisableClassName +
          "'>" +
          i +
          "</span> </li>";
      }
    }
  if (+PageNumber + 3 < TotalPages) {
    ReturnValue = ReturnValue + "...<li class='page-item'> <a pn='";
    ReturnValue =
      ReturnValue +
      TotalPages +
      "' class='" +
      ClassName +
      "'>" +
      TotalPages +
      "</a> </li>";
  }
  if (+PageNumber < TotalPages) {
    ReturnValue = ReturnValue + "   <li class='page-item'><a pn='";
    ReturnValue =
      ReturnValue +
      (+PageNumber + 1) +
      "' class='" +
      ClassName +
      "' aria-label='Next'><i aria-hidden='true' class='fas fa-angle-right'></i></a> </li>";
  } else
    ReturnValue =
      ReturnValue +
      "   <span class='" +
      DisableClassName +
      "' aria-label='Next'><i aria-hidden='true' class='fas fa-angle-right'></i></span>";

  return ReturnValue;
}
