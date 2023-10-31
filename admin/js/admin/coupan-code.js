var code_ajax = $("#code_ajax").val();
var pageno = 1;
var rowno = 0;


function getBanners(pagenov, rownov) {
   $.busyLoadFull("show");
    var perpage = $('#perpage').val();
    // successmsg( "sdfs" );
    var count = 1;
    $.ajax({
        method: 'POST',
        url: 'get_coupancode_data.php',
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

            var total_records = parsedJSON["totalrowvalue"];
            $("#totalrowvalue").html(total_records);
            $(".page_div").html(parsedJSON["page_html"]);
            var data = parsedJSON.data;
            $(data).each(function () {

                var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.name + '</td><td> ' + this.value + '</td> <td> ' + this.cap_value + '</td><td> ' + this.minorder + '</td><td> ' + this.fromdate + '</td><td> ' + this.todate + '</td><td> ' + this.user_apply + '</td><td  id="statustd' + this.id + '"> ' + this.activate + '</td> <td> <div class="dropdown"> <button class="btn btn-dark waves-effect waves-light dropdown-toggle w-100" type="button" data-toggle="dropdown">Select<span class="caret"></span></button> <div class="dropdown-menu dropdown-menu-right"> ';

                if (this.activate == 'active') {
                    var deactive = 'deactive';
                    html += '<a class="dropdown-item" href="javascript: void(0);" id="editbtn' + this.id + '" name="edit" onclick="editBanners(' + this.id + ',\'' + deactive + '\');"><i class="fa-regular fa-circle-xmark"></i> Deactive</a>';
                } else {
                    var active = 'active';
                    html += '<a class="dropdown-item" href="javascript: void(0);" id="editbtn' + this.id + '" name="edit" onclick="editBanners(' + this.id + ',\'' + active + '\');"><i class="fa-regular fa-circle-check"></i> Active</a>';
                }
                html += '<a class="dropdown-item" href="javascript: void(0);" id="deletebtn' + this.id + '" name="delete" onclick="deleteBanners(' + this.id + ');"><i class="fa fa-trash"></i> Delete</a>';

                html += '</div></div></td></tr>';
                
                $("#cat_list").append(html);

                count = count + 1;
            });

        }
    });
}

function perpage_filter() {
   $.busyLoadFull("show");
    var perpage = $('#perpage').val();
    // successmsg( "sdfs" );
    var count = 1;
    $.ajax({
        method: 'POST',
        url: 'get_coupancode_data.php',
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

            var total_records = parsedJSON["totalrowvalue"];
            $("#totalrowvalue").html(total_records);
            $(".page_div").html(parsedJSON["page_html"]);
            var data = parsedJSON.data;
            $(data).each(function () {

                var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.name + '</td><td> ' + this.value + '</td> <td> ' + this.cap_value + '</td><td> ' + this.minorder + '</td><td> ' + this.fromdate + '</td><td> ' + this.todate + '</td><td> ' + this.user_apply + '</td><td id="statustd' + this.id + '"> ' + this.activate + '</td> ';
                if (this.activate == 'active') {
                    var deactive = 'deactive';
                    html += '<td> <button type="submit" class= "btn btn-dark waves-effect waves-light btn-sm pull-left" id="editbtn' + this.id + '" name="edit" onclick="editBanners(' + this.id + ',\'' + deactive + '\');">Deactive</button>';
                } else {
                    var active = 'active';
                    html += '<td> <button type="submit" class= "btn btn-dark waves-effect waves-light btn-sm pull-left" id="editbtn' + this.id + '" name="edit" onclick="editBanners(' + this.id + ',\'' + active + '\');">Active</button>';
                }
                html += '<button style=" margin-left: 10px;" type="submit" class= "btn btn-danger btn-sm pull-left" name="delete"  id="deletebtn' + this.id + '" onclick="deleteBanners(' + this.id + ');">DELETE</button>';

                html += '</td></tr>';
                $("#cat_list").append(html);

                count = count + 1;
            });



        }
    });
}

function brand_product(pagenov) {
   $.busyLoadFull("show");
    var perpage = $('#perpage').val();
    // successmsg( "sdfs" );
    var count = 1;
    $.ajax({
        method: 'POST',
        url: 'get_coupancode_data.php',
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

            var total_records = parsedJSON["totalrowvalue"];
            $("#totalrowvalue").html(total_records);
            $(".page_div").html(parsedJSON["page_html"]);
            var data = parsedJSON.data;
            $(data).each(function () {

                var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.name + '</td><td> ' + this.value + '</td> <td> ' + this.cap_value + '</td><td> ' + this.minorder + '</td><td> ' + this.fromdate + '</td><td> ' + this.todate + '</td><td> ' + this.user_apply + '</td><td> ' + this.activate + '</td> ';
                html += '<td> <button type="submit" class= "btn btn-dark waves-effect waves-light btn-sm pull-left" id="editbtn' + this.id + '" name="edit" onclick="editBanners(' + this.id + ', ' + this.cat_order + ', ' + total_records + ');">Deactive</button>';
                html += '<button style=" margin-left: 10px;" type="submit" class= "btn btn-danger btn-sm pull-left" name="delete"  id="deletebtn' + this.id + '" onclick="deleteBanners(' + this.id + ');">DELETE</button>';

                html += '</td></tr>';
                $("#cat_list").append(html);

                count = count + 1;
            });



        }
    });
}


function deleteBanners(id) {

    xdialog.confirm('Are you sure want to delete?', function () {
       $.busyLoadFull("show");
        $.ajax({
            method: 'POST',
            url: 'get_coupancode_data.php',
            data: { deletearray: id, code: code_ajax },
            success: function (response) {
                $.busyLoadFull("hide");
                if (response == 'Failed to Delete.') {
                    successmsg("Failed to Delete.");
                } else if (response == 'Deleted') {
                    $("#tr" + id).remove();
                    successmsg("Coupon Deleted Successfully.");
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

function editBanners(id, status) {

    xdialog.confirm('Are you sure want to ' + status + '?', function () {
       $.busyLoadFull("show");
        $.ajax({
            method: 'POST',
            url: 'get_coupancode_data.php',
            data: { deactiveid: id, code: code_ajax, status: status },
            success: function (response) {
                $.busyLoadFull("hide");
                if (response == 'Failed to Delete.') {
                    successmsg("Failed to Delete.");
                } else if (response == 'done') {
                    successmsg("Coupon Status changed Successfully.");
                    var page = $(".pagination .active .current").text();
                    getBanners(page, 0);
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
    getBanners(pageno, rowno);

    $("#addCoupan").click(function (event) {
        event.preventDefault();
        var code_ajax = $("#code_ajax").val();
        var name_value = $('#cname').val();
        var value_value = $('#cvalue').val();
        var capvalue_value = $('#capvalue').val();
        var minorder_value = $('#minorder').val();
        var fromdate_value = $('#fromdate').val();
        var todate_value = $('#todate').val();
        var counapm_type = $('#counapm_type').val();
        var user_apply = $('#user_apply').val();

        if (name_value == "" || name_value == null) {
            successmsg("Coupan Code is empty");
        } else if (value_value == "" || value_value == null) {
            successmsg("Coupan Discount in empty");
        } else if (value_value == "" || value_value == null) {
            successmsg("Coupan Discount in empty");
        } else if (user_apply == "" || user_apply == null) {
            successmsg("Please enter No. of times user apply");
        } else if (fromdate_value == "" || fromdate_value == null) {
            successmsg("Please select Start Date");
        } else if (todate_value == "" || todate_value == null) {
            successmsg("Please select End Date");
        } else {
           $.busyLoadFull("show");
            $.ajax({
                method: 'POST',
                url: 'add_coupan_process.php',
                data: {
                    coupancode: name_value,
                    cvalue: value_value,
                    capvalue: capvalue_value,
                    minorder: minorder_value,
                    fromdate: fromdate_value,
                    todate: todate_value,
                    coupon_type: counapm_type,
                    user_apply: user_apply,
                    code: code_ajax
                },
                success: function (response) {
                    $.busyLoadFull("hide");
                    $("#myModal").modal('hide');
                    getBanners(1, 0);
                    successmsg(response);
                    $('#add_brand_form')[0].reset();

                }
            });
        }
    });
});