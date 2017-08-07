<div class="container">
	<div class="row pad-top-50">
	<?php 
	?>
		<?php if($this->session->flashdata('class_succ'))
		{
			
			?>
			<div class="alert alert-info alert-dismissable text-center">
				<button class="close" data-dismiss="alert" aria-hidden="true">x</button>
					<strong>Success! Classifieds Added Successfully.</strong>
			</div>
			<?php 
		}
		?>
	</div>
	<div class="row pad-top-50">
		<?=$this->layout->getsidemenu();?>
		<div class="col-md-9">
			<h2 class="margin-zero">Create Classifieds Ad</h2><br>
			<div class="row">
			</div><br><br>
			<form action="<?=base_url();?>classifieds/add_classifieds" method="post" 
				enctype="multipart/form-data">
				<div class="col-md-12">
					<div class="row margin-bottom-30">
						<div class="form-group">
							<label class="col-md-3 control-label">Ad Name <span class="red">*</span></label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="ad_name" value="<?=set_value('ad_name');?>">
								<span class="error red"><?=form_error('ad_name');?></span>
							</div>
						</div>
					</div>
					<div class="row margin-bottom-30">
						<div class="form-group ">
							<label class="col-md-3 control-label">Description <span class="red">*</span></label>
							<div class="col-md-9">
								<textarea class="form-control" rows="10" name="desc"><?=set_value('desc');?></textarea>
								<span class="error red"><?=form_error('desc');?></span>
							</div>
						</div>
					</div>
					<div class="row margin-bottom-30">
						<div class="form-group ">
							<label class="col-md-3 control-label">Photos <span class="red">*</span></label>
							<div class="col-md-9">
								<input type="file" class="form-control" multiple name="userfile[]">
								<span class="error red"><?=form_error('userfile');?></span>
							</div>
						</div>
					</div>
					<div class="row margin-bottom-30">
						<div class="form-group ">
							<label class="col-md-3 control-label">Street 1 <span class="red">*</span></label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="street1"
								value="<?=set_value('street1');?>">
								<span class="error red"><?=form_error('street1');?></span>
							</div>
						</div>
					</div>
					<div class="row margin-bottom-30">
						<div class="form-group ">
							<label class="col-md-3 control-label">Street 2</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="street2"
								value="<?=set_value('street2');?>">
								<span class="error red"><?=form_error('street2');?></span>
							</div>
						</div>
					</div>
					<div class="row margin-bottom-30">
						<div class="form-group ">
							<label class="col-md-3 control-label">City <span class="red">*</span></label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="city" value="<?=set_value('city');?>">
								<span class="error red"><?=form_error('city');?></span>
							</div>
						</div>
					</div>
					<div class="row margin-bottom-30">
						<div class="form-group ">
							<label class="col-md-3 control-label">State <span class="red">*</span></label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="state" maxlength="2"
								value="<?=set_value('state');?>">
								<span class="error red"><?=form_error('state');?></span>
							</div>
						</div>
					</div>
					<div class="row margin-bottom-30">
						<div class="form-group ">
							<label class="col-md-3 control-label">Country <span class="red">*</span></label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="country" maxlength="3"
									value="<?=set_value('country');?>" >
								<span class="error red"><?=form_error('country');?></span>
							</div>
						</div>
					</div>	
					<div class="row margin-bottom-30">
						<div class="form-group ">
							<label class="col-md-3 control-label">Zipcode <span class="red">*</span></label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="zipcode"
									value="<?=set_value('zipcode');?>" >
								<span class="error red"><?=form_error('zipcode');?></span>
							</div>
						</div>
					</div>	
					<div class="row margin-bottom-30">
						<div class="form-group col-md-12 col-md-offset-3">
							<input type="submit" name="submit" class="btn theme-blue white" value="Create Ad">
						</div>
					</div>		
				</div>
			</form>
		</div>
	</div>
</div>