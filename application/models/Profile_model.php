<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_model extends CI_Model 
{
	public function insert($table,$data)
	{
		$result = $this->db->insert($table,$data);
		//return $result->insert_id();
	}
	public function select($table,$where)
	{
		$this->db->where($where);
		$result = $this->db->get($table);
		return $result->row_array();
	}
	public function update($table,$data,$where)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}
}
?>