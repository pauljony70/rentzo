var csrfName = $(".txt_csrfname").attr("name");
var csrfHash = $(".txt_csrfname").val();
var site_url = $(".site_url").val();
var user_id = $("#user_id").val();
var qoute_id = $("#qoute_id").val();

$(function () {
	window.onload = get_home_products("New");
	window.onload = get_home_products("Popular");
	window.onload = get_home_products("Recommended");
	window.onload = get_home_products("Offers");
	window.onload = get_home_products("Most");
	window.onload = get_home_products("Custom");
	window.onload = get_home_bottom_banner();
	window.onload = get_home_small_banner('section4', '1930-150');
	window.onload = get_home_small_banner('section10', '1900-320');
	window.onload = get_home_small_banner('section11', '1900-320');
	setTimeout(() => {
		window.onload = getTimeDiff();
	}, 5000);
});

function get_home_products(type) {
	$.ajax({
		method: "get",
		url: site_url + "get_home_products",
		data: { type: type, [csrfName]: csrfHash, timezone: Intl.DateTimeFormat().resolvedOptions().timeZone },
		success: function (response) {
			//hideloader();
			var parsedJSON = JSON.parse(response);
			var order = parsedJSON.length;
			var product_html = "";
			var count = 1;
			var add_class = "";
			var whatsapp_number = $("#whatsapp_number").val();

			if (order != 0) {
				$("#" + type + "_products").empty();
				$(parsedJSON).each(function (index) {
					var timerContainer = '';
					var ratingHTML = '';
					if (this.offer) {
						timerContainer =
							`<div class="timer_container">
								<div class="row p-0 mt-1 d-flex-center">
									<div class="col-4 mx-0 p-1 px-0 d-flex flex-column">
										<div class="timer_text text-center hour fw-bolder border bg-white rounded">${this.remaining_hours}</div>
										<span class="text-light down_time">Hour</span>
									</div>
									<div class="col-4 mx-0 p-1 px-0 second_div d-flex flex-column">
										<div class="timer_text text-center minute fw-bolder border bg-white rounded">${this.remaining_minutes} </div>
										<span class="text-light down_time">Min</span>
									</div>
									<div class="col-4 mx-0 p-1 px-0 d-flex flex-column">
										<div class="timer_text text-center second border bg-white rounded fw-bolder">${this.remaining_seconds} </div>
										<span class="text-light down_time">Sec</span>
									</div>
								</div>
							</div>`;
					}
					if (this.rating.total_rows > 0) {
						ratingHTML =
							`<i class="fa-solid fa-star"></i>
							<div class="rating-number">${this.rating.total_rating / this.rating.total_rows}</div>`;
					}
					product_html +=
						`<div class="swiper-slide product-card-swiper px-2 py-1">
							<a href="${site_url}${this.web_url}?pid=${this.id}&sku=${this.sku}&sid=${this.vendor_id}" class="card h-100 d-flex flex-column justify-content-between product-link-card px-0">
								${this.mrp === this.price ? '' :
								`<div class="d-flex justify-content-between align-items-center" style="margin-top:-21px;">
									<span class="discount text-uppercase">
										<div>${this.offpercent}</div>
									</span>
									<span class="wishlist"><i class="fa fa-heart-o"></i></span>
								</div>`}
								<div class="image-container zoom-img">
									<img src="${this.imgurl}" class="zoom-img thumbnail-image" loading="lazy" alt="${this.name}">
									${timerContainer}
								</div>
								<div class="product-detail-container p-2 mb-1">
									<div class="justify-content-between align-items-center" style="padding:5px;">
										<p class="dress-name mb-0">${this.name}</p>	
										<div class="d-flex align-items-center justify-content-start flex-row mt-2" style="width: 100%;">
											<span class="new-price">${this.price}</span>
											<small class="old-price text-right mx-1">${this.mrp === this.price ? '' : this.mrp}</small>
										</div>
									</div>
									<div class="d-flex justify-content-between align-items-center mt-1" style="padding: 0 5px;">
										<div class="d-flex align-items-center">
											${ratingHTML}
										</div>
										<button class="btn btn-primary text-center text-uppercase card_buy_btn px-4 py-1 pt-2" onclick="add_to_cart_product_buy(event, '${this.id}', '${this.sku}', '${this.vendor_id}', '${user_id}', '1', '0', '2', '${qoute_id}')">${default_language === 1 ? 'يشتري' : 'BUY'}</button>
									</div>
								</div>
							</a>
						</div>`;
				});
			} else {
			}
			$("#" + type + "_products").html(product_html);

			new Swiper('.slider-trending_' + type, {
				slidesPerView: 2,
				freeMode: true,
				grabCursor: true,
				mousewheel: {
					forceToAxis: true,
				},
				forceToAxis: false,
				navigation: {
					nextEl: ".swiper-button-next",
					prevEl: ".swiper-button-prev",
				},
				breakpoints: {
					576: {
						slidesPerView: 3
					},
					768: {
						slidesPerView: 4
					},
					1024: {
						slidesPerView: 5
					},
					1200: {
						slidesPerView: 6
					},
				}
			});
		},
	});
}

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
				$(parsedJSON).each(function () {
					product_html +=
						`<div onclick="redirect_to_link('${this.link}')" class="a-Masonry-${count}"><img src="${this.image}" /></div>`;
					count++;
				});
			} else {
				// product_html = "No Record Found.";
			}
			$("#home_bottom_banner").html(product_html);
			document.querySelectorAll('img').forEach(image => { image.src = image.src.replace('-610-400', '') });
		},
	});
}

function get_home_small_banner(type, size) {
	$.ajax({
		method: "get",
		url: site_url + "get_home_small_banner",
		data: { [csrfName]: csrfHash, type: type, size: size },
		success: function (response) {
			var parsedJSON = JSON.parse(response);
			var order = parsedJSON.length;
			var product_html = "";
			var count = 1;
			if (order != 0) {
				$("#" + type + "_banner").empty();
				$(parsedJSON).each(function () {
					if (this.image == 'https://www.marurang.in/media/') {
						product_html += '';
					}
					else {
						product_html += '<div onclick="redirect_to_link(' + this.link + ')" class="a-homeOffers mb-5" style=""><img src="' + this.image + '" class="img-fluid" alt="" srcset="" 	style="object-fit: cover; width: 100%; border-radius: 8px;"></div>';
						count++;
					}
				});
			} else {
			}
			$("#" + type + "_banner").html(product_html);
			document.querySelectorAll('img').forEach(image => { image.src = image.src.replace('-1930-150', '') });
			document.querySelectorAll('img').forEach(image => { image.src = image.src.replace('-1900-320', '') });
		},
	});
}

var swiper = new Swiper(".top-categories", {
	slidesPerView: 3,
	spaceBetween: 30,
	freeMode: true,
	scrollbar: {
		el: ".swiper-scrollbar",
		draggable: true,
		dragSize: '15px'
	},
	navigation: {
		nextEl: ".swiper-button-next",
		prevEl: ".swiper-button-prev",
	},
	breakpoints: {
		640: {
			slidesPerView: 2,
			spaceBetween: 20,
		},
		768: {
			slidesPerView: 6,
			spaceBetween: 40,
		},
		1024: {
			slidesPerView: 8,
			spaceBetween: 50,
		},
	},
});

function timeToMilliseconds(hours, minutes, seconds) {
	return (hours * 60 * 60 * 1000) + (minutes * 60 * 1000) + (seconds * 1000);
}

function updateRemainingTime(hourTimer, minuteTimer, secondTimer, remainingTime) {
	const remainingHours = Math.floor(remainingTime / (60 * 60 * 1000));
	remainingTime %= 60 * 60 * 1000;
	const remainingMinutes = Math.floor(remainingTime / (60 * 1000));
	remainingTime %= 60 * 1000;
	const remainingSeconds = Math.floor(remainingTime / 1000);

	hourTimer.textContent = remainingHours.toString().padStart(2, '0');
	minuteTimer.textContent = remainingMinutes.toString().padStart(2, '0');
	secondTimer.textContent = remainingSeconds.toString().padStart(2, '0');
}

function updateTimerElements(hourTimer, minuteTimer, secondTimer, timer_container) {
	const now = new Date();
	for (let i = 0; i < hourTimer.length; i++) {
		const hourText = hourTimer[i].textContent;
		const minuteText = minuteTimer[i].textContent;
		const secondText = secondTimer[i].textContent;
		const timer_containerText = timer_container[i];

		const hour = parseInt(hourText);
		const minute = parseInt(minuteText);
		const second = parseInt(secondText);

		const timeDiff = timeToMilliseconds(hour, minute, second);

		const futureTime = new Date(now.getTime() + timeDiff);

		// Function to update the countdown
		function update() {
			const remainingTime = futureTime - new Date();
			updateRemainingTime(hourTimer[i], minuteTimer[i], secondTimer[i], remainingTime);
			if (remainingTime > 0) {
				requestAnimationFrame(update);
			}
			else {
				timer_container[i].remove();
			}
		}
		update();
	}
}

function getTimeDiff() {
	const hourTimer = document.querySelectorAll('.timer_text.hour');
	const minuteTimer = document.querySelectorAll('.timer_text.minute');
	const secondTimer = document.querySelectorAll('.timer_text.second');
	const timer_container = document.querySelectorAll('.timer_container');

	updateTimerElements(hourTimer, minuteTimer, secondTimer, timer_container);
}

