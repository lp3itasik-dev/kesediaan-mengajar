<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
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
	public function index()
	{
		$this->load->view('login');
	}
	public function cek_login()
	{
		$username	= $this->input->post('username');
		$password	= $this->input->post('password');
		$select = $this->db->select('*');
		$select = $this->db->where('username', $username);
		$select = $this->db->where('password', $password);
		$login = $this->m->Get_All('users', '$select');
		if ($login) {
			$data	= array(
				'authenticated' => true,
				'username'	=>	$login[0]->username,
				'nama'			=>	$login[0]->nama,
				'akses'			=>	$login[0]->akses,
			);
			$this->session->set_userdata($data); // ini seseion na udah di masukkin
			echo $data['akses'];
		} else {
			echo 'false';
		}
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
}
