<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Community extends CI_Controller 
{
	public $data="";
	public $init_scripts  = array();
	function __construct()
	{
		parent::__construct();
		$this->load->model('community_model');
		if(!$this->session->userdata('login_data')['id'])
			redirect('');
	}
	public function create()
	{
		$this->layout->view('community/create','frontend');
	}
	public function add_community()
	{
		$this->form_validation->set_rules('comm_name', 'Community Name','trim|required|max_length[255]|min_length[3]');
		$this->form_validation->set_rules('desc', 'Description', 'trim|required');
		$this->form_validation->set_rules('website', 'Website', 'trim|required|valid_url');
		$this->form_validation->set_rules('phone', 'Phone Number', 'trim|numeric|max_length[12]|min_length[10]');
		$this->form_validation->set_rules('mobile', 'Mobile Number','trim|numeric|max_length[12]|min_length[10]');
		$this->form_validation->set_rules('fax', 'Fax Number', 'trim|numeric|max_length[12]|min_length[10]');
		$this->form_validation->set_rules('address', 'Address', 'trim|required');
		if($this->form_validation->run()==FALSE)
		{
			$this->layout->view('community/create','frontend');
		}
		else
		{
			$form = $this->input->post();
			$code = substr($form['comm_name'],0,2).rand(10,99).substr($form['comm_name'],-2).rand(0,9);
			$ins['name'] = $form['comm_name'];
			$ins['desc'] = $form['desc'];
			$ins['code'] = strtoupper($code);
			$ins['website'] = $form['website'];
			$ins['address'] = nl2br($form['address']);
			$ins['phone'] = $form['phone'];
			$ins['mobile'] = $form['mobile'];
			$ins['created_by'] = $this->session->userdata('login_data')['id'];
			$ins['fax'] = $form['fax'];
			$formattedAddr = str_replace(' ','+',$form['address']);
      //Send request and receive json data by address
      $geocodeFromAddr = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddr.'&sensor=false'); 
      $output = json_decode($geocodeFromAddr);
        //Get latitude and longitute from json data
      $ins['latitude']  = $output->results[0]->geometry->location->lat; 
      $ins['longitude'] = $output->results[0]->geometry->location->lng;
			$this->community_model->insert("hoa_community",$ins);
			$this->session->set_flashdata("comm_succ","Community Created Successfully!.",TRUE);
			redirect("home/home");
		}
		

	}
}
?>
