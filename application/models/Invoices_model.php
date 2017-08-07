<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoices_model extends CI_Model 
{
	public function get_community()
	{
		$result = $this->db->get("hoa_community");
		return $result->result_array();
	}
		public function get_users($where)
	{
		$this->db->where($where);
		$result = $this->db->get("hoa_users");
		return $result->result_array();
	}
}
?>