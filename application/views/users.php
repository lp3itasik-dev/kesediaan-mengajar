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
                                <h5 class="card-title">Daftar Users</h5>
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
                                                <th width="100px" class="text-center">Username</th>
                                                <th width="100px" class="text-center">Password</th>
                                                <th width="150px" class="text-center">Nama</th>
                                                <th width="100px" class="text-center">Akases</th>
                                                <th width="100px" class="text-center">Foto</th>
                                                <th width="150px" class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($users as $r) { ?>
                                                <tr>
                                                    <td width="10px" class="text-center"><?= $no++ ?></td>
                                                    <td width="100px" class="text-center"><?= $r->username ?></td>
                                                    <td width="100px" class="text-center"><?= $r->password ?></td>
                                                    <td width="100px" class="text-center"><?= $r->nama ?></td>
                                                    <td width="100px" class="text-center"><?= $r->akses ?></td>
                                                    <td width="100px" class="text-center"><img src="<?php echo base_url() . 'global_assets/images/foto/' . $r->foto ?>" style="  max-width: 100%;height: auto;  border: 3px solid #adb5bd;margin: 0 auto;padding: 3px;width: 50px;"></td>
                                                    <td width="150px" class="text-center">
                                                        <button class="btn btn-success btn-sm" onclick="return ubah('<?= $r->username ?>','<?= $r->password ?>','<?= $r->nama ?>','<?= $r->akses ?>','<?= $r->foto ?>')"><i class="icon-database-edit2"></i> UBAH</button>
                                                        <button class="btn btn-danger btn-sm" onclick="return hapus('<?= $r->username ?>','<?= $r->nama ?>')"><i class="icon-database-remove"></i> Hapus</button>
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

        $('[name="username"]').attr("required", "required");
        $('[name="password"]').attr("required", "required");
        $('[name="nama"]').attr("required", "required");
        $('[name="foto"]').attr("required", "required");

        $('.modal-dialog').addClass('modal-sm');
        $('.modal-dialog').removeClass('modal-sm');
        $('#submit').html('SIMPAN');
        $('.hapus').addClass('d-none');
        $('.input').removeClass('d-none');
        $('#formId').attr('action', '<?= base_url() ?>pendidikan/simpan_users');
    }

    function ubah(username, password, nama, akses, foto) {
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false
        });
        $('.modal-title').html('Ubah');
        $('[name="username"]').val(username);
        $('[name="password"]').val(password);
        $('[name="nama"]').val(nama);
        $('[name="akses"]').val(akses);

        $('[name="nama"]').attr("required", "required");
        $('[name="password"]').attr("required", "required");

        $('[id^="select2-akses-"]').html(akses);

        $('.modal-dialog').addClass('modal-sm');
        $('.modal-dialog').removeClass('modal-sm');
        $('#submit').html('SIMPAN');
        $('.hapus').addClass('d-none');
        $('.input').removeClass('d-none');
        $('#formId').attr('action', '<?= base_url() ?>pendidikan/ubah_users/' + username);
    }

    function hapus(username, nama) {
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false
        });
        $('.modal-title').html('Hapus');

        $('[name="username"]').val(username);
        $('[name="nama"]').val(nama);
        $('.hapus').html("Anda yakin akan menghapus user <b>" + nama + "</b>?");
        $('#formId').attr('action', '<?= base_url() ?>pendidikan/hapus_users/' + username);
        $('#submit').removeClass('d-none');

        $('.modal-dialog').removeClass('modal-sm');
        $('.modal-dialog').addClass('modal-sm');
        $('#submit').html('HAPUS');
        $('.input').addClass('d-none');
        $('.hapus').removeClass('d-none');

        //hilangkan required
        $('[name="username"]').removeAttr("required");
        $('[name="password"]').removeAttr("required");
        $('[name="akses"]').removeAttr("required");
        $('[name="foto"]').removeAttr("required");
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

                        <div class="col-3">
                            <label class="col-form-label col-lg-12 pb-0 pt-2">Username</label>
                            <div class="col-lg-12 border rounded">
                                <input type="text" class="form-control" name="username" value="" required>
                            </div>
                        </div>

                        <div class="col-3">
                            <label class="col-form-label col-lg-12 pb-0 pt-2">Password</label>
                            <div class="col-lg-12 border rounded">
                                <input type="password" class="form-control" name="password" value="" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="col-form-label col-lg-12 pb-0 pt-2">Nama</label>
                            <div class="col-lg-12 border rounded">
                                <input type="text" class="form-control" name="nama" value="" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="col-form-label col-lg-12 pb-0 pt-2">Akses</label>
                            <div class="col-lg-12 border rounded">
                                <select name="akses" class="form-control select-search" data-fouc required>
                                    <option value="">Pilih</option>
                                    <option value="Dosen">Dosen</option>
                                    <option value="Pendidikan">Pendidikan</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <label class="col-form-label col-lg-12 pb-0 pt-2">foto</label>
                            <div class="col-lg-12 border rounded">
                                <input type="file" class="form-control" name="foto" value="">
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