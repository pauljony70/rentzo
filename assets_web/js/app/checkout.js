$(function () {
    //window.onload = get_checkout_data();
    window.onload = getStatedata();
    window.onload = getCitydata(0);
});

$('.dropify').dropify();

$('#state').on('change', function () {
    getCitydata(this.value);
});

var timeout = null;

function get_checkout_data() {
    var user_pincode = $('#pincode').val();
    document.getElementById('placeOrderBtn').disabled = true;
    $.ajax({
        method: "post",
        url: site_url + "checkout",
        data: {
            language: default_language,
            coupon_code: '',
            shipping_pincode: user_pincode,
            [csrfName]: csrfHash
        },
        success: function (response) {
            var parsedJSON = response.Information;

            $(parsedJSON).each(function () {
                $('#total_mrp').text(this.total_mrp);
                $('#total_mrp1').text(this.total_mrp);
                $('#discount_value').text(this.total_discount);
                $('#discount_value1').text(this.total_discount);
                $('#tex_value').text(this.tax_payable);
                $('#tex_value1').text(this.tax_payable);
                $('#shipping_fee').text(this.shipping_fee === 0 ? 'FREE' : this.shipping_fee);
                $('#shipping_fee1').text(this.shipping_fee === 0 ? 'FREE' : this.shipping_fee);
                $('#total_val').text(this.payable_amount);
                $('#total_val1').text(this.payable_amount);
                document.getElementById('placeOrderBtn').disabled = false;
            });
        }
    });
}

const verifyKycDocument = async () => {
    var documentType = document.querySelector("#documentType");
    var kycDocument = document.querySelector("#kyc-document");

    var flag_documentType = 0;
    var flag_kycDocument = 0;

    var firstErrorElement = null;

    if (documentType.value == '') {
        flag_documentType = 0;
        setSelectErrorMsg(documentType, '<i class="fa-solid fa-circle-xmark"></i> Document type is required.');
        if (!firstErrorElement) {
            firstErrorElement = documentType;
        }
    } else {
        flag_documentType = 1;
        setSelectSuccessMsg(documentType);
    }

    if (kycDocument.value == '') {
        flag_kycDocument = 0;
        setDropifyErrorMsg(kycDocument, kycDocument.parentElement.parentElement.querySelector('#error'), '<i class="fa-solid fa-circle-xmark"></i> Choose a document.');
        if (!firstErrorElement) {
            firstErrorElement = kycDocument;
        }
    } else {
        flag_kycDocument = 1;
        setDropifySuccessMsg(kycDocument, kycDocument.parentElement.parentElement.querySelector('#error'));
    }

    if (firstErrorElement) {
        firstErrorElement.focus();
    }

    if (flag_documentType === 1 && flag_kycDocument === 1) {
        try {
            var kycDocumentvalue = $('#kyc-document').prop('files')[0];
            var form_data = new FormData();
            form_data.append('kyc_document', kycDocumentvalue);
            form_data.append([csrfName], csrfHash);

            await new Promise((resolve, reject) => {
                $.ajax({
                    method: 'post',
                    url: site_url + '/verify-document/ocr/' + documentType.value,
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    success: function (response) {
                        if (response.success) {
                            setDropifySuccessMsg(kycDocument, kycDocument.parentElement.parentElement.querySelector('#error'));
                            resolve(); // Resolve the promise if successful
                        } else {
                            setDropifyErrorMsg(kycDocument, kycDocument.parentElement.parentElement.querySelector('#error'), `<i class="fa-solid fa-circle-xmark"></i> ${response.message}`);
                            documentType.focus();
                            reject(response.message); // Reject the promise with an error
                        }
                    }
                });
            });
        } catch (error) {
            throw new Error(error); // Propagate the error up the call stack
        }
    } else {
        throw new Error('Validation failed'); // Throw an error if validation fails
    }
}

async function place_order_data(ele) {
    ele.disabled = true;
    buttonLoader(ele);

    try {
        // Wait for both functions to complete
        await validateAddressForm();
        if (document.getElementById('cart_type').value === 'rent')
            await verifyKycDocument();

        var coupon_code = $('#coupon_code').val();
        var coupon_value = $('#coupo_discount_value').text();

        var form_data = new FormData();
        form_data.append('language', default_language);
        form_data.append('fullname', $("#fullname_a").val());
        form_data.append('mobile', $("#mobile").val());
        form_data.append('locality', '');
        form_data.append('fulladdress', $("#fulladdress").val());
        form_data.append('city', $('#city').find(":selected").text());
        form_data.append('city_id', $("#city").val());
        form_data.append('state', $('#state').find(":selected").text());
        form_data.append('state_id', $("#state").val());
        form_data.append('pincode', $("#pincode").val());
        form_data.append('addresstype', 'Home');
        form_data.append('email', $("#email").val());
        form_data.append('payment_id', 'Pay12345');
        form_data.append('payment_mode', $('input[name="flexRadioDefault"]:checked').val());
        form_data.append('coupon_code', coupon_code);
        form_data.append('coupon_value', coupon_value);
        form_data.append('kyc_document', document.getElementById('cart_type').value === 'rent' ? $('#kyc-document').prop('files')[0] : null);
        form_data.append([csrfName], csrfHash);

        $.ajax({
            method: "post",
            url: site_url + "placeOrder",
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            success: function (response) {

                if (response.status == 1) {
                    var order_id = response.Information.order_id;
                    location.href = site_url + "thankyou/" + order_id;

                } else {
                    /*Swal.fire({
                        position: "center",
                        //icon: "success",
                        title: response.Information.order_msg,
                        showConfirmButton: false,
                        confirmButtonColor: "#ff5400",
                        timer: 3000,
                    });*/
                }
            },
        });

    } catch (error) {
        // At least one of the functions failed
        // console.error('Error:', error);

        ele.disabled = false;
        ele.innerHTML = "Place Order"
    }
}


$(document).on('change', '.defaultAdderess', function () {
    var address_id = $('.defaultAdderess:checked').val();
    var user_id = $('#user_id').val();
    var total_value = $("#total_value").val();
    var seller_pincode = $('#seller_pincode').val();
    var user_pincode = '';
    $.ajax({
        method: "post",
        url: site_url + "getUserAddress",
        data: {
            language: default_language,
            user_id: user_id,
            [csrfName]: csrfHash
        },
        success: function (response) {
            var parsedJSON = response.Information.address_details;

            $(parsedJSON).each(function () {
                if (address_id == this.address_id) {
                    $("#fullname_a").val(this.fullname);
                    $("#email").val(this.email);
                    $("#mobile").val(this.mobile);
                    $("#fulladdress").val(this.fulladdress);
                    $("#pincode").val(this.pincode);
                    $("#state").val(this.state_id);
                    $('#city').val(this.city_id);
                    get_checkout_data(this.pincode);
                }
            });
        }
    });
});

function apply_coupon(event) {
    var total_value = $("#total_value").val();
    var coupon_code = $("#coupon_code").val();
    event.preventDefault();

    $.ajax({
        method: "post",
        url: site_url + "apply_coupon",
        data: {
            language: 1,
            coupon_code: coupon_code,
            price: "1000",
            [csrfName]: csrfHash,
        },
        success: function (response) {
            //hideloader();
            Swal.fire({
                position: "center",
                //icon: "success",
                title: response.msg,
                showConfirmButton: false,
                confirmButtonColor: "#ff5400",
                timer: 3000,
            });
            //alert(response.msg);
            //location.reload();
        },
    });
}


$(document).ready(function () {
    $('#placeOrderBtn').click((event) => {
        place_order_data(event.target);
    })
    /* $("#address_div_id").click(function () {
        event.preventDefault();
        var user_id = $('#user_id').val();
        if (user_id == '') {
            $("#address_div").toggle();
            //  document.getElementById('formoid').querySelector('#address_save_btn').style.display = 'none';
        } else {
            // location.href = site_url + 'myaddress';
            $("#address_div").toggle();
        }
    }); */
});