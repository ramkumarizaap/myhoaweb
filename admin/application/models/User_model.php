<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
	public function select($table,$where='')
	{
		if($where!='')
			$this->db->where($where);
		$result = $this->db->get($table);
		return $result->row_array();
	}
	public function insert($table,$data)
	{
		$this->db->insert($table,$data);
		return $this->db->insert_id();
	}
	public function delete($table,$where)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}
	public function update($table,$data,$where)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}
	public function select_multiple($table,$where='')
	{
		if($where!='')
			$this->db->where($where);
		$result = $this->db->get($table);
		return $result->result_array();
	}
}
?>