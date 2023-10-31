var code_ajax = $("#code_ajax").val();

var pageno = 1;

var rowno = 0;





function getSellerData(pagenov, rownov) {

    $.busyLoadFull("show");

    var perpage = $('#perpage').val();

    var grp = document.getElementById("selectgroup");

    var groupcatid = grp.options[grp.selectedIndex].value;

    var search_namevalue = $('#search_name').val();

    $.ajax({

        method: 'POST',

        url: 'get_seller_transaction_data.php',

        data: {

            code: code_ajax,

            page: pagenov,

            rowno: rownov,

            perpage: perpage,

            seller_name: search_namevalue,

            groupid: groupcatid

        },

        success: function(response) {

            $.busyLoadFull("hide");

            var count = 1;

            var data = $.parseJSON(response);

            $("#tbodyPostid").empty();

            $("#totalrowvalue").html(data["totalrowvalue"]);

            $(".page_div").html(data["page_html"]);

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



                    $("#tbodyPostid").append('<tr id="tr'+this.id+'"> <td class="nr">' + this.bussname + '</td><td><b>Name :</b> '+this.fullname+'<br><b>Email :</b> '+this.email+'<br><b>Phone :</b> '+this.phone+'</td><td>' + this.total_price + '</td><td>' + this.total_profit + '</td><td> <a  class= "btn btn-dark waves-effect waves-light btn-sm pull-left" target="_blank" href="manage_seller_wise_transaction.php?id='+this.sellerid+'">View Orders</a></td></tr> ');



                    count = count + 1;

                });





            } else {

                 successmsg(" No record found. please try again!");

            }



        }

    });

}



function seller_product(pagenov) {

    $.busyLoadFull("show");

    var perpage = $('#perpage').val();

    var grp = document.getElementById("selectgroup");

    var groupcatid = grp.options[grp.selectedIndex].value;

    var search_namevalue = $('#search_name').val();

    var count = 1;

    $.ajax({

        method: 'POST',

        url: 'get_seller_data.php',

        data: {

            code: code_ajax,

            page: pagenov,

            rowno: 0,

            perpage: perpage,

            seller_name: search_namevalue,

            groupid: groupcatid

        },

        success: function(response) {

            $.busyLoadFull("hide");

            var count = 1;

            var data = $.parseJSON(response);

            $("#tbodyPostid").empty();

            $("#totalrowvalue").html(data["totalrowvalue"]);

            $(".page_div").html(data["page_html"]);

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



                    $("#tbodyPostid").append('<tr id="tr'+this.id+'"> <td class="nr">' + this.bussname + '</td><td><b>Name :</b> '+this.fullname+'<br><b>Email :</b> '+this.email+'<br><b>Phone :</b> '+this.phone+'</td><td>' + this.total_price + '</td><td>' + this.total_profit + '</td><td> <a  class= "btn btn-dark waves-effect waves-light btn-sm pull-left" target="_blank" href="manage_seller_wise_transaction.php?id='+this.sellerid+'">View Orders</a></td></tr> ');



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

    var grp = document.getElementById("selectgroup");

    var groupcatid = grp.options[grp.selectedIndex].value;

    var search_namevalue = $('#search_name').val();

    var count = 1;

    $.ajax({

        method: 'POST',

        url: 'get_seller_data.php',

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



                   $("#tbodyPostid").append('<tr id="tr'+this.id+'"> <td class="nr">' + this.bussname + '</td><td><b>Name :</b> '+this.fullname+'<br><b>Email :</b> '+this.email+'<br><b>Phone :</b> '+this.phone+'</td><td>' + this.total_price + '</td><td>' + this.total_profit + '</td><td> <a  class= "btn btn-dark waves-effect waves-light btn-sm pull-left" target="_blank" href="manage_seller_wise_transaction.php?id='+this.sellerid+'">View Orders</a></td></tr> ');



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

    var count = 1;

    $.ajax({

        method: 'POST',

        url: 'get_seller_data.php',

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



                    $("#tbodyPostid").append('<tr id="tr'+this.id+'"> <td class="nr">' + this.sellerid + '</td><td>' + this.fullname + '</td><td>' + this.total_price + '</td><td>' + this.total_profit + '</td><td> <a  class= "btn btn-dark waves-effect waves-light btn-sm pull-left" target="_blank" href="manage_seller_wise_transaction.php?id='+this.sellerid+'">View Orders</a></td></tr> ');



                    count = count + 1;

                });





            } else {

                 successmsg(" No record found. please try again!");

            }



        }

    });

}







function editSeller(sellerid) {

    // successmsg(item);



    var mapForm = document.createElement("form");

    mapForm.target = "_self";

    mapForm.method = "POST"; // or "post" if appropriate

    mapForm.action = "edit_seller_profile.php";



    var mapInput = document.createElement("input");

    mapInput.type = "text";

    mapInput.name = "sellerid";

    mapInput.value = sellerid;

    mapForm.appendChild(mapInput);



    document.body.appendChild(mapForm);



    map = window.open("", "_self");



    if (map) {

        mapForm.submit();

    } else {

         successmsg('You must allow popups for this map to work.');

    }

}



    

function deleteCategory(seller_id){

        

		 xdialog.confirm('Are you sure want to delete All Seller Data?', function() {

          $.busyLoadFull("show");

            $.ajax({

                  method: 'POST',

                  url: 'delete_seller.php',

                  data: {code:code_ajax, seller_id: seller_id},

                  success: function(response){

					   $.busyLoadFull("hide");

					if(response =='Failed to Delete.'){

						successmsg("Failed to Delete.");

					}else if(response =='Deleted'){

						$("#tr"+seller_id).remove();

						successmsg("Seller Deleted Successfully.");

						var parentvalue = $("#last_cat").val();

						getCategoryclick(parentvalue);

					}else{

						$("#myModalbrandassign").modal('show');

						$("#myModalbrandassigndivy").html(response);

					}

                  }

                });

		 }, {

        style: 'width:420px;font-size:0.8rem;',

        buttons: {

            ok: 'yes ',

              cancel: 'no '

         },

        oncancel: function() {

             // console.warn('Cancelled!');

         }

 });

    }	



$(document).ready(function() {

    getSellerData(pageno, rowno);







    $("#searchName").click(function(event) {

        event.preventDefault();

        

        var perpage = $('#perpage').val();

        var grp = document.getElementById("selectgroup");

        var groupcatid = grp.options[grp.selectedIndex].value;

        var search_namevalue = $('#search_name').val();

        var count = 1;

        

        if(!search_namevalue){

            successmsg('Please enter search string.');

        }else{

         $.busyLoadFull("show");

        $.ajax({

            method: 'POST',

            url: 'get_seller_data.php',

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

                $("#tbodyPostid").empty();

                $("#totalrowvalue").html(data["totalrowvalue"]);

                $(".page_div").html(data["page_html"]);

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



                     	 $("#tbodyPostid").append('<tr id="tr'+this.id+'"> <td class="nr">' + this.bussname + '</td><td><b>Name :</b> '+this.fullname+'<br><b>Email :</b> '+this.email+'<br><b>Phone :</b> '+this.phone+'</td><td>' + this.total_price + '</td><td>' + this.total_profit + '</td><td> <a  class= "btn btn-dark waves-effect waves-light btn-sm pull-left" target="_blank" href="manage_seller_wise_transaction.php?id='+this.sellerid+'">View Orders</a></td></tr> ');



                        count = count + 1;

                    });





                } else {

                    successmsg(" No record found. please try again!");

                }



            }

        });

        

        }



    });



});


function view_seller(id){

		window.open('manage_seller_wise_transaction.php?id='+id,

  '_blank'

);

}