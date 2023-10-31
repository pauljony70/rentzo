<?php
include('session.php');

if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
}

$sellerid = $_SESSION['admin'];


?>
<?php include("header.php");
$cname = "";
$fname = "";
$address = "";
$desc = "";
$city = "";
$pincode = "";
$state = "";
$country = "";
$phone = "";
$email = "";
$logo = "";
$website = "";
$tax = "";
$grpid = "";
$status = "";
$flagid = "";
$createby = "";
$update_by = "";
$pan_card = "";
$aadhar_card = $pan_number = $cin_number = $seller_banner = "";

$stmt = $conn->prepare("SELECT sellerid, companyname, fullname, address, description, city, pincode, state, country, phone, email, logo, websiteurl,
						tax_number, groupid, status, flagid, create_by, update_by,pan_card,aadhar_card,business_proof,pan_number,cin_number,seller_banner FROM sellerlogin WHERE seller_unique_id=?");
$stmt->bind_param("s", $sellerid);
$stmt->execute();
$data = $stmt->bind_result(
    $col1,
    $col2,
    $col3,
    $col4,
    $col5,
    $col6,
    $col7,
    $col8,
    $col9,
    $col10,
    $col11,
    $col12,
    $col13,
    $col14,
    $col15,
    $col17,
    $col18,
    $col19,
    $col20,
    $col21,
    $col22,
    $col23,
    $col24,
    $col25,
    $col26
);

$return = array();

while ($stmt->fetch()) {
    $cname = $col2;
    $fname = $col3;
    $address = $col4;
    $desc = $col5;
    $city = $col6;
    $pincode = $col7;
    $state = $col8;
    $country = $col9;
    $phone = $col10;
    $email = $col11;
    $logo = $col12;
    $website = $col13;
    $tax = $col14;
    $grpid = $col15;
    $status = $col17;
    $flagid = $col18;
    $createby = $col19;
    $update_by = $col20;
    $pan_card = $col21;
    $aadhar_card = $col22;
    $business_proof = $col23;
    $pan_number = $col24;
    $cin_number = $col25;
    $seller_banner = $col26;
}

?>

<script>
    var code_ajax = $("#code_ajax").val();
    $(document).ready(function() {
        var id = 1;
        getSellerGroupdata();
        getcountrydata();

    });

    function getcountrydata() {
        //   successmsg("prod id "+item );
        $.ajax({
            method: 'POST',
            url: 'get_country.php',
            data: {
                code: code_ajax
            },
            success: function(response) {
                // successmsg(response); // display response from the PHP script, if any
                var data = $.parseJSON(response);
                $('#selectcountry').empty();
                $('#selectstate').empty();
                $('#selectcity').empty();
                //                    .append('<option selected="selected" value="whatever">text</option>') ;    

                if (data["status"] == "1") {
                    $getstate = true;
                    $(data["data"]).each(function() {
                        //	successmsg(this.name);
                        var countryid = <?php print($country); ?>;
                        $firstitemid = 0;
                        $firstitemflag = true;
                        if (countryid === this.id) {
                            // successmsg("match==="+countryid);
                            var o = new Option(this.name, this.id);
                            $("#selectcountry").append(o);
                            $('#selectcountry').val(this.id);
                            $getstate = false;
                            getStatedata(this.id);
                        } else {
                            var o = new Option(this.name, this.id);
                            $("#selectcountry").append(o);
                        }

                        if ($firstitemflag == true) {
                            $firstitemflag = false;
                            $firstitemid = this.id;
                        }


                    });
                    if ($getstate == true) {
                        $getstate = false;
                        getStatedata($firstitemid);
                    }

                } else {
                    successmsg(data["msg"]);
                }
            }
        });

        $('#selectcountry').on('change', function() {
            //successmsg("cahnge"+ this.value );
            getStatedata(this.value);
        });
    }
</script>

<script>
    function getStatedata(countryid) {
        //   successmsg("prod id "+item );
        $.ajax({
            method: 'POST',
            url: 'get_state.php',
            data: {
                code: code_ajax,
                countryid: countryid
            },
            success: function(response) {
                // successmsg(response); // display response from the PHP script, if any
                var data = $.parseJSON(response);
                $('#selectstate').empty();
                $('#selectcity').empty();
                //                      .append('<option selected="selected" value="blank">Select</option>') ;    

                if (data["status"] == "1") {
                    $getcity = true;
                    var stateid = <?php print($state); ?>; // <?php $state; ?>;
                    $firstitemid = 0;
                    $firstitemflag = true;
                    //  successmsg('<?php echo "some info"; ?>');
                    // successmsg("state "+ stateid );
                    $(data["data"]).each(function() {
                        //	successmsg(this.id +"--"+stateid+"--");
                        if (stateid === this.id) {
                            // successmsg("match==="+stateid);
                            var o = new Option(this.name, this.id);
                            $("#selectstate").append(o);
                            $('#selectstate').val(this.id);
                            $getcity = false;
                            getCitydata(this.id);
                        } else {
                            var o = new Option(this.name, this.id);
                            $("#selectstate").append(o);
                        }

                        if ($firstitemflag == true) {
                            $firstitemflag = false;
                            $firstitemid = this.id;
                        }
                    });

                    if ($getcity == true) {
                        $getcity = false;
                        getCitydata($firstitemid);
                    }

                } else {
                    successmsg(data["msg"]);
                }
            }
        });


        $('#selectstate').on('change', function() {
            //successmsg("cahnge"+ this.value );
            getCitydata(this.value);
        });
    }
</script>

<script>
    function getCitydata(stateid) {
        // successmsg("state id "+stateid );
        $.ajax({
            method: 'POST',
            url: 'get_city.php',
            data: {
                code: code_ajax,
                stateid: stateid
            },
            success: function(response) {
                // successmsg(response); // display response from the PHP script, if any
                var data = $.parseJSON(response);
                $('#selectcity').empty();
                //                      .append('<option selected="selected" value="blank">Select</option>') ;    

                if (data["status"] == "1") {
                    var cityid = <?php print($city); ?>;

                    $(data["data"]).each(function() {
                        //	successmsg(this.name+"---"+cityid);
                        if (cityid === this.id) {
                            // successmsg("match==="+stateid);
                            var o = new Option(this.name, this.id);
                            $("#selectcity").append(o);
                            $('#selectcity').val(this.id);

                        } else {
                            var o = new Option(this.name, this.id);
                            $("#selectcity").append(o);
                        }
                        //	var o = new Option(this.name, this.id);
                        //   $("#selectcity").append(o);
                        // pass PHP variable declared above to JavaScript variable

                    });

                } else {
                    successmsg(data["msg"]);
                }
            }
        });
    }
</script>

<script>
    function getSellerGroupdata() {
        // successmsg("state id "+stateid );
        $.ajax({
            method: 'POST',
            url: 'get_sellergroup.php',
            data: {
                code: code_ajax
            },
            success: function(response) {
                // successmsg(response); // display response from the PHP script, if any
                var data = $.parseJSON(response);
                $('#sellergroup').empty();
                //                      .append('<option selected="selected" value="blank">Select</option>') ;    

                if (data["status"] == "1") {

                    $(data["data"]).each(function() {
                        //	successmsg(this.name);
                        var o = new Option(this.name, this.id);
                        $("#sellergroup").append(o);
                    });

                } else {
                    successmsg(data["msg"]);
                }
            }
        });
    }
</script>

<script>
    $(document).ready(function() {
        $("#addProduct").click(function(event) {
            event.preventDefault();

            var selleridvalue = $('#sellerid').val();

            var seller_namevalue = $('#seller_name').val();
            var company_namevalue = $('#business_name').val();
            var business_addressvalue = $('#business_address').val();
            var business_detailsvalue = $('#business_details').val();
            var pincodevalue = $('#pincode').val();
            var phonevalue = $('#phone').val();
            var emailvalue = $('#email').val();
            var websitevalue = $('#website').val();
            var gstvalue = $('#gst').val();
            var pan = $('#pan_number').val();
            var cin_number = $('#cin_number').val();


            var grp = document.getElementById("sellergroup");
            var sellergroupvalue = grp.options[grp.selectedIndex].value;

            var ctr = document.getElementById("selectcountry");
            var countryvalue = ctr.options[ctr.selectedIndex].value;

            var stt = document.getElementById("selectstate");
            var statevalue = stt.options[stt.selectedIndex].value;

            var ct = document.getElementById("selectcity");
            var cityvalue = ct.options[ct.selectedIndex].value;

            var count = 1;
            //  successmsg( prod_shortvalue + " -- "+prod_detailsvalue );
            if (seller_namevalue == "" || seller_namevalue == null) {
                successmsg("Seller name is empty");
            } else if (company_namevalue == "" || company_namevalue == null) {
                successmsg("Business/ Company name is empty");
            } else if (sellergroupvalue == "blank") {
                successmsg("Please select seller type");
            } else if (business_addressvalue == "" || business_addressvalue == null) {
                successmsg("Business address is empty");
            } else if (business_detailsvalue == "" || business_detailsvalue == null) {
                successmsg("Business description is empty");
            } else if (countryvalue == "blank") {

                successmsg("Please select Country");
            } else if (statevalue == "blank") {

                successmsg("Please select state");
            } else if (cityvalue == "blank") {

                successmsg("Please select city");
            } else if (pincodevalue == "" || pincodevalue == null) {

                successmsg("Pincode is empty");
            } else if (phonevalue == "" || phonevalue == null) {

                successmsg("Phone number is empty");
            } else if (emailvalue == "" || emailvalue == null) {

                successmsg("Email id is empty");
            } else if (validate_email(emailvalue) == 'invalid') {

                successmsg("Email id is invalid");
            } else if (!gstvalue) {
                successmsg("Please enter GST");
            } else if (!pan) {
                successmsg("Please enter PAN");
            } else if (!cin_number) {
                successmsg("Please enter CIN");
            } else {
                showloader();
                var file_data = $('#seller_logo').prop('files')[0];
                var pan_card = $('#pan_card').prop('files')[0];
                var aadhar_card = $('#aadhar_card').prop('files')[0];
                var business_proof = $('#business_proof').prop('files')[0];
                var seller_banner = $('#seller_banner').prop('files')[0];

                var prod_imgurl = $("#prod_imgurl").val();
                var pan_card1 = $("#pan_card1").val();
                var aadhar_card1 = $("#aadhar_card1").val();
                var business_proof1 = $("#business_proof1").val();
                var seller_banner1 = $("#seller_banner1").val();

                var form_data = new FormData();
                form_data.append('business_proof', business_proof);
                form_data.append('seller_banner', seller_banner);
                form_data.append('seller_banner1', seller_banner1);
                form_data.append('pan_card', pan_card);
                form_data.append('aadhar_card', aadhar_card);
                form_data.append('seller_logo', file_data);
                form_data.append('seller_namevalue', seller_namevalue);
                form_data.append('company_namevalue', company_namevalue);
                form_data.append('sellergroupvalue', sellergroupvalue);
                form_data.append('business_addressvalue', business_addressvalue);
                form_data.append('business_detailsvalue', business_detailsvalue);
                form_data.append('countryvalue', countryvalue);
                form_data.append('statevalue', statevalue);
                form_data.append('cityvalue', cityvalue);
                form_data.append('pincodevalue', pincodevalue);
                form_data.append('phonevalue', phonevalue);
                form_data.append('emailvalue', emailvalue);
                form_data.append('websitevalue', websitevalue);
                form_data.append('gstvalue', gstvalue);
                form_data.append('sellerid', selleridvalue);
                form_data.append('prod_imgurl', prod_imgurl);
                form_data.append('pan_card1', pan_card1);
                form_data.append('aadhar_card1', aadhar_card1);
                form_data.append('business_proof1', business_proof1);
                form_data.append('pan_number', pan);
                form_data.append('cin_number', cin_number);
                form_data.append('code', code_ajax);
                $.ajax({
                    method: 'POST',
                    url: 'edit_seller_profileprocess.php',
                    data: form_data,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        hideloader();
                        var data = $.parseJSON(response);
                        if (data["status"] == "1") {
                            successmsg(data["msg"]);
                            $("#log_img").remove();
                            $("#banner_img").remove();
                            $("#bt_list").html('<img src="' + data["img"] + '" id="log_img" height="75" width="75" hspace="20" vspace="20">');
                            $("#bt_list_banner").html('<img src="' + data["img"] + '" id="banner_img" height="75" width="75" hspace="20" vspace="20">');

                        } else {
                            successmsg(data["msg"]);
                        }

                    }
                });


            }

        });

        $("#update_password_btn").click(function(event) {
            event.preventDefault();
            var selleridvalue = $('#sellerid').val();
            var passwords = $('#password').val();


            if (passwords == "" || passwords == null) {
                successmsg("Password is empty");
            } else if (strong_check_password(passwords) == 'fail') {
                successmsg("Password Must contain 5 characters or more,lowercase and uppercase characters and contains digits.");
            } else if (selleridvalue && passwords) {
                showloader();
                var form_data = new FormData();
                form_data.append('selleridvalue', selleridvalue);
                form_data.append('passwords', passwords);


                form_data.append('code', code_ajax);
                $.ajax({
                    method: 'POST',
                    url: 'verify_seller_bank_process.php',
                    data: form_data,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        hideloader();
                        var data = $.parseJSON(response);
                        if (data["status"] == "1") {
                            successmsg(data["msg"]);
                            $("#myModal").modal('hide');
                            $('#password').val('');

                        } else {
                            successmsg(data["msg"]);
                        }

                    }
                });
            }

        });


    })

    function logout_all_device() {
        $.ajax({
            method: 'POST',
            url: 'logout_all_device.php',
            data: {
                code: code_ajax,
                user_id: "<?php echo $_SESSION['admin']; ?>"
            },
            success: function(response) {
                successmsg("Successfully Logout from all device");
            }
        });
    }
</script>


<!-- main content start-->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Edit Seller Profile</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <button type="button" class="btn btn-danger  pull-right" onclick="logout_all_device();" style="margin-right:10px; margin-top:10px;">Log Out All Device</button>

                            <button data-toggle="modal" data-target="#myModal" type="button" class="btn btn-dark  pull-right" style="margin-right:10px; margin-top:10px;">Update Password</button>

                            <h4 class="pl-0" style="padding: 15px; height: 4px">


                                <b>Edit Seller Profile:</b>
                            </h4>
                            <br>

                            <input type="hidden" class="form-control" id="sellerid" value=<?php echo $sellerid; ?>></input>


                            <div class="form-three widget-shadow">
                                <form class="form-horizontal" id="myform">
                                    <a> ** required field</a>
                                    <br><br>



                                    <div class="form-group row align-items-center">
                                        <label for="focusedinput" class="col-sm-2 control-label m-0">Seller Name **</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="seller_name" placeholder="Full Name" value="<?php echo $fname; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label for="focusedinput" class="col-sm-2 control-label m-0">Business Name **</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="business_name" placeholder="Business/ Company Name" value="<?php echo $cname; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-2 control-label m-0">Seller Type **</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" id="sellergroup" name="sellergroup">

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row align-items-center">
                                        <label for="focusedinput" class="col-sm-2 control-label m-0">Business Address**</label>
                                        <div class="col-sm-8">
                                            <textarea rows="5" class="form-control" id="business_address" placeholder="Business Address" required><?php echo $address; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label for="focusedinput" class="col-sm-2 control-label m-0">Business Description **</label>
                                        <div class="col-sm-8">
                                            <textarea rows="6" class="form-control" id="business_details" name="business_details" form="usrform" required placeholder="About your Business / Company..."><?php echo $desc; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-2 control-label m-0">Select Country **</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" id="selectcountry" name="selectcountry">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-2 control-label m-0">Select State **</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" id="selectstate" name="selectstate">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-2 control-label m-0">Select City **</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" id="selectcity" name="selectcity">

                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row align-items-center">
                                        <label for="focusedinput" class="col-sm-2 control-label m-0">Pincode **</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="pincode" placeholder="462026" value="<?php echo $pincode; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label for="focusedinput" class="col-sm-2 control-label m-0">Phone **</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="phone" placeholder="** without country code" value="<?php echo $phone; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label for="focusedinput" class="col-sm-2 control-label m-0">email Id **</label>
                                        <div class="col-sm-8">
                                            <input type="email" class="form-control" id="email" placeholder="email id" value="<?php echo $email; ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group row align-items-center">

                                        <label for="exampleInputFile" class="col-sm-2 control-label m-0">Update Logo 500x500 pixel</label>

                                        <div class="col-sm-8">
                                            <div class="input-files">

                                                <div>

                                                    <input type="file" name="seller_logo" id="seller_logo" class="form-control-file" onchange="uploadFile1('seller_logo')" ;>

                                                </div>

                                            </div>

                                        </div>
                                    </div>


                                    <!-- icon-hover-effects -->
                                    <div class="form-group row align-items-center">

                                        <label for="exampleInputFile" class="col-sm-2 control-label m-0"></label>
                                        <?php
                                        ?>
                                        <div class="col-sm-8">
                                            <div class="tables" style="background-color: #F6EAEA;">
                                                <div class="wrap">

                                                    <div class="bg-effect">
                                                        <ul class="bt_list" id="bt_list">

                                                            <?php
                                                            $img_decode = json_decode($logo);
                                                            $prod_url = MEDIAURL . $img_decode->{$img_dimension_arr[0][0] . '-' . $img_dimension_arr[0][1]};


                                                            if ($prod_url) {
                                                                echo '<img src=' . $prod_url . ' id="log_img" height="75" width="75" hspace="20" vspace="20"> ';
                                                            }
                                                            ?>

                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group row align-items-center">

                                        <label for="exampleInputFile" class="col-sm-2 control-label m-0">Update Banner 1200x900 pixel</label>

                                        <div class="col-sm-8">
                                            <div class="input-files">

                                                <div>

                                                    <input type="file" name="seller_banner" id="seller_banner" class="form-control-file" onchange="uploadFile1('seller_banner')" ;>

                                                </div>

                                            </div>

                                        </div>
                                    </div>


                                    <!-- icon-hover-effects -->
                                    <div class="form-group row align-items-center">

                                        <label for="exampleInputFile" class="col-sm-2 control-label m-0"></label>
                                        <?php
                                        ?>
                                        <div class="col-sm-8">
                                            <div class="tables" style="background-color: #F6EAEA;">
                                                <div class="wrap">

                                                    <div class="bg-effect">
                                                        <ul class="bt_list" id="bt_list_banner">

                                                            <?php
                                                            $img_decode = json_decode($seller_banner);
                                                            $prod_url = MEDIAURL . $img_decode->{$img_dimension_arr[0][0] . '-' . $img_dimension_arr[0][1]};


                                                            if ($prod_url) {
                                                                echo '<img src=' . $prod_url . ' id="banner_img" height="75" width="75" hspace="20" vspace="20"> ';
                                                            }
                                                            ?>

                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <input type="hidden" class="form-control" id="seller_banner1" value=<?php echo $seller_banner; ?>></input>

                                    <input type="hidden" class="form-control" id="prod_imgurl" value=<?php echo $logo; ?>></input>

                                    <input type="hidden" class="form-control" id="pan_card1" value=<?php echo $pan_card; ?>></input>
                                    <input type="hidden" class="form-control" id="aadhar_card1" value=<?php echo $aadhar_card; ?>></input>
                                    <input type="hidden" class="form-control" id="business_proof1" value=<?php echo $business_proof; ?>></input>
                                    <div class="form-group row align-items-center">

                                        <label for="exampleInputFile" class="col-sm-2 control-label m-0">Upload Pan card (<?php echo $file_kb; ?>)</label>

                                        <div class="col-sm-8">
                                            <div class="input-files">

                                                <div>

                                                    <input type="file" name="pan_card" id="pan_card" class="form-control-file" onchange="uploadFile2('pan_card','<?php echo $image_size; ?>')" ;>

                                                </div>
                                                <?php

                                                echo '<a href="download.php?ids=' . $sellerid . '&type=pan_card">Download</a> ';
                                                ?>
                                                </br>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">

                                        <label for="exampleInputFile" class="col-sm-2 control-label m-0">Upload Id Proof (<?php echo $file_kb; ?>)</label>

                                        <div class="col-sm-8">
                                            <div class="input-files">

                                                <div>

                                                    <input type="file" name="aadhar_card" id="aadhar_card" class="form-control-file" onchange="uploadFile2('aadhar_card','<?php echo $image_size; ?>')" ;>

                                                </div>
                                                <?php

                                                echo '<a href="download.php?ids=' . $sellerid . '&type=aadhar_card">Download</a> ';
                                                ?>
                                                </br>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group row align-items-center">

                                        <label for="exampleInputFile" class="col-sm-2 control-label m-0">Upload Business Proof (<?php echo $file_kb; ?>)</label>

                                        <div class="col-sm-8">
                                            <div class="input-files">

                                                <div>

                                                    <input type="file" name="business_proof" id="business_proof" class="form-control-file" onchange="uploadFile2('business_proof','<?php echo $image_size; ?>')" ;>

                                                </div>
                                                <?php

                                                echo '<a href="download.php?ids=' . $sellerid . '&type=business_proof">Download</a> ';
                                                ?>
                                                </br>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group row align-items-center">
                                        <label for="focusedinput" class="col-sm-2 control-label m-0">Website URL</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="website" placeholder="https://www.blueappsoftware.com" value="<?php echo $website; ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group row align-items-center">
                                        <label for="focusedinput" class="col-sm-2 control-label m-0">GST/VAT Number **</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="gst" placeholder="Registered GST/VAT Number" value="<?php echo $tax; ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group row align-items-center">
                                        <label for="focusedinput" class="col-sm-2 control-label m-0">PAN Number**</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="pan_number" placeholder="PAN Number" value="<?php echo $pan_number; ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group row align-items-center">
                                        <label for="focusedinput" class="col-sm-2 control-label m-0">CIN Number **</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="cin_number" placeholder="CIN Number" value="<?php echo $cin_number; ?>" required>
                                        </div>
                                    </div>


                                    </br></br>

                                    <div class="col-sm-offset-2">
                                        <button type="submit" class="btn btn-dark waves-effect waves-light" href="javascript:void(0)" id="addProduct">Update</button>
                                    </div>

                                    </br></br>


                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>



            <div class="clearfix"> </div>

        </div>

        <div class="clearfix"> </div>

    </div>
</div>

<div class="col_1">


    <div class="clearfix"> </div>

</div>

<!--footer-->
<?php include("footernew.php"); ?>
<!--//footer-->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:50%;">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update Password</h4>
            </div>
            <div class="modal-body">
                <form class="form" id="update_password_form" enctype="multipart/form-data">

                    <div class="form-group row align-items-center">
                        <label for="name">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Password">
                    </div>

                    <button type="submit" class="btn btn-success" value="Upload" href="javascript:void(0)" id="update_password_btn">Update</button>
                </form>
            </div>

        </div>

    </div>
</div>