<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form_model extends CI_Model
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
	public function select_multiple($table,$where='',$order_by='')
	{
		if($where!='')
			$this->db->where($where);
		if($order_by!='')
			$this->db->order_by("sort",$order_by);
		$result = $this->db->get($table);
		return $result->result_array();
	}
	public function get_forms()
	{
		$result = $this->db->query("select a.*,GROUP_CONCAT(b.name) as community_name,c.firstname,c.email,d.name as usertype from hoa_form a,hoa_community b,hoa_users c,hoa_account_type d where FIND_IN_SET(b.id,a.community_id) and a.user_id=c.id and d.id=c.usertype group by a.id order by a.created_date desc");
		return $result->result_array();
	}
}
?>