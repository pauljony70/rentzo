var code_ajax = $("#code_ajax").val();
var pageno = 1;
var rowno = 0;


function getAttribute(pagenov, rownov) {
    $.busyLoadFull("show");
    var perpage = $('#perpage').val();
    // successmsg( "sdfs" );
    var count = 1;
    $.ajax({
        method: 'POST',
        url: 'get_attribute_set_data.php',
        data: {
            code: code_ajax,
            page: pagenov,
            rowno: rownov,
            perpage: perpage
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
                    btnactive = '<spanclass = "Active">' + "Active " + '</span>';
                } else if (this.statuss == "3") {
                    btnactive = '<span class = "Deactive">' + "Deactive" + '</span>';
                }
                var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.name + '</td><td > ' + btnactive + '</td>';
                html += '</tr>';
                $("#cat_list").append(html);

                count = count + 1;
            });

        }
    });
}


function attribute_set_product(pagenov) {
    $.busyLoadFull("show");
    var perpage = $('#perpage').val();
    // successmsg( "sdfs" );
    var count = 1;
    $.ajax({
        method: 'POST',
        url: 'get_attribute_set_data.php',
        data: {
            code: code_ajax,
            page: pagenov,
            rowno: 0,
            perpage: perpage
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
                    btnactive = '<spanclass = "Active">' + "Active " + '</span>';
                } else if (this.statuss == "3") {
                    btnactive = '<span class = "Deactive">' + "Deactive" + '</span>';
                }
                var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.name + '</td><td > ' + btnactive + '</td>';
                html += '</tr>';
                $("#cat_list").append(html);

                count = count + 1;
            });



        }
    });
}


$(document).ready(function () {
    getAttribute(pageno, rowno);


    $("#add_attribute_btn").click(function (event) {
        event.preventDefault();

        var namevalue = $('#name').val();

        if (!namevalue) {
            successmsg("Please enter Brand Name");
        }

        if (namevalue) {
            $.busyLoadFull("show");
            var form_data = new FormData();
            form_data.append('namevalue', namevalue);
            form_data.append('code', code_ajax);

            $.ajax({
                method: 'POST',
                url: 'add_attribute_set_process.php',
                data: form_data,
                contentType: false,
                processData: false,
                success: function (response) {
                    $.busyLoadFull("hide");
                    $("#myModal").modal('hide');
                    $('#name').val('');
                    getAttribute(1, 0)
                    successmsg(response);
                    $('#name').val('');
                }
            });
        }

    });



});



function perpage_filter() {
    $.busyLoadFull("show");
    var perpage = $('#perpage').val();
    // successmsg( "sdfs" );
    var count = 1;
    $.ajax({
        method: 'POST',
        url: 'get_attribute_set_data.php',
        data: {
            code: code_ajax,
            page: 1,
            rowno: 0,
            perpage: perpage
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
                var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.name + '</td><td > ' + btnactive + '</td>';
                html += '</tr>';
                $("#cat_list").append(html);

                count = count + 1;
            });



        }
    });
}

