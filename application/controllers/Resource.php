<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resource extends CI_Controller 
{
	public $data="";
	public $init_scripts  = array();
	function __construct()
	{
		parent::__construct();
		$this->load->model('resource_model');
	}
	public function index()
	{
		$id = $this->session->userdata('login_data')['code'];
		$this->data['category'] = $this->resource_model->get_community("hoa_resource_category",array("community"=>$id));
		$this->layout->view('resource/index','frontend');
	}
	public function category()
	{
		$id = $this->session->userdata('login_data')['id'];
		$this->data['community'] = $this->resource_model->get_community("hoa_community",array("created_by"=>$id));
		$this->layout->view('resource/add_category','frontend');
	}
	public function add_category()
	{
		$this->form_validation->set_rules("cat_name","Category Name","trim|required|alpha|max_length[20]|min_length[3]");
		$this->form_validation->set_rules("cat_img","Category Image","trim|required");
		$this->form_validation->set_rules("cat_desc","Category Description","trim|required");
		$this->form_validation->set_rules("community[]","Community","trim|required");
		if($this->form_validation->run()==FALSE)
		{
			$id = $this->session->userdata('login_data')['id'];
			$this->data['community'] = $this->resource_model->get_community("hoa_community",array("created_by"=>$id));
			$this->layout->view('resource/add_category','frontend');
		}
		else
		{
			$form = $this->input->post();
			$ins_data['cat_name'] = $form['cat_name'];
			$ins_data['cat_img'] = "assets/images/".$form['cat_img'];
			$ins_data['cat_desc'] = $form['cat_desc'];
			$ins_data['created_by'] = $this->session->userdata('login_data')['id'];
			$ins_data['community'] = implode(",",$form['community']);
			$this->resource_model->insert("hoa_resource_category",$ins_data);
			redirect("resource/list_category");
		}
	}
	public function library($name,$doc_id)
	{
		$id = $this->session->userdata('login_data')['id'];
		$this->data['category'] = $name;
		$this->data['documents'] = $this->resource_model->get_documents(array("a.category"=>$doc_id));
		$this->layout->view("resource/library",'frontend');
	}
	public function list_category()
	{
		$id = $this->session->userdata('login_data')['id'];
		$this->data['category'] = $this->resource_model->get_community("hoa_resource_category",array("created_by"=>$id));
		$this->layout->view("resource/list_category","frontend");
	}
	public function delete_category($id)
	{
		$this->resource_model->delete("hoa_resource_category",array("id"=>$id));
		$this->session->set_flashdata("del_cat",TRUE);
		redirect("resource/list_category");
	}
	public function document()
	{
		$id = $this->session->userdata('login_data')['id'];
		$this->data['category'] = $this->resource_model->select("hoa_resource_category",array("created_by"=>$id));
		$this->layout->view("resource/add_document","frontend");
	}
	public function add_document()
	{
		$this->form_validation->set_rules("title","Title","trim|required|alpha|max_length[20]|min_length[3]");
		$this->form_validation->set_rules("document","Document","trim|required");
		$this->form_validation->set_rules("description","Description","trim|required");
		$this->form_validation->set_rules("category","Category","trim|required");
		if($this->form_validation->run()==FALSE)
		{
			$id = $this->session->userdata('login_data')['id'];
			$this->data['category'] = $this->resource_model->select("hoa_resource_category",array("created_by"=>$id));
			$this->layout->view('resource/add_document','frontend');
		}
		else
		{
			$form = $this->input->post();
			$ins_data['title'] = $form['title'];
			$ins_data['document'] = "assets/docs/".$form['document'];
			$ins_data['description'] = $form['description'];
			$ins_data['created_by'] = $this->session->userdata('login_data')['id'];
			$ins_data['category'] = $form['category'];
			$this->resource_model->insert("hoa_resource_document",$ins_data);
			redirect("resource/list_document");
		}
	}
	public function list_document()
	{
		$id = $this->session->userdata('login_data')['id'];
		$this->data['document'] = $this->resource_model->get_documents(array("a.created_by"=>$id));
		$this->layout->view("resource/list_document","frontend");
	}
	public function delete_document($id)
	{
		$this->resource_model->delete("hoa_resource_document",array("id"=>$id));
		$this->session->set_flashdata("del_cat",TRUE);
		redirect("resource/list_document");
	}
	public function libraries($title,$doc_id)
	{
		$this->data['title'] = $title;
		$this->data['documents'] = $this->resource_model->get_documents(array("a.id"=>$doc_id));
		$this->layout->view('resource/document_list','frontend');
	}
	public function download($id)
	{
		ob_clean();
		$data = $this->resource_model->get_documents(array("a.id"=>$id));
		$path = $data[0]['document'];
		$name = explode("/",$path);
		$pth    =   file_get_contents(base_url().$path);
		$nme    =   $name[2];
		force_download($nme, $pth);   
	}
}
?>