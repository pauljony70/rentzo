var csrfName = $(".txt_csrfname").attr("name");
var csrfHash = $(".txt_csrfname").val();
var site_url = $(".site_url").val();

$(function () {
  
  window.onload = get_home_bottom_products("prod_section_1");
 
});

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


var categorySwiper = new Swiper(".section-5-category-div", {
	slidesPerView: 4.7,
	spaceBetween: 30,
	freeMode: true,
	grabCursor: true,
	mousewheel: {
		forceToAxis: true,
	},
	forceToAxis: false,
	breakpoints: {
		640: {
			slidesPerView: 5.5,
			spaceBetween: 30,
		},
		1024: {
			slidesPerView: 6.5,
			spaceBetween: 40,
		},
		1400: {
			slidesPerView: 8.5,
			spaceBetween: 50,
		},
	},
});

var topSliderSwiper = new Swiper(".top-slider", {
	slidesPerView: 1,
	spaceBetween: 30,
	centeredSlides: true,
	grabCursor: true,
	loop: true,
	autoplay: {
		delay: 2500,
		disableOnInteraction: true,
	},
	pagination: {
		el: ".swiper-pagination",
		clickable: true
	},
	navigation: {
		nextEl: ".swiper-button-next",
		prevEl: ".swiper-button-prev",
	},
});

var productSwiper = new Swiper(".product-swiper", {
	slidesPerView: 2.7,
	spaceBetween: 15,
	freeMode: true,
	grabCursor: true,
	mousewheel: {
		forceToAxis: true,
	},
	forceToAxis: false,
	breakpoints: {
		640: {
			slidesPerView: 3.5,
			spaceBetween: 15,
		},
		1024: {
			slidesPerView: 4.5,
			spaceBetween: 15,
		},
		1400: {
			slidesPerView: 5.5,
			spaceBetween: 15,
		},
	},
});

var eventSwiper = new Swiper(".event-swiper", {
	slidesPerView: 2.7,
	spaceBetween: 10,
	freeMode: true,
	grabCursor: true,
	mousewheel: {
		forceToAxis: true,
	},
	forceToAxis: false,
	breakpoints: {
		1024: {
			slidesPerView: 3.5,
			spaceBetween: 30,
		},
	},
});

var brandSwiper = new Swiper(".brand-swiper", {
	slidesPerView: 1.8,
	spaceBetween: 35,
	freeMode: true,
	grabCursor: true,
	mousewheel: {
		forceToAxis: true,
	},
	forceToAxis: false,
	pagination: {
		el: ".swiper-pagination",
		clickable: true
	},
	breakpoints: {
		640: {
			slidesPerView: 2,
			spaceBetween: 35,
		},
		1020: {
			slidesPerView: 3,
			spaceBetween: 35,
		},
	},
});

var testimonialSwiper = new Swiper(".testimonial-swiper", {
	slidesPerView: 1,
	spaceBetween: 15,
	freeMode: true,
	grabCursor: true,
	mousewheel: {
		forceToAxis: true,
	},
	forceToAxis: false,
	navigation: {
		nextEl: ".swiper-btn-next",
		prevEl: ".swiper-btn-prev",
	},
	breakpoints: {
		767: {
			slidesPerView: 2,
			spaceBetween: 35,
		},
		1020: {
			slidesPerView: 3,
			spaceBetween: 35,
		},
	},
});
