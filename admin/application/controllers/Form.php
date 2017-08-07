<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Form extends CI_Controller 
{
	public $data="";
	public $init_scripts  = array();
	function __construct()
	{
		parent::__construct();
		$this->load->model('form_model');
		$id = $this->session->userdata('admin_data')['id'];
		$this->data['users'] = $this->form_model->select("hoa_users",array("id"=>$id));

		if(!$this->session->userdata('admin_data')['id'])
			redirect('');
	}
	public function manage_form()
	{
		$this->data['forms'] = $this->form_model->get_forms();
		$this->layout->view("form/manage_form",'admin');
	}
	public function update_status($st,$id)
	{
		$up_data['status'] = $st;
		$this->form_model->update("hoa_events",$up_data,array("id"=>$id));
		redirect("events/manage_events");
	}
	public function add_form($edit_id='')
	{
		$this->data['form']=array("id"=>"","form_name"=>"","community"=>"");
		if($edit_id!='')
		{
			$this->data['form']=$this->form_model->select("hoa_form",array("id"=>$edit_id));
		}
		$this->data['community'] = $this->form_model->select_multiple("hoa_community");
		$this->layout->view("form/add_form",'admin');
	}
	public function create_form()
	{
		$form = $this->input->post();
		$edit_id = $form['edit_id'];
		$ins_data['form_name'] = $form['name'];
		$ins_data['user_id'] = $this->session->userdata('admin_data')['id'];
		$ins_data['community_id'] = implode(",",$form['community']);
		$id = $this->form_model->insert("hoa_form",$ins_data);
		redirect("form/add_form/$id");
	}
	public function add_input()
	{
		$form = $this->input->post();
    $edit_id = isset($form['edit_id']) ? $form['edit_id'] : "";
    $ins['form_id'] = $form['form_id'];
    $ins['label'] = $form['label'];
    $ins['type'] = $form['type'];
    if(isset($form['select_ip']) && $form['select_ip'][0]!='')
      $ins['options'] = implode(",",$form['select_ip']);
    if($form['type']=="payment-field")
    {
    	if(isset($form['amount']) && $form['amount']!='')
      	$ins['amount'] = $form['amount'];
    }
    $ins['required'] = isset($form['required']) ? $form['required'] : "off";
    $ins_data['form_id'] = $form['form_id'];
    $ins_data['field'] = json_encode($ins);
    if($edit_id=="")
    {
      $ins_data['sort'] = "1";
      $field = $this->form_model->insert("hoa_form_fields",$ins_data);
    }
    else
      $field = $this->form_model->update("hoa_form_fields",$ins_data,array("id"=>$edit_id));
    redirect("form/add_form/".$form['form_id']);
	}
	 public function remove_field()
  {
      $id = $this->input->post('id');
      $this->form_model->delete("hoa_form_fields",array("id"=>$id));
  }
	public function del_row($id,$field,$table)
	{
		$this->form_model->delete($table,array($field=>$id));
			$this->session->set_flashdata("community_add","Community deleted successfully from the system.",TRUE);
		redirect("form/manage_form");
	}
	public function sort()
  {
    $field_id = $this->input->post("field_id");
    $sort   = $this->input->post("sort");
    $up_data['sort'] = $sort;
    $this->form_model->update("hoa_form_fields",$up_data,array("id"=>$field_id));
  }
   public function get_field()
  {
    $id = $this->input->post('id');
    $res = $this->form_model->select("hoa_form_fields",array("id"=>$id));
    echo json_encode($res);
  }
   public function view_form($id)
  {
    $this->data['form_id'] = $id;
    $this->load->view("form/view_form",$this->data);
  }
public function do_upload()
  {
    $config['upload_path']          = '../assets/images/';
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
  public function form_action()
  {
    $data=[];
    if(isset($_POST['input']))
    {
      foreach ($_POST['input'] as $key => $value)
      {
        foreach ($value as $label => $ans) 
        {
          if($key=="check-field")
            $ans = implode(",",$ans);

          $data[str_replace("_"," ",$label)]=$ans;
          if($key=="file-field")
          {
            $img = $this->do_upload();
            $data[str_replace("_"," ",$label)] = $img['upload_data']['file_name'];
          }
        }
      }
    }
    if(isset($_POST['personal_info']))
    {
      $data['Title'] = "Personal Info";
      $data['Firstname'] = $_POST['firstname'];
      $data['Lastname'] = $_POST['lastname'];
      $data['Email-ID'] = $_POST['email'];
      $data['Age'] = $_POST['age'];
    }

    $ins_data['data'] = json_encode($data);
    $ins_data['form_id'] = $_POST['form_id'];
    if(isset($_POST['payment_info']))
    {
      $c_number = $_POST['card_number'];
      $cvv = $_POST['cvv'];
      $pay_to = $_POST['pay_to'];
      $amount = $_POST['amount'];
      $exp_month = $_POST['exp_month'];
      $exp_year = $_POST['exp_year'];
      $result = $this->paypal($_POST);
      $ins_data1['form_id'] = $_POST['form_id'];
      $ins_data1['user_id'] = $_SESSION['login_data']['id'];
      $ins_data1['pay_to'] = $pay_to;
      $ins_data1['amount'] = $amount;
      $ins_data1['trans_id'] = "";
      $ins_data1['status'] = "Pending";
      $data['PayTo'] = $pay_to;
      $data['Amount'] = "$".$amount;
      $data['TransID'] = "";
      $data['Status'] = "Pending";
      $ins_data['data'] = json_encode($data);
      $form_data = $this->form_model->insert("hoa_form_data",$ins_data);
      $form_data = $this->form_model->insert("hoa_form_payment",$ins_data1);
    }
    else
      $form_data = $this->form_model->insert("hoa_form_data",$ins_data);

    $this->session->set_flashdata("form_succ",TRUE);
    redirect("form/view_form/".$_POST['form_id']);
  }
  public function list_enteries($id)
  {
    $this->data['form'] = $this->form_model->select("hoa_form",array("id"=>$id));
    $this->data['values'] = $this->form_model->select_multiple("hoa_form_data",array("form_id"=>$id));
    $this->layout->view("form/list","admin");
  }
  public function export($id)
  {
    $data=$this->form_model->select_multiple("hoa_form_data",array("form_id"=>$id));
    header('Content-type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename=exp-'.date("Y-m-d").'.xlsx');
    echo "<table style='width:1200px'>
            <thead>";
              foreach ($data as $key => $value) 
              {
                foreach (json_decode($value['data']) as $label => $value) 
                {
                  echo "<th style='width:400px;'>".$label."</th>";
                }
               break;
              }
    echo   "</thead>
            <tbody>";
             foreach ($data as $key => $value) 
              {
                echo "<tr>";
                foreach (json_decode($value['data']) as $label => $value) 
                {
                   echo "<td style='width:400px;'>".$value."</td>";
                }
                echo "</tr>";
              }
    echo    "</tbody>
            </table>";
   

  }
}
?>