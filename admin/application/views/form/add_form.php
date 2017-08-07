<hr />
<ol class="breadcrumb bc-3" >
	<li><a href="<?=base_url();?>home"><i class="fa-home"></i>Home</a></li>
	<li><a href="<?=base_url();?>form/manage_form/">Form</a></li>
	<li class="active"><strong>Add Form</strong></li>
</ol>
<h2>Add Form</h2><br />
<div class="panel panel-primary">
	<div class="panel-heading">
		<div class="panel-title">Add Information</div>
	</div>
	<div class="panel-body">
		<form role="form" id="form1" action="<?=base_url();?>form/create_form" method="post" class="validate" enctype="multipart/form-data">
			<div class="form-group">
				<label class="control-label">Form Name</label>
				<input type="text" class="form-control" name="name" data-validate="required,minlength[4]" data-message-required="Please Enter Form Name" placeholder="Form Name" value="<?=$form['form_name'];?>" />
			</div>
			<div class="form-group">
				<label class="control-label">Community</label>
				<select class="select2 form-control" name="community[]" multiple data-validate="required" data-message-required="Please Select Community" >
					<?php
						if($community)
						{
							$comm = explode(",",$form['community_id']);
							foreach ($community as $key => $value)
							{
								?>
									<option <?php if(in_array($value['id'],$comm)){?> selected <?php }?> value="<?=$value['id'];?>"><?=$value['name'];?></option>
									}
								<?php
							}
						}
					?>
				</select>
			</div>
			<?php
			if($form['id']!='')
			{
				?>
				<div class="form-input col-md-12">
					<ul>
						<li data-field="title-field" data-target="#FormModal" data-toggle="modal">
								Form Title&nbsp;&nbsp;
								<span class="add-icon glyphicon glyphicon-plus"></span>
						</li>
						<li data-field="input-field" data-target="#FormModal" data-toggle="modal">
								Input Field&nbsp;&nbsp;
								<span class="add-icon glyphicon glyphicon-plus"></span>
						</li>
						<li data-field="area-field" data-target="#FormModal" data-toggle="modal">
								Text Area&nbsp;&nbsp;
								<span class="add-icon glyphicon glyphicon-plus"></span>
						</li>
						<li data-field="select-field" data-target="#FormModal" data-toggle="modal">
								Select Box&nbsp;&nbsp;
								<span class="add-icon glyphicon glyphicon-plus"></span>
						</li>
						<li data-field="radio-field" data-target="#FormModal" data-toggle="modal">Radio Button&nbsp;&nbsp;
								<span class="add-icon glyphicon glyphicon-plus"></span>
						</li> 
						<li data-field="check-field" data-target="#FormModal" data-toggle="modal">
								CheckBoxes&nbsp;&nbsp;
								<span class="add-icon glyphicon glyphicon-plus"></span>
						</li>
						<li data-field="password-field" data-target="#FormModal" data-toggle="modal">
								Password&nbsp;&nbsp;
								<span class="add-icon glyphicon glyphicon-plus"></span>
						</li>
						<li data-field="payment-field" data-target="#FormModal" data-toggle="modal">
								Payment Info&nbsp;&nbsp;
								<span class="add-icon glyphicon glyphicon-plus"></span>
						</li>
						<li data-field="personal-field" data-target="#FormModal" data-toggle="modal">
								Personal Info&nbsp;&nbsp;
								<span class="add-icon glyphicon glyphicon-plus"></span>
						</li>
						<li data-field="file-field" data-target="#FormModal" data-toggle="modal">
								File Upload&nbsp;&nbsp;
								<span class="add-icon glyphicon glyphicon-plus"></span>
						</li>
						<li data-field="date-field" data-target="#FormModal" data-toggle="modal">
								Datetime Picker&nbsp;&nbsp;
								<span class="add-icon glyphicon glyphicon-plus"></span>
						</li>
						<li data-field="submit-field" data-target="#FormModal" data-toggle="modal">
								Submit Button&nbsp;&nbsp;
								<span class="add-icon glyphicon glyphicon-plus"></span>
						</li>
					</ul>
				</div>
				<div class="col-md-12 saved-form">
					<ul>
						<?=create_form($form['id']);?>
					</ul>
				</div>
			<div class="form-group">
				<a href="<?=base_url();?>form/manage_form" class="btn btn-success">Save Form</a>
			</div>
			<?php
			}
			else
			{
				?>
				<div class="form-group">
					<button type="submit" class="btn btn-success">Add Form</button>
					<button type="reset" class="btn">Reset</button>
				</div>
				<?php
			}
			?>
		</form>
	</div>
</div>
<div id="FormModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Input</h4>
      </div>
      <div class="modal-body input-list-modal">
      	<form action="<?=base_url();?>form/add_input" method="post">
      		<input type="hidden" name="form_id" value="<?=$form['id'];?>">
      		<input type="hidden" name="edit_id" value="">
	      	<div class="row text-field">
	      		<div class="col-md-12">
	      			<div class="form-group">
	      				<label class="control-label">Label Name</label>
	      				<input type="text" class="form-control" name="label"><br>
	      				<input type="hidden" value="" name="type" class="field_type">
	      				<span>
	      					<input type="checkbox" name="required">&nbsp;&nbsp;&nbsp;Required
	      				</span>
	      			</div>
	      			<div class="form-group payment-field" style="display:none;">
	      				<label class="control-label">Amount</label>
	      				<input type="text" class="form-control" name="amount" value="5.00">
	      			</div>

	      			<div class="form-group other-field" style="display:none;">
	      				<label class="col-md-12">Options</label>
	      				<a href="javascript:void(0);" class="btn add_opt_field btn-primary">Add New</a><br><br>
	      				<div class="opt-div select">
	      					<div>
	      						<div class="col-md-11">
	      							<input type="text" class="form-control" name="select_ip[]">
	      						</div>
	      						<a href="javascript:void(0)" class='del_ip'>
	      							<i class="glyphicon glyphicon-remove"></i>
	      						</a>
	      					</div><br>
	      					<div>
	      						<div class="col-md-11">
	      							<input type="text" class="form-control" name="select_ip[]">
	      						</div>
	      						<a href="javascript:void(0)" class='del_ip'>
	      							<i class="glyphicon glyphicon-remove"></i>
	      						</a>
	      					</div><br>
	      					<div>
	      						<div class="col-md-11">
	      							<input type="text" class="form-control" name="select_ip[]">
	      						</div>
	      						<a href="javascript:void(0)" class='del_ip'>
	      							<i class="glyphicon glyphicon-remove"></i>
	      						</a>
	      					</div><br>
	      				</div>
	      			</div>
	      		</div>
	      	</div><br><br>
	      	<div class="row">
	      		<div class="form-group col-md-2">
	      			<input type="submit" value="Create" name="submit" class="btn btn-info">
	      		</div>
	      	</div>
      	</form>
    	</div>
  	</div>
	</div>
</div>