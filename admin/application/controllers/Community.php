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
		$id = $this->session->userdata('admin_data')['id'];
		$this->data['users'] = $this->community_model->select("hoa_users",array("id"=>$id));

		if(!$this->session->userdata('admin_data')['id'])
			redirect('');
	}
	public function manage_community()
	{
		$this->data['community'] = $this->community_model->get_communities(array("a.status"=>0));
		$this->layout->view("community/manage_community",'admin');
	}
	public function update_status($st,$id)
	{
		$up_data['status'] = $st;
		$this->community_model->update("hoa_community",$up_data,array("id"=>$id));
		if($st==0)
			redirect("community/manage_community");
		else
			redirect("community/inactive_community");
	}
	public function inactive_community()
	{
		$this->data['community'] = $this->community_model->get_communities(array("a.status"=>1));
		$this->layout->view("community/inactive_community",'admin');
	}
	public function add_community($edit_id='')
	{
		$this->data['community']=array("id"=>"","name"=>"","desc"=>"","website"=>"","address"=>"","mobile"=>"","phone"=>"","fax"=>"");
		if($edit_id!='')
		{
			$this->data['community']=$this->community_model->select("hoa_community",array("id"=>$edit_id));
		}
		$this->layout->view("community/add_community",'admin');
	}
	public function create_community()
	{
		$form = $this->input->post();
		$edit_id = $form['edit_id'];
		$ins_data['name'] = $form['name'];
		$ins_data['banner'] = "assets/images/3.jpg";
		$ins_data['code'] = strtoupper(substr($form['name'],0,2).rand(10,99).substr($form['name'],-2).rand(0,9));
		$ins_data['desc'] = $form['desc'];
		$ins_data['website'] = $form['website'];
		$ins_data['address'] = $form['address'];
		$ins_data['mobile'] = $form['mobile'];
		$ins_data['phone'] = $form['phone'];
		$ins_data['fax'] = $form['fax'];
		if($edit_id)
		{
			$insert = $this->community_model->update("hoa_community",$ins_data,array("id"=>$edit_id));
			$this->session->set_flashdata("community_add","Community updated successfully.",TRUE);
			redirect("community/manage_community");
		}
		else
		{
			$ins_data['status'] = 0;
			$ins_data['created_by'] = $this->session->userdata('admin_data')['id'];
			$insert = $this->community_model->insert("hoa_community",$ins_data);
			if($insert)
			{			
				$this->session->set_flashdata("community_add","Community added successfully.",TRUE);
			}
			else
			{
				$this->session->set_flashdata("community_fail","Community creation failed.",TRUE);
			}
			redirect("community/manage_community");
		}
	}
	public function del_row($id,$field,$table)
	{
		$this->community_model->delete($table,array($field=>$id));
			$this->session->set_flashdata("community_add","Community deleted successfully from the system.",TRUE);
		redirect("community/manage_community");
	}
}
?>