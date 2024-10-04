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
<page size="A4" style="font-size:12px;padding:15px 15px 28px 15px">
  <div class="row">
    <div class="col-12 text-center">
      <h2 style="margin-bottom:0px"><b>PERMOHONAN JADWAL MENGAJAR</b></h2>
      <h3 style="margin-top:0px"><b>SEMESTER GENAP TA <?= date('Y')."/".(date('Y')+1) ?></b></h3>
    </div>
    <div class="col-12">
      <h3 style="margin-bottom:0px">Nama Dosen : <?= $dosen ?></h3>
    </div>
    <div class="col-12">
      <table class="table">
        <tr class="bg-lp3i">
          <th width="100px">HARI/ JAM</th>
          <th width="100px">08.00 - 09.40</th>
          <th width="100px">09.50 - 11.30</th>
          <th width="100px">12.30 - 14.10</th>
          <th width="100px">14.20 - 16.00</th>
          <th width="100px">16.10 - 17.50</th>
          <th width="100px">18.30 - 20.10</th>
        </tr>
        <?php
        $hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
        for($i=1;$i<=6;$i++){?>
        <tr height="80px">
          <th><?= $hari[$i] ?></th>
          <?php for($s=1;$s<=6;$s++){
              $bg="#fff";
              if($isi[$hari[$i]][$s]!=""){$bg="#aaa";}
            ?>
          <th style="background-color:<?= $bg ?>">
            &nbsp;
          </th>
        <?php } ?>
        </tr>
        <?php } ?>
      </table>
    </div>
    <div class="col-12" style="margin-top:10px">
      <table class="table">
		<thead class="bg-lp3i">
	    	<tr>
		    	<th width="10px" class="text-center">No</th>
				<th width="250px" class="text-center">Prodi</th>
				<th width="250px" class="text-center">Matakuliah</th>
				<th width="10px" class="text-center">Semester</th>
				<th width="10px" class="text-center">SKS</th>
				<th width="10px" class="text-center">Sesi</th>
			</tr>
		</thead>
		<tbody>
		<?php
			$no = 1;
			$sks=0;
			foreach ($matkul as $r) { if($no<=10){ $sks+=$r->sks; ?>
			<tr>
				<td width="10px" class="text-center"><?= $no++ ?></td>
				<td width="100px" class="text-left"><?= $r->nama_jurusan ?></td>
				<td width="100px" class="text-left"><?= $r->matakuliah ?></td>
				<td width="100px" class="text-center"><?= $r->semester ?></td>
				<td width="100px" class="text-center"><?= $r->sks ?></td>
				<td width="100px" class="text-center"><?= ($r->sks/2) ?></td>
			</tr>
		<?php } } if(count($matkul)<=10){ ?>
		    <tr class="bg-lp3i">
				<td width="10px" class="text-center" colspan="4">Total</td>
				<td width="100px" class="text-center"><?= $sks ?></td>
				<td width="100px" class="text-center"><?= ($sks/2) ?></td>
			</tr>
		<?php } ?>
		</tbody>
	  </table>
    </div>
    <?php if(count($matkul)>10){ ?>
    </div>
</page>
<page size="A4" style="font-size:12px;padding:15px 15px 28px 15px">
    <div class="row">
    <div class="col-12 text-center">
      <h2 style="margin-bottom:0px"><b>PERMOHONAN JADWAL MENGAJAR</b></h2>
      <h3 style="margin-top:0px"><b>SEMESTER GENAP TA <?= date('Y')."/".(date('Y')+1) ?></b></h3>
    </div>
    <div class="col-12">
      <h3 style="margin-bottom:0px">Nama Dosen : <?= $dosen ?></h3>
    </div>
    <table class="table">
		<thead class="bg-lp3i">
	    	<tr>
		    	<th width="10px" class="text-center">No</th>
				<th width="250px" class="text-center">Prodi</th>
				<th width="250px" class="text-center">Matakuliah</th>
				<th width="10px" class="text-center">Semester</th>
				<th width="10px" class="text-center">SKS</th>
				<th width="10px" class="text-center">Sesi</th>
			</tr>
		</thead>
		<tbody>
		<?php
			$no = 1;
			foreach ($matkul as $r) { if($no>10 && $no<=33){ $sks+=$r->sks; ?>
			<tr>
				<td width="10px" class="text-center"><?= $no ?></td>
				<td width="100px" class="text-left"><?= $r->nama_jurusan ?></td>
				<td width="100px" class="text-left"><?= $r->matakuliah ?></td>
				<td width="100px" class="text-center"><?= $r->semester ?></td>
				<td width="100px" class="text-center"><?= $r->sks ?></td>
				<td width="100px" class="text-center"><?= ($r->sks/2) ?></td>
			</tr>
		<?php } $no++; } if(count($matkul)<=33){ ?>
		    <tr class="bg-lp3i">
				<td width="10px" class="text-center" colspan="4">Total</td>
				<td width="100px" class="text-center"><?= $sks ?></td>
				<td width="100px" class="text-center"><?= ($sks/2) ?></td>
			</tr>
		<?php } ?>
		</tbody>
	  </table>
    <?php } ?>
    <?php if(count($matkul)>33){ ?>
    </div>
</page>
<page size="A4" style="font-size:12px;padding:15px 15px 28px 15px">
    <div class="row">
    <div class="col-12 text-center">
      <h2 style="margin-bottom:0px"><b>PERMOHONAN JADWAL MENGAJAR</b></h2>
      <h3 style="margin-top:0px"><b>SEMESTER GENAP TA <?= date('Y')."/".(date('Y')+1) ?></b></h3>
    </div>
    <div class="col-12">
      <h3 style="margin-bottom:0px">Nama Dosen : <?= $dosen ?></h3>
    </div>
    <table class="table">
		<thead class="bg-lp3i">
	    	<tr>
		    	<th width="10px" class="text-center">No</th>
				<th width="250px" class="text-center">Prodi</th>
				<th width="250px" class="text-center">Matakuliah</th>
				<th width="10px" class="text-center">Semester</th>
				<th width="10px" class="text-center">SKS</th>
				<th width="10px" class="text-center">Sesi</th>
			</tr>
		</thead>
		<tbody>
		<?php
			$no = 1;
			foreach ($matkul as $r) { if($no>33){ $sks+=$r->sks; ?>
			<tr>
				<td width="10px" class="text-center"><?= $no ?></td>
				<td width="100px" class="text-left"><?= $r->nama_jurusan ?></td>
				<td width="100px" class="text-left"><?= $r->matakuliah ?></td>
				<td width="100px" class="text-center"><?= $r->semester ?></td>
				<td width="100px" class="text-center"><?= $r->sks ?></td>
				<td width="100px" class="text-center"><?= ($r->sks/2) ?></td>
			</tr>
		<?php } $no++; } ?>
		    <tr class="bg-lp3i">
				<td width="10px" class="text-center" colspan="4">Total</td>
				<td width="100px" class="text-center"><?= $sks ?></td>
				<td width="100px" class="text-center"><?= ($sks/2) ?></td>
			</tr>
		</tbody>
	  </table>
    <?php } ?>
    
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
      <?= $dosen ?>
    </div>
  </div>
</page>
