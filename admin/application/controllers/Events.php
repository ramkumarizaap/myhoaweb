<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Events extends CI_Controller 
{
	public $data="";
	public $init_scripts  = array();
	function __construct()
	{
		parent::__construct();
		$this->load->model('event_model');
		$id = $this->session->userdata('admin_data')['id'];
		$this->data['users'] = $this->event_model->select("hoa_users",array("id"=>$id));

		if(!$this->session->userdata('admin_data')['id'])
			redirect('');
	}
	public function manage_events()
	{
		$this->data['events'] = $this->event_model->get_events();
		$this->layout->view("events/manage_events",'admin');
	}
	public function update_status($st,$id)
	{
		$up_data['status'] = $st;
		$this->event_model->update("hoa_events",$up_data,array("id"=>$id));
		redirect("events/manage_events");
	}
	public function add_events($edit_id='')
	{
		$this->data['events']=array("id"=>"","name"=>"","description"=>"","banner"=>"","address"=>"","community"=>"","from_date"=>"","to_date"=>"");
		if($edit_id!='')
		{
			$this->data['events']=$this->event_model->select("hoa_events",array("id"=>$edit_id));
		}
		$this->data['community'] = $this->event_model->select_multiple("hoa_community");
		$this->layout->view("events/add_events",'admin');
	}
	public function create_events()
	{
		$form = $this->input->post();
		$edit_id = $form['edit_id'];
		$ins_data['name'] = $form['name'];
		$ins_data['desc'] = $form['desc'];
		$ins_data['community_id'] = implode(",",$form['community']);
		$ins_data['address'] = $form['address'];
		$ins_data['from_date'] = $form['from_date'];
		$ins_data['to_date'] = $form['to_date'];
		$address = str_replace(" ","+",$form['address']);
			$geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$address.'&sensor=false');
      $output= json_decode($geocode);
    $ins_data['latitude'] = $output->results[0]->geometry->location->lat;
    $ins_data['longitude'] = $output->results[0]->geometry->location->lng;
		$img = $this->do_upload();
		if($img['upload_data']['file_name']!='')
		{
			$ins_data['banner'] = "assets/events/".$img['upload_data']['file_name'];
		}
		else
		{
			if($form['old_img']=='')
				$ins_data['banner'] = "assets/events/7.jpg";
		}
		if($edit_id)
		{
			$insert = $this->event_model->update("hoa_events",$ins_data,array("id"=>$edit_id));
			$this->session->set_flashdata("events_add","Events updated successfully.",TRUE);
			redirect("events/manage_events");
		}
		else
		{
			$ins_data['status'] = 0;
			$ins_data['posted_by'] = $this->session->userdata('admin_data')['id'];
			$insert = $this->event_model->insert("hoa_events",$ins_data);
			if($insert)
			{			
				$this->session->set_flashdata("events_add","Events added successfully.",TRUE);
			}
			else
			{
				$this->session->set_flashdata("events_fail","Events creation failed.",TRUE);
			}
			redirect("events/manage_events");
		}
	}
	public function del_row($id,$field,$table)
	{
		$this->event_model->delete($table,array($field=>$id));
			$this->session->set_flashdata("community_add","Community deleted successfully from the system.",TRUE);
		redirect("events/manage_events");
	}
public function do_upload()
  {
    $config['upload_path']          = '../assets/events/';
    $config['allowed_types']        = 'gif|jpg|png';
    $config['max_size']             = 1000000;
    $config['max_width']            = 1024;
    $config['max_height']           = 768;

    $this->load->library('upload', $config);

    if ( ! $this->upload->do_upload('userfile'))
    {
      $error = array('error' => $this->upload->display_errors());
    }
    else
    {
      $data = array('upload_data' => $this->upload->data());
    }
    return $data;
  }
}
?>