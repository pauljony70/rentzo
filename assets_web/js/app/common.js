(function () {
  function checkDeviceType() {
    var userAgent = navigator.userAgent.toLowerCase();

    if (userAgent.match(/mobile|android|iphone|ipad|ipod|blackberry|iemobile|opera mini/i)) {
      // Mobile device
      document.body.classList.add('responsive-body');
    } else if (userAgent.match(/tablet|ipad/i)) {
      // Tablet device
      document.body.classList.add('responsive-body');
    } else {
      // Desktop device
      document.body.classList.remove('responsive-body');
    }
  }

  window.addEventListener('load', checkDeviceType);
  window.addEventListener('resize', checkDeviceType);
})();

function setErrorMsg(ele, errormsgs) {
  const formGroup = ele.parentElement;
  const formInput = formGroup.querySelector('.form-control');
  const span = formGroup.querySelector('#error');
  span.innerHTML = errormsgs;
  formInput.className = "form-control is-invalid";
  span.className = "invalid-feedback fw-bolder";
}

function setSuccessMsg(ele) {
  const formGroup = ele.parentElement;
  const formInput = formGroup.querySelector('.form-control');
  formInput.className = "form-control success";
}

function setSelectErrorMsg(ele, errormsgs) {
  const formGroup = ele.parentElement;
  const formInput = formGroup.querySelector('.form-select');
  const span = formGroup.querySelector('#error');
  span.innerHTML = errormsgs;
  formInput.className = "form-select is-invalid";
  span.className = "invalid-feedback fw-bolder";
}

function setSelectSuccessMsg(ele) {
  const formGroup = ele.parentElement;
  const formInput = formGroup.querySelector('.form-select');
  formInput.className = "form-select success";
}

const setInTelErrorMsg = (ele, errormsgs) => {
  const formGroup = ele.parentElement.parentElement;
  const formInput = formGroup.querySelector('.intl-tel-input');
  const span = formInput.parentElement.parentElement.querySelector('#error');
  span.innerHTML = errormsgs;
  span.style.cssText = "color: #f25042; font-size: 0.875em; margin-top: 4px; font-weight: 600"
  formInput.classList.add('is-invalid');
}

function setInTelSuccessMsg(ele) {
  const formGroup = ele.parentElement.parentElement;
  const formInput = formGroup.querySelector('.intl-tel-input');
  formInput.classList.remove('is-invalid');
  const span = formInput.parentElement.parentElement.querySelector('#error');
  span.innerHTML = "";
}

function setOtpErrorMsg(ele, errormsgs) {
  const formGroup = ele.parentElement;

  const formInputs = formGroup.querySelectorAll('input');
  const span = formGroup.querySelector('#error');
  span.innerHTML = errormsgs;
  span.style.cssText = "color: #f25042; font-size: 0.875em; margin-top: 4px; font-weight: 600";
  formInputs.forEach(formInput => {
    formInput.style.cssText = "border: 1px solid #f25042;"
  });
}

function setOtpSuccessMsg(ele) {
  const formGroup = ele.parentElement;
  const formInputs = formGroup.querySelectorAll('input');
  const span = formGroup.querySelector('#error');
  span.innerHTML = "";
  span.style.cssText = "";
  formInputs.forEach(formInput => {
    formInput.style.cssText = "border: 1px solid #333;"
  });
}

function intializeOtpContainer(ele) {
  if (ele) {
    const formGroup = ele.parentElement;
    const formInputs = formGroup.querySelectorAll('input');
    const span = formGroup.querySelector('#error');
    span.innerHTML = "";
    span.style.cssText = "";
    formInputs.forEach(formInput => {
      formInput.style.cssText = ""
    });
  }
}

function setDropifyErrorMsg(input, ele, errormsgs) {
  const formGroup = input.parentElement;
  formGroup.style.border = "1px solid #f25042";
  ele.style.cssText = "width: 100%; margin-top: 0.25rem; font-size: 0.875em; color: #f25042; font-weight:bolder";
  ele.innerHTML = errormsgs;
}

/* Set Dropify Success Message */
function setDropifySuccessMsg(input, ele) {
  const formGroup = input.parentElement;
  formGroup.style.border = "1px solid #ccc";
  ele.innerHTML = "";
}

function convertToFloat(str) {
  return parseFloat(str.split(' ')[0]);
}

function priceFormat(price) {
  let newPrice = 0;
  const currency = '₹';

  if (price > 0) {
    if (price.toString().includes('.')) {
      newPrice = currency + ' ' + price.toFixed(2);
    } else {
      newPrice = currency + ' ' + price.toFixed(2);
    }
  }
  return newPrice;
}

const buttonLoader = (ele) => {
  ele.innerHTML =
    `<div class="spinner-border spinner-border text-light" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>`;
}

const buttonLoaderPrimary = (ele) => {
  ele.innerHTML =
    `<div class="spinner-border spinner-border-sm text-primary" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>`;
}

// Function to retrieve the value of a specific cookie
function getCookie(name) {
  const cookieString = document.cookie;
  const cookies = cookieString.split('; ');

  for (const cookie of cookies) {
    const [cookieName, cookieValue] = cookie.split('=');
    if (cookieName === name) {
      return decodeURIComponent(cookieValue);
    }
  }

  return null;
}

function hexToRgb(hex) {
  // remove the "#" symbol
  hex = hex.replace("#", "");

  // convert to RGB
  const r = parseInt(hex.substring(0, 2), 16);
  const g = parseInt(hex.substring(2, 4), 16);
  const b = parseInt(hex.substring(4, 6), 16);

  return {
    r,
    g,
    b
  };
}

function enforceMaxLength(input) {
  const maxLength = input.getAttribute('maxlength');
  if (input.value.length > maxLength) {
    input.value = input.value.slice(0, maxLength);
  }
}

const validateAddressForm = async () => {
  var fullname_a = document.querySelector("#fullname_a");
  var email = document.querySelector("#email");
  var mobile = document.querySelector("#mobile");
  var fulladdress = document.querySelector("#fulladdress");
  var pincode = document.querySelector("#pincode");
  var state = document.querySelector("#state");
  var city = document.querySelector("#city");

  var flag_fullname_a = 0;
  var flag_email = 0;
  var flag_mobile = 0;
  var flag_fulladdress = 0;
  var flag_pincode = 0;
  var flag_state = 0;
  var flag_city = 0;

  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  var firstErrorElement = null;

  if (fullname_a.value == '') {
    flag_fullname_a = 0;
    setErrorMsg(fullname_a, '<i class="fa-solid fa-circle-xmark"></i> Full name is required.');
    if (!firstErrorElement) {
      firstErrorElement = fullname_a;
    }
  } else {
    flag_fullname_a = 1;
    setSuccessMsg(fullname_a);
  }
  if (email.value == '') {
    flag_email = 0;
    setErrorMsg(email, '<i class="fa-solid fa-circle-xmark"></i> Email is required.');
    if (!firstErrorElement) {
      firstErrorElement = email;
    }
  } else if (!emailRegex.test(email.value)) {
    flag_email = 0;
    setErrorMsg(email, '<i class="fa-solid fa-circle-xmark"></i> Please enter a valid email address.');
    if (!firstErrorElement) {
      firstErrorElement = email;
    }
  } else {
    flag_email = 1;
    setSuccessMsg(email);
  }
  if (mobile.value == '') {
    flag_mobile = 0;
    setErrorMsg(mobile, '<i class="fa-solid fa-circle-xmark"></i> Mobile is required.');
    if (!firstErrorElement) {
      firstErrorElement = mobile;
    }
  } else {
    flag_mobile = 1;
    setSuccessMsg(mobile);
  }
  if (fulladdress.value == '') {
    flag_fulladdress = 0;
    setErrorMsg(fulladdress, '<i class="fa-solid fa-circle-xmark"></i> Address is required.');
    if (!firstErrorElement) {
      firstErrorElement = fulladdress;
    }
  } else {
    flag_fulladdress = 1;
    setSuccessMsg(fulladdress);
  }
  if (pincode.value == '') {
    flag_pincode = 0;
    setErrorMsg(pincode, '<i class="fa-solid fa-circle-xmark"></i> Pincode is required.');
    if (!firstErrorElement) {
      firstErrorElement = pincode;
    }
  } else {
    flag_pincode = 1;
    setSuccessMsg(pincode);
  }

  if (state.value == '') {
    flag_state = 0;
    setSelectErrorMsg(state, '<i class="fa-solid fa-circle-xmark"></i> State is required.');
    if (!firstErrorElement) {
      firstErrorElement = state;
    }
  } else {
    flag_state = 1;
    setSelectSuccessMsg(state);
  }

  if (city.value == '') {
    flag_city = 0;
    setSelectErrorMsg(city, '<i class="fa-solid fa-circle-xmark"></i> City is required.');
    if (!firstErrorElement) {
      firstErrorElement = city;
    }
  } else {
    flag_city = 1;
    setSelectSuccessMsg(city);
  }

  // Set focus on the first error element
  if (firstErrorElement) {
    firstErrorElement.focus();
  }

  if (flag_fullname_a === 1 && flag_email === 1 && flag_mobile === 1 && flag_fulladdress === 1 && flag_pincode === 1 && flag_state === 1 && flag_city === 1) {
    return true;
  } else if (flag_fullname_a === 0 && flag_email === 0 && flag_mobile === 0 && flag_fulladdress === 0 && flag_pincode === 0 && flag_state === 0 && flag_city === 0) {
    nativeToast({
      message: 'Please select or add address!',
      position: 'bottom',
      type: 'error',
      square: true,
      edge: false,
      debug: false
    });
    throw new Error('Please select or add address!'); // Throw an error if condition not met
  } else {
    throw new Error('Validation failed'); // Throw an error if validation fails
  }
}