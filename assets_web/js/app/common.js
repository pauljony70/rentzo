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

function priceFormat(value) {
  if (value > 0)
    return value.toFixed(2).concat(' ', 'OMR');
  else
    return 0;
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