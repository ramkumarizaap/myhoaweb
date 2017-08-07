<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model
{
	public function select($table,$where='')
	{
		if($where!='')
			$this->db->where($where);
		$result = $this->db->get($table);
		return $result->row_array();
	}
	public function get_counts($table,$where='')
	{
		if($where!='')
			$this->db->where($where);
		$this->db->select("count(id) as count");
		$result = $this->db->get($table);
		return $result->row_array();
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