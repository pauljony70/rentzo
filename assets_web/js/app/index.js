$(function () {
	get_home_products("prod_section1_title", "prod_section_1");
	get_home_bottom_products("prod_section2_title", "prod_section_2");
	get_home_events();
	get_home_arival_banner();
	get_home_bottom_banner();
});

/* 
 * ---------------------------------------------------
 * Multi image banner
 * ---------------------------------------------------
 */
function get_home_bottom_banner() {
	$.ajax({
		method: "get",
		url: site_url + "get_home_bottom_banner",
		data: { [csrfName]: csrfHash },
		success: function (response) {
			var parsedJSON = JSON.parse(response);
			var order = parsedJSON.length;
			var product_html = "";
			var count = 1;
			if (order != 0) {
				$("#home_bottom_banner").empty();

				product_html +=
					`<a href="#" class="col-md-6 mb-2 mb-md-0">
						<img src="${parsedJSON[0].image}" alt="" class="banner1">
					</a>
					<div class="col-md-6 mt-2 mt-md-0">
						<div class="row h-100">
							<a href="#2" class="col-12 mb-2">
								<img src="${parsedJSON[1].image}" alt="" class="banner2">
							</a>
							<div class="col-12 mt-2">
								<div class="row h-100">
									<a href="#3" class="col-6">
										<img src="${parsedJSON[2].image}" alt="banner3">
									</a>
									<a href="#4" class="col-6">
										<img src="${parsedJSON[3].image}" alt="banner4">
									</a>
								</div>
							</div>
						</div>
					</div>`;
			} else { }
			$("#home_bottom_banner").html(product_html);
			document.querySelectorAll('img').forEach(image => { image.src = image.src.replace('-610-400', '') });
		},
	});
}

/* 
 * ---------------------------------------------------
 * Event section
 * ---------------------------------------------------
 */
function get_home_events() {
	$.ajax({
		method: "get",
		url: site_url + "get_home_events",
		data: { [csrfName]: csrfHash },
		success: function (response) {
			var parsedJSON = JSON.parse(response);
			var order = parsedJSON.length;
			var product_html = "";
			var product_htmls = "";
			var count = 1;
			if (order != 0) {
				$("#home_events").empty();
				$("#home_events_mobile").empty();
				$(parsedJSON).each(function () {
					product_html +=
						`<div class="swiper-slide">
							<a href="#" class="card event-card">
								<img src="${this.event_image}" class="card-img-top event-card-img" alt="">
								<div class="card-body event-card-body p-0">
									<h5 class="card-title event-title text-center line-clamp-1">${this.name}</h5>
								</div>
							</a>
						</div>`;
					product_htmls +=
						`<div class="col-6 col-sm-4 pb-3">
							<img src="${this.event_image}" class="event-card-img" alt="">
							<div class="event-title text-center line-clamp-1">${this.name}</div>
						</div>`;
					count++;
				});
			} else {

			}
			$("#home_events").html(product_html);
			$("#home_events_mobile").html(product_htmls);
			new Swiper(".event-swiper", {
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
		},
	});
}

/* 
 * ---------------------------------------------------
 * New Arrival
 * ---------------------------------------------------
 */
function get_home_arival_banner() {
	$.ajax({
		method: "get",
		url: site_url + "get_home_arival_banner",
		data: { [csrfName]: csrfHash },
		success: function (response) {
			var parsedJSON = JSON.parse(response);
			var order = parsedJSON.length;
			var product_html = "";
			var count = 1;
			if (order != 0) {
				$("#home_arrivel_banner").empty();
				$(parsedJSON).each(function () {
					product_html +=
						`<div class="swiper-slide">
							<a href="${this.link}">
								<img src="${this.image}" alt="Brand" class="brand-img">
							</a>
						</div>`;
					count++;
				});
			} else { }
			$("#home_arrivel_banner").html(product_html);
		},
	});
}

/* 
 * ---------------------------------------------------
 * First product section
 * ---------------------------------------------------
 */
function get_home_products(title, type) {
	$.ajax({
		method: "get",
		url: site_url + "get_home_products",
		data: { title: title, type: type, [csrfName]: csrfHash },
		success: function (response) {

			var parsedJSON = JSON.parse(response);
			var product_array = parsedJSON.product_array
			var order = product_array.length;
			var product_html = "";
			var get_title = parsedJSON.title;
			$("#" + title).text(get_title);

			if (order != 0) {
				$("#" + type + "_products").empty();
				$(product_array).each(function () {
					product_html +=
						`<div class="swiper-slide">
							<a href="${site_url}${this.web_url}?pid=${this.id}&sku=${this.sku}&sid=${this.vendor_id}" class="d-flex flex-column card product-card rounded-4">
								<img src="${this.imgurl}" class="card-img-top product-card-img rounded-4" alt="">
								<div class="card-body d-flex flex-column product-card-body">
									<h5 class="card-title product-title line-clamp-2 mb-auto">${this.name}</h5>
									<div class="card-text d-flex justify-content-between py-1">
										<div class="rent-heading">Rent</div>
										<div class="rent-price">${this.price}</div>
									</div>
									<div class="product-card-footer pt-1">
										<div class="text-success">Available Today</div>
									</div>
								</div>
							</a>
						</div>`;
				});
			} else { }
			$("#" + type + "_products").html(product_html);
			new Swiper(".product-swiper", {
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
		},
	});
}

/* 
 * ---------------------------------------------------
 * Bottom product section
 * ---------------------------------------------------
 */
function get_home_bottom_products(title, type) {
	$.ajax({
		method: "get",
		url: site_url + "get_home_products",
		data: { title: title, type: type, [csrfName]: csrfHash },
		success: function (response) {

			var parsedJSON = JSON.parse(response);
			var product_array = parsedJSON.product_array
			var order = product_array.length;
			var product_html = "";
			var get_title = parsedJSON.title;
			$("#" + title).text(get_title);

			if (order != 0) {
				$("#" + type + "_products").empty();
				$(product_array).each(function () {
					product_html +=
						`<div class="col-4 col-sm-4 col-md-3 mb-3 px-2">
							<a href="${site_url}${this.web_url}?pid=${this.id}&sku=${this.sku}&sid=${this.vendor_id}" class="d-flex flex-column card product-card rounded-4">
								<img src="${this.imgurl}" class="card-img-top product-card-img rounded-4" alt="">
								<div class="card-body d-flex flex-column product-card-body">
									<h5 class="card-title product-title line-clamp-2 mb-auto">${this.name}</h5>
									<div class="card-text d-flex justify-content-between py-1">
										<div class="rent-heading">Rent</div>
										<div class="rent-price">${this.price}</div>
									</div>
									<div class="product-card-footer pt-1">
										<div class="text-success">Available Today</div>
									</div>
								</div>
							</a>
						</div>`;
				});
			} else {

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
	slidesPerView: 1.3,
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
