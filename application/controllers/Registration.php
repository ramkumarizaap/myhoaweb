<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Controller 
{
	public $data="";public $init_scripts="";
	function __construct()
  {
    parent::__construct();
    $this->load->model("registration_model");
    
  }
	public function account_type()
	{
		$this->data['accounts'] = $this->registration_model->get_accounts_type("hoa_account_type",array("status"=>0));
		$this->layout->view('registration/account_type','frontend');
	}
	public function details($id)
	{
		$this->data['type'] = $id;
		$this->data['accounts'] = $this->registration_model->get_accounts_type("hoa_account_type",array("id"=>$id));
		$this->layout->view('registration/details','frontend');
	}
	public function check_code()
	{
		echo "0";
	}
	public function input_check()
	{
		$val = $this->input->post("val");
		$table = $this->input->post("table");
		$type = $this->input->post("type");
		if($type=="email")
			$field = "email";
		else
			$field = "code";
		$chk = $this->registration_model->input_check($table,array($field=>$val));
		if(!$chk)
		{
			echo "Fail";
		}
	}
	public function register()
	{
		$ins_data['firstname'] = $this->input->post('fname');
		$ins_data['lastname'] = $this->input->post('lname');
		$ins_data['username'] = $this->input->post('username');
		$ins_data['password'] = $this->input->post('password');
		$ins_data['email'] = $this->input->post('email');
		$code = $this->input->post('code');
		$get_code=$this->registration_model->select("hoa_community",array("code"=>$code));
		$ins_data['code'] = $get_code['id'];
		$ins_data['address'] = $this->input->post('address');
		$ins_data['phone'] = $this->input->post('phone');
		$ins_data['mobile'] = $this->input->post('mobile');
		$ins_data['about_me'] = $this->input->post('yourself');
		$ins_data['usertype'] = $this->input->post('type');
		$insert = $this->registration_model->insert("hoa_users",$ins_data);
		$this->layout->view('registration/success','frontend');
	}
}
?>