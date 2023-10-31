var code_ajax = $("#code_ajax").val();


var imagejson = [];
var attrjson = [];
var notiimage = "";
var categorylistvisible = false;
$(document).ready(function() {
    var id = 1;
    getSellerGroupdata();
    getcountrydata();
});

function getcountrydata() {
    //   successmsg("prod id "+item );
    $.ajax({
        method: 'POST',
        url: 'get_country.php',
        data: {
            code: code_ajax
        },
        success: function(response) {
            // successmsg(response); // display response from the PHP script, if any
            var data = $.parseJSON(response);
            $('#selectcountry').empty();
            $('#selectstate').empty();
            $('#selectcity').empty();
            //                    .append('<option selected="selected" value="whatever">text</option>') ;    

            if (data["status"] == "1") {
                $getstate = true;
                $(data["data"]).each(function() {
                    //	successmsg(this.name);
                    var o = new Option(this.name, this.id);
                    $("#selectcountry").append(o);
                    if ($getstate == true) {
                        $getstate = false;
                        getStatedata(this.id);
                    }
                });

            } else {
                successmsg(data["msg"]);
            }
        }
    });

    $('#selectcountry').on('change', function() {
        //successmsg("cahnge"+ this.value );
        getStatedata(this.value);
    });
}

function getStatedata(countryid) {
    //   successmsg("prod id "+item );
    $.ajax({
        method: 'POST',
        url: 'get_state.php',
        data: {
            code: code_ajax,
            countryid: countryid
        },
        success: function(response) {
            // successmsg(response); // display response from the PHP script, if any
            var data = $.parseJSON(response);
            $('#selectstate').empty();
            $('#selectcity').empty();
            //                      .append('<option selected="selected" value="blank">Select</option>') ;    

            if (data["status"] == "1") {
                $getcity = true;
                $(data["data"]).each(function() {
                    //	successmsg(this.name);
                    var o = new Option(this.name, this.id);
                    $("#selectstate").append(o);
                    if ($getcity == true) {
                        $getcity = false;
                        getCitydata(this.id);
                    }
                });

            } else {
                successmsg(data["msg"]);
            }
        }
    });


    $('#selectstate').on('change', function() {
        //successmsg("cahnge"+ this.value );
        getCitydata(this.value);
    });
}


function getCitydata(stateid) {
    // successmsg("state id "+stateid );
    $.ajax({
        method: 'POST',
        url: 'get_city.php',
        data: {
            code: code_ajax,
            stateid: stateid
        },
        success: function(response) {
            // successmsg(response); // display response from the PHP script, if any
            var data = $.parseJSON(response);
            $('#selectcity').empty();
            //                      .append('<option selected="selected" value="blank">Select</option>') ;    

            if (data["status"] == "1") {

                $(data["data"]).each(function() {
                    //	successmsg(this.name);
                    var o = new Option(this.name, this.id);
                    $("#selectcity").append(o);
                });

            } else {
                successmsg(data["msg"]);
            }
        }
    });
}

function getSellerGroupdata() {
    // successmsg("state id "+stateid );
    $.ajax({
        method: 'POST',
        url: 'get_sellergroup.php',
        data: {
            code: code_ajax
        },
        success: function(response) {
            // successmsg(response); // display response from the PHP script, if any
            var data = $.parseJSON(response);
            $('#sellergroup').empty();
            //                      .append('<option selected="selected" value="blank">Select</option>') ;    

            if (data["status"] == "1") {

                $(data["data"]).each(function() {
                    //	successmsg(this.name);
                    var o = new Option(this.name, this.id);
                    $("#sellergroup").append(o);
                });

            } else {
                successmsg(data["msg"]);
            }
        }
    });
}




$(document).ready(function() {
    $("#add_seller_btn").click(function(event) {
        event.preventDefault();


        var seller_namevalue = $('#seller_name').val();
        var company_namevalue = $('#business_name').val();
        var business_addressvalue = $('#business_address').val();
        var business_detailsvalue = $('#business_details').val();
        var pincodevalue = $('#pincode').val();
        var phonevalue = $('#phone').val();
        var emailvalue = $('#email').val();
        var websitevalue = $('#website').val();
        var gstvalue = $('#gst').val();
        var passwords = $('#password').val();

        var grp = document.getElementById("sellergroup");
        var sellergroupvalue = grp.options[grp.selectedIndex].value;

        var ctr = document.getElementById("selectcountry");
        var countryvalue = ctr.options[ctr.selectedIndex].value;

        var stt = document.getElementById("selectstate");
        var statevalue = stt.options[stt.selectedIndex].value;

        var ct = document.getElementById("selectcity");
        var cityvalue = ct.options[ct.selectedIndex].value;



        var count = 1;
        //  successmsg( prod_shortvalue + " -- "+prod_detailsvalue );
        if (seller_namevalue == "" || seller_namevalue == null) {
            successmsg("Seller name is empty");
        } else if (company_namevalue == "" || company_namevalue == null) {
            successmsg("Business/ Company name is empty");
        } else if (sellergroupvalue == "blank") {
            successmsg("Please select seller type");
        } else if (business_addressvalue == "" || business_addressvalue == null) {
            successmsg("Business address is empty");
        } else if (business_detailsvalue == "" || business_detailsvalue == null) {
            successmsg("Business description is empty");
        } else if (countryvalue == "blank") {

            successmsg("Please select Country");
        } else if (statevalue == "blank") {

            successmsg("Please select state");
        } else if (cityvalue == "blank") {

            successmsg("Please select city");
        } else if (pincodevalue == "" || pincodevalue == null) {

            successmsg("Pincode is empty");
        } else if (phonevalue == "" || phonevalue == null) {

            successmsg("Phone number is empty");
        } else if (emailvalue == "" || emailvalue == null) {

            successmsg("Email id is empty");
        }else if (validate_email(emailvalue) == 'invalid') {

            successmsg("Email id is invalid");
        } else if (passwords == "" || passwords == null) {

            successmsg("Password is empty");
        }else if(strong_check_password(passwords) == 'fail'){
			successmsg("Password Must contain 5 characters or more,lowercase and uppercase characters and contains digits.");
		} else {
            showloader();
            var file_data = $('#seller_logo').prop('files')[0];
            var form_data = new FormData();
            form_data.append('seller_logo', file_data);
            form_data.append('seller_namevalue', seller_namevalue);
            form_data.append('company_namevalue', company_namevalue);
            form_data.append('sellergroupvalue', sellergroupvalue);
            form_data.append('business_addressvalue', business_addressvalue);
            form_data.append('business_detailsvalue', business_detailsvalue);
            form_data.append('countryvalue', countryvalue);
            form_data.append('statevalue', statevalue);
            form_data.append('cityvalue', cityvalue);
            form_data.append('pincodevalue', pincodevalue);
            form_data.append('phonevalue', phonevalue);
            form_data.append('emailvalue', emailvalue);
            form_data.append('websitevalue', websitevalue);
            form_data.append('gstvalue', gstvalue);
            form_data.append('passwords', passwords);

            form_data.append('code', code_ajax);
            $.ajax({
                method: 'POST',
                url: 'add_seller_process.php',
                data: form_data,
                contentType: false,
                processData: false,
                success: function(response) {
                    hideloader();
                    if (response == 'Added') {
                        successmsg("Seller Added Successfully.");
                        location.href = "seller.php";
                    } else {
                        successmsg(response);
                    }
                }
            });
        }
    });

});
