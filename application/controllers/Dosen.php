<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dosen extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public     function __construct()
    {
        parent::__construct();
        $this->load->model('Models', 'm');
    }
    public function authenticated()
    {
        if ($this->uri->segment(1) != 'auth' && $this->uri->segment(1) != '') {
            if (!$this->session->userdata('authenticated'))
                $this->session->set_flashdata('pesan', 'Silahkan Login Terlebih Dahulu');
            redirect('Login');
        }
    }
    public function index()
    {
        if ($this->session->userdata('akses') == '') {
            $this->authenticated();
        } else if ($this->session->userdata('akses') == 'Pendidikan') {
            redirect('login');
        } else {
            $tahun1 = date('Y');
            $tahun2 = date('Y') + 1;
            $ajaran =  $tahun1.'/'.$tahun2;
            if (isset($_POST['tahun_akademik'])) {
              $ajaran = $this->input->post('tahun_akademik');
            }
            $select = $this->db->select('*');
            $select = $this->db->join('master_matakuliah', 'master_matakuliah.id_matkul= jadwalkuliah.id_matakuliah');
            $select = $this->db->join('master_jurusan', 'master_matakuliah.id_jurusan= master_jurusan.id');
            $select = $this->db->where('jadwalkuliah.tahunajaran',$ajaran);
            $select = $this->db->group_by('master_jurusan.id');
            $select = $this->db->group_by('semester');
            $select = $this->db->order_by('nama_jurusan');
            $data['jurusan'] = $this->m->Get_All('jadwalkuliah', '$select');

            $select = $this->db->select('*,jadwalkuliah.id as id_jadwal,kesediaan_mengajar.id as id_kesediaan, kesediaan_mengajar.status as status_kesediaan');
            $select = $this->db->join('users', 'users.username = kesediaan_mengajar.id_user');
            $select = $this->db->join('jadwalkuliah', 'jadwalkuliah.id = kesediaan_mengajar.id_jadwal');
            $select = $this->db->join('master_matakuliah', 'master_matakuliah.id_matkul = jadwalkuliah.id_matakuliah');
            $select = $this->db->join('master_jurusan', 'master_jurusan.id	 = master_matakuliah.id_jurusan');
            $select = $this->db->where('username', $this->session->userdata('username'));
            $data['kesediaan'] = $this->m->Get_All('kesediaan_mengajar', '$select');

            $select = $this->db->select('*');
            $select = $this->db->where('id_user', $this->session->userdata('username'));
            $waktu_kesediaan = $this->m->Get_All('kesediaan_waktu_mengajar', '$select');

            $hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
            $sesi = array("","08.00 - 09.40","09.50 - 11.30","12.30 - 14.10","14.20 - 16.00","16.10 - 17.50","18.30 - 20.10");

            for($i=1;$i<=6;$i++){
              for($s=1;$s<=6;$s++){
                $data['waktu_kesediaan'][$hari[$i]][$sesi[$s]]="";
              }
            }
            foreach($waktu_kesediaan as $k){
              $data['waktu_kesediaan'][$k->hari][$k->waktu]="checked";
            }
            $data['tahunajaran'] = $ajaran;
            $this->load->view('dosen/dashboard', $data);
        }
    }
    function show_kesediaan_mengajar(){
      $select = $this->db->select('*,jadwalkuliah.id as id_jadwal,kesediaan_mengajar.id as id_kesediaan, kesediaan_mengajar.status as status_kesediaan');
      $select = $this->db->join('users', 'users.username = kesediaan_mengajar.id_user');
      $select = $this->db->join('jadwalkuliah', 'jadwalkuliah.id = kesediaan_mengajar.id_jadwal');
      $select = $this->db->join('master_matakuliah', 'master_matakuliah.id_matkul = jadwalkuliah.id_matakuliah');
      $select = $this->db->join('master_jurusan', 'master_jurusan.id	 = master_matakuliah.id_jurusan');
      $select = $this->db->where('username', $this->session->userdata('username'));
      $kesediaan = $this->m->Get_All('kesediaan_mengajar', '$select');

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
        echo'
          <tr>
              <td width="10px" class="text-center">'.$no++.'</td>
              <td width="100px" class="text-left">'.$r->nama_jurusan.'</td>
              <td width="100px" class="text-left">'.$r->matakuliah.'</td>
              <td width="100px" class="text-center">'.$r->semester.'</td>
              <td width="100px" class="text-center">'.$r->sks.'</td>
              <td width="100px" class="text-center"><span class="btn btn-sm btn-'.$bg.'">di '.$r->status_kesediaan.'</span></td>
              <td width="150px" class="text-center">';
                  if ($r->status_kesediaan != "Proses") {
                    echo'
                      <button class="btn btn-danger btn-sm" disabled>Hapus</button>';
                  } else {
                    echo'
                      <button class="btn btn-danger btn-sm" onclick="return hapus(`'.$r->id_kesediaan.'`)">Hapus</button>';
                  }
          echo'
              </td>
          </tr>';
      }
    }
    function simpan_kesediaan($id_jadwal)
    {
        $data = array(
            'id_jadwal'    =>  $id_jadwal,
            'id_user'      =>  $this->session->userdata('username'),
            'status'       =>  'Proses',
            'hari'         =>  '',
            'waktu'        =>  '',
        );
        $this->m->Save($data, 'kesediaan_mengajar');
        $this->show_kesediaan_mengajar();
    }
    function show_waktu_kesediaan(){

      $select = $this->db->select('*');
      $select = $this->db->where('id_user', $this->session->userdata('username'));
      $waktu = $this->m->Get_All('kesediaan_waktu_mengajar', '$select');

      $hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
      $sesi = array("","08.00 - 09.40","09.50 - 11.30","12.30 - 14.10","14.20 - 16.00","16.10 - 17.50","18.30 - 20.10");

      for($i=1;$i<=6;$i++){
        for($s=1;$s<=6;$s++){
          $waktu_kesediaan[$hari[$i]][$sesi[$s]]="";
        }
      }
      print_r($waktu_kesediaan);
      foreach($waktu as $k){
        $waktu_kesediaan[$k->hari][$k->waktu]="checked";
      }
      for($i=1;$i<=6;$i++){
        echo'
      <tr>
        <td class="text-center">'.$hari[$i].'</td>';
        for($s=1;$s<=6;$s++){ $onclick="savewaktu"; if($waktu_kesediaan[$hari[$i]][$sesi[$s]]=="checked"){$onclick="removewaktu";}
        echo'
          <td class="text-center">';
            if(($i<6) or ($i==6 && $s<4)){ 
                echo '<input type="checkbox" value="" onclick="return '.$onclick.'(`'.$hari[$i].'`,`'.$sesi[$s].'`)" class="form-control" '.$waktu_kesediaan[$hari[$i]][$sesi[$s]].'>';
            }
          echo '</td>';
          }
        echo'
      </tr>';
      }
    }
    function simpan_waktu_kesediaan()
    {
      $data = array(
          'id_user'      =>  $this->session->userdata('username'),
          'hari'         =>  $this->input->post('hari'),
          'waktu'        =>  $this->input->post('waktu'),
      );
      $table='kesediaan_waktu_mengajar';
      $this->m->Delete($data, $table);
      $this->m->Save($data, $table);
      $this->show_waktu_kesediaan();
    }
    function hapus_waktu_kesediaan()
    {
      $data = array(
          'id_user'      =>  $this->session->userdata('username'),
          'hari'         =>  $this->input->post('hari'),
          'waktu'        =>  $this->input->post('waktu'),
      );
      $table='kesediaan_waktu_mengajar';
      $this->m->Delete($data, $table);
      $this->show_waktu_kesediaan();
    }
    function ubah_kesediaan()
    {
        $data = array(
            'id_jadwal'    =>  $this->input->post('id_jadwal'),
            'id_user'      =>  $this->session->userdata('username'),
            'status'       =>  'Proses',
            'hari'         =>  $this->input->post('hari'),
            'waktu'        =>  $this->input->post('waktu_mulai')." - ".$this->input->post('waktu_akhir'),
        );
        $table = 'kesediaan_mengajar';
        $where = array(
            'id'        =>    $this->input->post('id_kesediaan'),
        );
        $this->m->Update($where, $data, $table);
        $this->show_kesediaan_mengajar();
    }
    public function hapus_kesediaan()
    {
        $table = 'kesediaan_mengajar';
        $where = array(
            'id'        =>    $this->input->post('id_kesediaan'),
        );
        $this->m->Delete($where, $table);
        $this->show_kesediaan_mengajar();
    }
}
