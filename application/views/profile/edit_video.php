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
							<strong>Success!</strong> Profile Video has been updated.
						</div>
					</div>
					<?php 
				}
				?>
				<form class="" method="post" 
						action="<?=base_url();?>profile/edit_video" enctype="multipart/form-data">
					<div class="form-group">
						<h4>Profile Video</h4>
						<video height="240" controls>
						  <source src="<?=base_url().$profile['video'];?>" type="video/mp4">
							  Your browser does not support the video tag.
						</video>
					</div><br><br>
					<div class="form-group">
						<label class="col-md-3 control-label">Video </label>
						<div class="col-md-9">
							<input type="file" name="userfile" class="form-control">
							<span class="error red"><?=form_error('userfile');?></span>
						</div>
					</div><br><br>
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