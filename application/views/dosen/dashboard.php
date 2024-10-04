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

            <!-- Page header -->
            <div class="page-header">
                <div class="page-header-content">
                    <div class="page-title row">
                        <div class="col-lg-6 col-12">
                            <h4><i class="icon-home4 mr-2"></i> <span class="font-weight-semibold">Dashboard</span></h4>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /page header -->

            <!-- Content area -->
            <div class="content pt-0">

                <!-- Main charts -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-framed" id="datatable-basic">
                                        <thead class="bg-lp3i">
                                            <tr>
                                                <th width="10px" class="text-center">No</th>
                                                <th width="100px" class="text-center">Kelas</th>
                                                <th width="200px" class="text-center">Jurusan</th>
                                                <th width="200px" class="text-center">Matakuliah</th>
                                                <th width="200px" class="text-center">Semester</th>
                                                <th width="100px" class="text-center">SKS</th>
                                                <!--<th width="10px" class="text-center">Status</th>-->
                                                <!--<th width="150px" class="text-center">Aksi</th>-->
                                            </tr>
                                        </thead>
                                        <tbody class="isi-tabel">
                                            <?php
                                            $no = 1;
                                            foreach ($kesediaan as $r) {
                                                $bg = null;
                                                if ($r->status_kesediaan == "Proses") {
                                                    $bg = 'warning';
                                                }
                                                if ($r->status_kesediaan == "Terima") {
                                                    $bg = 'success';
                                                }
                                                if ($r->status_kesediaan == "Tolak") {
                                                    $bg = 'danger';
                                                }
                                              ?>
                                                <tr>
                                                    <td width="10px" class="text-center"><?= $no++ ?></td>
                                                    <td width="100px" class="text-center"><?= $r->kelas ?></td>
                                                    <td width="100px" class="text-left"><?= $r->nama_jurusan ?></td>
                                                    <td width="100px" class="text-left"><?= $r->matakuliah ?></td>
                                                    <td width="100px" class="text-center"><?= $r->semester ?></td>
                                                    <td width="100px" class="text-center"><?= $r->sks ?></td>
                                                    <!--<td width="100px" class="text-center"><span class="btn btn-sm btn-<?= $bg ?>">di <?= $r->status_kesediaan ?></span></td>-->
                                                    <!--<td width="150px" class="text-center">-->
                                                    <!--    <?php if ($r->status_kesediaan != "Proses") { ?>-->
                                                    <!--        <button class="btn btn-danger btn-sm" disabled>Hapus</button>-->
                                                    <!--    <?php } else { ?>-->
                                                    <!--        <button class="btn btn-danger btn-sm" onclick="return hapus(`<?= $r->id_kesediaan ?>`,`<?= $r->id_jadwal ?>`)">Hapus</button>-->
                                                    <!--    <?php } ?>-->
                                                    <!--</td>-->
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header text-center mb-0">
                              <h5 class="mb-0">KESEDIAAN WAKTU MENGAJAR</h5>
                              <span class="save-waktu"></spam>
                            </div>
                            <div class="card-body p-1">
                                <div class="table-responsive">
                                    <table class="table table-framed" id="datatable-basic">
                                        <thead class="bg-lp3i">
                                            <tr>
                                                <th width="100px" class="text-center">Hari/ Sesi</th>
                                                <th width="100px" class="text-center">08.00 s.d 09.40</th>
                                                <th width="100px" class="text-center">09.50 s.d 11.30</th>
                                                <th width="100px" class="text-center">12.30 s.d 14.10</th>
                                                <th width="100px" class="text-center">14.20 s.d 16.00</th>
                                                <th width="100px" class="text-center">16.10 s.d 17.50</th>
                                                <th width="100px" class="text-center">18.30 s.d 20.10</th>
                                            </tr>
                                        </thead>
                                        <tbody class="show-waktu">
                                          <?php
                                          $hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
                                          $sesi = array("","08.00 - 09.40","09.50 - 11.30","12.30 - 14.10","14.20 - 16.00","16.10 - 17.50","18.30 - 20.10");
                                          for($i=1;$i<=6;$i++){ ?>
                                          <tr>
                                            <td class="text-center"><?= $hari[$i] ?></td>
                                            <?php for($s=1;$s<=6;$s++){ $onclick="savewaktu"; if($waktu_kesediaan[$hari[$i]][$sesi[$s]]=="checked"){$onclick="removewaktu";} ?>
                                            <td class="text-center">
                                                <?php if(($i<6) or ($i==6 && $s<4)){ ?>
                                                <input type="checkbox" value="" onclick="return <?= $onclick ?>(`<?= $hari[$i] ?>`,`<?= $sesi[$s] ?>`)" class="form-control" <?= $waktu_kesediaan[$hari[$i]][$sesi[$s]]?>>
                                                <?php } ?>
                                            </td>
                                            <?php } ?>
                                          </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card text-center pt-2 d-none">
                            <h5>DAFTAR MATAKULIAH</h5>
                            <!-- <h5>SEMESTER <?php if(date('Y')%2==0){ echo "GENAP";}else{echo "GANJIL";}?></h5>
                            <h5>TAHUN AJARAN <?= $tahunajaran ?></h5> -->
                            <div id="carouselExampleIndicators" class="carousel slide pl-1 pr-1 pb-3" data-ride="carousel" data-interval="false">
                                <div class="carousel-inner">
                                    <?php $no = 1;
                                    foreach ($jurusan as $j) {
                                        $active = "";
                                        if ($no == 1) {
                                            $active = "active";
                                        }
                                        $no++;
                                        $select = $this->db->select('*,jadwalkuliah.id as id_jadwal');
                                        $select = $this->db->join('jadwalkuliah', 'jadwalkuliah.id_matakuliah= master_matakuliah.id_matkul');
                                        $select = $this->db->where('tahunajaran', $tahunajaran);
                                        $select = $this->db->where('id_jurusan', $j->id);
                                        $select = $this->db->where('semester', $j->semester);
                                        $select = $this->db->order_by('matakuliah');
                                        $matkul = $this->m->Get_All('master_matakuliah', '$select');
                                    ?>
                                        <div class="carousel-item <?= $active ?>">
                                            <div class="table-responsive d-block w-100 p-0">
                                                <div class="card-title text-center">
                                                    <h5><?= strtoupper($j->nama_jurusan) ?></h5>
                                                    <h5>SEMESTER <?= $j->semester ?></h5>
                                                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev" style="width:auto!important;left:5">
                                                        <i class="icon-arrow-left15 icon-2x pl-2" aria-hidden="true" style="color:#083470"></i>
                                                        <span class="sr-only">Previous</span>
                                                    </a>
                                                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next" style="width:auto!important;right:5">
                                                        <i class="icon-arrow-right15 icon-2x pr-2" aria-hidden="true" style="color:#083470"></i>
                                                        <span class="sr-only">Next</span>
                                                    </a>
                                                </div>
                                                <table class="table table-framed" id="datatable-basic border">
                                                    <thead class="bg-lp3i">
                                                        <tr>
                                                            <th width="700px" class="text-center">Matakuliah</th>
                                                            <th width="10px" class="text-center">Sks</th>
                                                            <th width="10px" class="text-center">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        foreach ($matkul as $r) { $no++?>
                                                            <tr>
                                                                <td width="100px" class="text-center"><?= $r->matakuliah ?></td>
                                                                <td width="100px" class="text-center"><?= $r->sks ?></td>
                                                                <td width="100px" class="text-center">
                                                                  <?php $tombol="on"; foreach ($kesediaan as $k) {if($k->id_jadwal==$r->id_jadwal){$tombol="off";} }
                                                                  if($tombol=="on"){
                                                                  ?>
                                                                  <button class="btn bg-lp3i" type="button" name="<?= $r->id_jadwal ?>" onclick="return save(`<?= $r->id_jadwal ?>`)">TAMBAH</button>
                                                                <?php }else{ ?>
                                                                  <button class="btn bg-lp3i" type="button" name="<?= $r->id_jadwal ?>" disabled>TAMBAH</button>
                                                                <?php } ?>
                                                                </td>
                                                            </tr>
                                                        <?php  } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    <?php  } ?>
                                </div>


                            </div>
                        </div>
                        
                    </div>
                </div>
                <!-- /dashboard content -->

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
$('.carousel').carousel({
  interval: false,
});
function tambah(id_jadwal,matakuliah,sks,jurusan,semester) {
    $('#myModal').modal({
        backdrop: 'static',
        keyboard: false
    });
    $('.modal-title').html('Tambah');

    $('[name="id_jadwal"]').val(id_jadwal);
    $('[name="matakuliah"]').val(matakuliah);
    $('[name="sks"]').val(sks);
    $('[name="jurusan"]').val(jurusan);
    $('[name="semester"]').val(semester);

    $('.modal-dialog').addClass('modal-sm');
    $('.modal-dialog').removeClass('modal-sm');
    $('#submit').html('SIMPAN');
    $('.hapus').addClass('d-none');
    $('.input').removeClass('d-none');
    $('#submit').attr('onclick', 'return save()');
}
function hapus(id_kesediaan,id_jadwal) {
    $('#myModal').modal({
        backdrop: 'static',
        keyboard: false
    });
    $('.modal-title').html('Hapus');

    $('[name="id_kesediaan"]').val(id_kesediaan);

    $('.modal-dialog').addClass('modal-sm');
    $('.modal-dialog').removeClass('modal-sm');
    $('#submit').html('Hapus');
    $('.hapus').removeClass('d-none');
    $('.input').addClass('d-none');
    $('#submit').attr('onclick', 'return remove('+id_jadwal+')');
}
function save(id_jadwal){
  $('.isi-tabel').load("<?= base_url() ?>Dosen/simpan_kesediaan/"+id_jadwal);
  $('[name="'+id_jadwal+'"]').attr('onclick', '');
  $('[name="'+id_jadwal+'"]').attr('disabled', 'disabled');
}
function savewaktu(hari,waktu){
  $.ajax({
    type: 'POST',
    url: "<?= base_url() ?>Dosen/simpan_waktu_kesediaan",
    data: {hari:hari,waktu:waktu},
    success: function(data) {
      $('.show-waktu').html(data);
    },
    error: function(response) {
      console.log(response.responseText);
      $('#msg').html('<b class="text-danger">ERROR</b>');
    }
  });
}
function removewaktu(hari,waktu){
  $.ajax({
    type: 'POST',
    url: "<?= base_url() ?>Dosen/hapus_waktu_kesediaan",
    data: {hari:hari,waktu:waktu},
    success: function(data) {
      $('.show-waktu').html(data);
    },
    error: function(response) {
      console.log(response.responseText);
      $('#msg').html('<b class="text-danger">ERROR</b>');
    }
  });
}
function remove(id_jadwal){
  var form = document.getElementById('formId');
  var data = new FormData(form);
  $.ajax({
    type: 'POST',
    url: "<?= base_url() ?>Dosen/hapus_kesediaan",
    data: data,
    contentType: false,
    cache: false,
    processData: false,
    success: function(data) {
      $('.isi-tabel').html(data);
      $('[name="'+id_jadwal+'"]').attr('onclick', 'return save('+id_jadwal+')');
      $('[name="'+id_jadwal+'"]').removeAttr('disabled');
    },
    error: function(response) {
      console.log(response.responseText);
      $('#msg').html('<b class="text-danger">ERROR</b>');
    }
  });
  $('#myModal').modal('hide');
}
function update(){
  var form = document.getElementById('formId');
  var data = new FormData(form);
  $.ajax({
    type: 'POST',
    url: "<?= base_url() ?>Dosen/ubah_kesediaan",
    data: data,
    contentType: false,
    cache: false,
    processData: false,
    success: function(data) {
      $('.isi-tabel').html(data);
    },
    error: function(response) {
      console.log(response.responseText);
      $('#msg').html('<b class="text-danger">ERROR</b>');
    }
  });
  $('#myModal').modal('hide');
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
                        <input type="hidden" name="id_kesediaan" value="">
                        <div class="col-lg-4 col-12">
                            <label class="col-form-label col-lg-12 pb-0 pt-2">Jurusan</label>
                            <div class="col-lg-12 border rounded bg-lp3i-light">
                              <input type="text" value="" class="form-control" name="jurusan" readonly>
                            </div>
                        </div>
                        <div class="col-lg-2 col-12">
                            <label class="col-form-label col-lg-12 pb-0 pt-2">SEMESTER</label>
                            <div class="col-lg-12 border rounded bg-lp3i-light">
                              <input type="text" value="" class="form-control" name="semester" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <label class="col-form-label col-lg-12 pb-0 pt-2">Matakuliah</label>
                            <div class="col-lg-12 border rounded bg-lp3i-light">
                              <input type="text" value="" class="form-control" name="matakuliah" readonly>
                            </div>
                        </div>
                        <div class="col-lg-2 col-12">
                            <label class="col-form-label col-lg-12 pb-0 pt-2">SKS</label>
                            <div class="col-lg-12 border rounded bg-lp3i-light">
                              <input type="text" value="" class="form-control" name="sks" readonly>
                            </div>
                        </div>
                        <div class="col-12">
                          <label class="col-form-label col-lg-12 pb-0 pt-2">Hari</label>
                        </div>
                        <?php
                          $hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
                          $sesi1 = array("","08.00 - 09.40","09.50 - 11.30","12.30 - 14.10","14.20 - 16.00","16.10 - 17.50");
                          $sesi2 = array("","08.00 - 11.30","09.50 - 14.10","12.30 - 16.00","14.20 - 17.50","16.10 - 19.40");
                          for($i=1;$i<=6;$i++){
                        ?>
                        <div class="col-4 mb-3">
                          <div class="col-12 d-flex">
                            <input type="checkbox" class="mt-1" value="Senin" name="<?= strtolower($hari[$i]) ?>" style="height:20px"><label class="m-1"> <?= $hari[$i] ?></label>
                          </div>
                          <?php for($s=1;$s<=5;$s++){ ?>
                          <div class="col-12 d-flex">
                            <input type="checkbox" class="mt-1" value="<?= $sesi1[$s] ?>" name="<?= strtolower($hari[$i])."-".$s ?>" style="height:20px"><label class="m-1"> <?= $sesi1[$s] ?></label>
                          </div>
                          <?php } ?>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="modal-body hapus h5">
                  Anda yakin ingin menghapus?
                </div>
                <div class="modal-footer bg-lp3i-light">
                    <button id="tutup" type="button" class="btn bg-grey" data-dismiss="modal">TUTUP</button>
                    <button id="submit" type="button" class="btn bg-lp3i" onclick="">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
</html>
