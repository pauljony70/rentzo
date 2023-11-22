var csrfName = $(".txt_csrfname").attr("name"); //
var csrfHash = $(".txt_csrfname").val(); // CSRF hash
var site_url = $(".site_url").val(); // CSRF hash
var user_id = $("#user_id").val(); // CSRF hash
var recent_id = $("#recent_id").val(); // CSRF hash
var user_pincode = $("#user_pincode").val();

// Get the URL query parameters
const urlParams = new URLSearchParams(window.location.search);

// Check if the "affiliated_by" parameter exists
if (urlParams.has("affiliated_by")) {
	// Get the value of the "affiliated_by" parameter
	const affiliatedByValue = urlParams.get("affiliated_by");
	const pidValue = urlParams.get("pid");

	// Calculate the expiration time for the cookie (30 minutes from now)
	const expirationTime = new Date(Date.now() + 3 * 24 * 60 * 60 * 1000); // 2 days in milliseconds

	// Convert the expiration time to a UTC string format
	const expiresUTC = expirationTime.toUTCString();

	// Save the value to a cookie with the specified expiration time
	document.cookie = `affiliated_by=${affiliatedByValue}-${pidValue}; expires=${expiresUTC}; path=/`;

	// Remove the "affiliated_by" parameter from the URL
	urlParams.delete("affiliated_by");

	// Create the new URL without the "affiliated_by" parameter
	const newUrl = `${window.location.origin}${window.location.pathname}?${urlParams.toString()}${window.location.hash}`;

	// Replace the current URL without triggering a full page reload
	history.replaceState(null, "", newUrl);
}


$(function () {
	window.onload = related_product();
	window.onload = upsell_product();
	if (user_pincode != '0') {
		$('#check_pincode').val(user_pincode);
		window.onload = submit_user_pincode(user_pincode);
	}
	new Swiper('.slider-trending2', {
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
});

/* 
 * ---------------------------------------------------
 * Initialize Desktop Gallery
 * ---------------------------------------------------
 */
var swiper = new Swiper(".product-details-swiper-sm", {
	spaceBetween: 10,
	slidesPerView: 4,
	freeMode: true,
	watchSlidesProgress: true,
});

var swiper2 = new Swiper(".product-details-swiper", {
	spaceBetween: 10,
	loop: true,
	autoplay: {
		delay: 2500,
		disableOnInteraction: true,
	},
	thumbs: {
		swiper: swiper,
	},
	breakpoints: {
		768: {
			autoplay: false,
		},
	},
});


/* 
 * ---------------------------------------------------
 * Initialize Mobile Gallery
 * ---------------------------------------------------
 */
var swiperMobileThumbs = new Swiper(".product-details-swiper-sm-mob", {
	spaceBetween: 10,
	slidesPerView: 3,
	freeMode: true,
	watchSlidesProgress: true,
	direction: 'vertical'
});

var swiperMobileMain = new Swiper(".product-details-swiper-mob", {
	spaceBetween: 10,
	loop: true,
	autoplay: {
		delay: 2500,
		disableOnInteraction: true,
	},
	thumbs: {
		swiper: swiperMobileThumbs,
	},
});

/* 
 * ---------------------------------------------------
 * Mouse hover zoom
 * ---------------------------------------------------
 */
var options2 = {
	fillContainer: true,
	zoomWidth: 500,
	offset: {
		vertical: 0,
		horizontal: 0
	}
};

document.querySelectorAll('Zoom-1').forEach(element => {
	new ImageZoom(element, options2);
});

/* 
 * ---------------------------------------------------
 * Full calender
 * ---------------------------------------------------
 */
var calendarEl = document.getElementById('calendar');
var today = new Date().toISOString().split('T')[0]; // Get today's date in the format 'YYYY-MM-DD'
var unavailableDates = ['2023-11-25', '2023-11-26', '2023-11-27', '2023-11-30']; // Replace with your array of unavailable dates
var selectedDate = null;
var isUnavailableInRange = false;

// Create events for unavailable dates
var unavailableEvents = unavailableDates.map(function (date) {
	return {
		start: date,
		display: 'background',
		color: 'red',
	};
});

var calendar = new FullCalendar.Calendar(calendarEl, {
	headerToolbar: {
		left: 'title',
		center: '',
		right: 'today prev,next'
	},
	events: [
		...unavailableEvents,
		// Add more events as needed
	],

	dateClick: function (info) {
		if (!unavailableDates.includes(info.dateStr) && info.dateStr >= today) {
			// Check if any date in the range is unavailable
			for (var i = 0; i < dateRange; i++) {
				var date = new Date(info.dateStr);
				date.setDate(date.getDate() + i);
				var formattedDate = date.toISOString().split('T')[0];
				if (unavailableDates.includes(formattedDate)) {
					isUnavailableInRange = true;
					break;
				} else {
					isUnavailableInRange = false;
				}
			}

			if (isUnavailableInRange) {
				document.querySelector('.availability-status').classList.remove('text-success');
				document.querySelector('.availability-status').classList.add('text-danger');
				document.querySelector('.availability-status').textContent = "Not available on this date";
				return;
			}

			if (selectedDate) {
				// Remove background color from the previously selected date and its range
				for (var i = 0; i < dateRange; i++) {
					var date = new Date(selectedDate.getAttribute('data-date'));
					date.setDate(date.getDate() + i);
					var formattedDate = date.toISOString().split('T')[0];
					var element = document.querySelector(`[data-date="${formattedDate}"]`);
					if (element) {
						element.classList.remove('selected-date');
					}
				}
			}

			// Update the selectedDate variable and calculate the end date
			selectedDate = info.dayEl;
			endDate = new Date(selectedDate.getAttribute('data-date'));
			endDate.setDate(endDate.getDate() + dateRange - 1);


			// Add background color to the newly selected date and its range
			for (var i = 0; i < dateRange; i++) {
				var date = new Date(info.dateStr);
				date.setDate(date.getDate() + i);
				var formattedDate = date.toISOString().split('T')[0];
				var element = document.querySelector(`[data-date="${formattedDate}"]`);
				if (element) {
					element.classList.add('selected-date');
				}
			}

			document.querySelector('.availability-status').classList.add('text-success');
			document.querySelector('.availability-status').classList.remove('text-danger');
			document.querySelector('.availability-status').textContent = "Available on this date";
			document.getElementById('arrival-date').textContent = moment(info.dateStr).format("DD/MM/YYYY");
			document.getElementById('return-date').textContent = moment(endDate.toISOString().split('T')[0]).format("DD/MM/YYYY");
		}
	},
	eventDidMount: function (info) {
		// Apply conditional cursor style for future dates that are not in the unavailableDates array
		if (info.event.display === 'background') {
			info.el.parentElement.parentElement.parentElement.parentElement.style.cssText = 'cursor: not-allowed';
		}
	}
});

calendar.render();

/* 
 * ---------------------------------------------------
 * Rent Day Slider
 * ---------------------------------------------------
 */
var daysSlider = document.getElementById('day-slider');
var dateRange = 1;

noUiSlider.create(daysSlider, {
	start: 1,
	margin: 20,
	// connect: 'lower',
	connect: true,
	range: {
		'min': 1,
		'max': 7
	},
	step: 2,
	pips: {
		mode: 'steps',
		density: 50,
		format: {
			to: function (value) {
				return value + ' day';
			},
			from: function (value) {
				// In case you need to convert the formatted value back to the original value
				return value.replace(' day', '');
			}
		}
	}
});

var activePips = [null, null];

daysSlider.noUiSlider.on('update', function (values, handle) {
	// Update the dateRange variable
	var newdateRange = Math.round(values[handle]);

	// Check if the new date range includes any unavailable dates
	if (selectedDate) {
		for (var i = 0; i < newdateRange; i++) {
			var date = new Date(selectedDate.getAttribute('data-date'));
			date.setDate(date.getDate() + i);
			var formattedDate = date.toISOString().split('T')[0];
			if (unavailableDates.includes(formattedDate)) {
				// Reset the slider to the previous valid state
				daysSlider.noUiSlider.set(dateRange);

				document.querySelector('.availability-status').classList.remove('text-success');
				document.querySelector('.availability-status').classList.add('text-danger');
				document.querySelector('.availability-status').textContent = "Not available on this date";

				return;
			}
		}
	}

	// Remove background color from the existing selected date range
	if (selectedDate) {
		for (var i = 0; i < dateRange; i++) {
			var date = new Date(selectedDate.getAttribute('data-date'));
			date.setDate(date.getDate() + i);
			var formattedDate = date.toISOString().split('T')[0];
			var element = document.querySelector(`[data-date="${formattedDate}"]`);
			if (element) {
				element.classList.remove('selected-date');
			}
		}
	}

	dateRange = newdateRange;
	document.querySelector('#selected-day').textContent = dateRange + ' Days';
	document.querySelector('#total-rent').textContent = document.querySelector('#day' + dateRange + '_price').textContent;

	// Add background color to the new selected date range
	if (selectedDate) {
		for (var i = 0; i < dateRange; i++) {
			var date = new Date(selectedDate.getAttribute('data-date'));
			date.setDate(date.getDate() + i);
			var formattedDate = date.toISOString().split('T')[0];
			var element = document.querySelector(`[data-date="${formattedDate}"]`);
			if (element) {
				element.classList.add('selected-date');
			}
		}

		endDate = new Date(selectedDate.getAttribute('data-date'));
		endDate.setDate(endDate.getDate() + dateRange - 1);


		document.querySelector('.availability-status').classList.add('text-success');
		document.querySelector('.availability-status').classList.remove('text-danger');
		document.querySelector('.availability-status').textContent = "Available on this date";
		document.getElementById('arrival-date').textContent = moment(selectedDate.getAttribute('data-date')).format("DD/MM/YYYY");
		document.getElementById('return-date').textContent = moment(endDate.toISOString().split('T')[0]).format("DD/MM/YYYY");
	}

	// Remove the active class from the current pip
	if (activePips[handle]) {
		activePips[handle].classList.remove('active-pip');
	}

	// Match the formatting for the pip
	var dataValue = Math.round(values[handle]);

	// Find the pip matching the value
	activePips[handle] = daysSlider.querySelector('.noUi-value[data-value="' + dataValue + '"]');

	// Add the active class
	if (activePips[handle]) {
		activePips[handle].classList.add('active-pip');
	}
});

/* 
 * ---------------------------------------------------
 * Add to cart for rent
 * ---------------------------------------------------
 */
function addto_cart_rent(ele, event, pid, sku, vendor_id, user_id, qty, referid, devicetype, qouteid) {
	event.preventDefault();
	if (user_id == '') {
		window.location.href = site_url.concat('login');
	} else {
		var buttonInnerHTML = ele.innerHTML;
		buttonLoader(ele);
		var qty = 1;
		var rent_price = document.querySelector('#total-rent').textContent.replace(/[^\d.]/g, '');
		var arrivalDateText = moment(document.querySelector('#arrival-date').textContent, 'DD/MM/YYYY', true);
		var returnDateText = moment(document.querySelector('#return-date').textContent, 'DD/MM/YYYY', true);

		if (arrivalDateText.isValid() && returnDateText.isValid()) {
			if (arrivalDateText.isSameOrBefore(returnDateText)) {
				$.ajax({
					method: "post",
					url: site_url + "addProductCartRent",
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
						rent_price: rent_price,
						rent_from_date: arrivalDateText.format('YYYY-MM-DD'),
						rent_to_date: returnDateText.format('YYYY-MM-DD'),
						cart_type: 'Rent',
						[csrfName]: csrfHash,
					},
					success: function (response) {
						addto_cart_count();
						ele.innerHTML = buttonInnerHTML;
						if (!response.status) {
							Swal.fire({
								type: "error",
								text: response.msg,
								showCancelButton: true,
								showCloseButton: true,
								confirmButtonColor: '#ff6600',
								timer: 3000,
							});
						} else {
							window.location = site_url + "cart";
						}
					},
				});
			} else {
				ele.innerHTML = buttonInnerHTML;
				nativeToast({
					message: 'Return date should be after or equal to arrival date',
					position: 'bottom',
					type: 'error',
					square: true,
					edge: false,
					debug: false
				});
			}
		} else {
			ele.innerHTML = buttonInnerHTML;
			nativeToast({
				message: 'Choose arrival and return date',
				position: 'bottom',
				type: 'error',
				square: true,
				edge: false,
				debug: false
			});
		}
	}
}

var shareIcon = document.querySelector('.share-icon');
var hoverCard = document.querySelector('.hover-card');

shareIcon.addEventListener('click', function () {
	if (hoverCard.style.display === 'block') {
		shareIcon.classList.remove('active');
		hoverCard.style.display = 'none';
	} else {
		shareIcon.classList.add('active');
		hoverCard.style.display = 'block';
	}
});

document.addEventListener('click', function (e) {
	if (!shareIcon.contains(e.target) && !hoverCard.contains(e.target)) {
		shareIcon.classList.remove('active');
		hoverCard.style.display = 'none';
	}
});


function submit_user_pincode(user_pincode) {

	var csrfName = $('.txt_csrfname').attr('name');
	var csrfHash = $('.txt_csrfname').val();
	var site_url = $('.site_url').val();

	var spinner = '<div  role="status"><span class="se-only"></span></div> Wait..';
	$('.pincodeBtn').html(spinner);
	$.ajax({

		method: 'get',
		url: site_url + 'checkpincode',
		data: {
			language: 1,
			pincode: user_pincode,
			devicetype: 2,
			[csrfName]: csrfHash
		},

		success: function (response) {
			$('.pincodeBtn').text('Check');
			$('#pincode_msg').html(response);
		}

	});


}

function submit_pincode(event) {
	event.preventDefault();
	var csrfName = $('.txt_csrfname').attr('name');
	var csrfHash = $('.txt_csrfname').val();
	var site_url = $('.site_url').val();
	var check_pincode = $('#check_pincode').val();
	if (check_pincode.length < 6) {
		$('#pincode_msg').html('Invalid Pincode');
	}
	else {
		var spinner = '<div  role="status"><span class="se-only"></span></div> Wait..';
		$('.pincodeBtn').html(spinner);
		$.ajax({
			method: 'get',
			url: site_url + 'checkpincode',
			data: {
				language: 1,
				pincode: check_pincode,
				devicetype: 2,
				[csrfName]: csrfHash
			},
			success: function (response) {
				$('.pincodeBtn').text('Check');
				$('#pincode_msg').html(response);
			}
		});
	}
}

/* 
 * ---------------------------------------------------
 * Related products
 * ---------------------------------------------------
 */
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
			var parsedJSON = response.Information;
			var order = parsedJSON.length;
			var product_html = "";
			if (order != 0) {
				$("#related_product").empty();
				$(parsedJSON).each(function () {
					product_html +=
						`<div class="swiper-slide">
							<a href="${site_url}${this.web_url}?pid=${this.id}&sku=${this.sku}&sid=${this.vendor_id}" class="d-flex flex-column card product-card rounded-4">
								<div class="product-card-img zoom-img">
									<img src="${site_url}media/${this.imgurl}" class="card-img-top product-card-img rounded-4" alt="">
								</div>
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
			$("#related_product").html(product_html);
			new Swiper('.slider-trending', {
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
 * Upsell Products
 * ---------------------------------------------------
 */
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
						`<div class="swiper-slide">
							<a href="${site_url}${this.web_url}?pid=${this.id}&sku=${this.sku}&sid=${this.vendor_id}" class="d-flex flex-column card product-card rounded-4">
								<div class="product-card-img zoom-img">
									<img src="${site_url}media/${this.imgurl}" class="card-img-top product-card-img rounded-4" alt="">
								</div>
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
			$("#upsell_product").html(product_html);
			new Swiper('.slider-trending', {
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

function add_to_cart_product_buynow(ele, event, pid, sku, vendor_id, user_id, qty, referid, devicetype, qouteid) {
	var csrfName = $('.txt_csrfname').attr('name'); // 
	var csrfHash = $('.txt_csrfname').val(); // CSRF hash
	var site_url = $('.site_url').val(); // CSRF hash
	event.preventDefault();
	if (user_id == '') {
		window.location.href = site_url.concat('login');
	} else {
		var buttonInnerHTML = ele.innerHTML;
		buttonLoader(ele);
		var qty = 1;
		if (qty == '') {

			Swal.fire({
				position: "center",
				//icon: "success",
				title: "Please Select Qty",
				showConfirmButton: true,
				confirmButtonText: "ok",
				confirmButtonColor: "#f42525",
				timer: 3000,
			});

		} else {
			var firstValue = '';
			var secondValue = '';
			const affiliated_by = getCookie("affiliated_by");
			if (affiliated_by) {
				const parts = affiliated_by.split('-');
				if (parts.length === 2) {
					firstValue = parts[0];
					secondValue = parts[1];
				}
			}

			$.ajax({

				method: 'post',
				url: site_url + 'buynowProductCart',
				data: {
					language: default_language,
					pid: pid,
					sku: sku,
					sid: vendor_id,
					user_id: user_id,
					qty: qty,
					referid: referid,
					//affiliated_by: secondValue == pid ? firstValue : null,
					devicetype: 2,
					qouteid: qouteid,
					[csrfName]: csrfHash
				},

				success: function (response) {
					//ele.innerHTML = buttonInnerHTML;
					addto_cart_count();

					if (!response.status) {
						Swal.fire({
							type: "error",
							text: response.msg,
							showCancelButton: true,
							showCloseButton: true,
							confirmButtonColor: '#ff6600',
							timer: 3000,
						});
					}
					else {
						location.href = site_url + "cart";
					}
				}
			});
		}
	}
}

function add_to_cart_products(
	ele,
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
	if (user_id == '') {
		window.location.href = site_url.concat('login');
	} else {
		var buttonInnerHTML = ele.innerHTML;
		buttonLoader(ele);
		Swal.fire({
			title: 'The buying price of this product is ' + '<br>' + document.querySelector('#product-price').value,
			text: 'Click ok to add this product in your cart',
			type: "warning",
			showCancelButton: true,
			showCloseButton: true,
		}).then(function (res) {
			if (res.value) {
				document.querySelector('#cartOffcanvas').querySelector('.offcanvas-body').querySelector('.row').innerHTML = '';
				document.querySelector('#cartOffcanvas').querySelector('.offcanvas-footer').innerHTML = '';
				document.querySelector('#offcanvas-loader').className = "";
				var qty = 1;
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
						addto_cart_count();
						ele.innerHTML = buttonInnerHTML;
						if (!response.status) {
							Swal.fire({
								type: "error",
								text: response.msg,
								showCancelButton: true,
								showCloseButton: true,
								confirmButtonColor: '#ff6600',
								timer: 3000,
							});
						} else {
							var bsOffcanvas = new bootstrap.Offcanvas('#cartOffcanvas');
							bsOffcanvas.show();
							setTimeout(() => {
								document.querySelector('#cartOffcanvas').querySelector('.offcanvas-body').querySelector('.row').innerHTML = '';
								document.querySelector('#offcanvas-loader').classList.add('d-none');
								response.Information.forEach(cartItem => {
									document.querySelector('#cartOffcanvas').querySelector('.offcanvas-body').querySelector('.row').innerHTML +=
										`<div class="col-12 mb-3 px-0">
											<div class="card">
												<div class="card-body">
													<div class="row">
														<div class="col-3">
															<img class="w-100 object-fit-cover" src="${site_url + 'media/' + cartItem.imgurl}" alt="">
														</div>
														<div class="col-9">
															<div class="d-flex flex-column">
																<div class="d-flex align-items-center justify-content-between">
																	<div class="cart-prod-title mb-2">${cartItem.name}</div>
																	<i class="fa-regular fa-trash-can ms-2" onclick="delete_cart('${cartItem.prodid}','${user_id}','${qouteid}')" style="cursor: pointer; position: absolute; top: 17px;${default_language == 1 ? `left: 10px;` : `right: 10px`}"></i>
																</div>
																<div class="rate mb-2">
																	<h5>${cartItem.price}</h5>
																	<div class="old-price mb-1">${cartItem.mrp}</div>
																	<div class="off-price text-success"><span>${cartItem.offpercent}</span></div>
																</div>
																<div class="quantity mb-2">
																	<div class="input-group">
																		<button type="button" class="btn btn-primary p-0 text-center" type="button" id="" onclick="add_product_qty(this, '${cartItem.prodid}','${cartItem.sku}','${cartItem.vendor_id}','${user_id}',${parseInt(cartItem.qty) - 1},'',2,'${qouteid}')"><i class="fa-solid fa-minus mt-1"></i></button>
																		<input type="number" class="form-control p-0 py-1 text-center" placeholder="" value="${cartItem.qty}" readonly>
																		<button type="button" class="btn btn-primary p-0 text-center" type="button" id="" onclick="add_product_qty(this, '${cartItem.prodid}','${cartItem.sku}','${cartItem.vendor_id}','${user_id}',${parseInt(cartItem.qty) + 1},'',2,'${qouteid}')"><i class="fa-solid fa-plus mt-1"></i></button>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>`;
								});
								document.querySelector('#cartOffcanvas').querySelector('.offcanvas-footer').innerHTML =
									`<div class="d-flex align-items-center justify-content-between p-2">
										<div class="cart-count">${response.Information.length} ${default_language === 1 ? 'غرض' : 'Item'}</div>
										<div class="cart-total d-flex align-items-center">
											<div class="cart-total-text">${default_language === 1 ? 'المجموع الفرعي' : 'Subtotal'} : </div>
											<div class="cart-total-value">&nbsp;${response.total_price}</div>
										</div>
									</div>
									<hr class="m-0 px-2">
									<div class="btn-oc d-flex py-2">
										<a href="${site_url}cart" class="btn btn-lg btn-secondary waves-effect waves-light w-100">
											<div class="d-flex justify-content-center align-items-center h-100">
												<i class="fa-solid fa-cart-shopping"></i>
												<div class="mx-2 mt-1 fw-bolder text-uppercase">${default_language === 1 ? 'استمر في عربة التسوق' : 'Continue to Cart'}</div>
											</div>
										</a>
										<button class="btn btn-lg btn-light waves-effect waves-light w-100">
											<div class="d-flex justify-content-center align-items-center h-100">
												<div class="mx-2 mt-1 fw-bolder text-dark text-uppercase" data-bs-dismiss="offcanvas">${default_language === 1 ? 'مواصلة التسوق' : 'Continue Shopping'}</div>
											</div>
										</button>
									</div>`;
							}, 500);
						}
					},
				});
			} else {
				ele.innerHTML = buttonInnerHTML;
			}
		});
	}
}

function add_product_qty(
	ele,
	prod_id,
	sku,
	vendor_id,
	user_id,
	qty,
	referid,
	devicetype,
	qouteid
) {
	$.ajax({
		method: "post",
		url: site_url + "addProductCart",
		data: {
			language: default_language,
			pid: prod_id,
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
			//$(".table").load(location.href + " .table");
			//alert(response.msg);
			// alert(response.status);
			//location.reload();
			if (response.status == 1) {
				document.querySelector('#cartOffcanvas').querySelector('.offcanvas-body').querySelector('.row').innerHTML = '';
				document.querySelector('#offcanvas-loader').classList.add('d-none');
				response.Information.forEach(cartItem => {
					document.querySelector('#cartOffcanvas').querySelector('.offcanvas-body').querySelector('.row').innerHTML +=
						`<div class="col-12 mb-3 px-0">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<img class="w-100 object-fit-cover" src="${site_url + 'media/' + cartItem.imgurl}" alt="">
										</div>
										<div class="col-9">
											<div class="d-flex flex-column">
												<div class="d-flex align-items-center justify-content-between">
													<div class="cart-prod-title mb-2">${cartItem.name}</div>
													<i class="fa-regular fa-trash-can ms-2" onclick="delete_cart('${cartItem.prodid}','${user_id}','${qouteid}')" style="cursor: pointer; position: absolute; top: 17px;${default_language == 1 ? `left: 10px;` : `right: 10px`}"></i>
												</div>
												<div class="rate mb-2">
													<h5>${cartItem.price}</h5>
													<div class="old-price mb-1">${cartItem.mrp}</div>
													<div class="off-price text-success"><span>${cartItem.offpercent}</span></div>
												</div>
												<div class="quantity mb-2">
													<div class="input-group">
														<button type="button" class="btn btn-primary p-0 text-center" type="button" id="" onclick="add_product_qty(this, '${cartItem.prodid}','${cartItem.sku}','${cartItem.vendor_id}','${user_id}',${parseInt(cartItem.qty) - 1},'',2,'${qouteid}')"><i class="fa-solid fa-minus mt-1"></i></button>
														<input type="number" class="form-control p-0 py-1 text-center" placeholder="" value="${cartItem.qty}" readonly>
														<button type="button" class="btn btn-primary p-0 text-center" type="button" id="" onclick="add_product_qty(this, '${cartItem.prodid}','${cartItem.sku}','${cartItem.vendor_id}','${user_id}',${parseInt(cartItem.qty) + 1},'',2,'${qouteid}')"><i class="fa-solid fa-plus mt-1"></i></button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>`;
				});
				document.querySelector('#cartOffcanvas').querySelector('.offcanvas-footer').innerHTML =
					`<div class="d-flex align-items-center justify-content-between p-2">
						<div class="cart-count">${response.Information.length} ${default_language === 1 ? 'غرض' : 'Item'}</div>
							<div class="cart-total d-flex align-items-center">
								<div class="cart-total-text">${default_language === 1 ? 'المجموع الفرعي' : 'Subtotal'} : </div>
								<div class="cart-total-value">&nbsp;${response.total_price}</div>
							</div>
						</div>
						<hr class="m-0 px-2">
						<div class="btn-oc d-flex py-2">
							<a href="${site_url}cart" class="btn btn-lg btn-secondary waves-effect waves-light w-100">
								<div class="d-flex justify-content-center align-items-center h-100">
									<i class="fa-solid fa-cart-shopping"></i>
									<div class="mx-2 mt-1 fw-bolder text-uppercase">${default_language === 1 ? 'استمر في عربة التسوق' : 'Continue to Cart'}</div>
								</div>
							</a>
							<button class="btn btn-lg btn-light waves-effect waves-light w-100">
								<div class="d-flex justify-content-center align-items-center h-100">
									<div class="mx-2 mt-1 fw-bolder text-dark text-uppercase" data-bs-dismiss="offcanvas">${default_language === 1 ? 'مواصلة التسوق' : 'Continue Shopping'}</div>
								</div>
							</button>
						</div>`;
			} else {
				if (response.msg !== 'Cart invalid request') {
					Swal.fire({
						title: response.msg,
						type: 'error',
						confirmButtonColor: '#FF6600',
						confirmButtonText: 'OK',
						timer: 1000
					});
				}
			}

		},
	});
}

function delete_cart(prod_id, user_id, qouteid) {
	$.ajax({
		method: "post",
		url: site_url + "deleteProductCart",
		data: {
			language: default_language,
			pid: prod_id,
			devicetype: 2,
			user_id: user_id,
			qouteid: qouteid,
			[csrfName]: csrfHash,
		},
		success: function (response) {
			if (response.status == 1) {
				document.querySelector('#cartOffcanvas').querySelector('.offcanvas-body').querySelector('.row').innerHTML = '';
				document.querySelector('#offcanvas-loader').classList.add('d-none');
				response.Information.forEach(cartItem => {
					document.querySelector('#cartOffcanvas').querySelector('.offcanvas-body').querySelector('.row').innerHTML +=
						`<div class="col-12 mb-3 px-0">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<img class="w-100 object-fit-cover" src="${site_url + 'media/' + cartItem.imgurl}" alt="">
										</div>
										<div class="col-9">
											<div class="d-flex flex-column">
												<div class="d-flex align-items-center justify-content-between">
													<div class="cart-prod-title mb-2">${cartItem.name}</div>
													<i class="fa-regular fa-trash-can ms-2" onclick="delete_cart('${cartItem.prodid}','${user_id}','${qouteid}')" style="cursor: pointer; position: absolute; top: 17px;${default_language == 1 ? `left: 10px;` : `right: 10px`}"></i>
												</div>
												<div class="rate mb-2">
													<h5>${cartItem.price}</h5>
													<div class="old-price mb-1">${cartItem.mrp}</div>
													<div class="off-price text-success"><span>${cartItem.offpercent}</span></div>
												</div>
												<div class="quantity mb-2">
													<div class="input-group">
														<button type="button" class="btn btn-primary p-0 text-center" type="button" id="" onclick="add_product_qty(this, '${cartItem.prodid}','${cartItem.sku}','${cartItem.vendor_id}','${user_id}',${parseInt(cartItem.qty) - 1},'',2,'${qouteid}')"><i class="fa-solid fa-minus mt-1"></i></button>
														<input type="number" class="form-control p-0 py-1 text-center" placeholder="" value="${cartItem.qty}" readonly>
														<button type="button" class="btn btn-primary p-0 text-center" type="button" id="" onclick="add_product_qty(this, '${cartItem.prodid}','${cartItem.sku}','${cartItem.vendor_id}','${user_id}',${parseInt(cartItem.qty) + 1},'',2,'${qouteid}')"><i class="fa-solid fa-plus mt-1"></i></button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>`;
				});
				document.querySelector('#cartOffcanvas').querySelector('.offcanvas-footer').innerHTML =
					`<div class="d-flex align-items-center justify-content-between p-2">
						<div class="cart-count">${response.Information.length} ${default_language === 1 ? 'غرض' : 'Item'}</div>
							<div class="cart-total d-flex align-items-center">
								<div class="cart-total-text">${default_language === 1 ? 'المجموع الفرعي' : 'Subtotal'} : </div>
								<div class="cart-total-value">&nbsp;${response.total_price}</div>
							</div>
						</div>
						<hr class="m-0 px-2">
						<div class="btn-oc d-flex py-2">
							<a href="${site_url}cart" class="btn btn-lg btn-secondary waves-effect waves-light w-100">
								<div class="d-flex justify-content-center align-items-center h-100">
									<i class="fa-solid fa-cart-shopping"></i>
									<div class="mx-2 mt-1 fw-bolder text-uppercase">${default_language === 1 ? 'استمر في عربة التسوق' : 'Continue to Cart'}</div>
								</div>
							</a>
							<button class="btn btn-lg btn-light waves-effect waves-light w-100">
								<div class="d-flex justify-content-center align-items-center h-100">
									<div class="mx-2 mt-1 fw-bolder text-dark text-uppercase" data-bs-dismiss="offcanvas">${default_language === 1 ? 'مواصلة التسوق' : 'Continue Shopping'}</div>
								</div>
							</button>
						</div>`;
			} else {
				if (response.msg !== 'Cart invalid request') {
					Swal.fire({
						title: response.msg,
						type: 'error',
						confirmButtonColor: '#FF6600',
						confirmButtonText: 'OK',
						timer: 1000
					});
				}
			}
		},
	});
}

function getRandomInt(min, max) {
	return Math.random() * (max - min) + min
}

//create the random transform 
const keyframeRandomMove = () => Math.floor(getRandomInt(-100, 100))

//create random animation to the page using style tag
const keyframesMove = (index) =>
	`<style class="style-move-heart">
		@keyframes move-heart-${index} {
		from {transform: translate(-50%, -50%); opacity: 1;}
		to {transform: translate(${keyframeRandomMove()}%, ${keyframeRandomMove()}%); opacity: 0;}
		}
		.move-heart-${index} {
			animation: move-heart-${index} 1s 0s ease-in-out forwards;
		}
	</style>`

//mini-heart structure
const heart = ({
	color,
	moveSideWise,
	moveUpOrDown
}, index) => `<i class="fa-solid fa-heart add-to-wishlist sub-hearts move-heart-${index}" style="top:${moveSideWise()}%; left:${moveUpOrDown()}%;"></i>`

//object with all info to create mini-hearts with random position
const heartsDirection = {
	numberOfHearts: () => Math.floor(getRandomInt(6, 10)), //random from 3 to 6
	moveSideWise: () => Math.floor(getRandomInt(0, 100)), //random from 0 to 70%
	moveUpOrDown: () => Math.floor(getRandomInt(0, 100)), //random from 0 to 70%
	color: '#f48120',
}

// consts
const heartContainer = () => document.querySelector('.heart-container')
const heartButton = () => document.querySelector('.add-to-wishlist')
const allSubHearts = () => document.querySelectorAll('.sub-hearts')
const jsStyleForAnimation = () => document.querySelectorAll('.style-move-heart')

// Object Destructuring to be used in for loop
const {
	numberOfHearts
} = heartsDirection;

function add_to_wishlist(event, pid, sku, vendor_id, user_id, qty, referid, devicetype) {
	event.preventDefault();
	document.querySelector('.heart-container .d-flex').innerHTML = '<div class="spinner-grow spinner-grow-sm text-warning" role="status"><span class="visually-hidden">Loading...</span></div>'
	if (user_id == '') {
		Swal.fire({
			position: "center",
			//icon: "success",
			title: 'please login to add product into wishlist',
			showConfirmButton: false,
			confirmButtonColor: '#f42525',
			timer: 1500
		})
	}

	var csrfName = $('.txt_csrfname').attr('name'); //
	var csrfHash = $('.txt_csrfname').val(); // CSRF hash
	var site_url = $('.site_url').val(); // CSRF hash
	$.ajax({
		method: 'post',
		url: site_url + 'addProductWishlist',
		data: {
			language: 1,
			pid: pid,
			sku: sku,
			sid: vendor_id,
			user_id: user_id,
			qty: qty,
			referid: referid,
			devicetype: 2,
			[csrfName]: csrfHash
		},
		success: function (response) {
			if (response.status) {
				document.querySelector('.heart-container .d-flex').innerHTML = '<i class="fa-solid fa-heart add-to-wishlist"></i>';
				for (let i = 1; i < numberOfHearts(); i++) {
					heartContainer().insertAdjacentHTML('beforeend', heart(heartsDirection, i))
					document.head.insertAdjacentHTML("beforeend", keyframesMove(i))
				}
				nativeToast({
					message: default_language == 1 ? 'أضيف لقائمة الأماني' : 'Added to wishlist',
					position: 'bottom',
					type: 'success',
					square: true,
					edge: false,
					debug: false,
					// timeout: 1000000
				});
			} else {
				document.querySelector('.heart-container .d-flex').innerHTML = '<i class="fa-regular fa-heart add-to-wishlist"></i>';
			}
			wishlist_count();
		}
	});
}

function get_product_attributes(tag) {
	$("#" + tag.replace(/[^a-zA-Z0-9]/g, '_') + "_attr_id").attr("checked", true);

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
		var whats_btn = $("#whats_btn").val();
		var whatsapp_number = $("#whatsapp_number").val();
		var jsons = JSON.stringify(attribute_array);
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
				$("#btn-mb").empty();

				$(parsedJSON).each(function () {
					const attributeImageLinks = document.querySelectorAll('.attribute-image');
					if (attributeImageLinks.length) {
						var lastIndex = swiper2.slides.length - 1;
						swiper2.removeSlide(lastIndex);
						swiper.removeSlide(lastIndex);
					}
					if (this.product_price == '' || this.product_stock == 0) {
						$('.pBtns').html(`<button type="button" class="btn btn-lg btn-secondary waves-effect waves-light d-flex align-items-center justify-content-center" style="width: fit-content;"><div class="d-flex justify-content-center align-items-center h-100"><div class="mx-2 mt-1 fw-bolder text-uppercase">${out_of_stock}</div></div></button>`);
					} else {

						if (this.imgurl != '') {

							swiper.appendSlide(
								`<div class="swiper-slide my-auto attribute-image">
									<img src="${site_url}media/${this.imgurl}" />
								</div>`
							);

							swiper2.appendSlide(
								'<a class="swiper-slide my-auto spotlight zoom-img attribute-image" data-page="false" data-animation="fade" data-control="zoom,fullscreen,close" data-theme="white" data-autohide=false href="' + site_url + 'media/' + this.imgurl + '"><img src="' + site_url + 'media/' + this.imgurl + '" /></a>'
							);

							lastIndex = swiper2.slides.length - 1;
							swiper2.slideTo(lastIndex);
						}
						$("#product-price").html(this.product_price);
						$("#mrp").html(this.product_mrp);
						var discount = (this.product_mrp.replace(/\D/g, '')) - (this.product_price.replace(/\D/g, ''));
						$("#total_saving").html('JD' + discount);

						product_html +=
							`<a class="btn btn-warning" data-bs-toggle="offcanvas" href="#rentOffcanvas" role="button" aria-controls="rentOffcanvas">For Rent</a>

							<a href="#" onclick="add_to_cart_products(this, event,'${pid}','${this.product_attr_sku}','${sid}','${user_id}',1,'0',2,'${qoute_id}')" class="btn btn-primary">
								Buy Now
							</a>`;
						$(".pBtns").html(product_html);
						$(".pBtns").append(
							`<a class="btn btn-light wishlist-btn heart-container mx-2" onclick="add_to_wishlist(event,'${pid}','${this.product_attr_sku}','${sid}','${user_id}',1,'',2)">
								<div class="d-flex justify-content-center align-items-center h-100">
									<i class="fa-${this.wishlist_count > 0 ? 'solid' : 'regular'} fa-heart add-to-wishlist"></i>
								</div>
							</a>`
						);
						$("#btn-mb").html(product_html);
					}
				});
			},
		});
	}
}

$('#myInput').hide();
$('#coupon_name').hide();

const spL = document.getElementById("spotlight");
if (spL) {
	const copyLink = document.querySelector(".spl-autofit");
	const url = window.location.href;

	if (copyLink) {

		copyLink.addEventListener("click", () => {
			navigator.clipboard.writeText(url);
			alert("URL Copied");
		})
	} else {
		console.log("not")
	}
} else {
	console.log("not fnd")
}

function copy_link() {
	event.preventDefault();

	var copyText = document.getElementById("myInput");
	copyText.select();
	copyText.setSelectionRange(0, 99999); /* For mobile devices */

	navigator.clipboard.writeText(copyText.value);


	Toastify({
		text: "Copied Links !",
		duration: 1500,
		newWindow: false,
		close: false,
		gravity: "bottom", // `top` or `bottom`
		position: "center", // `left`, `center` or `right`
		stopOnFocus: true, // Prevents dismissing of toast on hover
		style: {
			background: "linear-gradient(to right, #f42525, #f42525)",
		},
		onClick: function () { } // Callback after click
	}).showToast();
}

function copy_vendor_coupon() {

	var copyText = document.getElementById("coupon_name");
	copyText.select();
	copyText.setSelectionRange(0, 99999); /* For mobile devices */

	navigator.clipboard.writeText(copyText.value);


	Toastify({
		text: "Coupon Copied!",
		duration: 1500,
		newWindow: false,
		close: false,
		gravity: "bottom", // `top` or `bottom`
		position: "center", // `left`, `center` or `right`
		stopOnFocus: true, // Prevents dismissing of toast on hover
		style: {
			background: "linear-gradient(to right, #f42525, #f42525)",
		},
		onClick: function () { } // Callback after click
	}).showToast();



}

$("#review_form").submit(function (event) {
	event.preventDefault();

	var ProductReview = $("#ProductReview").val();
	var reviewtitle = $("#reviewtitle").val();
	var pid = $("#pid").val();
	var user_id = $("#user_id").val();
	var rating = $('.rating_star input[type="radio"]:checked').val() || 0;

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

			if (response.status) {
				$('#reviewsModal').hide();
				Swal.fire({
					title: 'SUCCESS',
					text: response.msg,
					type: "success",
					confirmButtonColor: '#ff6600',
					showCloseButton: true,
				}).then((res) => {
					location.reload();
				});
			} else {
				Swal.fire({
					title: 'FAILED',
					text: response.msg,
					type: "warning",
					confirmButtonColor: '#ff6600',
					showCloseButton: true,
					timer: 3000,
				})
			}
		},
	});
});

/* $(window).scroll(function () {
	var scrollTop = $(this).scrollTop();
	$('.nav_inner').css({
		opacity: function () {
			var elementHeight = $('.left-block').height() - 120,
				opacity = ((1 - (elementHeight - scrollTop) / elementHeight) * 0.8) + 0;
			return opacity;
		}
	});
	if (scrollTop >= $('.left-block').height() - 48) {
		document.getElementsByClassName("responsive_nav")[0].style["boxShadow"] = "0 0 5px #999999";
	} else {
		document.getElementsByClassName("responsive_nav")[0].style["boxShadow"] = "";
	}
}); */

function mobileShareLink(url) {
	if (navigator.share) {
		navigator.share({
			title: document.title,
			url: url
		})
			.then(() => console.log('Link shared successfully.'))
			.catch((error) => console.log('Error sharing link:', error));
	} else {
		console.log('Sharing not supported on this device.');
	}
}