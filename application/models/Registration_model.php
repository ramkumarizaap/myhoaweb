<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration_model extends CI_Model 
{
	public function get_accounts_type($table,$where='')
	{
		$this->db->where($where);
		$result = $this->db->get($table);
		return $result->result_array();
	}
	public function insert($table,$data)
	{
		$this->db->insert($table,$data);
	}
	public function input_check($table,$val)
	{
		$this->db->where($val);
		$result = $this->db->get($table);
		return $result->row_array();
	}
	public function select($table,$where)
	{
		$this->db->where($where);
		$result = $this->db->get($table);
		return $result->row_array();
	}
}
?>