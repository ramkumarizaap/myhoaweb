<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inbox_model extends CI_Model 
{
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
	public function delete($table,$where)
	{
		$this->db->where($where);
	  $this->db->delete($table);
	}
	public function select($table,$where)
	{
		$this->db->where($where);
	  $result = $this->db->get($table);
	  return $result->row_array();
	}
	public function get_messages($id)
	{

		$result = $this->db->query("SELECT a.*,b.firstname FROM `hoa_messages` a,hoa_users b  where a.id IN ( select max(id) from hoa_messages group by reply_id ) and (a.from_id=b.id or a.to_id=b.id) and (a.to_id=".$id." or a.from_id=".$id.") group by a.reply_id order by a.created_date desc");
		return $result->result_array();
	}
	public function get_message_by_id($id)
	{
		$result = $this->db->query("select a.*,b.firstname as to_name from hoa_messages a,hoa_users b where a.from_id = b.id and a.reply_id=$id order by a.created_date desc");
		/*$this->db->from("hoa_messages a");
		$this->db->where("a.reply_id",$id);
		$this->db->join("hoa_users b","a.from_id=b.id");
		$result = $this->db->get();*/
		return $result->result_array();
	}
	public function get_admin($table,$where)
	{
		$this->db->where($where);
		$result = $this->db->get($table);
		return $result->row_array();
	}
}
?>