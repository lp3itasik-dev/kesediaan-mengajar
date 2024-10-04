<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Models extends CI_Model
{
	public function view($table)
	{
		return $this->db->get($table);
	}
	public function Get_All($table, $select)
	{
		$select;
		$query = $this->db->get($table);
		return $query->result();
	}
	function Save($data, $table)
	{
		$result = $this->db->insert($table, $data);
		return $result;
	}
	function Update($where, $data, $table)
	{
		$this->db->update($table, $data, $where);
		return $this->db->affected_rows();
	}
	function Update_All($data, $table)
	{
		$this->db->update($table, $data);
		return $this->db->affected_rows();
	}
	function Delete($where, $table)
	{
		$result = $this->db->delete($table, $where);
		return $result;
	}
	function Delete_All($table)
	{
		$result = $this->db->delete($table);
		return $result;
	}
	public function Get_Where($where, $table)
	{
		$query = $this->db->get_where($table, $where);
		return $query->result();
	}
	public function gettotal($ajaran)
	{
		$query = $this->db->query("SELECT * FROM jadwalkuliah  join kesediaan_mengajar on kesediaan_mengajar.id = kesediaan_mengajar.id WHERE tahunajaran = '$ajaran'  group by kesediaan_mengajar.id");
		return $query->num_rows();
	}
	public function getterima($ajaran)
	{
		$query = $this->db->query("SELECT * FROM jadwalkuliah  join kesediaan_mengajar on kesediaan_mengajar.id = kesediaan_mengajar.id WHERE tahunajaran = '$ajaran' and status = 'Terima' group by kesediaan_mengajar.id");
		return $query->num_rows();
	}
	public function gettolak($ajaran)
	{
		$query = $this->db->query("SELECT * FROM jadwalkuliah  join kesediaan_mengajar on kesediaan_mengajar.id = kesediaan_mengajar.id WHERE tahunajaran = '$ajaran' and status = 'Tolak' group by kesediaan_mengajar.id");
		return $query->num_rows();
	}


	public function gettotalfilter($ajaran)
	{
		$query = $this->db->query("SELECT * FROM jadwalkuliah  join kesediaan_mengajar on kesediaan_mengajar.id = kesediaan_mengajar.id WHERE tahunajaran = '$ajaran'  group by kesediaan_mengajar.id");
		return $query->num_rows();
	}
	public function getterimafilter($ajaran)
	{
		$query = $this->db->query("SELECT * FROM jadwalkuliah  join kesediaan_mengajar on kesediaan_mengajar.id = kesediaan_mengajar.id  WHERE status = 'Terima' and tahunajaran = '$ajaran' group by kesediaan_mengajar.id ");
		return $query->num_rows();
	}
	public function gettolakfilter($ajaran)
	{
		$query = $this->db->query("SELECT * FROM jadwalkuliah  join kesediaan_mengajar on kesediaan_mengajar.id = kesediaan_mengajar.id   WHERE status = 'Tolak' and tahunajaran = '$ajaran' group by kesediaan_mengajar.id ");
		return $query->num_rows();
	}
}
