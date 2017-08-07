<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Events_model extends CI_Model 
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
	public function get_events()
	{
		$this->db->select("a.*,b.firstname,(select count(id) from hoa_events_results where status='1' and event_id=a.id) as attendee,(select count(id) from hoa_events_results where status='2' and event_id=a.id) as no,(select count(id) from hoa_events_results where status='3' and event_id=a.id) as maybe");
		$this->db->from("hoa_events a");
		$this->db->join("hoa_users b","a.posted_by=b.id");
		//$this->db->where("");
	  $result = $this->db->get();
	  //echo $this->db->last_query();
	  //exit;
	  return $result->result_array();
	}
	public function get_communities($id)
	{	
		$this->db->where("a.created_by",$id);
		$this->db->select("a.*,b.firstname");
		$this->db->from("hoa_community a");
		$this->db->join("hoa_users b","a.created_by=b.id");
		$result = $this->db->get();
		return $result->result_array();
	}
}
?>