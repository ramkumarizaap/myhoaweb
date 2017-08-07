<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller 
{
	public $data="";
	public $init_scripts  = array();
	function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
		//if(!$this->session->userdata('login_data')['id'])
			//redirect('');
	}
	public function index()
	{
		$this->layout->view('login','admin');
	}
	public function check()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$chk = $this->login_model->login_check($username,$password);
		if($chk)
		{
			$this->session->set_userdata('admin_data',$chk);
			$output['login_status'] = "success";
			$output['redirect_url'] = "home";
		}
		else
		{
			$this->session->set_flashdata("login_fail",TRUE);
			$output['login_status'] = "invalid";
			$output['redirect_url'] = "";
		}		
		echo json_encode($output);
		//$this->layout->view('login','admin');
	}
	public function logout()
	{
		$this->session->unset_userdata('admin_data');
		redirect('');
	}
}
?>