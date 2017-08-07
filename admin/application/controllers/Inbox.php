<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Inbox extends CI_Controller 
{
	public $data="";
	public $init_scripts  = array();
	function __construct()
	{
		parent::__construct();
		$this->load->model('inbox_model');
		$id = $this->session->userdata('admin_data')['id'];
		$this->data['users'] = $this->inbox_model->select("hoa_users",array("id"=>$id));

		if(!$this->session->userdata('admin_data')['id'])
			redirect('');
	}
	public function manage_inbox()
	{
		$this->data['inbox'] = $this->inbox_model->get_inbox();
		$this->layout->view('inbox/manage_inbox','admin');
	}
	public function del_row($id,$field,$table)
	{
		$this->inbox_model->delete($table,array($field=>$id));
			$this->session->set_flashdata("inbox_add","Inbox deleted successfully from the system.",TRUE);
		redirect("inbox/manage_inbox");
	}
	public function compose()
	{
		$this->layout->view('inbox/compose','admin');
	}
	public function get_message_by_id()
	{
		$id = $this->input->post('id');
		$data['msg'] = $this->inbox_model->select("hoa_messages",array("id"=>$id));
		$this->load->view('inbox/ajax_content',$data);
	}
}
?>