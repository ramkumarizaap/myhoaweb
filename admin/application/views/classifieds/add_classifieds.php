<hr />
<ol class="breadcrumb bc-3" >
	<li><a href="<?=base_url();?>home"><i class="fa-home"></i>Home</a></li>
	<li><a href="<?=base_url();?>classifieds/manage_classifieds">Classifieds</a></li>
	<li class="active"><strong>Add Classifieds</strong></li>
</ol>
<h2>Add Classifieds</h2><br />
<div class="panel panel-primary">
	<div class="panel-heading">
		<div class="panel-title">Add Information</div>
	</div>
	<div class="panel-body">
		<form role="form" id="form1" action="<?=base_url();?>classifieds/create_classifieds" method="post" class="validate" enctype="multipart/form-data">
		<input type="hidden" name="edit_id" value="<?=$classifieds['id'];?>">
			<div class="form-group">
				<label class="control-label">Classified Name</label>
				<input type="text" class="form-control" name="ad_name" data-validate="required,minlength[4]" data-message-required="Please Enter Classified Name" placeholder="Classified Name" value="<?=$classifieds['ad_name'];?>" />
			</div>
			<div class="form-group">
				<label class="control-label">Description</label>
				<textarea class="form-control" rows="10" name="desc" data-validate="required" data-message-required="Please Enter Description" placeholder="Description"><?=$classifieds['description'];?></textarea>
			</div>
			<div class="form-group">
				<label class="control-label">Photos</label>
				<input type="file" class="form-control" name="userfile[]" data-validate="required" multiple data-message-required="Please Select Photos" />
			</div>
			<input type="hidden" name="old_img" value="<?=$classifieds['photos'];?>">
			<?php 
			if($classifieds['photos']!='')
			{
				?>
					<div class="gallery-env">
						<?php
							$img = explode(",",$classifieds['photos']);
							if($img)
							{
								foreach ($img as $key => $value)
								{
									?>
									<div class="col-sm-3 col-xs-4" data-tag="<?=$value;?>" data-id="<?=$classifieds['id'];?>">
										<article class="image-thumb">
											<a href="#" class="image">
												<img style="height:100px;"
												 src="../../../assets/images/classifieds/<?=$value;?>">
											</a>
											<div class="image-options">
												<a href="#" class="view"><i class="entypo-eye"></i></a>
												<a href="#" class="delete"><i class="entypo-cancel"></i></a>
											</div>
										</article>
									</div>
									<?php
								}
							}
							?>
					</div>
					<?php 
				}
			?>
			<div class="form-group">
				<label class="control-label">Street 1</label>
				<input type="text" class="form-control" name="street_1" data-validate="required" data-message-required="Please Enter Street 1" placeholder="Street 1" value="<?=$classifieds['street1'];?>" />
			</div>
			<div class="form-group">
				<label class="control-label">Street 2</label>
				<input type="text" class="form-control" name="street_2" data-validate="required" data-message-required="Please Enter Street 2" placeholder="Street 2" value="<?=$classifieds['street2'];?>" />
			</div>
			<div class="form-group">
				<label class="control-label">City</label>
				<input type="text" class="form-control" name="city" data-validate="required" data-message-required="Please Enter City" placeholder="City" 
				value="<?=$classifieds['city'];?>" />
			</div>
			<div class="form-group">
				<label class="control-label">State</label>
				<input type="text" class="form-control" name="state" data-validate="required" data-message-required="Please Enter State" placeholder="State"
				value="<?=$classifieds['state'];?>" />
			</div>
			<div class="form-group">
				<label class="control-label">Country</label>
				<input type="text" class="form-control" name="country" data-validate="required" data-message-required="Please Enter Country" placeholder="Country" value="<?=$classifieds['country'];?>" />
			</div>
			<div class="form-group">
				<label class="control-label">Zipcode</label>
				<input type="text" class="form-control" name="zipcode" data-validate="required,number" data-message-required="Please Enter Zipcode" placeholder="Zipcode" value="<?=$classifieds['zipcode'];?>" />
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-success">Add Classified</button>
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
