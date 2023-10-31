var code_ajax = $("#code_ajax").val();
var pageno = 1;
var rowno = 0;


function getOrderData(pagenov, rownov) {
    $.busyLoadFull("show");
    var perpage = $('#perpage').val();

    var search_namevalue = $('#search_name').val();
    $.ajax({
        method: 'POST',
        url: 'get_shipped_order_data.php',
        data: {
            code: code_ajax,
            page: pagenov,
            rowno: rownov,
            perpage: perpage,
            order_id: search_namevalue
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
                    $("#tbodyPostid").append('<tr> <td class="nr"><img src="' + this.prod_img + '" style="width:50px;"></td><td>' + this.prod_name + '</td><td>' + this.prod_id + '</td> <td>' + this.prod_attr + '</td> <td class="stk" > ' + this.qty + '</td><td class="stk" > ' + this.prod_mrp + '</td><td>' + this.prod_price + '</td><td> ' + this.shipping + '</td><td> ' + this.discount + '</td> <td>' + this.order_status + '</td><td>' + this.create_date + '</td><td>	<button type = "button" class = "btn btn-dark waves-effect waves-light btn-sm" onclick = \'editorder("' + this.orderid + '","' + this.prod_id + '");\'>' + "Edit" + '</button></td></tr> ');

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
    var count = 1;
    $.ajax({
        method: 'POST',
        url: 'get_shipped_order_data.php',
        data: {
            code: code_ajax,
            page: pagenov,
            rowno: 0,
            perpage: perpage,
            order_id: search_namevalue
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
                    $("#tbodyPostid").append('<tr> <td class="nr"><img src="' + this.prod_img + '" style="width:50px;"></td><td>' + this.prod_name + '</td><td>' + this.prod_id + '</td> <td>' + this.prod_attr + '</td> <td class="stk" > ' + this.qty + '</td><td class="stk" > ' + this.prod_mrp + '</td><td>' + this.prod_price + '</td><td> ' + this.shipping + '</td><td> ' + this.discount + '</td> <td>' + this.order_status + '</td><td>' + this.create_date + '</td><td>	<button type = "button" class = "btn btn-dark waves-effect waves-light btn-sm" onclick = \'editorder("' + this.orderid + '","' + this.prod_id + '");\'>' + "Edit" + '</button></td></tr> ');

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
    var count = 1;
    $.ajax({
        method: 'POST',
        url: 'get_shipped_order_data.php',
        data: {
            code: code_ajax,
            page: 1,
            rowno: 0,
            perpage: perpage,
            order_id: search_namevalue
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
                    $("#tbodyPostid").append('<tr> <td class="nr"><img src="' + this.prod_img + '" style="width:50px;"></td><td>' + this.prod_name + '</td><td>' + this.prod_id + '</td> <td>' + this.prod_attr + '</td> <td class="stk" > ' + this.qty + '</td><td class="stk" > ' + this.prod_mrp + '</td><td>' + this.prod_price + '</td><td> ' + this.shipping + '</td><td> ' + this.discount + '</td> <td>' + this.order_status + '</td><td>' + this.create_date + '</td><td>	<button type = "button" class = "btn btn-dark waves-effect waves-light btn-sm" onclick = \'editorder("' + this.orderid + '","' + this.prod_id + '");\'>' + "Edit" + '</button></td></tr> ');

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
    var count = 1;
    $.ajax({
        method: 'POST',
        url: 'get_shipped_order_data.php',
        data: {
            code: code_ajax,
            page: 1,
            rowno: 0,
            perpage: perpage,
            seller_name: search_namevalue,
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

    location.href = "edit_shipped_order.php?orderid=" + orderid + "&product_id=" + prod_id;
}



$(document).ready(function () {
    getOrderData(pageno, rowno);



    $("#searchName").click(function (event) {
        event.preventDefault();

        var perpage = $('#perpage').val();

        var search_namevalue = $('#search_name').val();
        var count = 1;

        if (!search_namevalue) {
            successmsg('Please enter search string.');
        } else {
            $.busyLoadFull("show");
            $.ajax({
                method: 'POST',
                url: 'get_shipped_order_data.php',
                data: {
                    code: code_ajax,
                    page: 1,
                    rowno: 0,
                    perpage: perpage,
                    order_id: search_namevalue
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
                            $("#tbodyPostid").append('<tr> <td class="nr"><img src="' + this.prod_img + '" style="width:50px;"></td><td>' + this.prod_name + '</td><td>' + this.prod_id + '</td> <td>' + this.prod_attr + '</td> <td class="stk" > ' + this.qty + '</td><td class="stk" > ' + this.prod_mrp + '</td><td>' + this.prod_price + '</td><td> ' + this.shipping + '</td><td> ' + this.discount + '</td> <td>' + this.order_status + '</td><td>' + this.create_date + '</td><td>	<button type = "button" class = "btn btn-dark waves-effect waves-light btn-sm" onclick = \'editorder("' + this.orderid + '","' + this.prod_id + '");\'>' + "Edit" + '</button></td></tr> ');

                        });

                    } else {
                        successmsg(" No record found. please try again!");
                    }

                }
            });

        }

    });

});