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
								<h5 class="card-title">Daftar Matakuliah</h5>
								<button class="btn bg-lp3i float-right" onclick="return tambah()"><i class="icon-database-add"></i> TAMBAH</button>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-lg-3"></div>
									<div class="col-lg-6">
										<?php
										if ($this->session->flashdata('pesan') != '') {
											echo '<div class="alert alert-success bg-lp3i alert-styled-left alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                                        <h5><i class="icon fas fa fa-check"></i>';
											echo $this->session->flashdata('pesan');
											$this->session->set_flashdata('pesan', '');
											echo '</h5></div>';
										}
										?>
									</div>
									<div class="col-lg-3"></div>
								</div>
								<div class="table-responsive">
									<table class="table table-framed" id="datatable-basic">
										<thead class="bg-lp3i">
											<tr>
												<th width="10px" class="text-center">No</th>
												<th width="100px" class="text-center">Kode Matakuliah</th>
												<th width="100px" class="text-center">Matakuliah</th>
												<th width="10px" class="text-center">Sks</th>
												<th width="100px" class="text-center">Nama Jurusan</th>
												<th width="150px" class="text-center">Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$no = 1;
											foreach ($matkul as $r) { ?>
												<tr>
													<td width="10px" class="text-center"><?= $no++ ?></td>
													<td width="100px" class="text-center"><?= $r->kodematakuliah ?></td>
													<td width="100px" class="text-center"><?= $r->matakuliah ?></td>
													<td width="100px" class="text-center"><?= $r->sks ?></td>
													<td width="100px" class="text-center"><?= $r->nama_jurusan ?></td>
													<td width="150px" class="text-center">
														<button class="btn btn-success btn-sm" onclick="return ubah('<?= $r->id_matkul ?>','<?= $r->kodematakuliah ?>', '<?= $r->matakuliah ?>','<?= $r->sks ?>', '<?= $r->id_jurusan ?>', '<?= $r->nama_jurusan ?>')"><i class="icon-database-edit2"></i> UBAH</button>
														<button class="btn btn-danger btn-sm" onclick="return hapus('<?= $r->id_matkul ?>','<?= $r->matakuliah ?>')"><i class="icon-database-remove"></i> Hapus</button>
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

		$('[name="kodematakuliah"]').attr("required", "required");
		$('[name="matakuliah"]').attr("required", "required");

		$('.modal-dialog').addClass('modal-sm');
		$('.modal-dialog').removeClass('modal-sm');
		$('#submit').html('SIMPAN');
		$('.hapus').addClass('d-none');
		$('.input').removeClass('d-none');
		$('#formId').attr('action', '<?= base_url() ?>pendidikan/simpan_matkul');
	}

	function ubah(id_matkul, kodematakuliah, matakuliah, sks, id_jurusan, nama_jurusan) {
		$('#myModal').modal({
			backdrop: 'static',
			keyboard: false
		});
		$('.modal-title').html('Ubah');

		$('[name="kodematakuliah"]').val(kodematakuliah);
		$('[name="matakuliah"]').val(matakuliah);
		$('[name="sks"]').val(sks);
		$('[name="id_jurusan"]').val(id_jurusan);

		$('[id^="select2-sks-"]').html(sks);
		$('[id^="select2-id_jurusan-"]').html(nama_jurusan);

		$('[name="kodematakuliah"]').attr("required", "required");
		$('[name="matakuliah"]').attr("required", "required");
		$('[name="sks"]').attr("required", "required");
		$('[name="id_jurusan"]').attr("required", "required");

		$('.modal-dialog').addClass('modal-sm');
		$('.modal-dialog').removeClass('modal-sm');
		$('#submit').html('SIMPAN');
		$('.hapus').addClass('d-none');
		$('.input').removeClass('d-none');
		$('#formId').attr('action', '<?= base_url() ?>pendidikan/ubah_matkul/' + id_matkul);
	}

	function hapus(id_matkul, matakuliah) {
		$('#myModal').modal({
			backdrop: 'static',
			keyboard: false
		});
		$('.modal-title').html('Hapus');

		$('[name="id"]').val(id_matkul);
		$('[name="matakuliah"]').val(matakuliah);
		$('.hapus').html("Anda yakin akan menghapus matakuliah <b>" + matakuliah + "</b>?");
		$('#formId').attr('action', '<?= base_url() ?>pendidikan/hapus_matkul/' + id_matkul);
		$('#submit').removeClass('d-none');

		$('.modal-dialog').removeClass('modal-xl');
		$('.modal-dialog').addClass('modal-lg');
		$('#submit').html('HAPUS');
		$('.input').addClass('d-none');
		$('.hapus').removeClass('d-none');

		//hilangkan required
		$('[name="kodematakuliah"]').removeAttr("required");
		$('[name="matakuliah"]').removeAttr("required");
		$('[name="sks"]').removeAttr("required");
		$('[name="id_jurusan"]').removeAttr("required");
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
						<div class="col-12">
							<label class="col-form-label col-lg-12 p-0 font-weight-bold">Data Jurusan</label>
						</div>
						<input type="hidden" name="id" value="">

						<div class="col-3">
							<label class="col-form-label col-lg-12 pb-0 pt-2">Kode Mata Kuliah</label>
							<div class="col-lg-12 border rounded">
								<input type="text" class="form-control" name="kodematakuliah" value="" required>
							</div>
						</div>
						<div class="col-3">
							<label class="col-form-label col-lg-12 pb-0 pt-2">SKS</label>
							<div class="col-lg-12 border rounded">
								<select name="sks" class="form-control select-search" data-fouc required>
									<option value="">Pilih</option>
									<option value="2">2</option>
									<option value="4">4</option>
								</select>
							</div>
						</div>
						<div class="col-6">
							<label class="col-form-label col-lg-12 pb-0 pt-2">Jurusan</label>
							<div class="col-lg-12 border rounded">
								<select name="id_jurusan" class="form-control select-search" data-fouc required>
									<option value="">Pilih</option>
									<?php foreach ($jurusan as $r) { ?>
										<option value="<?= $r->id ?>"><?= $r->nama_jurusan ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-12">
							<label class="col-form-label col-lg-12 pb-0 pt-2">Mata Kuliah</label>
							<div class="col-lg-12 border rounded">
								<input type="text" class="form-control" name="matakuliah" value="" required>
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