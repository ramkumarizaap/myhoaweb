<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller 
{
	public $data="";
	public $init_scripts  = array();
	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$id = $this->session->userdata('admin_data')['id'];
		$this->data['users'] = $this->user_model->select("hoa_users",array("id"=>$id));

		if(!$this->session->userdata('admin_data')['id'])
			redirect('');
	}
	public function manage_user()
	{
		$this->data['all_users'] = $this->user_model->select_multiple("hoa_users",array("usertype!="=>0,"published"=>1));
		$this->layout->view("user/manage_user",'admin');
	}
	public function update_status($st,$id)
	{
		$up_data['published'] = $st;
		$this->user_model->update("hoa_users",$up_data,array("id"=>$id));
		if($st==0)
			redirect("user/manage_user");
		else
			redirect("user/inactive_user");
	}
	public function inactive_user()
	{
		$this->data['all_users'] = $this->user_model->select_multiple("hoa_users",array("usertype!="=>0,"published"=>0));
		$this->layout->view("user/inactive_user",'admin');
	}
	public function add_user($edit_id='')
	{
		$this->data['user']=array("id"=>"","firstname"=>"","lastname"=>"","email"=>"","username"=>"","password"=>"","community"=>"","usertype"=>"","code"=>"","mobile"=>"","phone"=>"","about_me"=>"");
		if($edit_id!='')
		{
			$this->data['user']=$this->user_model->select("hoa_users",array("id"=>$edit_id));
		}
		$this->data['usertype'] = $this->user_model->select_multiple("hoa_account_type",array("status"=>0));
		$this->data['community'] = $this->user_model->select_multiple("hoa_community",array("status"=>0));
		$this->layout->view("user/add_user",'admin');
	}
	public function create_user()
	{
		$form = $this->input->post();
		$edit_id = $form['edit_id'];
		$ins_data['firstname'] = $form['firstname'];
		$ins_data['lastname'] = $form['lastname'];
		$ins_data['username'] = $form['username'];
		$ins_data['email'] = $form['email'];
		$ins_data['password'] = $form['password'];
		$ins_data['usertype'] = $form['usertype'];
		$ins_data['code'] = $form['community'];
		$ins_data['mobile'] = $form['mobile'];
		$ins_data['phone'] = $form['phone'];
		$ins_data['about_me'] = $form['about_me'];
		$ins_data['photo'] = "assets/images/profile/user.png";
		if($edit_id)
		{
			$insert = $this->user_model->update("hoa_users",$ins_data,array("id"=>$edit_id));
			$this->session->set_flashdata("user_add","User updated successfully.",TRUE);
			redirect("user/manage_user");
		}
		else
		{
			$ins_data['published'] = 0;
			$insert = $this->user_model->insert("hoa_users",$ins_data);
			if($insert)
			{
				$message = "Hi ".$form['firstname'].",<br>&nbsp;&nbsp;&nbsp;
											Thanks for registering with us.
											Please click the link to activate your account.<br><br>
											<a href='http://localhost/myhoaweb/user/activate_user/".$insert."' style='padding:10px;background:#193670;color:white;text-decoration:none;' >Click Here to Activate</a><br><br><br><br>Thanks,<br>ramHOA Staff";		
				
				$this->session->set_flashdata("user_add","User added successfully. Activation mail has been sent to registered email.",TRUE);
				/*$this->load->library('email');
				$this->email->setFrom("ramHOA","sramkumareng@gmail.com");
				$this->email->to($mail);
				$this->email->isHTML(true);
				$this->email->message($message);
				$this->email->send();*/
			}
			else
			{
				$this->session->set_flashdata("user_fail","User creation failed.",TRUE);
			}
			redirect("user/manage_user");
		}
	}
	public function del_row($id,$field,$table)
	{
		$this->user_model->delete($table,array($field=>$id));
			$this->session->set_flashdata("user_add","User deleted successfully from the system.",TRUE);
		redirect("user/manage_user");
	}
}
?>