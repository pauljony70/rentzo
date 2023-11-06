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
