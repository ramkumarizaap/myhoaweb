<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event_model extends CI_Model
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
	public function get_events()
	{
		$result = $this->db->query("select a.*,GROUP_CONCAT(b.name) as community_name,c.firstname,c.email,d.name as usertype from hoa_events a,hoa_community b,hoa_users c,hoa_account_type d where FIND_IN_SET(b.id,a.community_id) and a.posted_by=c.id and d.id=c.usertype group by a.id order by a.created_date desc");
		return $result->result_array();
	}
}
?>