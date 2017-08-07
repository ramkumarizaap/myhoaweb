<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inbox_model extends CI_Model
{
	public function select($table,$where='')
	{
		if($where!='')
			$this->db->where($where);
		$result = $this->db->get($table);
		return $result->row_array();
	}
	public function get_inbox()
	{
		$this->db->order_by("created_date","desc");
		$result = $this->db->get("hoa_messages");
		return $result->result_array();
	}
	public function delete($table,$where)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}
}
?>