<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model 
{
	public function login_check($table,$where)
	{
		$this->db->where($where);
		$result = $this->db->get($table);
		return $result->row_array();
	}
	public function select($table,$where)
	{
		$this->db->where($where);
		$result = $this->db->get($table);
		return $result->row_array();
	}
	public function select_multiple($table,$where)
	{
		$this->db->where($where);
		$result = $this->db->get($table);
		return $result->result_array();
	}
	public function insert($table,$data)
	{
		$this->db->insert($table,$data);
		return $this->db->insert_id();
	}
	public function update($table,$data,$where)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}
		public function get_community($id)
	{
		$result =	$this->db->query("select *,(select count(id) from hoa_users where code=hoa_community.id) as members from hoa_community where created_by=".$id);
		return $result->result_array();
	}
	public function get_activity_streams($id)
	{
		$this->db->select("a.*,b.firstname,c.name");
		$this->db->from("hoa_activity_stream a");
		$this->db->join("hoa_users b","a.creator_id=b.id");
		$this->db->join("hoa_community c","a.community_id=c.id");
		$this->db->order_by("a.created_date","desc");
		$result = $this->db->get();
		return $result->result_array();
	}
}
?>