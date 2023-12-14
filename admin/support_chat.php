<?php
include('session.php');

if(!isset($_SESSION['admin'])){
  header("Location: index.php");

}else if(!isset($_REQUEST['id'])){
	  header("Location: dashboard.php");
}
 
 include("header.php"); ?>
	<style>
		.container {
		border: 2px solid #dedede;
		background-color: #f1f1f1;
		border-radius: 5px;
		padding: 10px;
		margin: 10px 10px;
		width:98%;
		}
		
		.darker {
		border-color: #ccc;
		background-color: #ddd;
		}

		.light {
			border-color: #ccc;
			background-color: #f5f5f5;
		}

		.container::after {
		content: "";
		clear: both;
		display: table;
		}
		
		.container img {
		float: left;
		max-width: 60px;
		width: 100%;
		margin-right: 20px;
		border-radius: 50%;
		}
		
		.container img.right {
		float: right;
		margin-left: 20px;
		margin-right:0;
		}

		.time-right {
		float: right;
		color: #aaa;
		}
		
		.time-left {
		float: left;
		color: #999;
		}
</style>
<div class="content-page">
	<!-- Start content -->
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="page-title-box">
						<h4 class="page-title">Support</h4>
					</div>
				</div>
			</div>
			<!-- end page title -->
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="activity_box">
										<div id="chat_div" style="height: 350px;overflow: auto;">
											<?php 
									
									$query = $conn->query("SELECT * FROM vendor_admin_chat WHERE  user_id = '".$_REQUEST["id"]."' AND status='Y' ORDER BY created_at ASC");
									
									if($query->num_rows > 0){
										while($row = $query->fetch_assoc()){
											$time = date('H:i A',strtotime($row['created_at']));
											if($row['message_by'] =='VENDOR'){
												echo '<div class="container light">
														<img src="'.BASEURL.'bandmember.jpg" alt="Avatar" style="height: 40px;width: 40px;position: relative; margin-top: 10px;">
														<p>'.$row['message'].'</p>
														<span class="time-right">'.$time.'</span>
													</div>';
											}else{
												echo '<div class="container darker">
													<img src="'.BASEURL.'avatar_g2.jpg" alt="Avatar" class="right" style="height: 40px;width: 40px;position: relative; margin-top: 10px;">
													<p>'.$row['message'].'</p>
													<span class="time-left">'.$time.'</span>
												</div>';
											}
											
										}
									}
								?>

										</div>
										<div class="panel-footer">
											<div class="input-group">
												<input id="message" type="text" class="form-control input-sm" placeholder="Type your message here...">
												<span class="input-group-btn">
													<button class="btn btn-dark waves-effect waves-light" id="btn_chat">Send</button>
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="clearfix"> </div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>



	
<script>
	$(document).ready(function(){
		
		
		$('#chat_div').scrollTop($('#chat_div')[0].scrollHeight);
		var code_ajax = $("#code_ajax").val();
		
		setInterval(function(){ getmessage(code_ajax); }, 2000);
		
		$("#btn_chat").click(function(event){
			event.preventDefault();
			
			var message = $('#message').val();
			var vendor_id = '<?php echo $_REQUEST["id"]; ?>';
			
			if(!message){
				successmsg("Please enter message");
			}else {	
				
				var form_data = new FormData();                  
				
				form_data.append('message', message);
				form_data.append('vendor_id', vendor_id);
				form_data.append('type', 'chat');
				form_data.append('code', code_ajax);
				
				$.ajax({
					method: 'POST',
					url: 'get_support_chat_data.php',
					data:form_data,
					contentType: false,
					processData: false,
					success: function(response){
						if(response !='error'){
							if(response){
								$('#chat_div').append(response);
								$('#message').val('');
								$('#chat_div').scrollTop($('#chat_div')[0].scrollHeight);
							}
						}else{
							successmsg("Please try again");
						}
					}
				});
			}
			
        });
    });
		
	function getmessage(code_ajax){
		if(code_ajax){
			var vendor_id = '<?php echo $_REQUEST["id"]; ?>';
			var form_data = new FormData();                  
				
			form_data.append('message', message);
			form_data.append('vendor_id', vendor_id);
			form_data.append('type', 'get_chat');
			form_data.append('code', code_ajax);
			
			$.ajax({
				method: 'POST',
				url: 'get_support_chat_data.php',
				data:form_data,
				contentType: false,
				processData: false,
				success: function(response){
					if(response !='error'){
						if(response){
							$('#chat_div').append(response);
						
							$('#chat_div').scrollTop($('#chat_div')[0].scrollHeight);
						}
					}else{
						successmsg("Please try again");
					}
				}
			});
		}
	}
</script>
	<!--footer-->
        <?php include("footernew.php"); ?>
    <!--//footer-->

</div>