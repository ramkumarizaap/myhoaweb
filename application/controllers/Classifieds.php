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
		if(!$this->session->userdata('login_data')['id'])
			redirect('');
	}
	public function index()
	{
		$where="";
		if(isset($_POST['search']))
		{
			$where = $_POST['search'];
		}
		$this->data['classifieds'] = $this->classifieds_model->get_classifieds($where);
		$this->layout->view("classifieds/home","frontend");
	}
	public function create_classifieds()
	{
		$this->layout->view("classifieds/create","frontend");
	}
	public function add_classifieds()
	{
		$this->form_validation->set_rules("ad_name","Ad Name","trim|required");
		$this->form_validation->set_rules("desc","Description","trim|required");
		//$this->form_validation->set_rules("userfile","Photos","trim|required");
		$this->form_validation->set_rules("street1","Street 1","trim|required");
		$this->form_validation->set_rules("city","City","trim|required");
		$this->form_validation->set_rules("state","State","trim|required|max_length[2]");
		$this->form_validation->set_rules("country","Country","trim|required|max_length[2]");
		$this->form_validation->set_rules("zipcode","Zipcode","trim|required|numeric|max_length[6]");
		if($this->form_validation->run()==FALSE)
		{
			$this->layout->view("classifieds/create","frontend");
		}
		else
		{
			$form = $this->input->post();
			$ins_data['user_id'] = $this->session->userdata('login_data')['id'];
			$ins_data['ad_name'] = $form['ad_name'];
			$ins_data['description'] = $form['desc'];
			$ins_data['street1'] = $form['street1'];
			$ins_data['street2'] = $form['street2'];
			$ins_data['city'] = $form['city'];
			$ins_data['state'] = $form['state'];
			$ins_data['country'] = $form['country'];
			$ins_data['zipcode'] = $form['zipcode'];
			$img = $this->do_upload();
			$address=$form['street1'].$form['street2'].$form['city'].$form['state'].$form['country'].$form['zipcode'];
 		  $formattedAddr = str_replace(' ','+',$address);
      //Send request and receive json data by address
      $geocodeFromAddr = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddr.'&sensor=false'); 
      $output = json_decode($geocodeFromAddr);
        //Get latitude and longitute from json data
      $ins_data['latitude']  = $output->results[0]->geometry->location->lat; 
      $ins_data['longitude'] = $output->results[0]->geometry->location->lng;

			foreach ($img as $key => $value)
			{
				$img['name'][] = $value['upload_data']['file_name'];
			}
			$ins_data['photos'] = implode(",",$img['name']);
			$this->classifieds_model->insert("hoa_classifieds",$ins_data);
			$this->session->set_flashdata('class_succ',TRUE);
			redirect("classifieds");
		}
	}
	public function do_upload()
  {
    $config['upload_path']          = './assets/images/classifieds/';
    $config['allowed_types']        = 'gif|jpg|png';
    $config['max_size']             = 100;
    $config['max_width']            = 1024;
    $config['max_height']           = 768;
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
  public function view($id)
  {
  	$this->data['classifieds'] = $this->classifieds_model->select($id);
  	$this->load->library('googlemaps');
		$latitude = $this->data['classifieds']['latitude'];
		$longitude = $this->data['classifieds']['longitude'];	
		$config['center'] = $latitude.", ".$longitude;
		$config['zoom'] = '10';
		$this->googlemaps->initialize($config);
		$marker = array();
		$marker['animation'] = 'DROP';
		$marker['infowindow_content'] = $this->data['classifieds']['ad_name'];
		$marker['position'] = $latitude.", ".$longitude;
		$this->googlemaps->add_marker($marker);
		$this->data['map'] = $this->googlemaps->create_map();
  	$this->layout->view('classifieds/view','frontend');
  }
  public function contact_advertiser()
  {
  	$from = $this->input->post('from');
  	$to = $this->input->post('to');
  	$msg = $this->input->post('desc');
  	$this->load->library('email');
  	$this->email->setFrom($from);
		$this->email->to($to);
		$this->email->set_mailtype("html");
		$this->email->message($msg);
		$this->email->subject("Classifieds Contact");
		if($this->email->send())
  		echo "Success";
  	else
  		echo "Fail";
  }
}
?>