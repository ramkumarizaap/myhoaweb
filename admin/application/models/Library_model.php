<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Library_model extends CI_Model
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
	public function get_categories()
	{
		$this->output->enable_profiler(TRUE);
		$this->db->select("a.*,count(b.id) as docs");
		$this->db->from("hoa_resource_category a");
		$this->db->join("hoa_resource_document b","a.id=b.category",'left outer');
		$this->db->order_by("a.id","desc");
		$this->db->group_by("a.id");
		$result = $this->db->get();
		return $result->result_array();
	}
	public function get_documents($where='')
	{
		if($where!='')
			$this->db->where($where);
		$this->db->select("a.*,b.cat_name");
		$this->db->from("hoa_resource_document a");
		$this->db->join("hoa_resource_category b","b.id=a.category");
		//$this->db->group_by("a.id");
		$result = $this->db->get();
		return $result->result_array();
	}
	public function get_files($table,$where='')
	{
		if($where!='')
			$this->db->where($where);
	/*	$this->db->select("a.*,b.cat_name");
		$this->db->from("hoa_resource_document a");
		$this->db->join("hoa_resource_category b","b.id=a.category");
		//$this->db->group_by("a.id");*/
		$result = $this->db->get($table);
		return $result->result_array();
	}
}
?>