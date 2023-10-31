 var csrfName = $('.txt_csrfname').attr('name'); // 
 var csrfHash = $('.txt_csrfname').val(); // CSRF hash
 var site_url = $('.site_url').val(); // CSRF hash


$("#formoid").submit(function(event) {

    event.preventDefault();
	
  var inputFirstName = $('#inputFirstName').val();
  var inputlastName = $('#inputlastName').val();
  var inputEmail = $('#inputEmail').val();
  var inputMessage = $('textarea#inputMessage').val();
	
  $.ajax({
		method: 'post',
		url: site_url+'send_mail',
		data: { inputFirstName : inputFirstName , inputlastName : inputlastName , inputEmail : inputEmail , inputMessage : inputMessage , [csrfName]: csrfHash},
		success: function(response){
			//hideloader();
			    //alert(response);
				//location.reload();
				Swal.fire({
				 position: "center",
				 //icon: "success",
				 title: response,
				 showConfirmButton: false,
				 confirmButtonColor: '#ff5400',
				 timer: 3000
			 })
			 setTimeout(function(){
				location.reload();
			}, 3000);
			
        }
   });

});