var swiper = new Swiper(".mySwiper", {
  slidesPerView: 1,
  spaceBetween: 30,
  loop: true,
  freeMode: true,
  autoplay: {
    delay: 3000,
  },
  // effect: "creative",
  keyboard: {
    enabled: true,
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});

var swiper = new Swiper(".SameProdmySwiper", {
  slidesPerView: 1,
  spaceBetween: 10,
  // pagination: {
  //   el: ".swiper-pagination",
  //   clickable: true,
  // },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  breakpoints: {
    576: {
      slidesPerView: 2,
      // spaceBetween: 20,
    },
    768: {
      slidesPerView: 3,
      // spaceBetween: 40,
    },
    1024: {
      slidesPerView: 5,
      // spaceBetween: 50,
    },
  },
});
