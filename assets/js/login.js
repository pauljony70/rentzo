var csrfName = $('.txt_csrfname').attr('name'); // 
 var csrfHash = $('.txt_csrfname').val(); // CSRF hash
 var site_url = $('.site_url').val(); // CSRF hash

function call_register() {
       //alert("call");
      var phonev = $("#phone").val();
      var famev = $("#fname").val();
      var lamev = $("#lname").val();
      var pass = $("#password").val();
      var cpass = $("#cpassword").val();
	  var name = famev + lamev;
      //  alert("phone  "+phonev+"---"+namev+ "===="+phonev.length);

      if (famev == "" || famev == null) {

		$("#fname_error").text("First Name is Empty");
		
	  } else {

		$("#fname_error").text("");

	  }
	  if (lamev == "" || lamev == null) {

		$("#lamev_error").text("Last Name is Empty");
		
	  } else {

		$("#lamev_error").text("");

      }
	  if (phonev == "" || phonev == null) {

		$("#phonev_error").text("Phone Number is Empty");

	  } else {

		$("#phonev_error").text("");

      }
	  if (phonev.length != 10) {

		$("#phonev_error").text("Invalid Phone Number");
		
	  } else {

		$("#phonev_error").text("");

      }
	  if (pass == "" || pass == null) {

		 $("#pass_error").text("Password is Empty");

	  } else {

		$("#pass_error").text("");

      } 
	  if (pass.length != 6) {

		 $("#pass_error").text("Minimum 6 character Password Allow");
	    
	 } else {

		$("#pass_error").text("");

     }
	 if (cpass == "" || cpass == null) {

		 $("#cpass_error").text("Confirm Password is Empty");
		 
	  } else {

		$("#cpass_error").text("");

      }
	  if (pass != cpass) {

		$("#cpass_error").text("Password And Confirm Password are not Same.");

      
      } else {

		 $("#cpass_error").text("");
	  }
		/*alert('out');*/
      if(famev != "" && lamev != "" && phonev != "" && pass != "" && cpass != "" && pass.length != 6 && pass == cpass) { 
		/* alert('in');*/
		
		  
        $.ajax({
          method: 'POST',
		  url: site_url+'signup',
          //url: 'https://fleekmart.com/API/index.php/auth/signup',
          headers: {
            'X-API-KEY': 'ysh2zka3fhcn4hsdkcn',
          },
          data: {
            language: default_language,
            devicetype: "1",
            phone: phonev,
            user_name: name,
            user_password: pass,
			[csrfName]: csrfHash,

          },
          success: function(response) {
            console.log(response);
			$('#otp').val(response.Information.otp);
            //alert("response is "+response);
            var abc = response;
            ////alert("status is " + abc.msg);
            if (abc.status == 1) {
              // show otp verify div
              $('.aa-myaccount-login').hide();
              $('.aa-myaccount-otp').show();

            } else {
              //$('.aa-myaccount-otp').show();
              alert(abc.msg);
            }

          },
          error: function(data) {
            //debugger;
            //alert("Error");
          }
        });

      }
    }

    function verify_otp() {
      var phonev = $("#phone").val();
      var famev = $("#fname").val();
      var lamev = $("#lname").val();
      var pass = $("#password").val();
      var cpass = $("#cpassword").val();
      var otpv = $("#otp").val();
	  var name = famev + lamev;
      var qouteidv = "";
      //alert("phone  "+phonev+"---"+namev+ "===="+phonev.length);
      if (famev == "" || famev == null) {

        alert("First Name is Empty");
	  } else if (lamev == "" || lamev == null) {

        alert("Last Name is Empty");
      
      } else if (phonev == "" || phonev == null) {

        alert("Phone Number is Empty");

	  } else if (pass == "" || pass == null) {

         alert("Password is Empty");

	  } else if (cpass == "" || cpass == null) {

         alert("Confirm Password is Empty");
	  } else if (pass != cpass) {

        alert("Password And Confirm Password are not Same.");

      } else if (phonev.length != 10) {

        alert("Invalid Phone Number");
      } else {
        $.ajax({
          method: 'POST',
		  url: site_url+'verify_otp',
         // url: 'https://fleekmart.com/API/index.php/auth/verify_otp',
          headers: {
            'X-API-KEY': 'ysh2zka3fhcn4hsdkcn',
          },
          data: {
            language: "default",
            devicetype: "1",
            phone: phonev,
            otp: otpv,
            fullname: name,
            qouteid: qouteidv,
            user_name: name,
            user_password: pass,
			[csrfName]: csrfHash,
          },
          success: function(response) {
            console.log(response);
			if(response.msg == 'Login successfully')
			{
				//alert(response.msg);
				location.href=site_url;
			}
			else
			{
				alert(response.msg);
			}
		    //location.href=site_url+'login';
            //alert("response is " + response);
            // var parsedJSON = jQuery.parseJSON(response ); //JSON.parse(response);
            //   alert("status is" +parsedJSON );

          },
        });

      }
    }

function call_login() {
      // alert("call");
      var phonev = $("#phone").val();
      var pass = $("#password").val();
	
	  var qouteid = '';

	    if (phonev == "" || phonev == null) {

			$("#phonev_error").text("Pnone No is Empty");
			
		  } 
		  else 
		  {
				$("#phonev_error").text("");
		  }
		 if (pass == "" || pass == null) {

			$("#passd_error").text("Password is Empty");
		  
		  }
		  else 
		  {
				$("#passd_error").text("");
		  }
		
	  if(phonev != "" && pass != "") {
		//alert('fffffffff');
      
      $.ajax({
        method: 'POST',
		url: site_url+'user_login',
        //url: 'https://fleekmart.com/API/index.php/auth/signup',
        headers: {
          'X-API-KEY': 'ysh2zka3fhcn4hsdkcn',
        },
        data: {
          language: "default",
          devicetype: "1",
          phone: phonev,
          user_password: pass,
		  qouteid : qouteid,
		  [csrfName]: csrfHash

        },
        success: function(response) {
            
			
			if(response.msg == 'Login successfully')
			{
				window.location.href = site_url; 
			}
			else
			{
				$("#error_msg").html(response.msg);
				//alert(response.msg);
				// Swal.fire({
					 // position: "center",
					 // title: response.msg,
					 // showConfirmButton: false,
					 // confirmButtonColor: '#ff5400',
					 // timer: 3000
				 // })
			}

			//console.log(response);
          //alert("response is " + response);
          //var parsedJSON = JSON.parse(response);
          //alert("status is" + parsedJSON);

        },


      });

	}

    }