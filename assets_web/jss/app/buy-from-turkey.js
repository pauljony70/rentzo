const product_link_form = document.getElementById('product-link-form');
const product_link_1 = product_link_form.querySelector('#product-link');
const shop_now_btn = document.querySelector('#shop-now-btn');
const buy_from_turkey_form_form = document.getElementById('buy-from-turkey-form');
const product_link_2 = buy_from_turkey_form_form.querySelector('#modal-product-link');
const product_quantity = buy_from_turkey_form_form.querySelector('#product-qty');
const product_size = buy_from_turkey_form_form.querySelector('#product-size');
const product_color = buy_from_turkey_form_form.querySelector('#product-color');
const product_des = buy_from_turkey_form_form.querySelector('#product-des');
const product_img1 = buy_from_turkey_form_form.querySelector('#product-img-1');
const screenshot_1_error = buy_from_turkey_form_form.querySelector('#screenshot-1-error');
const screenshot_2_error = buy_from_turkey_form_form.querySelector('#screenshot-2-error');
const product_img2 = buy_from_turkey_form_form.querySelector('#product-img-2');
const buyfrom_turkey_form_sumbit_btn = buy_from_turkey_form_form.querySelector('#buy-from-turkey-sumbit');
const modalLoader = document.getElementById('modal-loader');

const getAllActiveTurkishBrands = () => {
    $.ajax({
        method: "post",
        url: site_url + "turkish-brands",
        data: {
            language: default_language,
            [csrfName]: csrfHash,
        },
        success: function (response) {
            // var parsedJSON = JSON.parse(response);
            var product_html = "";
            if (response.status) {
                $(response.Information).each(function () {
                    product_html +=
                        `<div class="col-6 col-lg-3 col-xl-2 py-3">
                            <div class="card h-100 box-shadow-4">
                                <a href="${this.brand_site_url}" target="_blank">
                                    <div class="card-body">
                                        <img src="${myApp.siteUrl}media/${JSON.parse(this.brand_img)['72-72']}" alt="Image" class="card-img-top">
                                        ${this.popular_brand == 1 ? '<div class="position-absolute top-0 start-0 shimmer-effect" style="background-color: #f48120; color: #fff; font-weight: 900; padding: 0px 9px;">Popular</div>' : ''}
                                    </div>
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title text-center">${this.brand_name}</h5>
                                </div>
                            </div>
                        </div>`;
                });
            } else {
                product_html = "No Record Found.";
            }
            setTimeout(() => {
                $("#turkish-brand-row").html(product_html);
            }, 500);
        },
    });
}

const validateBuyFromTurkeyForm = () => {
    var flag_product_link_2 = 0;
    var flag_product_quantity = 0;
    var flag_product_size = 0;
    var flag_product_color = 0;
    var flag_product_des = 0;
    var flag_product_img1 = 0;
    var flag_product_img2 = 0;

    if (product_link_2.value == '' && isValidLink(product_link_2.value)) {
        flag_product_link_2 = 0;
        if (default_language === 1)
            setErrorMsg(product_link_2, '<i class="fa-solid fa-circle-xmark"></i> أضف رابط منتج صالح للمتابعة.');
        else
            setErrorMsg(product_link_2, '<i class="fa-solid fa-circle-xmark"></i> Add a valid product link to continue.');
    } else {
        flag_product_link_2 = 1;
        setSuccessMsg(product_link_2);
    }

    if (product_quantity.value == '') {
        flag_product_quantity = 0;
        if (default_language === 1)
            setErrorMsg(product_quantity, '<i class="fa-solid fa-circle-xmark"></i> كمية المنتج مطلوبة.');
        else
            setErrorMsg(product_quantity, '<i class="fa-solid fa-circle-xmark"></i> Product quantity is required.');
    } else {
        flag_product_quantity = 1;
        setSuccessMsg(product_quantity);
    }

    if (product_size.value == '') {
        flag_product_size = 0;
        if (default_language === 1)
            setErrorMsg(product_size, '<i class="fa-solid fa-circle-xmark"></i> حجم المنتج مطلوب.');
        else
            setErrorMsg(product_size, '<i class="fa-solid fa-circle-xmark"></i> Product size is required.');
    } else {
        flag_product_size = 1;
        setSuccessMsg(product_size);
    }

    if (product_color.value == '') {
        flag_product_color = 0;
        if (default_language === 1)
            setErrorMsg(product_color, '<i class="fa-solid fa-circle-xmark"></i> لون المنتج مطلوب.');
        else
            setErrorMsg(product_color, '<i class="fa-solid fa-circle-xmark"></i> Product colour is required.');
    } else {
        flag_product_color = 1;
        setSuccessMsg(product_color);
    }

    if (product_des.value == '') {
        flag_product_des = 0;
        if (default_language === 1)
            setErrorMsg(product_des, '<i class="fa-solid fa-circle-xmark"></i> وصف المنتج مطلوب.');
        else
            setErrorMsg(product_des, '<i class="fa-solid fa-circle-xmark"></i> Product description is required.');
    } else {
        flag_product_des = 1;
        setSuccessMsg(product_des);
    }

    if (product_img1.value == '') {
        flag_product_img1 = 0;
        if (default_language === 1)
            setDropifyErrorMsg(product_img1, screenshot_1_error, '<i class="fa-solid fa-circle-xmark"></i> مطلوب لقطة شاشة العنصر.');
        else
            setDropifyErrorMsg(product_img1, screenshot_1_error, '<i class="fa-solid fa-circle-xmark"></i> Item screenshot is required.');
    } else {
        flag_product_img1 = 1;
        setDropifySuccessMsg(product_img1, screenshot_1_error);
    }

    if (product_img2.value == '') {
        flag_product_img2 = 0;
        if (default_language === 1)
            setDropifyErrorMsg(product_img2, screenshot_2_error, '<i class="fa-solid fa-circle-xmark"></i> مطلوب لقطة شاشة العنصر.');
        else
            setDropifyErrorMsg(product_img2, screenshot_2_error, '<i class="fa-solid fa-circle-xmark"></i> Item screenshot is required.');
    } else {
        flag_product_img2 = 1;
        setDropifySuccessMsg(product_img2, screenshot_2_error);
    }

    if (flag_product_link_2 === 1 && flag_product_quantity === 1 && flag_product_size === 1 && flag_product_color === 1 && flag_product_des === 1 && flag_product_img1 === 1 && flag_product_img2 === 1) {
        return true;
    } else {
        return false;
    }
}

const submitBuyFromTurkeyFrom = () => {
    modalLoader.classList.remove('d-none');
    if (validateBuyFromTurkeyForm()) {
        buyfrom_turkey_form_sumbit_btn.classList.add('disabled-link');
        var form_data = new FormData();
        form_data.append('language', default_language);
        form_data.append('user_id', myApp.userId);
        form_data.append('product_link', product_link_2.value);
        form_data.append('product_size', product_size.value);
        form_data.append('product_quantity', product_quantity.value);
        form_data.append('product_color', product_color.value);
        form_data.append('product_des', product_des.value);
        form_data.append('product_img_1', product_img1.files[0]);
        form_data.append('product_img_2', product_img2.files[0]);
        form_data.append('country', 'Turkey');
        form_data.append('status', 'requested');
        form_data.append([csrfName], csrfHash);

        $.ajax({
            method: 'post',
            url: site_url + 'submit-shopping-request',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            success: function (response) {
                $('#buyFromTurkey').modal('hide');
                modalLoader.classList.add('d-none');
                initializeBuyFromTurkeyForm();
                if (response.status) {
                    Swal.fire({
                        title: 'SUCCESS',
                        text: response.msg,
                        type: "success",
                        confirmButtonColor: '#ff6600',
                        showCloseButton: true
                    }).then((res) => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        title: 'FAILED',
                        text: response.msg,
                        type: "error",
                        confirmButtonColor: '#ff6600',
                        showCloseButton: true
                    }).then((res) => {
                        location.reload();
                    });
                }
            },
            error: function (xhr, status, error) {
                // Handle error here
                $('#buyFromTurkey').modal('hide');
                modalLoader.classList.remove('d-none');
                initializeBuyFromTurkeyForm();
                Swal.fire({
                    title: 'FAILED',
                    text: error,
                    type: "error",
                    confirmButtonColor: '#ff6600',
                    showCloseButton: true
                }).then((res) => {
                    location.reload();
                });;
            }
        });
    } else {
        modalLoader.classList.add('d-none');
    }
}

const isValidLink = (url) => {
    const pattern = /^(ftp|http|https):\/\/[^ "]+$/;
    return pattern.test(url);
};

const initializeBuyFromTurkeyForm = () => {
    document.querySelectorAll('input').forEach(input => {
        input.value = "";
    });
    document.querySelectorAll('textarea').forEach(input => {
        input.value = "";
    });
}

$(document).ready(function () {
    getAllActiveTurkishBrands();

    /* product_link_1.addEventListener('input', () => {
        product_link_2.value = product_link_1.value;
    }); */

    shop_now_btn.addEventListener('click', () => {
        product_link_2.value = product_link_1.value;
        if (myApp.userId !== '') {
            if (product_link_1.value !== '' && isValidLink(product_link_1.value)) {
                setSuccessMsg(product_link_1);
                $('#buyFromTurkey').modal('show');
            } else {
                if (default_language == 1)
                    setErrorMsg(product_link_1, '<i class="fa-solid fa-circle-xmark"></i> أضف رابط منتج صالح للمتابعة.');
                else
                    setErrorMsg(product_link_1, '<i class="fa-solid fa-circle-xmark"></i> Add a valid product link to continue.');
            }
        } else {
            window.location.href = myApp.siteUrl.concat('login')
        }
    });

    buy_from_turkey_form_form.addEventListener('submit', (event) => {
        event.preventDefault();

        submitBuyFromTurkeyFrom();
    })

    buyfrom_turkey_form_sumbit_btn.addEventListener('click', (event) => {
        event.preventDefault();

        submitBuyFromTurkeyFrom();
    })
});


