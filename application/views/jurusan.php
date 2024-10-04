<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('template/head') ?>

<body>

	<!-- Main navbar -->
	<?php $this->load->view('template/navbar') ?>
	<!-- /main navbar -->


	<!-- Page content -->
	<div class="page-content">

		<!-- Main sidebar -->
		<?php $this->load->view('template/sidebar') ?>
		<!-- /main sidebar -->


		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content pt-0 mt-3">

				<!-- Main charts -->
				<div class="row">
					<div class="col-xl-12">

						<!-- Traffic sources -->
						<div class="card">
							<div class="card-header header-elements-inline pb-0">
								<h5 class="card-title">Daftar Jurusan</h5>
								<button class="btn bg-lp3i float-right" onclick="return tambah()"><i class="icon-database-add"></i> TAMBAH</button>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-framed" id="datatable-basic">
										<thead class="bg-lp3i">
											<tr>
												<th width="10px" class="text-center">No</th>
												<th width="100px" class="text-center">Nama Jurusan</th>
												<th width="150px" class="text-center">Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$no = 1;
											foreach ($jurusan as $r) { ?>
												<tr>
													<td width="10px" class="text-center"><?= $no++ ?></td>
													<td width="100px" class="text-left"><?= $r->nama_jurusan ?></td>
													<td width="150px" class="text-center">
														<button class="btn btn-success btn-sm" onclick="return ubah('<?= $r->id ?>','<?= $r->nama_jurusan ?>')"><i class="icon-database-edit2"></i> UBAH</button>
														<button class="btn btn-danger btn-sm" onclick="return hapus('<?= $r->id ?>','<?= $r->nama_jurusan ?>')"><i class="icon-database-remove"></i> Hapus</button>
													</td>
												</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!-- /traffic sources -->

					</div>
				</div>
				<!-- /pendidikan content -->

			</div>
			<!-- /content area -->

			<!-- Footer -->
			<?php $this->load->view('template/footer') ?>
			<!-- /footer -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

</body>
<script>
	$('#datatable-basic').DataTable({
		autoWidth: false,
		dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
		language: {
			search: '<span>Filter:</span> _INPUT_',
			lengthMenu: '<span>Show:</span> _MENU_',
			paginate: {
				'first': 'First',
				'last': 'Last',
				'next': '→',
				'previous': '←'
			}
		}
	});

	function tambah() {
		$('#myModal').modal({
			backdrop: 'static',
			keyboard: false
		});
		$('.modal-title').html('Tambah');

		$('[name="kode_jurusan"]').attr("required", "required");
		$('[name="nama_jurusan"]').attr("required", "required");

		$('.modal-dialog').addClass('modal-sm');
		$('.modal-dialog').removeClass('modal-sm');
		$('#submit').html('SIMPAN');
		$('.hapus').addClass('d-none');
		$('.input').removeClass('d-none');
		$('#formId').attr('action', '<?= base_url() ?>pendidikan/simpan_jurusan');
	}

	function ubah(id, nama_jurusan) {
		$('#myModal').modal({
			backdrop: 'static',
			keyboard: false
		});
		$('.modal-title').html('Ubah');

		$('[name="nama_jurusan"]').val(nama_jurusan);

		$('[name="kode_jurusan"]').attr("required", "required");
		$('[name="nama_jurusan"]').attr("required", "required");

		$('[id^="select2-jenis-"]').html(jenis);
		$('[id^="select2-status-"]').html(status);

		$('.modal-dialog').addClass('modal-sm');
		$('.modal-dialog').removeClass('modal-sm');
		$('#submit').html('SIMPAN');
		$('.hapus').addClass('d-none');
		$('.input').removeClass('d-none');
		$('#formId').attr('action', '<?= base_url() ?>pendidikan/ubah_jurusan/' + id);
	}

	function hapus(id, nama_jurusan) {
		$('#myModal').modal({
			backdrop: 'static',
			keyboard: false
		});
		$('.modal-title').html('Hapus');

		$('[name="id"]').val(id);
		$('[name="nama_jurusan"]').val(nama_jurusan);
		$('.hapus').html("Anda yakin akan menghapus Jurusan <b>" + nama_jurusan + "</b>?");
		$('#formId').attr('action', '<?= base_url() ?>pendidikan/hapus_jurusan/' + id);
		$('#submit').removeClass('d-none');

		$('.modal-dialog').removeClass('modal-sm');
		$('.modal-dialog').addClass('modal-sm');
		$('#submit').html('HAPUS');
		$('.input').addClass('d-none');
		$('.hapus').removeClass('d-none');

		//hilangkan required
		$('[name="kode_jurusan"]').removeAttr("required");
		$('[name="nama_jurusan"]').removeAttr("required");
		$('[name="jenis"]').removeAttr("required");
		$('[name="status"]').removeAttr("required");
	}
</script>
<div id="myModal" class="modal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-lp3i">
				<h5 class="modal-title">Basic modal</h5>
				<button type="button" class="close ml-2" data-dismiss="modal">×</button>
			</div>
			<form id="formId" action="" method="POST">
				<div class="modal-body input">
					<div class="row">
						<input type="hidden" name="id" value="">

						<div class="col-12">
							<label class="col-form-label col-lg-12 p-0 font-weight-bold">Data Jurusan</label>
						</div>

						<div class="col-9">
							<label class="col-form-label col-lg-12 pb-0 pt-2">Nama Jurusan</label>
							<div class="col-lg-12 border rounded">
								<input type="text" class="form-control" name="nama_jurusan" value="" required>
							</div>
						</div>

					</div>
				</div>
				<div class="modal-body hapus h5">
				</div>
				<div class="modal-footer bg-lp3i-light">
					<button id="tutup" type="button" class="btn bg-grey" data-dismiss="modal">TUTUP</button>
					<button id="submit" type="submit" class="btn bg-lp3i">Save changes</button>
				</div>
			</form>
		</div>
	</div>
</div>

</html>
