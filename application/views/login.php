<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('template/head') ?>

<body class="bg-lp3i-grd">

	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content d-flex justify-content-center align-items-center">

				<!-- Login card -->
				<form class="login-form " action="#" method="POST" id="myForm">
					<div class="card mb-0">
						<div class="card-body ">
							<div class="text-center mb-2 pt-4">
								<img src="<?= base_url() ?>global_assets/images/silt.png" class="col-6">
								<span class="d-block text-muted mt-2">Sistem Informasi LP3i Tasikmalaya</span>
								<h5 class="mb-0">LOGIN</h5>
								<span class="d-block" id="msg"></span>
							</div>
							<?php
							if ($this->session->flashdata('pesan') != '') {
								echo '<div class="alert alert-warning bg-lp3i alert-styled-left alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                                        <h5><i class="icon fas fa fa-check"></i>';
								echo $this->session->flashdata('pesan');
								$this->session->set_flashdata('pesan', '');
								echo '</h5></div>';
							}
							?>
							<div class="form-group form-group-feedback form-group-feedback-left">
								<input type="text" name="username" class="form-control" placeholder="Username">
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">
								<input type="password" name="password" class="form-control" placeholder="Password">
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>

							<div class="form-group">
								<button type="button" class="btn btn-dark btn-block" onclick="return cek()">Login <i class="icon-circle-right2 ml-2"></i></button>
							</div>

						</div>
					</div>
				</form>
				<!-- /login card -->

			</div>
			<!-- /content area -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

</body>
<script>
	function cek() {
		$('#msg').html('<b class="text-info">Loading...</b>');
		var form = document.getElementById('myForm');
		var data = new FormData(form);
		$.ajax({
			type: 'POST',
			url: "<?= base_url() ?>Login/cek_login",
			data: data,
			contentType: false,
			cache: false,
			processData: false,
			success: function(data) {
				//pada hasil proses login menggunakan echo false jika gagal, echo akses jika berhasil
				if (data == "false") {
					$('#msg').html('<b class="text-danger">Username dan Password salah!</b> ');
				} else {
					$('#msg').html('<b class="text-success">Berhasil Login!</b>');
					window.location = "<?= base_url() ?>" + data;
				}
			},
			error: function(response) {
				console.log(response.responseText);
				$('#msg').html('<b class="text-danger">ERROR</b>');
			}
		});
	}
	$(document).ready(function() {
		$("#myFormLock").submit(function(e) {
			e.preventDefault();
		});
		$('[name="password"]').on('keypress', function(e) {
			if (e.which == 13) {
				cek();
			}
		});
		$('[name="username"]').on('keypress', function(e) {
			if (e.which == 13) {
				cek();
			}
		});
	});
</script>
<script>
	window.setTimeout(function() {
		$(".alert").fadeTo(500, 0).slideUp(500, function() {
			$(this).remove();
		});
	}, 3000)
</script>

</html>