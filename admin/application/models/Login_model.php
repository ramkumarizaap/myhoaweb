<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model
{
	public function login_check($username,$password)
	{
		$this->db->where("username",$username);
		$this->db->where("password",$password);
		$this->db->where("usertype",'5');
		$result = $this->db->get("hoa_users");
		return $result->row_array();
	}
}
?>