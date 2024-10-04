<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendidikan extends CI_Controller
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
	public	 function __construct()
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
		} else if ($this->session->userdata('akses') == 'Dosen') {
			redirect('login');
		} else {
			$tahun1 = date('Y');
			$tahun2 = date('Y') + 1;
			$ajaran =  $tahun1 . '/' . $tahun2;
			if (isset($_POST['tahun_akademik'])) {
				$ajaran = $this->input->post('tahun_akademik');
			}
			$select = $this->db->select('*');
			$select = $this->db->join('master_matakuliah', 'master_matakuliah.id_matkul = jadwalkuliah.id_matakuliah');
			$data['users'] = $this->m->Get_All('jadwalkuliah', '$select');

			$data['tahunajaran'] = $ajaran;
			$data['jmla'] = $this->m->gettotal($ajaran);
			$data['jmlb'] = $this->m->getterima($ajaran);
			$data['jmlc'] = $this->m->gettolak($ajaran);
			$this->load->view('dashboard', $data);
		}
	}
	public function filterreport()
	{
		if ($this->session->userdata('akses') == '') {
			$this->authenticated();
		} else if ($this->session->userdata('akses') == 'Dosen') {
			redirect('login');
		} else {
			$ajaran = $this->input->post('tahun_akademik');

			$data['tahunajaran'] = $ajaran;
			$data['jmla'] = $this->m->gettotalfilter($ajaran);
			$data['jmlb'] = $this->m->getterimafilter($ajaran);
			$data['jmlc'] = $this->m->gettolakfilter($ajaran);
			$this->load->view('dashboard', $data);
		}
	}
	public function jurusan()
	{
		if ($this->session->userdata('akses') == '') {
			$this->authenticated();
		} else if ($this->session->userdata('akses') == 'Dosen') {
			redirect('login');
		} else {
			$select = $this->db->select('*');
			$data['jurusan'] = $this->m->Get_All('master_jurusan', '$select');
			$this->load->view('jurusan', $data);
		}
	}
	function simpan_jurusan()
	{
		$data = array(
			'nama_jurusan'    =>  $this->input->post('nama_jurusan'),
		);

		$this->m->Save($data, 'master_jurusan');
		$this->session->set_flashdata('pesan', 'Data Jurusan Berhasil Ditambahkan!!');
		redirect(base_url() . 'pendidikan/jurusan');
	}
	function ubah_jurusan($id)
	{
		$data = array(
			'nama_jurusan'    =>  $this->input->post('nama_jurusan'),
		);

		$table = 'master_jurusan';
		$where = array(
			'id'		=>	$id
		);
		$this->session->set_flashdata('pesan', 'Data Jurusan Berhasil Diubah!!');
		$this->m->Update($where, $data, $table);
		redirect(base_url() . 'pendidikan/jurusan');
	}
	public function hapus_jurusan($id)
	{
		$table = 'master_jurusan';
		$where = array(
			'id'		=>	$id
		);
		$read = $this->m->Get_Where($where, $table);
		$this->session->set_flashdata('pesan', 'Data Jurusan Berhasil Dihapus!!');
		$this->m->Delete($where, $table);
		redirect(base_url() . 'pendidikan/jurusan');
	}
	public function matkul()
	{
		if ($this->session->userdata('akses') == '') {
			$this->authenticated();
		} else if ($this->session->userdata('akses') == 'Dosen') {
			redirect('login');
		} else {
			$select = $this->db->select('*');
			$data['jurusan'] = $this->m->Get_All('master_jurusan', '$select');

			$select = $this->db->select('*');
			$select = $this->db->join('master_jurusan', 'master_jurusan.id = master_matakuliah.id_jurusan');
			$data['matkul'] = $this->m->Get_All('master_matakuliah', '$select');
			$this->load->view('matkul', $data);
		}
	}
	function simpan_matkul()
	{
		$data = array(
			'kodematakuliah'    =>  $this->input->post('kodematakuliah'),
			'matakuliah'    =>  $this->input->post('matakuliah'),
			'sks'    =>  $this->input->post('sks'),
			'id_jurusan'    =>  $this->input->post('id_jurusan')
		);

		$this->m->Save($data, 'master_matakuliah');
		$this->session->set_flashdata('pesan', 'Data Matakuliah Berhasil Ditambahkan!!');
		redirect(base_url() . 'pendidikan/matkul');
	}
	function ubah_matkul($id_matkul)
	{
		$data = array(
			'kodematakuliah'    =>  $this->input->post('kodematakuliah'),
			'matakuliah'    =>  $this->input->post('matakuliah'),
			'sks'    =>  $this->input->post('sks'),
			'id_jurusan'    =>  $this->input->post('id_jurusan')
		);

		$table = 'master_matakuliah';
		$where = array(
			'id_matkul'		=>	$id_matkul
		);
		$this->session->set_flashdata('pesan', 'Data Matakuliah Berhasil Diubah!!');
		$this->m->Update($where, $data, $table);
		redirect(base_url() . 'pendidikan/matkul');
	}
	public function hapus_matkul($id_matkul)
	{
		$table = 'master_matakuliah';
		$where = array(
			'id_matkul'		=>	$id_matkul
		);
		$read = $this->m->Get_Where($where, $table);
		$this->session->set_flashdata('pesan', 'Data Matakuliah Berhasil Dihapus!!');
		$this->m->Delete($where, $table);
		redirect(base_url() . 'pendidikan/matkul');
	}
	public function jadwal()
	{
		if ($this->session->userdata('akses') == '') {
			$this->authenticated();
		} else if ($this->session->userdata('akses') == 'Dosen') {
			redirect('login');
		} else {
			$tahun1 = date('Y');
			$tahun2 = date('Y') + 1;
			$select = $this->db->select('*');
			$select = $this->db->select('jadwalkuliah.id as id_jadwal');
			$select = $this->db->join('master_matakuliah', 'master_matakuliah.id_matkul = jadwalkuliah.id_matakuliah');
			$select = $this->db->join('master_jurusan', 'master_jurusan.id = master_matakuliah.id_jurusan');
			$select = $this->db->where('tahunajaran', $tahun1 . '/' . $tahun2);
			$select = $this->db->order_by('matakuliah', 'asc');
			$data['jadwal'] = $this->m->Get_All('jadwalkuliah', '$select');

			$select = $this->db->select('*');
			$select = $this->db->join('master_jurusan', 'master_jurusan.id = master_matakuliah.id_jurusan');
			$select = $this->db->order_by('matakuliah', 'asc');
			$data['matkul'] = $this->m->Get_All('master_matakuliah', '$select');

			$select = $this->db->select('*');
			$data['users'] = $this->m->Get_All('users', '$select');

			$this->load->view('jadwal', $data);
		}
	}
	public function filtertahunajar()
	{
		if ($this->session->userdata('akses') == '') {
			$this->authenticated();
		} else if ($this->session->userdata('akses') == 'Dosen') {
			redirect('login');
		} else {
			$select = $this->db->select('*');
			$data['matkul'] = $this->m->Get_All('master_matakuliah', '$select');

			$select = $this->db->select('*');
			$data['users'] = $this->m->Get_All('users', '$select');

			$select = $this->db->select('*');
			$select = $this->db->select('jadwalkuliah.id as id_jadwal');
			$select = $this->db->join('master_matakuliah', 'master_matakuliah.id_matkul = jadwalkuliah.id_matakuliah');
			$select = $this->db->join('master_jurusan', 'master_jurusan.id = master_matakuliah.id_jurusan');
			$select = $this->db->where('tahunajaran', $this->input->post('tahun_akademik'));
			$data['jadwal'] = $this->m->Get_All('jadwalkuliah', '$select');
			$this->load->view('jadwal', $data);
		}
	}

	function simpan_jadwal()
	{
		$data = array(
			'id_matakuliah'    =>  $this->input->post('id_matakuliah'),
			'tahunajaran'    =>  $this->input->post('tahunajaran'),
			'semester'    =>  $this->input->post('semester')
		);

		$this->m->Save($data, 'jadwalkuliah');
		$this->session->set_flashdata('pesan', 'Data Jadwal Matakuliah Berhasil Ditambahkan!!');
		redirect(base_url() . 'pendidikan/jadwal');
	}
	function ubah_jadwal($id)
	{
		$data = array(
			'id_matakuliah'    =>  $this->input->post('id_matakuliah'),
			'tahunajaran'    =>  $this->input->post('tahunajaran'),
			'semester'    =>  $this->input->post('semester')
		);

		$table = 'jadwalkuliah';
		$where = array(
			'id'		=>	$id
		);
		$this->session->set_flashdata('pesan', 'Data Jadwal Matakuliah Berhasil Diubah!!');
		$this->m->Update($where, $data, $table);
		redirect(base_url() . 'pendidikan/jadwal');
	}
	public function hapus_jadwal($id)
	{
		$table = 'jadwalkuliah';
		$where = array(
			'id'		=>	$id
		);
		$read = $this->m->Get_Where($where, $table);
		$this->session->set_flashdata('pesan', 'Data Jadwal Matakuliah Berhasil Dihapus!!');
		$this->m->Delete($where, $table);
		redirect(base_url() . 'pendidikan/jadwal');
	}
	public function users()
	{
		if ($this->session->userdata('akses') == '') {
			$this->authenticated();
		} else if ($this->session->userdata('akses') == 'Dosen') {
			redirect('login');
		} else {
			$select = $this->db->select('*');
			$data['users'] = $this->m->Get_All('users', '$select');
			$this->load->view('users', $data);
		}
	}
	function simpan_users()
	{
		$data = array(
			'username'    =>  $this->input->post('username'),
			'password'  =>  $this->input->post('password'),
			'nama'  =>  $this->input->post('nama'),
			'akses' =>  $this->input->post('akses')
		);
		if (!empty($_FILES['foto']['name'])) {
			$path = 'global_assets/images/foto/';
			$upload = $this->_do_upload($path);
			$data['foto'] = $upload;
		} else {
			$data['foto'] = "user.png";
		}

		$this->m->Save($data, 'users');
		$this->session->set_flashdata('pesan', 'Data User Berhasil Ditambahkan!!');
		redirect(base_url() . 'pendidikan/users');
	}
	private function _do_upload($path)
	{
		$config['upload_path']          = $path;
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 500000; //set max size allowed in Kilobyte
		$config['max_width']            = 500000; // set max width image allowed
		$config['max_height']           = 500000; // set max height allowed
		$config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('foto')) //upload and validate
		{
			$data['inputerror'][] = 'foto';
			$data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		return $this->upload->data('file_name');
	}
	function ubah_users($username)
	{
		$data = array(
			'password'  =>  $this->input->post('password'),
			'nama'  =>  $this->input->post('nama'),
			'akses' =>  $this->input->post('akses')
		);

		$table = 'users';
		$where = array(
			'username'		=>	$username
		);

		if (!empty($_FILES['foto']['name'])) {
			$path = 'global_assets/images/foto/';
			$upload = $this->_do_upload($path);
			$data['foto'] = $upload;

			$read = $this->m->Get_Where($where, $table);
			if (file_exists('global_assets/images/foto/' . $read[0]->foto) && ($read[0]->foto != 'user.png'))
				unlink('global_assets/images/foto/' . $read[0]->foto);
		}
		$this->session->set_flashdata('pesan', 'Data Users Berhasil Diubah!!');
		$this->m->Update($where, $data, $table);
		redirect(base_url() . 'pendidikan/users');
	}
	public function hapus_users($username)
	{
		$table = 'users';
		$where = array(
			'username'		=>	$username
		);
		$read = $this->m->Get_Where($where, $table);
		if (file_exists('global_assets/images/foto/' . $read[0]->foto) && ($read[0]->foto != 'user.png'))
			unlink('global_assets/images/foto/' . $read[0]->foto);
		$this->session->set_flashdata('pesan', 'Data Users Berhasil Dihapus!!');
		$this->m->Delete($where, $table);
		redirect(base_url() . 'pendidikan/users');
	}
	public function kesediaan()
	{
		if ($this->session->userdata('akses') == '') {
			$this->authenticated();
		} else if ($this->session->userdata('akses') == 'Dosen') {
			redirect('login');
		} else {
			$select = $this->db->select('*');
			$select = $this->db->select('jadwalkuliah.id as id_jadwal');
			$select = $this->db->select('kesediaan_mengajar.id as id_kesediaan');
			$select = $this->db->select('master_jurusan.id as id_mjurusan');
			$select = $this->db->select('kesediaan_mengajar.status');
			$select = $this->db->join('users', 'users.username = kesediaan_mengajar.id_user');
			$select = $this->db->join('jadwalkuliah', 'jadwalkuliah.id = kesediaan_mengajar.id_jadwal');
			$select = $this->db->join('master_matakuliah', 'master_matakuliah.id_matkul = jadwalkuliah.id_matakuliah');
			$select = $this->db->join('master_jurusan', 'master_jurusan.id	 = master_matakuliah.id_jurusan');
			$select = $this->db->group_by('id_kesediaan');
			$data['kesediaan'] = $this->m->Get_All('kesediaan_mengajar', '$select');

			$select = $this->db->select('*');
			$data['matkul'] = $this->m->Get_All('master_matakuliah', '$select');

			$select = $this->db->select('*');
			$data['users'] = $this->m->Get_All('users', '$select');


			$select = $this->db->select('*');
			$select = $this->db->order_by('nama', 'asc');
			$data['users'] = $this->m->Get_All('users', '$select');
			$this->load->view('kesediaan', $data);
		}
	}
	function ubah_kesediaan($id_kesediaan)
	{
		$data = array(
			'kelas'    =>  $this->input->post('kelas'),
			'hari'    =>  $this->input->post('hari'),
			'waktu'    =>  $this->input->post('waktu'),
			'ruangan'    =>  $this->input->post('ruangan'),
			'status'    =>  $this->input->post('status')
		);

		$table = 'kesediaan_mengajar';
		$where = array(
			'id'		=>	$id_kesediaan
		);
		$this->m->Update($where, $data, $table);
		$this->session->set_flashdata('pesan', 'Status Kesediaan Mengajar Berhasil Diubah!!');
		redirect(base_url() . 'pendidikan/kesediaan');
	}
	public function laporankesediaan()
	{
		if ($this->session->userdata('akses') == '') {
			$this->authenticated();
		} else if ($this->session->userdata('akses') == 'Dosen') {
			redirect('login');
		} else {
			$select = $this->db->select('*');
			$data['jurusan'] = $this->m->Get_All('master_jurusan', '$select');

			$select = $this->db->select('*,count(matakuliah) as totalmatkul, sum(sks) as totalsks,kesediaan_mengajar.status');
			$select = $this->db->join('jadwalkuliah', 'jadwalkuliah.id = kesediaan_mengajar.id_jadwal');
			$select = $this->db->join('users', 'users.username = kesediaan_mengajar.id_user');
			$select = $this->db->join('master_matakuliah', 'master_matakuliah.id_matkul = jadwalkuliah.id_matakuliah');
			$select = $this->db->join('master_jurusan', 'master_jurusan.id	 = master_matakuliah.id_jurusan');
			$select = $this->db->group_by('users.username');
			$data['kesediaan'] = $this->m->Get_All('kesediaan_mengajar', '$select');

			$this->load->view('laporankesediaan', $data);
		}
	}
	public function cetaklaporankesediaan($username)
	{
		$select = $this->db->select('*');
		$select = $this->db->where('id_user', $username);
		$data['kesediaan'] = $this->m->Get_All('kesediaan_waktu_mengajar', $select);

		$select = $this->db->select('*,users.nama as nama_dosen');
		$select = $this->db->where('username', $username);
		$dosen = $this->m->Get_All('users', $select);

		$select = $this->db->select('*');
		$select = $this->db->join('master_jurusan', 'master_jurusan.id=master_matakuliah.id_jurusan');
		$select = $this->db->join('jadwalkuliah', 'jadwalkuliah.id_matakuliah=master_matakuliah.id_matkul');
		$select = $this->db->join('kesediaan_mengajar', 'kesediaan_mengajar.id_jadwal=jadwalkuliah.id');
		$select = $this->db->where('kesediaan_mengajar.id_user', $username);
		$select = $this->db->order_by('nama_jurusan');
		$data['matkul'] = $this->m->Get_All('master_matakuliah', $select);

		$hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
		for($i=1;$i<=6;$i++){
			for($s=1;$s<=6;$s++){
				$data['isi'][$hari[$i]][$s]="";
			}
		}
		$data['dosen']="";
		$data['matakuliah']="";
		foreach($data['kesediaan'] as $k){
			$sesi="1";
			if(substr($k->waktu,0,2)=="08"){$sesi="1";}
			if(substr($k->waktu,0,2)=="09"){$sesi="2";}
			if(substr($k->waktu,0,2)=="12"){$sesi="3";}
			if(substr($k->waktu,0,2)=="14"){$sesi="4";}
			if(substr($k->waktu,0,2)=="16"){$sesi="5";}
			if(substr($k->waktu,0,2)=="18"){$sesi="6";}

			$data['isi'][$k->hari][$sesi]="ada";
		}
		foreach($dosen as $k){
			$data['dosen']=$k->nama_dosen;
		}

		$this->load->view('cetaklaporankesediaan', $data);
	}
	public function cetaklaporankesediaan_listall()
	{
		$select = $this->db->select('*,sum(sks) as total_sks,kesediaan_mengajar.status,users.nama as nama_dosen,master_jurusan.nama_jurusan as master_jurusan');
		$select = $this->db->join('jadwalkuliah', 'jadwalkuliah.id = kesediaan_mengajar.id_jadwal');
		$select = $this->db->join('users', 'users.username = kesediaan_mengajar.id_user');
		$select = $this->db->join('master_matakuliah', 'master_matakuliah.id_matkul = jadwalkuliah.id_matakuliah');
		$select = $this->db->join('master_jurusan', 'master_jurusan.id = master_matakuliah.id_jurusan');
		$select = $this->db->group_by('users.username');
		$select = $this->db->group_by('nama_jurusan');
		$select = $this->db->group_by('master_matakuliah.id_matkul');
		$select = $this->db->group_by('semester');
		$select = $this->db->order_by('users.nama');
		$data['kesediaan'] = $this->m->Get_All('kesediaan_mengajar', '$select');
		$data['jenis_laporan']="all";
		$this->load->view('cetaklaporankesediaan_list', $data);
	}
	public function cetaklaporankesediaan_listdosen($username)
	{
		$select = $this->db->select('*,sum(sks) as total_sks,kesediaan_mengajar.status,users.nama as nama_dosen,master_jurusan.nama_jurusan as master_jurusan');
		$select = $this->db->join('jadwalkuliah', 'jadwalkuliah.id = kesediaan_mengajar.id_jadwal');
		$select = $this->db->join('users', 'users.username = kesediaan_mengajar.id_user');
		$select = $this->db->join('master_matakuliah', 'master_matakuliah.id_matkul = jadwalkuliah.id_matakuliah');
		$select = $this->db->join('master_jurusan', 'master_jurusan.id = master_matakuliah.id_jurusan');
		$select = $this->db->where('users.username',$username);
		$select = $this->db->group_by('users.username');
		$select = $this->db->group_by('nama_jurusan');
		$select = $this->db->group_by('master_matakuliah.id_matkul');
		$select = $this->db->group_by('semester');
		$select = $this->db->order_by('nama_jurusan');
		$data['kesediaan'] = $this->m->Get_All('kesediaan_mengajar', '$select');
		$data['jenis_laporan']="dosen";
		$data['dosen']="";
		foreach($data['kesediaan'] as $k){$data['dosen']=$k->nama_dosen;}
		$this->load->view('cetaklaporankesediaan_list', $data);
	}
	public function cetaklaporankesediaan_listjurusan($jurusan)
	{
		$select = $this->db->select('*,sum(sks) as total_sks,kesediaan_mengajar.status,users.nama as nama_dosen,master_jurusan.nama_jurusan as master_jurusan');
		$select = $this->db->join('jadwalkuliah', 'jadwalkuliah.id = kesediaan_mengajar.id_jadwal');
		$select = $this->db->join('users', 'users.username = kesediaan_mengajar.id_user');
		$select = $this->db->join('master_matakuliah', 'master_matakuliah.id_matkul = jadwalkuliah.id_matakuliah');
		$select = $this->db->join('master_jurusan', 'master_jurusan.id = master_matakuliah.id_jurusan');
		$select = $this->db->where('master_jurusan.id',$jurusan);
		$select = $this->db->group_by('users.username');
		$select = $this->db->group_by('nama_jurusan');
		$select = $this->db->group_by('master_matakuliah.id_matkul');
		$select = $this->db->group_by('semester');
		$select = $this->db->order_by('users.nama');
		$data['kesediaan'] = $this->m->Get_All('kesediaan_mengajar', '$select');
		$data['jenis_laporan']="jurusan";
		$data['jurusan']="";
		foreach($data['kesediaan'] as $k){$data['jurusan']=$k->nama_jurusan;}
		$this->load->view('cetaklaporankesediaan_list', $data);
	}
}
