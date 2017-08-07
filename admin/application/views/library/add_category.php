<hr />
<ol class="breadcrumb bc-3" >
	<li><a href="<?=base_url();?>home"><i class="fa-home"></i>Home</a></li>
	<li><a href="<?=base_url();?>library/manage_category/">Category</a></li>
	<li class="active"><strong>Add Category</strong></li>
</ol>
<h2>Add Category</h2><br />
<div class="panel panel-primary">
	<div class="panel-heading">
		<div class="panel-title">Add Information</div>
	</div>
	<div class="panel-body">
		<form role="form" id="form1" action="<?=base_url();?>library/add_category" method="post" class="validate" enctype="multipart/form-data">
		<input type="hidden" name="edit_id" value="<?=$category['id'];?>">
			<div class="form-group">
				<label class="control-label">Category Name</label>
				<input type="text" class="form-control" name="name" data-validate="required,minlength[4]" data-message-required="Please Enter Category Name" placeholder="Category Name" value="<?=$category['cat_name'];?>" />
			</div>
			<div class="form-group">
				<label class="control-label">Description</label>
				<textarea class="form-control" rows="10" name="desc" data-validate="required" data-message-required="Please Enter Description" placeholder="Description"><?=$category['cat_desc'];?></textarea>
			</div>
				<div class="form-group">
				<?php
				if($category['cat_img']!='')
				{
					echo "<img src='../../../".$category['cat_img']."' 
						style='width:40px;height:40px;'>";
					$required="";
				}
				else
					$required="data-validate='required' data-message-required='Please Select Icon'";	
				?>
			</div>
			<div class="form-group">
				<label class="control-label">Category Icon</label>
				<input type="file" class="form-control" name="userfile">
			</div>
		
			<div class="form-group">
				<label class="control-label">Community</label>
				<select class="select2 form-control" name="community[]" multiple data-validate="required" data-message-required="Please Select Community" >
					<?php
						if($community)
						{
							$comm = explode(",",$category['community']);
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
				<button type="submit" class="btn btn-success">Add Category</button>
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
