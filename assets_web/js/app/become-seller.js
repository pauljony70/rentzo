const sendEmailOtpbtn = document.querySelector('#add_seller #send-email-otp-btn');
const sendPhoneOtpbtn = document.querySelector('#add_seller #send-phone-otp-btn');
const sendBecomeSellerPhoneOtp = () => {
    var phone = document.getElementById('seller_phone');
    var phone_otp = document.getElementById('phone_otp');

    if (phone.value == "" || phone.value == null) {
        setErrorMsg(phone, '<i class="fa-solid fa-circle-xmark"></i> Phone is empty.')
        setErrorMsg(phone_otp, '<i class="fa-solid fa-circle-xmark"></i> Phone is empty.')
    } else if (phone.value.length !== 10) {
        setErrorMsg(phone, '<i class="fa-solid fa-circle-xmark"></i> Invalid phone.')
        setErrorMsg(phone_otp, '<i class="fa-solid fa-circle-xmark"></i> Invalid phone.')
    } else {
        setSuccessMsg(phone);
        setSuccessMsg(phone_otp);
        sendPhoneOtpbtn.disabled = true;
        var phoneRemainingSeconds = 31;
        phoneCountdownInterval = setInterval(function () {
            phoneRemainingSeconds--;
            var phoneFormattedSeconds = phoneRemainingSeconds < 10 ? "0" + phoneRemainingSeconds : phoneRemainingSeconds;
            sendPhoneOtpbtn.innerHTML = '<span class="fw-bolder text-dark">00:' + phoneFormattedSeconds + '</span>';

            if (phoneRemainingSeconds <= 0) {
                // Reset the timer element and enable the button
                clearInterval(phoneCountdownInterval);
                sendPhoneOtpbtn.innerText = "Get OTP";
                sendPhoneOtpbtn.disabled = false;
            }
        }, 1000);
        $.ajax({
            method: 'POST',
            url: 'send-become-seller-phone-otp',
            data: {
                language: default_language,
                phone: phone.value,
                [csrfName]: csrfHash
            },
            success: function (response) {
                if (response.status) {
                    setSuccessMsg(phone);
                    setSuccessMsg(phone_otp);
                    return true;
                } else {
                    clearInterval(phoneCountdownInterval);
                    sendPhoneOtpbtn.innerText = "Get OTP";
                    sendPhoneOtpbtn.disabled = false;
                    setErrorMsg(phone, `<i class="fa-solid fa-circle-xmark"></i> ${response.msg}.`);
                    setErrorMsg(phone_otp, `<i class="fa-solid fa-circle-xmark"></i> ${response.msg}.`);
                }
            },
            error: function (response) {
                clearInterval(phoneCountdownInterval);
                sendPhoneOtpbtn.innerText = "Get OTP";
                sendPhoneOtpbtn.disabled = false;
                setErrorMsg(phone, `<i class="fa-solid fa-circle-xmark"></i> ${response.responseJSON.msg}.`);
                setErrorMsg(phone_otp, `<i class="fa-solid fa-circle-xmark"></i> ${response.responseJSON.msg}.`);
            }
        });
        return false;
    }
}

const sendBecomeSellerEmailOtp = () => {
    var email = document.getElementById('seller_email');
    var email_otp = document.getElementById('email_otp');

    if (email.value == "" || email.value == null) {
        setErrorMsg(email, '<i class="fa-solid fa-circle-xmark"></i> Email is empty.')
        setErrorMsg(email_otp, '<i class="fa-solid fa-circle-xmark"></i> Email is empty.')
    } else if (!emailRegex.test(email.value)) {
        setErrorMsg(email, '<i class="fa-solid fa-circle-xmark"></i> Invalid email.')
        setErrorMsg(email_otp, '<i class="fa-solid fa-circle-xmark"></i> Invalid email.')
    } else {
        setSuccessMsg(email);
        setSuccessMsg(email_otp);
        sendEmailOtpbtn.disabled = true;
        var emailRemainingSeconds = 31;
        emailCountdownInterval = setInterval(function () {
            emailRemainingSeconds--;
            var emailFormattedSeconds = emailRemainingSeconds < 10 ? "0" + emailRemainingSeconds : emailRemainingSeconds;
            sendEmailOtpbtn.innerHTML = '<span class="fw-bolder text-dark">00:' + emailFormattedSeconds + '</span>';

            if (emailRemainingSeconds <= 0) {
                // Reset the timer element and enable the button
                clearInterval(emailCountdownInterval);
                sendEmailOtpbtn.innerText = "Get OTP";
                sendEmailOtpbtn.disabled = false;
            }
        }, 1000);
        $.ajax({
            method: 'POST',
            url: 'send-become-seller-email-otp',
            data: {
                language: default_language,
                email: email.value,
                [csrfName]: csrfHash
            },
            success: function (response) {
                if (response.status) {
                    setSuccessMsg(email);
                    setSuccessMsg(email_otp);
                    return true;
                } else {
                    clearInterval(emailCountdownInterval);
                    sendEmailOtpbtn.innerText = "Get OTP";
                    sendEmailOtpbtn.disabled = false;
                    setErrorMsg(email, `<i class="fa-solid fa-circle-xmark"></i> ${response.msg}.`);
                    setErrorMsg(email_otp, `<i class="fa-solid fa-circle-xmark"></i> ${response.msg}.`);
                }
            },
            error: function (response) {
                clearInterval(emailCountdownInterval);
                sendEmailOtpbtn.innerText = "Get OTP";
                sendEmailOtpbtn.disabled = false;
                setErrorMsg(email, `<i class="fa-solid fa-circle-xmark"></i> ${response.responseJSON.msg}.`);
                setErrorMsg(email_otp, `<i class="fa-solid fa-circle-xmark"></i> ${response.responseJSON.msg}.`);
            }
        });
        return false;
    }
}

const validateSellerForm = () => {
    const seller_form = document.getElementById('seller_form');
    const business_type = seller_form.querySelector('#business_type');
    const seller_name = seller_form.querySelector('#seller_name');
    const business_name = seller_form.querySelector('#business_name');
    const business_address = seller_form.querySelector('#business_address');
    const business_details = seller_form.querySelector('#business_details');

    var flag_business_type = false;
    var flag_seller_name = false;
    var flag_business_name = false;
    var flag_business_address = false;
    var flag_business_details = false;

    if (business_type.value === '') {
        flag_business_type = false;
        setSelectErrorMsg(business_type, '<i class="fa-solid fa-circle-xmark"></i> Business type is required.');
    } else {
        flag_business_type = true;
        if (business_type.value == "Individual") {
            document.querySelector('#add_seller #gst_certificate').parentElement.parentElement.classList.add('d-none');
        } else if (business_type.value == "Company") {
            document.querySelector('#add_seller #gst_certificate').parentElement.parentElement.classList.remove('d-none');
        }
        setSelectSuccessMsg(business_type);
    }

    if (seller_name.value === '') {
        flag_seller_name = false;
        setErrorMsg(seller_name, '<i class="fa-solid fa-circle-xmark"></i> Seller name is required.');
    } else {
        flag_seller_name = true;
        setSuccessMsg(seller_name);
    }

    if (business_type.value === 'Company') {
        if (business_name.value === '') {
            flag_business_name = false;
            setErrorMsg(business_name, '<i class="fa-solid fa-circle-xmark"></i> Shop name is required.');
        } else {
            flag_business_name = true;
            setSuccessMsg(business_name);
        }

        if (business_address.value === '') {
            flag_business_address = false;
            setErrorMsg(business_address, '<i class="fa-solid fa-circle-xmark"></i> Shop address is required.');
        } else {
            flag_business_address = true;
            setSuccessMsg(business_address);
        }

        if (business_details.value === '') {
            flag_business_details = false;
            setErrorMsg(business_details, '<i class="fa-solid fa-circle-xmark"></i> Shop details is required.');
        } else {
            flag_business_details = true;
            setSuccessMsg(business_details);
        }
    } else {
        flag_business_name = true;
        flag_business_address = true;
        flag_business_details = true;
    }

    if (flag_business_type == true && flag_seller_name == true && flag_business_name == true && flag_business_address == true && flag_business_details == true) {
        return true;
    } else {
        return false;
    }
}

const validateSellerDescriptionForm = () => {
    const seller_desc = document.getElementById('seller_desc');
    const state = seller_desc.querySelector('#state');
    const city = seller_desc.querySelector('#city');
    const pincode = seller_desc.querySelector('#pincode');

    var flag_state = false;
    var flag_city = false;
    var flag_pincode = false;


    if (state.value == '') {
        flag_state = false;
        setSelectErrorMsg(state, '<i class="fa-solid fa-circle-xmark"></i> State is required.');
    } else {
        flag_state = true;
        setSelectSuccessMsg(state);
    }

    if (city.value == '') {
        flag_city = false;
        setSelectErrorMsg(city, '<i class="fa-solid fa-circle-xmark"></i> City is required.');
    } else {
        flag_city = true;
        setSelectSuccessMsg(city);
    }


    if (pincode.value == '') {
        flag_pincode = false;
        setErrorMsg(pincode, '<i class="fa-solid fa-circle-xmark"></i> Pincode is required.');
    } else {
        flag_pincode = true;
        setSuccessMsg(pincode);
    }


    if (flag_state == true && flag_city == true && flag_pincode == true) {
        return true;
    } else {
        return false;
    }
}

const validateSellerInfoForm = (callback) => {
    var seller_info = document.getElementById('seller_info');
    var phone = seller_info.querySelector('#seller_phone');
    var phone_otp = seller_info.querySelector('#phone_otp');
    var email = seller_info.querySelector('#seller_email');
    var email_otp = seller_info.querySelector('#email_otp');
    var password = seller_info.querySelector('#password');

    var flag_phone = false;
    var flag_phone_otp = false;
    var flag_email = false;
    var flag_email_otp = false;
    var flag_password = false;

    var mobileNumberRegex = /^[+]?\d{8,15}$/;
    var passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
    let phoneOtpValidationPromise;
    let emailOtpValidationPromise;

    if (phone.value === '') {
        flag_phone = false;
        setErrorMsg(phone, '<i class="fa-solid fa-circle-xmark"></i> Phone is required.');
    } else if (!mobileNumberRegex.test(phone.value.trim())) {
        flag_phone = false;
        setErrorMsg(phone, '<i class="fa-solid fa-circle-xmark"></i> Phone number does not match the required format.');
    } else {
        flag_phone = true;
        setSuccessMsg(phone);
    }

    if (phone_otp.value === '') {
        flag_phone_otp = false;
        setErrorMsg(phone_otp, '<i class="fa-solid fa-circle-xmark"></i> Phone OTP is required.');
    } else if (phone_otp.value.length !== 6) {
        flag_phone_otp = false;
        setErrorMsg(phone_otp, '<i class="fa-solid fa-circle-xmark"></i> OTP should be 6 in length.');
    } else {
        phoneOtpValidationPromise = new Promise((resolve, reject) => {
            $.ajax({
                url: site_url.concat('validate-become-seller-phone-otp'),
                method: 'POST',
                data: {
                    language: default_language,
                    otp: phone_otp.value,
                    [csrfName]: csrfHash
                },
                success: function (response) {
                    if (response.status) {
                        flag_phone_otp = true;
                        setSuccessMsg(phone_otp);
                        resolve();
                    } else {
                        flag_phone_otp = false;
                        setErrorMsg(phone_otp, '<i class="fa-solid fa-circle-xmark"></i> ' + response.msg);
                        reject();
                    }
                },
                error: function (xhr, status, error) {
                    flag_phone_otp = false;
                    console.error('Error:', error);
                    reject();
                }
            });
        });
    }

    if (email.value === '') {
        flag_email = false;
        setErrorMsg(email, '<i class="fa-solid fa-circle-xmark"></i> Email is required.');
    } else if (!emailRegex.test(email.value.trim())) {
        flag_email = false;
        setErrorMsg(email, '<i class="fa-solid fa-circle-xmark"></i> Email is invalid.');
    } else {
        flag_email = true;
        setSuccessMsg(email);
    }

    if (email_otp.value === '') {
        flag_email_otp = false;
        setErrorMsg(email_otp, '<i class="fa-solid fa-circle-xmark"></i> Email OTP is required.');
    } else if (email_otp.value.length !== 6) {
        flag_email_otp = false;
        setErrorMsg(email_otp, '<i class="fa-solid fa-circle-xmark"></i> OTP should be 6 in length.');
    } else {
        emailOtpValidationPromise = new Promise((resolve, reject) => {
            $.ajax({
                url: site_url.concat('validate-become-seller-email-otp'),
                method: 'POST',
                data: {
                    language: default_language,
                    otp: email_otp.value,
                    [csrfName]: csrfHash
                },
                success: function (response) {
                    if (response.status) {
                        flag_email_otp = true;
                        setSuccessMsg(email_otp);
                        resolve();
                    } else {
                        flag_email_otp = false;
                        setErrorMsg(email_otp, '<i class="fa-solid fa-circle-xmark"></i> ' + response.msg);
                        reject();
                    }
                },
                error: function (xhr, status, error) {
                    flag_email_otp = false;
                    console.error('Error:', error);
                    reject();
                }
            });
        });
    }

    if (password.value === '') {
        flag_password = false;
        setErrorMsg(password, '<i class="fa-solid fa-circle-xmark"></i> Password is required.');
    } else if (!passwordRegex.test(password.value.trim())) {
        flag_password = false;
        setErrorMsg(password, '<i class="fa-solid fa-circle-xmark"></i> Password does not meet the required criteria.');
    } else {
        flag_password = true;
        setSuccessMsg(password);
    }

    // Use Promise.all to wait for all promises to resolve
    Promise.all([phoneOtpValidationPromise, emailOtpValidationPromise])
        .then(() => {
            if (flag_phone && flag_phone_otp && flag_email && flag_email_otp && flag_password) {
                callback(true);
            } else {
                callback(false);
            }
        })
        .catch(() => {
            // Handle errors here if needed
            callback(false);
        });
}

const validateDocForm = () => {
    const business_type = document.querySelector('#business_type');
    const seller_doc = document.getElementById('seller_doc');
    const business_logo = seller_doc.querySelector('#business_logo');
    const aadhar_card = seller_doc.querySelector('#aadhar_card');
    const pan_card = seller_doc.querySelector('#pan_card');
    const gst_certificate = seller_doc.querySelector('#gst_certificate');

    var flag_business_logo = false;
    var flag_aadhar_card = false;
    var flag_pan_card = false;
    var flag_gst_certificate = false;

    if (business_logo.value === '') {
        flag_business_logo = false;
        setDropifyErrorMsg(business_logo, business_logo.parentElement.parentElement.querySelector('#error'), '<i class="fa-solid fa-circle-xmark"></i> Business logo is required.');
    } else {
        flag_business_logo = true;
        setDropifySuccessMsg(business_logo, business_logo.parentElement.parentElement.querySelector('#error'));
    }

    if (aadhar_card.value === '') {
        flag_aadhar_card = false;
        setDropifyErrorMsg(aadhar_card, aadhar_card.parentElement.parentElement.querySelector('#error'), '<i class="fa-solid fa-circle-xmark"></i> Aadhaar card is required.');
    } else {
        flag_aadhar_card = true;
        setDropifySuccessMsg(aadhar_card, aadhar_card.parentElement.parentElement.querySelector('#error'));
    }

    if (pan_card.value === '') {
        flag_pan_card = false;
        setDropifyErrorMsg(pan_card, pan_card.parentElement.parentElement.querySelector('#error'), '<i class="fa-solid fa-circle-xmark"></i> Pan card is required.');
    } else {
        flag_pan_card = true;
        setDropifySuccessMsg(pan_card, pan_card.parentElement.parentElement.querySelector('#error'));
    }

    if (business_type.value === 'Company') {
        if (gst_certificate.value === '') {
            flag_gst_certificate = false;
            setDropifyErrorMsg(gst_certificate, gst_certificate.parentElement.parentElement.querySelector('#error'), '<i class="fa-solid fa-circle-xmark"></i> Commercial registration is required.');
        } else {
            flag_gst_certificate = true;
            setDropifySuccessMsg(gst_certificate, gst_certificate.parentElement.parentElement.querySelector('#error'));
        }
    } else {
        flag_gst_certificate = true;
    }

    if (flag_business_logo == true && flag_aadhar_card == true && flag_pan_card == true && flag_gst_certificate == true) {
        return true;
    } else {
        return false;
    }
}


$(function () {
    window.onload = getStatedata();
    window.onload = getCitydata(0);
});

$('#state').on('change', function () {
    getCitydata(this.value);
});

$('.dropify').dropify();

$(document).ready(function () {
    document.querySelector('#business_type').addEventListener('change', function () {
        document.querySelector('#business_name').value = "";
        document.querySelector('#business_address').value = "";
        document.querySelector('#business_details').value = "";
        if (this.value === 'Company') {
            document.querySelector('#business_name').parentElement.classList.remove('d-none');
            document.querySelector('#business_address').parentElement.classList.remove('d-none');
            document.querySelector('#business_details').parentElement.classList.remove('d-none');
        } else {
            document.querySelector('#business_name').parentElement.classList.add('d-none');
            document.querySelector('#business_address').parentElement.classList.add('d-none');
            document.querySelector('#business_details').parentElement.classList.add('d-none');
        }
    });

    sendEmailOtpbtn.addEventListener('click', () => {
        sendBecomeSellerEmailOtp();
    });

    document.querySelector('#add_seller #send-phone-otp-btn').addEventListener('click', () => {
        if (sendBecomeSellerPhoneOtp()) {
        }
    });

    const checkboxElement = document.getElementById('social_media_handle');

    checkboxElement.addEventListener('change', (event) => {
        const isChecked = event.target.checked;
        if (isChecked) {
            document.querySelectorAll(".social-media-handle").forEach(element => {
                element.classList.remove('d-none');
            });
        } else {
            document.querySelectorAll(".social-media-handle").forEach(element => {
                element.classList.add('d-none');
                element.querySelector('input').value = "";
            });
        }
    });


    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;
    var current = 1;
    var steps = $("fieldset").length;

    setProgressBar(current);

    $(".seller_form").click(function () {
        if (validateSellerForm()) {
            current_fs = $(this).parent();
            next_fs = $(this).parent().next();

            //Add Class Active
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

            //show the next fieldset
            next_fs.show();
            //hide the current fieldset with style
            current_fs.animate(
                { opacity: 0 },
                {
                    step: function (now) {
                        // for making fielset appear animation
                        opacity = 1 - now;

                        current_fs.css({
                            display: "none",
                            position: "relative"
                        });
                        next_fs.css({ opacity: opacity });
                    },
                    duration: 500
                }
            );
            setProgressBar(++current);
        }
    });

    $(".seller_desc").click(function () {
        if (validateSellerDescriptionForm()) {
            current_fs = $(this).parent();
            next_fs = $(this).parent().next();

            //Add Class Active
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

            //show the next fieldset
            next_fs.show();
            //hide the current fieldset with style
            current_fs.animate(
                { opacity: 0 },
                {
                    step: function (now) {
                        // for making fielset appear animation
                        opacity = 1 - now;

                        current_fs.css({
                            display: "none",
                            position: "relative"
                        });
                        next_fs.css({ opacity: opacity });
                    },
                    duration: 500
                }
            );
            setProgressBar(++current);
        }
    });

    $(".seller_info").click(function () {
        validateSellerInfoForm(function (isValid) {
            if (isValid) {
                current_fs = $('.seller_info').parent();
                next_fs = $('.seller_info').parent().next();
                //Add Class Active
                $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

                //show the next fieldset
                next_fs.show();
                //hide the current fieldset with style
                current_fs.animate(
                    { opacity: 0 },
                    {
                        step: function (now) {
                            // for making fielset appear animation
                            opacity = 1 - now;

                            current_fs.css({
                                display: "none",
                                position: "relative"
                            });
                            next_fs.css({ opacity: opacity });
                        },
                        duration: 500
                    }
                );
                setProgressBar(++current);
            }
        });
    });

    $(".previous").click(function () {
        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();

        //Remove class active
        $("#progressbar li")
            .eq($("fieldset").index(current_fs))
            .removeClass("active");

        //show the previous fieldset
        previous_fs.show();

        //hide the current fieldset with style
        current_fs.animate(
            { opacity: 0 },
            {
                step: function (now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        display: "none",
                        position: "relative"
                    });
                    previous_fs.css({ opacity: opacity });
                },
                duration: 500
            }
        );
        setProgressBar(--current);
    });

    function setProgressBar(curStep) {
        var percent = parseFloat(100 / steps) * curStep;
        percent = percent.toFixed();
        $(".progress-bar").css("width", percent + "%");
    }

    $(".submit").click(function () {
        this.disabled = true;
        if (validateDocForm()) {
            // event.preventDefault();
            current_fs = $(this).parent();
            next_fs = $(this).parent().next();
            var business_type = $('#business_type').val();
            var seller_name = $('#seller_name').val();
            var business_name = $('#business_name').val();
            var business_address = $('textarea#business_address').val();
            var business_details = $('textarea#business_details').val();
            var city_id = $('#city').val();
            var city = $('#city option:selected').text();
            var state_id = $('#state').val();
            var state = $('#state option:selected').text();
            var pincode = $('#pincode').val();
            var phone = $('#seller_phone').val();
            var email = $('#seller_email').val();
            var website_link = $('#website_link').val();
            var facebook_link = $('#facebook_link').val();
            var instagram_link = $('#instagram_link').val();
            var passwords = $('#password').val();
            var gst_certificate = null;

            var business_logo = $('#business_logo').prop('files')[0];
            var aadhar_card = $('#aadhar_card').prop('files')[0];
            var pan_card = $('#pan_card').prop('files')[0];

            if (business_type == 'Company') {
                gst_certificate = $('#gst_certificate').prop('files')[0];
            }


            var form_data = new FormData();
            form_data.append('business_type', business_type);
            form_data.append('seller_name', seller_name);
            form_data.append('business_name', business_name);
            form_data.append('business_address', business_address);
            form_data.append('business_details', business_details);
            form_data.append('state_id', state_id);
            form_data.append('state', state);
            form_data.append('city_id', city_id);
            form_data.append('city', city);
            form_data.append('pincode', pincode);
            form_data.append('phone', phone);
            form_data.append('email', email);
            form_data.append('website_link', website_link);
            form_data.append('facebook_link', facebook_link);
            form_data.append('instagram_link', instagram_link);
            form_data.append('passwords', passwords);
            form_data.append('business_logo', business_logo);
            form_data.append('aadhar_card', aadhar_card);
            form_data.append('pan_card', pan_card);
            form_data.append('gst_certificate', gst_certificate);
            form_data.append([csrfName], csrfHash);

            $.ajax({
                method: 'post',
                url: site_url + 'add_seller',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                success: function (response) {
                    //Add Class Active
                    setTimeout(() => {
                        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
                        next_fs.show();
                        current_fs.animate(
                            { opacity: 0 },
                            {
                                step: function (now) {
                                    opacity = 1 - now;

                                    current_fs.css({
                                        display: "none",
                                        position: "relative"
                                    });
                                    next_fs.css({ opacity: opacity });
                                },
                                duration: 500
                            }
                        );
                        this.disabled = false;
                        setProgressBar(++current);
                    }, 1500);
                },
                error: function (response) {
                    this.disabled = false;
                    console.log(response);
                }
            });

        } else {
            setTimeout(() => {
                this.disabled = false;
            }, 1000);

        }
    });
});