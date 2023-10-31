<?php
include('session.php');

if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
}

include("header.php"); ?>
<style>
	.darker {
		border-color: #ccc;
		background-color: #ddd;
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
		margin-right: 0;
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
<!-- main content start-->
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

											$query = $conn->query("SELECT * FROM vendor_admin_chat WHERE  user_id = '" . $_SESSION['admin'] . "' AND status ='Y' ORDER BY created_at ASC");

											if ($query->num_rows > 0) {
												while ($row = $query->fetch_assoc()) {
													$time = date('H:i A', strtotime($row['created_at']));
													if ($row['message_by'] == 'ADMIN') {
														echo '<div class="container my-1">
														<img src="/w3images/bandmember.jpg" alt="Avatar" style="width:100%;">
														<p>' . $row['message'] . '</p>
														<span class="float-right">' . $time . '</span>
													</div>';
													} else {
														echo '<div class="container darker my-1">
													<img src="/w3images/avatar_g2.jpg" alt="Avatar" class="right" style="width:100%;">
													<p>' . $row['message'] . '</p>
													<span class="float-left">' . $time . '</span>
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
<div class="clearfix"> </div></br>

<!--footer-->
<?php include("footernew.php"); ?>

<script>
	$(document).ready(function() {


		$('#chat_div').scrollTop($('#chat_div')[0].scrollHeight);
		var code_ajax = $("#code_ajax").val();

		setInterval(function() {
			getmessage(code_ajax);
		}, 2000);

		$("#btn_chat").click(function(event) {
			event.preventDefault();

			var message = $('#message').val();
			var vendor_id = "<?php echo $_SESSION['admin']; ?>";

			if (!message) {
				successmsg("Please enter message");
			} else {

				var form_data = new FormData();

				form_data.append('message', message);
				form_data.append('vendor_id', vendor_id);
				form_data.append('type', 'chat');
				form_data.append('code', code_ajax);

				$.ajax({
					method: 'POST',
					url: 'get_support_chat_data.php',
					data: form_data,
					contentType: false,
					processData: false,
					success: function(response) {
						if (response != 'error') {
							if (response) {
								$('#chat_div').append(response);
								$('#message').val('');
								$('#chat_div').scrollTop($('#chat_div')[0].scrollHeight);
							}
						} else {
							successmsg("Please try again");
						}
					}
				});
			}

		});
	});

	function getmessage(code_ajax) {
		if (code_ajax) {
			var vendor_id = "<?php echo $_SESSION['admin']; ?>";
			var form_data = new FormData();

			form_data.append('message', message);
			form_data.append('vendor_id', vendor_id);
			form_data.append('type', 'get_chat');
			form_data.append('code', code_ajax);

			$.ajax({
				method: 'POST',
				url: 'get_support_chat_data.php',
				data: form_data,
				contentType: false,
				processData: false,
				success: function(response) {
					if (response != 'error') {
						if (response) {
							$('#chat_div').append(response);
							$('#chat_div').scrollTop($('#chat_div')[0].scrollHeight);
						}
					} else {
						successmsg("Please try again");
					}
				}
			});
		}
	}
</script>
<!--//footer-->