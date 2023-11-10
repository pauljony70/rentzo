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
const signupPhoneOtpBox = document.querySelector('.phone-otp-field');
const signupEmailOtpBox = document.querySelector('.email-otp-field');
const editBtn = document.querySelectorAll('#login-otp-container .fa-pen-to-square');
const fullname = document.querySelector('#fullname');
const signupPhone = document.querySelector('#phone_number');
const signupEmail = document.querySelector('#email');
var countdownInterval = '';


const checkInputValue = (input) => {
    var onlyNumbersRegex = /^\d+$/;

    if (onlyNumbersRegex.test(input)) {
        return 'phone';
    } else {
        return 'email';
    }
}

const checkInputType = (input) => {
    const emailRegex = /^\S+@\S+\.\S+$/; // Regular expression for email pattern
    const phoneRegex = /^\d+$/; // Regular expression for phone number pattern

    if (emailRegex.test(input)) {
        return 'email';
    } else if (phoneRegex.test(input)) {
        if (input.length === 10) {
            return 'phone';
        } else {
            return 'Invalid phone length';
        }
    } else {
        return 'nothing';
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
        setErrorMsg(phone, '<i class="fa-solid fa-circle-xmark"></i> Phone no or email is empty.')
    } else if (input_type !== 'email' && input_type !== 'phone') {
        loginLoader.classList.add('d-none');
        if (input_type === 'nothing')
            setErrorMsg(phone, '<i class="fa-solid fa-circle-xmark"></i> Invalid phone no or email.')
        else
            setErrorMsg(phone, `<i class="fa-solid fa-circle-xmark"></i> ${input_type}`)
    } else {
        setSuccessMsg(phone);
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
                    setErrorMsg(phone, '<i class="fa-solid fa-circle-xmark"></i> Please signup before login.')
                } else if (response.msg == 'Sms sent') {
                    setSuccessMsg(phone);
                    loginInputContainer.classList.add('d-none');
                    loginOtpContainer.classList.remove('d-none');
                    startResendTimer();
                } else {
                    setErrorMsg(phone, `<i class="fa-solid fa-circle-xmark"></i> ${response.msg}.`);
                }
            },
            error: function (response) {
                loginLoader.classList.add('d-none');
                setErrorMsg(phone, `<i class="fa-solid fa-circle-xmark"></i> ${response.responseJSON.msg}.`);
            }
        });
    }
}

const sendRegistrationOtp = () => {
    loginLoader.className = "";
    document.getElementById('error-alert-div').classList.add('d-none');

    if (validateSignUpForm()) {
        $.ajax({
            method: 'POST',
            url: site_url + 'signup',
            data: {
                language: default_language,
                fullname: fullname.value,
                phone: signupPhone.value,
                email: signupEmail.value,
                [csrfName]: csrfHash,
            },
            success: function (response) {
                loginLoader.classList.add('d-none');
                if (response.status == 1) {
                    signupInputContainer.classList.add('d-none');
                    loginOtpContainer.classList.remove('d-none');
                    startResendTimer();
                } else {
                    document.getElementById('error-alert-div').classList.remove('d-none');
                    document.getElementById('error-alert').textContent = response.msg;
                }
            },
            error: function (response) {
                loginLoader.classList.add('d-none');
                console.log(response);
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
                setErrorMsg(phone, '<i class="fa-solid fa-circle-xmark"></i> رقم الهاتف أو البريد الإلكتروني فارغ.')
            else
                setErrorMsg(phone, '<i class="fa-solid fa-circle-xmark"></i> Phone no or email is empty.')
        } else if (input_type !== 'email' && input_type !== 'phone') {
            loginLoader.classList.add('d-none');
            if (default_language === 1)
                setErrorMsg(phone, '<i class="fa-solid fa-circle-xmark"></i> رقم الهاتف أو البريد الإلكتروني غير صالح.')
            else
                setErrorMsg(phone, '<i class="fa-solid fa-circle-xmark"></i> Invalid phone no or email.')
        } else {
            setSuccessMsg(phone);
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
                        window.history.go(-1);
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
        document.getElementById('otp-error-alert-div').classList.add('d-none');
        var phone_otp = getOTPVal("phone-otp-field");
        var email_otp = getOTPVal("email-otp-field");

        if (phone_otp === '') {
            loginLoader.classList.add('d-none');
            setOtpErrorMsg(signupPhoneOtpBox, '<i class="fa-solid fa-circle-xmark"></i> OTP is empty.')
        } else if (phone_otp.length !== 6) {
            loginLoader.classList.add('d-none');
            setOtpErrorMsg(signupPhoneOtpBox, '<i class="fa-solid fa-circle-xmark"></i> OTP should be 6 in length.')
        } else {
            setOtpSuccessMsg(signupPhoneOtpBox);
        }

        if (email_otp === '') {
            loginLoader.classList.add('d-none');
            setOtpErrorMsg(signupEmailOtpBox, '<i class="fa-solid fa-circle-xmark"></i> OTP is empty.')
        } else if (email_otp.length !== 6) {
            loginLoader.classList.add('d-none');
            setOtpErrorMsg(signupEmailOtpBox, '<i class="fa-solid fa-circle-xmark"></i> OTP should be 6 in length.')
        } else {
            setOtpSuccessMsg(signupEmailOtpBox);
        }

        if (validateSignUpForm() && phone_otp.length === 6 && email_otp.length === 6) {
            $.ajax({
                method: 'POST',
                url: site_url + 'verify_otp',
                data: {
                    language: default_language,
                    fullname: fullname.value,
                    phone: signupPhone.value,
                    email: signupEmail.value,
                    phone_otp: phone_otp,
                    email_otp: email_otp,
                    [csrfName]: csrfHash,
                },
                success: function (response) {
                    if (response.status == 1) {
                        document.getElementById('otp-error-alert-div').classList.add('d-none');
                        // window.location.href = document.referrer;
                        window.history.go(-1);
                    } else {
                        loginLoader.classList.add('d-none');
                        document.getElementById('otp-error-alert-div').classList.remove('d-none');
                        document.getElementById('otp-error-alert').textContent = response.msg;
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    loginLoader.classList.add('d-none');
                    console.log(errorThrown);
                }
            });

        }
    });
}

const validateSignUpForm = () => {
    var nameFlag = 0;
    var emailFlag = 0;
    var phoneFlag = 0;

    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (fullname.value == "" || fullname.value == null) {
        loginLoader.classList.add('d-none');
        setErrorMsg(fullname, '<i class="fa-solid fa-circle-xmark"></i> Full name is required.');
        nameFlag = 0;
    } else {
        setSuccessMsg(fullname);
        nameFlag = 1
    }

    if (signupEmail.value == "" || signupEmail.value == null) {
        loginLoader.classList.add('d-none');
        setErrorMsg(signupEmail, '<i class="fa-solid fa-circle-xmark"></i> Email is required.');
        emailFlag = 0;
    } else if (!emailRegex.test(signupEmail.value)) {
        loginLoader.classList.add('d-none');
        setErrorMsg(signupEmail, '<i class="fa-solid fa-circle-xmark"></i> Invalid email.');;
        emailFlag = 0;
    } else {
        setSuccessMsg(signupEmail);
        emailFlag = 1;
    }

    if (signupPhone.value == "" || signupPhone.value == null) {
        loginLoader.classList.add('d-none');
        setErrorMsg(signupPhone, '<i class="fa-solid fa-circle-xmark"></i> Phone no is required.');
        phoneFlag = 0;
    } else if (!(/^\d{10}$/.test(signupPhone.value.replace(/\s|-/g, '')))) {
        loginLoader.classList.add('d-none');
        setErrorMsg(signupPhone, '<i class="fa-solid fa-circle-xmark"></i> Invalid phone no.');;
        phoneFlag = 0;
    } else {
        setSuccessMsg(signupPhone);
        phoneFlag = 1;
    }

    if (nameFlag == 1 && emailFlag == 1 && phoneFlag == 1)
        return true
    else
        return false;
}

editBtn.forEach(element => {
    element.addEventListener('click', () => {
        loginLoader.className = "";
        clearOTPVal('otp-field');
        clearOTPVal('phone-otp-field');
        clearOTPVal('email-otp-field');
        intializeOtpContainer(loginOtpBox);
        intializeOtpContainer(signupPhoneOtpBox);
        intializeOtpContainer(signupEmailOtpBox);
        setTimeout(() => {
            clearInterval(countdownInterval);
            resendOtpBtn.innerText = "RESEND OTP";
            resendOtpBtn.disabled = false;
            loginOtpContainer.classList.add('d-none');
            if (loginInputContainer)
                loginInputContainer.classList.remove('d-none');
            else
                signupInputContainer.classList.remove('d-none');
            loginLoader.className = "d-none";
        }, 500);
    });
});

// For OTP Screen
const inputs = document.querySelectorAll(".otp-field > input");
const signupPhoneinputs = document.querySelectorAll(".phone-otp-field > input");
const signupEmailinputs = document.querySelectorAll(".email-otp-field > input");
const button = document.querySelector(".btn");

// window.addEventListener("load", () => inputs[0].focus());
button.setAttribute("disabled", "disabled");

if (inputs.length > 0) {
    inputs[0].addEventListener("paste", function (event) {
        event.preventDefault();

        var pastedValue = (event.clipboardData || window.clipboardData).getData(
            "text"
        );
        var otpLength = inputs.length;

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
            var currentInput = input;
            var nextInput = input.nextElementSibling;
            var prevInput = input.previousElementSibling;

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

            var inputsNo = inputs.length;
            if (!inputs[inputsNo - 1].disabled && inputs[inputsNo - 1].value !== "") {
                button.classList.add("active");
                button.removeAttribute("disabled");

                return;
            }
        });
    });
}

if (signupPhoneinputs.length > 0) {
    signupPhoneinputs[0].addEventListener("paste", function (event) {
        event.preventDefault();

        var pastedValue = (event.clipboardData || window.clipboardData).getData(
            "text"
        );
        var otpLength = signupPhoneinputs.length;

        for (let i = 0; i < otpLength; i++) {
            if (i < pastedValue.length) {
                signupPhoneinputs[i].value = pastedValue[i];
                signupPhoneinputs[i].removeAttribute("disabled");
                signupPhoneinputs[i].focus;
            } else {
                signupPhoneinputs[i].value = ""; // Clear any remaining signupPhoneinputs
                signupPhoneinputs[i].focus;
            }
        }
    });

    signupPhoneinputs.forEach((input, index1) => {
        input.addEventListener("keyup", (e) => {
            var currentInput = input;
            var nextInput = input.nextElementSibling;
            var prevInput = input.previousElementSibling;

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
                signupPhoneinputs.forEach((input, index2) => {
                    if (index1 <= index2 && prevInput) {
                        input.setAttribute("disabled", true);
                        input.value = "";
                        prevInput.focus();
                    }
                });
            }

            button.classList.remove("active");
            button.setAttribute("disabled", "disabled");

            var inputsNo = signupPhoneinputs.length;
            if (!signupPhoneinputs[inputsNo - 1].disabled && signupPhoneinputs[inputsNo - 1].value !== "") {
                button.classList.add("active");
                button.removeAttribute("disabled");

                return;
            }
        });
    });
}

if (signupEmailinputs.length > 0) {
    signupEmailinputs[0].addEventListener("paste", function (event) {
        event.preventDefault();

        var pastedValue = (event.clipboardData || window.clipboardData).getData(
            "text"
        );
        var otpLength = signupEmailinputs.length;

        for (let i = 0; i < otpLength; i++) {
            if (i < pastedValue.length) {
                signupEmailinputs[i].value = pastedValue[i];
                signupEmailinputs[i].removeAttribute("disabled");
                signupEmailinputs[i].focus;
            } else {
                signupEmailinputs[i].value = ""; // Clear any remaining signupEmailinputs
                signupEmailinputs[i].focus;
            }
        }
    });

    signupEmailinputs.forEach((input, index1) => {
        input.addEventListener("keyup", (e) => {
            var currentInput = input;
            var nextInput = input.nextElementSibling;
            var prevInput = input.previousElementSibling;

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
                signupEmailinputs.forEach((input, index2) => {
                    if (index1 <= index2 && prevInput) {
                        input.setAttribute("disabled", true);
                        input.value = "";
                        prevInput.focus();
                    }
                });
            }

            button.classList.remove("active");
            button.setAttribute("disabled", "disabled");

            var inputsNo = signupEmailinputs.length;
            if (!signupEmailinputs[inputsNo - 1].disabled && signupEmailinputs[inputsNo - 1].value !== "") {
                button.classList.add("active");
                button.removeAttribute("disabled");

                return;
            }
        });
    });
}

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

    if (inputs.length > 0) {
        for (let i = 0; i < inputs.length; i++) {
            inputs[i].value = '';

            // Disable all inputs except the first one
            if (i !== 0) {
                inputs[i].disabled = true;
            } else {
                inputs[i].disabled = false;
                inputs[i].focus(); // Optional: Set focus to the first input
            }
        }
    }
}

// Resend OTP Timer
resendOtpBtn.addEventListener("click", function () {
    clearOTPVal('otp-field');
    clearOTPVal('phone-otp-field');
    clearOTPVal('email-otp-field');
    intializeOtpContainer(loginOtpBox);
    intializeOtpContainer(signupPhoneOtpBox);
    intializeOtpContainer(signupEmailOtpBox);
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
    resendOtpBtn.innerHTML = resendOtpInText + ': <span class="fw-bolder text-dark">00:30</span>';

    var remainingSeconds = 30;
    countdownInterval = setInterval(function () {
        remainingSeconds--;
        var formattedSeconds = remainingSeconds < 10 ? "0" + remainingSeconds : remainingSeconds;
        resendOtpBtn.innerHTML = resendOtpInText + ': <span class="fw-bolder text-dark">00:' + formattedSeconds + '</span>';

        if (remainingSeconds <= 0) {
            // Reset the timer element and enable the button
            clearInterval(countdownInterval);
            resendOtpBtn.innerText = resendOtpText;
            resendOtpBtn.disabled = false;
        }
    }, 1000);
}

$(document).ready(function () {
    // Initialize the plugin on the input field with the id 'phone'
    const input = document.querySelector("#log_mobileno");
    if (input) {
        input.addEventListener('input', () => {
            document.querySelector('#login-input').innerText = input.value;
        });
    }
    if (signupPhone) {
        signupPhone.addEventListener('input', () => {
            document.querySelector('#signup-input-phone').innerText = signupPhone.value;
        });
    }
    if (signupEmail) {
        signupEmail.addEventListener('input', () => {
            document.querySelector('#signup-input-email').innerText = signupEmail.value;
        });
    }
});