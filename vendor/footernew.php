<!--footer-->
<div class="footer">
	<p class="text-center mb-0">&copy; <?php echo date('Y'); ?> <span><?php echo $Common_Function->get_system_settings($conn, 'system_name'); ?> </span>. All Rights Reserved | Design and developed by <a href="https://www.blueappsoftware.com/" class="text-dark" target="_blank">BlueApp Software</a></p>
</div>
<!--//footer-->
</div>
<script src="<?php echo BASEURL; ?>assets/js/classie.js"></script>
<script>
	function edit_orders(order_id, prod_id) {
		location.href = "edit_order.php?orderid=" + order_id + "&product_id=" + prod_id;
	}
</script>
<!-- //Classie --><!-- //for toggle left push menu script -->
<!--scrolling js-->
<!-- <script src="<?php echo BASEURL; ?>assets/js/jquery.nicescroll.js"></script>
<script src="<?php echo BASEURL; ?>assets/js/scripts.js"></script> -->
<!--//scrolling js-->

<!-- Vendor js -->
<script src="assets/libs/mohithg-switchery/switchery.min.js"></script>
<script src="assets/libs/multiselect/js/jquery.multi-select.js"></script>
<script src="assets/libs/select2/js/select2.min.js"></script>
<script src="assets/libs/jquery-mockjax/jquery.mockjax.min.js"></script>
<script src="assets/libs/devbridge-autocomplete/jquery.autocomplete.min.js"></script>
<script src="assets/libs/bootstrap-select/js/bootstrap-select.min.js"></script>
<script src="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script src="assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
<script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="assets/libs/clockpicker/bootstrap-clockpicker.min.js"></script>
<script src="assets/libs/busyload/app.min.js"></script>

<!-- third party js -->
<script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
<script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="assets/libs/ajax-form/jquery.form.min.js"></script>
<!-- third party js ends -->

<!-- Plugins js-->
<script src="assets/libs/flatpickr/flatpickr.min.js"></script>
<script src="assets/libs/apexcharts/apexcharts.min.js"></script>
<script src="assets/libs/parsleyjs/parsley.min.js"></script>
<script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
<script src="assets/libs/selectize/js/standalone/selectize.min.js"></script>
<script src="assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
<script src="assets/libs/dropzone/min/dropzone.min.js"></script>
<script src="assets/libs/dropify/js/dropify.min.js"></script>
<script src="assets/libs/auto-complete/jquery-ui.js"></script>
<script src="assets/libs/ladda/spin.min.js"></script>
<script src="assets/libs/ladda/ladda.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.4/tinymce.min.js" integrity="sha512-kQSkkpoq98tNK/kdapmHfgiLLNnpu3nsyUX5O67/9sr+qKN25tNBo07y/8NM/usymGx2Qif4FawiqbCjOFkaFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- App js-->
<script src="assets/js/app.min.js"></script>

<!-- push custom script & js -->
<script src="js/admin/common.js"></script>
<script src="<?php echo BASEURL; ?>assets/js/jquery.multiselect.js"></script>
<script>
	/* document.addEventListener("DOMContentLoaded", function() {
		console.log('first');
		var loadingAnimation = document.getElementById("loading-animation");
		loadingAnimation.style.display = "none";
	}); */
	document.addEventListener('DOMContentLoaded', function() {
		var loader = document.getElementById('loading-animation');
		loader.style.display = 'flex'; // Show the loader initially
		console.log('first');
		// Hide the loader when the document finishes loading
		window.addEventListener('load', function() {
			loader.style.display = 'none';
		});
	});
</script>
</body>

</html>