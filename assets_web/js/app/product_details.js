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
								<img src="${site_url}media/${this.imgurl}" class="card-img-top product-card-img rounded-4" alt="">
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
						`<div class="swiper-slide product-card-swiper px-2 py-1">
							<a href="${site_url}${this.web_url}?pid=${this.id}&sku=${this.sku}&sid=${this.vendor_id}" class="card h-100 d-flex flex-column justify-content-between product-link-card px-0">
								<div class="d-flex justify-content-between align-items-center" style="margin-top:-21px;">
									<span class="discount text-uppercase">
										<div>${this.offpercent}</div>
									</span>
									<span class="wishlist"><i class="fa fa-heart-o"></i></span>
								</div>
								<div class="image-container zoom-img">
									<img src="${site_url}media/${this.imgurl}" class="zoom-img thumbnail-image">
								</div>
								<div class="product-detail-container p-2 mb-1">
									<div class="justify-content-between align-items-center" style="padding:5px;">
										<p class="dress-name mb-0">${this.name}</p>	
										<div class="d-flex align-items-center justify-content-start flex-row mt-2" style="width: 100%;">
											<span class="new-price">${this.mrp}</span>
											<small class="old-price text-right mx-1">${this.price}</small>
										</div>
									</div>
									<div class="d-flex justify-content-between align-items-center mt-1" style="padding: 0 5px;">
										<div class="d-flex align-items-center">
											<i class="fa-solid fa-star"></i>
											<div class="rating-number">4.8</div>
										</div>
										<button class="btn btn-primary text-center text-uppercase card_buy_btn px-4 py-1" onclick="add_to_cart_product_buy(event, '${this.id}', '${this.sku}', '${this.vendor_id}', '${user_id}', '1', '0', '2', '${qoute_id}')">${default_language === 1 ? 'يشتري' : 'BUY'}</button>
									</div>
								</div>
							</a>
						</div>`;
				});
			} else {
			}
			$("#upsell_product").html(product_html);
			new Swiper('.slider-trending1', {
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
					affiliated_by: secondValue == pid ? firstValue : null,
					devicetype: 2,
					qouteid: qouteid,
					[csrfName]: csrfHash
				},

				success: function (response) {
					ele.innerHTML = buttonInnerHTML;
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
						location.href = site_url + "checkout";
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
		document.querySelector('#cartOffcanvas').querySelector('.offcanvas-body').querySelector('.row').innerHTML = '';
		document.querySelector('#cartOffcanvas').querySelector('.offcanvas-footer').innerHTML = '';
		document.querySelector('#offcanvas-loader').className = "";
		var qty = 1;
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
				affiliated_by: secondValue == pid ? firstValue : null,
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
													<img src="${site_url + 'media/' + cartItem.imgurl}" alt="">
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
							<div class="btn-wrap btn-oc d-flex py-2">
								<a href="${site_url}cart" class="btn btn-lg btn-secondary waves-effect waves-light">
									<div class="d-flex justify-content-center align-items-center h-100">
										<i class="fa-solid fa-cart-shopping"></i>
										<div class="mx-2 mt-1 fw-bolder text-uppercase">${default_language === 1 ? 'استمر في عربة التسوق' : 'Continue to Cart'}</div>
									</div>
								</a>
								<button class="btn btn-lg btn-light waves-effect waves-light">
									<div class="d-flex justify-content-center align-items-center h-100">
										<div class="mx-2 mt-1 fw-bolder text-dark text-uppercase" data-bs-dismiss="offcanvas">${default_language === 1 ? 'مواصلة التسوق' : 'Continue Shopping'}</div>
									</div>
								</button>
							</div>`;
					}, 500);
				}
			},
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
											<img src="${site_url + 'media/' + cartItem.imgurl}" alt="">
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
						<div class="btn-wrap btn-oc d-flex py-2">
							<a href="${site_url}cart" class="btn btn-lg btn-secondary waves-effect waves-light">
								<div class="d-flex justify-content-center align-items-center h-100">
									<i class="fa-solid fa-cart-shopping"></i>
									<div class="mx-2 mt-1 fw-bolder text-uppercase">${default_language === 1 ? 'استمر في عربة التسوق' : 'Continue to Cart'}</div>
								</div>
							</a>
							<button class="btn btn-lg btn-light waves-effect waves-light">
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
											<img src="${site_url + 'media/' + cartItem.imgurl}" alt="">
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
						<div class="btn-wrap btn-oc d-flex py-2">
							<a href="${site_url}cart" class="btn btn-lg btn-secondary waves-effect waves-light">
								<div class="d-flex justify-content-center align-items-center h-100">
									<i class="fa-solid fa-cart-shopping"></i>
									<div class="mx-2 mt-1 fw-bolder text-uppercase">${default_language === 1 ? 'استمر في عربة التسوق' : 'Continue to Cart'}</div>
								</div>
							</a>
							<button class="btn btn-lg btn-light waves-effect waves-light">
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
		var buy_now = '';
		var add_to_cart = '';
		if (default_language == '1') {
			buy_now = 'اشتري الآن';
			add_to_cart = 'أضف إلى السلة';
			out_of_stock = 'إنتهى من المخزن';
		} else {
			buy_now = 'Buy Now';
			add_to_cart = 'Add to Cart';
			out_of_stock = 'Out of Stock';
		}
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
						$('.pBtns1').html(`<button type="button" class="btn btn-lg btn-secondary waves-effect waves-light d-flex align-items-center justify-content-center" style="width: fit-content;"><div class="d-flex justify-content-center align-items-center h-100"><div class="mx-2 mt-1 fw-bolder text-uppercase">${out_of_stock}</div></div></button>`);
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


						if (whats_btn != 10) {
							product_html +=
								`<a href="#" onclick="add_to_cart_product_buynow(this, event,'${pid}','${this.product_attr_sku}','${sid}','${user_id}',1,'',2,'${qoute_id}')" class="btn btn-lg btn-primary waves-effect waves-light">
									<div class="d-flex justify-content-center align-items-center h-100">
										<i class="fa-solid fa-bolt"></i>
										<div class="mx-2 mt-1 fw-bolder text-uppercase">${buy_now}</div>
									</div>
								</a>`;
						}
						if (whats_btn == 10) {
							product_html += '&nbsp;<a target="_blank" href="https://api.whatsapp.com/send?phone=%2B91' + whatsapp_number + '&text=hi"  class="btn btn-success"><svg width="35" height="35" viewBox="2 1 24 24" version="1.1" id="svg8" inkscape:version="0.92.4 (5da689c313, 2019-01-14)" sodipodi:docname="1881161.svg" xmlns:cc="http://creativecommons.org/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  xml:space="preserve"><path id="path4" inkscape:connector-curvature="0" d="M16.6,14c-0.2-0.1-1.5-0.7-1.7-0.8c-0.2-0.1-0.4-0.1-0.6,0.1c-0.2,0.2-0.6,0.8-0.8,1c-0.1,0.2-0.3,0.2-0.5,0.1c-0.7-0.3-1.4-0.7-2-1.2c-0.5-0.5-1-1.1-1.4-1.7c-0.1-0.2,0-0.4,0.1-0.5c0.1-0.1,0.2-0.3,0.4-0.4c0.1-0.1,0.2-0.3,0.2-0.4c0.1-0.1,0.1-0.3,0-0.4c-0.1-0.1-0.6-1.3-0.8-1.8C9.4,7.3,9.2,7.3,9,7.3c-0.1,0-0.3,0-0.5,0C8.3,7.3,8,7.5,7.9,7.6C7.3,8.2,7,8.9,7,9.7c0.1,0.9,0.4,1.8,1,2.6c1.1,1.6,2.5,2.9,4.2,3.7c0.5,0.2,0.9,0.4,1.4,0.5c0.5,0.2,1,0.2,1.6,0.1c0.7-0.1,1.3-0.6,1.7-1.2c0.2-0.4,0.2-0.8,0.1-1.2C17,14.2,16.8,14.1,16.6,14 M19.1,4.9C15.2,1,8.9,1,5,4.9c-3.2,3.2-3.8,8.1-1.6,12L2,22l5.3-1.4c1.5,0.8,3.1,1.2,4.7,1.2h0c5.5,0,9.9-4.4,9.9-9.9C22,9.3,20.9,6.8,19.1,4.9 M16.4,18.9c-1.3,0.8-2.8,1.3-4.4,1.3h0c-1.5,0-2.9-0.4-4.2-1.1l-0.3-0.2l-3.1,0.8l0.8-3l-0.2-0.3C2.6,12.4,3.8,7.4,7.7,4.9S16.6,3.7,19,7.5C21.4,11.4,20.3,16.5,16.4,18.9"/></svg>WhatsApp</a>';

						} else {
							product_html +=
								`<a href="#" onclick="add_to_cart_products(this, event,'${pid}','${this.product_attr_sku}','${sid}','${user_id}',1,'0',2,'${qoute_id}')" class="btn btn-lg btn-secondary waves-effect waves-light d-flex align-items-center justify-content-center mx-2">
								<div class="d-flex justify-content-center align-items-center h-100">
									<i class="fa-solid fa-cart-shopping"></i>
									<div class="mx-2 mt-1 fw-bolder text-uppercase">${add_to_cart}</div>
								</div>
							</a>`;
						}
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