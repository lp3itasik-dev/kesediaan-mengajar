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
                                <h5 class="card-title">Daftar Kesediaan Mengajar</h5>
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
                                                <th width="200px" class="text-center">Matakuliah</th>
                                                <th width="100px" class="text-center">SKS</th>
                                                <th width="100px" class="text-center">Sesi</th>
                                                <th width="10px" class="text-center">Status</th>
                                                <th width="150px" class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($kesediaan as $r) {
                                                $bg = null;
                                                if ($r->status == "Proses") {
                                                    $bg = 'warning';
                                                }
                                                if ($r->status == "Terima") {
                                                    $status = 'Perlu Dikirim';
                                                    $bg = 'success';
                                                }
                                                if ($r->status == "Tolak") {
                                                    $bg = 'danger';
                                                }
                                            ?>
                                                <tr>
                                                    <td width="10px" class="text-center"><?= $no++ ?></td>
                                                    <td width="100px" class="text-center"><?= $r->matakuliah ?></td>
                                                    <td width="100px" class="text-center"><?= $r->sks ?></td>
                                                    <td width="100px" class="text-center"><?= $r->waktu ?></td>
                                                    <td width="100px" class="text-center"><span class="badge badge-<?= $bg ?>"><?= $r->status ?></span></td>
                                                    <td width="150px" class="text-center">
                                                        <?php if ($r->status != "Proses") { ?>
                                                            <button class="btn btn-success btn-sm" disabled onclick="return ubah('<?= $r->id_kesediaan ?>','<?= $r->id_jadwal ?>','<?= $r->id_matkul ?>','<?= $r->matakuliah ?>', '<?= $r->tahunajaran ?>', '<?= $r->hari ?>', '<?= $r->waktu ?>', '<?= $r->ruangan ?>')"><i class="icon-database-edit2"></i> UBAH</button>
                                                            <button class="btn btn-danger btn-sm" onclick="return hapus('<?= $r->id_kesediaan ?>','<?= $r->id_jadwal ?>','<?= $r->matakuliah ?>')"><i class="icon-database-remove"></i> Hapus</button>
                                                        <?php } else { ?>
                                                            <button class="btn btn-success btn-sm" onclick="return ubah('<?= $r->id_kesediaan ?>','<?= $r->id_jadwal ?>','<?= $r->id_matkul ?>','<?= $r->matakuliah ?>', '<?= $r->tahunajaran ?>', '<?= $r->hari ?>', '<?= $r->waktu ?>', '<?= $r->ruangan ?>')"><i class="icon-database-edit2"></i> UBAH</button>
                                                            <button class="btn btn-danger btn-sm" onclick="return hapus('<?= $r->id_kesediaan ?>','<?= $r->id_jadwal ?>','<?= $r->matakuliah ?>')"><i class="icon-database-remove"></i> Hapus</button>
                                                        <?php } ?>
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
                <!-- /dosen content -->

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
        $('#formId').attr('action', '<?= base_url() ?>dosen/simpan_kesediaan');
    }

    function ubah(id_kesediaan, id_jadwal, id_matkul, matakuliah, tahunajaran, hari, waktu, ruangan) {
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false
        });
        $('.modal-title').html('Ubah');

        $('[name="id_jadwal"]').val(id_jadwal);
        $('[name="id_matakuliah"]').val(id_matkul);
        $('[name="tahunajaran"]').val(tahunajaran);
        $('[name="hari"]').val(hari);
        $('[name="waktu"]').val(waktu);
        $('[name="ruangan"]').val(ruangan);

        $('[id^="select2-id_matakuliah-"]').html(matakuliah);
        $('[id^="select2-tahunajaran-"]').html(tahunajaran);
        $('[id^="select2-hari-"]').html(hari);


        $('.modal-dialog').addClass('modal-sm');
        $('.modal-dialog').removeClass('modal-sm');
        $('#submit').html('SIMPAN');
        $('.hapus').addClass('d-none');
        $('.input').removeClass('d-none');
        $('#formId').attr('action', '<?= base_url() ?>dosen/ubah_kesediaan/' + id_kesediaan);
    }

    function hapus(id_kesediaan, id_jadwal, matakuliah) {
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false
        });
        $('.modal-title').html('Hapus');

        $('[name="id_jadwal"]').val(id_jadwal);
        $('[name="matakuliah"]').val(matakuliah);
        $('.hapus').html("Anda yakin akan menghapus kesediaan mengajar <b>" + matakuliah + "</b>?");
        $('#formId').attr('action', '<?= base_url() ?>dosen/hapus_kesediaan/' + id_kesediaan);
        $('#submit').removeClass('d-none');

        $('.modal-dialog').removeClass('modal-sm');
        $('.modal-dialog').addClass('modal-sm');
        $('#submit').html('HAPUS');
        $('.input').addClass('d-none');
        $('.hapus').removeClass('d-none');

        //hilangkan required
        $('[name="id_jadwal"]').removeAttr("required");
        $('[name="id_matakuliah"]').removeAttr("required");
        $('[name="hari"]').removeAttr("required");
        $('[name="waktu"]').removeAttr("required");
        $('[name="tahunajaran"]').removeAttr("required");
        $('[name="ruangan"]').removeAttr("required");
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
                        <input type="hidden" name="id_jadwal" value="">

                        <div class="col-12">
                            <label class="col-form-label col-lg-12 p-0 font-weight-bold">Data Kesediaan Mengajar</label>
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

                        <div class="col-6">
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
                                <input type="text" class="form-control" name="waktu" value="" required>
                            </div>
                        </div>
                        <div class="col-4">
                            <label class="col-form-label col-lg-12 pb-0 pt-2">Ruangan</label>
                            <div class="col-lg-12 border rounded">
                                <input type="ruangan" class="form-control" name="ruangan" value="" required>
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