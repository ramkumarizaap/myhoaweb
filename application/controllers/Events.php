<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends CI_Controller 
{
		public $data="";
		public $init_scripts  = array();
	  function __construct()
    {
      parent::__construct();
      $this->load->model("events_model");
    }
	public function index()
	{
		$this->data['events'] = $this->events_model->get_events();
		$this->layout->view("events/home","frontend");
	}
	public function create_events()
	{
		$this->data['community'] ="";
		if($this->session->userdata('login_data')['usertype']=="2")
		{
			$id = $this->session->userdata('login_data')['id'];
			$this->data['community'] = $this->events_model->get_communities($id);
		}
		$this->layout->view("events/create","frontend");	
	}
	public function add_events()
	{
		$this->form_validation->set_rules("name","Event Name","trim|required|max_length[50]|min_length[3]");
		$this->form_validation->set_rules("desc","Event Description","trim|required");
		$this->form_validation->set_rules("address","Event Address","trim|required");
		$this->form_validation->set_rules("from_date","From Date","trim|required");
		$this->form_validation->set_rules("to_date","To Date","trim|required");
		if($this->form_validation->run()==FALSE)
		{
			$this->layout->view("events/create","frontend");
		}	
		else
		{
			$form = $this->input->post();
			$ins_data['posted_by'] = $this->session->userdata('login_data')['id'];
			$ins_data['community_id'] = implode(",",$form['community']);
			$ins_data['name'] = $form['name'];
			$ins_data['desc'] = $form['desc'];
			$ins_data['address'] = $form['address'];
			$ins_data['from_date'] = date("Y-m-d H:i:s",strtotime($form['from_date']));
			$ins_data['to_date'] = date("Y-m-d H:i:s",strtotime($form['to_date']));
			$address = str_replace(" ","+",$form['address']);
			$geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$address.'&sensor=false');
      $output= json_decode($geocode);
      $ins_data['latitude'] = $output->results[0]->geometry->location->lat;
      $ins_data['longitude'] = $output->results[0]->geometry->location->lng;
      $this->events_model->insert("hoa_events",$ins_data);
      redirect('events');
		}
	}
	public function respond($id,$ans)
	{
		$ins_data['event_id'] = $id;
		$ins_data['status'] = $ans;
		$ins_data['user_id'] = $this->session->userdata('login_data')['id'];
		$this->events_model->insert("hoa_events_results",$ins_data);
		redirect('events');
	}
}
?>