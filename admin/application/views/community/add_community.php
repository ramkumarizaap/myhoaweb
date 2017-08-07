<hr />
<ol class="breadcrumb bc-3" >
	<li><a href="<?=base_url();?>home"><i class="fa-home"></i>Home</a></li>
	<li><a href="<?=base_url();?>community/manage_community">Community</a></li>
	<li class="active"><strong>Add Community</strong></li>
</ol>
<h2>Add Community</h2><br />
<div class="panel panel-primary">
	<div class="panel-heading">
		<div class="panel-title">Add Information</div>
	</div>
	<div class="panel-body">
		<form role="form" id="form1" action="<?=base_url();?>community/create_community" method="post" class="validate">
		<input type="hidden" name="edit_id" value="<?=$community['id'];?>">
			<div class="form-group">
				<label class="control-label">Community Name</label>
				<input type="text" class="form-control" name="name" data-validate="required,minlength[4]" data-message-required="Please Enter Community Name" placeholder="Community Name" value="<?=$community['name'];?>" />
			</div>
			<div class="form-group">
				<label class="control-label">Description</label>
				<textarea class="form-control" rows="10" name="desc" data-validate="required" data-message-required="Please Enter Description" placeholder="Description"><?=$community['desc'];?></textarea>
			</div>
			<div class="form-group">
				<label class="control-label">Website</label>
				<input type="text" class="form-control" name="website" data-validate="required" data-message-required="Please Enter Website" placeholder="Website" 
				value="<?=$community['website'];?>" />
			</div>
			<div class="form-group">
				<label class="control-label">Address</label>
				<textarea class="form-control" name="address" data-validate="required" data-message-required="Please Enter Address" placeholder="Address"><?=$community['address'];?></textarea>
			</div>
			<div class="form-group">
				<label class="control-label">Mobile No</label>
				<input type="text" class="form-control" name="mobile" data-validate="number" placeholder="Mobile No" value="<?=$community['mobile'];?>" />
			</div>
			<div class="form-group">
				<label class="control-label">Phone No</label>
				<input type="text" class="form-control" name="phone" data-validate="number"  placeholder="Phone No" value="<?=$community['phone'];?>" />
			</div>
			<div class="form-group">
				<label class="control-label">Fax</label>
				<input type="text" class="form-control" name="fax" data-validate="number" data-message-required="Please Enter Fax No" placeholder="Fax" 
				value="<?=$community['fax'];?>" />
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-success">Add Community</button>
				<button type="reset" class="btn">Reset</button>
			</div>
		</form>
	</div>
</div>