 var csrfName = $('.txt_csrfname').attr('name'); // 
 var csrfHash = $('.txt_csrfname').val(); // CSRF hash
 var site_url = $('.site_url').val(); // CSRF hash


function cancel_order(pid,order_id) {
	
	Swal.fire({
		 position: "center",
		 //icon: "success",
		 title: 'Are you Sure to Cancelled Order?',
		 showConfirmButton: true,
		 showCancelButton: true,
		 confirmButtonText: 'Confirm',
		 cancelButtonText: 'Cancel',
		 confirmButtonColor: '#ff5400'
	 }).then((result) => {
		 if (result.isConfirmed) {
			 $.ajax({
				method: 'post',
				url: site_url+'cancelOrder',
				data: {language : 1 , pid : pid , order_id: order_id , [csrfName]: csrfHash},
				success: function(response){
					//hideloader();
					//$(".table").load(location.href + " .table");
					//alert(response.msg);
					location.reload();
				}
		   });
			
		 }
	 })
	
}