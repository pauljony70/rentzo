<?php

include('session.php');





if (!$Common_Function->user_module_premission($_SESSION, $Orders)) {

	echo "<script>location.href='no-premission.php'</script>";
	die();
}

if (!isset($_SESSION['admin'])) {

	header("Location: index.php");
}
?>

<?php include("header.php"); ?>

<input type="hidden" name="seller_id" id="seller_id0" value="<?php echo $_REQUEST['id']; ?>">

<style>
#myModal .modal-body {
    border: 1px solid var(--primary);
    display: flex;
    flex-direction: column-reverse;
    overflow-y: auto;
    color: #000;
    font-size: 12px;
    font-style: normal;
    font-weight: 400;
    line-height: 15px;
    letter-spacing: 0.24px;
	height : 350px;
	margin : 5px;
}
#myModal .modal-body .seller-message .message {
    border-radius: 0px 2px 2px 0px;
    border: 1px solid var(--primary);
    border-left: none;
    background: #F0ECEC;
}

.seller-message_title {
    border-left: none;
    background: #F0ECEC;
}

.user-message_title {
    border-right: none;
    background: rgba(0, 142, 204, 0.60);
}

#myModal .modal-body .user-message .message {
    border-radius: 2px 0px 0px 2px;
    border: 1px solid var(--primary);
    border-right: none;
    background: rgba(0, 142, 204, 0.60);
}
.send_seller,.user_seller {
    position: fixed;
    bottom: 18px;
    font-size: 10px;
    color: #504c4ce8;
}
</style>

<!-- main content start-->

<div class="content-page">
	<!-- Start content -->
	<div class="content">
		<div class="container-fluid">
			<!-- start page title -->
			<div class="row">
				<div class="col-12">
					<div class="page-title-box">
						<h4 class="page-title">All Chats</h4>
					</div>
				</div>
			</div>
			<!-- end page title -->

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div data-example-id="simple-form-inline">

								<div class="row align-items-center">
									<div class="col-md-9 mb-2">
										<form class="form d-flex flex-wrap">

											
											<input type="text" id="order_id" name="order_id"  class="form-control1 mr-1" placeholder="Order Id">

											<button type="submit" href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" id="searchName"><i class="fa fa-search"></i></button>
										</form>
									</div>
									<div class="col-md-3 mb-2">
										<div class="d-flex align-items-center">
											<div class="ml-md-auto">
												<div class="d-flex align-items-center">
													<span>Show</span>
													<select class="form-control mx-1" id="perpage" name="perpage" onchange="perpage_filter()" style="float:left;">

														<option value="10">10</option>

														<option value="25">25</option>

														<option value="50">50</option>

													</select>
													<span class="pull-right per-pag">entries</span>
												</div>
											</div>
										</div>
									</div>
								</div>

							</div>

							<div class="work-progres">

								<div class="table-responsive">

									<table class="table table-hover" id="tblname" style="overflow-x: auto;">

										<thead class="thead-light">

											<tr>

												<th>S.N.</th>
												<th>Order Id</th>
												<th>Product Id</th>
												<th>Unseen Sms</th>
												<th>Action</th>


											</tr>

										</thead>

										<tbody id="tbodyPostid">



										</tbody>

									</table>

								</div>

								<div class="row align-items-center">
									<div class="col-md-6">
										<div class="pull-right" style="float:left;">
											Total Row : <a id="totalrowvalue" class="totalrowvalue"></a>
										</div>
									</div>
									<div class="col-md-6">
										<div class="pull-right page_div ml-auto" style="float:right;"> </div>
									</div>
								</div>


							</div>

							<div class="clearfix"> </div>

						</div>
					</div>
				</div>
			</div>


		</div>

		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog  modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">View Message </h5> <span class="seller-message_title mx-1 px-1">Seller</span><span class="user-message_title mx-1 px-1">User</span>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body px-0" id="messageContainer">
					</div>

				</div>

			</div>
		</div>



		<div class="clearfix"></div>

	</div>

	<!-- //calendar -->

	<div class="col_1">

		<div class="clearfix"> </div>

	</div>



</div>


<!--footer-->

<?php include("footernew.php"); ?>
<script src="js/admin/all_chats.js"></script> 
<!--//footer-->
<script>
	$(document).on("click", ".open-modal", function() {
		var id = $(this).data('id');
		var order_id = $(this).data('order_id');
		//$('#seller_id').val(id);
		//$('#order_id').val(order_id);
		
		
		 $.ajax({

            method: 'POST',

            url: 'get_user_wise_chats_data.php',

            data: {

               
                order_id: order_id,


            },

            success: function (response) {
			
			$('#messageContainer').html(response);
                


            }

        });
		
		
		 $.ajax({
                    method: 'POST',
                    url: 'add_security_payment_process.php',
                    data: form_data,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        $.busyLoadFull("hide");
                        $("#myModal").modal('hide');
                        $('#transection_id').val('');
                        $('#invoice_proof').val('');
                        successmsg(response);
                    }
                });

	});
</script>