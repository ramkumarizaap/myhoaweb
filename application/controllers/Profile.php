<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller 
{
	public $data="";
	public $init_scripts  = array();
	function __construct()
	{
		parent::__construct();
		$this->load->model('profile_model');
		$id = $this->session->userdata('login_data')['id'];
		$this->data['profile']=$this->profile_model->select("hoa_users",array("id"=>$id));
		if(!$this->session->userdata('login_data')['id'])
			redirect('');
	}
	public function edit()
	{
		$this->layout->view('profile/edit_profile','frontend');
	}
	public function picture()
	{
		$this->layout->view('profile/edit_picture','frontend');
	}
	public function video()
	{
		$this->layout->view('profile/edit_video','frontend');
	}
	public function edit_profile()
	{
		$id = $this->session->userdata('login_data')['id'];
		$this->form_validation->set_rules("firstname","First Name","trim|required|alpha|min_length[3]");
		$this->form_validation->set_rules("lastname","Last Name","trim|required|alpha|min_length[3]");
		$this->form_validation->set_rules("password","Password","trim|required|min_length[3]|max_length[10]");
		$this->form_validation->set_rules("phone","Phone","trim|numeric|min_length[10]");
		$this->form_validation->set_rules("mobile","Mobile","trim|numeric|min_length[10]");
		if($this->form_validation->run()==FALSE)
		{
			$this->layout->view('profile/edit_profile','frontend');
		}
		else
		{
			$form = $this->input->post();
			$up_data['firstname'] = $form['firstname'];
			$up_data['lastname'] = $form['lastname'];
			$up_data['password'] = $form['password'];
			$up_data['address'] = $form['address'];
			$up_data['phone'] = $form['phone'];
			$up_data['mobile'] = $form['mobile'];
			$up_data['about_me'] = $form['about_me'];
			$this->profile_model->update("hoa_users",$up_data,array("id"=>$id));
			$this->session->set_flashdata("prof_succ",TRUE);
			redirect("profile/edit");
		}
	}
	public function edit_picture()
	{
		$id = $this->session->userdata('login_data')['id'];
		$name= $_FILES['userfile']['name'];
		if($name!='')
		{
			$config['upload_path']          = './assets/images/profile/pics/';
    	$config['allowed_types']        = 'gif|png|jpg|jpeg';
    	$config['max_size']             = 5000;
    	$this->load->library('upload', $config);
			$img = $this->do_upload();
			$up_data['photo'] = "assets/images/profile/pics/".$img['upload_data']['file_name'];
			$this->profile_model->update("hoa_users",$up_data,array("id"=>$id));
		}
		redirect("profile/picture");
	}
	public function edit_video()
	{
		$id = $this->session->userdata('login_data')['id'];
		$name= $_FILES['userfile']['name'];
		if($name!='')
		{
			$config['upload_path']          = './assets/images/profile/videos/';
    	$config['allowed_types']        = 'wav|mp4|flv';
    	$config['max_size']             = 10000;
    	$this->load->library('upload', $config);
			$img = $this->do_upload();
			$up_data['video'] = "assets/images/profile/videos/".$img['upload_data']['file_name'];
			$this->profile_model->update("hoa_users",$up_data,array("id"=>$id));
		}
		redirect("profile/video");
	}
	 public function do_upload()
  {   
    //$config['max_width']            = 1024;
    //$config['max_height']           = 768;
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