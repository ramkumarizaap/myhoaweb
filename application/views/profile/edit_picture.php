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
			<h2 class="margin-zero padd-zero">Edit Profile</h2><br>
			<div class="col-md-12">
				<?=$this->layout->gettoolbar();?>
				<br>
			</div>
			<div class="col-md-12">
				<br><br>
				<?php
				if($this->session->flashdata("prof_succ")==TRUE)
				{
					?>
					<div class="col-md-12">
						<div class="alert alert-success">
							<button class="close" data-dismiss="alert" aria-hidden="true">x</button>
							<strong>Success!</strong> Profile Picture has been updated.
						</div>
					</div>
					<?php 
				}
				?>
				<form method="post" 
						action="<?=base_url();?>profile/edit_picture" enctype="multipart/form-data">
					<div class="form-group">
						<h4>Profile Picture</h4>
						<img src="<?=base_url().$profile['photo'];?>" style="width:200px;height:200px;">
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Photo </label>
						<div class="col-md-9">
							<input type="file" name="userfile" class="form-control">
							<span class="error red"><?=form_error('userfile');?></span>
						</div>
					</div><br><br><br>
					<div class="form-group">
						<div class="col-md-10 col-md-offset-3">
							<input type="submit" name="submit" value="Save Changes" 
							class="btn theme-blue white" >
						</div>
					</div>
					
				</form>
			</div>
		</div>
	</div>