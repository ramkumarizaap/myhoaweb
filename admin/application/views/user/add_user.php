<hr />
<ol class="breadcrumb bc-3" >
	<li><a href="<?=base_url();?>home"><i class="fa-home"></i>Home</a></li>
	<li><a href="<?=base_url();?>user/manage_user">User</a></li>
	<li class="active"><strong>Add User</strong></li>
</ol>
<h2>Add User</h2><br />
<div class="panel panel-primary">
	<div class="panel-heading">
		<div class="panel-title">Add Information</div>
	</div>
	<div class="panel-body">
		<form role="form" id="form1" action="<?=base_url();?>user/create_user" method="post" class="validate">
		<input type="hidden" name="edit_id" value="<?=$user['id'];?>">
			<div class="form-group">
				<label class="control-label">First Name</label>
				<input type="text" class="form-control" name="firstname" data-validate="required" data-message-required="Please Enter Firstname" placeholder="First Name" value="<?=$user['firstname'];?>" />
			</div>
			<div class="form-group">
				<label class="control-label">Last Name</label>
				<input type="text" class="form-control" name="lastname" data-validate="required" data-message-required="Please Enter Lastname" placeholder="Last Name"
				value="<?=$user['lastname'];?>" />
			</div>
			<div class="form-group">
				<label class="control-label">User Name</label>
				<input type="text" class="form-control" name="username" data-validate="required" data-message-required="Please Enter Username" placeholder="Username" 
				value="<?=$user['username'];?>" />
			</div>
			<div class="form-group">
				<label class="control-label">Email-ID</label>
				<input type="text" class="form-control" name="email" data-validate="required,email" data-message-required="Please Enter Email-ID" placeholder="Email-ID" value="<?=$user['email'];?>"/>
			</div>
			<div class="form-group">
				<label class="control-label">Password</label>
				<input type="password" class="form-control" name="password" data-validate="required" data-message-required="Please Enter Password" placeholder="Password" 
				value="<?=$user['password'];?>" />
			</div>
			<div class="form-group">
				<label class="col-md-12 control-label" style="padding:0;">Usertype</label>
					<select style="display: none;" data-validate="required" name="usertype" class="form-control selectboxit">
						<?php
						if($usertype)
						{
							foreach ($usertype as $key => $value)
							{
								?>
									<option <?php if($user['usertype']==$value['id']){?>selected<?php }?>
										value="<?=$value['id'];?>"><?=$value['name'];?></option>
									}
								<?php
							}
						}
						?>
					</select>				
			</div>
			<div class="form-group">
				<label class="col-md-12 control-label" style="padding:0;">Community</label>
					<select style="display: none;" data-validate="required" name="community" class="form-control selectboxit">
						<?php
						if($community)
						{
							foreach ($community as $key => $value)
							{
								?>
									<option <?php if($user['code']==$value['id']){?>selected <?php }?>
										value="<?=$value['id'];?>">
										<?=$value['name']." ( ".$value['code']." )";?>
									</option>
								<?php
							}
						}
						?>
					</select>				
			</div>
			<div class="form-group">
				<label class="control-label">Mobile No</label>
				<input type="text" class="form-control" name="mobile" data-validate="number" placeholder="Mobile No" value="<?=$user['mobile'];?>" />
			</div>
			<div class="form-group">
				<label class="control-label">Phone No</label>
				<input type="text" class="form-control" name="phone" data-validate="number"  placeholder="Phone No" value="<?=$user['phone'];?>" />
			</div>
			<div class="form-group">
				<label class="control-label">About Me</label>
				<textarea class="form-control" name="about_me" placeholder="About Me"><?=$user['about_me'];?></textarea>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-success">Add User</button>
				<button type="reset" class="btn">Reset</button>
			</div>
		</form>
	</div>
</div>

	
