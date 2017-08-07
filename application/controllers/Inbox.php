<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inbox extends CI_Controller 
{
		public $data="";
		public $init_scripts  = array();
	  function __construct()
    {
      parent::__construct();
      $this->load->model("inbox_model");
    }
	public function index()
	{
		$user_id = $this->session->userdata('login_data')['id'];
		$this->data['messages'] = $this->inbox_model->get_messages($user_id);
		$this->layout->view("inbox/home","frontend");
	}
	public function message($id,$row_id)
	{
		$this->data['msg_id'] = $id;
		$this->data['row_id'] = $row_id;
		$user_id = $this->session->userdata('login_data')['id'];
		$get_id = $this->inbox_model->select("hoa_messages",array("id"=>$row_id));
		if($this->session->userdata('login_data')['usertype']=="2")
		{
			$this->data['from_id'] = $get_id['to_id'];
			$this->data['to_id'] = $get_id['from_id'];
			$up_data['admin_read'] = 1;
			$this->inbox_model->update("hoa_messages",$up_data,array("reply_id"=>$id));
		}
		else if($this->session->userdata('login_data')['usertype']=="1")
		{
			$get_admin = $this->inbox_model->get_admin("hoa_community",array("id"=>$this->session->userdata('login_data')['code']));
			$this->data['from_id'] = $this->session->userdata('login_data')['id'];
			$this->data['to_id'] =  $get_admin['created_by'];
			$up_data['user_read'] = 1;
			$this->inbox_model->update("hoa_messages",$up_data,array("reply_id"=>$id));
		}
		$this->data['messages'] = $this->inbox_model->get_message_by_id($id);
		$this->layout->view("inbox/message","frontend");
	}
	public function create_message()
	{
		$subject = $this->input->post('subject');
		$message = $this->input->post('message');
		$community = $this->session->userdata('login_data')['code'];
		$img = $this->do_upload();
		$get_admin = $this->inbox_model->get_admin("hoa_community",array("id"=>$community));
		$ins_data['from_id'] = $this->session->userdata('login_data')['id'];
		$ins_data['to_id'] = $get_admin['created_by'];
		$ins_data['subject'] = $subject;
		$ins_data['message'] = $message;
		$ins_data['reply_id'] = 0;
		$ins_data['admin_read'] = 0;
		$ins_data['user_read'] = 1;
		$ins_data['file'] = "assets/files/".$img['upload_data']['file_name'];
		$reply = $this->inbox_model->insert("hoa_messages",$ins_data);
		$up_data['reply_id'] = $reply;
		$this->inbox_model->update("hoa_messages",$up_data,array("id"=>$reply));
		redirect("inbox/index");
	}
	public function do_upload()
  {
    $config['upload_path']          = './assets/files';
    $config['allowed_types']        = 'gif|jpg|png';
    $config['max_size']             = 50000;
    //$config['max_width']            = 1024;
    //$config['max_height']           = 768;
    $this->load->library('upload', $config);
    if ( ! $this->upload->do_upload('userfile'))
    {
      $error = array('error' => $this->upload->display_errors());
       return $error;
    }
    else
    {
      $data = array('upload_data' => $this->upload->data());
      return $data;
    }
  }
  public function delete_message()
  {
  	$id = $this->input->post('val');
  	$this->inbox_model->delete("hoa_messages",array("id"=>$id));
  }
  public function create_reply()
  {
  	$message = $this->input->post('message');
  	$msg_id = $this->input->post('msg_id');
  	$row_id = $this->input->post('row_id');
  	$community = $this->session->userdata('login_data')['code'];
  	if($this->input->post('userfile')['name']!='')
  	{
			$img = $this->do_upload();
			$ins_data['file'] = "assets/files/".$img['upload_data']['file_name'];
  	}
		$get_admin = $this->inbox_model->get_admin("hoa_community",array("id"=>$community));
		$ins_data['from_id'] = $this->input->post('from_id');
		$ins_data['to_id'] =  $this->input->post('to_id');
		$ins_data['message'] = $message;
		$ins_data['subject'] = "Reply";		
		if($this->session->userdata('login_data')['usertype']=="2")
			$ins_data['admin_read'] = 1;
		else if($this->session->userdata('login_data')['usertype']=="1")
			$ins_data['user_read'] = 1;
		$ins_data['reply_id'] = $msg_id;
		$this->inbox_model->insert("hoa_messages",$ins_data);
		redirect("inbox/message/".$msg_id."/".$row_id);
  }
}
?>                          