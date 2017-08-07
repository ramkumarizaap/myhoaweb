<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Classifieds extends CI_Controller 
{
	public $data="";
	public $init_scripts  = array();
	function __construct()
	{
		parent::__construct();
		$this->load->model('classifieds_model');
		$id = $this->session->userdata('admin_data')['id'];
		$this->data['users'] = $this->classifieds_model->select("hoa_users",array("id"=>$id));

		if(!$this->session->userdata('admin_data')['id'])
			redirect('');
	}
	public function manage_classifieds()
	{
		$this->data['classifieds'] = $this->classifieds_model->get_classifieds(array("a.status"=>1));
		$this->layout->view("classifieds/manage_classifieds",'admin');
	}
	public function update_status($st,$id)
	{
		$up_data['status'] = $st;
		$this->classifieds_model->update("hoa_classifieds",$up_data,array("id"=>$id));
		redirect("classifieds/manage_classifieds");
	}
	public function add_classifieds($edit_id='')
	{
		$this->data['classifieds']=array("id"=>"","ad_name"=>"","description"=>"","photos"=>"","street1"=>"","street2"=>"","state"=>"","city"=>"","country"=>"","zipcode"=>"");
		if($edit_id!='')
		{
			$this->data['classifieds']=$this->classifieds_model->select("hoa_classifieds",array("id"=>$edit_id));
		}
		$this->layout->view("classifieds/add_classifieds",'admin');
	}
	public function create_classifieds()
	{
		$form = $this->input->post();
		$edit_id = $form['edit_id'];
		$ins_data['ad_name'] = $form['ad_name'];
		$ins_data['description'] = $form['desc'];
		$ins_data['street1'] = $form['street_1'];
		$ins_data['street2'] = $form['street_2'];
		$ins_data['city'] = $form['city'];
		$ins_data['state'] = $form['state'];
		$old_img = $form['old_img'];
		$ins_data['country'] = $form['country'];
		$ins_data['zipcode'] = $form['zipcode'];
		$img = $this->do_upload();
		
		foreach ($img as $key => $value)
		{
			$img['name'][] = $value['upload_data']['file_name'];
		}
		$ins_data['photos'] = trim(implode(",",$img['name']).",".$old_img,",");
		if($edit_id)
		{
			$insert = $this->classifieds_model->update("hoa_classifieds",$ins_data,array("id"=>$edit_id));
			$this->session->set_flashdata("classifieds_add","Classifieds updated successfully.",TRUE);
			redirect("classifieds/manage_classifieds");
		}
		else
		{
			$ins_data['status'] = 0;
			$ins_data['created_by'] = $this->session->userdata('admin_data')['id'];
			$insert = $this->classifieds_model->insert("hoa_classifieds",$ins_data);
			if($insert)
			{			
				$this->session->set_flashdata("classifieds_add","Classifieds added successfully.",TRUE);
			}
			else
			{
				$this->session->set_flashdata("classifieds_fail","Classifieds creation failed.",TRUE);
			}
			redirect("classifieds/manage_classifieds");
		}
	}
	public function del_row($id,$field,$table)
	{
		$this->classifieds_model->delete($table,array($field=>$id));
			$this->session->set_flashdata("community_add","Community deleted successfully from the system.",TRUE);
		redirect("classifieds/manage_classifieds");
	}
	public function delete_photo()
	{
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$get_photo = $this->classifieds_model->select("hoa_classifieds",array("id"=>$id));
		$arr = array($name.",",",".$name);
		$up_data['photos'] = str_replace($arr,"",$get_photo['photos']);
		$this->classifieds_model->update("hoa_classifieds",$up_data,array("id"=>$id));
	}
	public function do_upload()
  {
    $config['upload_path']          = '../assets/images/classifieds/';
    $config['allowed_types']        = 'gif|jpg|png';
    $config['max_size']             = 100000;
    //$config['max_width']            = 1024;
    //$config['max_height']           = 768;
	  $files = $_FILES; 
    $this->load->library('upload');
    $count = sizeof($_FILES['userfile']['tmp_name']);
    for ($i=0; $i < $count ; $i++)
    { 
    	$this->upload->initialize($config);
    	$_FILES['userfile']['name']= $files['userfile']['name'][$i];
      $_FILES['userfile']['type']= $files['userfile']['type'][$i];
      $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
      $_FILES['userfile']['error']= $files['userfile']['error'][$i];
      $_FILES['userfile']['size']= $files['userfile']['size'][$i];
	    if (!$this->upload->do_upload('userfile'))
	    {
	     $error = array("error"=>$this->upload->display_errors());
	    }
	    else
	    {
	       $data[] = array("upload_data"=>$this->upload->data());
	    }
    }
   	return $data;
  }
}
?>