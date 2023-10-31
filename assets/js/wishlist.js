 var csrfName = $('.txt_csrfname').attr('name'); // 
 var csrfHash = $('.txt_csrfname').val(); // CSRF hash
 var site_url = $('.site_url').val(); // CSRF hash


function delete_wishlist(prod_id,user_id) {
	$.ajax({
		method: 'post',
		url: site_url+'deleteProductWishlist',
		data: {language : 1 , pid : prod_id , user_id: user_id , devicetype : 2  , [csrfName]: csrfHash},
		success: function(response){
			//hideloader();
			    location.reload();
        }
   });
}


function add_to_cart_product(pid,sku,vendor_id,user_id,qty,referid,devicetype,qouteid) {
	  event.preventDefault();
	$.ajax({
		method: 'post',
		url: site_url+'addProductCart',
		data: {language : 1 , pid : pid , sku : sku , sid : vendor_id , user_id: user_id , qty : qty , referid : referid , devicetype : 2 , qouteid : qouteid , [csrfName]: csrfHash},
		success: function(response){
			//alert(response.msg);Cart added
			Swal.fire({
                 position: "center",
                 icon: "success",
                 title: response.msg,
                 showConfirmButton: false,
                 confirmButtonColor: '#ff5400',
                 confirmButtonText: 'View Cart',
                 timer: 3000
             });
			 if(response.msg == 'Cart added')
			 {
				 addto_cart_count();
				 delete_wishlist(pid,user_id);
		     }
			
			
			//delete_wishlist(pid,user_id);

			
        }
   });
}