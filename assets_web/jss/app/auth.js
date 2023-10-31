const loginContainter = document.querySelector('#login-containter');
const signupContainter = document.querySelector('#signup-containter');
const loginInputContainer = document.querySelector('#login-input-container');
const signupInputContainer = document.querySelector('#signup-input-container');
const loginOtpContainer = document.querySelector('#login-otp-container');
const loginLoader = document.querySelector('#login-loader');
const sendLoginOtpBtn = loginInputContainer ? loginInputContainer.querySelector('#otp-with-change-addon') : null;
const sendSignUpOtpBtn = signupInputContainer ? signupInputContainer.querySelector('#otp-with-change-addon') : null;
const submitOtpBtn = loginContainter ? loginContainter.querySelector('#sendOtpLogInBtn') : null;
const submitSignUpForm = signupContainter ? signupContainter.querySelector('#sendOtpLogInBtn') : null;
const resendOtpBtn = document.getElementById("resendOtpBtn");
const loginOtpBox = document.querySelector('.otp-field');
const editBtn = document.querySelector('#login-otp-container .fa-pen-to-square');
const fullName = document.querySelector('#fullname');
var countdownInterval = '';


const checkInputValue = (input) => {
    var onlyNumbersRegex = /^\d+$/;

    if (onlyNumbersRegex.test(input)) {
        return 'phone';
    } else {
        return 'email';
    }
}

const sendLoginOtp = () => {
    loginLoader.className = "";
    var phone = document.getElementById('log_mobileno');
    var phonev = phone.value;
    var countryCode = '';
    var qouteid = '';
    var input_type = checkInputType(phonev);

    if (phonev == "" || phonev == null) {
        loginLoader.classList.add('d-none');
        if (default_language === 1)
            setInTelErrorMsg(phone, '<i class="fa-solid fa-circle-xmark"></i> رقم الهاتف أو البريد الإلكتروني فارغ.')
        else
            setInTelErrorMsg(phone, '<i class="fa-solid fa-circle-xmark"></i> Phone no or email is empty.')
    } else if (input_type !== 'email' && input_type !== 'phone') {
        loginLoader.classList.add('d-none');
        if (default_language === 1)
            setInTelErrorMsg(phone, '<i class="fa-solid fa-circle-xmark"></i> رقم الهاتف أو البريد الإلكتروني غير صالح.')
        else
            setInTelErrorMsg(phone, '<i class="fa-solid fa-circle-xmark"></i> Invalid phone no or email.')
    } else {
        setInTelSuccessMsg(phone);
    }

    if (input_type === 'phone') {
        var iti = window.intlTelInputGlobals.getInstance(phone);
        var selectedCountryData = iti.getSelectedCountryData();
        var countryCode = selectedCountryData.dialCode;
    }


    if (phonev != "" && (input_type === 'email' || input_type === 'phone')) {
        $.ajax({
            method: 'POST',
            url: input_type === 'phone' ? site_url + 'login_otp' : site_url + 'send-login-email-otp',
            data: {
                language: default_language,
                devicetype: "1",
                country_code: countryCode,
                phone: phonev,
                email: phonev,
                qouteid: qouteid,
                [csrfName]: csrfHash

            },
            success: function (response) {
                loginLoader.classList.add('d-none');
                if (response.msg == 'User not exist') {
                    if (default_language === 1)
                        setInTelErrorMsg(phone, '<i class="fa-solid fa-circle-xmark"></i> الرجاء التسجيل قبل تسجيل الدخول.')
                    else
                        setInTelErrorMsg(phone, '<i class="fa-solid fa-circle-xmark"></i> Please signup before login.')
                } else if (response.msg == 'Sms sent') {
                    setInTelSuccessMsg(phone);
                    loginInputContainer.className = "d-none";
                    loginOtpContainer.className = "";
                    startResendTimer();
                } else {
                    setInTelErrorMsg(phone, `<i class="fa-solid fa-circle-xmark"></i> ${response.msg}.`);
                }
            },
            error: function (response) {
                loginLoader.classList.add('d-none');
                setInTelErrorMsg(phone, `<i class="fa-solid fa-circle-xmark"></i> ${response.responseJSON.msg}.`);
            }
        });
    }
}

const sendRegistrationOtp = () => {
    loginLoader.className = "";
    var phone = document.getElementById('log_mobileno');
    var phonev = phone.value;
    var countryCode = '';
    var qouteid = '';
    var input_type = checkInputType(phonev);
    var phoneFlag = 0;
    var nameFlag = 0;

    if (phonev == "" || phonev == null) {
        loginLoader.classList.add('d-none');
        if (default_language === 1)
            setInTelErrorMsg(phone, '<i class="fa-solid fa-circle-xmark"></i> رقم الهاتف أو البريد الإلكتروني فارغ.')
        else
            setInTelErrorMsg(phone, '<i class="fa-solid fa-circle-xmark"></i> Phone no or email is empty.');
        phoneFlag = 0;
    } else if (input_type !== 'email' && input_type !== 'phone') {
        loginLoader.classList.add('d-none');
        if (default_language === 1)
            setInTelErrorMsg(phone, '<i class="fa-solid fa-circle-xmark"></i> رقم الهاتف أو البريد الإلكتروني غير صالح.')
        else
            setInTelErrorMsg(phone, '<i class="fa-solid fa-circle-xmark"></i> Invalid phone no or email.');;
        phoneFlag = 0;
    } else {
        setInTelSuccessMsg(phone);
        phoneFlag = 1;
    }

    if (input_type === 'phone') {
        var iti = window.intlTelInputGlobals.getInstance(phone);
        var selectedCountryData = iti.getSelectedCountryData();
        var countryCode = selectedCountryData.dialCode;
    }

    if (fullName.value == "" || fullName.value == null) {
        loginLoader.classList.add('d-none');
        if (default_language === 1)
            setErrorMsg(fullName, '<i class="fa-solid fa-circle-xmark"></i> الإسم الكامل ضروري.');
        else
            setErrorMsg(fullName, '<i class="fa-solid fa-circle-xmark"></i> Full name is required.');
        nameFlag = 0;
    } else {
        setSuccessMsg(fullName);
        nameFlag = 1
    }


    if (nameFlag == 1 && phoneFlag == 1) {
        $.ajax({
            method: 'POST',
            url: site_url + 'signup',
            data: {
                language: default_language,
                devicetype: "1",
                phone: phonev,
                country_code: countryCode,
                user_name: fullName.value,
                [csrfName]: csrfHash,
            },
            success: function (response) {
                loginLoader.classList.add('d-none');
                if (response.status == 1) {
                    setInTelSuccessMsg(phone);
                    signupInputContainer.className = "d-none";
                    loginOtpContainer.className = "";
                    startResendTimer();
                } else {
                    setInTelErrorMsg(phone, `<i class="fa-solid fa-circle-xmark"></i> ${response.msg}.`);
                }
            },
            error: function (response) {
                loginLoader.classList.add('d-none');
                setInTelErrorMsg(phone, `<i class="fa-solid fa-circle-xmark"></i> ${response.responseJSON.msg}.`);
            }
        });
    }
}

if (sendLoginOtpBtn) {
    sendLoginOtpBtn.addEventListener('click', () => {
        sendLoginOtp();
    });
}

if (sendSignUpOtpBtn) {
    sendSignUpOtpBtn.addEventListener('click', () => {
        sendRegistrationOtp();
    });
}

if (submitOtpBtn) {
    submitOtpBtn.addEventListener('click', () => {
        loginLoader.className = "";
        var phone = document.getElementById('log_mobileno');
        var phonev = phone.value;
        var otp_login = getOTPVal("otp-field");
        var input_type = checkInputType(phonev);
        var qouteid = '';

        if (phonev == "" || phonev == null) {
            loginLoader.classList.add('d-none');
            if (default_language === 1)
                setInTelErrorMsg(phone, '<i class="fa-solid fa-circle-xmark"></i> رقم الهاتف أو البريد الإلكتروني فارغ.')
            else
                setInTelErrorMsg(phone, '<i class="fa-solid fa-circle-xmark"></i> Phone no or email is empty.')
        } else if (input_type !== 'email' && input_type !== 'phone') {
            loginLoader.classList.add('d-none');
            if (default_language === 1)
                setInTelErrorMsg(phone, '<i class="fa-solid fa-circle-xmark"></i> رقم الهاتف أو البريد الإلكتروني غير صالح.')
            else
                setInTelErrorMsg(phone, '<i class="fa-solid fa-circle-xmark"></i> Invalid phone no or email.')
        } else {
            setInTelSuccessMsg(phone);
            if (otp_login === '') {
                loginLoader.classList.add('d-none');
                if (default_language === 1)
                    setOtpErrorMsg(loginOtpBox, '<i class="fa-solid fa-circle-xmark"></i> كلمة المرور لمرة واحدة فارغة.')
                else
                    setOtpErrorMsg(loginOtpBox, '<i class="fa-solid fa-circle-xmark"></i> OTP is empty.')
            } else if (otp_login.length !== 6) {
                loginLoader.classList.add('d-none');
                if (default_language === 1)
                    setOtpErrorMsg(loginOtpBox, '<i class="fa-solid fa-circle-xmark"></i> يجب أن يكون طول كلمة المرور لمرة واحدة ستة.')
                else
                    setOtpErrorMsg(loginOtpBox, '<i class="fa-solid fa-circle-xmark"></i> OTP should be 6 in length.')
            } else {
                setOtpSuccessMsg(loginOtpBox);
            }
        }

        if (phonev != "" && otp_login.length === 6 && (input_type === 'email' || input_type === 'phone')) {

            $.ajax({
                method: 'POST',
                url: input_type === 'phone' ? site_url + 'user_login' : site_url + 'email-login',
                data: {
                    language: default_language,
                    devicetype: "1",
                    phone: phonev,
                    email: phonev,
                    otp_login: otp_login,
                    qouteid: qouteid,
                    [csrfName]: csrfHash

                },
                success: function (response) {
                    if (response.msg == 'Login successfully') {
                        setOtpSuccessMsg(loginOtpBox);
                        if (document.referrer) {
                            if (document.referrer !== site_url.concat('login')) {
                                // window.location.href = document.referrer;
                                window.history.go(-1);
                            } else {
                                window.location.href = site_url;
                            }
                        } else {
                            window.location.href = site_url;
                        }
                    } else {
                        loginLoader.classList.add('d-none');
                        setOtpErrorMsg(loginOtpBox, `<i class="fa-solid fa-circle-xmark"></i> ${response.msg}.`);
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    loginLoader.classList.add('d-none');
                    setOtpErrorMsg(phone, `<i class="fa-solid fa-circle-xmark"></i> ${errorThrown}.`)
                }
            });

        }
    });
}

if (submitSignUpForm) {

    submitSignUpForm.addEventListener('click', () => {
        loginLoader.className = "";
        var phone = document.getElementById('log_mobileno');
        var phonev = phone.value;
        var otp_login = getOTPVal("otp-field");
        var input_type = checkInputType(phonev);

        if (otp_login === '') {
            loginLoader.classList.add('d-none');
            if (default_language === 1)
                setOtpErrorMsg(loginOtpBox, '<i class="fa-solid fa-circle-xmark"></i> كلمة المرور لمرة واحدة فارغة.')
            else
                setOtpErrorMsg(loginOtpBox, '<i class="fa-solid fa-circle-xmark"></i> OTP is empty.')
        } else if (otp_login.length !== 6) {
            loginLoader.classList.add('d-none');
            if (default_language === 1)
                setOtpErrorMsg(loginOtpBox, '<i class="fa-solid fa-circle-xmark"></i> يجب أن يكون طول كلمة المرور لمرة واحدة ستة.')
            else
                setOtpErrorMsg(loginOtpBox, '<i class="fa-solid fa-circle-xmark"></i> OTP should be 6 in length.')
        } else {
            setOtpSuccessMsg(loginOtpBox);
        }

        if (fullName.value != "" && phonev != "" && otp_login.length === 6 && (input_type === 'email' || input_type === 'phone')) {
            $.ajax({
                method: 'POST',
                url: site_url + 'verify_otp',
                data: {
                    language: default_language,
                    phone: phonev,
                    otp: otp_login,
                    user_name: fullName.value,
                    [csrfName]: csrfHash,
                },
                success: function (response) {
                    if (response.status == 1) {
                        setOtpSuccessMsg(loginOtpBox);
                        window.location.href = site_url;
                    } else {
                        loginLoader.classList.add('d-none');
                        setOtpErrorMsg(loginOtpBox, `<i class="fa-solid fa-circle-xmark"></i> ${response.msg}.`);
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    loginLoader.classList.add('d-none');
                    setOtpErrorMsg(phone, `<i class="fa-solid fa-circle-xmark"></i> ${errorThrown}.`)
                }
            });

        }
    });
}

editBtn.addEventListener('click', () => {
    loginLoader.className = "";
    clearOTPVal('otp-field');
    intializeOtpContainer(loginOtpBox);
    setTimeout(() => {
        clearInterval(countdownInterval);
        resendOtpBtn.className = 'fw-bolder';
        if (default_language === 1)
            resendOtpBtn.innerText = "أعد إرسال كلمة المرور لمرة واحدة";
        else
            resendOtpBtn.innerText = "RESEND OTP";
        resendOtpBtn.disabled = false;
        loginOtpContainer.className = "d-none";
        if (loginInputContainer)
            loginInputContainer.className = "";
        else
            signupInputContainer.className = "";
        loginLoader.className = "d-none";
    }, 500);
});

// For OTP Screen
const inputs = document.querySelectorAll(".otp-field > input");
const button = document.querySelector(".btn");

window.addEventListener("load", () => inputs[0].focus());
button.setAttribute("disabled", "disabled");

inputs[0].addEventListener("paste", function (event) {
    event.preventDefault();

    const pastedValue = (event.clipboardData || window.clipboardData).getData(
        "text"
    );
    const otpLength = inputs.length;

    for (let i = 0; i < otpLength; i++) {
        if (i < pastedValue.length) {
            inputs[i].value = pastedValue[i];
            inputs[i].removeAttribute("disabled");
            inputs[i].focus;
        } else {
            inputs[i].value = ""; // Clear any remaining inputs
            inputs[i].focus;
        }
    }
});

inputs.forEach((input, index1) => {
    input.addEventListener("keyup", (e) => {
        const currentInput = input;
        const nextInput = input.nextElementSibling;
        const prevInput = input.previousElementSibling;

        if (currentInput.value.length > 1) {
            currentInput.value = "";
            return;
        }

        if (
            nextInput &&
            nextInput.hasAttribute("disabled") &&
            currentInput.value !== ""
        ) {
            nextInput.removeAttribute("disabled");
            nextInput.focus();
        }

        if (e.key === "Backspace") {
            inputs.forEach((input, index2) => {
                if (index1 <= index2 && prevInput) {
                    input.setAttribute("disabled", true);
                    input.value = "";
                    prevInput.focus();
                }
            });
        }

        button.classList.remove("active");
        button.setAttribute("disabled", "disabled");

        const inputsNo = inputs.length;
        if (!inputs[inputsNo - 1].disabled && inputs[inputsNo - 1].value !== "") {
            button.classList.add("active");
            button.removeAttribute("disabled");

            return;
        }
    });
});

const getOTPVal = (otpDivClass) => {
    var otpVal = '';
    const inputs = document.querySelectorAll('.' + otpDivClass + ' > *[id]');
    for (let i = 0; i < inputs.length; i++) {
        otpVal += inputs[i].value;
    }
    return otpVal;
}

const clearOTPVal = (otpDivClass) => {
    const inputs = document.querySelectorAll('.' + otpDivClass + ' > *[id]');
    for (let i = 0; i < inputs.length; i++) {
        inputs[i].value = '';
    }
}

// Resend OTP Timer
resendOtpBtn.addEventListener("click", function () {
    clearOTPVal('otp-field');
    intializeOtpContainer(loginOtpBox);
    if (loginInputContainer)
        sendLoginOtp();
    else
        sendRegistrationOtp();
});

function startResendTimer() {
    // Disable the button to prevent multiple clicks
    resendOtpBtn.disabled = true;
    var resendOtpText = 'RESEND OTP';
    var resendOtpInText = 'Resend OTP in';
    // Show the timer element and set it to 30 seconds
    if (default_language == 1) {
        resendOtpText = 'إعادة إرسال كلمة المرور لمرة واحدة';
        resendOtpInText = 'أعد إرسال كلمة المرور لمرة واحدة بتنسيق';
    }
    resendOtpBtn.innerHTML = resendOtpInText + ': <span class="fw-bolder text-dark">00:30</span>';
    resendOtpBtn.className = 'text-muted fw-bold';

    var remainingSeconds = 30;
    countdownInterval = setInterval(function () {
        remainingSeconds--;
        var formattedSeconds = remainingSeconds < 10 ? "0" + remainingSeconds : remainingSeconds;
        resendOtpBtn.innerHTML = resendOtpInText + ': <span class="fw-bolder text-dark">00:' + formattedSeconds + '</span>';

        if (remainingSeconds <= 0) {
            // Reset the timer element and enable the button
            clearInterval(countdownInterval);
            resendOtpBtn.className = 'fw-bolder';
            resendOtpBtn.innerText = resendOtpText;
            resendOtpBtn.disabled = false;
        }
    }, 1000);
}

$(document).ready(function () {
    // Initialize the plugin on the input field with the id 'phone'
    const input = document.querySelector("#log_mobileno");
    const mobileNo = document.querySelector("#mobileno");
    if (input) {
        input.addEventListener('input', () => {
            var input_type = checkInputValue(input.value);
            document.querySelector('#login-input').innerText = input.value;
            if (input_type === 'email') {
                var iti = window.intlTelInputGlobals.getInstance(input);
                if (iti) {
                    iti.destroy();
                    input.style.cssText = "";
                }
            } else if (input_type === 'phone') {
                var iti = window.intlTelInputGlobals.getInstance(input);
                if (!iti) {
                    window.intlTelInput(input, {
                        initialCountry: "om",
                        onlyCountries: ["om", "bh", "kw", "qa", "sa", "ae"],
                        separateDialCode: true,
                        utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.8/build/js/utils.js"
                    });
                }
            }
            input.focus();
        });
    }
});