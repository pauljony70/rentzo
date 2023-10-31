var code_ajax = $("#code_ajax").val();

var pageno = 1;

var rowno = 0;



function export_excel() {
    var search_namevalue = $('#search_name').val();
    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();
    var seller_id = $('#seller_id').val();
    var export_data = $('#export_data').val();

    var orderstatus = $("#orderstatus option:selected").val();

    $.ajax({

        method: 'POST',

        url: 'export_seller_transection_data.php',

        data: {

            code: code_ajax,

            order_id: search_namevalue,

            orderstatus: orderstatus,

            from_date: from_date,

            to_date: to_date,

            seller_id: seller_id,

            export_data: export_data

        },


        cache: false,

        success: function (response) {


        }
    });
}



function getOrderData(pagenov, rownov) {

    $.busyLoadFull("show");

    var perpage = $('#perpage').val();



    var search_namevalue = $('#search_name').val();
    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();
    var seller_id = $('#seller_id').val();
    var export_data = $('#export_data').val();

    var orderstatus = $("#orderstatus option:selected").val();

    $.ajax({

        method: 'POST',

        url: 'get_payment_transection_data.php',

        data: {

            code: code_ajax,

            page: pagenov,

            rowno: rownov,

            perpage: perpage,

            order_id: search_namevalue,

            orderstatus: orderstatus,

            from_date: from_date,

            to_date: to_date,

            seller_id: seller_id,

            export_data: export_data

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
                    var public_html = '';
                    public_html = '<tr> <td>' + count + '</td><td> ' + this.companyname + '</td><td class="nr">' + this.amount + '</td><td>' + this.date_range + '</td> <td>' + this.payment_status + '</td> <td>' + this.transection_id + '</td><td> ';

                    if (this.payment_status == 'pending') {
                        public_html += '<button type="button" class="btn btn-dark waves-effect waves-light btn-sm pull-left open-modal" target="_blank" data-pay_id="' + this.id + '" data-id="' + this.seller_id + '" data-toggle="modal" data-target="#myModal">Pay</button>';

                    }
                    
                    public_html += '<a style="margin-left:10px;" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" target="_blank" href="manage_order_date_wise_transaction.php?id=' + this.id + '">View All</a></td></tr> ';
                    $("#tbodyPostid").append(public_html);

                    count = count + 1;

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

    var orderstatus = $("#orderstatus option:selected").val();

    var from_date = $('#from_date').val();

    var to_date = $('#to_date').val();

    var seller_id = $('#seller_id').val();

    var export_data = $('#export_data').val();

    var count = 1;

    $.ajax({

        method: 'POST',

        url: 'get_payment_transection_data.php',

        data: {

            code: code_ajax,

            page: pagenov,

            rowno: 0,

            perpage: perpage,

            order_id: search_namevalue,

            orderstatus: orderstatus,

            from_date: from_date,

            to_date: to_date,

            seller_id: seller_id,

            export_data: export_data

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
                    var public_html = '';
                    public_html = '<tr> <td>' + count + '</td><td> ' + this.companyname + '</td><td class="nr">' + this.amount + '</td><td>' + this.date_range + '</td> <td>' + this.payment_status + '</td> <td>' + this.transection_id + '</td><td> ';

                    if (this.payment_status == 'pending') {
                        public_html += '<button type="button" class="btn btn-dark waves-effect waves-light btn-sm pull-left open-modal" target="_blank" data-pay_id="' + this.id + '" data-id="' + this.seller_id + '" data-toggle="modal" data-target="#myModal">Pay</button>';

                    }
                    public_html += '<a style="margin-left:10px;" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" target="_blank" href="manage_order_date_wise_transaction.php?id=' + this.id + '">View All</a></td></tr> ';
                    $("#tbodyPostid").append(public_html);
                    count = count + 1;



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

    var orderstatus = $("#orderstatus option:selected").val();

    var from_date = $('#from_date').val();

    var to_date = $('#to_date').val();

    var seller_id = $('#seller_id').val();

    var export_data = $('#export_data').val();

    var count = 1;

    $.ajax({

        method: 'POST',

        url: 'get_payment_transection_data.php',

        data: {

            code: code_ajax,

            page: 1,

            rowno: 0,

            perpage: perpage,

            order_id: search_namevalue,

            orderstatus: orderstatus,

            from_date: from_date,

            to_date: to_date,

            seller_id: seller_id,

            export_data: export_data

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
                    var public_html = '';
                    public_html = '<tr> <td>' + count + '</td><td> ' + this.companyname + '</td><td class="nr">' + this.amount + '</td><td>' + this.date_range + '</td> <td>' + this.payment_status + '</td> <td>' + this.transection_id + '</td><td> ';

                    if (this.payment_status == 'pending') {
                        public_html += '<button type="button" class="btn btn-dark waves-effect waves-light btn-sm pull-left open-modal" target="_blank" data-pay_id="' + this.id + '" data-id="' + this.seller_id + '" data-toggle="modal" data-target="#myModal">Pay</button>';

                    }
                    public_html += '<a style="margin-left:10px;" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" target="_blank" href="manage_order_date_wise_transaction.php?id=' + this.id + '">View All</a></td></tr> ';
                    $("#tbodyPostid").append(public_html);

                    count = count + 1;

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

    var from_date = $('#from_date').val();

    var to_date = $('#to_date').val();

    var seller_id = $('#seller_id').val();

    var export_data = $('#export_data').val();

    var count = 1;

    $.ajax({

        method: 'POST',

        url: 'get_payment_transection_data.php',

        data: {

            code: code_ajax,

            page: 1,

            rowno: 0,

            perpage: perpage,

            seller_name: search_namevalue,

            orderstatus: orderstatus,

            groupid: groupcatid,

            from_date: from_date,

            to_date: to_date,

            seller_id: seller_id,

            export_data: export_data

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


    $("#add_payment_btn").click(function (event) {
        event.preventDefault();

        var transection_id = $('#transection_id').val();
        var seller_id = $('#seller_id').val();
        var paymant_id = $('#paymant_id').val();
        var invoice_proof = $('#invoice_proof').val();

        if (!transection_id) {
            successmsg("Please Enter Transection Id");
        } else


            if (transection_id) {
                $.busyLoadFull("show");
                var file_data = $('#invoice_proof').prop('files')[0];
                var form_data = new FormData();
                form_data.append('invoice_proof', file_data);
                form_data.append('transection_id', transection_id);
                form_data.append('seller_id', seller_id);
                form_data.append('paymant_id', paymant_id);
                form_data.append('code', code_ajax);

                $.ajax({
                    method: 'POST',
                    url: 'add_payment_process.php',
                    data: form_data,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        $.busyLoadFull("hide");
                        $("#myModal").modal('hide');
                        $('#transection_id').val('');
                        $('#invoice_proof').val('');
                        successmsg(response);
                    }
                });
            }

    });




    $("#searchName").click(function (event) {

        event.preventDefault();



        var perpage = $('#perpage').val();



        var search_namevalue = $('#search_name').val();

        var orderstatus = $("#orderstatus option:selected").val();

        var from_date = $('#from_date').val();

        var to_date = $('#to_date').val();

        var seller_id = $('#seller_id').val();

        var export_data = $('#export_data').val();


        var count = 1;



        //if(!search_namevalue){

        //   successmsg('Please enter search string.');

        // }else{

        $.busyLoadFull("show");

        $.ajax({

            method: 'POST',

            url: 'get_payment_transection_data.php',

            data: {

                code: code_ajax,

                page: 1,

                rowno: 0,

                perpage: perpage,

                order_id: search_namevalue,

                orderstatus: orderstatus,

                from_date: from_date,

                to_date: to_date,

                seller_id: seller_id,

                export_data: export_data



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
                        var public_html = '';
                        public_html = '<tr> <td>' + count + '</td><td> ' + this.companyname + '</td><td class="nr">' + this.amount + '</td><td>' + this.date_range + '</td> <td>' + this.payment_status + '</td> <td>' + this.transection_id + '</td><td> ';

                        if (this.payment_status == 'pending') {
                            public_html += '<button type="button" class="btn btn-dark waves-effect waves-light btn-sm pull-left open-modal" target="_blank" data-pay_id="' + this.id + '" data-id="' + this.seller_id + '" data-toggle="modal" data-target="#myModal">Pay</button>';

                        }
                        public_html += '<a style="margin-left:10px;" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" target="_blank" href="manage_order_date_wise_transaction.php?id=' + this.id + '">View All</a></td></tr> ';
                        $("#tbodyPostid").append(public_html);

                        count = count + 1;

                    });






                } else {

                    successmsg(" No record found. please try again!");

                }



            }

        });



        //}



    });



});