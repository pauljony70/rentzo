var code_ajax = $("#code_ajax").val();
var pageno = 1;
var rowno = 0;


function getOrderData(pagenov, rownov) {
    $.busyLoadFull("show");
    var perpage = $('#perpage').val();
   
    var search_namevalue = $('#search_name').val();
    var seller_value = $('#seller').val();
    $.ajax({
        method: 'POST',
        url: 'get_order_data_report.php',
        data: {
            code: code_ajax,
            page: pagenov,
            rowno: rownov,
            perpage: perpage,
            order_id: search_namevalue,
            seller_value: seller_value
        },
        success: function(response) {
            $.busyLoadFull("hide");
            var count = 1;
            var data = $.parseJSON(response);
            $("#tbodyPostid").empty();
            $("#totalrowvalue").html(data["totalrowvalue"]);
            $(".page_div").html(data["page_html"]);
            if (data["status"] == "1") {

                $(data["details"]).each(function() {
                   $("#tbodyPostid").append('<tr> <td class="nr">' + this.orderid + '</td><td>' + this.vender_id + '</td><td>' + this.user_type + '</td><td>' + this.payment_id + '</td> <td>' + this.total_price + '</td> <td class="stk" > ' + this.total_qty + '</td><td>' + this.payment_mode + '</td><td> ' + this.create_date + '</td><td> ' + this.payment_status + '</td> <td>' + this.order_status + '</td><td>	<button type = "button" class = "btn btn-dark waves-effect waves-light btn-sm" onclick = \'editorder("' + this.orderid + '");\'>' + "Edit" + '</button></td></tr> ');

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
	var seller_value = $('#seller').val();
	var export_data = $('#export').val();
	var from_date = $('#from_date').val();
	var to_date = $('#to_date').val();
	
	$('#search_name_exp').val(search_namevalue);
	$('#seller_exp').val(seller_value);
	$('#from_date_exp').val(from_date);
	$('#to_date_exp').val(to_date);
	
    var count = 1;
    $.ajax({
        method: 'POST',
        url: 'get_order_data_report.php',
        data: {
            code: code_ajax,
            page: pagenov,
            rowno: 0,
            perpage: perpage,
            order_id: search_namevalue,
			seller_value: seller_value,
			export_data : export_data,
			from_date : from_date,
			to_date : to_date
        },
        success: function(response) {
            $.busyLoadFull("hide");
            var count = 1;
            var data = $.parseJSON(response);
            $("#tbodyPostid").empty();
            $("#totalrowvalue").html(data["totalrowvalue"]);
            $(".page_div").html(data["page_html"]);
            if (data["status"] == "1") {
				$(data["details"]).each(function() {
                   $("#tbodyPostid").append('<tr> <td class="nr">' + this.orderid + '</td><td>' + this.vender_id + '</td><td>' + this.user_type + '</td><td>' + this.payment_id + '</td> <td>' + this.total_price + '</td> <td class="stk" > ' + this.total_qty + '</td><td>' + this.payment_mode + '</td><td> ' + this.create_date + '</td><td> ' + this.payment_status + '</td> <td>' + this.order_status + '</td><td>	<button type = "button" class = "btn btn-dark waves-effect waves-light btn-sm" onclick = \'editorder("' + this.orderid + '");\'>' + "Edit" + '</button></td></tr> ');

                });

            } else {
                 successmsg(" No record found. please try again!");
            }

        }
    });
}


function perpage_filter() {
    $.busyLoadFull("show");
	//alert('dd');
    var perpage = $('#perpage').val();
   
    var search_namevalue = $('#search_name').val();
	$('#search_name_exp').val(search_namevalue);

    var count = 1;
    $.ajax({
        method: 'POST',
        url: 'get_order_data.php',
        data: {
            code: code_ajax,
            page: 1,
            rowno: 0,
            perpage: perpage,
            order_id: search_namevalue
        },
        success: function(response) {
            $.busyLoadFull("hide");
            var count = 1;
            var data = $.parseJSON(response);

            $("#totalrowvalue").html(data["totalrowvalue"]);
            $(".page_div").html(data["page_html"]);
            $("#tbodyPostid").empty();
            if (data["status"] == "1") {
				 $(data["details"]).each(function() {
                   $("#tbodyPostid").append('<tr> <td class="nr">' + this.orderid + '</td><td>' + this.user_type + '</td><td>' + this.payment_id + '</td> <td>' + this.total_price + '</td> <td class="stk" > ' + this.total_qty + '</td><td>' + this.payment_mode + '</td><td> ' + this.create_date + '</td><td> ' + this.payment_status + '</td> <td>' + this.order_status + '</td><td>	<button type = "button" class = "btn btn-dark waves-effect waves-light btn-sm" onclick = \'editorder("' + this.orderid + '");\'>' + "Edit" + '</button></td></tr> ');

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
	$('#search_name_exp').val(search_namevalue);

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
            groupid: groupcatid
        },
        success: function(response) {
            $.busyLoadFull("hide");
            var count = 1;
            var data = $.parseJSON(response);

            $("#totalrowvalue").html(data["totalrowvalue"]);
            $(".page_div").html(data["page_html"]);
            $("#tbodyPostid").empty();
            if (data["status"] == "1") {


                searchenable = false;

                $(data["details"]).each(function() {
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

    

$(document).ready(function() {
    getOrderData(pageno, rowno);



    $("#searchName").click(function(event) {
        event.preventDefault();
        
        var perpage = $('#perpage').val();
        var seller_value = $('#seller').val();
        var search_namevalue = $('#search_name').val();
        var export_data = $('#export').val();
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
		
		
		$('#search_name_exp').val(search_namevalue);
		$('#seller_exp').val(seller_value);
		$('#from_date_exp').val(from_date);
		$('#to_date_exp').val(to_date);
		
        var count = 1;
        if(!search_namevalue){
            //successmsg('Please enter search string.');
        }else{
         $.busyLoadFull("show");
		}
        $.ajax({
            method: 'POST',
            url: 'get_order_data_report.php',
            data: {
                code: code_ajax,
                page: 1,
                rowno: 0,
                perpage: perpage,
                order_id: search_namevalue,
				seller_value: seller_value,
				export_data : export_data,
				from_date : from_date,
				to_date : to_date

            },
            success: function(response) {
                $.busyLoadFull("hide");
				setTimeout(function() {
				  var dlbtn = document.getElementById("dlbtn");
				  var file = new Blob([response], {type: 'text/csv'});
				  //alert(response);
				  dlbtn.href = URL.createObjectURL(file);
				  dlbtn.download = 'myfile.csv';
				  $( "#mine").click();
				}, 2000);
				
                var count = 1;
                var data = $.parseJSON(response);
                $("#tbodyPostid").empty();
                $("#totalrowvalue").html(data["totalrowvalue"]);
                $(".page_div").html(data["page_html"]);
                if (data["status"] == "1") {
					 $(data["details"]).each(function() {
						$("#tbodyPostid").append('<tr> <td class="nr">' + this.orderid + '</td><td>' + this.vender_id + '</td><td>' + this.user_type + '</td><td>' + this.payment_id + '</td> <td>' + this.total_price + '</td> <td class="stk" > ' + this.total_qty + '</td><td>' + this.payment_mode + '</td><td> ' + this.create_date + '</td><td> ' + this.payment_status + '</td> <td>' + this.order_status + '</td><td> <button type = "button" class = "btn btn-dark waves-effect waves-light btn-sm" onclick = \'editorder("' + this.orderid + '");\'>' + "Edit" + '</button></td></tr> ');
					});

                } else {
                    successmsg(" No record found. please try again!");
                }

            }
        });
        
        //}

    });

});