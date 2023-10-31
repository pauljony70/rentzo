var code_ajax = $("#code_ajax").val();


$(document).ready(function () {
	$("#sms_form").submit(function (event) {
		event.preventDefault();


		var active_sms_service = 'soft';
		var soft_url = $('#soft_url').val();
		var soft_sender = $('#soft_sender').val();
		var soft_user = $('#soft_user').val();
		var soft_password = $('#soft_password').val();


		if (soft_url == "" || soft_url == null) {
			successmsg("Please enter SMS URL");

		} else if (soft_sender == "" || soft_sender == null) {
			successmsg("Please enter SMS Sender");

		} else if (soft_user == "" || soft_user == null) {
			successmsg("Please enter SMS User Name");

		} else if (soft_password == "" || soft_password == null) {
			successmsg("Please enter SMS Password");

		} else {
			$.busyLoadFull("show");
			var form_data = new FormData();

			form_data.append('active_sms_service', active_sms_service);
			form_data.append('soft_url', soft_url);
			form_data.append('soft_sender', soft_sender);
			form_data.append('soft_user', soft_user);
			form_data.append('soft_password', soft_password);


			form_data.append('type', 'smtp_settings');
			form_data.append('code', code_ajax);
			$.ajax({
				method: 'POST',
				url: 'update_system_settings.php',
				data: form_data,
				contentType: false,
				processData: false,
				success: function (response) {
					$.busyLoadFull("hide");
					var data = $.parseJSON(response);
					if (data["status"] == "1") {
						successmsg(data["msg"]);


					} else {
						successmsg(data["msg"]);
					}
				}
			});
		}
	});

})

