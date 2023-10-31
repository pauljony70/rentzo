 var csrfName = $('.txt_csrfname').attr('name'); // 
 var csrfHash = $('.txt_csrfname').val(); // CSRF hash
 var site_url = $('.site_url').val(); // CSRF hash


$("#formoid").submit(function(event) {

    event.preventDefault();
	
  var seller_name = $('#seller_name').val();
  var business_name = $('#business_name').val();
  var website = $('#website').val();
  var business_address = $('textarea#business_address').val();
  var business_details = $('textarea#business_details').val();
 // var gst = '';
  var pan_number = $('#pan_number').val();
  var selectcountry = 4;
  var selectstate = $('#selectstate').val();
  var selectcity = $('#selectcity').val();
  var pincode = $('#pincode').val();
  var phone = $('#phone').val();
  var email = $('#email').val();
  var passwords = $('#password').val();
  
//  var seller_logo = $('#seller_logo').prop('files')[0];
	//var pan_card = $('#pan_card').prop('files')[0];
	//var aadhar_card = $('#aadhar_card').prop('files')[0];
	//var business_proof = $('#business_proof').prop('files')[0];
	
	 var seller_logo = '';
	var pan_card = '';
	var aadhar_card = '';
	var business_proof = '';
	
  $.ajax({
		method: 'post',
		url: site_url+'add_seller',
		data: { seller_name : seller_name , business_name : business_name , website : website , business_address : business_address , business_details : business_details ,  pan_number : pan_number, selectcountry : selectcountry , selectstate : selectstate , selectcity : selectcity , pincode:pincode, phone:phone , email:email , passwords: passwords, seller_logo : seller_logo , pan_card : pan_card , aadhar_card:aadhar_card , business_proof : business_proof  ,  [csrfName]: csrfHash},
		success: function(response){
			//hideloader();
			    //alert(response);
				//location.reload();
				//Swal.fire({
				// position: "center",
				 //icon: "success",
				// title: response,
				 //showConfirmButton: false,
				 //confirmButtonColor: '#ff5400',
				 //timer: 1000
			// })
			// setTimeout(function(){
				 //thankyouseller.php
				 window.location = site_url + "thankyouseller";
				//location.reload();
			//}, 3000);
			
        }
   });

});