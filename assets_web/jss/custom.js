const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
$(window).scroll(function () {
  var scroll = $(window).scrollTop();
  if (scroll > 120) {
    $("#btn-mb").addClass("active");
  }
  else {
    $("#btn-mb").removeClass("active");
  }
});


$("#sliderModal").on('hidden.bs.modal', function (e) {
  $("#sliderModal iframe").attr("src", $("#sliderModal iframe").attr("src"));
});


$(document).ready(function () {
  $('.minus').click(function () {
    var $input = $(this).parent().find('input');
    var count = parseInt($input.val()) - 1;
    count = count < 1 ? 1 : count;
    $input.val(count);
    $input.change();
    return false;
  });
  $('.plus').click(function () {
    var $input = $(this).parent().find('input');
    $input.val(parseInt($input.val()) + 1);
    $input.change();
    return false;
  });
});

/*--------------------------------------*/

/*4. Multistep Form */
/*--------------------------------------*/

/*--------------------------------------*/

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
  const formGroup = ele.parentElement;
  const formInputs = formGroup.querySelectorAll('input');
  const span = formGroup.querySelector('#error');
  span.innerHTML = "";
  span.style.cssText = "";
  formInputs.forEach(formInput => {
    formInput.style.cssText = "border: 1px solid #ddd;"
  });
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

$(document).ready(function () {

});

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

/* Waves-effect initialization */
document.addEventListener('DOMContentLoaded', function () {
  var wavesElems = document.querySelectorAll('.waves-effect');
  for (var i = 0; i < wavesElems.length; i++) {
    wavesElems[i].addEventListener('click', createRipple);
  }
});

function createRipple(event) {
  var button = event.currentTarget;
  var ripple = document.createElement('span');
  var diameter = Math.max(button.clientWidth, button.clientHeight);
  var radius = diameter / 2;

  ripple.style.width = ripple.style.height = diameter + 'px';
  ripple.style.left = event.clientX - button.getBoundingClientRect().left - radius + 'px';
  ripple.style.top = event.clientY - button.getBoundingClientRect().top - radius + 'px';

  ripple.classList.add('waves-ripple');

  var prevRipple = button.querySelector('.waves-ripple');
  if (prevRipple) {
    prevRipple.remove();
  }

  button.appendChild(ripple);
}

const getRegiondata = (country_id) => {
  $.ajax({
    method: 'POST',
    url: site_url + "get_region",
    data: {
      country_id: country_id,
      [csrfName]: csrfHash
    },
    success: function (response) {
      var data = $.parseJSON(response);
      $('#region').empty();
      if (default_language === 1)
        var o = new Option("اختر المنطقة", "");
      else
        var o = new Option("Select Region", "");
      $("#region").append(o);
      if (data["status"] == "1") {
        $(data["data"]).each(function () {
          if (default_language == 1)
            var o = new Option(this.name_ar, this.id);
          else
            var o = new Option(this.name, this.id);
          $("#region").append(o);
        });
      } else {
        // successmsg(data["msg"]);
      }
    }
  });
}

const getGovernoratedata = (region_id) => {
  $.ajax({
    method: 'POST',
    url: site_url + "get_governorates",
    data: {
      region_id: region_id,
      [csrfName]: csrfHash
    },
    success: function (response) {
      var data = $.parseJSON(response);
      $('#governorates').empty();
      if (default_language === 1)
        var o = new Option("حدد المحافظة", "");
      else
        var o = new Option("Select Governorate", "");
      $("#governorates").append(o);
      if (data["status"] == "1") {
        $(data["data"]).each(function () {
          if (default_language == 1)
            var o = new Option(this.name_ar, this.id);
          else
            var o = new Option(this.name, this.id);
          $("#governorates").append(o);
        });
      } else {
        // successmsg(data["msg"]);
      }
    }
  });
}

const getAreadata = (governorate_id) => {
  $.ajax({
    method: 'POST',
    url: site_url + "get_areas",
    data: {
      governorate_id: governorate_id,
      [csrfName]: csrfHash
    },
    success: function (response) {
      var data = $.parseJSON(response);
      $('#area').empty();
      if (default_language === 1)
        var o = new Option("حدد المنطقة", "");
      else
        var o = new Option("Select Area", "");
      $("#area").append(o);
      if (data["status"] == "1") {
        $(data["data"]).each(function () {
          if (default_language == 1)
            var o = new Option(this.name_ar, this.id);
          else
            var o = new Option(this.name, this.id);
          $("#area").append(o);
        });
      } else {
        // successmsg(data["msg"]);
      }
    }
  });
}

const getEditRegiondata = (country_id) => {
  $.ajax({
    method: 'POST',
    url: site_url + "get_region",
    data: {
      country_id: country_id,
      [csrfName]: csrfHash
    },
    success: function (response) {
      var data = $.parseJSON(response);
      $('#edit-region').empty();
      if (default_language === 1)
        var o = new Option("اختر المنطقة", "");
      else
        var o = new Option("Select Region", "");
      $("#edit-region").append(o);
      if (data["status"] == "1") {
        $(data["data"]).each(function () {
          if (default_language == 1)
            var o = new Option(this.name_ar, this.id);
          else
            var o = new Option(this.name, this.id);
          $("#edit-region").append(o);
        });
      } else {
        // successmsg(data["msg"]);
      }
    }
  });
}

const getEditGovernoratedata = (region_id) => {
  $.ajax({
    method: 'POST',
    url: site_url + "get_governorates",
    data: {
      region_id: region_id,
      [csrfName]: csrfHash
    },
    success: function (response) {
      var data = $.parseJSON(response);
      $('#edit-governorates').empty();
      if (default_language === 1)
        var o = new Option("حدد المحافظة", "");
      else
        var o = new Option("Select Governorate", "");
      $("#edit-governorates").append(o);
      if (data["status"] == "1") {
        $(data["data"]).each(function () {
          if (default_language == 1)
            var o = new Option(this.name_ar, this.id);
          else
            var o = new Option(this.name, this.id);
          $("#edit-governorates").append(o);
        });
      } else {
        // successmsg(data["msg"]);
      }
    }
  });
}

const getEditAreadata = (governorate_id) => {
  $.ajax({
    method: 'POST',
    url: site_url + "get_areas",
    data: {
      governorate_id: governorate_id,
      [csrfName]: csrfHash
    },
    success: function (response) {
      var data = $.parseJSON(response);
      $('#edit-area').empty();
      if (default_language === 1)
        var o = new Option("حدد المنطقة", "");
      else
        var o = new Option("Select Area", "");
      $("#edit-area").append(o);
      if (data["status"] == "1") {
        $(data["data"]).each(function () {
          if (default_language == 1)
            var o = new Option(this.name_ar, this.id);
          else
            var o = new Option(this.name, this.id);
          $("#edit-area").append(o);
        });
      } else {
        // successmsg(data["msg"]);
      }
    }
  });
}

const validateAddressForm = () => {
  var fullname_a = document.querySelector("#fullname_a");
  var email = document.querySelector("#email");
  var mobile = document.querySelector("#mobile");
  var fulladdress = document.querySelector("#fulladdress");
  var country = document.querySelector("#country");
  var region = document.querySelector("#region");
  var governorates = document.querySelector("#governorates");
  var area = document.querySelector("#area");

  var flag_fullname_a = 0;
  var flag_email = 0;
  var flag_mobile = 0;
  var flag_fulladdress = 0;
  var flag_country = 0;
  var flag_region = 0;
  var flag_governorates = 0;
  var flag_area = 0;

  if (fullname_a.value == '') {
    flag_fullname_a = 0;
    setErrorMsg(fullname_a, '<i class="fa-solid fa-circle-xmark"></i> Full name is required.');
  } else {
    flag_fullname_a = 1;
    setSuccessMsg(fullname_a);
  }
  if (email.value == '') {
    flag_email = 0;
    setErrorMsg(email, '<i class="fa-solid fa-circle-xmark"></i> Email is required.');
  } else {
    flag_email = 1;
    setSuccessMsg(email);
  }
  if (mobile.value == '') {
    flag_mobile = 0;
    setInTelErrorMsg(mobile, '<i class="fa-solid fa-circle-xmark"></i> Mobile is required.');
  } else {
    flag_mobile = 1;
    setInTelSuccessMsg(mobile);
  }
  if (fulladdress.value == '') {
    flag_fulladdress = 0;
    setErrorMsg(fulladdress, '<i class="fa-solid fa-circle-xmark"></i> Address is required.');
  } else {
    flag_fulladdress = 1;
    setSuccessMsg(fulladdress);
  }
  if (country.value == '') {
    flag_country = 0;
    setSelectErrorMsg(country, '<i class="fa-solid fa-circle-xmark"></i> Country is required.');
  } else {
    flag_country = 1;
    setSelectSuccessMsg(country);
  }
  if (region.tagName === "SELECT") {
    if (region.value == '') {
      flag_region = 0;
      setSelectErrorMsg(region, '<i class="fa-solid fa-circle-xmark"></i> Region is required.');
    } else {
      flag_region = 1;
      setSelectSuccessMsg(region);
    }
  } else {
    if (region.value == '') {
      flag_region = 0;
      setErrorMsg(region, '<i class="fa-solid fa-circle-xmark"></i> Region is required.');
    } else {
      flag_region = 1;
      setSuccessMsg(region);
    }
  }
  if (governorates.tagName === "SELECT") {
    if (governorates.value == '') {
      flag_governorates = 0;
      setSelectErrorMsg(governorates, '<i class="fa-solid fa-circle-xmark"></i> Governorates is required.');
    } else {
      flag_governorates = 1;
      setSelectSuccessMsg(governorates);
    }
  } else {
    if (governorates.value == '') {
      flag_governorates = 0;
      setErrorMsg(governorates, '<i class="fa-solid fa-circle-xmark"></i> Governorates is required.');
    } else {
      flag_governorates = 1;
      setSuccessMsg(governorates);
    }
  }
  if (area.tagName === "SELECT") {
    if (area.value == '') {
      flag_area = 0;
      setSelectErrorMsg(area, '<i class="fa-solid fa-circle-xmark"></i> Area is required.');
    } else {
      flag_area = 1;
      setSelectSuccessMsg(area);
    }
  } else {
    if (area.value == '') {
      flag_area = 0;
      setErrorMsg(area, '<i class="fa-solid fa-circle-xmark"></i> Area is required.');
    } else {
      flag_area = 1;
      setSuccessMsg(area);
    }
  }

  if (flag_fullname_a === 1 && flag_email === 1 && flag_mobile === 1 && flag_fulladdress === 1 && flag_country === 1 && flag_region === 1 && flag_governorates === 1 && flag_area === 1) {
    return true;
  } else if (flag_fullname_a === 0 && flag_email === 0 && flag_mobile === 0 && flag_fulladdress === 0 && flag_country === 0 && flag_region === 0 && flag_governorates === 0 && flag_area === 0) {
    nativeToast({
      message: default_language == 1 ? 'الرجاء تحديد أو إضافة العنوان!' : 'Please select or add address!',
      position: 'top',
      type: 'error',
      square: true,
      edge: false,
      debug: false
    });
    return false;
  } else {
    return false;
  }
}

const validateEditAddressForm = () => {
  var fullname_a = document.querySelector("#edit-fullname");
  var email = document.querySelector("#edit-email");
  var mobile = document.querySelector("#edit-mobile");
  var fulladdress = document.querySelector("#edit-address");
  var country = document.querySelector("#edit-country");
  var region = document.querySelector("#edit-region");
  var governorates = document.querySelector("#edit-governorates");
  var area = document.querySelector("#edit-area");

  var flag_fullname_a = 0;
  var flag_email = 0;
  var flag_mobile = 0;
  var flag_fulladdress = 0;
  var flag_country = 0;
  var flag_region = 0;
  var flag_governorates = 0;
  var flag_area = 0;

  if (fullname_a.value == '') {
    flag_fullname_a = 0;
    setErrorMsg(fullname_a, '<i class="fa-solid fa-circle-xmark"></i> Full name is required.');
  } else {
    flag_fullname_a = 1;
    setSuccessMsg(fullname_a);
  }
  if (email.value == '') {
    flag_email = 0;
    setErrorMsg(email, '<i class="fa-solid fa-circle-xmark"></i> Email is required.');
  } else {
    flag_email = 1;
    setSuccessMsg(email);
  }
  if (mobile.value == '') {
    flag_mobile = 0;
    setInTelErrorMsg(mobile, '<i class="fa-solid fa-circle-xmark"></i> Mobile is required.');
  } else {
    flag_mobile = 1;
    setInTelSuccessMsg(mobile);
  }
  if (fulladdress.value == '') {
    flag_fulladdress = 0;
    setErrorMsg(fulladdress, '<i class="fa-solid fa-circle-xmark"></i> Address is required.');
  } else {
    flag_fulladdress = 1;
    setSuccessMsg(fulladdress);
  }
  if (country.value == '') {
    flag_country = 0;
    setSelectErrorMsg(country, '<i class="fa-solid fa-circle-xmark"></i> Country is required.');
  } else {
    flag_country = 1;
    setSelectSuccessMsg(country);
  }
  if (region.tagName === "SELECT") {
    if (region.value == '') {
      flag_region = 0;
      setSelectErrorMsg(region, '<i class="fa-solid fa-circle-xmark"></i> Region is required.');
    } else {
      flag_region = 1;
      setSelectSuccessMsg(region);
    }
  } else {
    if (region.value == '') {
      flag_region = 0;
      setErrorMsg(region, '<i class="fa-solid fa-circle-xmark"></i> Region is required.');
    } else {
      flag_region = 1;
      setSuccessMsg(region);
    }
  }
  if (governorates.tagName === "SELECT") {
    if (governorates.value == '') {
      flag_governorates = 0;
      setSelectErrorMsg(governorates, '<i class="fa-solid fa-circle-xmark"></i> Governorates is required.');
    } else {
      flag_governorates = 1;
      setSelectSuccessMsg(governorates);
    }
  } else {
    if (governorates.value == '') {
      flag_governorates = 0;
      setErrorMsg(governorates, '<i class="fa-solid fa-circle-xmark"></i> Governorates is required.');
    } else {
      flag_governorates = 1;
      setSuccessMsg(governorates);
    }
  }
  if (area.tagName === "SELECT") {
    if (area.value == '') {
      flag_area = 0;
      setSelectErrorMsg(area, '<i class="fa-solid fa-circle-xmark"></i> Area is required.');
    } else {
      flag_area = 1;
      setSelectSuccessMsg(area);
    }
  } else {
    if (area.value == '') {
      flag_area = 0;
      setErrorMsg(area, '<i class="fa-solid fa-circle-xmark"></i> Area is required.');
    } else {
      flag_area = 1;
      setSuccessMsg(area);
    }
  }

  if (flag_fullname_a === 1 && flag_email === 1 && flag_mobile === 1 && flag_fulladdress === 1 && flag_country === 1 && flag_region === 1 && flag_governorates === 1 && flag_area === 1) {
    return true;
  } else if (flag_fullname_a === 0 && flag_email === 0 && flag_mobile === 0 && flag_fulladdress === 0 && flag_country === 0 && flag_region === 0 && flag_governorates === 0 && flag_area === 0) {
    nativeToast({
      message: default_language == 1 ? 'الرجاء تحديد أو إضافة العنوان!' : 'Please select or add address!',
      position: 'top',
      type: 'error',
      square: true,
      edge: false,
      debug: false
    });
    return false;
  } else {
    return false;
  }
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
