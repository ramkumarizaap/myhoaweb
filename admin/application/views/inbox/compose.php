<hr />
<ol class="breadcrumb bc-3" >
	<li><a href="<?=base_url();?>home"><i class="fa-home"></i>Home</a></li>
	<li><a href="<?=base_url();?>manage_inbox/">Compose</a></li>
	<li class="active"><strong>Compose Mail</strong></li>
</ol>
<h2>Compose Mail</h2><br />
<div class="panel panel-primary">
	<div class="panel-heading">
		<div class="panel-title">Add Information</div>
	</div>
	<div class="panel-body">
		<form role="form" id="form1" action="<?=base_url();?>events/create_events" method="post" class="validate" enctype="multipart/form-data">
			<div class="form-group">
				<label class="control-label">Subject</label>
				<input type="text" class="form-control" name="name" data-validate="required,minlength[4]" data-message-required="Please Enter Subject" placeholder="Subject"/>
			</div>
			<div class="form-group">
				<label class="control-label">Message</label>
				<textarea class="form-control" rows="10" name="desc" data-validate="required" data-message-required="Please Enter Message" placeholder="Message"></textarea>
			</div>
			<div class="form-group">
				<label class="control-label">File</label>
				<input type="file" class="form-control" name="userfile" />
			</div>
			<div class="form-group">
				<label class="control-label">Community</label>
				<select class="select2 form-control" name="community[]" multiple data-validate="required" data-message-required="Please Select Community" >
					<?php
						if($community)
						{
							$comm = explode(",",$events['community_id']);
							foreach ($community as $key => $value)
							{
								?>
									<option <?php if(in_array($value['id'],$comm)){?> selected <?php }?> value="<?=$value['id'];?>"><?=$value['name'];?></option>
									}
								<?php
							}
						}
					?>
				</select>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-success">Send Mail</button>
				<button type="reset" class="btn">Reset</button>
			</div>
		</form>
	</div>
</div>

<div class="modal fade" id="album-image-options">
	<div class="modal-dialog">
		<div class="modal-content">
			
			<div class="gallery-image-edit-env">
				<img src="../../../assets/images/classifieds/1.jpg" class="img-responsive" />
				
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
		</div>
	</div>
</div>
