<hr />
<ol class="breadcrumb bc-3" >
	<li><a href="<?=base_url();?>home"><i class="fa-home"></i>Home</a></li>
	<li><a href="<?=base_url();?>manage_events/">Events</a></li>
	<li class="active"><strong>Add Events</strong></li>
</ol>
<h2>Add Events</h2><br />
<div class="panel panel-primary">
	<div class="panel-heading">
		<div class="panel-title">Add Information</div>
	</div>
	<div class="panel-body">
		<form role="form" id="form1" action="<?=base_url();?>events/create_events" method="post" class="validate" enctype="multipart/form-data">
		<input type="hidden" name="edit_id" value="<?=$events['id'];?>">
			<div class="form-group">
				<label class="control-label">Event Name</label>
				<input type="text" class="form-control" name="name" data-validate="required,minlength[4]" data-message-required="Please Enter Event Name" placeholder="Event Name" value="<?=$events['name'];?>" />
			</div>
			<div class="form-group">
				<label class="control-label">Description</label>
				<textarea class="form-control" rows="10" name="desc" data-validate="required" data-message-required="Please Enter Description" placeholder="Description"><?=$events['desc'];?></textarea>
			</div>
			<div class="form-group">
				<label class="control-label">Banner</label>
				<input type="file" class="form-control" name="userfile" />
			</div>
			<input type="hidden" name="old_img" value="<?=$events['banner'];?>">
			<?php
			if($events['banner']!='')
			{
				echo "<img src='../../../".$events['banner']."' style='height:150px;width:200px;' ><br><br>";
			}
			?>
			<div class="form-group">
				<label class="control-label">Address</label>
				<textarea type="text" class="form-control" name="address" data-validate="required" data-message-required="Please Enter Address" placeholder="Address"><?=$events['address'];?></textarea>
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
				<label class="control-label">From Date</label>
				<input type="text" class="form-control datetime" name="from_date" data-validate="required" data-message-required="Please Select From Date" placeholder="From Date" value="<?=$events['from_date'];?>" />
			</div>
			<div class="form-group">
				<label class="control-label">To Date</label>
				<input type="text" class="form-control datetime" name="to_date" data-validate="required" data-message-required="Please Select To Date" placeholder="To Date" value="<?=$events['to_date'];?>" />
			</div>
		
			<div class="form-group">
				<button type="submit" class="btn btn-success">Add Event</button>
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
