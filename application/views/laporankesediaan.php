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
                                <h5 class="card-title">Laporan Kesediaan Mengajar</h5>
                                <a class="btn bg-lp3i float-right" href="<?= base_url() ?>Pendidikan/cetaklaporankesediaan_listall" target="_blank" >Cetak</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-framed" id="datatable-basic">
                                        <thead class="bg-lp3i">
                                            <tr>
                                                <th width="10px" class="text-center">No</th>
                                                <th width="200px" class="text-center">Dosen</th>
                                                <th width="100px" class="text-center">Total Matakuliah</th>
                                                <th width="100px" class="text-center">Total SKS</th>
                                                <th width="150px" class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($kesediaan as $r) { ?>
                                                <tr>
                                                    <td width="10px" class="text-center"><?= $no++ ?></td>
                                                    <td width="100px" class="text-center"><?= $r->nama ?></td>
                                                    <td width="100px" class="text-center"><?= $r->totalmatkul ?></td>
                                                    <td width="100px" class="text-center"><?= $r->totalsks ?></td>
                                                    <td width="150px" class="text-center">
                                                        <a class="btn btn-success btn-sm" href="<?= base_url()?>Pendidikan/cetaklaporankesediaan/<?= $r->username ?>" target="_blank">Cetak</a>
                                                        <a class="btn btn-info btn-sm" href="<?= base_url()?>Pendidikan/cetaklaporankesediaan_listdosen/<?= $r->username ?>" target="_blank">Cetak</a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /traffic sources -->
                        <!-- Traffic sources -->
            						<div class="card">
            							<div class="card-header header-elements-inline pb-2">
            								<h5 class="card-title">Laporan Kesediaan Mengajar Berdasarkan Jurusan</h5>
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
                                        <a class="btn bg-lp3i btn-sm" href="<?= base_url()?>Pendidikan/cetaklaporankesediaan_listjurusan/<?= $r->id ?>" target="_blank">Cetak</a>
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

        $('.modal-dialog').addClass('modal-sm');
        $('.modal-dialog').removeClass('modal-sm');
        $('#submit').html('SIMPAN');
        $('.hapus').addClass('d-none');
        $('.input').removeClass('d-none');
        $('#formId').attr('action', '<?= base_url() ?>pendidikan/simpan_kesediaan');
    }

    function ubah(id, kode_jurusan, nama_jurusan, jenis, status) {
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false
        });
        $('.modal-title').html('Ubah');

        $('[name="kode_jurusan"]').val(kode_jurusan);
        $('[name="nama_jurusan"]').val(nama_jurusan);
        $('[name="jenis"]').val(jenis);
        $('[name="status"]').val(status);

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
                        <div class="col-6">
                            <label class="col-form-label col-lg-12 pb-0 pt-2">Dosen</label>
                            <div class="col-lg-12 border rounded">
                                <select name="id_user" class="form-control select-search" data-fouc required>
                                    <option value="">Pilih</option>
                                    <?php foreach ($users as $r) { ?>
                                        <option value="<?= $r->username ?>"><?= $r->nama ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="col-form-label col-lg-12 pb-0 pt-2">Mata kuliah</label>
                            <div class="col-lg-12 border rounded">
                                <select name="id_matakuliah" class="form-control select-search" data-fouc required>
                                    <option value="">Pilih</option>
                                    <?php foreach ($matkul as $r) { ?>
                                        <option value="<?= $r->id_matkul ?>"><?= $r->matakuliah ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-4">
                            <label class="col-form-label col-lg-12 pb-0 pt-2">Tahun Ajaran</label>
                            <div class="col-lg-12 border rounded">
                                <select name="tahunajaran" class="form-control select-search" data-fouc required>
                                    <option value="">Pilih</option>
                                    <?php
                                    $mulai = date('Y') - 5;
                                    $ajaran = "";
                                    for ($i = $mulai; $i < $mulai + 11; $i++) {
                                        $ajaran = $i + 1 ?>
                                        <option value="<?= $i . '/' . $ajaran ?>"><?= $i . '/' . $ajaran ?></option>
                                    <?php  } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <label class="col-form-label col-lg-12 pb-0 pt-2">Kelas</label>
                            <div class="col-lg-12 border rounded">
                                <select name="kelas" class="form-control select-search" data-fouc required>
                                    <option value="">Pilih</option>
                                    <?php foreach ($kelas as $r) { ?>
                                        <option value="<?= $r->kelas ?>"><?= $r->kelas ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <label class="col-form-label col-lg-12 pb-0 pt-2">Status</label>
                            <div class="col-lg-12 border rounded">
                                <select name="status" class="form-control select-search" data-fouc required>
                                    <option value="">Pilih</option>
                                    <option value="Proses">Proses</option>
                                    <option value="Terima">Terima</option>
                                    <option value="Tolak">Tolak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <label class="col-form-label col-lg-12 pb-0 pt-2">Hari</label>
                            <div class="col-lg-12 border rounded">
                                <select name="hari" class="form-control select-search" data-fouc required>
                                    <option value="">Pilih</option>
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                    <option value="Minggu">Minggu</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <label class="col-form-label col-lg-12 pb-0 pt-2">Waktu</label>
                            <div class="col-lg-12 border rounded">
                                <select name="waktu" class="form-control select-search" data-fouc required>
                                    <option value="">Pilih</option>
                                    <?php foreach ($waktu as $r) { ?>
                                        <option value="<?= $r->waktu ?>"><?= $r->waktu ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <label class="col-form-label col-lg-12 pb-0 pt-2">Ruangan</label>
                            <div class="col-lg-12 border rounded">
                                <select name="ruangan" class="form-control select-search" data-fouc required>
                                    <option value="">Pilih</option>
                                    <?php foreach ($ruangan as $r) { ?>
                                        <option value="<?= $r->ruangan ?>"><?= $r->ruangan ?></option>
                                    <?php } ?>
                                </select>
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
