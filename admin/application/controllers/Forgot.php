<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgot extends CI_Controller 
{
	public $data="";
	public $init_scripts  = array();
	function __construct()
	{
		parent::__construct();
		//if(!$this->session->userdata('login_data')['id'])
			//redirect('');
	}
	public function index()
	{
		$this->layout->view('forgot','admin');
	}
}
?>