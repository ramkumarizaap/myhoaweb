<hr />
<ol class="breadcrumb bc-3" >
	<li><a href="<?=base_url();?>home"><i class="fa-home"></i>Home</a></li>
	<li><a href="<?=base_url();?>library/manage_document/">Document</a></li>
	<li class="active"><strong>Add Document</strong></li>
</ol>
<h2>Add Document</h2><br />
<div class="panel panel-primary">
	<div class="panel-heading">
		<div class="panel-title">Add Information</div>
	</div>
	<div class="panel-body">
		<form role="form" id="form1" action="<?=base_url();?>library/add_documents" method="post" class="validate" enctype="multipart/form-data">
		<input type="hidden" name="edit_id" value="<?=$document['id'];?>">
			<div class="form-group">
				<label class="control-label">Title</label>
				<input type="text" class="form-control" name="name" data-validate="required,minlength[4]" data-message-required="Please Enter Title" placeholder="Title" value="<?=$document['title'];?>" />
			</div>
			<div class="form-group">
				<label class="control-label">Description</label>
				<textarea class="form-control" rows="10" name="desc" data-validate="required" data-message-required="Please Enter Description" placeholder="Description"><?=$document['description'];?></textarea>
			</div>
				<div class="form-group">
				<?php
				if($document['document']!='')
				{
					echo "<a href='../../../".$document['document']."' target='_blank' >".str_replace("assets/docs/","",$document['document'])."</a>";
					$required="";
				}
				else
					$required="data-validate='required' data-message-required='Please Select Icon'";	
				?>
			</div>
			<div class="form-group">
				<label class="control-label">Document</label>
				<input type="file" class="form-control" name="userfile">
			</div>
		
			<div class="form-group">
				<label class="control-label">Category</label>
				<select class="form-control" name="category" data-validate="required" data-message-required="Please Select Category" >
					<?php
						if($category)
						{
							$cat = $document['category'];
							foreach ($category as $key => $value)
							{
								?>
									<option <?php if($value['id']==$cat){?> selected <?php }?> value="<?=$value['id'];?>"><?=$value['cat_name'];?></option>
									}
								<?php
							}
						}
					?>
				</select>
			</div>
	
			<div class="form-group">
				<button type="submit" class="btn btn-success">Add Document</button>
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
