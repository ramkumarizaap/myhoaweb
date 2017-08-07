<?php 
function get_user($id)
{
	$CI= &get_instance();
	$CI->load->model("home_model");
	$result = $CI->home_model->select("hoa_users",array("id"=>$id));
	return $result;
}
function create_form($id)
{
	$CI= &get_instance();
	$CI->load->model("form_model");
	$result=$CI->form_model->select_multiple("hoa_form_fields",array("form_id"=>$id),"asc");
	foreach ($result as $key => $value) 
	{
		$json =  json_decode($value['field']);
		$type = $json->type;
		switch ($type) 
		{
			case 'title-field':
				echo "<li data-id='".$value['id']."' class='head-title'>
								<span class='ed_options'>
								 <a href='javascript:void(0);' data-target='#FormModal' class='edit_field' data-toggle='modal' data-id='".$value['id']."'>Edit</a> |
								  <a href='javascript:void(0);' class='rem_field' data-id='".$value['id']."'>Remove</a>
								</span>
								<center><h3>".$json->label."</h3></center>
							</li>";
				break;
				case 'input-field':
				echo "<li style='width:".$json->width."' data-id='".$value['id']."'>
								<span class='ed_options'>
									<a href='javascript:void(0);' data-target='#FormModal' class='edit_field' data-toggle='modal' data-id='".$value['id']."'>Edit</a> |
								  <a href='javascript:void(0);' class='rem_field' data-id='".$value['id']."'>Remove</a>
								</span>
								<div class='col-md-12'>
									<div class='form-group'>
										<label class='col-md-12 control-label'>".$json->label."</label>
										<div class='col-md-12'>
											<input type='text' class='form-control' 
											name='input[".$json->label."]'>
										</div>
									</div>
								</div>						
							</li>";
				break;
				case 'area-field':
				echo "<li data-id='".$value['id']."'>
								<span class='ed_options'>
									<a href='javascript:void(0);' data-target='#FormModal' class='edit_field' data-toggle='modal' data-id='".$value['id']."'>Edit</a> |
								  <a href='javascript:void(0);' class='rem_field' data-id='".$value['id']."'>Remove</a>
								</span>
								<div class='col-md-12'>
									<div class='form-group'>
										<label class='col-md-2 control-label'>".$json->label."</label>
										<div class='col-md-10'>
											<textarea class='form-control' rows='5'></textarea>
										</div>
									</div>
								</div>						
							</li>";
				break;
				case 'select-field':
				echo "<li data-id='".$value['id']."'>
								<span class='ed_options'>
									<a href='javascript:void(0);' data-target='#FormModal' class='edit_field' data-toggle='modal' data-id='".$value['id']."'>Edit</a> |
								  <a href='javascript:void(0);' class='rem_field' data-id='".$value['id']."'>Remove</a>
								</span>
								<div class='col-md-12'>
									<div class='form-group'>
										<label class='col-md-2 control-label'>".$json->label."</label>
										<div class='col-md-10'>
											<select class='form-control' rows='5'>";
											$option = explode(",",$json->options);
											foreach ($option as $id => $opt)
											{
												echo "<option value='".$opt."'>".$opt."</option>";
											}
				echo				"</select>
										</div>
									</div>
								</div>						
							</li>";
				break;
				case 'radio-field':
				echo "<li data-id='".$value['id']."'>
								<span class='ed_options'>
									<a href='javascript:void(0);' data-target='#FormModal' class='edit_field' data-toggle='modal' data-id='".$value['id']."'>Edit</a> |
								  <a href='javascript:void(0);' class='rem_field' data-id='".$value['id']."'>Remove</a>
								</span>
								<div class='col-md-12'>
									<div class='form-group'>
										<label class='col-md-2 control-label'>".$json->label."</label>
										<div class='col-md-10'>";
											$option = explode(",",$json->options);
											foreach ($option as $id => $opt)
											{
												echo "<input type='radio' value='".$opt."'>".$opt."&nbsp;&nbsp;&nbsp;";
											}
				echo				"</div>
									</div>
								</div>						
							</li>";
				break;
				case 'check-field':
				echo "<li data-id='".$value['id']."'>
								<span class='ed_options'>
									<a href='javascript:void(0);' data-target='#FormModal' class='edit_field' data-toggle='modal' data-id='".$value['id']."'>Edit</a> |
								  <a href='javascript:void(0);' class='rem_field' data-id='".$value['id']."'>Remove</a>
								</span>
								<div class='col-md-12'>
									<div class='form-group'>
										<label class='col-md-2 control-label'>".$json->label."</label>
										<div class='col-md-10'>";
											$option = explode(",",$json->options);
											foreach ($option as $id => $opt)
											{
												echo "<input type='checkbox' value='".$opt."'>".$opt."&nbsp;&nbsp;&nbsp;";
											}
				echo				"</div>
									</div>
								</div>						
							</li>";
				break;
				case 'password-field':
				echo "<li data-id='".$value['id']."'>
								<span class='ed_options'>
									<a href='javascript:void(0);' data-target='#FormModal' class='edit_field' data-toggle='modal' data-id='".$value['id']."'>Edit</a> |
								  <a href='javascript:void(0);' class='rem_field' data-id='".$value['id']."'>Remove</a>
								</span>
								<div class='col-md-12'>
									<div class='form-group'>
										<label class='col-md-2 control-label'>".$json->label."</label>
										<div class='col-md-10'>
											<input type='password' class='form-control'>
										</div>
									</div>
								</div>						
							</li>";
				break;
				case 'file-field':
				echo "<li data-id='".$value['id']."'>
								<span class='ed_options'>
									<a href='javascript:void(0);' data-target='#FormModal' class='edit_field' data-toggle='modal' data-id='".$value['id']."'>Edit</a> |
								  <a href='javascript:void(0);' class='rem_field' data-id='".$value['id']."'>Remove</a>
								</span>
								<div class='col-md-12'>
									<div class='form-group'>
										<label class='col-md-2 control-label'>".$json->label."</label>
										<div class='col-md-10'>
											<input type='file' class='form-control'>
										</div>
									</div>
								</div>						
							</li>";
				break;
				case 'submit-field':
				echo "<li data-id='".$value['id']."'>
								<span class='ed_options'>
									<a href='javascript:void(0);' data-target='#FormModal' class='edit_field' data-toggle='modal' data-id='".$value['id']."'>Edit</a> |
								  <a href='javascript:void(0);' class='rem_field' data-id='".$value['id']."'>Remove</a>
								</span>
								<div class='col-md-12'>
									<div class='form-group'>
										<div class='col-md-3 col-md-offset-4'>
											<input type='submit' class='btn white theme-blue form-control' value='".$json->label."'>
										</div>
									</div>
								</div>						
							</li>";
				break;
				case 'payment-field':
				echo "<li data-id='".$value['id']."'>
								<span class='ed_options'>
									<a href='javascript:void(0);' data-target='#FormModal' class='edit_field' data-toggle='modal' data-id='".$value['id']."'>Edit</a> |
								  <a href='javascript:void(0);' class='rem_field' data-id='".$value['id']."'>Remove</a>
								</span>
								<div class='col-md-12'>
									<h4><strong>".$json->label."</strong></h4>
									<label class='control-label'>Amount : $".$json->amount."</label>
									<br><br>
									<div class='form-group'>
										<label class='col-md-3 control-label'>Card Number</label>
										<div class='col-md-9'>
											<input type='text' class='form-control' maxlength='16'>
										</div>
									</div>
									<div class='form-group'>
										<label class='col-md-3 control-label'>CVV</label>
										<div class='col-md-9'>
											<input type='text' class='form-control' maxlength='3'>
										</div>
									</div>
									<div class='form-group'>
										<label class='col-md-3 control-label'>Expire Month</label>
										<div class='col-md-9'>
											<select class='form-control'>
												<option value='01'>01</option><option value='02'>02</option>
												<option value='03'>03</option><option value='04'>04</option>
												<option value='05'>05</option><option value='06'>06</option>
												<option value='07'>07</option><option value='08'>08</option>
												<option value='09'>09</option><option value='10'>10</option>
												<option value='11'>11</option><option value='12'>12</option>
											</select>
										</div>
									</div>
									<div class='form-group'>
										<label class='col-md-3 control-label'>Expire Month</label>
										<div class='col-md-9'>
											<select class='form-control'>";
											$year = date('Y');
											$year1 = date('Y',strtotime("+25 years"));
											for ($i=$year; $i < $year1; $i++) 
											{ 
											echo "<option value='".$i."'>".$i."</option>";
											}
						echo 			"</select>
										</div>
									</div>
								</div>						
							</li>";
				break;
				case 'personal-field':
				echo "<li data-id='".$value['id']."'>
								<span class='ed_options'>
									<a href='javascript:void(0);' data-target='#FormModal' class='edit_field' data-toggle='modal' data-id='".$value['id']."'>Edit</a> |
								  <a href='javascript:void(0);' class='rem_field' data-id='".$value['id']."'>Remove</a>
								</span>
								<div class='col-md-12'>
									<h4><strong>".$json->label."</strong></h4>
									<div class='form-group'>
										<label class='col-md-3 control-label'>First Name</label>
										<div class='col-md-9'>
											<input type='text' class='form-control' maxlength='16'>
										</div>
									</div>
									<div class='form-group'>
										<label class='col-md-3 control-label'>Last Name</label>
										<div class='col-md-9'>
											<input type='text' class='form-control' maxlength='3'>
										</div>
									</div>
									<div class='form-group'>
										<label class='col-md-3 control-label'>Email-ID</label>
										<div class='col-md-9'>
											<input type='email' class='form-control'>
										</div>
									</div>
									<div class='form-group'>
										<label class='col-md-3 control-label'>Age</label>
										<div class='col-md-9'>
											<input type='text' class='form-control' maxlength='3'>
										</div>
									</div>
								</div>						
							</li>";
				break;
			
			default:
				# code...
				break;
		}
	}
}
function showform($id)
{
	$CI= &get_instance();
	$CI->load->model("form_model");
	$result=$CI->form_model->select_multiple("hoa_form_fields",array("form_id"=>$id),"asc");
	foreach ($result as $key => $value) 
	{
		$json =  json_decode($value['field']);
		$type = $json->type;
		switch ($type) 
		{
			case 'title-field':
				echo "<li class='head-title'>
								<center><h3>".$json->label."</h3></center>
							</li>";
				break;
				case 'input-field':
				echo "<li style='width:".$json->width."'>
								<div class='col-md-12'>
									<div class='form-group'>
										<label class='col-md-12 control-label'>".$json->label."</label>
										<div class='col-md-12'>
											<input type='text' class='form-control' 
											name='input[".$json->type."][".str_replace(" ","_",$json->label)."]'>
										</div>
									</div>
								</div>						
							</li>";
				break;
				case 'area-field':
				echo "<li>
								<div class='col-md-12'>
									<div class='form-group'>
										<label class='col-md-2 control-label'>".$json->label."</label>
										<div class='col-md-10'>
											<textarea class='form-control' rows='10' 
											name='input[".$json->type."][".str_replace(" ","_",$json->label)."]'></textarea>
										</div>
									</div>
								</div>						
							</li>";
				break;
				case 'select-field':
				echo "<li>
								<div class='col-md-12'>
									<div class='form-group'>
										<label class='col-md-2 control-label'>".$json->label."</label>
										<div class='col-md-10'>
											<select class='form-control' rows='5' name='input[".$json->type."][".str_replace(" ","_",$json->label)."]'>";
											$option = explode(",",$json->options);
											foreach ($option as $id => $opt)
											{
												echo "<option value='".$opt."'>".$opt."</option>";
											}
				echo				"</select>
										</div>
									</div>
								</div>						
							</li>";
				break;
				case 'radio-field':
				echo "<li>
								<div class='col-md-12'>
									<div class='form-group'>
										<label class='col-md-2 control-label'>".$json->label."</label>
										<div class='col-md-10'>";
											$option = explode(",",$json->options);
											foreach ($option as $id => $opt)
											{
												echo "<input type='radio' name='input[".$json->type."][".str_replace(" ","_",$json->label)."]' value='".$opt."'>".$opt."&nbsp;&nbsp;&nbsp;";
											}
				echo				"</div>
									</div>
								</div>						
							</li>";
				break;
				case 'check-field':
				echo "<li>
								<div class='col-md-12'>
									<div class='form-group'>
										<label class='col-md-2 control-label'>".$json->label."</label>
										<div class='col-md-10'>";
											$option = explode(",",$json->options);
											foreach ($option as $id => $opt)
											{
												echo "<input type='checkbox' name='input[".$json->type."][".str_replace(" ","_",$json->label)."][]' value='".$opt."'>".$opt."&nbsp;&nbsp;&nbsp;";
											}
				echo				"</div>
									</div>
								</div>						
							</li>";
				break;
				case 'password-field':
				echo "<li>
								<div class='col-md-12'>
									<div class='form-group'>
										<label class='col-md-2 control-label'>".$json->label."</label>
										<div class='col-md-10'>
											<input type='password' name='input[".$json->type."][".str_replace(" ","_",$json->label)."]' class='form-control'>
										</div>
									</div>
								</div>						
							</li>";
				break;
				case 'file-field':
				echo "<li>
								<div class='col-md-12'>
									<div class='form-group'>
										<label class='col-md-2 control-label'>".$json->label."</label>
										<div class='col-md-10'>
										<input type='file' name='userfile' class='form-control'>
											<input type='hidden' name='input[".$json->type."][".str_replace(" ","_",$json->label)."]' class='form-control'>
										</div>
									</div>
								</div>						
							</li>";
				break;
				case 'submit-field':
				echo "<li>
								<div class='col-md-12'>
									<div class='form-group'>
										<div class='col-md-3 col-md-offset-4'>
											<input type='submit'  class='btn white theme-blue form-control' value='".$json->label."'>
										</div>
									</div>
								</div>						
							</li>";
				break;
				case 'payment-field':
				echo "<li>
								<div class='col-md-12'>
									<input type='hidden' name='payment_info' value='1'>
									<input type='hidden' name='pay_to' value='".$json->label."'>
									<input type='hidden' name='amount' value='".$json->amount."'>
									<h4><strong>".$json->label."</strong></h4>
									<label class='control-label'>Amount : $".$json->amount."</label>
									<div class='form-group'>
										<label class='col-md-3 control-label'>Card Number</label>
										<div class='col-md-9'>
											<input type='text' class='form-control' maxlength='16'
												name='card_number'>
										</div>
									</div>
									<div class='form-group'>
										<label class='col-md-3 control-label'>CVV</label>
										<div class='col-md-9'>
											<input type='text' class='form-control' maxlength='3'
											 name='cvv'>
										</div>
									</div>
									<div class='form-group'>
										<label class='col-md-3 control-label'>Expire Month</label>
										<div class='col-md-9'>
											<select class='form-control' name='exp_month'>
												<option value='01'>01</option><option value='02'>02</option>
												<option value='03'>03</option><option value='04'>04</option>
												<option value='05'>05</option><option value='06'>06</option>
												<option value='07'>07</option><option value='08'>08</option>
												<option value='09'>09</option><option value='10'>10</option>
												<option value='11'>11</option><option value='12'>12</option>
											</select>
										</div>
									</div>
									<div class='form-group'>
										<label class='col-md-3 control-label'>Expire Month</label>
										<div class='col-md-9'>
											<select class='form-control' name='exp_year'>";
											$year = date('Y');
											$year1 = date('Y',strtotime("+25 years"));
											for ($i=$year; $i < $year1; $i++) 
											{ 
											echo "<option value='".$i."'>".$i."</option>";
											}
						echo 			"</select>
										</div>
									</div>
								</div>						
							</li>";
				break;
				case 'personal-field':
				echo "<li>
								<div class='col-md-12'>
									<input type='hidden' name='personal_info' value='1'>
									<h4><strong>".$json->label."</strong></h4>
									<div class='form-group'>
										<label class='col-md-3 control-label'>First Name</label>
										<div class='col-md-9'>
											<input type='text' class='form-control' name='firstname'>
										</div>
									</div>
									<div class='form-group'>
										<label class='col-md-3 control-label'>Last Name</label>
										<div class='col-md-9'>
											<input type='text' class='form-control' name='lastname'>
										</div>
									</div>
									<div class='form-group'>
										<label class='col-md-3 control-label'>Email-ID</label>
										<div class='col-md-9'>
											<input type='email' class='form-control' name='email'>
										</div>
									</div>
									<div class='form-group'>
										<label class='col-md-3 control-label'>Age</label>
										<div class='col-md-9'>
											<input type='text' class='form-control' name='age'
												maxlength='3'>
										</div>
									</div>
								</div>						
							</li>";
				break;
			
			default:
				# code...
				break;
		}
	}
}

function get_counts($id,$usertype='',$type)
{
	$CI= &get_instance();
	$where = array();
	switch ($type) {
		case 'inbox':
			$data = "count(id) as inbox";
			if($usertype=="2")
				$where = array("to_id"=>$id,"admin_read"=>0);
			else if($usertype=="1")
				$where = array("to_id"=>$id,"user_read"=>0);
			$table = "hoa_messages";
			break;
		case 'events':
			$data = "count(id) as event";
			$where = array("community_id"=>$id);
			$table = "hoa_events";
		break;
		case 'classifieds':
			$data = "count(id) as classified";
			$table = "hoa_classifieds";
		break;
		case 'forms':
			$data = "count(id) as form";
			$where = array("community_id"=>$id);
			$table = "hoa_form";
		break;
	}
	$CI->db->select($data);
	$CI->db->where($where);
	$res = $CI->db->get($table);
	return $res->row_array(); 
}

?>