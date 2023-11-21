var filter_array = [];
var price_object = {
    'min_price': '',
    'max_price': ''
};
var sort_id = "";
var rating = '';
var total_pages = 1;
var pageNo = 0;
let isFetching = false;
var functionDelayTimeout;
var pageLoadCount = 0;
var hidden_brandid = $("#hidden_brandid").val();

function get_brand_product(brand_id, sortby, pageno, callback) {
    pageNo = pageno;
    $('.loading-container').removeClass('d-none');
    $.ajax({
        method: "post",
        url: site_url + "shop/brand",
        data: {
            brand_id: brand_id,
            sortby: sortby,
            pageno: pageno,
            [csrfName]: csrfHash,
            language: default_language,
            min_price: price_object['min_price'],
            max_price: price_object['max_price'],
            rating: rating,
            config_attr: JSON.stringify(filter_array),
        },
        success: function (response) {
            //hideloader();
            var parsedJSON = response.Information;
            total_pages = response.total_pages;
            var user_id = $("#user_id").val();
            var order = parsedJSON.length;
            var qoute_id = '';
            var product_html = "";
            if (pageno === 0)
                $("#brand_product").empty();
            if (order != 0 && response.status == 1) {
                for (let i = 0; i < 1; i++) {
                    $(parsedJSON).each(function () {
                        var out_of_stock = "";
                        if (this.stock_status == 'Out of Stock' || this.stock <= '0') {
                            out_of_stock = '<img alt="' + website_name + '" class="outof_stock" src="' + site_url + 'assets/img/out-of-stock-en.png" >';
                        }
                        var ratingHTML = '';
                        if (this.rating.total_rows > 0) {
                            var rating = Math.round((this.rating.total_rating / this.rating.total_rows) * 2) / 2;
                            ratingHTML += `<div class="rating-number mt-1">${rating}</div>`;
                            const wholeNumber = Math.floor(rating);
                            const fractionalPart = rating - wholeNumber;
                            for (let i = 0; i < wholeNumber; i++) {
                                ratingHTML += '<img src="assets_web/images/icons/star-yellow.svg" alt="Star">';
                            }
                            if (fractionalPart >= 0.5) {
                                ratingHTML += '<img src="assets_web/images/icons/half-star.svg" alt="Star">';
                            } else {
                                ratingHTML += '<img src="assets_web/images/icons/star-grey.svg" alt="Star">';
                            }
                            const emptyStars = 5 - wholeNumber - 1;
                            for (let i = 0; i < emptyStars; i++) {
                                ratingHTML += '<img src="assets_web/images/icons/star-grey.svg" alt="Star">';
                            }

                        }
                        product_html +=
                            `<div class="col-6 col-md-4 p-3 position-relative">
                                ${out_of_stock}
                                <a href="${site_url}${this.web_url}?pid=${this.id}&sku=${this.sku}&sid=${this.vendor_id}" class="d-flex flex-column card product-card rounded-4">
                                    <img src="${site_url}/media/${this.imgurl}" class="card-img-top product-card-img rounded-4" alt="${this.name}">
                                    <div class="card-body d-flex flex-column product-card-body">
                                        <h5 class="card-title product-title line-clamp-2 mb-auto">${this.name}</h5>
                                        <div class="d-flex stars py-1">
                                            ${ratingHTML}
                                        </div>
                                        <div class="rent-price py-1">${this.price} / day</div>
                                        <div class="product-location line-clamp-1 py-1">
                                            Subhas Nagar, Dheradun
                                        </div>
                                    </div>
                                </a>
                            </div>`;
                    });
                }
            } else {
                product_html = '<div class="wrap box-shadow-4"><img src="' + site_url + 'assets_web/images/empty-search-result.png" alt="" class="empty-cart-img"><h5>Sorry, no record found!</h5><a href="' + site_url + '" class="btn btn-default">GO TO HOMEPAGE</a></div>';
            }
            setTimeout(() => {
                $('.loading-container').addClass('d-none');
                $("#brand_product").append(product_html);
                callback();
            }, 500);
        },
    });
}

$(document).on('change', '#sort_data_id', function () {
    sort_id = $("#sort_data_id").val();
    isFetching = true;
    get_brand_product(hidden_brandid, sort_id, 0, () => {
        isFetching = false;
    });
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
    get_brand_product(hidden_brandid, sort_id, 0, () => {
        isFetching = false;
    });
});

var radioButtonGroup = document.getElementsByName('rating-radio');

// Add change event listener to the radio button group
radioButtonGroup.forEach(function (radioButton) {
    radioButton.addEventListener('change', function () {
        var selectedValue = this.value;
        rating = selectedValue;
        sort_id = $("#sort_data_id").val();
        isFetching = true;
        get_brand_product(hidden_brandid, sort_id, 0, () => {
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
        console.log('first')
        if (pageNo < total_pages - 1) {
            pageNo++;
            sort_id = $("#sort_data_id").val();
            isFetching = true;
            get_brand_product(hidden_brandid, sort_id, pageNo, () => {
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
                // direction: 'rtl',
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
                        get_brand_product(hidden_brandid, sort_id, 0, () => {
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
                    get_brand_product(hidden_brandid, sort_id, 0, () => {
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
            get_brand_product(hidden_brandid, sort_id, 0, () => {
                isFetching = false;
            });
        });
    }
}

window.addEventListener('load', () => {
    rangeSlider();

    isFetching = true;
    get_brand_product(hidden_brandid, '', 0, () => {
        isFetching = false;
    });

    pageLoadCount++;
});