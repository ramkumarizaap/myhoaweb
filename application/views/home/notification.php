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
			<h2 class="margin-zero">Create Emergency Notification</h2><br>
			<br><br>
			<form action="<?=base_url();?>home/add_notification/<?=$id;?>" method="post">
				<div class="row">
				<div class="col-md-12">
					<div class="row margin-bottom-30">
						<div class="form-group">
							<label class="col-md-3 control-label">Title <span class="red">*</span></label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="title" value="<?=set_value('title');?>">
								<span class="error red"><?=form_error('title');?></span>
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
						<div class="form-group col-md-12 col-md-offset-3">
							<input type="submit" name="submit" class="btn theme-blue white" value="Create Notification">
						</div>
					</div>		

				</div>
				</div>
			</form>
		</div>
	</div>
</div>