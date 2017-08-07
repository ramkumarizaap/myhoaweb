<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Library extends CI_Controller 
{
	public $data="";
	public $init_scripts  = array();
	function __construct()
	{
		parent::__construct();
		$this->load->model('library_model');
		$id = $this->session->userdata('admin_data')['id'];
		$this->data['users'] = $this->library_model->select("hoa_users",array("id"=>$id));

		if(!$this->session->userdata('admin_data')['id'])
			redirect('');
	}
	public function manage_category()
	{
		$this->data['category'] = $this->library_model->get_categories();
		$this->layout->view('library/manage_category','admin');
	}
	public function manage_files()
	{
		$this->data['files'] = $this->library_model->get_documents();
		$this->layout->view('library/manage_files','admin');
	}
	public function manage_documents($id='')
	{
		$where='';
		$this->data['cat_id']='';
		if($id!='')
		{
			$where = array("a.category"=>$id);
			$this->data['cat_id'] = $id;
		}
		$this->data['documents'] = $this->library_model->get_documents($where);
		$this->layout->view('library/manage_documents','admin');
	}
	public function update_status($st,$id,$table)
	{
		$up_data['status'] = $st;
		$this->library_model->update($table,$up_data,array("id"=>$id));
		if($table=='hoa_resource_category')
			redirect("library/manage_category");
		else
			redirect("library/manage_documents");
	}
	public function del_row($id,$field,$table)
	{
		$this->event_model->delete($table,array($field=>$id));
			$this->session->set_flashdata("library_add","Category deleted successfully from the system.",TRUE);
			if($table=='hoa_resource_category')
				redirect("library/manage_category");
			else
				redirect("library/manage_documents");
	}
	public function download($id)
	{
		$this->load->helper('download');
		ob_clean();
		$data = $this->library_model->get_documents(array("a.id"=>$id));
		$path = $data[0]['document'];
		$up_data['downloads'] = $data[0]['downloads'] + 1;
		$this->library_model->update("hoa_resource_document",$up_data,array("id"=>$id));
		$name = explode("/",$path);
		$pth    =   file_get_contents("../".$path);
		$nme    =   $name[2];
		force_download($nme, $pth);
		redirect("library/manage_documents");
	}
	public function create_category($id='')
	{
		$this->data['category'] = array("id"=>"","cat_name"=>"","cat_desc"=>"","community"=>"","cat_img"=>"");
		if($id!='')
		{
			$this->data['category'] = $this->library_model->select("hoa_resource_category",array("id"=>$id));
		}
		$this->data['community'] = $this->library_model->select_multiple("hoa_community",array("status"=>0));
		$this->layout->view('library/add_category','admin');
	}
	public function add_category()
	{
		$ins_data['cat_name'] = $this->input->post('name');
		$ins_data['cat_desc'] = $this->input->post('desc');
		$edit_id = $this->input->post('edit_id');
		if($_FILES['userfile']['name']!='')
		{
			$img = $this->do_upload();
			$ins_data['cat_img'] = $img['upload_data']['file_name'];
		}
		$ins_data['community'] = implode(",",$this->input->post('community'));
		$ins_data['created_by'] = $this->session->userdata('admin_data')['id'];
		if($edit_id!='')
		{
			$this->library_model->update("hoa_resource_category",$ins_data,array("id"=>$edit_id));
			$this->session->set_flashdata("library_add","Category updated successfully.",TRUE);
		}
		else
		{
			$this->library_model->insert("hoa_resource_category",$ins_data);
			$this->session->set_flashdata("library_add","Category added successfully.",TRUE);
		}
		redirect("library/manage_category");
	}
	public function create_document($id='')
	{
		$this->data['document'] = array("id"=>"","cat_name"=>"","cat_desc"=>"","community"=>"","cat_img"=>"");
		if($id!='')
		{
			$this->data['document'] = $this->library_model->select("hoa_resource_document",array("id"=>$id));
		}
		$this->data['category'] = $this->library_model->select_multiple("hoa_resource_category",array("status"=>1));
		$this->layout->view('library/add_document','admin');
	}
	public function add_documents()
	{
		$ins_data['title'] = $this->input->post('name');
		$ins_data['description'] = $this->input->post('desc');
		if($_FILES['userfile']['name']!='')
		{
			$img = $this->do_upload();
		  $ins_data['document'] = "assets/docs/".$img['upload_data']['file_name'];
		}
		$edit_id = $this->input->post('edit_id');
		$ins_data['category'] =$this->input->post('category');
		$ins_data['created_by'] = $this->session->userdata('admin_data')['id'];
		if($edit_id!='')
		{
			$this->library_model->update("hoa_resource_document",$ins_data,array("id"=>$edit_id));
			$this->session->set_flashdata("library_add","Document updated successfully.",TRUE);
		}
		else
		{
			$this->library_model->insert("hoa_resource_document",$ins_data);
			$this->session->set_flashdata("library_add","Document added successfully.",TRUE);
		}
		redirect("library/manage_documents");
	}
	public function do_upload()
  {
    $config['upload_path']          = '../assets/docs/';
    $config['allowed_types']        = 'pdf|docx|doc|xls|xlsx';
    $config['max_size']             = 1000000;
    //$config['max_width']            = 1024;
    //$config['max_height']           = 768;

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