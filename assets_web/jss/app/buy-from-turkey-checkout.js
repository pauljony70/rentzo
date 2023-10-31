$(document).ready(function () {
    // Get all the image checkboxes
    var $selectAllCheckBox = $('#flexCheckChecked');
    var $imageCheckboxes = $('.checkbox-input');
    var $selectedCheckbox = $('#selected-item')

    $selectAllCheckBox.on('change', function () {
        if ($(this).prop('checked')) {
            $imageCheckboxes.prop('checked', true);
        } else {
            $imageCheckboxes.prop('checked', false);
        }
        $selectedCheckbox.text($imageCheckboxes.filter(':checked').length);
        getSelectedItemPrice();
    });

    $imageCheckboxes.on('change', function () {
        var allChecked = true;
        var anyChecked = false;
        $imageCheckboxes.each(function () {
            if ($(this).prop('checked')) {
                anyChecked = true;
            } else {
                allChecked = false;
            }
        });
        if (allChecked) {
            $selectAllCheckBox.prop('checked', true);
            $selectAllCheckBox.prop('indeterminate', false);
        } else if (anyChecked) {
            $selectAllCheckBox.prop('checked', false);
            $selectAllCheckBox.prop('indeterminate', true);
        } else {
            $selectAllCheckBox.prop('checked', false);
            $selectAllCheckBox.prop('indeterminate', false);
        }
        $selectedCheckbox.text($imageCheckboxes.filter(':checked').length);
        getSelectedItemPrice();
    });

    $("#address_div_id").click(function () {
        event.preventDefault();
        var user_id = $('#user_id').val();
        if (user_id == '') {
            $("#address_div").toggle();
        } else {
            $("#address_div").toggle();
        }
    });

    $('#country').on('change', function () {
        getCitydata(this.value);
    });
});

var checkboxInputs = document.querySelectorAll('.checkbox-input');
// Filter the checked checkboxes

const getSelectedItemPrice = () => {
    var prod_price = 0;
    var shipping = 0;
    var adminProfit = 0;
    var igst = 0;
    var checkedCheckboxes = Array.from(checkboxInputs).filter(function (checkbox) {
        return checkbox.checked;
    });
    checkedCheckboxes.forEach(checkbox => {
        var parentElement = checkbox.parentElement.parentElement.parentElement.parentElement;
        prod_price += convertToFloat(parentElement.querySelector('#prod_price').innerText);
        shipping += convertToFloat(parentElement.querySelector('#shipping').innerText);
        adminProfit += convertToFloat(parentElement.querySelector('#admin-profit').innerText);
        igst += convertToFloat(parentElement.querySelector('#igst').innerText);
    });
    document.querySelector('#total_val').innerText = priceFormat(prod_price + shipping + adminProfit + igst);
    document.querySelector('#selected-item-price').innerText = priceFormat(prod_price + shipping + adminProfit + igst);
    document.querySelector('#payable_prod_price').innerText = priceFormat(prod_price);
    document.querySelector('#payable_platform_fee').innerText = priceFormat(adminProfit);
    document.querySelector('#payable_shipping').innerText = priceFormat(shipping);
    document.querySelector('#payable_vat').innerText = priceFormat(igst);
    enablePlaceOrderBtn();
}

const enablePlaceOrderBtn = () => {
    if ($('.checkbox-input').filter(':checked').length > 0) {
        $('#online_place_order_btn').prop('disabled', false);
    } else {
        $('#online_place_order_btn').prop('disabled', true);
    }
}

var infoIcons = document.querySelectorAll('.info-icon');
var hoverCards = document.querySelectorAll('.hover-card');
var activeIconIndex = -1;

infoIcons.forEach(function (shareIcon, index) {
    shareIcon.addEventListener('click', function (event) {
        event.stopPropagation();
        if (activeIconIndex !== -1 && activeIconIndex !== index) {
            infoIcons[activeIconIndex].classList.remove('active');
            hoverCards[activeIconIndex].style.display = 'none';
        }
        if (activeIconIndex === index) {
            activeIconIndex = index;
        } else {
            activeIconIndex = index;
            shareIcon.classList.add('active');
            hoverCards[index].style.display = 'block';
        }
    });
});

document.addEventListener('click', function (event) {
    var target = event.target;
    var isInsideElement = false;
    infoIcons.forEach(function (shareIcon) {
        if (target === shareIcon || shareIcon.contains(target)) {
            isInsideElement = true;
        }
    });
    if (!isInsideElement && activeIconIndex !== -1) {
        infoIcons[activeIconIndex].classList.remove('active');
        hoverCards[activeIconIndex].style.display = 'none';
        activeIconIndex = -1;
    }
});

const online_place_order_btn = document.querySelector('#online_place_order_btn');

online_place_order_btn.addEventListener('click', () => {
    var buttonInnerHTML = online_place_order_btn.innerHTML;
    online_place_order_btn.disabled = true;
    buttonLoaderPrimary(online_place_order_btn);
    if (validateAddressForm()) {
        const orderIds = [];
        var checkedCheckboxes = Array.from(checkboxInputs).filter(function (checkbox) {
            return checkbox.checked;
        });
        var fullname_a = $("#fullname_a").val();
        var email = $("#email").val();
        var mobile = $("#mobile").val();
        var area = $("#area").val();
        var fulladdress = $("#fulladdress").val();
        var country = $("#country").val();
        var region = $("#region").val();
        var city = $("#city").val();
        var governorates = $("#governorates").val();
        checkedCheckboxes.forEach(checkedBox => {
            orderIds.push(checkedBox.parentElement.parentElement.parentElement.parentElement.querySelector('#order-id').innerText);
        });
        $.ajax({
            method: "post",
            url: site_url + "place-other-country-order",
            data: {
                language: default_language,
                order_ids: orderIds,
                fullname: fullname_a,
                email: email,
                mobile: mobile,
                area: area,
                fulladdress: fulladdress,
                country: 1,
                region: 1,
                city: 1,
                governorates: 1,
                [csrfName]: csrfHash
            },
            success: function (response) {
                if (response.status) {
                    location.href = site_url + "thankyou";
                } else {
                    online_place_order_btn.disabled = false;
                    online_place_order_btn.innerHTML = buttonInnerHTML;
                    Swal.fire({
                        title: 'FAILED',
                        text: response.msg,
                        type: "error",
                        confirmButtonColor: '#ff6600',
                        showCloseButton: true
                    }).then((res) => {
                        location.reload();
                    });;
                }
            },
        });
    } else {
        setTimeout(() => {
            online_place_order_btn.disabled = false;
            online_place_order_btn.innerHTML = buttonInnerHTML;
        }, 500);
    }
});