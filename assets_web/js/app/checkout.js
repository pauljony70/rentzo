$(function () {
    //window.onload = get_checkout_data();
    window.onload = getStatedata();
    window.onload = getCitydata(0);
});

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

function convertToNumber(str) {
    // Remove all commas from the string
    const withoutCommas = str.replace(/,/g, '');

    // Extract the number from the string and convert it to a float
    const number = parseFloat(withoutCommas.slice(1));

    return number;
}

// Place order button visiblity
const payment_options = document.paymentOptions.flexRadioDefault;
const place_order_btn_div = document.getElementById('place-order-btn-div');
var prev = null;

function AllowOnlyNumbers(e) {
    e = (e) ? e : window.event;
    var clipboardData = e.clipboardData ? e.clipboardData : window.clipboardData;
    var key = e.keyCode ? e.keyCode : e.which ? e.which : e.charCode;
    var str = (e.type && e.type == "paste") ? clipboardData.getData('Text') : String.fromCharCode(key);
    return (/^\d+$/.test(str));
}


var csrfName = $(".txt_csrfname").attr("name"); //
var csrfHash = $(".txt_csrfname").val(); // CSRF hash
var site_url = $(".site_url").val(); // CSRF hash

function get_checkout_data(user_pincode) {
    //alert('ssss');
    $('#coupon_message').html('');
    var input_code = $('#coupon_code').val();
    var city = $("#city option:selected").val();
    $(".paymentMethodBtn").prop('disabled', true);
    $.ajax({
        method: "post",
        url: site_url + "checkout",
        data: {
            language: default_language,
            coupon_code: input_code,
            shipping_city: city,
            shipping_pincode: user_pincode,
            [csrfName]: csrfHash
        },
        success: function (response) {

            var parsedJSON = response.Information;
            var product_html = "";
            $(".paymentMethod").empty();
            $('#total_discount_data').text();
            if (response.status == 2) {
                $('#coupon_message').html(response.msg);
                /*Swal.fire({
                    position: "center",
                    //icon: "success",
                    title: response.msg,
                    showConfirmButton: false,
                    confirmButtonColor: "#ff5400",
                    timer: 3000,
                });*/
            }
            $(parsedJSON).each(function () {
                $('#payable_value').text(this.total_mrp);
                $('#discount_value').text(this.total_discount);
                $('#tex_value').text(this.tax_payable);
                $('#shipping_fee').text(this.shipping_fee === 0 ? 'FREE' : this.shipping_fee);
                $('#total_val').text(this.payable_amount);
                $('#coupon_message').html();
                //alert(this.shipping_fee);
                if (this.coupon_code != '') {
                    $('#total_discount_data').text('Total Savings :' + this.coupon_discount_text);
                    $('#coupo_discount_value').text(this.coupon_discount);
                    $('#coupon_message').html('Coupon applied successfully.');
                }
                $(".paymentMethodBtn").prop('disabled', false);

                /*product_html += '<a onclick="place_order_data(event)" href="javascript:void(0);" class="btn btn-default paymentMethodBtn">Place Order</a>';
                $(".paymentMethod").html(product_html);
                alert(this.payable_amount);*/
            });
            //alert(response);
        }
    });
}

function get_shipping() {
    var pincode = $('#pincode').val();
    get_checkout_data(pincode);
}

function place_order_data(event) {
    var tab = 'true';


    var address_id = $('#defaultAdderess:checked').val();
    var user_id = $('#user_id').val();


    var fullname = $("#fullname_a").val();
    var mobile = $("#mobile").val();
    var state = $("#state").val();
    var pincode = $("#pincode").val();
    var city = $("#city").val();
    var email = $("#email").val();
    var user_id = $("#user_id").val();
    var fulladdress = $("#fulladdress").val();
    var city_id = $("#city option:selected").val();


    const validateAddressForm = () => {
        if ($('#fullname_a').val() !== '' && $('#fulladdress').val() !== '' && $('#city').val() !== '' && $('#state').val() !== '' && $('#pincode').val() !== '' && $('#mobile').val() !== '' && $('#email').val() !== '') {
            /*Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'saved',
                showConfirmButton: false,
                timer: 1500
            });*/
            return true;
        } else if ($('#fullname_a').val() !== '' || $('#fulladdress').val() !== '' || $('#city').val() !== '' || $('#city').val() !== 'Select' || $('#state').val() !== '' || $('#state').val() !== 'Select State' || $('#pincode').val() !== '' || $('#mobile').val() !== '' || $('#email').val() !== '') {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: "Please fill all the required field",
                showConfirmButton: false,
                timer: 1500
            });
            return true;
        } else {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: "Your address can't be blank",
                showConfirmButton: false,
                timer: 1500
            });
            return false;
        }
    }

    if (fullname == '') {
        Swal.fire({
            position: "center",
            //icon: "success",
            title: 'Please Select Address',
            showConfirmButton: false,
            confirmButtonColor: "#ff5400",
            timer: 3000,
        });
    } else {


        if (fulladdress == "" || fulladdress == null && fullname == "" || fullname == null && state == "" || state == null && city == "" || city == null) {

            if (fullname == "" || fullname == null) {
                $("#fullname1_error").text("Please Add Name.");
            } else {
                $("#fullname1_error").text("");
            }
            if (mobile == "" || mobile == null) {
                $("#mobile_error").text("Please Add Mobile No.");
            } else {
                $("#mobile_error").text("");
            }
            if (state == "" || state == null) {
                $("#state_error").text("Please Select State.");
            } else {
                $("#state_error").text("");
            }
            //else if(pincode == "" || pincode == null)
            //{
            //alert('please Add Pincode.');
            //}
            if (city == "" || city == null) {
                $("#city_error").text("Please Select City.");
            } else {
                $("#city_error").text("");
            }

            if (email == "" || email == null) {
                $("#emails_error").text("Please Add Emails.");
            } else {
                $("#emails_error").text("");
            }

            if (fulladdress == "" || fulladdress == null) {
                $("#fulladdress_error").text("Please Add Full Address.");
            } else {
                $("#fulladdress_error").text("");
            }

            /*if( ){
              /// write address filed validation code
            }else if(){ */

        } else {

            $("#fullname1_error").text("");
            $("#emails_error").text("");
            $("#mobile_error").text("");
            $("#state_error").text("");
            $("#city_error").text("");
            $("#fulladdress_error").text("");

            if (tab == 'true') {

                // alert("call true");

                var spinner = '<div class="spinner-border" role="status"><span class="se-only"></span></div> Please Wait..';
                $('.paymentMethodBtn').html(spinner);
                // $(".paymentMethodBtn").prop('disabled', true);
                $('.paymentMethodBtn').addClass('disabled-link');
                // alert(" place order req send ");
                var coupon_code = $('#coupon_code').val();
                var coupon_value = $('#coupo_discount_value').text();

                $.ajax({
                    method: "post",
                    url: site_url + "placeOrder",
                    data: {
                        language: default_language,
                        fullname: fullname,
                        mobile: mobile,
                        locality: '',
                        fulladdress: fulladdress,
                        city: $('#city').find(":selected").text(),
                        state: state,
                        pincode: pincode,
                        addresstype: 'Home',
                        email: email,
                        payment_id: 'Pay12345',
                        payment_mode: 'COD',
                        city_id: city_id,
                        coupon_code: coupon_code,
                        coupon_value: coupon_value,
                        [csrfName]: csrfHash,
                    },
                    success: function (response) {
                        // $(".paymentMethodBtn").prop('disabled', false);
                        $('.paymentMethodBtn').removeClass('disabled-link');
                        $('.paymentMethodBtn').text('Place Order');
                        //hideloader();

                        if (response.status == 1) {
                            // alert(response.status);
                            //location.href = site_url + "thankyou/" + order_id;

                            var imgurl = $("#imgurl").val();

                            var order_id = response.Information.order_id;
                            var message = 'Dear *' + fullname + '* ,';
                            message += ' Your Order has been placed Successfully.';
                            $.ajax({
                                method: 'get',
                                url: site_url + 'send_whatsapp_msg',
                                data: {
                                    number: '91'.concat(mobile),
                                    type: 'media',
                                    message: message.replace(/ /g, "%20"),
                                    media_url: site_url + 'media/' + imgurl,
                                    // filename: '',
                                    instance_id: '64258107A62A7',
                                    access_token: '14e3c33fbe98cd4ac95bb8f15c2d9023'
                                },
                                success: function (response) {
                                    // alert(JSON.stringify(JSON.parse(response), null, 2));
                                }
                            });


                            setTimeout(function () {


                                location.href = site_url + "thankyou/" + order_id;
                            }, 100);

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
                        //alert(response.Information.order_msg);
                        //var order_id = response.Information.order_id
                        //location.href=site_url+'thankyou/'+ order_id;

                        //var parsedJSON = JSON.parse(response);
                        //$(parsedJSON.Information).each(function() {
                        //	 alert(this.order_id);
                        //});
                        //location.href=site_url+'thankyou';
                    },
                });


            } else {
                //alert ("call else ");
                ///$('#payment-tab').
                $('#address-tab').attr('aria-selected', false);
                $("#address-tab").removeClass('active');
                $("#address").removeClass('active');
                $("#address").removeClass('show');

                $("#payment-tab").addClass('active');
                $("#payment").addClass('active');
                $("#payment").addClass('show');
                $('#payment-tab').attr('aria-selected', true);
            }

        }


        /*
          event.preventDefault();
          var fullname = $("#name").val();
          var mobile = $("#mobile").val();
          var state = $("#state").val();
          var pincode = $("#pincode").val();
          var city = $("#city").val();
          var email = $("#email").val();
          var user_id = $("#user_id").val();
          var fulladdress = $("textarea#address").val();
          
          

         */
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

function place_order_data_old(event) {
    var tab = 'true';

    var address_id = $('.defaultAdderess:checked').val();
    var user_id = $('#user_id').val()
    var fullname = $("#fullname_a").val();
    var email = $("#email").val();
    var mobile = $("#mobile").val();
    var area = $("#area").val();
    var fulladdress = $("#fulladdress").val();
    var lat = $('#lat').val();
    var lng = $('#lng').val();
    var country = $("#country option:selected").text();
    var region = $('#region').is('input') ? $('#region').val() : $('#region option:selected').text();
    var governorate = $('#governorates').is('input') ? $('#governorates').val() : $('#governorates option:selected').text();
    var area = $('#area').is('input') ? $('#area').val() : $('#area option:selected').text();

    if (user_id !== '') {
        if (validateAddressForm()) {

            addUserAddress();

            var spinner = '<div class="spinner-border" role="status"><span class="se-only"></span></div> Please Wait..';
            $('.paymentMethodBtn').html(spinner);
            $(".paymentMethodBtn").prop('disabled', true);
            // alert(" place order req send ");
            var coupon_code = $('#coupon_code').val();
            var coupon_value = $('#coupo_discount_value').text();

            $.ajax({
                method: "post",
                url: site_url + "placeOrder",
                data: {
                    language: default_language,
                    fullname: fullname,
                    mobile: mobile,
                    email: email,
                    area: area,
                    fulladdress: fulladdress,
                    country: country,
                    region: region,
                    governorate: governorate,
                    area: area,
                    lat: lat,
                    lng: lng,
                    addresstype: 'Home',
                    payment_id: 'Pay12345',
                    payment_mode: 'COD',
                    coupon_code: coupon_code,
                    coupon_value: coupon_value,
                    [csrfName]: csrfHash,
                },
                success: function (response) {
                    $(".paymentMethodBtn").prop('disabled', true);
                    $('.paymentMethodBtn').text('Place Order');
                    //hideloader();

                    if (response.status == 1) {
                        // alert(response.status);
                        //location.href = site_url + "thankyou/" + order_id;

                        var imgurl = $("#imgurl").val();

                        var order_id = response.Information.order_id;
                        var message = 'Dear *' + fullname + '* ,';
                        message += ' Your Order has been placed Successfully.';

                        setTimeout(function () {
                            location.href = site_url + "thankyou/" + order_id;
                        }, 100);

                    } else {
                        Swal.fire({
                            position: "center",
                            //icon: "success",
                            title: response.Information.order_msg,
                            showConfirmButton: false,
                            confirmButtonColor: "#ff5400",
                            timer: 3000,
                        });
                    }

                },
            });
        }
    }

}

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

/*const addUserAddress = () => {
    $.ajax({
        method: "post",
        url: site_url + "addUserAddress",
        data: {
            language: default_language,
            username: $('#fullname_a').val(),
            email: $('#email').val(),
            country_code: '1',
            mobile: $('#mobile').val(),
            fulladdress: $('#fulladdress').val(),
            lat: $('#lat').val(),
            lng: $('#lng').val(),
            country_id: $('#country').val(),
            country: $('#country option:selected').text(),
            region_id: $('#region').is('input') ? '' : $('#region').val(),
            region: $('#region').is('input') ? $('#region').val() : $('#region option:selected').text(),
            governorate_id: $('#governorates').is('input') ? '' : $('#governorates').val(),
            governorate: $('#governorates').is('input') ? $('#governorates').val() : $('#governorates option:selected').text(),
            area_id: $('#area').is('input') ? '' : $('#area').val(),
            area: $('#area').is('input') ? $('#area').val() : $('#area option:selected').text(),
            addresstype: "home",
            [csrfName]: csrfHash,
        },
        success: function(response) {
            console.log(response);
        },
        error: function(xhr, status, error) {
            submitButton.prop("disabled", false);
            var errorMessage = "An error occurred: " + xhr.responseText;
            console.log(errorMessage);
        }
    });
};

const getUserAddress = (user_id) => {

    var response = $.ajax({
        method: "post",
        url: site_url + "getUserAddress",

        data: {
            language: default_language,
            user_id: user_id,
            [csrfName]: csrfHash
        },
        success: function(response) {
            // alert(response);
        }
    });
    return response;

}*/

$(document).ready(function () {
    $("#address_div_id").click(function () {
        event.preventDefault();
        var user_id = $('#user_id').val();
        if (user_id == '') {
            $("#address_div").toggle();
            //  document.getElementById('formoid').querySelector('#address_save_btn').style.display = 'none';
        } else {
            // location.href = site_url + 'myaddress';
            $("#address_div").toggle();
        }
    });
});