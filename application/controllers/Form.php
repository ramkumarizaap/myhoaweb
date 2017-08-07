<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Controller 
{
	public $data="";
	public $init_scripts  = array();
  function __construct()
  {
    parent::__construct();
    $this->load->model("form_model");
    if(!$this->session->userdata('login_data')['id'])
      redirect('');
    $config = array(
      'Sandbox' => $this->config->item('Sandbox'),      // Sandbox / testing mode option.
      'APIUsername' => $this->config->item('APIUsername'),  // PayPal API username of the API caller
      'APIPassword' => $this->config->item('APIPassword'),  // PayPal API password of the API caller
      'APISignature' => $this->config->item('APISignature'),  // PayPal API signature of the API caller
      'APISubject' => '',                   // PayPal API subject (email address of 3rd party user that has granted API permission for your app)
      'APIVersion' => $this->config->item('APIVersion')   // API version you'd like to use for your call.  You can set a default version in the class and leave this blank if you want.
    );
    if($config['Sandbox'])
    {
      error_reporting(E_ALL);
      ini_set('display_errors', '1');
    }
    $this->load->library('Paypal_pro', $config); 
  }
  public function index()
  {
      $this->data['forms'] = $this->form_model->select_multiple("hoa_form");
  	$this->layout->view("form/home","frontend");
  }
  public function create()
  {
  	$name = $this->input->post('form_name');
  	$ins['form_name'] = $name;
  	$ins['user_id'] = $this->session->userdata('login_data')['id'];
  	$form_id = $this->form_model->insert("hoa_form",$ins);
  	redirect("form/home/$form_id");
  }
  public function home($form_id)
  {
      $this->data['fields'] = $this->form_model->select_multiple("hoa_form_fields",array("form_id"=>$form_id),"asc");
  	$this->data['form_id'] = $form_id;
  	$this->layout->view("form/create","frontend");
  }
  public function add_input()
  {
    $form = $this->input->post();
    $edit_id = isset($form['edit_id']) ? $form['edit_id'] : "";
    $ins['form_id'] = $form['form_id'];
    $ins['label'] = $form['label'];
    $ins['width'] = $form['width'];
    $ins['type'] = $form['type'];
    if(isset($form['select_ip']) && $form['select_ip']!='')
        $ins['options'] = implode(",",$form['select_ip']);
     if(isset($form['amount']) && $form['amount']!='')
        $ins['amount'] = $form['amount'];
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
    redirect("form/home/".$form['form_id']);
  }
  public function remove_field()
  {
      $id = $this->input->post('id');
      $this->form_model->delete("hoa_form_fields",array("id"=>$id));
  }
  public function del_form()
  {
      $id = $this->input->post('id');
      $this->form_model->delete("hoa_form",array("id"=>$id));
      $this->form_model->delete("hoa_form_fields",array("form_id"=>$id));
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
    $this->load->view("form/view",$this->data);
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
  public function do_upload()
  {
    $config['upload_path']          = './assets/images/';
    $config['allowed_types']        = 'gif|jpg|png';
    $config['max_size']             = 100;
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
  public function list_enteries($id)
  {
    $this->data['form'] = $this->form_model->select("hoa_form",array("id"=>$id));
    $this->data['values'] = $this->form_model->select_multiple("hoa_form_data",array("form_id"=>$id));
    $this->layout->view("form/list","frontend");
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

  function paypal()
  {
    $DPFields = array(
              'paymentaction' => 'Sale',            // How you want to obtain payment.  Authorization indidicates the payment is a basic auth subject to settlement with Auth & Capture.  Sale indicates that this is a final sale for which you are requesting payment.  Default is Sale.
              'ipaddress' => $_SERVER['REMOTE_ADDR'],               // Required.  IP address of the payer's browser.
              'returnfmfdetails' => '1'           // Flag to determine whether you want the results returned by FMF.  1 or 0.  Default is 0.
            );
            
    $CCDetails = array(
              'creditcardtype' => 'MasterCard',           // Required. Type of credit card.  Visa, MasterCard, Discover, Amex, Maestro, Solo.  If Maestro or Solo, the currency code must be GBP.  In addition, either start date or issue number must be specified.
              'acct' => $_POST['card_number'],                 // Required.  Credit card number.  No spaces or punctuation.  
              'expdate' => $_POST['exp_month'].$_POST['exp_year'],              // Required.  Credit card expiration date.  Format is MMYYYY
              'cvv2' => $_POST['cvv'],                // Requirements determined by your PayPal account settings.  Security digits for credit card.
              'startdate' => '',              // Month and year that Maestro or Solo card was issued.  MMYYYY
              'issuenumber' => ''             // Issue number of Maestro or Solo card.  Two numeric digits max.
            );
            
    $PayerInfo = array(
              'email' => $_POST['email'],                 // Email address of payer.
              'payerid' => '',              // Unique PayPal customer ID for payer.
              'payerstatus' => '',            // Status of payer.  Values are verified or unverified
             // 'business' => 'Testers, LLC'              // Payer's business name.
            );
            
    $PayerName = array(
              'salutation' => 'Mr.',            // Payer's salutation.  20 char max.
              'firstname' => $_POST['firstname'],              // Payer's first name.  25 char max.
              'middlename' => '',             // Payer's middle name.  25 char max.
              'lastname' => $_POST['lastname'],              // Payer's last name.  25 char max.
              'suffix' => ''                // Payer's suffix.  12 char max.
            );
            
    $BillingAddress = array(
                'street' => '123 Test Ave.',            // Required.  First street address.
                'street2' => '',            // Second street address.
                'city' => 'Kansas City',              // Required.  Name of City.
                'state' => 'MO',              // Required. Name of State or Province.
                'countrycode' => 'US',          // Required.  Country code.
                'zip' => '64111',               // Required.  Postal code of payer.
                'phonenum' => '555-555-5555'            // Phone Number of payer.  20 char max.
              );
              
    $ShippingAddress = array(
                'shiptoname' => 'Tester Testerson',           // Required if shipping is included.  Person's name associated with this address.  32 char max.
                'shiptostreet' => '123 Test Ave.',          // Required if shipping is included.  First street address.  100 char max.
                'shiptostreet2' => '',          // Second street address.  100 char max.
                'shiptocity' => 'Kansas City',          // Required if shipping is included.  Name of city.  40 char max.
                'shiptostate' => 'MO',          // Required if shipping is included.  Name of state or province.  40 char max.
                'shiptozip' => '64111',             // Required if shipping is included.  Postal code of shipping address.  20 char max.
                'shiptocountry' => 'US',          // Required if shipping is included.  Country code of shipping address.  2 char max.
                'shiptophonenum' => '555-555-5555'          // Phone number for shipping address.  20 char max.
                );
              
    $PaymentDetails = array(
                'amt' => $_POST['amount'],              // Required.  Total amount of order, including shipping, handling, and tax.  
                'currencycode' => 'USD',          // Required.  Three-letter currency code.  Default is USD.
                'itemamt' => $_POST['amount'],             // Required if you include itemized cart details. (L_AMTn, etc.)  Subtotal of items not including S&H, or tax.
                'shippingamt' => '0.00',          // Total shipping costs for the order.  If you specify shippingamt, you must also specify itemamt.
                'shipdiscamt' => '',          // Shipping discount for the order, specified as a negative number.  
                'handlingamt' => '',          // Total handling costs for the order.  If you specify handlingamt, you must also specify itemamt.
                'taxamt' => '',             // Required if you specify itemized cart tax details. Sum of tax for all items on the order.  Total sales tax. 
                'desc' => $_POST['pay_to'],              // Description of the order the customer is purchasing.  127 char max.
                'custom' => '',             // Free-form field for your own use.  256 char max.
                'invnum' => '',             // Your own invoice or tracking number
                'notifyurl' => ''           // URL for receiving Instant Payment Notifications.  This overrides what your profile is set to use.
              );  
        
    $OrderItems = array();
    $Item  = array(
              'l_name' => $_POST['pay_to'],            // Item Name.  127 char max.
              'l_desc' => $_POST['pay_to'],            // Item description.  127 char max.
              'l_amt' => $_POST['amount'],               // Cost of individual item.
              'l_number' => '123',            // Item Number.  127 char max.
              'l_qty' => '1',               // Item quantity.  Must be any positive integer.  
              'l_taxamt' => '',             // Item's sales tax amount.
              'l_ebayitemnumber' => '',         // eBay auction number of item.
              'l_ebayitemauctiontxnid' => '',     // eBay transaction ID of purchased item.
              'l_ebayitemorderid' => ''         // eBay order ID for the item.
          );
    array_push($OrderItems, $Item);
    
    $Secure3D = array(
              'authstatus3d' => '', 
              'mpivendor3ds' => '', 
              'cavv' => '', 
              'eci3ds' => '', 
              'xid' => ''
              );
              
    $PayPalRequestData = array(
                'DPFields' => $DPFields, 
                'CCDetails' => $CCDetails, 
                'PayerInfo' => $PayerInfo, 
                'PayerName' => $PayerName, 
                'BillingAddress' => $BillingAddress, 
                'ShippingAddress' => $ShippingAddress, 
                'PaymentDetails' => $PaymentDetails, 
                'OrderItems' => $OrderItems, 
                'Secure3D' => $Secure3D
              );
              
    $PayPalResult = $this->paypal_pro->DoDirectPayment($PayPalRequestData);
    
    if(!$this->paypal_pro->APICallSuccessful($PayPalResult['ACK']))
    {
      $errors = array('Errors'=>$PayPalResult['ERRORS']);
      //$this->load->view('paypal/samples/error',$errors);
      return $errors;
    }
    else
    {
      // Successful call.  Load view or whatever you need to do here.
      $data = array('PayPalResult'=>$PayPalResult);
      return $data;
      //$this->load->view('paypal/samples/do_direct_payment',$data);
    }
  }
}
?>