<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller 
{
		public $data="";
		public $init_scripts  = array();
	  function __construct()
    {
      parent::__construct();
      $this->load->model("home_model");
    }
	public function index()
	{
		if($this->session->userdata('login_data')['id']=="")
			$this->layout->view('home','frontend');
		else
			redirect("home/home");
	}
	public function forgot($type)
	{
		$this->data['type'] = $type;
		$this->layout->view('forgot','frontend');
	}
	public function do_forgot($type)
	{
		$email = $this->input->post('email');
		$type = $this->input->post('type');
		$this->email->setFrom("contact@hoa.com","myHOA");
		$this->email->to($email);
		$this->email->send();
		$this->layout->view('forgot','frontend');
	}
	public function login_check()
	{
		$username =  $this->input->post('username');
		$password =  $this->input->post('password');
		$where = array("username"=>$username,"password"=>$password);	
		$chk = $this->home_model->login_check("hoa_users",$where);
		if(!$chk)
		{
			echo "Fail";
		}
		else
		{
			$this->session->set_userdata("login_data",$chk);
		}
	}
	public function logged()
	{
		if($this->session->userdata('login_data')['id'])
		{
			$this->session->set_flashdata("succ",TRUE);
			redirect("home/home");
		}
		else
			redirect("home");
	}
	public function home()
	{
		if($this->session->userdata('login_data')['id'])
		{
			$user_id = $this->session->userdata('login_data')['id'];
			$this->data['users'] = $this->home_model->select("hoa_users",array("id"=>$user_id));
 		  $this->data['community'] = $this->home_model->get_community($user_id);
			$this->layout->view("home/home");
		}
		else
			redirect("home");
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect("home");
	}
	public function community($id)
	{
		$this->data['id'] = $id;
		$this->data['community'] = $this->home_model->select("hoa_community",array("id"=>$id));
		$this->load->library('googlemaps');
		$latitude = $this->data['community']['latitude'];
		$longitude = $this->data['community']['longitude'];	
		$config['center'] = $latitude.", ".$longitude;
		$config['zoom'] = '10';
		$this->googlemaps->initialize($config);
		$marker = array();
		$marker['animation'] = 'DROP';
		$marker['infowindow_content'] = $this->data['community']['name'];
		$marker['position'] = $latitude.", ".$longitude;
		$this->googlemaps->add_marker($marker);
		$this->data['map'] = $this->googlemaps->create_map();
		$this->data['streams'] = $this->home_model->get_activity_streams($id);
		$this->data['docs'] = $this->home_model->select_multiple("hoa_community_docs",array("community_id"=>$id));
		$this->data['notify'] = $this->home_model->select_multiple("hoa_emergency_notification",array("community_id"=>$id));
		$this->layout->view('home/community','frontend');
	}
	public function share_post()
	{
		$id = $this->session->userdata('login_data')['id'];
		$msg = $this->input->post('message');
		$comm_id = $this->input->post('comm_id');
		$file1 = isset($_FILES['userfile1']['name']) ? $_FILES['userfile1']['name'] : "";
		$file2 = isset($_FILES['userfile2']['name']) ? $_FILES['userfile2']['name'] : "";
		if($file1!='')
		{
			$config['upload_path']          = './assets/images/stream/photo';
    	$config['allowed_types']        = 'gif|jpg|png';
    	$config['max_size']             = 5000;
    	$config['max_width']            = 1024;
    	$config['max_height']           = 768;
	    $this->load->library('upload', $config);
			$img = $this->do_upload1();
			$ins_data['photo'] = "assets/images/stream/photo/".$img['upload_data']['file_name'];
		}
		else if($msg!='')
		{
			$ins_data['message'] = $msg;
		}
		else if($file2!='')
		{
			$img = $this->do_upload2();
			$ins_data['video'] = "assets/images/stream/video/".$img['upload_data']['file_name'];
		}
		//echo "<script>alert('Uploaded Successfully');</script>";
		$ins_data['community_id'] = $comm_id;
		$ins_data['creator_id'] = $id;
		$this->home_model->insert("hoa_activity_stream",$ins_data);
		redirect("home/community/".$comm_id);
	}
	public function document()
	{
		$id = $this->session->userdata('login_data')['id'];
		$comm_id = $this->input->post('comm_id');
		$config['upload_path']          = './assets/docs';
    $config['allowed_types']        = 'pdf|doc|docx';
    $config['max_size']             = 5000;
	  $this->load->library('upload', $config);
		$img = $this->do_upload1();
		$ins_data['user_id'] = $id;
		$ins_data['community_id'] = $comm_id;
		$ins_data['doc'] = "assets/docs/".$img['upload_data']['file_name'];
		$this->home_model->insert("hoa_community_docs",$ins_data);
		redirect("home/community/".$comm_id);
	}
	public function do_upload1()
  {
    if ( ! $this->upload->do_upload('userfile1'))
    {
      $error = array('error' => $this->upload->display_errors());
    }
    else
    {
      $data = array('upload_data' => $this->upload->data());
    }
    return $data;
  }
  public function do_upload2()
  {
    $config['upload_path']          = './assets/images/stream/video';
    $config['allowed_types']        = 'mp4|flv|wav';
    //$config['max_size']             = 100;
    //$config['max_width']            = 1024;
    //$config['max_height']           = 768;

    $this->load->library('upload', $config);

    if ( ! $this->upload->do_upload('userfile2'))
    {
      $error = array('error' => $this->upload->display_errors());
    }
    else
    {
      $data = array('upload_data' => $this->upload->data());
    }
    return $data;
  }
  public function delete()
  {
  	$table = $_POST['table'];
  	$id = $_POST['id'];
  	$field = $_POST['field'];
  	$this->db->where($field,$id);
  	$this->db->delete($table);
  }
public function change_banner()
	{
		$id = $this->input->post('comm_id');
		$config['upload_path']          = './assets/images';
    $config['allowed_types']        = 'jpeg|jpg|png|gif';
    $config['max_size']             = 5000;
	  $this->load->library('upload', $config);
		$img = $this->do_upload1();
		$up_data['banner'] = "assets/images/".$img['upload_data']['file_name'];
		$up = $this->home_model->update("hoa_community",$up_data,array("id"=>$id));
		if($up)
		{
			echo "Fail";
		}
		else
			echo "Success";
	}
	public function create_notification($id)
	{
		$this->data['id'] = $id;
		$this->layout->view("home/notification",'frontend');
	}
	public function add_notification($id)
	{
		$this->form_validation->set_rules('title','Title',"trim|required|max_length[50]|min_length[3]");
		$this->form_validation->set_rules('desc','Description',"trim|required");
		if($this->form_validation->run()==FALSE)
		{
			$this->data['id'] = $id;
			$this->layout->view("home/notification",'frontend');
		}
		else
		{
			$form = $this->input->post();
			$ins_data['user_id'] = $this->session->userdata('login_data')['id'];
			$ins_data['title'] = $form['title'];
			$ins_data['description'] = $form['desc'];
			$ins_data['community_id'] = $id;
			$this->home_model->insert("hoa_emergency_notification",$ins_data);
			redirect("home/community/".$id);
		}
	}
	public function send_notification($id)
	{
		$this->session->set_flashdata("notify_succ","TRUE");
		redirect("home/community/".$id);
	}
}
