<div class="container">
	<div class="row pad-top-50">
	<?php 
	?>
		<?php if($this->session->flashdata('succ'))
		{
			
			?>
			<div class="alert alert-info alert-dismissable text-center">
				<button class="close" data-dismiss="alert" aria-hidden="true">x</button>
					Welcome <strong><?=$users['firstname'];?>!</strong>
			</div>
			<?php 
		}
		?>
	</div>
	<div class="row pad-top-50 ">
		<?=$this->layout->getsidemenu();?>
		<div class="col-md-8">
			<h2 class="margin-zero padd-zero">Form</h2><br>
			<div class="col-md-12">
				<ul class="input-list">
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
					<li data-field="submit-field" data-target="#FormModal" data-toggle="modal">
							Submit Button&nbsp;&nbsp;
							<span class="add-icon glyphicon glyphicon-plus"></span>
					</li>
				</ul>
			</div><br>
			<span class="help-block">
				<i>Note : You can drag and drop your fields in any order.</i>
			</span>
			<div class="row">
				<div class="form-create-div col-md-12 pad-top-20">
					<form class="form-horizontal" method="post">
						<ul class="list-inputs">
							<?=create_form($form_id);?>
						</ul>
					</form>
				</div>
			</div>
		</div>
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
      		<input type="hidden" name="form_id" value="<?=$form_id;?>">
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
	      			<div class="form-group">
	      				<label class="control-label">Width</label>
	      				<input type="text" class="form-control" name="width"><br>
	      			</div>
	      			<div class="form-group payment-field" style="display:none;">
	      				<label class="control-label">Amount</label>
	      				<input type="text" class="form-control" name="amount" value="5.00">
	      			</div>

	      			<div class="form-group other-field" style="display:none;">
	      				<label class="col-md-12">Options</label>
	      				<a href="javascript:void(0);" class="btn add_opt_field theme-blue white">Add New</a><br><br>
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
	      		<div class="form-group col-md-offset-1">
	      			<input type="submit" value="Create" name="submit" class="btn theme-blue white">
	      		</div>
	      	</div>
      	</form>
    	</div>
  	</div>
	</div>
</div>