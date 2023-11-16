var devicetype = 1;
var filter_array = [];
var price_object = {
    'min_price': '',
    'max_price': ''
};
var sort_id = '';
var rating = '';
var total_pages = 1;
var pageNo = 0;
let isFetching = false;
var functionDelayTimeout;
var pageLoadCount = 0;
var hidden_catid = $("#hidden_catid").val();

function get_category_product(catid, sortby, pageno, callback) {
    pageNo = pageno;
    $('.loading-container').removeClass('d-none');
    $.ajax({
        method: "post",
        url: site_url + "getCategoryProduct",
        data: {
            catid: catid,
            sortby: sortby,
            pageno: pageno,
            [csrfName]: csrfHash,
            language: default_language,
            min_price: price_object['min_price'],
            max_price: price_object['max_price'],
            rating: rating,
            devicetype: devicetype,
            config_attr: JSON.stringify(filter_array),
        },
        success: function (response) {
            var parsedJSON = response.Information;
            total_pages = response.total_pages;
            var qoute_id = '';
            var order = parsedJSON.length;
            var product_html = "";
            if (pageno === 0)
                $("#category_product").empty();
            if (order != 0 && response.status == 1) {
                for (let i = 0; i < 10; i++) {
                    $(parsedJSON).each(function () {
                        var out_of_stock = "";
                        if (this.stock_status == 'Out of Stock' || this.stock <= '0') {
                            out_of_stock = '<img alt="' + website_name + '" class="outof_stock" src="' + site_url + 'assets/img/out-of-stock-en.png" >';
                        }
                        var ratingHTML = '';
                        if (this.rating.total_rows > 0) {
                            var ratingHTML =
                                `<i class="fa-solid fa-star fa-lg"></i>
                                        <span class="rating-number">${(this.rating.total_rating / this.rating.total_rows).toFixed(1)}</span>`;
                        }
                        product_html +=
                            `<div class="col-6 col-sm-4 col-lg-3 p-3">
                                ${out_of_stock}
                                <a href="${site_url}${this.web_url}?pid=${this.id}&sku=${this.sku}&sid=${this.vendor_id}" class="card h-100 d-flex flex-column justify-content-between product-link-card px-0">
                                    <!--<div class="d-flex justify-content-between align-items-center" style="margin-top:-21px;">
                                        <span class="discount text-uppercase">
                                            <div>${this.offpercent}</div>
                                        </span>
                                        <span class="wishlist"><i class="fa fa-heart-o"></i></span>
                                    </div>-->
                                    <div class="image-container zoom-img">
                                        <img src="${site_url}/media/${this.imgurl}" class="zoom-img thumbnail-image">
                                    </div>
                                    <div class="product-detail-container p-2 mb-1">
                                        <div class="justify-content-between align-items-center">
                                            <p class="dress-name mb-0">${this.name}</p>	
                                            <div class="d-flex justify-content-start flex-row mt-2" style="width: 100%;">
                                                <span class="new-price mx-1">${this.price}</span>
                                                <small class="old-price text-right mx-1">${this.mrp}</small>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center pt-1">
                                            <div class="d-flex align-items-center">
                                                ${ratingHTML}
                                            </div>
                                            <button class="btn btn-primary text-center text-uppercase card_buy_btn px-4 py-1" onclick="add_to_cart_product_buy(event, '${this.id}', '${this.sku}', '${this.vendor_id}', '${user_id}', '1', '0', '2', '${qoute_id}')">Buy</button>
                                        </div>
                                    </div>
                                </a>
                            </div>`;

                    });
                }
            } else {
                product_html = '<div class="wrap box-shadow-4"><img src="' + site_url + 'assets_web/images/empty-search-result.png" alt="" class="empty-cart-img"><h5></h5><a href="' + site_url + '" class="btn btn-default"></a></div>';
            }
            setTimeout(() => {
                $('.loading-container').addClass('d-none');
                $("#category_product").append(product_html);
                callback();
            }, 500);
        },
    });
}

$(document).on('change', '#sort_data_id', function () {
    sort_id = $("#sort_data_id").val();
    isFetching = true;
    get_category_product(hidden_catid, sort_id, 0, () => {
        isFetching = false;
    });
    get_category_sponsor_product(hidden_catid, sort_id, 0);
});

$(document).on('change', '#flexCheckChecked', function () {
    sort_id = $("#sort_data_id").val();
    if (this.checked) {
        var check_val = $(this).val();
        var attr_id = $(this).closest('div').find('#attr_id').val();
        var attr_name = $(this).closest('div').find('#attr_name').val();
        filter_array.push({
            "attr_id": attr_id,
            "attr_name": attr_name,
            "attr_value": check_val
        });
    } else {
        var check_val = $(this).val();
        var parsedJSON = filter_array;
        for (var i = 0; i < parsedJSON.length; i++) {
            var counter = parsedJSON[i];
            if (counter.attr_value.includes(check_val)) {
                parsedJSON.splice(i, 1);
            }
        }
    }
    isFetching = true;
    get_category_product(hidden_catid, sort_id, 0, () => {
        isFetching = false;
    });
    get_category_sponsor_product(hidden_catid, sort_id, 0);
});

var radioButtonGroup = document.getElementsByName('rating-radio');

// Add change event listener to the radio button group
radioButtonGroup.forEach(function (radioButton) {
    radioButton.addEventListener('change', function () {
        var selectedValue = this.value;
        rating = selectedValue;
        sort_id = $("#sort_data_id").val();
        isFetching = true;
        get_category_product(hidden_catid, sort_id, 0, () => {
            isFetching = false;
        });
    });
});

// Pagination
window.addEventListener('scroll', () => {
    if (isFetching) return;
    const {
        scrollHeight,
        scrollTop,
        clientHeight
    } = document.documentElement;
    if (scrollTop + clientHeight >= scrollHeight - 100) {
        if (pageNo < total_pages - 1) {
            pageNo++;
            sort_id = $("#sort_data_id").val();
            isFetching = true;
            get_category_product(hidden_catid, sort_id, pageNo, () => {
                isFetching = false;
            });
        }
    }
});

function rangeSlider() {
    var rangeSlider = document.getElementsByClassName('noui-slider-range');
    if (rangeSlider.length > 0) {
        var rangeSliders = Array.from(rangeSlider);
        rangeSliders.forEach(slider => {
            var nouiMin = parseFloat(slider.getAttribute('data-range-min'));
            var nouiMax = parseFloat(slider.getAttribute('data-range-max'));
            var nouiSelectedMin = parseFloat(slider.getAttribute('data-range-selected-min'));
            var nouiSelectedMax = parseFloat(slider.getAttribute('data-range-selected-max'));
            var rangeText = slider.parentElement.previousElementSibling;
            var imin = rangeText.firstElementChild;
            var imax = rangeText.lastElementChild;
            var inputs = [imin, imax];

            noUiSlider.create(slider, {
                start: [nouiSelectedMin, nouiSelectedMax],
                connect: true,
                step: 0.01,
                range: {
                    min: [nouiMin],
                    max: [nouiMax]
                }
            });

            slider.noUiSlider.on("update", function (values, handle) {
                inputs[handle].value = values[handle];
                if (pageLoadCount > 0) {
                    clearTimeout(functionDelayTimeout);
                    functionDelayTimeout = setTimeout(function () {
                        price_object['min_price'] = values[0];
                        price_object['max_price'] = values[1];
                        sort_id = $("#sort_data_id").val();
                        isFetching = true;
                        get_category_product(hidden_catid, sort_id, 0, () => {
                            isFetching = false;
                        });
                    }, 500);
                }
            });

            document.querySelector('#clear-all-filter').addEventListener('click', function () {
                slider.noUiSlider.set([nouiMin, nouiMax]);
                imin.value = nouiMin;
                imax.value = nouiMax;
                price_object['min_price'] = nouiMin;
                price_object['max_price'] = nouiMax;
                clearTimeout(functionDelayTimeout);
                functionDelayTimeout = setTimeout(function () {
                    pageLoadCount = 0;
                    sort_id = $("#sort_data_id").val();
                    document.querySelectorAll('input[type="checkbox"]').forEach(function (checkbox) {
                        checkbox.checked = false;
                    });
                    document.querySelectorAll('input[type="radio"]').forEach(function (radio) {
                        radio.checked = false;
                    });
                    rating = '';
                    filter_array = [];
                    isFetching = true;
                    get_category_product(hidden_catid, sort_id, 0, () => {
                        isFetching = false;
                    });
                }, 500);
            });
        });
    } else {
        document.querySelector('#clear-all-filter').addEventListener('click', function () {
            pageLoadCount = 0;
            sort_id = $("#sort_data_id").val();
            document.querySelectorAll('input[type="checkbox"]').forEach(function (checkbox) {
                checkbox.checked = false;
            });
            document.querySelectorAll('input[type="radio"]').forEach(function (radio) {
                radio.checked = false;
            });
            rating = '';
            filter_array = [];
            isFetching = true;
            get_category_product(hidden_catid, sort_id, 0, () => {
                isFetching = false;
            });
        });
    }
}

window.addEventListener('load', () => {
    rangeSlider();

    isFetching = true;
    get_category_product(hidden_catid, '', 0, () => {
        isFetching = false;
    });
    get_category_sponsor_product(hidden_catid, "", 0);

    pageLoadCount++;
});


function get_category_sponsor_product(catid, sortby, pageno) {
    $.ajax({
        method: "post",
        url: site_url + "getCategorysponsorProduct",
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

            var qoute_id = '';

            var order = parsedJSON.length;
            var product_html = "";
            if (order != 0) {
                $("#category_sponsor_product").empty();
                $(parsedJSON).each(function () {
                    product_html +=
                        `<div class="mx-2 py-2" style="width:20rem;">
                            <a href="${site_url}${this.web_url}?pid=${this.id}&sku=${this.sku}&sid=${this.vendor_id}" class="card h-100 d-flex flex-column justify-content-between product-link-card px-0">
                                <div class="image-container mt-3 zoom-img">
                                    <div class="first">
                                        <div class="d-flex justify-content-between align-items-center" style="margin-top:-21px;">
                                            <span class="discount">-25%</span>
                                            <span class="wishlist"><i class="fa fa-heart-o"></i></span>
                                        </div>
                                    </div>
                                    <img src="${this.imgurl}" class="thumbnail-image">
                                </div>
                                <div class="product-detail-container p-2 mb-1">
                                    <div class="justify-content-between align-items-center">
                                        <p class="dress-name mb-0">${this.name}</p>	
                                        <div class="d-flex justify-content-start flex-row mt-2" style="width: 100%;">
                                            <span class="new-price mx-1">${this.mrp}</span>
                                            <small class="old-price text-right mx-1">${this.price}</small>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mt-3 pt-1">
                                        <div>
                                            <i class="fa-solid fa-star fa-lg" style="color: #ff6600;"></i>
                                            <span class="rating-number">4.8</span>
                                        </div>
                                        <button class="btn btn-primary text-center card_buy_btn px-4 py-1" onclick="add_to_cart_product_buy(event, '${this.id}', '${this.sku}', '${this.vendor_id}', '${user_id}', '1', '0', '2', '${qoute_id}')">BUY</button>
                                    </div>
                                </div>
                            </a>
                        </div>`

                });
            }
            $("#category_sponsor_product").html(product_html);
        },
    });
}