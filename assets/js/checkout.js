const btnNext = document.getElementById("checkOutNext");
const addressTab = document.getElementById("address-tab");
const addressC = document.getElementById("address");
const paymentTab = document.getElementById("payment-tab");
const paymentC = document.getElementById("payment");
const btnPrev = document.getElementById("checkOutPrev");

if (btnNext && addressTab && addressC && paymentTab && paymentC) {
  btnNext.addEventListener("click", () => {
    addressTab.classList.remove("active");
    addressC.classList.remove("active");
    addressC.classList.remove("show");
    paymentTab.classList.add("active");
    paymentC.classList.add("active");
    paymentC.classList.add("show");
  });
}
if (btnPrev && addressTab && addressC && paymentTab && paymentC) {
  btnPrev.addEventListener("click", () => {
    paymentTab.classList.remove("active");
    paymentC.classList.remove("active");
    paymentC.classList.remove("show");
    addressTab.classList.add("active");
    addressC.classList.add("active");
    addressC.classList.add("show");
  });
}

var csrfName = $(".txt_csrfname").attr("name"); //
var csrfHash = $(".txt_csrfname").val(); // CSRF hash
var site_url = $(".site_url").val(); // CSRF hash

$(function () {
  window.onload = get_checkout_data();
  window.onload = getStatedata();
});

$('#state').on('change', function() {
	getCitydata(this.value);
});

$('#city').on('change', function() {
	get_checkout_data();
});

function getStatedata(){
            //   successmsg("prod id "+item );
            //alert('ddddd');
			$.ajax({
              method: 'POST',
			  url: site_url + "get_state",
              data: {
                language: default_language,
                [csrfName]: csrfHash
              },
              success: function(response){
                           // successmsg(response); // display response from the PHP script, if any
                            var data = $.parseJSON(response);
                             $('#state') .empty();
                             $('#tcity') .empty(); 
                               var o = new Option( "Select State", "");
                                $("#state").append(o);
                             if(data["status"]=="1"){
                                  $getcity = true;  
                                  var stateid =''  // <?php $state; ?>;
                                  $firstitemid ='';
                                  $firstitemflag = true;
                                //  successmsg('<?php echo "some info"; ?>');
                                 // successmsg("state "+ stateid );
                                $(data["data"]).each(function() {
                                	//	successmsg(this.id +"--"+stateid+"--");
                                	if(stateid === this.id){
                                	   // successmsg("match==="+stateid);
                                	     var o = new Option(this.name, this.id); 
                                        $("#state").append(o);
                                        $('#state').val(this.id);
                                         $getcity = false;
                                         //getCitydata(this.id);
                                	}else{
                                	    var o = new Option(this.name, this.id);
                                       $("#state").append(o); 	    
                                	}
                               
                                    if($firstitemflag == true){
                                         $firstitemflag = false;
                                        $firstitemid  =this.id ;
                                    }
                                });
                                
                                if($getcity  == true){
                                     $getcity  = false;
                                    // getCitydata( $firstitemid );
                                }
                                    
                             }else{
                                 successmsg(data["msg"]);
                             }
                        }
            }); 
}
function getCitydata(stateid){
          // successmsg("state id "+stateid );
            $.ajax({
              method: 'POST',
			  url: site_url + "get_city",
              data: {
                stateid: stateid,
				[csrfName]: csrfHash
              },
              success: function(response){
                           // successmsg(response); // display response from the PHP script, if any
                            var data = $.parseJSON(response);
                             $('#city') .empty(); 
                              var o = new Option( "Select", "");
                                $("#city").append(o);
                             if(data["status"]=="1"){
                                  var cityid = '';  
                                    
                                $(data["data"]).each(function() {
                                	//	successmsg(this.name+"---"+cityid);
                                	if(cityid === this.id){
                                	   // successmsg("match==="+stateid);
                                	     var o = new Option(this.name, this.id); 
                                        $("#city").append(o);
                                        $('#city').val(this.id);
                                     
                                	}else{
                                	    var o = new Option(this.name, this.id);
                                       $("#city").append(o); 	    
                                	}       	
                                    //	var o = new Option(this.name, this.id);
                                     //   $("#selectcity").append(o);
                                      // pass PHP variable declared above to JavaScript variable
                                              
                                });
                                    
                             }else{
                                 successmsg(data["msg"]);
                             }
                        }
            });
    }

function get_checkout_data()
{
	//alert('ssss');
	var input_code = $('#coupon_code').val();
	var city = $("#city option:selected").val();
	$.ajax({
    method: "post",
    url: site_url + "checkout",
    data: {
      language: default_language,
	  coupon_code : input_code,
	  shipping_city : city,
      [csrfName]: csrfHash
    },
    success: function (response) {
		
	  var parsedJSON = response.Information;
	  var product_html = "";
	  $(".paymentMethod").empty();
	  $('#total_discount_data').text();
	  
	   $(parsedJSON).each(function () {
		   $('#payable_value').text(this.total_mrp);
		   $('#discount_value').text(this.total_discount);
		   $('#tex_value').text(this.tax_payable);
		   $('#shipping_fee').text(this.shipping_fee);
		   $('#total_val').text(this.payable_amount);
		   
		   //alert(this.shipping_fee);
		   if(this.coupon_code != '')
		   {
			$('#total_discount_data').text('Total Savings :' + this.coupon_discount_text);
			$('#coupo_discount_value').text(this.coupon_discount_text);
		   }
		   
		   
		   product_html += '<button type="submit" onclick="place_order_data(event)" class="paymentMethodBtn fw-bold fs-6">Place Order</button>';
		   $(".paymentMethod").html(product_html);
		   //alert(this.payable_amount);
	   });
	  //alert(response);
	}
  });
}



$(document).on('change', '#defaultAdderess', function() {
   var address_id = $('#defaultAdderess:checked').val();
   var user_id = $('#user_id').val();
   $.ajax({
    method: "post",
    url: site_url + "getUserAddress",
    data: {
      language: default_language,
	  user_id : user_id,
      [csrfName]: csrfHash
    },
    success: function (response) {
	   var parsedJSON = response.Information.address_details;
		
	   $(parsedJSON).each(function () {
		   if(address_id == this.address_id)
		   {
			   
			   
			   $("#fullname").val(this.fullname);
			   $("#mobile").val(this.mobile);
			   $("#state").val(this.state);
			   $("#state").val(this.state);
			   $("#pincode").val(this.pincode);
			   $("#email").val(this.email);
			   $('#city').val(this.city_id).trigger("change");
			   //$("#city option:selected").val(this.city_id);
			   //$("#city").children("option:selected").val(this.city_id);
			   $("#fulladdress").val(this.fulladdress);
			   //alert(this.city_id);
			   
		   }
	   });
	  
	}
  });
	//alert(selectVal);
  //get_brand_product(hidden_brandid, id, 0)
});

function place_order_data(event) {
 var tab = $("#payment-tab").attr("aria-selected");
    //alert("active---"+tab+"---");
   var fullname = $("#fullname").val();
  var mobile = $("#mobile").val();
  var state = $("#state").val();
  var pincode = $("#pincode").val();
  var city = $("#city").val();
  var email = $("#email").val();
  var user_id = $("#user_id").val();
  var fulladdress = $("#fulladdress").val();
  var city_id = $("#city option:selected").val();
  
  if(fulladdress == "" || fulladdress == null && fullname == "" || fullname == null && state == "" || state == null && city == "" || city == null)
  {  

	if(fullname == "" || fullname == null)
  {
		$("#fullname_error").text("Please Add Name.");
  }
  else 
  {
		$("#fullname_error").text("");
  } 
  if(mobile == "" || mobile == null)
  {
		$("#mobile_error").text("Please Add Mobile No.");
  }
  else 
  {
		$("#mobile_error").text("");
  }
  if(state == "" || state == null)
  {
		$("#state_error").text("Please Select State.");
  }
  else 
  {
		$("#state_error").text("");
  }
  //else if(pincode == "" || pincode == null)
  //{
		//alert('please Add Pincode.');
  //}
  if(city == "" || city == null)
  {
		$("#city_error").text("Please Select City.");
  }
  else 
  {
		$("#city_error").text("");
  }
  
  //else if(email == "" || email == null)
  //{
		//alert('please Add Email.');
  //}
  if(fulladdress == "" || fulladdress == null)
  {
		$("#fulladdress_error").text("Please Add Full Address.");
  }
  else 
  {
		$("#fulladdress_error").text("");
  }
  
/*if( ){
  /// write address filed validation code
}else if(){ */

}
else {

	$("#fullname_error").text("");
	$("#mobile_error").text("");
	$("#state_error").text("");
	$("#city_error").text("");
	$("#fulladdress_error").text("");

	if(tab == 'true'){
		
 // alert("call true");
 
 var spinner = '<div class="spinner-border" role="status"><span class="se-only"></span></div> Please Wait..';
$('.paymentMethodBtn').html(spinner);
$(".paymentMethodBtn").prop('disabled', true);
  //  alert(" place order req send ");
  $.ajax({
    method: "post",
    url: site_url + "placeOrder",
    data: {
      language: default_language,
      fullname: fullname,
      mobile: mobile,
      locality: '',
      fulladdress: fulladdress,
      city: $('#city').find(":selected").text(),
      state: state,
      pincode: pincode,
      addresstype: 'Home',
      email: email,
      payment_id: 'Pay12345',
      payment_mode: 'COD',
	  city_id : city_id,
      [csrfName]: csrfHash,
    },
    success: function (response) {
	  $(".paymentMethodBtn").prop('disabled', false);
	  $('.paymentMethodBtn').text('Place Order');
      //hideloader();
	 
      if(response.status == 1)
	  {
		  // alert(response.status);
		  //location.href = site_url + "thankyou/" + order_id;
	  setTimeout(function () {
        var order_id = response.Information.order_id;
        location.href = site_url + "thankyou/" + order_id;
      }, 100);
	  
	}
	else
	{
      Swal.fire({
        position: "center",
        //icon: "success",
        title: response.Information.order_msg,
        showConfirmButton: false,
        confirmButtonColor: "#ff5400",
        timer: 3000,
      });
	}
      //alert(response.Information.order_msg);
      //var order_id = response.Information.order_id
      //location.href=site_url+'thankyou/'+ order_id;

      //var parsedJSON = JSON.parse(response);
      //$(parsedJSON.Information).each(function() {
      //	 alert(this.order_id);
      //});
      //location.href=site_url+'thankyou';
    },
  });
	 

 
 }else{
    //alert ("call else ");
	///$('#payment-tab').
 $('#address-tab').attr('aria-selected', false);
 $("#address-tab").removeClass('active');
 $("#address").removeClass('active');
 $("#address").removeClass('show');
 
 $("#payment-tab").addClass('active');
 $("#payment").addClass('active');
 $("#payment").addClass('show');
 $('#payment-tab').attr('aria-selected', true);	 
 }
	
}
 
 
/*
  event.preventDefault();
  var fullname = $("#name").val();
  var mobile = $("#mobile").val();
  var state = $("#state").val();
  var pincode = $("#pincode").val();
  var city = $("#city").val();
  var email = $("#email").val();
  var user_id = $("#user_id").val();
  var fulladdress = $("textarea#address").val();
  
  

 */
}

function apply_coupon(event) {
  var total_value = $("#total_value").val();
  var coupon_code = $("#coupon_code").val();
  event.preventDefault();

  $.ajax({
    method: "post",
    url: site_url + "apply_coupon",
    data: {
      language: 1,
      coupon_code: coupon_code,
      price: "1000",
      [csrfName]: csrfHash,
    },
    success: function (response) {
      //hideloader();
      Swal.fire({
        position: "center",
        //icon: "success",
        title: response.msg,
        showConfirmButton: false,
        confirmButtonColor: "#ff5400",
        timer: 3000,
      });
      //alert(response.msg);
      //location.reload();
    },
  });
}

$("#formoid").submit(function (event) {
  event.preventDefault();

  var fullname = $("#fullname").val();
  var mobile = $("#mobile").val();
  var state = $("#state").val();
  var pincode = $("#pincode").val();
  var city = $("#city").val();
  var email = $("#email").val();
  var fulladdress = $("#fulladdress").val(); 
  var city_id = $("#city option:selected").val();
  
  if(fullname == "" || fullname == null)
  {
		$("#fullname_error").text("Please Add Name00.");
  }
  else if(mobile == "" || mobile == null)
  {
		$("#mobile_error").text("Please Add Mobile No.");
  }
  else if(state == "" || state == null)
  {
		$("#state_error").text("Please Select State.");
  }
  //else if(pincode == "" || pincode == null)
  //{
		//alert('please Add Pincode.');
  //}
  else if(city == "" || city == null)
  {
		$("#city_error").text("Please Select City.");
  }
  //else if(email == "" || email == null)
  //{
			//alert('please Add Email.');
  //}
  else if(fulladdress == "" || fulladdress == null)
  {
		$("#fulladdress_error").text("Please Add Full Address.");
		//alert('please Add Full Address.');
  }
  else {
	  //alert('ddd');
  $.ajax({
    method: "post",
    url: site_url + "addUserAddress",
    data: {
      language: default_language,
      username: fullname,
      mobile: mobile,
      pincode: pincode,
      locality: "",
      fulladdress: fulladdress,
      state: state,
      city: $('#city').find(":selected").text(),
      addresstype: "home",
      email: email,
	  city_id : city_id,
      [csrfName]: csrfHash,
    },
    success: function (response) {
      //hideloader();
      location.reload();
    },
  });
}
});

