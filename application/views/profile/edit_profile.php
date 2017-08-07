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
							<strong>Success!</strong> Profile has been updated.
						</div>
					</div>
					<?php 
				}
				?>
				<form class="form-horizontal" method="post" 
						action="<?=base_url();?>profile/edit_profile">
					<div class="form-group">
						<label class="col-md-3 control-label">First Name
							<span class="red"> *</span></label>
						<div class="col-md-9">
							<input type="text" name="firstname" class="form-control" 
							value="<?=set_value('firstname',$profile['firstname']);?>" >
							<span class="error red"><?=form_error('firstname');?></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Last Name
							<span class="red"> *</span></label>
						<div class="col-md-9">
							<input type="text" name="lastname" class="form-control"
							value="<?=set_value('lastname',$profile['lastname']);?>">
							<span class="error red"><?=form_error('lastname');?></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">User Name
							<span class="red"> *</span></label>
						<div class="col-md-9">
							<input type="text" name="username" readonly class="form-control"
							value="<?=set_value('username',$profile['username']);?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Email<span class="red"> *</span></label>
						<div class="col-md-9">
							<input type="text" name="email" readonly class="form-control"
							value="<?=set_value('email',$profile['email']);?>">
						</div>
					</div>
					<div class="form-group">
            <label class="col-md-3 control-label">Password</label>
            <div class="col-md-9">
              <div class="input-group">
                <input class="form-control profilepass" placeholder="Password" type="password" value="<?=set_value('password',$profile['password']);?>">
                <span class="error red"><?=form_error('password');?></span>
                <span class="input-group-addon pass-toggle">
                  <i class="glyphicon glyphicon-eye-open"></i>
                </span>
              </div>
            </div>
          </div>
					<div class="form-group">
						<label class="col-md-3 control-label">Address </label>
						<div class="col-md-9">
							<textarea name="address" class="form-control"><?=set_value('address',$profile['address']);?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Phone </label>
						<div class="col-md-9">
							<input type="text" name="phone" class="form-control" 
							value="<?=set_value('phone',$profile['phone']);?>">
							<span class="error red"><?=form_error('phone');?></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Mobile </label>
						<div class="col-md-9">
							<input type="text" name="mobile" class="form-control"
							value="<?=set_value('mobile',$profile['mobile']);?>">
							<span class="error red"><?=form_error('mobile');?></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">About Me </label>
						<div class="col-md-9">
							<textarea name="about_me" class="form-control"><?=set_value('about_me',$profile['about_me']);?></textarea>
						</div>
					</div>
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