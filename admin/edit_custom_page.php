<?php
include('session.php');

if (!$Common_Function->user_module_premission($_SESSION, $StoreSettings)) {
	echo "<script>location.href='no-premission.php'</script>";
	die();
}

if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
}

if (!$_GET['id']) {
	header("Location: index.php");
	die;
}


include("header.php");

?>

<!-- main content start-->
<div class="content-page">
	<!-- Start content -->
	<div class="content">
		<div class="container-fluid">
			<!-- start page title -->
			<div class="row">
				<div class="col-12">
					<div class="page-title-box">
						<h4 class="page-title">Custom Page Settings</h4>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<div class="card">
						<div class="card-body">

							<div class="bs-example widget-shadow" data-example-id="hoverable-table">

								<div class="form-three widget-shadow">

									<?php
									$query = $conn->query("SELECT * FROM `seometa` where metaid ='" . $_REQUEST['id'] . "'");

									$rows = $query->fetch_assoc();

									?>
									<form class="form" id="update_brand_form" enctype="multipart/form-data">


										<div class="form-group">
											<label for="name">Page Title</label>
											<input type="text" class="form-control" value="<?php echo $rows['page_title'];  ?>" id="update_page_title" placeholder="Page Title">
										</div>
										<div class="form-group">
											<label for="name">Page Heading</label>
											<input type="text" class="form-control" value="<?php echo $rows['page_heading'];  ?>" id="update_page_heading" placeholder="Page Heading">
										</div>
										<div class="form-group">
											<label for="name">Page Slug</label>
											<input type="text" class="form-control" value="<?php echo $rows['page_slug']; ?>" id="update_page_slug" placeholder="Page Slug">
										</div>
										<div class="form-group">
											<label for="name">Meta Tags</label>
											<input type="text" class="form-control" value="<?php echo $rows['meta_tags']; ?>" id="update_meta_tags" placeholder="Meta Tags">
										</div>
										<div class="form-group">
											<label for="name">Meta Description</label>
											<input type="text" class="form-control" value="<?php echo $rows['meta_desc']; ?>" id="update_meta_dsc" placeholder="Meta Description">
										</div>
										<div class="form-group">
											<label for="name">Meta Keywords</label>
											<input type="text" class="form-control" value="<?php echo $rows['meta_keys']; ?>" id="update_meta_keys" placeholder="Meta Keywords">
										</div>

										<div class="form-group">
											<label for="name">Caninocial Url</label>
											<input type="text" class="form-control" value="<?php echo $rows['caninocial_url']; ?>" id="update_caninocial_url" placeholder="Caninocial Url">
										</div>
										<div class="form-group">
											<label for="name">Page Content</label>
											<textarea class="form-control" id="update_page_content" placeholder="Page Content"><?php echo $rows['page_content']; ?></textarea>
										</div>
										<input type="hidden" class="form-control" id="metaid" value="<?php echo $rows['metaid']; ?>">
										<button type="submit" class="btn btn-dark waves-effect waves-light" value="Upload" href="javascript:void(0)" id="update_meta_btn">Update </button>
									</form>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>



			<div class="clearfix"> </div>

		</div>

	</div>

</div>
<!--footer-->
<?php include("footernew.php"); ?>
<!--//footer-->

<script>
	var code_ajax = $("#code_ajax").val();

	$(document).ready(function() {
		$("#update_meta_btn").click(function(event) {
			event.preventDefault();

			var page_title = $('#update_page_title').val();
			var page_heading = $('#update_page_heading').val();
			var meta_tags = $('#update_meta_tags').val();
			var meta_dsc = $('#update_meta_dsc').val();
			var meta_keys = $('#update_meta_keys').val();
			var page_content = tinyMCE.get('update_page_content').getContent();
			var caninocial_url = $('#update_caninocial_url').val();
			var metaid = $('#metaid').val();
			var statuss = $('#status').val();
			var update_page_slug = $('#update_page_slug').val();

			if (!page_title) {
				successmsg("Please enter Page Title");
			}
			if (!page_heading) {
				successmsg("Please enter Page Heading");
			}
			if (!update_page_slug) {
				successmsg("Please enter Page Slug");
			}

			if (page_title && page_heading && update_page_slug) {
				$.busyLoadFull("show");
				var form_data = new FormData();
				form_data.append('page_title', page_title);
				form_data.append('metaid', metaid);
				form_data.append('page_heading', page_heading);
				form_data.append('meta_tags', meta_tags);
				form_data.append('meta_dsc', meta_dsc);
				form_data.append('meta_keys', meta_keys);
				form_data.append('page_content', page_content);
				form_data.append('caninocial_url', caninocial_url);
				form_data.append('page_slug', update_page_slug);
				form_data.append('code', code_ajax);

				$.ajax({
					method: 'POST',
					url: 'edit_meta_process.php',
					data: form_data,
					contentType: false,
					processData: false,
					success: function(response) {
						$.busyLoadFull("hide");

						successmsg(response);
						//$('#update_brand_image').val('');
					}
				});
			}

		});

		if ($("#update_page_content").length > 0) {
			tinymce.init({
				selector: "textarea#update_page_content",
				theme: "modern",
				height: 300,
				plugins: [
					"advlist lists print",
					"wordcount code fullscreen",
					"save table directionality emoticons paste textcolor"
				],
				toolbar: " undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",

			});
		}
	})
</script>