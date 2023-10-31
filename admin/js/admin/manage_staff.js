var code_ajax = $("#code_ajax").val();
var pageno = 1;
var rowno = 0;


function getSellerData(pagenov, rownov) {
    $.busyLoadFull("show");
    var perpage = $('#perpage').val();

    var search_string = $('#search_name').val();
    $.ajax({
        method: 'POST',
        url: 'get_staff_data.php',
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

                    $("#tbodyPostid").append('<tr id="tr' + this.user_unique_id + '"> <td class="nr">' + this.user_unique_id + '</td><td>' + this.fullname + '</td> <td>' + this.email + '</td> <td class="stk" > ' + this.phone + '</td><td> ' + this.role + '</td><td>' + btnactive + '</td><td><button type = "button" class = "btn btn-danger waves-effect waves-light btn-sm pull-left" onclick = \'deleteRecord("' + this.user_unique_id + '");\'>' + "Delete" + '</button>	<button type = "button" class = "btn btn-dark waves-effect waves-light btn-sm " style=" margin-left: 10px;"  onclick = \'editRecord("' + this.user_unique_id + '");\'>' + "Edit" + '</button> </td></tr> ');

                    count = count + 1;
                });


            } else {
                $("#tbodyPostid").append("No record found.");
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
        url: 'get_staff_data.php',
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

                    $("#tbodyPostid").append('<tr id="tr' + this.user_unique_id + '"> <td class="nr">' + this.user_unique_id + '</td><td>' + this.fullname + '</td> <td>' + this.email + '</td> <td class="stk" > ' + this.phone + '</td><td> ' + this.role + '</td><td>' + btnactive + '</td><td><button type = "button" class = "btn btn-danger waves-effect waves-light btn-sm pull-left" onclick = \'deleteRecord("' + this.user_unique_id + '");\'>' + "Delete" + '</button>	<button type = "button" class = "btn btn-dark waves-effect waves-light btn-sm " style=" margin-left: 10px;"  onclick = \'editRecord("' + this.user_unique_id + '");\'>' + "Edit" + '</button> </td></tr> ');

                    count = count + 1;
                });


            } else {
                $("#tbodyPostid").append("No record found.");
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
        url: 'get_staff_data.php',
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

                    $("#tbodyPostid").append('<tr id="tr' + this.user_unique_id + '"> <td class="nr">' + this.user_unique_id + '</td><td>' + this.fullname + '</td> <td>' + this.email + '</td> <td class="stk" > ' + this.phone + '</td><td> ' + this.role + '</td><td>' + btnactive + '</td><td><button type = "button" class = "btn btn-danger waves-effect waves-light btn-sm pull-left" onclick = \'deleteRecord("' + this.user_unique_id + '");\'>' + "Delete" + '</button>	<button type = "button" class = "btn btn-dark waves-effect waves-light btn-sm " style=" margin-left: 10px;"  onclick = \'editRecord("' + this.user_unique_id + '");\'>' + "Edit" + '</button> </td></tr> ');

                    count = count + 1;
                });


            } else {
                $("#tbodyPostid").append("No record found.");
            }

        }
    });
}


function editRecord(user_unique_id) {
    //successmsg(item);

    var mapForm = document.createElement("form");
    mapForm.target = "_self";
    mapForm.method = "POST"; // or "post" if appropriate
    mapForm.action = "edit_staff_user_data.php";

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

function deleteRecord(user_id) {

    xdialog.confirm('Are you sure want to delete?', function () {
        $.busyLoadFull("show");
        $.ajax({
            method: 'POST',
            url: 'delete_staff_data.php',
            data: { code: code_ajax, user_id: user_id, type: "delete" },
            success: function (response) {
                $.busyLoadFull("hide");
                if (response == 'Failed to Delete.') {
                    successmsg("Failed to Delete.");
                } else if (response == 'Deleted') {
                    $("#tr" + user_id).remove();
                    successmsg("User Deleted Successfully.");
                    var parentvalue = $("#last_cat").val();
                    getrolesclick(parentvalue);
                }
            }
        });
    }, {
        style: 'width:420px;font-size:0.8rem;',
        buttons: {
            ok: 'yes ',
            cancel: 'no '
        },
        oncancel: function () {
            // console.warn('Cancelled!');
        }
    });
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
                url: 'get_staff_data.php',
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

                            $("#tbodyPostid").append('<tr id="tr' + this.user_unique_id + '"> <td class="nr">' + this.user_unique_id + '</td><td>' + this.fullname + '</td> <td>' + this.email + '</td> <td class="stk" > ' + this.phone + '</td><td> ' + this.role + '</td><td>' + btnactive + '</td><td><button type = "button" class = "btn btn-danger waves-effect waves-light btn-sm pull-left" onclick = \'deleteRecord("' + this.user_unique_id + '");\'>' + "Delete" + '</button>	<button type = "button" class = "btn btn-dark waves-effect waves-light btn-sm " style=" margin-left: 10px;"  onclick = \'editRecord("' + this.user_unique_id + '");\'>' + "Edit" + '</button> </td></tr> ');

                            count = count + 1;
                        });


                    } else {
                        $("#tbodyPostid").append("No record found.");
                    }

                }

            });
        }
    });




});
