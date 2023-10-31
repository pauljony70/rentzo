var csrfName = $(".txt_csrfname").attr("name"); //
var csrfHash = $(".txt_csrfname").val(); // CSRF hash
var site_url = $(".site_url").val(); // CSRF hash
var user_id = $("#user_id").val();

var language = 1;
var devicetype = 1;
var selectVal = ""; //$("#sort_data_id option:selected").val();
var hidden_catid = $("#hidden_catid").val();
var filter_array = [];
var sort_id = '';
var pages = 0;

$(function () {
  window.onload = get_category_product(hidden_catid, "", 0);
});
// $("#sort_data_id").on("change", function () {
  // var selectVal = $("#sort_data_id option:selected").val();

  // get_category_product(hidden_catid, selectVal, 0);
// });
$(document).on('change', '#sort_data_id', function() {
   var selectVal = $("#sort_data_id option:selected").val();
	sort_id = $(this).children(":selected").attr("id");
  get_category_product(hidden_catid, sort_id, 0);
});

$(document).on('load', '#flexCheckChecked', function() { 
   if(this.checked) {
		var check_val = $(this).val();
		var attr_id = $(this).closest('div').find('#attr_id').val();
		var attr_name = $(this).closest('div').find('#attr_name').val();
		filter_array.push({
			"attr_id" : attr_id,
			"attr_name" : attr_name,
			"attr_value" : check_val
		});
		  //alert(JSON.stringify(filter_array));

    }
	else
	{
		var check_val = $(this).val();
		var parsedJSON = filter_array;
       //  alert("before " +parsedJSON);                                        
   
        for (var i=0; i<parsedJSON.length; i++) {
            var counter = parsedJSON[i];
           // var name = counter.url;
            if(counter.attr_value.includes(check_val)){
                //alert("remove it " +parsedJSON[i]);
                //delete parsedJSON[i];
                 parsedJSON.splice(i, 1);
                
            }
          
		}
		 // alert(JSON.stringify(filter_array));
	}
	get_category_product(hidden_catid, sort_id, pages);
});

$(document).on('change', '#flexCheckChecked', function() {
   if(this.checked) {
		var check_val = $(this).val();
		var attr_id = $(this).closest('div').find('#attr_id').val();
		var attr_name = $(this).closest('div').find('#attr_name').val();
		filter_array.push({
			"attr_id" : attr_id,
			"attr_name" : attr_name,
			"attr_value" : check_val
		});
		  //alert(JSON.stringify(filter_array));

    }
	else
	{
		var check_val = $(this).val();
		var parsedJSON = filter_array;
       //  alert("before " +parsedJSON);                                        
   
        for (var i=0; i<parsedJSON.length; i++) {
            var counter = parsedJSON[i];
           // var name = counter.url;
            if(counter.attr_value.includes(check_val)){
                //alert("remove it " +parsedJSON[i]);
                //delete parsedJSON[i];
                 parsedJSON.splice(i, 1);
                
            }
          
		}
		 // alert(JSON.stringify(filter_array));
	}
	get_category_product(hidden_catid, sort_id, pages);
});

//$(".flexCheckChecked input").click(function () {
   // alert('ss');
	//$(".rating span").removeClass("checked");
    //$(this).parent().addClass("checked");
  //});

function get_category_product(catid, sortby, pageno) {
  $.ajax({
    method: "post",
    url: site_url + "getCategoryProduct",
    data: {
      catid: catid,
      sortby: sortby,
      pageno: pageno,
      [csrfName]: csrfHash,
      language: default_language,
      devicetype: devicetype,
      config_attr: JSON.stringify(filter_array),
    },
    success: function (response) {
      //hideloader();

      var parsedJSON = response.Information;

      var order = parsedJSON.length;
      var product_html = "";
      if (order != 0) {
        $("#category_product").empty();
        $(parsedJSON).each(function () {
          product_html +=
            '<div class="col-6 col-sm-4 col-xl-3 mb-4"><a href="' +
            site_url +
            this.web_url +
            "?pid=" +
            this.id +
            "&sku=" +
            this.sku +
            "&sid=" +
            this.vendor_id +
            '"><div class="card p-1 shadow position-relative"><div class=" d-flex align-items-center justify-content-center"> <img src="https://fleekmart.com/media/' +
            this.imgurl +
            '" class="card-img-top" alt=""></div><div class="favourite shadow">';
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
            ')" class="btn btn-primary addToCart"><i class="fas fa-shopping-cart"></i></a></div></div></div></a></div>';
        });
        var result = Paging(
          response.pageno,
          32,
          response.productCount,
          "page-link shadow",
          "myDisableClass page-link shadow"
        );
        $(".pagingDiv").html(result);
      } else {
        product_html = "No Record Found.";
      }
      $("#category_product").html(product_html);
    },
  });
}

$(document).ready(function () {
  $(".pagingDiv").on("click", "a", function () {
    pages = $(this).attr("pn") - 1;
    get_category_product(hidden_catid, sort_id, pages);
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
