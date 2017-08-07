<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Classifieds_model extends CI_Model 
{
	public function insert($table,$data)
	{
		$result = $this->db->insert($table,$data);
		//return $result->insert_id();
	}
	public function get_classifieds($where='')
	{
		$this->db->select("a.*,b.firstname");
		$this->db->from("hoa_classifieds a");
		$this->db->join("hoa_users b","a.user_id=b.id");
		if($where!='')
			$this->db->like("a.ad_name",$where);	
		$this->db->order_by("a.created_date","desc");
		$result = $this->db->get();
		return $result->result_array();
	}
	public function select($where='')
	{
		$this->db->select("a.*,b.firstname,b.email,b.phone");
		$this->db->from("hoa_classifieds a");
		$this->db->join("hoa_users b","a.user_id=b.id");
		if($where!='')
			$this->db->where("a.id",$where);	
		$this->db->order_by("a.created_date","desc");
		$result = $this->db->get();
		return $result->row_array();
	}
}
?>