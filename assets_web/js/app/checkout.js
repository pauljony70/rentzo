$(function () {
    //window.onload = get_checkout_data();
    window.onload = getStatedata();
    window.onload = getCitydata(0);
});

$('.dropify').dropify();

$('#state').on('change', function () {
    getCitydata(this.value);
});


function getStatedata() {
    $.ajax({
        method: 'POST',
        url: site_url + "get_state",
        data: {
            language: default_language,
            [csrfName]: csrfHash
        },
        success: function (response) {
            // successmsg(response); // display response from the PHP script, if any
            var data = $.parseJSON(response);
            $('#state').empty();
            $('#tcity').empty();
            var o = new Option("Select State", "");
            $("#state").append(o);
            if (data["status"] == "1") {
                $getcity = true;
                var stateid = ''
                $firstitemid = '';
                $firstitemflag = true;
                $(data["data"]).each(function () {
                    if (stateid === this.id) {
                        var o = new Option(this.name, this.id);
                        $("#state").append(o);
                        $('#state').val(this.id);
                        $getcity = false;
                    } else {
                        var o = new Option(this.name, this.id);
                        $("#state").append(o);
                    }

                    if ($firstitemflag == true) {
                        $firstitemflag = false;
                        $firstitemid = this.id;
                    }
                });

                if ($getcity == true) {
                    $getcity = false;
                }

            } else {
                successmsg(data["msg"]);
            }
        }
    });
}

function getCitydata(stateid) {
    $.ajax({
        method: 'POST',
        url: site_url + "get_city",
        data: {
            stateid: stateid,
            [csrfName]: csrfHash
        },
        success: function (response) {
            var data = $.parseJSON(response);
            $('#city').empty();
            var o = new Option("Select City", "");
            $("#city").append(o);
            if (data["status"] == "1") {
                var cityid = '';

                $(data["data"]).each(function () {
                    if (cityid === this.id) {
                        var o = new Option(this.name, this.id);
                        $("#city").append(o);
                        $('#city').val(this.id);

                    } else {
                        var o = new Option(this.name, this.id);
                        $("#city").append(o);
                    }
                });
            } else {
                successmsg(data["msg"]);
            }
        }
    });
}


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
        await verifyKycDocument();

        // alert("call true");


        // alert(" place order req send ");
        var coupon_code = $('#coupon_code').val();
        var coupon_value = $('#coupo_discount_value').text();

        $.ajax({
            method: "post",
            url: site_url + "placeOrder",
            data: {
                language: default_language,
                fullname: $("#fullname_a").val(),
                mobile: $("#mobile").val(),
                locality: '',
                fulladdress: $("#fulladdress").val(),
                city: $('#city').find(":selected").text(),
                state: $('#state').find(":selected").text(),
                pincode: $("#pincode").val(),
                addresstype: 'Home',
                email: $("#email").val(),
                payment_id: 'Pay12345',
                payment_mode: 'COD',
                city_id: $("#city option:selected").val(),
                coupon_code: coupon_code,
                coupon_value: coupon_value,
                [csrfName]: csrfHash,
            },
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
                    console.log(this);
                    $('#lat').val(this.lat);
                    $('#lng').val(this.lng);
                    initMap();
                    $("#fullname_a").val(this.fullname);
                    $("#email").val(this.email);
                    iti.setNumber(`+${this.country_code}${this.mobile}`)
                    $("#fulladdress").val(this.fulladdress);
                    $("#country").val($("#country option:contains('" + this.country + "')").val());
                    if (this.country_id == 1) {
                        $('#region-div').html(
                            `<label class="form-label"><?= $this->lang->line('region'); ?></label>
                            <select name="region" id="region" class="form-select">
                                <option value=""><?= $this->lang->line('select_region'); ?></option>
                            </select>
                            <span id="error"></span>`);
                        $('#governorates-div').html(
                            `<label class="form-label"><?= $this->lang->line('governorate'); ?></label>
                            <select name="governorates" id="governorates" class="form-select">
                            <option value=""><?= $this->lang->line('select_governorate'); ?></option>
                            </select>
                            <span id="error"></span>`);
                        $('#area-div').html(
                            `<label class="form-label"><?= $this->lang->line('area'); ?></label>
                            <select name="area" id="area" class="form-select">
                                <option value=""><?= $this->lang->line('select_area'); ?></option>
                            </select>
                            <span id="error"></span>`);
                        getRegiondata($("#country").val());
                        setTimeout(() => {
                            $("#region").val($("#region option:contains('" + this.region + "')").val());
                            getGovernoratedata($("#region").val());
                            setTimeout(() => {
                                $("#governorates").val($("#governorates option:contains('" + this.governorate + "')").val());
                                getAreadata($("#governorates").val());
                                setTimeout(() => {
                                    $("#area").val($("#area option:contains('" + this.area + "')").val());
                                }, 400);
                            }, 400);
                        }, 400);
                    } else {
                        $('#region-div').html(
                            `<label class="form-label"><?= $this->lang->line('region'); ?></label>
                            <input type="text" class="form-control" id="region" name="region" value="${this.region}" />
                            <span id="error"></span>`);
                        $('#governorates-div').html(
                            `<label class="form-label"><?= $this->lang->line('governorate'); ?></label>
                            <input type="text" class="form-control" id="governorates" name="governorates" value="${this.governorate}" />
                            <span id="error"></span>`);
                        $('#area-div').html(
                            `<label class="form-label"><?= $this->lang->line('area'); ?></label>
                            <input type="text" class="form-control" id="area" name="area" value="${this.area}" />
                            <span id="error"></span>`);
                    }

                    user_pincode = '743144';
                }
            });
            get_checkout_data(user_pincode);
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