const sendEmailOtpbtn = document.querySelector('#add_seller #send-email-otp-btn');
const sendPhoneOtpbtn = document.querySelector('#add_seller #send-phone-otp-btn');
const sendBecomeSellerPhoneOtp = () => {
    var phone = document.getElementById('seller_phone');
    var iti = window.intlTelInputGlobals.getInstance(phone);
    var selectedCountryData = iti.getSelectedCountryData();
    var countryCode = selectedCountryData.dialCode;
    var phone_otp = document.getElementById('phone_otp');

    if (phone.value == "" || phone.value == null) {
        setInTelErrorMsg(phone, '<i class="fa-solid fa-circle-xmark"></i> Phone is empty.')
        setErrorMsg(phone_otp, '<i class="fa-solid fa-circle-xmark"></i> Phone is empty.')
    } else if (phone.value.length < 7) {
        setInTelErrorMsg(phone, '<i class="fa-solid fa-circle-xmark"></i> Invalid phone.')
        setErrorMsg(phone_otp, '<i class="fa-solid fa-circle-xmark"></i> Invalid phone.')
    } else {
        setInTelSuccessMsg(phone);
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
                country_code: countryCode,
                [csrfName]: csrfHash
            },
            success: function (response) {
                if (response.status) {
                    setInTelSuccessMsg(phone, `<i class="fa-solid fa-circle-xmark"></i> ${response.msg}.`);
                    setSuccessMsg(phone_otp, `<i class="fa-solid fa-circle-xmark"></i> ${response.msg}.`);
                    return true;
                } else {
                    clearInterval(phoneCountdownInterval);
                    sendPhoneOtpbtn.innerText = "Get OTP";
                    sendPhoneOtpbtn.disabled = false;
                    setInTelErrorMsg(phone, `<i class="fa-solid fa-circle-xmark"></i> ${response.msg}.`);
                    setErrorMsg(phone_otp, `<i class="fa-solid fa-circle-xmark"></i> ${response.msg}.`);
                }
            },
            error: function (response) {
                clearInterval(phoneCountdownInterval);
                sendPhoneOtpbtn.innerText = "Get OTP";
                sendPhoneOtpbtn.disabled = false;
                setInTelErrorMsg(phone, `<i class="fa-solid fa-circle-xmark"></i> ${response.responseJSON.msg}.`);
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
    const vat_registered = seller_form.querySelector('#vat_registered');
    const vat_registratoion_no = seller_form.querySelector('#vat_registratoion_no');
    const seller_name = seller_form.querySelector('#seller_name');
    const business_name = seller_form.querySelector('#business_name');
    const business_address = seller_form.querySelector('#business_address');
    const business_details = seller_form.querySelector('#business_details');

    var flag_business_type = false;
    var flag_vat_registered = false;
    var flag_vat_registratoion_no = false;
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
            console.log(document.querySelector('#add_seller #commercial_registration').parentElement.parentElement)
            document.querySelector('#add_seller #commercial_registration').parentElement.parentElement.classList.add('d-none')
            document.querySelector('#add_seller #license').parentElement.parentElement.classList.add('d-none')
        } else if (business_type.value == "Company") {
            document.querySelector('#add_seller #commercial_registration').parentElement.parentElement.classList.remove('d-none')
            document.querySelector('#add_seller #license').parentElement.parentElement.classList.remove('d-none')
        }
        setSelectSuccessMsg(business_type);
    }

    if (vat_registered.value === '') {
        flag_vat_registered = false;
        setSelectErrorMsg(vat_registered, '<i class="fa-solid fa-circle-xmark"></i> This field is required.');
    } else {
        flag_vat_registered = true;
        if (vat_registered.value == 1) {
            document.querySelector('#add_seller #vat_certificate').parentElement.parentElement.classList.remove('d-none')
        } else {
            document.querySelector('#add_seller #vat_certificate').parentElement.parentElement.classList.add('d-none')
        }
        setSelectSuccessMsg(vat_registered);
    }

    if (vat_registered.value == 1) {
        if (vat_registratoion_no.value === '') {
            flag_vat_registratoion_no = false;
            setErrorMsg(vat_registratoion_no, '<i class="fa-solid fa-circle-xmark"></i> VAT registratoion no is required.');
        }
    } else {
        flag_vat_registratoion_no = true;
        setSuccessMsg(vat_registratoion_no);
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

    if (flag_business_type == true && flag_vat_registered == true && flag_seller_name == true && flag_business_name == true && flag_business_address == true && flag_business_details == true) {
        return true;
    } else {
        return false;
    }
}

const validateSellerDescriptionForm = () => {
    const seller_desc = document.getElementById('seller_desc');
    const country = seller_desc.querySelector('#country');
    const region = seller_desc.querySelector('#region');
    const governorate = seller_desc.querySelector('#governorates');
    const area = seller_desc.querySelector('#area');

    var flag_country = false;
    var flag_region = false;
    var flag_governorate = false;
    var flag_area = false;

    if (country.value == '') {
        flag_country = false;
        setSelectErrorMsg(country, '<i class="fa-solid fa-circle-xmark"></i> Country is required.');
    } else {
        flag_country = true;
        setSelectSuccessMsg(country);
    }

    if (region.tagName === "SELECT") {
        if (region.value == '') {
            flag_region = false;
            setSelectErrorMsg(region, '<i class="fa-solid fa-circle-xmark"></i> Region is required.');
        } else {
            flag_region = true;
            setSelectSuccessMsg(region);
        }
    } else {
        if (region.value == '') {
            flag_region = false;
            setErrorMsg(region, '<i class="fa-solid fa-circle-xmark"></i> Region is required.');
        } else {
            flag_region = true;
            setSuccessMsg(region);
        }
    }

    if (governorates.tagName === "SELECT") {
        if (governorate.value == '') {
            flag_governorate = false;
            setSelectErrorMsg(governorate, '<i class="fa-solid fa-circle-xmark"></i> Governorate is required.');
        } else {
            flag_governorate = true;
            setSelectSuccessMsg(governorate);
        }
    } else {
        if (governorate.value == '') {
            flag_governorate = false;
            setErrorMsg(governorate, '<i class="fa-solid fa-circle-xmark"></i> Governorate is required.');
        } else {
            flag_governorate = true;
            setSuccessMsg(governorate);
        }
    }

    if (area.tagName === "SELECT") {
        if (area.value == '') {
            flag_area = false;
            setSelectErrorMsg(area, '<i class="fa-solid fa-circle-xmark"></i> Area is required.');
        } else {
            flag_area = true;
            setSelectSuccessMsg(area);
        }
    } else {
        if (area.value == '') {
            flag_area = false;
            setErrorMsg(area, '<i class="fa-solid fa-circle-xmark"></i> Area is required.');
        } else {
            flag_area = true;
            setSuccessMsg(area);
        }
    }



    if (flag_country == true && flag_region == true && flag_governorate == true && flag_area == true) {
        return true;
    } else {
        console.log('first')
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
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    var passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;

    if (phone.value === '') {
        flag_phone = false;
        setInTelErrorMsg(phone, '<i class="fa-solid fa-circle-xmark"></i> Phone is required.');
    } else if (!mobileNumberRegex.test(phone.value.trim())) {
        flag_phone = false;
        setInTelErrorMsg(phone, '<i class="fa-solid fa-circle-xmark"></i> Phone number does not match the required format.');
    } else {
        flag_phone = true;
        setInTelSuccessMsg(phone);
    }

    if (phone_otp.value === '') {
        flag_phone_otp = false;
        setErrorMsg(phone_otp, '<i class="fa-solid fa-circle-xmark"></i> Phone OTP is required.');
    } else if (phone_otp.value.length !== 6) {
        flag_phone_otp = false;
        setErrorMsg(phone_otp, '<i class="fa-solid fa-circle-xmark"></i> OTP should be 6 in length.');
    } else {
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
                } else {
                    flag_phone_otp = false;
                    setErrorMsg(phone_otp, '<i class="fa-solid fa-circle-xmark"></i> ' + response.msg);
                }
            },
            error: function (xhr, status, error) {
                flag_phone_otp = false;
                console.error('Error:', error);
            }
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
                } else {
                    flag_email_otp = false;
                    setErrorMsg(email_otp, '<i class="fa-solid fa-circle-xmark"></i> ' + response.msg);
                }
            },
            error: function (xhr, status, error) {
                flag_email_otp = false;
                console.error('Error:', error);
            }
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

    setTimeout(() => {
        if (flag_phone == true && flag_phone_otp == true && flag_email == true && flag_email_otp == true && flag_password == true) {
            callback(true);
        } else {
            callback(false);
        }
    }, 500);
}

const validateDocForm = () => {
    const business_type = document.querySelector('#business_type');
    const vat_registered = document.querySelector('#vat_registered');
    const seller_doc = document.getElementById('seller_doc');
    const business_logo = seller_doc.querySelector('#business_logo');
    const aadhar_card = seller_doc.querySelector('#aadhar_card');
    const commercial_registration = seller_doc.querySelector('#commercial_registration');
    const vat_certificate = seller_doc.querySelector('#vat_certificate');
    const license = seller_doc.querySelector('#license');

    var flag_business_logo = false;
    var flag_aadhar_card = false;
    var flag_commercial_registration = false;
    var flag_vat_certificate = false;
    var flag_license = false;

    if (business_logo.value === '') {
        flag_business_logo = false;
        setDropifyErrorMsg(business_logo, business_logo.parentElement.parentElement.querySelector('#error'), '<i class="fa-solid fa-circle-xmark"></i> Business logo is required.');
    } else {
        flag_business_logo = true;
        setDropifySuccessMsg(business_logo, business_logo.parentElement.parentElement.querySelector('#error'));
    }

    if (aadhar_card.value === '') {
        flag_aadhar_card = false;
        setDropifyErrorMsg(aadhar_card, aadhar_card.parentElement.parentElement.querySelector('#error'), '<i class="fa-solid fa-circle-xmark"></i> Id proof is required.');
    } else {
        flag_aadhar_card = true;
        setDropifySuccessMsg(aadhar_card, aadhar_card.parentElement.parentElement.querySelector('#error'));
    }

    if (business_type.value === 'Company') {
        if (commercial_registration.value === '') {
            flag_commercial_registration = false;
            setDropifyErrorMsg(commercial_registration, commercial_registration.parentElement.parentElement.querySelector('#error'), '<i class="fa-solid fa-circle-xmark"></i> Commercial registration is required.');
        } else {
            flag_commercial_registration = true;
            setDropifySuccessMsg(commercial_registration, commercial_registration.parentElement.parentElement.querySelector('#error'));
        }

        if (license.value === '') {
            flag_license = false;
            setDropifyErrorMsg(license, license.parentElement.parentElement.querySelector('#error'), '<i class="fa-solid fa-circle-xmark"></i> License is required.');
        } else {
            flag_license = true;
            setDropifySuccessMsg(license, license.parentElement.parentElement.querySelector('#error'));
        }
    } else {
        flag_commercial_registration = true;
        flag_license = true;
    }

    if (vat_registered.value == 1) {
        if (vat_certificate.value === '') {
            flag_vat_certificate = false;
            setDropifyErrorMsg(vat_certificate, vat_certificate.parentElement.parentElement.querySelector('#error'), '<i class="fa-solid fa-circle-xmark"></i> VAT certificate is required.');
        } else {
            flag_vat_certificate = true;
            setDropifySuccessMsg(vat_certificate, vat_certificate.parentElement.parentElement.querySelector('#error'));
        }
    } else {
        flag_vat_certificate = true;
    }

    if (flag_business_logo == true && flag_aadhar_card == true && flag_commercial_registration == true && flag_vat_certificate == true && flag_license == true) {
        return true;
    } else {
        return false;
    }
}


$(document).ready(function () {
    document.querySelector('#business_type').addEventListener('change', function () {
        document.querySelector('#vat_registratoion_no').parentElement.classList.add('d-none');
        document.querySelector('#vat_registratoion_no').value = "";
        document.querySelector('#business_name').value = "";
        document.querySelector('#business_address').value = "";
        document.querySelector('#business_details').value = "";
        if (this.value === 'Company') {
            document.querySelector('#vat_registered').value = "";
            document.querySelector('#vat_registered').disabled = false;
            document.querySelector('#vat_registered').parentElement.classList.remove('d-none');
            document.querySelector('#business_name').parentElement.classList.remove('d-none');
            document.querySelector('#business_address').parentElement.classList.remove('d-none');
            document.querySelector('#business_details').parentElement.classList.remove('d-none');
        } else {
            document.querySelector('#vat_registered').value = 0;
            document.querySelector('#vat_registered').disabled = true;
            document.querySelector('#vat_registered').parentElement.classList.add('d-none');
            document.querySelector('#business_name').parentElement.classList.add('d-none');
            document.querySelector('#business_address').parentElement.classList.add('d-none');
            document.querySelector('#business_details').parentElement.classList.add('d-none');
        }
    });

    document.querySelector('#vat_registered').addEventListener('change', function () {
        setSuccessMsg(vat_registratoion_no);
        if (this.value === '0') {
            document.querySelector('#vat_registratoion_no').parentElement.classList.add('d-none');
            document.querySelector('#vat_registratoion_no').value = "";
            document.querySelector('#vat_registratoion_no').disabled = true;
        } else {
            document.querySelector('#vat_registratoion_no').parentElement.classList.remove('d-none');
            document.querySelector('#vat_registratoion_no').disabled = false;
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

    const input = document.querySelector("#seller_phone");
    var iti = window.intlTelInputGlobals.getInstance(input);
    if (!iti) {
        window.intlTelInput(input, {
            initialCountry: "om",
            onlyCountries: ["om", "bh", "kw", "qa", "sa", "ae"],
            separateDialCode: true,
            utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.8/build/js/utils.js"
        });
    }

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
            console.log(isValid)
            if (isValid) {
                console.log($(this).parent())
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
            var vat_registered = $('#vat_registered').val();
            var vat_registratoion_no = $('#vat_registratoion_no').val();
            var seller_name = $('#seller_name').val();
            var business_name = $('#business_name').val();
            var business_address = $('textarea#business_address').val();
            var business_details = $('textarea#business_details').val();
            var country_id = $('#country').val();
            var country = $('#country option:selected').text();
            var region_id = $('#region').is('input') ? '' : $('#region').val();
            var region = $('#region').is('input') ? $('#region').val() : $('#region option:selected').text();
            var governorate_id = $('#governorates').is('input') ? '' : $('#governorates').val();
            var governorate = $('#governorates').is('input') ? $('#governorates').val() : $('#governorates option:selected').text();
            var area_id = $('#area').is('input') ? '' : $('#area').val();
            var area = $('#area').is('input') ? $('#area').val() : $('#area option:selected').text();
            var phone = $('#seller_phone').val();
            var email = $('#seller_email').val();
            var website_link = $('#website_link').val();
            var facebook_link = $('#facebook_link').val();
            var instagram_link = $('#instagram_link').val();
            var passwords = $('#password').val();
            var commercial_registration = null;
            var vat_certificate = null;
            var license = null;

            var business_logo = $('#business_logo').prop('files')[0];
            var aadhar_card = $('#aadhar_card').prop('files')[0];

            if (business_type == 'Company') {
                commercial_registration = $('#commercial_registration').prop('files')[0];
                license = $('#license').prop('files')[0];
            }

            if (vat_registered == 1) {
                vat_certificate = $('#vat_certificate').prop('files')[0];
            }


            var form_data = new FormData();
            form_data.append('business_type', business_type);
            form_data.append('vat_registered', vat_registered);
            form_data.append('vat_registratoion_no', vat_registratoion_no);
            form_data.append('seller_name', seller_name);
            form_data.append('business_name', business_name);
            form_data.append('business_address', business_address);
            form_data.append('business_details', business_details);
            form_data.append('country_id', country_id);
            form_data.append('country', country);
            form_data.append('region_id', region_id);
            form_data.append('region', region);
            form_data.append('governorate_id', governorate_id);
            form_data.append('governorate', governorate);
            form_data.append('area_id', area_id);
            form_data.append('area', area);
            form_data.append('phone', phone);
            form_data.append('email', email);
            form_data.append('website_link', website_link);
            form_data.append('facebook_link', facebook_link);
            form_data.append('instagram_link', instagram_link);
            form_data.append('passwords', passwords);
            form_data.append('business_logo', business_logo);
            form_data.append('aadhar_card', aadhar_card);
            form_data.append('commercial_registration', commercial_registration);
            form_data.append('vat_certificate', vat_certificate);
            form_data.append('license', license);
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
                }
            });

        } else {
            setTimeout(() => {
                this.disabled = false;
            }, 1000);

        }
    });
});