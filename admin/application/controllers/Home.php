<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller 
{
	public $data="";
	public $init_scripts  = array();
	function __construct()
	{
		parent::__construct();
		$this->load->model('home_model');
		$id = $this->session->userdata('admin_data')['id'];
		$this->data['users'] = $this->home_model->select("hoa_users",array("id"=>$id));

		if(!$this->session->userdata('admin_data')['id'])
			redirect('');
	}
	public function index()
	{
		$this->layout->view('dashboard/home','admin');
	}
	public function manage_user()
	{
		$this->layout->view("user/manage_user",'admin');
	}
}