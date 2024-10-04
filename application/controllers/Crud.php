<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends CI_Controller {

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
	Public	 function __construct()
	{
		parent::__construct();
		$this->load->model('Models','m');
	}
		public function index()
	{
		//Tampil Join
		$select = $this->db->select('*');
		$select = $this->db->join('contoh2','contoh2.id_jabatan=contoh1.id_jabatan');
		$data['read'] = $this->m->Get_All('contoh1','$select');
		//Tampil Jabatan Select Option
		$select = $this->db->select('*');
		$data['read2'] = $this->m->Get_All('contoh2','$select');
		$this->load->view('crud_modal',$data);
	}

	function add()
	{	
	    $data=array(
	      'id_jabatan'    =>  $this->input->post('id_jabatan'),	
	      'nama'    =>  $this->input->post('nama')
	    );
	    if(!empty($_FILES['foto']['name']))
	    {
	      $path = './assets/img/';
	      $upload = $this->_do_upload($path);
	      $data['foto'] = $upload;
	    }else{
	      $data['foto'] = "default.jpg";
	    }
	    
	    $this->m->Save($data, 'contoh1');
	    redirect(base_url().'Crud');
	}

  private function _do_upload($path){ 
        $config['upload_path']          = $path;
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 500000; //set max size allowed in Kilobyte
        $config['max_width']            = 500000; // set max width image allowed
        $config['max_height']           = 500000; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
        $this->load->library('upload', $config);
        if(!$this->upload->do_upload('foto')) //upload and validate
        {
            $data['inputerror'][] = 'foto';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
    }
    return $this->upload->data('file_name');
  }

  function edit()
	{
		$data=array(
	      'id_jabatan'    =>  $this->input->post('id_jabatan'),	
	      'nama'    =>  $this->input->post('nama')
	    );

		$table = 'contoh1';
		$where=array(
			'id'		=>	$this->input->post('id')
		);

		if(!empty($_FILES['foto']['name']))
		{
			$path = 'assets/img/';
			$upload = $this->_do_upload($path);
			$data['foto'] = $upload;

		$read = $this->m->Get_Where($where, $table);
		if(file_exists('assets/img/'.$read[0]->foto) && ($read[0]->foto != 'default.jpg'))
			unlink('assets/img/'.$read[0]->foto);
		}
		$this->m->Update($where, $data, $table);	
		redirect(base_url().'Crud');
	}
	public function delete()
	{
		$table = 'contoh1';
		$where=array(
			'id'		=>	$_GET['id']
		);
		$read = $this->m->Get_Where($where, $table);
		if(file_exists('assets/img/'.$read[0]->foto) && ($read[0]->foto != 'default.jpg'))
			unlink('assets/img/'.$read[0]->foto);
		$this->m->Delete($where, $table);
		redirect(base_url().'Crud');
	}

}
