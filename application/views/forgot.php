<?php
if($type=="username")
{?>
<br><br>
<div class="col-md-12 pad-top-20">
	<p>Please enter the email address associated with your User account. Your username will be emailed to the email address on file.</p>
</div>
<br><br><br><br>
<form action="<?=base_url();?>home/do_forgot" method="post">
<input type="hidden" name="type" value="<?=$type;?>">
	<div class="col-md-12">
		<label class="col-md-12 control-label">Email Address  <span class="red">*</span></label>
		<div class="col-md-2">
			<input type="text" class="form-control" name="email">	
		</div>
	</div>
<br><br><br><br>	
	<div class="col-md-3 pull-left">
		&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" class="btn theme-blue white font-bold">
	</div>	
</form>
<?php }
else if($type=="password")
{?>
<br><br>
<div class="col-md-12 pad-top-20">
	<p>Please enter the email address for your account. A verification code will be sent to you. Once you have received the verification code, you will be able to choose a new password for your account.</p>
</div>
<br><br><br><br>
<form action="<?=base_url();?>home/do_forgot" method="post">
<input type="hidden" name="type" value="<?=$type;?>">
	<div class="col-md-12">
		<label class="col-md-12 control-label">Email Address  <span class="red">*</span></label>
		<div class="col-md-2">
			<input type="text" class="form-control" name="email">	
		</div>
	</div>
<br><br><br><br>
	<div class="col-md-3 pull-left">
		&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" class="btn theme-blue white font-bold">
	</div>
</form>
<?php }?>