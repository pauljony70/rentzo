var code_ajax = $("#code_ajax").val();


var imagejson = [];
var attrjson = [];
var notiimage = "";
var categorylistvisible = false;
$(document).ready(function () {
    // successmsg("ready call");
    getattributeset();
    gettaxclass();
    getvisibility();
    getcountry();

    getbrand();
    gethsncode();

    getreturn_policy();
    get_seller_related_product();

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

    $('#selectrelatedprod').multiselect({
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
    var high = "21";
    $("#moreImg").click(function () {
        var showId = ++id;
        if (showId <= high) {
            $(".input-files").append('<div class="d-flex align-items-center" id="more_img' + showId + '" style="margin-top:0.90rem"><input type="file" id="prod_img' + showId + '"  onchange=uploadFile1("prod_img' + showId + '")  name="product_image[]" style="float:left; display: inline-block; margin-right:20px;"> </input><div id="image-viewer"></div>' + '<button type="button" class="btn btn-sm btn-danger" onclick=removeImage("more_img' + showId + '"); return false;" style="float:left; display: inline-block; margin-right:20px;">Remove</button></div>');
        }
    });

    $('#selectattrset').change(function () {
        var selectedValue = $(this).val();
        var count = 0;
        $.busyLoadFull("show");

        $.ajax({
            method: 'POST',
            url: 'get_product_info_data.php',
            data: {
                code: code_ajax,
                page: 1,
                rowno: 0,
                attribute_set_id: selectedValue,
                perpage: 100
            },
            success: function (response) {
                $.busyLoadFull("hide");
                var parsedJSON = $.parseJSON(response);
                $("#product_attributes_set_id").empty();

                var data = parsedJSON.data;
                document.getElementById('product_info').innerHTML = '';
                // <input type="text" class="form-control" id="${convertToUnderscore(element.attribute)}" name="product_info_set_val_id[]" placeholder="${element.attribute}"></input>
                if (data !== '') {
                    var html = '';
                    data.forEach(element => {
                        html = '';
                        var selectBoxId = ''
                        html +=
                            `<div class="form-group row align-items-center">
                                <label for="focusedinput" class="col-sm-2 control-label m-0">${element.attribute} </label>
                                <div class="col-sm-8">
                                    <input type="hidden" id="product_info_set_id" name="product_info_set_id[]" value="${element.product_info_set_id}">
                                    <select class="form-control" id="${convertToUnderscore(element.attribute)}" name="product_info_set_val_id_${element.product_info_set_id}[]" multiple>`;
                        element.product_info_set_val_data.forEach(product_info_set_val => {
                            html +=
                                `<option value="${product_info_set_val.product_info_set_value_id}">${product_info_set_val.product_info_set_value}</option>`;
                        });
                        html +=
                            `</select>
                                </div>
                            </div>`;
                        document.getElementById('product_info').innerHTML += html;
                        // selectBoxId = convertToUnderscore(element.attribute);

                    });
                    $('select[multiple]').multiselect({
                        columns: 3,
                        search: true,
                        selectAll: true,
                        texts: {
                            placeholder: 'Select Attribute',
                            search: 'Search Attribute'
                        }
                    });
                    // $("select[multiple]").multiselect('reload');
                    // for (let i = 0; i < data.length + 2; i++) {
                    //     count = i + 1;
                    Array.from(document.getElementsByClassName('ms-options-wrap')).forEach(msOPtionWrap => {
                        msOPtionWrap.classList.add('form-control', 'p-0');
                        msOPtionWrap.getElementsByTagName('button')[0].classList.add('w-100', 'h-100', 'm-0', 'pl-2');
                        msOPtionWrap.getElementsByTagName('span')[0].style.cssText = 'font-size: .875rem; font-weight: 400; line-height: 1.5; color: #6c757d;';
                        msOPtionWrap.getElementsByTagName('button')[0].style.cssText = 'border: 0; border-radius: 5px;';
                    });
                    Array.from(document.getElementsByClassName('ms-options')).forEach(msOPtion => {
                        msOPtion.getElementsByTagName('input')[0].classList.add('form-control');
                    });
                    Array.from(document.getElementsByClassName('ms-selectall global')).forEach(msSelectAll => {
                        msSelectAll.classList.add('btn', 'btn-sm', 'btn-dark', 'waves-effect', 'waves-light');
                    });
                    // }
                }
            }
        });
    });


});

function convertToUnderscore(str) {
    // Remove special characters and replace with underscores
    var underscoredStr = str.replace(/[^a-zA-Z0-9]/g, "_");

    // Remove consecutive underscores
    underscoredStr = underscoredStr.replace(/_+/g, "_");

    // Remove leading and trailing underscores
    underscoredStr = underscoredStr.replace(/^_+|_+$/g, "");

    return underscoredStr;
}

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


$('#selectcity').multiselect({
        columns: 3,
        search: true,
        selectAll: false,
        texts: {
            placeholder: 'Select city (Max 10)',
            search: 'Search city'
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

function getvisibility() {
    $.ajax({
        method: 'POST',
        url: 'get_visibility.php',
        data: {
            code: code_ajax
        },
        success: function (response) {
            //  successmsg(response); // display response from the PHP script, if any
            var data = $.parseJSON(response);
            $('#selectvisibility').empty();
            //                    .append('<option selected="selected" value="whatever">text</option>') ;    
            if (data["status"] == "1") {
                $(data["data"]).each(function () {
                    //	successmsg(this.name);
                    var o = new Option(this.name, this.id);
                    $("#selectvisibility").append(o);
                });

            } else {
                successmsg(data["msg"]);
            }
        }
    });

}

function getcountry() {
    $.ajax({
        method: 'POST',
        url: 'get_country.php',
        data: {
            code: code_ajax
        },
        success: function (response) {
            //  successmsg(response); // display response from the PHP script, if any
            var data = $.parseJSON(response);
            $('#selectcountry').empty();
            //                    .append('<option selected="selected" value="whatever">text</option>') ;    
            if (data["status"] == "1") {
                $(data["data"]).each(function () {
                    //	successmsg(this.name);
                    var o = new Option("(" + this.code + ")  " + this.name, this.id);
                    $("#selectcountry").append(o);
                });

            } else {
                successmsg(data["msg"]);
            }
        }
    });

}

function getcolor() {
    $.ajax({
        method: 'POST',
        url: 'get_color.php',
        data: {
            code: code_ajax
        },
        success: function (response) {
            // successmsg(response); // display response from the PHP script, if any
            var data = $.parseJSON(response);
            $('#selectcolor').empty();
            //  .append('<option selected="selected" value="blank"></option>') ;    
            var o = new Option("", "blank");
            $("#selectcolor").append(o);
            if (data["status"] == "1") {
                $(data["data"]).each(function () {
                    //	successmsg(this.name);
                    var o = new Option(this.name + " (" + this.code + ")", this.id);
                    $("#selectcolor").append(o);
                });

            } else {
                successmsg(data["msg"]);
            }
        }
    });

}

function getsize() {
    $.ajax({
        method: 'POST',
        url: 'get_size.php',
        data: {
            code: code_ajax
        },
        success: function (response) {
            // successmsg(response); // display response from the PHP script, if any
            var data = $.parseJSON(response);
            $('#selectsize').empty();
            //  .append('<option selected="selected" value="blank"></option>') ;    
            var o = new Option("", "blank");
            $("#selectsize").append(o);
            if (data["status"] == "1") {
                $(data["data"]).each(function () {
                    //	successmsg(this.name);
                    var o = new Option(this.name, this.id);
                    $("#selectsize").append(o);
                });

            } else {
                successmsg(data["msg"]);
            }
        }
    });

}

function getbrand() {
    $.ajax({
        method: 'POST',
        url: 'get_brand_data_product.php',
        data: {
            code: code_ajax
        },
        success: function (response) {
            // successmsg(response); // display response from the PHP script, if any
            var data = $.parseJSON(response);
            $('#selectbrand').empty();
            //  .append('<option selected="selected" value="blank"></option>') ;    
            var o = new Option("Select", "");
            $("#selectbrand").append(o);
            if (data["status"] == "1") {
                $(data["data"]).each(function () {
                    //	successmsg(this.name);
                    var o = new Option(this.name, this.id);
                    $("#selectbrand").append(o);
                });

            } else {
                successmsg(data["msg"]);
            }
        }
    });

}

function gethsncode() {
    $.ajax({
        method: 'POST',
        url: 'get_hsncode_data_product.php',
        data: {
            code: code_ajax
        },
        success: function (response) {
            var data = $.parseJSON(response);
            $('#prod_hsn').empty();
            var o = new Option("Select", "");
            $("#prod_hsn").append(o);
            if (data["status"] == "1") {
                $(data["data"]).each(function () {
                    var o = new Option(this.hsn_code, this.hsn_code);
                    $("#prod_hsn").append(o);
                });

            } else {
                successmsg(data["msg"]);
            }
        }
    });

}



function get_seller_related_product() {
    var selectseller = $("#selleer_id").val();
    getralatedprod(selectseller);
    getupsellprod(selectseller);
	getallcity();
}

function getallcity() {
    $.ajax({
        method: 'POST',
        url: 'get_all_city.php',
        data: {
            code: code_ajax
        },
        success: function (response) {
            var data = $.parseJSON(response);
            $('#selectcity').empty();
            if (data["status"] == "1") {

                $(data["data"]).each(function () {
                    //	successmsg(this.name);
                    var o = new Option(this.name, this.id);
                    $("#selectcity").append(o);
                });

                $("#selectcity").multiselect('reload');
                // $("#selectrelatedprod").multiselect('rebuild');

            } else {
                //successmsg(data["msg"]);
            }
        }
    });

}

function getralatedprod(selectseller) {



    var cat_id = $('#select_cat_id').val();
    $.ajax({
        method: 'POST',
        url: 'get_product_related.php',
        data: {
            code: code_ajax, selectseller: selectseller, cat_id: cat_id
        },
        success: function (response) {
            // successmsg(" realted "+response); // display response from the PHP script, if any
            var data = $.parseJSON(response);
            $('#selectrelatedprod').empty();
            if (data["status"] == "1") {

                $(data["data"]).each(function () {
                    //	successmsg(this.name);
                    var o = new Option(this.name, this.id);
                    $("#selectrelatedprod").append(o);
                });

                $("#selectrelatedprod").multiselect('reload');
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
                    var o = new Option(this.name, this.id);
                    $("#selecttaxclass").append(o);
                });

            } else {
                successmsg(data["msg"]);
            }
        }
    });

}

function getattributeset() {
    // successmsg("call");
    $.ajax({
        method: 'POST',
        url: 'get_attribute_set.php',
        data: {
            code: code_ajax
        },
        success: function (response) {
            //  successmsg(response); // display response from the PHP script, if any
            var data = $.parseJSON(response);
            $('#selectattrset').empty();
            var o = new Option("Select", "");
            $("#selectattrset").append(o);
            if (data["status"] == "1") {
                $(data["data"]).each(function () {
                    //	successmsg(this.name);
                    var o = new Option(this.name, this.id);
                    $("#selectattrset").append(o);
                });

            } else {
                successmsg(data["msg"]);
            }
        }
    });

}

function getproduct_attr(counts = '') {
    var selected_attr = '';
    jQuery("#myform_attr").find('select').each(function () {
        var vau = jQuery(this).val();
        if (vau) {
            selected_attr = '';
            // selected_attr += vau + ',';
        }
    });

    $.ajax({
        method: 'POST',
        url: 'get_attributes.php',
        data: {
            code: code_ajax, selected_attr: selected_attr
        },
        success: function (response) {
            var data = $.parseJSON(response);
            // $('#selectattrs' + counts).empty();
            // var o = new Option("Select", "");
            // $("#selectattrs" + counts).append(o);
            if (data["status"] == "1") {
                $("#selectattrs_div").html('')
                $(data["data"]).each(function () {
                    var o = new Option(this.attribute, this.id, this.attribute_value);
                    // $("#selectattrs" + counts).append('<option value="' + this.id + '" attrs="' + this.attribute_value + '">' + this.attribute + '</option>');
                    var html =
                        `<tr>
                            <td>
                                <select class="form-control" id="selectattrs" name="selectattrs[]" required style="float:left; display:inline-block; margin-right:20px; width:140px; appearance:none; -webkit-appearance:none; -moz-appearance:none; pointer-events:none;" readonly>
                                    <option value="${this.id}" attrs="${this.attribute_value}">${this.attribute}</option>
                                </select>
                            </td>
                            <td>
                                <div id="cselectattrs" class="d-flex flex-wrap">
                                    ${select_attr_val(this.id, this.attribute_value, this.attribute)}
                                </div>
                            </td>
                        </tr>`;
                    $("#selectattrs_div").append(html)
                });

            } else {
                $("#selectattrs_div").remove();
                successmsg(data["msg"]);
            }
        }
    });

}

var i = 0;
function add_more_attrs() {
    sel_attr = '0';
    jQuery("#myform_attr").find('select').each(function () {
        var vau = jQuery(this).val();
        if (!vau) {
            successmsg("Please select Attribute");
            sel_attr = '1';

        }

    });
    if (sel_attr != '1') {
        i++;
        var attr_html = '<div class="form-group" id="selectattrs_div' + i + '">	<label for="focusedinput" class="col-sm-2 control-label">Select Attributes</label> <div class="col-sm-9"> ';
        attr_html += '<div class="input-files"> <div style="vertical-align: middle; margin-top:5px;"><select class="form-control1 attr-select" id="selectattrs' + i + '" name="selectattrs[]" onchange=select_attr_val("selectattrs' + i + '") required style="float:left; display: inline-block; margin-right:20px;width:150px;"></select> ';
        attr_html += '<div id="cselectattrs' + i + '"></div><button type="submit" class="btn btn-sm btn-danger" onclick=removeattrs("selectattrs_div' + i + '"); return false;" style="float:left; display: inline-block; margin-right:20px;">Remove</button>';
        attr_html += '</div><br>    </div>     </div>        </div>';


        $("#myform_attr").append(attr_html);
        getproduct_attr(i);
    }
}

function removeattrs(id) {
    $("#" + id).remove();
}

function select_attr_val(element_id, myTag, element_name) {
    // var element = $("#" + id).find('option:selected');
    // var myTag = element.attr("attrs");
    var tag_arr = myTag.split(',');
    var tag_html = '';
    for (var j = 0; j < tag_arr.length; j++) {
        let firstChar = tag_arr[j].charAt(0);
        if (firstChar == '#') {
            var rgb = hexToRgb(tag_arr[j]);
            var darkerColor = `rgb(${rgb.r * 0.8}, ${rgb.g * 0.8}, ${rgb.b * 0.8})`;
            tag_html += '<div class="d-flex align-items-center mb-1"><input type="checkbox" name="attr' + element_id + '[]" value="' + tag_arr[j] + '" class="attr' + element_id + '"><span style="padding: 13px;background-color:' + tag_arr[j] + ';margin:0px 6px;font-size:1px;border-radius:30px;border:1px solid ' + darkerColor + ';"></span></div>';
        } else {
            tag_html += '<input type="checkbox" name="attr' + element_id + '[]" value="' + tag_arr[j] + '" class="attr' + element_id + '"><span style="padding: 9px;">' + tag_arr[j] + '</span>';
        }
    }
    // $("#c" + id).html(tag_html);
    return tag_html;
}

// function to convert hex color to RGB
function hexToRgb(hex) {
    // remove the "#" symbol
    hex = hex.replace("#", "");

    // convert to RGB
    const r = parseInt(hex.substring(0, 2), 16);
    const g = parseInt(hex.substring(2, 4), 16);
    const b = parseInt(hex.substring(4, 6), 16);

    return { r, g, b };
}

function manage_configurations() { //
    var prod_name = $("#prod_name").val();

    if (!prod_name) {
        successmsg("Please enter Product Name first");
    }
    var sel_attr = '0';
    var sel_attr_val = '0';
    /* jQuery("#myform_attr").find('select').each(function () {
        var vau = jQuery(this).val();
        if (!vau) {
            successmsg("Please select Attribute");
            sel_attr = '1';

        } else {
            if ($('.attr' + vau + ':checkbox:checked').length == 0) {
                sel_attr_val = '1';
                successmsg("Please select Attribute value");
            }
        }

    }); */


    if (prod_name && sel_attr == '0' && sel_attr_val == '0') {
        $.busyLoadFull("show");
        $('#myform_attr').append('<input type="hidden" name="product_name" value="' + prod_name + '" /> ');
        $('#myform_attr').append('<input type="hidden" name="code" value="' + code_ajax + '" /> ');
        var formData = $('#myform_attr').serialize();

        $.ajax({
            method: 'POST',
            url: 'get_attributes_conf_data.php',
            data: formData,
            success: function (response) {
                $.busyLoadFull("hide");
                var data = response;
                $("#myModal").modal('hide');
                $("#skip_pric").show();
                $('#configurations_div_html').html(data);

            }
        });
    }
}

function remove_attr_tr(id) {
    $("#" + id).remove();
}

function check_product() {
    var prod_name = $("#prod_name").val();
    if (!prod_name) {
        successmsg("Please enter Product Name first");
        return false;
    } else {
        $("#myModal").modal();

        var html = '<div class="form-group" id="selectattrs_div">  	<label for="focusedinput" class="col-sm-2 control-label">Select Attributes</label> <div class="col-sm-9"> ';
        html += '<div class="input-files">  <div style="vertical-align: middle; margin-top:5px;">';
        html += '<select class="form-control1 attr-select" id="selectattrs" name="selectattrs[]" onchange=select_attr_val("selectattrs"); required style="float:left; display: inline-block; margin-right:20px;width:150px;">';
        html += '</select> <div id="cselectattrs"></div></div><br>  </div> </div>   </div>';
        // $('#myform_attr').html(html);
        getproduct_attr();
        $("#manage_configurations_btn").attr('onclick', 'manage_configurations();');
        // $("#add_more_attr_btndiv").html('<a class="fa fa-plus fa-4 btn btn-primary" aria-hidden="true"  onclick="add_more_attrs();">Add More Attributes</a>');
    }
}


function manage_configurations_final() {
    var finals = '0';
    var val = '0';
    if ($("#skip_sale_price").prop('checked') == true) {
        val = '1';
    } else {
        $("#myform_attr").find("input").each(function () {
            if ($(this).attr('class') == 'sale_prices') {
                var vau = jQuery(this).val();
                if (!vau) {
                    finals = '1';
                }
            }
        });
    }
    if (finals == '0') {
        $("#myModal").modal('hide');
        var table_html = $("#myform_attr").html();
        $("#configurations_div_html").html(table_html);
        $("#skip_pric").show();
    } else {
        successmsg("Please enter Sale Price");
    }

}


function expand(list, view) {
    var listElement = document.getElementById('ul' + list);
    var defaultView = '[+]';

    if (view.innerHTML == defaultView) {
        listElement.style.display = "block";
        view.innerHTML = '[-]';
    } else {
        listElement.style.display = "none";
        view.innerHTML = '[+]';
    }
}

function check_category_limit(view, cat_id) {


    var checkbox_value = "";
    $(".check_category_limit:checkbox").each(function () {
        var ischecked = $(this).is(":checked");
        if (ischecked) {
            checkbox_value += $(this).val() + "|";
        }
    });
    $('#select_cat_id').val(checkbox_value);
    get_seller_related_product();

    if ($('.check_category_limit:checkbox:checked').length > 5) {
        view.checked = false;
        successmsg("Category Selection Limit 5");
        //$('.check_category_limit').attr('disabled','disabled');
    }
}


function getreturn_policy() {
    $.ajax({
        method: 'POST',
        url: 'get_return_policy.php',
        data: {
            code: code_ajax
        },
        success: function (response) {
            // successmsg(response); // display response from the PHP script, if any
            var data = $.parseJSON(response);
            $('#return_policy').empty();
            //  .append('<option selected="selected" value="blank"></option>') ;    
            var o = new Option("Select", "");
            $("#return_policy").append(o);
            if (data["status"] == "1") {
                $(data["data"]).each(function () {
                    //	successmsg(this.name);
                    var o = new Option(this.title, this.id);
                    $("#return_policy").append(o);
                });

            } else {
                successmsg(data["msg"]);
            }
        }
    });

}


$(document).ready(function () {
    $("#addProduct_btn").click(function (event) {
        event.preventDefault();

        var selectattrset = $('#selectattrset').val();
        var prod_namevalue = $('#prod_name').val();
        var prod_shortvalue = tinyMCE.get('prod_short').getContent();
        var prod_detailsvalue = tinyMCE.get('editor').getContent();
        var prod_mrpvalue = $('#prod_mrp').val();
        var prod_pricevalue = $('#prod_price').val();
        var prod_qty_value = $('#prod_qty').val();
        var prod_brand = $('#selectbrand').val();
        var prod_seller = $('#selleer_id').val();
        var featured_img = $('#featured_img').val();
       
        /* if (prod_brand == '') {
            prod_brand = $('#selectbrand').val('3');
        } */

        var mrp = $('#prod_mrp').val(prod_mrpvalue);

        var element = $("#skip_sale_price").length;

        var valid = 1;
        var finals = '0';
        if ($("#skip_sale_price").is(":visible")) {


            $("#configurations_div_html").find("input").each(function () {
                if ($(this).attr('class') == 'sale_prices') {
                    var vau = jQuery(this).val();
                    if (!vau) {
                        finals = '1';
                    }
                }
            });

        }


        /*  if (!selectattrset) {
             successmsg("Please Select Attribute Set.");
             valid = 0;
         } else  */
        if ($('.check_category_limit:checkbox:checked').length == 0) {
            successmsg("Please Select atleast one Category.");
            $('.check_category_limit').focus();
            valid = 0;
        } else if (!prod_namevalue) {
            successmsg("Please enter Product Name.");
            $('#prod_name').focus();
            valid = 0;
        } else if (!prod_shortvalue) {
            successmsg("Please enter Product Short details (ENG).");
            tinyMCE.get('prod_short').focus();
            valid = 0;
        } else if (!prod_detailsvalue) {
            successmsg("Please enter Product Short details (ENG).");
            tinyMCE.get('editor').focus();
            valid = 0;
        } else if (!prod_pricevalue) {
            successmsg("Price is empty");
            $('#seller_price').focus();
            valid = 0;
        } else if (parseFloat(prod_mrpvalue) < parseFloat(prod_pricevalue)) {
            successmsg("Please enter product Price less or equal to MRP");
            $('#seller_price').focus();
            valid = 0;
        }
        /* else if (prod_seller == "") {
            $('#prod_qty').focus();
            successmsg("Please Select Seller");
            valid = 0;
        } */
        else if (prod_brand == "") {
            successmsg("Please Select Brand");
            valid = 0;
        } else if (prod_qty_value == "") {
            $('#prod_qty').focus();
            successmsg("Please Add Stock Qty");
            valid = 0;
        } else if (prod_qty_value == 0) {
            $('#prod_qty').focus();
            successmsg("Please Stock Qty Could Not Be 0");
            valid = 0;
        } else if (finals == 1) {
            successmsg("Please enter Attribute Sale Price");
            valid = 0;

        } else if (featured_img == "") {
            $('#featured_img').focus();
            successmsg("Please Select Featured Image");
            valid = 0;
        }

        else {
            $.busyLoadFull("show");
            $.ajax({
                method: 'POST',
                url: 'check_product_process.php',
                data: $('#myform').serialize(),
                success: function (response) {
                    var data = $.parseJSON(response);
                    if (data["data"]['status'] == 'exist') {
                        $.busyLoadFull("hide");
                        $("#prod_url").val(data["data"]['prod_url']);
                        $("#prod_sku").val(data["data"]['prod_sku']);
                        successmsg(data["data"]['message']);
                    } else if (data["data"]['status'] == 'done') {
                        $("#prod_url").val(data["data"]['prod_url']);
                        $("#prod_sku").val(data["data"]['prod_sku']);
                        $("#myform").submit();
                    }

                },
                error: function (xhr, status, error) {
                    console.log('AJAX request failed:', error);
                    $.busyLoadFull("hide");
                    // Perform additional actions or show an error message
                }
            });



        }
    });

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
    if ($("#prod_short_ar").length > 0) {
        tinymce.init({
            selector: "textarea#prod_short_ar",
            theme: "modern",
            height: 300,
            directionality: 'rtl',
            /*language: 'ar',*/

            plugins: [
                "advlist lists print",

                //  "wordcount code fullscreen",
                "save table directionality emoticons paste textcolor"
            ],
            toolbar: " undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",

        });
    }

    if ($("#editor_ar").length > 0) {
        tinymce.init({
            selector: "textarea#editor_ar",
            theme: "modern",
            height: 300,
            directionality: 'rtl',
            plugins: [
                "advlist lists print",
                //  "wordcount code fullscreen",
                "save table directionality emoticons paste textcolor"
            ],
            toolbar: " undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",

        });
    }
})