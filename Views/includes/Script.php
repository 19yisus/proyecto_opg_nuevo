<script src="./Views/plugins/bootstrap-5.2.0-beta1-dist/js/bootstrap.min.js"></script>
<script src="./Views/plugins/fontawesome-free-6.1.1-web/js/all.js"></script>
<script src="./Views/Js/Vue.js"></script>
<!-- Jquery -->
<!-- Jquery Valitations -->
<script src="./Views/jQuery.js"></script>
<script src="./Views/jquery-validations/jquery.validate.js"></script>
<script src="./Views/jquery-validations/additional-methods.js"></script>
<!-- <script src="./Views/jquery-validations/lib/jquery-3.1.1.js"></script> -->
<!-- <script src="./Views/Js/jquery/jquery.min.js"></script> -->
<!-- <script src="./Views/Js/jquery-validation/jquery.validate.min.js"></script>
<script src="./Views/Js/jquery-validation/addional-methods.min.js"></script> -->

<!-- <script src="./Views/jquery-validations/dist/jquery.validate.min.js"></script>
<script src="./Views/jquery-validations/dist/addional-methods.min.js"></script> -->

<!-- DataTalbes -->
<script src="./Views/plugins/DataTables/datatables.min.js"></script>
<!-- Bootstrap DataTables -->
<script src="./Views/plugins/DataTables/DataTables-1.12.1/js/dataTables.dataTables.min.js"></script>
<script src="./Views/plugins/DataTables/DataTables-1.12.1/js/dataTables.bootstrap5.min.js"></script>
<!-- Buttons DataTables -->
<script src="./Views/plugins/DataTables/Buttons-2.2.3/js/buttons.bootstrap5.min.js"></script>
<!-- Moment -->
<script src="./Views/Js/Moment.js"></script>
<!-- SweetAlert2 -->
<script src="./Views/Js/SweetAlert2.js"></script>

<script>
	const ViewAlert = (sms, type) => {
		let Toast = Swal.mixin({
			toast: true,
			position: "top-end",
			showConfirmButton: false,
			timer: 4000
		});

		Toast.fire({
			icon: `${type}`,
			title: `${sms}`
		})
	}
</script>
<?php 
	if(isset($_GET['codigo'])){
		if($_GET['codigo'] == '200'){
			?>
			<script> ViewAlert("<?php echo $_GET['mensaje'];?>","success");</script>
			<?php 
		}else{
			?>
			<script> ViewAlert("<?php echo $_GET['mensaje'];?>","error");</script>
			<?php 
		}
	}
?>