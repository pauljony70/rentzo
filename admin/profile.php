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
$aadhar_card = "";
$stmt = $conn->prepare("SELECT seller_id , companyname, fullname, address, description, city, pincode, state, country, phone, email, logo, create_by, update_by FROM admin_login WHERE seller_id =?");
$stmt->bind_param("s", $sellerid);
$stmt->execute();
$data = $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11, $col12, $col13, $col14);
$return = array();

//echo " get col data ";
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
  /// status  = 0 -pending  1 accepted , 2 reject, 

}

?>

<!-- main content start-->
<div class="content-page">
  <!-- Start content -->
  <div class="content">
    <div class="container-fluid">
      <!-- start page title -->
      <div class="row">
        <div class="col-12">
          <div class="page-title-box">
            <h4 class="page-title">Edit Profile</h4>
          </div>
        </div>
      </div>
      <!-- end page title -->

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">

              <div class="row align-items-center">
                <div class="col-md-12 mb-2">
                  <div class="d-flex align-items-center">
                    <button type="button" class="btn btn-danger waves-effect waves-light pull-right mr-1" onclick="logout_all_device();">Log Out All Device</button>
                    <button data-toggle="modal" data-target="#myModal" type="button" class="btn btn-dark waves-effect waves-light pull-right">Update Password</button>
                  </div>
                </div>
              </div>

              <div class="bs-example widget-shadow" data-example-id="hoverable-table">

                <input type="hidden" class="form-control" id="sellerid" value=<?php echo $sellerid; ?>></input>

                <div class="form-three widget-shadow">
                  <form class="form-horizontal" id="myform">
                    <a> ** required field</a>
                    <div class="form-group row align-items-center">
                      <label for="focusedinput" class="col-sm-2 control-label m-0"> Name **</label>
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
                      <label for="focusedinput" class="col-sm-2 control-label m-0">Business Address**</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="business_address" placeholder="Business Address" value="<?php echo $address; ?>" required>
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

                      <label for="exampleInputFile" class="col-sm-2 control-label m-0">Update profile</label>

                      <div class="col-sm-8">

                        <input type="file" name="seller_logo" id="seller_logo" class="form-control-file" onchange="uploadFile1('seller_logo')" ;>

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
                    <input type="hidden" class="form-control" id="prod_imgurl" value=<?php echo $logo; ?>></input>


                    </br></br>

                    <div class="col-sm-offset-2">
                      <button type="submit" class="btn btn-dark waves-effect waves-light" href="javascript:void(0)" id="addProduct">Update</button>
                    </div>

                    </br></br>


                  </form>
                </div>

              </div>

              <div class="clearfix"> </div>

            </div>
          </div>
        </div>
      </div>

    </div>

    <div class="clearfix"> </div>

  </div>

  <div class="col_1">

    <div class="clearfix"> </div>

  </div>

</div>
<!--footer-->
<?php include("footernew.php"); ?>
<!--//footer-->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form" id="update_password_form" enctype="multipart/form-data">

          <div class="form-group row align-items-center">
            <label for="name">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Password">
          </div>

          <button type="submit" class="btn btn-dark waves-effect waves-light" value="Upload" href="javascript:void(0)" id="update_password_btn">Update</button>
        </form>
      </div>

    </div>

  </div>
</div>

<script>
  var code_ajax = $("#code_ajax").val();
  $(document).ready(function() {

    var id = 1;

    getcountrydata();

  });
</script>

<script>
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
        var o = new Option("Select", "");
        $("#selectcountry").append(o);
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
            getStatedata(countryid);
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
        var o = new Option("Select", "");
        $("#selectstate").append(o);
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
        var o = new Option("Select", "");
        $("#selectcity").append(o);
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


      var ctr = document.getElementById("selectcountry");
      var countryvalue = ctr.options[ctr.selectedIndex].value;

      var stt = document.getElementById("selectstate");
      var statevalue = stt.options[stt.selectedIndex].value;

      var ct = document.getElementById("selectcity");
      var cityvalue = ct.options[ct.selectedIndex].value;

      var count = 1;
      //  successmsg( prod_shortvalue + " -- "+prod_detailsvalue );
      if (seller_namevalue == "" || seller_namevalue == null) {
        successmsg("Name is empty");
      } else if (company_namevalue == "" || company_namevalue == null) {
        successmsg("Business/ Company name is empty");
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
      } else {
        $.busyLoadFull("show");
        var file_data = $('#seller_logo').prop('files')[0];

        var prod_imgurl = $("#prod_imgurl").val();

        var form_data = new FormData();
        form_data.append('seller_logo', file_data);
        form_data.append('seller_namevalue', seller_namevalue);
        form_data.append('company_namevalue', company_namevalue);
        form_data.append('business_addressvalue', business_addressvalue);
        form_data.append('business_detailsvalue', business_detailsvalue);
        form_data.append('countryvalue', countryvalue);
        form_data.append('statevalue', statevalue);
        form_data.append('cityvalue', cityvalue);
        form_data.append('pincodevalue', pincodevalue);
        form_data.append('phonevalue', phonevalue);
        form_data.append('emailvalue', emailvalue);
        form_data.append('sellerid', selleridvalue);

        form_data.append('code', code_ajax);
        $.ajax({
          method: 'POST',
          url: 'edit_admin_profileprocess.php',
          data: form_data,
          contentType: false,
          processData: false,
          success: function(response) {
            $.busyLoadFull("hide");
            var data = $.parseJSON(response);
            if (data["status"] == "1") {
              successmsg(data["msg"]);
              $("#log_img").remove();
              $("#bt_list").html('<img src="' + data["img"] + '" id="log_img" height="75" width="75" hspace="20" vspace="20">');


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
        $.busyLoadFull("show");
        var form_data = new FormData();
        form_data.append('selleridvalue', selleridvalue);
        form_data.append('passwords', passwords);


        form_data.append('code', code_ajax);
        $.ajax({
          method: 'POST',
          url: 'update_password_process.php',
          data: form_data,
          contentType: false,
          processData: false,
          success: function(response) {
            $.busyLoadFull("hide");
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