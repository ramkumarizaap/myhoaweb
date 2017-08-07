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
	<div class="row pad-top-50">
		<?=$this->layout->getsidemenu();?>
		<div class="col-md-9">
			<h2 class="margin-zero">Create Community</h2><br>
			<div class="row">
				<?=$this->layout->gettoolbar();?>
			</div><br><br>
			<form action="<?=base_url();?>community/add_community" method="post">
				<div class="row">
				<div class="col-md-12">
					<div class="row margin-bottom-30">
						<div class="form-group">
							<label class="col-md-3 control-label">Community Name <span class="red">*</span></label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="comm_name" value="<?=set_value('comm_name');?>">
								<span class="error red"><?=form_error('comm_name');?></span>
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
							<label class="col-md-3 control-label">Website <span class="red">*</span></label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="website" value="<?=set_value('website');?>">
								<span class="error red"><?=form_error('website');?></span>
							</div>
						</div>
					</div>
					<div class="row margin-bottom-30">
						<div class="form-group ">
							<label class="col-md-3 control-label">Address <span class="red">*</span></label>
							<div class="col-md-9">
								<textarea class="form-control" name="address" rows="5"><?=set_value('address');?></textarea>
								<span class="error red"><?=form_error('address');?></span>
							</div>
						</div>
					</div>
					<div class="row margin-bottom-30">
						<div class="form-group ">
							<label class="col-md-3 control-label">Phone</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="phone" value="<?=set_value('phone');?>">
								<span class="error red"><?=form_error('phone');?></span>
							</div>
						</div>
					</div>
					<div class="row margin-bottom-30">
						<div class="form-group ">
							<label class="col-md-3 control-label">Mobile</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="mobile" value="<?=set_value('mobile');?>">
								<span class="error red"><?=form_error('mobile');?></span>
							</div>
						</div>
					</div>
					<div class="row margin-bottom-30">
						<div class="form-group ">
							<label class="col-md-3 control-label">Fax</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="fax" value="<?=set_value('fax');?>">
								<span class="error red"><?=form_error('fax');?></span>
							</div>
						</div>
					</div>	
					<div class="row margin-bottom-30">
						<div class="form-group col-md-12 col-md-offset-3">
							<input type="submit" name="submit" class="btn theme-blue white" value="Create Community">
						</div>
					</div>		

				</div>
				</div>
			</form>
		</div>
	</div>
</div>