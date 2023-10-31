var code_ajax = $("#code_ajax").val();

$(document).ready(function () {
    gettaxclass();
});

function gettaxclass() {
    $.ajax({
        method: 'POST',
        url: 'get_tax_class.php',
        data: {
            code: code_ajax
        },
        success: function (response) {
            //  successmsg(response); // display response from the PHP script, if any
            var data = $.parseJSON(response);
            $('#selecttaxclass').empty();
            //                    .append('<option selected="selected" value="whatever">text</option>') ;    
            if (data["status"] == "1") {
                $(data["data"]).each(function () {
                    //	successmsg(this.name);
                    var o = new Option(this.name, (this.name).replace(/%/g, ''));
                    $("#selecttaxclass").append(o);
                });

            } else {
                successmsg(data["msg"]);
            }
        }
    });

}

// Price Calculator
document.querySelector('#total_price').addEventListener('input', () => {
    document.querySelector('#product_price').innerText = document.querySelector('#total_price').value;
    var taxValue = document.getElementById('selecttaxclass').options[document.getElementById('selecttaxclass').selectedIndex].text.match(/\d+/)[0];
    document.querySelector('#total-tax').innerText = (document.querySelector('#total_price').value * (taxValue / 100)).toFixed(2);
    calculatePayableAmount();
});

document.querySelector('#service_charge').addEventListener('input', () => {
    document.querySelector('#commision_fee').innerText = document.querySelector('#service_charge').value;
    var taxValue = document.getElementById('selecttaxclass').options[document.getElementById('selecttaxclass').selectedIndex].text.match(/\d+/)[0];
    document.querySelector('#total-tax').innerText = (document.querySelector('#total_price').value * (taxValue / 100)).toFixed(2);
    calculatePayableAmount();
});

document.querySelector('#shipping_charge').addEventListener('input', () => {
    document.querySelector('#shipping_fee').innerText = document.querySelector('#shipping_charge').value;
    var taxValue = document.getElementById('selecttaxclass').options[document.getElementById('selecttaxclass').selectedIndex].text.match(/\d+/)[0];
    document.querySelector('#total-tax').innerText = (document.querySelector('#total_price').value * (taxValue / 100)).toFixed(2);
    calculatePayableAmount();
});

document.querySelector('#selecttaxclass').addEventListener('change', () => {
    var taxValue = document.getElementById('selecttaxclass').options[document.getElementById('selecttaxclass').selectedIndex].text.match(/\d+/)[0];
    document.querySelector('#total-tax').innerText = (document.querySelector('#total_price').value * (taxValue / 100)).toFixed(2);
    calculatePayableAmount();
});

const calculatePayableAmount = () => {
    var taxValue = document.getElementById('selecttaxclass').options[document.getElementById('selecttaxclass').selectedIndex].text.match(/\d+/);
    var prod_price = document.querySelector('#total_price').value;
    var commision_fee = document.querySelector('#service_charge').value;
    var shipping = document.querySelector('#shipping_charge').value;

    // Set taxValue to 0 if it's blank or not a valid number
    taxValue = taxValue ? parseFloat(taxValue[0]) / 100 : 0;

    // Set other variables to 0 if they are blank or not valid numbers
    prod_price = parseFloat(prod_price) || 0;
    commision_fee = parseFloat(commision_fee) || 0;
    shipping = parseFloat(shipping) || 0;

    var tax_value = prod_price * taxValue;
    var totalPayableAmount = prod_price + commision_fee + shipping + tax_value;

    document.querySelector('#total-payable-amount').innerText = totalPayableAmount.toFixed(2);
}

$('#myform').parsley();

