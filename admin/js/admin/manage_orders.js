var code_ajax = $("#code_ajax").val();

var pageno = 1;

var rowno = 0;




function opendata(evt, type) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    /*  for (i = 0; i < tabcontent.length; i++) {
         tabcontent[i].style.display = "none";
     } */
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    // document.getElementById(type).style.display = "block";
    evt.currentTarget.className += " active";
    var quote_str = singlequote(type);
    var perpage = $('#perpage').val();
    var search_namevalue = $(`#${type} #search_name`).val();
    var orderstatus = type;
    var count = 1;

    $.busyLoadFull("show");
    $.ajax({
        method: 'POST',
        url: 'get_order_data.php',
        data: {
            code: code_ajax,
            page: 1,
            rowno: 0,
            perpage: perpage,
            order_id: search_namevalue,
            orderstatus: orderstatus
        },
        success: function (response) {
            $.busyLoadFull("hide");
            var count = 1;
            var data = $.parseJSON(response);
            $("#tbodyPostid").empty();
            $("#totalrowvalue").html(data["totalrowvalue"]);
            $(".page_div").html(data["page_html"]);
            if (data["status"] == "1") {
                $(data["details"]).each(function () {
                    $("#tbodyPostid").append('<tr> <td><img src="' + this.prod_img + '" style="width:50px;"></td><td>' + this.prod_name + '</td><td class="nr">' + this.orderid + '</td><td>' + this.user_type + '</td><td>' + this.payment_id + '</td> <td>' + this.total_price + '</td> <td class="stk" > ' + this.total_qty + '</td><td>' + this.payment_mode + '</td><td> ' + this.create_date + '</td><td> ' + this.payment_status + '</td> <td>' + this.order_status + '</td><td> <button type = "button" class = "btn btn-dark waves-effect waves-light btn-sm" onclick = \'editorder("' + this.orderid + '","' + this.prod_id + '");\'>' + "Edit" + '</button></td></tr> ');
                });
            } else {
                successmsg(" No record found. please try again!");
            }
        }
    });
}

function getOrderData(pagenov, rownov) {
    $.busyLoadFull("show");
    var perpage = $('#perpage').val();
    var search_namevalue = $('#search_name').val();
    var orderstatus = $("#orderstatus option:selected").val();

    $.ajax({
        method: 'POST',
        url: 'get_order_data.php',
        data: {
            code: code_ajax,
            page: pagenov,
            rowno: rownov,
            perpage: perpage,
            order_id: search_namevalue,
            orderstatus: orderstatus
        },

        success: function (response) {
            $.busyLoadFull("hide");
            var count = 1;
            var data = $.parseJSON(response);
            $("#tbodyPostid").empty();
            $("#totalrowvalue").html(data["totalrowvalue"]);
            $(".page_div").html(data["page_html"]);
            if (data["status"] == "1") {
                $(data["details"]).each(function () {
                    $("#tbodyPostid").append('<tr> <td><img src="' + this.prod_img + '" style="width:50px;"></td><td>' + this.prod_name + '</td><td class="nr">' + this.orderid + '</td><td>' + this.user_type + '</td><td>' + this.payment_id + '</td> <td>' + this.total_price + '</td> <td class="stk" > ' + this.total_qty + '</td><td>' + this.payment_mode + '</td><td> ' + this.create_date + '</td><td> ' + this.payment_status + '</td> <td>' + this.order_status + '</td><td> <button type = "button" class = "btn btn-dark waves-effect waves-light btn-sm" onclick = \'editorder("' + this.orderid + '","' + this.prod_id + '");\'>' + "Edit" + '</button></td></tr> ');
                });
            } else {
                successmsg(" No record found. please try again!");
            }
        }

    });

}

function order_product(pagenov) {
    $.busyLoadFull("show");
    var type = $('.tablinks.active').data('type');
    var perpage = $('#perpage_' + type).val();
    $('#orderstatus [value=' + type + ']').attr('selected', 'true');
    var search_namevalue = $('#search_name').val();
    var orderstatus = type;
    var count = 1;
    $.ajax({
        method: 'POST',
        url: 'get_order_data.php',
        data: {
            code: code_ajax,
            page: pagenov,
            rowno: 0,
            perpage: perpage,
            order_id: search_namevalue,
            orderstatus: orderstatus
        },
        success: function (response) {
            $.busyLoadFull("hide");
            var count = 1;
            var data = $.parseJSON(response);
            $("#tbodyPostid").empty();
            $("#totalrowvalue").html(data["totalrowvalue"]);

            $(".page_div").html(data["page_html"]);
            if (data["status"] == "1") {
                $(data["details"]).each(function () {
                    $("#tbodyPostid").append('<tr><td><img src="' + this.prod_img + '" style="width:50px;"></td><td>' + this.prod_name + '</td> <td class="nr">' + this.orderid + '</td><td>' + this.user_type + '</td><td>' + this.payment_id + '</td> <td>' + this.total_price + '</td> <td class="stk" > ' + this.total_qty + '</td><td>' + this.payment_mode + '</td><td> ' + this.create_date + '</td><td> ' + this.payment_status + '</td> <td>' + this.order_status + '</td><td> <button type = "button" class = "btn btn-dark waves-effect waves-light btn-sm" onclick = \'editorder("' + this.orderid + '","' + this.prod_id + '");\'>' + "Edit" + '</button></td></tr> ');
                });
            } else {
                successmsg(" No record found. please try again!");
            }
        }
    });

}

function perpage_filter() {
    $.busyLoadFull("show");
    var type = $('.tablinks.active').data('type');
    var perpage = $('#perpage').val();
    $('#orderstatus [value=' + type + ']').attr('selected', 'true');
    var search_namevalue = $('#search_name').val();
    var orderstatus = type;
    var count = 1;
    $.ajax({
        method: 'POST',
        url: 'get_order_data.php',
        data: {
            code: code_ajax,
            page: 1,
            rowno: 0,
            perpage: perpage,
            order_id: search_namevalue,
            orderstatus: orderstatus
        },
        success: function (response) {
            $.busyLoadFull("hide");
            var count = 1;
            var data = $.parseJSON(response);
            $("#tbodyPostid").empty();
            $("#totalrowvalue").html(data["totalrowvalue"]);
            $(".page_div").html(data["page_html"]);
            if (data["status"] == "1") {
                $(data["details"]).each(function () {
                    $("#tbodyPostid").append('<tr><td><img src="' + this.prod_img + '" style="width:50px;"></td><td>' + this.prod_name + '</td> <td class="nr">' + this.orderid + '</td><td>' + this.user_type + '</td><td>' + this.payment_id + '</td> <td>' + this.total_price + '</td> <td class="stk" > ' + this.total_qty + '</td><td>' + this.payment_mode + '</td><td> ' + this.create_date + '</td><td> ' + this.payment_status + '</td> <td>' + this.order_status + '</td><td> <button type = "button" class = "btn btn-dark waves-effect waves-light btn-sm" onclick = \'editorder("' + this.orderid + '","' + this.prod_id + '");\'>' + "Edit" + '</button></td></tr> ');
                });
            } else {
                successmsg(" No record found. please try again!");
            }
        }
    });

}

function groupfilter() {

    $.busyLoadFull("show");

    var perpage = $('#perpage').val();

    var grp = document.getElementById("selectgroup");

    var groupcatid = grp.options[grp.selectedIndex].value;

    var search_namevalue = $('#search_name').val();

    var orderstatus = $("#orderstatus option:selected").val();

    var count = 1;

    $.ajax({

        method: 'POST',

        url: 'get_order_data.php',

        data: {

            code: code_ajax,

            page: 1,

            rowno: 0,

            perpage: perpage,

            seller_name: search_namevalue,

            orderstatus: orderstatus,

            groupid: groupcatid

        },

        success: function (response) {

            $.busyLoadFull("hide");

            var count = 1;

            var data = $.parseJSON(response);



            $("#totalrowvalue").html(data["totalrowvalue"]);

            $(".page_div").html(data["page_html"]);

            $("#tbodyPostid").empty();

            if (data["status"] == "1") {





                searchenable = false;



                $(data["details"]).each(function () {

                    //	 successmsg(this.sellerstatus);

                    var btnactive = "";

                    if (this.sellerstatus == "0") {

                        btnactive = '<span class = "Pending">' + "Pending" + '</span>';

                    } else if (this.sellerstatus == "1") {

                        btnactive = '<span class = "Active">' + "Active " + '</span>';

                    } else if (this.sellerstatus == "3") {

                        btnactive = '<span class = "Deactive">' + "Deactive" + '</span>';

                    } else if (this.sellerstatus == "2") {

                        btnactive = '<span class = "Reject">' + "Rejected" + '</span>';

                    }



                    $("#tbodyPostid").append('<tr> <td class="nr">' + this.sellerid + '</td><td>' + this.fullname + '</td><td>' + this.bussname + '</td> <td>' + this.email + '</td> <td class="stk" > ' + this.phone + '</td><td>' + this.city + '</td><td> ' + this.groupname + '</td><td> ' + this.createby + '</td> <td>' + btnactive + '</td><td>	<button type = "button" class = "btn btn-dark waves-effect waves-light btn-sm" onclick = \'editSeller("' + this.sellerid + '");\'>' + "Edit" + '</button></td></tr> ');



                    count = count + 1;

                });





            } else {

                successmsg(" No record found. please try again!");

            }



        }

    });

}

function editorder(orderid, prod_id) {

    /*successmsg(prod_id);*/


    var url = "edit_order.php?orderid=" + orderid + "&product_id=" + prod_id;
    window.location.href = url;

    die;


    var mapForm = document.createElement("form");

    mapForm.target = "_self";

    mapForm.method = "GET"; // or "post" if appropriate

    mapForm.action = "edit_order.php";



    var mapInput = document.createElement("input");

    mapInput.type = "text";

    mapInput.name = "orderid";

    mapInput.value = orderid;

    mapForm.appendChild(mapInput);



    document.body.appendChild(mapForm);



    map = window.open("", "_self");



    if (map) {

        mapForm.submit();

    } else {

        successmsg('You must allow popups for this map to work.');

    }

}

$(document).ready(function () {

    // getOrderData(pageno, rowno);

    $("#searchName").click(function (event) {
        event.preventDefault();

        var perpage = $('#perpage').val();
        var search_namevalue = $('#search_name').val();
        var orderstatus = $("#orderstatus option:selected").val();
        var count = 1;

        //if(!search_namevalue){
        //   successmsg('Please enter search string.');
        // }else{

        $.busyLoadFull("show");
        $.ajax({
            method: 'POST',
            url: 'get_order_data.php',
            data: {
                code: code_ajax,
                page: 1,
                rowno: 0,
                perpage: perpage,
                order_id: search_namevalue,
                orderstatus: orderstatus
            },

            success: function (response) {
                $.busyLoadFull("hide");
                var count = 1;
                var data = $.parseJSON(response);
                $("#tbodyPostid").empty();
                $("#totalrowvalue").html(data["totalrowvalue"]);
                $(".page_div").html(data["page_html"]);
                if (data["status"] == "1") {
                    $(data["details"]).each(function () {
                        $("#tbodyPostid").append('<tr> <td><img src="' + this.prod_img + '" style="width:50px;"></td><td>' + this.prod_name + '</td><td class="nr">' + this.orderid + '</td><td>' + this.user_type + '</td><td>' + this.payment_id + '</td> <td>' + this.total_price + '</td> <td class="stk" > ' + this.total_qty + '</td><td>' + this.payment_mode + '</td><td> ' + this.create_date + '</td><td> ' + this.payment_status + '</td> <td>' + this.order_status + '</td><td> <button type = "button" class = "btn btn-dark waves-effect waves-light btn-sm" onclick = \'editorder("' + this.orderid + '","' + this.prod_id + '");\'>' + "Edit" + '</button></td></tr> ');
                    });
                } else {
                    successmsg(" No record found. please try again!");
                }
            }

        });

    });

});