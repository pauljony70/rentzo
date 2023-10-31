var code_ajax = $("#code_ajax").val();

var pageno = 1;

var rowno = 0;





function getOrderData(pagenov, rownov) {

    $.busyLoadFull("show");

    var perpage = $('#perpage').val();



    var search_namevalue = $('#search_name').val();
    var payment_id = $('#payment_id').val();

    var orderstatus = $("#orderstatus option:selected").val();

    $.ajax({

        method: 'POST',

        url: 'get_order_date_wise_data.php',

        data: {

            code: code_ajax,

            page: pagenov,

            rowno: rownov,

            perpage: perpage,

            order_id: search_namevalue,

            payment_id: payment_id,

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

                    $("#tbodyPostid").append('<tr> <td class="nr"><a class="text-dark font-weight-bold" target="_blank" onclick = \'edit_orders("' + this.orderid + '","' + this.prod_id + '");\' style="cursor:pointer;">' + this.orderid + '</a></td><td class="stk" > ' + this.total_qty + '</td><td>' + this.total_price + '</td><td>' + this.tds + '</td><td>' + this.tcs + '</td><td>' + this.gross_amount + '</td><td>' + this.gst_input + '</td><td>' + this.net_amount + '</td><td> ' + this.create_date + '</td><td>' + this.order_status + '</td></tr> ');





                });



            } else {

                successmsg(" No record found. please try again!");

            }



        }

    });

}



function order_product(pagenov) {

    $.busyLoadFull("show");

    var perpage = $('#perpage').val();



    var search_namevalue = $('#search_name').val();

    var payment_id = $('#payment_id').val();

    var orderstatus = $("#orderstatus option:selected").val();

    var count = 1;

    $.ajax({

        method: 'POST',

        url: 'get_order_date_wise_data.php',

        data: {

            code: code_ajax,

            page: pagenov,

            rowno: 0,

            perpage: perpage,

            order_id: search_namevalue,

            payment_id: payment_id,

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

                    $("#tbodyPostid").append('<tr> <td class="nr"><a class="text-dark font-weight-bold" target="_blank" onclick = \'edit_orders("' + this.orderid + '","' + this.prod_id + '");\'>' + this.orderid + '</a></td><td class="stk" > ' + this.total_qty + '</td><td>' + this.total_price + '</td><td>' + this.tds + '</td><td>' + this.tcs + '</td><td>' + this.gross_amount + '</td><td>' + this.gst_input + '</td><td>' + this.net_amount + '</td><td> ' + this.create_date + '</td><td>' + this.order_status + '</td></tr> ');



                });



            } else {

                successmsg(" No record found. please try again!");

            }



        }

    });

}





function perpage_filter() {

    $.busyLoadFull("show");

    var perpage = $('#perpage').val();



    var search_namevalue = $('#search_name').val();

    var payment_id = $('#payment_id').val();

    var orderstatus = $("#orderstatus option:selected").val();

    var count = 1;

    $.ajax({

        method: 'POST',

        url: 'get_order_date_wise_data.php',

        data: {

            code: code_ajax,

            page: 1,

            rowno: 0,

            perpage: perpage,

            order_id: search_namevalue,

            payment_id: payment_id,

            orderstatus: orderstatus

        },

        success: function (response) {

            $.busyLoadFull("hide");

            var count = 1;

            var data = $.parseJSON(response);



            $("#totalrowvalue").html(data["totalrowvalue"]);

            $(".page_div").html(data["page_html"]);

            $("#tbodyPostid").empty();

            if (data["status"] == "1") {

                $(data["details"]).each(function () {

                    $("#tbodyPostid").append('<tr> <td class="nr"><a class="text-dark font-weight-bold" target="_blank" onclick = \'edit_orders("' + this.orderid + '","' + this.prod_id + '");\'>' + this.orderid + '</a></td><td class="stk" > ' + this.total_qty + '</td><td>' + this.total_price + '</td><td>' + this.tds + '</td><td>' + this.tcs + '</td><td>' + this.gross_amount + '</td><td>' + this.gst_input + '</td><td>' + this.net_amount + '</td><td> ' + this.create_date + '</td><td>' + this.order_status + '</td></tr> ');


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

    var payment_id = $('#payment_id').val();

    var orderstatus = $("#orderstatus option:selected").val();

    var count = 1;

    $.ajax({

        method: 'POST',

        url: 'get_order_date_wise_data.php',

        data: {

            code: code_ajax,

            page: 1,

            rowno: 0,

            perpage: perpage,

            seller_name: search_namevalue,

            orderstatus: orderstatus,

            payment_id: payment_id,

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



                    $("#tbodyPostid").append('<tr> <td class="nr">' + this.sellerid + '</td><td>' + this.fullname + '</td><td>' + this.bussname + '</td> <td>' + this.email + '</td> <td class="stk" > ' + this.phone + '</td><td>' + this.city + '</td><td> ' + this.groupname + '</td><td> ' + this.createby + '</td> <td>' + btnactive + '</td></tr> ');



                    count = count + 1;

                });





            } else {

                successmsg(" No record found. please try again!");

            }



        }

    });

}





function edit_orders(order_id, prod_id) {
    location.href = "edit_order.php?orderid=" + order_id + "&product_id=" + prod_id;
}

function editorder(orderid) {

    // successmsg(item);



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

    getOrderData(pageno, rowno);







    $("#searchName").click(function (event) {

        event.preventDefault();



        var perpage = $('#perpage').val();



        var search_namevalue = $('#search_name').val();

        var orderstatus = $("#orderstatus option:selected").val();

        var payment_id = $('#payment_id').val();

        var count = 1;



        //if(!search_namevalue){

        //   successmsg('Please enter search string.');

        // }else{

        $.busyLoadFull("show");

        $.ajax({

            method: 'POST',

            url: 'get_order_date_wise_data.php',

            data: {

                code: code_ajax,

                page: 1,

                rowno: 0,

                perpage: perpage,

                order_id: search_namevalue,

                payment_id: payment_id,

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

                        $("#tbodyPostid").append('<tr> <td class="nr"><a class="text-dark font-weight-bold" target="_blank" onclick = \'edit_orders("' + this.orderid + '","' + this.prod_id + '");\'>' + this.orderid + '</a></td><td class="stk" > ' + this.total_qty + '</td><td>' + this.total_price + '</td><td>' + this.tds + '</td><td>' + this.tcs + '</td><td>' + this.gross_amount + '</td><td>' + this.gst_input + '</td><td>' + this.net_amount + '</td><td> ' + this.create_date + '</td><td>' + this.order_status + '</td></tr> ');

                    });

                } else {

                    successmsg(" No record found. please try again!");

                }



            }

        });



        //}



    });



});