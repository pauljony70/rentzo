<script src="<?php echo base_url; ?>assets_web/js/jquery.min.js"></script>
<script src="<?php echo base_url; ?>assets_web/js/bootstrap.bundle.min.js"></script>  
<script src="<?php echo base_url(); ?>assets_web/libs/sweetalert2/sweetalert2.min.js"></script>
<script src="<?php echo base_url(); ?>assets_web/js/app/common.js"></script>

<script>
  setTimeout(function() {
    $('.loaderScreen').css('display', 'none');
  }, 300);

  var csrfName = $(".txt_csrfname").attr("name"); //
  var csrfHash = $(".txt_csrfname").val(); // CSRF hash
  var site_url = $(".site_url").val(); // CSRF hash
  const default_language = 2;

  $("main").attr("id", "common-class");


  function redirect_to_link(link) {
    location.href = link;
  }

  $(document).on('input', '#search', function() {
    var searchResultsContainer = $(this).parent().parent().parent().parent().find('#searchResults');
    var search = $(this).val();
    searchResultsContainer.html('');

    $.ajax({
      method: "get",
      url: site_url + "get_search_products",
      data: {
        search: search,
        [csrfName]: csrfHash
      },
    }).done(function(response) {
      var parsedJSON = JSON.parse(response);
      var product_html = "";
      var counter = 1;
      if (parsedJSON.length > 0) {
        $(parsedJSON).each(function() {
          product_html +=
            `<li>
              <a class="dropdown-item" href="${site_url}${this.web_url}?pid=${this.id}&sku=${this.sku}&sid=${this.vendor_id}">
                <div class="card search-card">
                  <div class="d-flex align-items-center">
                    <div class="d-flex-center search-card_image" style="background-image: url(${site_url}/media/${this.imgurl});"></div>
                    <div class="w-100">
                      <div class="card-body py-2 h-100 d-flex flex-column justify-content-evenly">
                        <div class="w-100 d-flex justify-content-between">
                          <h6 class="card-title line-clamp-2" style="white-space: normal;">${this.name}</h6>
                        </div>
                        <p class="card-text d-flex"><small class="text-muted">${this.price}</small></p>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </li>`;

          if (counter == 5) {
            return false;
          } else {
            counter++;
          }
        });

        product_html += `<li><a class="dropdown-item text-primary fw-bold text-center bg-light" href="${site_url}index.php/search/s?search=${search}" style="border-radius: 5px;">See all</a></li>`;

        searchResultsContainer.html(product_html);

        // Show the dropdown and use Bootstrap's dropdown function to handle its behavior
        searchResultsContainer.dropdown('show');
      } else {
        searchResultsContainer.dropdown('hide');
      }
    }).fail(function() {
      console.log('Failed');
    });
  });

  $(document).on('focus', '#search', function() {
    $(this).addClass('focus-within');
    $(this).siblings('#searchButton').addClass('focus-within');
  });

  $(document).on('blur', '#search', function() {
    $(this).removeClass('focus-within');
    $(this).siblings('#searchButton').removeClass('focus-within');
  });


  // Hide the dropdown when clicking outside the input box
  $(document).on('click', 'body', function(event) {
    if (!$(event.target).closest('#searchResults').length && !$(event.target).is('#search')) {
      $('.searchResults').each(function() {
        $(this).dropdown('hide');
      });
    }
  });




  wishlist_count();

  function wishlist_count() {

    var csrfName = $('.txt_csrfname').attr('name'); //

    var csrfHash = $('.txt_csrfname').val(); // CSRF hash

    var site_url = $('.site_url').val(); // CSRF hash



    $.ajax({

      method: 'get',

      url: site_url + 'wishlist_count',

      data: {



        [csrfName]: csrfHash

      },

      success: function(response) {

        $('#wishlist_count').html(response);



      }

    });



  }

  addto_cart_count();

  function addto_cart_count() {
    $.ajax({
      method: 'get',
      url: site_url + 'cart_count',
      data: {
        [csrfName]: csrfHash
      },
      success: function(response) {
        document.querySelectorAll('#badge-cart-count').forEach(element => {
          element.innerText = response;
        });
      }

    });

  }

  function add_to_cart_product(event, pid, sku, vendor_id, user_id, qty, referid, devicetype, qouteid) {

    event.preventDefault();

    var csrfName = $('.txt_csrfname').attr('name'); //

    var csrfHash = $('.txt_csrfname').val(); // CSRF hash

    var site_url = $('.site_url').val(); // CSRF hash

    if (user_id == '')

    {

      //alert('Please login to add product into Cart');

      Swal.fire({

        position: "center",

        //icon: "success",

        title: 'Please login to add product into Cart',

        showConfirmButton: false,

        confirmButtonColor: '#f42525',

        timer: 3000

      })

      setTimeout(function() {

        window.location.href = site_url + 'login';

      }, 2000);





    } else

    {

      $.ajax({

        method: 'post',

        url: site_url + 'addProductCart',

        data: {

          language: 1,

          pid: pid,

          sku: sku,

          sid: vendor_id,

          user_id: user_id,

          qty: qty,

          referid: referid,

          devicetype: 2,

          qouteid: qouteid,

          [csrfName]: csrfHash

        },

        success: function(response) {

          //hideloader();

          addto_cart_count();

          //alert(response.msg);

          if (response.msg == 'Product attribute mandotary')

          {

            location.href =

              site_url +

              this.web_url +

              "?pid=" +

              pid +

              "&sku=" +

              sku +

              "&sid=" +

              vendor_id

            ;

          }

          Swal.fire({

            position: "center",

            // icon: "success",

            title: response.msg,

            showConfirmButton: true,

            confirmButtonColor: '#f42525',

            confirmButtonText: 'View Cart',

            timer: 3000

          }).then((result) => {

            if (result.isConfirmed) {

              window.location = site_url + "cart";

            }

          })

          //location.href = site_url + "cart";

          //$('#cart_msg').html(response.msg);

          // $('#id01').show();

          //alert(response.msg);

        }

      });

    }

  }

  function delete_cart_before_buy(user_id, qouteid) {
    $.ajax({
      method: "post",
      url: site_url + "deleteProductCart_buynow",
      data: {
        language: default_language,
        devicetype: 2,
        user_id: user_id,
        qouteid: qouteid,
        [csrfName]: csrfHash,
      },
      success: function(response) {

        //alert(response);

      },
    })
  }

  function add_to_cart_product_buy(event, pid, sku, vendor_id, user_id, qty, referid, devicetype, qouteid) {

    event.preventDefault();
    var csrfName = $('.txt_csrfname').attr('name'); //
    var csrfHash = $('.txt_csrfname').val(); // CSRF hash
    var site_url = $('.site_url').val(); // CSRF hash

    if (user_id == '') {
      window.location.href = site_url.concat('login');
    } else {
      var qty = 1;
      if (qty == '') {
        Swal.fire({
          position: "center",
          //icon: "success",
          title: "Please Select Qty",
          showConfirmButton: true,
          confirmButtonText: "ok",
          confirmButtonColor: "#f42525",
          timer: 3000,
        });
      } else {
        $.ajax({
          method: 'post',
          url: site_url + 'buynowProductCart',
          data: {
            language: 1,
            pid: pid,
            sku: sku,
            sid: vendor_id,
            user_id: user_id,
            qty: qty,
            referid: referid,
            devicetype: 2,
            qouteid: qouteid,
            [csrfName]: csrfHash
          },
          success: function(response) {
            addto_cart_count();
            if (!response.status) {
              location.href = site_url + sku + "?pid=" + pid + "&sku=" + sku + "&sid=" + vendor_id;
            } else {
              location.href = site_url + "checkout";
            }
          }
        });
      }
    }
  }

  function AllowOnlyNumbers(e) {

    e = (e) ? e : window.event;
    var clipboardData = e.clipboardData ? e.clipboardData : window.clipboardData;
    var key = e.keyCode ? e.keyCode : e.which ? e.which : e.charCode;
    var str = (e.type && e.type == "paste") ? clipboardData.getData('Text') : String.fromCharCode(key);

    return (/^\d+$/.test(str));
  }

  function sendEmailOtp() {


    var email = $("#email").val();
    // alert("phone "+phonev+"---"+fullname+ "===="+phonev.length);

    /*alert('out');*/
    if (email != "" && email != null) {
      /* alert('in');*/


      $.ajax({
        method: 'POST',
        url: site_url + 'send-reg-email-otp',
        data: {
          language: default_language,
          devicetype: "1",
          email: email,
          [csrfName]: csrfHash,
        },
        success: function(response) {
          console.log(response);
        },
        error: function(data) {}
      });

    } else {
      alert('email is blank');
    }
  }

  function subscriber_form() {

    event.preventDefault();

    var csrfName = $('.txt_csrfname').attr('name'); //

    var csrfHash = $('.txt_csrfname').val(); // CSRF hash

    var site_url = $('.site_url').val(); // CSRF hash



    var sub_email = $('#sub_email').val();



    if (sub_email != '')

    {

      $.ajax({

        method: 'post',

        url: site_url + 'send_subscriber',

        data: {
          sub_email: sub_email,
          [csrfName]: csrfHash
        },

        success: function(response) {

          //hideloader();

          alert(response);

          location.reload();



        }

      });

    } else

    {

      alert('Please Add Emails Address ?');

    }

  }

  const countryShort = ["om", "bh", "kw", "qa", "sa", "ae"];

  $('#country').on('change', function() {
    if (this.value == 1) {
      document.querySelector('#region-div').innerHTML =
        `<label class="form-label"><?= $this->lang->line('region'); ?></label>
					<select name="region" id="region" class="form-select">
						<option value=""><?= $this->lang->line('select_region'); ?></option>
					</select>
					<span id="error"></span>`;
      document.querySelector('#governorates-div').innerHTML =
        `<label class="form-label"><?= $this->lang->line('governorate'); ?></label>
					<select name="governorates" id="governorates" class="form-select">
						<option value=""><?= $this->lang->line('select_governorate'); ?></option>
					</select>
					<span id="error"></span>`;
      document.querySelector('#area-div').innerHTML =
        `<label class="form-label"><?= $this->lang->line('area'); ?></label>
					<select name="area" id="area" class="form-select">
						<option value=""><?= $this->lang->line('select_area'); ?></option>
					</select>
					<span id="error"></span>`;
      getRegiondata(this.value);
      $('#region').on('change', function() {
        getGovernoratedata(this.value);
      });
      $('#governorates').on('change', function() {
        getAreadata(this.value);
      });
    } else if (this.value > 1) {
      document.querySelector('#region-div').innerHTML =
        `<label class="form-label"><?= $this->lang->line('region'); ?></label>
					<input type="text" class="form-control" id="region" name="region" />
					<span id="error"></span>`;
      document.querySelector('#governorates-div').innerHTML =
        `<label class="form-label"><?= $this->lang->line('governorate'); ?></label>
					<input type="text" class="form-control" id="governorates" name="governorates" />
					<span id="error"></span>`;
      document.querySelector('#area-div').innerHTML =
        `<label class="form-label"><?= $this->lang->line('area'); ?></label>
					<input type="text" class="form-control" id="area" name="area" />
					<span id="error"></span>`;
    } else {
      document.querySelector('#region-div').innerHTML =
        `<label class="form-label"><?= $this->lang->line('region'); ?></label>
					<input type="text" class="form-control" id="region" name="region" disabled />
					<span id="error"></span>`;
      document.querySelector('#governorates-div').innerHTML =
        `<label class="form-label"><?= $this->lang->line('governorate'); ?></label>
					<input type="text" class="form-control" id="governorates" name="governorates" disabled />
					<span id="error"></span>`;
      document.querySelector('#area-div').innerHTML =
        `<label class="form-label"><?= $this->lang->line('area'); ?></label>
					<input type="text" class="form-control" id="area" name="area" disabled />
					<span id="error"></span>`;
    }

  });

  function setSelectedCountry(countryName) {
    var selectElement = document.getElementById('country');
    for (var i = 0; i < countryNames.length; i++) {
      if (countryNames[i].name === countryName) {
        selectElement.selectedIndex = i + 1;
        initializeIntlTelInput(countryShort[i]);
        if (i == 0) {
          document.querySelector('#region-div').innerHTML =
            `<label class="form-label"><?= $this->lang->line('region'); ?></label>
							<select name="region" id="region" class="form-select">
								<option value=""><?= $this->lang->line('select_region'); ?></option>
							</select>
							<span id="error"></span>`;
          document.querySelector('#governorates-div').innerHTML =
            `<label class="form-label"><?= $this->lang->line('governorate'); ?></label>
							<select name="governorates" id="governorates" class="form-select">
								<option value=""><?= $this->lang->line('select_governorate'); ?></option>
							</select>
							<span id="error"></span>`;
          document.querySelector('#area-div').innerHTML =
            `<label class="form-label"><?= $this->lang->line('area'); ?></label>
							<select name="area" id="area" class="form-select">
								<option value=""><?= $this->lang->line('select_area'); ?></option>
							</select>
							<span id="error"></span>`;
          getRegiondata(i + 1);
          $('#region').on('change', function() {
            getGovernoratedata(this.value);
          });
          $('#governorates').on('change', function() {
            getAreadata(this.value);
          });
        } else if (i > 0) {
          document.querySelector('#region-div').innerHTML =
            `<label class="form-label"><?= $this->lang->line('region'); ?></label>
							<input type="text" class="form-control" id="region" name="region" />
							<span id="error"></span>`;
          document.querySelector('#governorates-div').innerHTML =
            `<label class="form-label"><?= $this->lang->line('governorate'); ?></label>
							<input type="text" class="form-control" id="governorates" name="governorates" />
							<span id="error"></span>`;
          document.querySelector('#area-div').innerHTML =
            `<label class="form-label"><?= $this->lang->line('area'); ?></label>
							<input type="text" class="form-control" id="area" name="area" />
							<span id="error"></span>`;
        }
        return;
      }
    }
    clearAddressForm();
    document.querySelector('#region-div').innerHTML =
      `<label class="form-label"><?= $this->lang->line('region'); ?></label>
				<input type="text" class="form-control" id="region" name="region" disabled />
				<span id="error"></span>`;
    document.querySelector('#governorates-div').innerHTML =
      `<label class="form-label"><?= $this->lang->line('governorates'); ?></label>
				<input type="text" class="form-control" id="governorates" name="governorates" disabled />
				<span id="error"></span>`;
    document.querySelector('#area-div').innerHTML =
      `<label class="form-label"><?= $this->lang->line('area'); ?></label>
				<input type="text" class="form-control" id="area" name="area" disabled />
				<span id="error"></span>`;
    nativeToast({
      message: default_language == 1 ? 'أوه لا! هذا الموقع خارج منطقة خدمتنا.' : 'Oh no! This location is outside of our service area.',
      position: 'top',
      type: 'error',
      square: true,
      edge: false,
      debug: false
    });
  }

  function setEditSelectedCountry(countryName) {
    var selectElement = document.getElementById('edit-country');
    for (var i = 0; i < countryNames.length; i++) {
      if (countryNames[i].name === countryName) {
        selectElement.selectedIndex = i + 1;
        var editMobile = document.getElementById('edit-mobile');
        var editIti = window.intlTelInputGlobals.getInstance(editMobile);
        if (editIti) {
          // If iti instance exists, destroy it before reinitializing
          editIti.destroy();
        }

        editIti = window.intlTelInput(editMobile, {
          initialCountry: countryShort[i],
          onlyCountries: ["om", "bh", "kw", "qa", "sa", "ae"],
          separateDialCode: true,
          utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.8/build/js/utils.js"
        });
        if (i == 0) {
          document.querySelector('#edit-region-div').innerHTML =
            `<label class="form-label"><?= $this->lang->line('region'); ?></label>
							<select name="edit-region" id="edit-region" class="form-select">
								<option value=""><?= $this->lang->line('select_region'); ?></option>
							</select>
							<span id="error"></span>`;
          document.querySelector('#edit-governorates-div').innerHTML =
            `<label class="form-label"><?= $this->lang->line('governorate'); ?></label>
							<select name="edit-governorates" id="edit-governorates" class="form-select">
								<option value=""><?= $this->lang->line('select_governorate'); ?></option>
							</select>
							<span id="error"></span>`;
          document.querySelector('#edit-area-div').innerHTML =
            `<label class="form-label"><?= $this->lang->line('area'); ?></label>
							<select name="edit-area" id="edit-area" class="form-select">
								<option value=""><?= $this->lang->line('select_area'); ?></option>
							</select>
							<span id="error"></span>`;
          getEditRegiondata(i + 1);
          $('#edit-region').on('change', function() {
            getEditGovernoratedata(this.value);
          });
          $('#edit-governorates').on('change', function() {
            getEditAreadata(this.value);
          });
        } else if (i > 0) {
          document.querySelector('#edit-region-div').innerHTML =
            `<label class="form-label"><?= $this->lang->line('region'); ?></label>
							<input type="text" class="form-control" id="edit-region" name="edit-region" />
							<span id="error"></span>`;
          document.querySelector('#edit-governorates-div').innerHTML =
            `<label class="form-label"><?= $this->lang->line('governorate'); ?></label>
							<input type="text" class="form-control" id="edit-governorates" name="edit-governorates" />
							<span id="error"></span>`;
          document.querySelector('#edit-area-div').innerHTML =
            `<label class="form-label"><?= $this->lang->line('area'); ?></label>
							<input type="text" class="form-control" id="edit-area" name="edit-area" />
							<span id="error"></span>`;
        }
        return;
      }
    }
    clearAddressForm();
    document.querySelector('#edit-region-div').innerHTML =
      `<label class="form-label"><?= $this->lang->line('region'); ?></label>
				<input type="text" class="form-control" id="edit-region" name="edit-region" disabled />
				<span id="error"></span>`;
    document.querySelector('#edit-governorates-div').innerHTML =
      `<label class="form-label"><?= $this->lang->line('governorates'); ?></label>
				<input type="text" class="form-control" id="edit-governorates" name="edit-governorates" disabled />
				<span id="error"></span>`;
    document.querySelector('#edit-area-div').innerHTML =
      `<label class="form-label"><?= $this->lang->line('area'); ?></label>
				<input type="text" class="form-control" id="edit-area" name="edit-area" disabled />
				<span id="error"></span>`;
    nativeToast({
      message: default_language == 1 ? 'أوه لا! هذا الموقع خارج منطقة خدمتنا.' : 'Oh no! This location is outside of our service area.',
      position: 'top',
      type: 'error',
      square: true,
      edge: false,
      debug: false
    });
  }
</script>