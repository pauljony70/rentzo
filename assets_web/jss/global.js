window.myApp = window.myApp || {};

window.myApp.csrfName = $(".txt_csrfname").attr("name");
window.myApp.csrfHash = $(".txt_csrfname").val();
window.myApp.siteUrl = $(".site_url").val();
window.myApp.userId = $("#user_id").val();

window.addEventListener("load", () => {
  $("#loader").fadeOut("slow");
});



/* var offcanvasMarurang = document.getElementById('offcanvasMarurang')
offcanvasMarurang.addEventListener('shown.bs.offcanvas', function () {
  document.getElementsByClassName('top-bar')[0].style.cssText = "opacity: 0.4;";
  document.getElementsByClassName('navbar')[0].style.cssText = "opacity: 0.4;";
  document.getElementById('common-class').style.cssText = "opacity: 0.4;";
  document.getElementsByClassName('a-mobileNav')[0].style.cssText = "background-color : #f1f1f1 !important;";
})
offcanvasMarurang.addEventListener('hidden.bs.offcanvas', function () {
  document.getElementsByClassName('top-bar')[0].style.cssText = "";
  document.getElementsByClassName('navbar')[0].style.cssText = "";
  document.getElementById('common-class').style.cssText = "";
  document.getElementsByClassName('a-mobileNav')[0].style.cssText = "";
})

$(window).resize(function () {
  if ($(window).width() > 998) {
    document.getElementsByClassName('top-bar')[0].style.cssText = "";
    document.getElementsByClassName('navbar')[0].style.cssText = "";
    document.getElementById('common-class').style.cssText = "";
    document.getElementsByClassName('a-mobileNav')[0].style.cssText = "";
  }
}); */

// $('.explore')[0].onmouseover = function () {
//   // $('.dropdown-toggle', this).trigger('click');
// };

// Hero Slider
$("#heroHomeSlider").slick({
  speed: 500,
  slidesToShow: 1,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 3000,
  infinite: true,
  arrows: false,
  dots: false,
  responsive: [
    {
      breakpoint: 1092,
      settings: {
        centerMode: false,
      },
    },
  ]
});

// Mobile top slider
$(".homeTopCategoryMobileContainer").slick({
  speed: 500,
  slidesToShow: 5,
  slidesToScroll: 1,
  swipeToSlide: false,
  infinite: false,
  centerMode: false,
  arrows: false,
  dots: false,
});

// Sign Up hide unhide
$("#sendOtpSignUpBtn").click(function (e) {
  e.preventDefault();
  $("#enterNumberSignUp").removeClass("d-flex");
  $("#enterNumberSignUp").addClass("d-none");
  $("#enterOTPSignUp").removeClass("d-none");
  $("#enterOTPSignUp").addClass("d-flex");
});
// Log In hide unhide
$("#sendOtpLogInBtn0").click(function (e) {
  e.preventDefault();
  $("#enterNumberLogin").removeClass("d-flex");
  $("#enterNumberLogin").addClass("d-none");
  $("#enterOtpLogin").removeClass("d-none");
  $("#enterOtpLogin").addClass("d-flex");
});

$(".a-homeCategoryPill").slick({
  speed: 500,
  slidesToShow: 15,
  slidesToScroll: 1,
  swipeToSlide: true,
  infinite: true,
  centerMode: false,
  arrows: false,
  dots: false,
  responsive: [
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1,
      },
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        centerMode: false,
        arrows: false,
      },
    },
    {
      breakpoint: 576,
      settings: {
        slidesToShow: 3.5,
        slidesToScroll: 1,
        centerMode: false,
        arrows: false,
      },
    },
    {
      breakpoint: 375,
      settings: {
        slidesToShow: 3.5,
        slidesToScroll: 1,
        centerMode: false,
        arrows: false,
      },
    },
  ],
});

$(".a-homeTopCategoriesSlider").slick({
  speed: 500,
  slidesToShow: 4,
  slidesToScroll: 1,
  swipeToSlide: true,
  infinite: true,
  centerMode: false,
  arrows: false,
  dots: false,
  responsive: [
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1,
      },
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        centerMode: false,
        arrows: false,
      },
    },
    {
      breakpoint: 576,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: false,
        arrows: false,
      },
    },
  ],
});

$(".a-homeTopSellingContainer").slick({
  speed: 500,
  slidesToShow: 4,
  slidesToScroll: 1,
  swipeToSlide: true,
  infinite: true,
  centerMode: false,
  arrows: true,
  prevArrow:
    "<button class='btn btn-primary text-light a-slider-previous-arrow p-0'><i class='bx bx-chevron-left bx-sm'></i></button>",
  nextArrow:
    "<button class='btn btn-primary text-light a-slider-next-arrow p-0'><i class='bx bx-chevron-right bx-sm'></i></button>",
  dots: false,
  responsive: [
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1,
      },
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        centerMode: false,
        arrows: false,
      },
    },
    {
      breakpoint: 576,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        centerMode: false,
        arrows: false,
      },
    },
  ],
});

$(".a-homeFeaturedItemContainer").slick({
  speed: 500,
  slidesToShow: 4,
  slidesToScroll: 1,
  swipeToSlide: true,
  infinite: true,
  centerMode: false,
  arrows: true,
  prevArrow:
    "<button class='btn btn-primary text-light a-slider-previous-arrow p-0'><i class='bx bx-chevron-left bx-sm'></i></button>",
  nextArrow:
    "<button class='btn btn-primary text-light a-slider-next-arrow p-0'><i class='bx bx-chevron-right bx-sm'></i></button>",
  dots: false,
  responsive: [
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1,
      },
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        centerMode: false,
        arrows: false,
      },
    },
    {
      breakpoint: 576,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        centerMode: false,
        arrows: false,
      },
    },
  ],
});
