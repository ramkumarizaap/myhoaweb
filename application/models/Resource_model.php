<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resource_model extends CI_Model 
{
	public function insert($table,$data)
	{
		$result = $this->db->insert($table,$data);
		//return $result->insert_id();
	}
	public function get_community($table,$where)
	{
		$this->db->where($where);
		$result = $this->db->get($table);
		return $result->result_array();
	}
	public function select($table,$where)
	{
		$this->db->where($where);
		$result = $this->db->get($table);
		return $result->result_array();
	}
	public function delete($table,$data)
	{
		$this->db->delete($table,$data);
	}
	public function get_documents($where)
	{
		$this->db->select("a.*,b.cat_name");
		$this->db->from("hoa_resource_document a");
		$this->db->join("hoa_resource_category b","a.category=b.id");
		$this->db->where($where);
		$result = $this->db->get();
		return $result->result_array();
	}
}
?>