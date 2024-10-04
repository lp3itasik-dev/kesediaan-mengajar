<style>
body {
  background: rgb(204,204,204);
	font-family: Arial;
}
page {
  background: white;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
}
page[size="Kwitansi"] {
  /* width: 25cm;
  height: 15cm; */
  width: 24.2cm;
  height: 13.9cm;
}
page[size="A4"] {
  width: 21cm;
  height: 29.7cm;
}
page[size="A4"][layout="landscape"] {
  width: 29.7cm;
  height: 21cm;
}
page[size="A3"] {
  width: 29.7cm;
  height: 42cm;
}
page[size="A3"][layout="landscape"] {
  width: 42cm;
  height: 29.7cm;
}
page[size="A5"] {
  width: 14.8cm;
  height: 21cm;
}
page[size="A5"][layout="landscape"] {
  width: 21cm;
  height: 14.8cm;
}
@media print {
  body, page {
    margin: 0;
    box-shadow: 0;
  }
}
.table tr td,.table tr th{
  font-size:11px!important;
  padding: 5px!important;
  border: 0.3px solid #000!important;
}
table{
  border-collapse: collapse;
  margin-bottom: 0;
  width: 100%;
}
.bg-lp3i{
  background-color: #083470;
  color:#fff;
}
.text-center{
  text-align: center;
}
.text-right{
  text-align: right;
}
.text-left{
  text-align: left;
}
.float-left{
  float: left;
}
.row{
  display: -ms-flexbox;
  display: flex;
  -ms-flex-wrap: wrap;
  flex-wrap: wrap;
}
.col-1{
  -ms-flex: 0 0 8.33333%;
  flex: 0 0 8.33333%;
  max-width: 8.33333%;
}
.col-2 {
    -ms-flex: 0 0 16.66667%;
    flex: 0 0 16.66667%;
    max-width: 16.66667%;
}
.col-6 {
    -ms-flex: 0 0 50%;
    flex: 0 0 50%;
    max-width: 50%;
}
.col-10 {
    -ms-flex: 0 0 83.33333%;
    flex: 0 0 83.33333%;
    max-width: 83.33333%;
}
.col-11 {
    -ms-flex: 0 0 91.66667%;
    flex: 0 0 91.66667%;
    max-width: 91.66667%;
}
.col-12 {
    -ms-flex: 0 0 100%;
    flex: 0 0 100%;
    max-width: 100%;
}
.col-1, .col-10, .col-11, .col-12, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9 {
    position: relative;
    width: 100%;
}
.pr-0 {
    padding-right: 0!important;
}
.pl-0 {
    padding-left: 0!important;
}
.pt-2 {
    padding-top: .625rem!important;
}
.pb-2 {
    padding-bottom: .625rem!important;
}
.pl-2 {
    padding-left: .625rem!important;
}
.pr-2 {
    padding-right: .625rem!important;
}
.pt-3 {
    padding-top: 1.25rem!important;
}
.pl-3 {
    padding-left: 1.25rem!important;
}
.pr-3 {
    padding-right : 1.25rem!important;
}
.pb-3 {
    padding-bottom : 1.25rem!important;
}
.h5, h5 {
    font-size: 1.0625rem;
}
.pt-3 {
    padding-top : 1.25rem!important;
}
.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
    letter-spacing: -.015em;
}
.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
    margin-bottom: .625rem;
    font-weight: 400;
    line-height: 1.5385;
}
</style>
<title>Sistem Informasi LP3I Tasikmalaya</title>
<link rel="icon" href="<?= base_url() ?>global_assets/images/ico-silt.png" type="image/x-icon">
<page size="A4" style="font-size:12px;padding:15px 15px 25px 15px">
  <div class="row">
    <div class="col-12 text-center">
      <h2 style="margin-bottom:0px"><b>PERMOHONAN JADWAL MENGAJAR</b></h2>
      <h3 style="margin-top:0px"><b>SEMESTER GENAP TA <?= date('Y')."/".(date('Y')+1) ?></b></h3>
    </div>
    <?php if($jenis_laporan=="dosen"){ ?>
      <div class="col-12 text-left" style="margin-bottom:10px">
        Nama Dosen: <?= $dosen ?>
      </div>
    <?php } ?>
    <?php if($jenis_laporan=="jurusan"){ ?>
      <div class="col-12 text-left" style="margin-bottom:10px">
        Nama Prodi: <?= $jurusan ?>
      </div>
    <?php } ?>
    <div class="col-12">
      <table class="table">
        <tr class="bg-lp3i">
          <th>No.</th>
          <?php if($jenis_laporan!="dosen"){ ?>
          <th width="250px">Nama Dosen</th>
          <?php } ?>
          <?php if($jenis_laporan!="jurusan"){ ?>
          <th>Prodi</th>
          <?php } ?>
          <th>Matakuliah</th>
          <th>Semester</th>
          <th>SKS</th>
          <th>Sesi</th>
        </tr>
        <?php
        $no=1;
        $o=1;
        $totalsks=0;
        $totalsksall=0;
        $nama_dosen="";
        foreach ($kesediaan as $k) {
          if($k->nama_dosen!=$nama_dosen && $no!=1){
            $o++;
            if($totalsks>0){
            ?>
            <tr>
              <?php if($jenis_laporan=="all"){ ?>
              <td colspan="5">Subtotal</td>
              <?php }else{ ?>
              <td colspan="4">Subtotal</td>
              <?php } ?>
              <td class="text-center"><?= $totalsks ?></td>
              <td class="text-center"><?= ($totalsks/2) ?></td>
            </tr>
            <?php
            }
            $totalsks=0;
          }
          
          if($o<=33){
          $o++;
          $totalsks+=$k->sks;
          $totalsksall+=$k->sks;
          $nama_dosen=$k->nama_dosen;
          ?>
          <tr>
            <td class="text-center"><?= $no++ ?></td>
            <?php if($jenis_laporan!="dosen"){ ?>
            <td><?= $k->nama_dosen ?></td>
            <?php } ?>
            <?php if($jenis_laporan!="jurusan"){ ?>
            <td><?= $k->nama_jurusan?></td>
            <?php } ?>
            <td><?= $k->matakuliah?></td>
            <td class="text-center"><?= $k->semester?></td>
            <td class="text-center"><?= $k->sks ?></td>
            <td class="text-center"><?= ($k->sks/2) ?></td>
          </tr>
        <?php } } ?>
        
        <?php if($o<=33){ ?>
        <?php if($jenis_laporan!="dosen"){?>
        <tr>
          <?php if($jenis_laporan=="all"){ ?>
          <td colspan="5">Subtotal</td>
          <?php }else{ ?>
          <td colspan="4">Subtotal</td>
          <?php } ?>
          <td class="text-center"><?= $totalsks ?></td>
          <td class="text-center"><?= ($totalsks/2) ?></td>
        </tr>
        <?php } ?>
        <tr class="bg-lp3i">
          <?php if($jenis_laporan=="all"){ ?>
          <td colspan="5">Total</td>
          <?php }else{ ?>
          <td colspan="4">Total</td>
          <?php } ?>
          <td class="text-center"><?= $totalsksall ?></td>
          <td class="text-center"><?= ($totalsksall/2) ?></td>
        </tr>
        <?php } ?>
      </table>
    </div>
    <?php if($o>33){
    $x = "false";
    $n=33;
    while($x == "false") {
    ?>
  </div>
</page>
<page size="A4" style="font-size:12px;padding:15px 15px 25px 15px">
  <div class="row">
    <div class="col-12 text-center">
      <h2 style="margin-bottom:0px"><b>PERMOHONAN JADWAL MENGAJAR</b></h2>
      <h3 style="margin-top:0px"><b>SEMESTER GENAP TA <?= date('Y')."/".(date('Y')+1) ?></b></h3>
    </div>
    <?php if($jenis_laporan=="dosen"){ ?>
      <div class="col-12 text-left" style="margin-bottom:10px">
        Nama Dosen: <?= $dosen ?>
      </div>
    <?php } ?>
    <?php if($jenis_laporan=="jurusan"){ ?>
      <div class="col-12 text-left" style="margin-bottom:10px">
        Nama Prodi: <?= $jurusan ?>
      </div>
    <?php } ?>
    <div class="col-12">
      <table class="table">
        <tr class="bg-lp3i">
          <th>No.</th>
          <?php if($jenis_laporan!="dosen"){ ?>
          <th width="220px">Nama Dosen</th>
          <?php } ?>
          <?php if($jenis_laporan!="jurusan"){ ?>
          <th>Prodi</th>
          <?php } ?>
          <th>Matakuliah</th>
          <th>Semester</th>
          <th>SKS</th>
          <th>Sesi</th>
        </tr>
        <?php
        $no=1;
        $o=1;
        $totalsksall=0;
        foreach ($kesediaan as $k) {
          if($k->nama_dosen!=$nama_dosen && $no!=1){
            $o++;
            if($o>$n && $o<=$n+33&&$totalsks!=0){
            ?>
            <tr>
              <?php if($jenis_laporan=="all"){ ?>
              <td colspan="5">Subtotal</td>
              <?php }else{ ?>
              <td colspan="4">Subtotal</td>
              <?php } ?>
              <td class="text-center"><?= $totalsks ?></td>
              <td class="text-center"><?= ($totalsks/2) ?></td>
            </tr>
            <?php
            }
            $totalsks=0;
          }
          
          $nama_dosen=$k->nama_dosen;
          $totalsks+=$k->sks;
          if($o>$n && $o<=$n+33){
          if($no==count($kesediaan)){$x="true";}
          ?>
          <tr>
            <td class="text-center"><?= $no ?></td>
            <?php if($jenis_laporan!="dosen"){ ?>
            <td><?= $k->nama_dosen ?></td>
            <?php } ?>
            <?php if($jenis_laporan!="jurusan"){ ?>
            <td><?= $k->nama_jurusan?></td>
            <?php } ?>
            <td><?= $k->matakuliah?></td>
            <td class="text-center"><?= $k->semester?></td>
            <td class="text-center"><?= $k->sks ?></td>
            <td class="text-center"><?= ($k->sks/2) ?></td>
          </tr>
        <?php } $o++; $no++; $totalsksall+=$k->sks; } ?>
        
        
        <?php 
        if($x=="true"){
        if($jenis_laporan!="dosen"){?>
        <tr>
          <?php if($jenis_laporan=="all"){ ?>
          <td colspan="5">Subtotal</td>
          <?php }else{ ?>
          <td colspan="4">Subtotal</td>
          <?php } ?>
          <td class="text-center"><?= $totalsks ?></td>
          <td class="text-center"><?= ($totalsks/2) ?></td>
        </tr>
        <?php } ?>
        <tr class="bg-lp3i">
          <?php if($jenis_laporan=="all"){ ?>
          <td colspan="5">Total</td>
          <?php }else{ ?>
          <td colspan="4">Total</td>
          <?php } ?>
          <td class="text-center"><?= $totalsksall ?></td>
          <td class="text-center"><?= ($totalsksall/2) ?></td>
        </tr>
        <?php } ?>
        
      </table>
    </div>
    <?php $n+=33;} 
    }?>
    <div class="col-12">
      <br>
      <br>
      <div>Tasikmalaya, ……………………………………</div>
      <br>
      <br>
      <br>
      <br>
      <br>
      <div>……………………………………………………</div>
    </div>
  </div>
</page>
