var code_ajax = $("#code_ajax").val();
var pageno = 1;
var rowno = 0;
var status = 0;


function getReview(pagenov, rownov) {
    $.busyLoadFull("show");
    var perpage = $('#perpage').val();
    // successmsg( "sdfs" );
    var count = 1;
    $.ajax({
        method: 'POST',
        url: 'get_product_review_data.php',
        data: {
            code: code_ajax,
            page: pagenov,
            rowno: rownov,
            perpage: perpage,
            type: "get"
        },
        success: function (response) {
            $.busyLoadFull("hide");
            var parsedJSON = $.parseJSON(response);
            $("#cat_list").empty();

            $("#totalrowvalue").html(parsedJSON["totalrowvalue"]);
            $(".page_div").html(parsedJSON["page_html"]);

            var data = parsedJSON.data;
            $(data).each(function () {
                var btnactive = "";
                if (this.statuss == "0") {
                    btnactive = '<span class = "Pending">' + "Pending" + '</span>';
                } else if (this.statuss == "1") {
                    btnactive = '<span class = "Active">' + "Active " + '</span>';
                } else if (this.statuss == "3") {
                    btnactive = '<span class = "Deactive">' + "Deactive" + '</span>';
                }
                var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td>' + this.fullname + '</td><td > ' + this.prod_name + '</td><td > ' + this.title + '</td><td > ' + this.rating + '</td><td > ' + btnactive + '</td>';
                html += '<td> <button type="submit" class= "btn btn-dark waves-effect waves-light btn-sm pull-left" name="View" onclick="viewReview(' + this.id + ');">View</button>';

                html += '</td></tr>';
                $("#cat_list").append(html);

                count = count + 1;
            });



        }
    });
}


function product_review(pagenov) {
    $.busyLoadFull("show");
    var perpage = $('#perpage').val();
    // successmsg( "sdfs" );
    var count = 1;
    $.ajax({
        method: 'POST',
        url: 'get_product_review_data.php',
        data: {
            code: code_ajax,
            page: pagenov,
            rowno: 0,
            perpage: perpage,
            type: "get"
        },
        success: function (response) {
            $.busyLoadFull("hide");
            var parsedJSON = $.parseJSON(response);
            $("#cat_list").empty();

            $("#totalrowvalue").html(parsedJSON["totalrowvalue"]);
            $(".page_div").html(parsedJSON["page_html"]);

            var data = parsedJSON.data;
            $(data).each(function () {

                var btnactive = "";
                if (this.statuss == "0") {
                    btnactive = '<span class = "Pending">' + "Pending" + '</span>';
                } else if (this.statuss == "1") {
                    btnactive = '<span class = "Active">' + "Active " + '</span>';
                } else if (this.statuss == "3") {
                    btnactive = '<span class = "Deactive">' + "Deactive" + '</span>';
                }
                var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td>' + this.fullname + '</td><td > ' + this.prod_name + '</td><td > ' + this.title + '</td><td > ' + this.rating + '</td><td > ' + btnactive + '</td>';
                html += '<td> <button type="submit" class= "btn btn-dark waves-effect waves-light btn-sm pull-left" name="View" onclick="viewReview(' + this.id + ');">View</button>';

                html += '</td></tr>';

                $("#cat_list").append(html);

                count = count + 1;
            });



        }
    });
}


$(document).ready(function () {
    getReview(pageno, rowno);

});



function perpage_filter() {
    $.busyLoadFull("show");
    var perpage = $('#perpage').val();
    // successmsg( "sdfs" );
    var count = 1;
    $.ajax({
        method: 'POST',
        url: 'get_product_review_data.php',
        data: {
            code: code_ajax,
            page: 1,
            rowno: 0,
            perpage: perpage,
            type: "get"
        },
        success: function (response) {
            $.busyLoadFull("hide");
            var parsedJSON = $.parseJSON(response);
            $("#cat_list").empty();


            $("#totalrowvalue").html(parsedJSON["totalrowvalue"]);
            $(".page_div").html(parsedJSON["page_html"]);

            var data = parsedJSON.data;
            $(data).each(function () {
                var btnactive = "";
                if (this.statuss == "0") {
                    btnactive = '<span class = "Pending">' + "Pending" + '</span>';
                } else if (this.statuss == "1") {
                    btnactive = '<span class = "Active">' + "Active " + '</span>';
                } else if (this.statuss == "3") {
                    btnactive = '<span class = "Deactive">' + "Deactive" + '</span>';
                }
                var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td>' + this.fullname + '</td><td > ' + this.prod_name + '</td><td > ' + this.title + '</td><td > ' + this.rating + '</td><td > ' + btnactive + '</td>';
                html += '<td> <button type="submit" class= "btn btn-dark waves-effect waves-light btn-sm pull-left" name="View" onclick="viewReview(' + this.id + ');">View</button>';

                html += '</td></tr>';

                $("#cat_list").append(html);

                count = count + 1;
            });
        }
    });
}

function viewReview(id) {
    if (id) {
        $.busyLoadFull("show");
        $.ajax({
            method: 'POST',
            url: 'get_product_review_data.php',
            data: { deletearray: id, code: code_ajax, type: "view" },
            success: function (response) {
                $.busyLoadFull("hide");
                $("#myModal").modal('show');
                var parsedJSON = $.parseJSON(response);
                var data = parsedJSON.data[0];
                $("#user_name").val(data.fullname);
                $("#product_name").val(data.prod_name);
                $("#review_title").val(data.title);
                $("#review_rating").val(data.rating);
                $("#review_comment").val(data.comment);
                $("#review_ids").val(data.id);
                $("#product_ids").val(data.product_id);
            }
        });
    }

}


function approve_review() {
    var review_ids = $("#review_ids").val();
    var product_ids = $("#product_ids").val();
    if (review_ids) {
        xdialog.confirm('Are you sure want to approve?', function () {
            $.busyLoadFull("show");
            $.ajax({
                method: 'POST',
                url: 'get_product_review_data.php',
                data: { deletearray: review_ids, code: code_ajax, type: "approve", product_ids: product_ids },
                success: function (response) {
                    $.busyLoadFull("hide");
                    $("#myModal").modal('hide');
                    getReview(pageno, rowno);
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
}


function reject_review() {
    var review_ids = $("#review_ids").val();
    var product_ids = $("#product_ids").val();
    if (review_ids) {
        xdialog.confirm('Are you sure want to delete?', function () {
            $.busyLoadFull("show");
            $.ajax({
                method: 'POST',
                url: 'get_product_review_data.php',
                data: { deletearray: review_ids, code: code_ajax, type: "delete", product_ids: product_ids },
                success: function (response) {
                    $.busyLoadFull("hide");
                    $("#myModal").modal('hide');
                    getReview(pageno, rowno);
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
}
