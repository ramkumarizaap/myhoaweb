<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoices extends CI_Controller 
{
	public $data="";
	public $init_scripts  = array();
	function __construct()
	{
		parent::__construct();
		$this->load->model('invoices_model');
		if(!$this->session->userdata('login_data')['id'])
			redirect('');
	}
	public function index()
	{
		$this->layout->view('invoices/home');
	}
	public function create()
	{
		$this->data['community'] = $this->invoices_model->get_community();
		$this->layout->view('invoices/add_invoice','frontend');
	}
	public function get_users()
	{
		$id = $this->input->post('val');
		$where = array("code"=>$id);
		$this->data['com_user'] = $this->invoices_model->get_users($where);
		$this->load->view('invoices/refine_result',$this->data);
	}
	public function add_invoice()
	{
		$form = $this->input->post();
		$user_id = $form['user_id'];
		$item = $form['item_id'];
		for ($i=0; $i <count($user_id) ; $i++) 
		{ 
			$ins_data['from_date'] = $form['from_date'];
			$ins_data['to_date'] = $form['from_date'];
			$ins_data['status'] = $form['invoice_status'];
			$ins_data['user_id'] = $i;
			$ins_data['description'] = $form['description'];
			$ins_data['total'] = $form['grand_total'][0];
			$ins_data['total'] = $form['discount'][0];
			for ($j=0; $j < count($item); $j++) 
			{ 
				$ins_data1['invoice_id'] = 1;
				$ins_data1['item_id'] = $form['item_id'][$j];
				$ins_data1['item_name'] = $form['item_name'][$j];
				$ins_data1['qty'] = $form['qty'][$j];
				$ins_data1['price'] = $form['price'][$j];
				$ins_data1['tax'] = $form['tax'][$j];
				$ins_data1['item_total'] = $form['item_total'][$j];

			}
		}

	}
}
?>