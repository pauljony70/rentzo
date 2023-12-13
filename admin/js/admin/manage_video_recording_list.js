var code_ajax = $("#code_ajax").val();
var pageno = 1;
var rowno = 0;

function getSellerData(pagenov, rownov) {
    $.busyLoadFull("show");
    var perpage = $('#perpage').val();

    var search_string = $('#search_name').val();
    $.ajax({
        method: 'POST',
        url: 'get_video_recording_list_data.php',
        data: {
            code: code_ajax,
            page: pagenov,
            rowno: rownov,
            perpage: perpage,
            search_string: search_string
        },
        success: function (response) {
            $.busyLoadFull("hide");
            var count = 1;
            var data = $.parseJSON(response);
            $("#tbodyPostid").empty();
            $("#totalrowvalue").html(data["totalrowvalue"]);
            $(".page_div").html(data["page_html"]);
            if (data["status"] == "1") {


                searchenable = false;

                $(data["details"]).each(function () {
                    //	successmsg(this.statuss);
                    var btnactive = "";
                    if (this.statuss == "0") {
                        btnactive = '<span class = "Pending">' + "Pending" + '</span>';
                    } else if (this.statuss == "1") {
                        btnactive = '<spanclass = "Active">' + "Active " + '</span>';
                    } else if (this.statuss == "3") {
                        btnactive = '<span class = "Deactive">' + "Deactive" + '</span>';
                    }

                    $("#tbodyPostid").append('<tr> <td class="nr">' + count + '</td><td>' + this.order_id + '</td>  <td class="stk" > ' + this.product_id + '</td><td>' + this.duration + '</td><td> ' + this.video_link + '</td><td> ' + this.created_at + '</td></tr> ');

                    count = count + 1;	
                });


            } else {
                successmsg("No record found. please try again!");
            }

        }
    });
}

function appuser_page(pagenov) {
    $.busyLoadFull("show");
    var perpage = $('#perpage').val();

    var search_string = $('#search_name').val();
    var count = 1;
    $.ajax({
        method: 'POST',
        url: 'get_video_recording_list_data.php',
        data: {
            code: code_ajax,
            page: pagenov,
            rowno: 0,
            perpage: perpage,
            search_string: search_string

        },
        success: function (response) {
            $.busyLoadFull("hide");
            var count = 1;
            var data = $.parseJSON(response);
            $("#tbodyPostid").empty();
            $("#totalrowvalue").html(data["totalrowvalue"]);
            $(".page_div").html(data["page_html"]);
            if (data["status"] == "1") {


                searchenable = false;

                $(data["details"]).each(function () {
                    //	successmsg(this.statuss);
                    var btnactive = "";
                    if (this.statuss == "0") {
                        btnactive = '<span class = "Pending">' + "Pending" + '</span>';
                    } else if (this.statuss == "1") {
                        btnactive = '<spanclass = "Active">' + "Active " + '</span>';
                    } else if (this.statuss == "3") {
                        btnactive = '<span class = "Deactive">' + "Deactive" + '</span>';
                    }

                      $("#tbodyPostid").append('<tr> <td class="nr">' + count + '</td><td>' + this.order_id + '</td>  <td class="stk" > ' + this.product_id + '</td><td>' + this.duration + '</td><td> ' + this.video_link + '</td><td> ' + this.created_at + '</td></tr> ');

                    count = count + 1;
                });


            } else {
                successmsg("No record found. please try again!");
            }

        }
    });
}


function perpage_filter() {
    $.busyLoadFull("show");
    var perpage = $('#perpage').val();

    var search_string = $('#search_name').val();
    var count = 1;
    $.ajax({
        method: 'POST',
        url: 'get_video_recording_list_data.php',
        data: {
            code: code_ajax,
            page: 1,
            rowno: 0,
            perpage: perpage,
            search_string: search_string
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
                    //	successmsg(this.statuss);
                    var btnactive = "";
                    var btnactive = "";
                    if (this.statuss == "0") {
                        btnactive = '<span class = "Pending">' + "Pending" + '</span>';
                    } else if (this.statuss == "1") {
                        btnactive = '<spanclass = "Active">' + "Active " + '</span>';
                    } else if (this.statuss == "3") {
                        btnactive = '<span class = "Deactive">' + "Deactive" + '</span>';
                    }

                     $("#tbodyPostid").append('<tr> <td class="nr">' + count + '</td><td>' + this.order_id + '</td>  <td class="stk" > ' + this.product_id + '</td><td>' + this.duration + '</td><td> ' + this.video_link + '</td><td> ' + this.created_at + '</td></tr> ');

                    count = count + 1;
                });


            } else {
                successmsg("No record found. please try again!");
            }

        }
    });
}


function editRecord(user_unique_id) {
    //successmsg(item);

    var mapForm = document.createElement("form");
    mapForm.target = "_self";
    mapForm.method = "POST"; // or "post" if appropriate
    mapForm.action = "edit_user_profile.php";

    var mapInput = document.createElement("input");
    mapInput.type = "text";
    mapInput.name = "user_unique_id";
    mapInput.value = user_unique_id;
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
    getSellerData(pageno, rowno);


    $("#searchName").click(function (event) {
        event.preventDefault();
        var perpage = $('#perpage').val();

        var search_string = $('#search_string').val();
        if (!search_string) {
            successmsg("Please enter Search text");
        } else {
            $.busyLoadFull("show");
            var count = 1;
            $.ajax({
                method: 'POST',
                url: 'get_video_recording_list_data.php',
                data: {
                    code: code_ajax,
                    page: 1,
                    rowno: 0,
                    perpage: perpage,
                    search_string: search_string
                },
                success: function (response) {
                    $.busyLoadFull("hide");
                    var count = 1;
                    var data = $.parseJSON(response);
                    $("#tbodyPostid").empty();
                    $("#totalrowvalue").html(data["totalrowvalue"]);
                    $(".page_div").html(data["page_html"]);
                    if (data["status"] == "1") {


                        searchenable = false;

                        $(data["details"]).each(function () {
                            //	successmsg(this.statuss);
                            var btnactive = "";
                            if (this.statuss == "0") {
                                btnactive = '<span class = "Pending">' + "Pending" + '</span>';
                            } else if (this.statuss == "1") {
                                btnactive = '<spanclass = "Active">' + "Active " + '</span>';
                            } else if (this.statuss == "3") {
                                btnactive = '<span class = "Deactive">' + "Deactive" + '</span>';
                            }

                            $("#tbodyPostid").append('<tr> <td class="nr">' + count + '</td><td>' + this.order_id + '</td>  <td class="stk" > ' + this.product_id + '</td><td>' + this.duration + '</td><td> ' + this.video_link + '</td><td> ' + this.created_at + '</td></tr> ');

                            count = count + 1;
                        });


                    } else {
                        successmsg("No record found. please try again!");
                    }

                }

            });
        }
    });




});
