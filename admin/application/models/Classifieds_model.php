<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Classifieds_model extends CI_Model
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
	public function get_classifieds($where)
	{
		$this->db->select("a.*,b.firstname,b.email,c.name as usertype");
		$this->db->from("hoa_classifieds a");
		$this->db->join("hoa_users b","a.user_id=b.id");
		$this->db->join("hoa_account_type c","b.usertype=c.id");
		$this->db->order_by("a.created_date","desc");
		$this->db->where($where);
		$result = $this->db->get();
		return $result->result_array();
	}
}
?>