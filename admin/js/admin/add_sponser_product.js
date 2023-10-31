var code_ajax = $("#code_ajax").val();


var imagejson = [];
var attrjson = [];
var notiimage = "";
var categorylistvisible = false;
$(document).ready(function () {
    // successmsg("ready call");

    getsellername();

    // multi select with checkbox
    // $('#example-getting-started').multiselect();
    $('#selectcategory').multiselect({
        columns: 1,
        search: true,
        selectAll: false,
        texts: {
            placeholder: 'Select Category (Max 5)',
            search: 'Search Category'
        },
        onOptionClick: function (element, option) {
            var maxSelect = 5;

            // too many selected, deselect this option
            if ($(element).val().length > maxSelect) {
                if ($(option).is(':checked')) {
                    var thisVals = $(element).val();

                    thisVals.splice(
                        thisVals.indexOf($(option).val()), 1
                    );

                    $(element).val(thisVals);

                    $(option).prop('checked', false).closest('li')
                        .toggleClass('selected');
                }
            }
            // max select reached, disable non-checked checkboxes
            else if ($(element).val().length == maxSelect) {
                $(element).next('.ms-options-wrap')
                    .find('li:not(.selected)').addClass('disabled')
                    .find('input[type="checkbox"]')
                    .attr('disabled', 'disabled');
            }
            // max select not reached, make sure any disabled
            // checkboxes are available
            else {
                $(element).next('.ms-options-wrap')
                    .find('li.disabled').removeClass('disabled')
                    .find('input[type="checkbox"]')
                    .removeAttr('disabled');
            }
        }

    });

    $('#selectproduct').multiselect({
        columns: 3,
        search: true,
        selectAll: false,
        texts: {
            placeholder: 'Select Product Sponsor',
            search: 'Search Product Sponsor'
        },
        onOptionClick: function (element, option) {
            var maxSelect = 100;
            if ($(element).val()) {
                // too many selected, deselect this option
                if ($(element).val().length > maxSelect) {
                    if ($(option).is(':checked')) {
                        var thisVals = $(element).val();

                        thisVals.splice(
                            thisVals.indexOf($(option).val()), 1
                        );

                        $(element).val(thisVals);

                        $(option).prop('checked', false).closest('li')
                            .toggleClass('selected');
                    }
                }
                // max select reached, disable non-checked checkboxes
                else if ($(element).val().length == maxSelect) {
                    $(element).next('.ms-options-wrap')
                        .find('li:not(.selected)').addClass('disabled')
                        .find('input[type="checkbox"]')
                        .attr('disabled', 'disabled');
                }
                // max select not reached, make sure any disabled
                // checkboxes are available
                else {
                    $(element).next('.ms-options-wrap')
                        .find('li.disabled').removeClass('disabled')
                        .find('input[type="checkbox"]')
                        .removeAttr('disabled');
                }
            }
        }

    });




    $('#selectupsell').multiselect({
        columns: 3,
        search: true,
        selectAll: false,
        texts: {
            placeholder: 'Select Product (Max 10)',
            search: 'Search Product'
        },
        onOptionClick: function (element, option) {
            var maxSelect = 10;
            if ($(element).val()) {
                // too many selected, deselect this option
                if ($(element).val().length > maxSelect) {
                    if ($(option).is(':checked')) {
                        var thisVals = $(element).val();

                        thisVals.splice(
                            thisVals.indexOf($(option).val()), 1
                        );

                        $(element).val(thisVals);

                        $(option).prop('checked', false).closest('li')
                            .toggleClass('selected');
                    }
                }
                // max select reached, disable non-checked checkboxes
                else if ($(element).val().length == maxSelect) {
                    $(element).next('.ms-options-wrap')
                        .find('li:not(.selected)').addClass('disabled')
                        .find('input[type="checkbox"]')
                        .attr('disabled', 'disabled');
                }
                // max select not reached, make sure any disabled
                // checkboxes are available
                else {
                    $(element).next('.ms-options-wrap')
                        .find('li.disabled').removeClass('disabled')
                        .find('input[type="checkbox"]')
                        .removeAttr('disabled');
                }
            }
        }

    });



    // multi select with checkbox close



    var id = 1;
    var high = "11";
    $("#moreImg").click(function () {
        var showId = ++id;
        if (showId <= high) {
            $(".input-files").append('<div id="more_img' + showId + '"><br><input type="file" id="prod_img' + showId + '"  onchange=uploadFile1("prod_img' + showId + '")  name="product_image[]" style="float:left; display: inline-block; margin-right:20px;"> </input> ' +
                '<a class="btn btn-sm btn-danger" onclick=removeImage("more_img' + showId + '"); return false;" style="float:left; display: inline-block; margin-right:20px;">Remove</a> <br></div>');
        }
    });


});

function saveInfo(element) {
    //var file_data = $('#'+element).prop('files')[0]; 
    var count = Number(element) + 100; var stockcount = Number(element) + 200; var mrpcount = Number(element) + 300;
    var attrvalue = $('#' + count).val();
    var attrname = $('#' + element).val();
    var attrstockvalue = $('#' + stockcount).val();
    var attrmrpvalue = $('#' + mrpcount).val();

    attrjson.push({
        "attrnam": attrname,
        "attrvalue": attrvalue,
        "attrstockvalue": attrstockvalue,
        "attrmrpvalue": attrmrpvalue
    });

    //  successmsg("save "+ attrname +" -- "+ attrvalue + "-- "+attrjson.length+ "--"+JSON.stringify(attrjson));
    $('#' + count).prop("disabled", true);
    $('#' + element).prop("disabled", true);
    $('#' + stockcount).prop("disabled", true);
    $('#' + mrpcount).prop("disabled", true);
}

function removeInfo(element) {
    //var file_data = $('#'+element).prop('files')[0]; 
    var count = Number(element) + 100; var stockcount = Number(element) + 200; var mrpcount = Number(element) + 300;
    var attrvalue = $('#' + count).val();
    var attrname = $('#' + element).val();

    //  successmsg("sdfsdf  -- "+attrjson.length); 
    var parsedJSON = attrjson;
    //  successmsg("before " +parsedJSON);                                        

    for (var i = 0; i < parsedJSON.length; i++) {
        var counter = parsedJSON[i];
        // var name = counter.url;
        if (counter.attrnam.includes(attrname)) {
            //successmsg("remove it " +parsedJSON[i]);
            //delete parsedJSON[i];
            parsedJSON.splice(i, 1);

        }
        //  successmsg( parsedJSON);
    }


    $('#' + count).prop("disabled", false);
    $('#' + element).prop("disabled", false);
    $('#' + stockcount).prop("disabled", false);
    $('#' + mrpcount).prop("disabled", false);

    $('#' + element).val('');
    $('#' + count).val('');
    $('#' + stockcount).val('');
    $('#' + mrpcount).val('');

}

function removeImage(element) {
    $("#" + element).remove();
}


function getsellername() {
    $.ajax({
        method: 'POST',
        url: 'get_seller_active.php',
        data: {
            code: code_ajax
        },
        success: function (response) {
            // successmsg(response); // display response from the PHP script, if any
            var data = $.parseJSON(response);
            $('#selectseller').empty();
            //  .append('<option selected="selected" value="blank"></option>') ;    
            var o = new Option("Select", "");
            $("#selectseller").append(o);
            if (data["status"] == "1") {
                $(data["data"]).each(function () {
                    //	successmsg(this.name);
                    var o = new Option(this.companyname, this.id);
                    $("#selectseller").append(o);
                });

            } else {
                successmsg(data["msg"]);
            }
        }
    });

}



function get_seller_related_product() {
    var selectseller = $("#selectseller").val();
    getralatedprod(selectseller);
    getupsellprod(selectseller);
}

function getralatedprod(selectseller) {
    $.ajax({
        method: 'POST',
        url: 'get_product_related.php',
        data: {
            code: code_ajax, selectseller: selectseller
        },
        success: function (response) {
            // successmsg(" realted "+response); // display response from the PHP script, if any
            var data = $.parseJSON(response);
            $('#selectproduct').empty();
            if (data["status"] == "1") {

                $(data["data"]).each(function () {
                    //	successmsg(this.name);
                    var o = new Option(this.name, this.id);
                    $("#selectproduct").append(o);
                });

                $("#selectproduct").multiselect('reload');
                // $("#selectrelatedprod").multiselect('rebuild');

            } else {
                //successmsg(data["msg"]);
            }
        }
    });

}

function getupsellprod(selectseller) {
    $.ajax({
        method: 'POST',
        url: 'get_product_upsell.php',
        data: {
            code: code_ajax, selectseller: selectseller
        },
        success: function (response) {
            // successmsg(" realted "+response); // display response from the PHP script, if any
            var data = $.parseJSON(response);
            $('#selectupsell').empty();
            if (data["status"] == "1") {

                $(data["data"]).each(function () {
                    //	successmsg(this.name);
                    var o = new Option(this.name, this.id);
                    $("#selectupsell").append(o);
                });

                $("#selectupsell").multiselect('reload');
                // $("#selectrelatedprod").multiselect('rebuild');

            } else {
                //  successmsg(data["msg"]);
            }
        }
    });

}




function check_category_limit(view) {
    if ($('.check_category_limit:checkbox:checked').length > 5) {
        view.checked = false;
        successmsg("Category Selection Limit 5");
        //$('.check_category_limit').attr('disabled','disabled');
    }
}




$(document).ready(function () {


    $("#skip_sale_price").click(function (event) {
        var prod_mrp = $("#prod_mrp").val();
        var prod_price = $("#prod_price").val();

        if (!prod_mrp) {
            successmsg("Please enter Product MRP");
            $("#skip_sale_price").prop("checked", false);
            $("#prod_mrp").focus();
            $("#prod_price").focus();
        } else if (!prod_price) {
            successmsg("Please enter Product Sale Price");
            $("#skip_sale_price").prop("checked", false);
        } else if ($("#skip_sale_price").prop('checked') == true) {

            $(".sale_prices").val(prod_price);
            $(".mrp_price").val(prod_mrp);
            $(".sale_prices").attr('readonly', 'readonly');
            $(".mrp_price").attr('readonly', 'readonly');
        } else {
            $(".sale_prices").removeAttr('readonly', 'readonly');
            $(".mrp_price").removeAttr('readonly', 'readonly');
        }

    });

    if ($("#editor").length > 0) {
        tinymce.init({
            selector: "textarea#editor",
            theme: "modern",
            height: 300,
            plugins: [
                "advlist lists print",
                //  "wordcount code fullscreen",
                "save table directionality emoticons paste textcolor"
            ],
            toolbar: " undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",

        });
    }
    if ($("#prod_short").length > 0) {
        tinymce.init({
            selector: "textarea#prod_short",
            theme: "modern",
            height: 300,
            plugins: [
                "advlist lists print",
                //  "wordcount code fullscreen",
                "save table directionality emoticons paste textcolor"
            ],
            toolbar: " undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",

        });
    }

})

