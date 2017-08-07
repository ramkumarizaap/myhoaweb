<hr />
<ol class="breadcrumb bc-3">
	<li><a href="<?=base_url();?>home/"><i class="fa-home"></i>Home</a></li>
	<li><a href="<?=base_url();?>library/manage_category">Category</a></li>
	<li class="active"><strong>Manage Category</strong></li>
</ol>
					
<h2>Category List</h2>
<br />
<a href="<?=base_url();?>library/create_category" class="btn btn-primary">Add Category</a>
<br />
<?php
if($this->session->flashdata('library_add')==TRUE)
{
	?>
<div class="alert alert-success alert-dismissable">
	<button class="close" aria-hidden="true" data-dismiss="alert">x</button>
	<?=$this->session->flashdata('library_add');?>
</div>
<?php 
}
else if($this->session->flashdata('events_fail')==TRUE)
{
	?>
	<div class="alert alert-danger alert-dismissable">
		<button class="close" aria-hidden="true" data-dismiss="alert">x</button>
		<?=$this->session->flashdata('library_fail');?>
	</div>
	<?php
}
?>

<br />
<table class="table table-bordered datatable" id="table-3">
	<thead>
		<tr class="replace-inputs">
			<th width="150">Category Name</th>
			<th width="200">Community</th>
			<th  width="300" >Created By</th>
			<th width="110">Documents</th>
		</tr>
		<tr>
			<th class="no-sort">Category Name</th>
			<th>Community</th>
			<th>Created By</th>
			<th>Documents</th>
			<th>Status</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php
			if($category)
			{
				foreach ($category as $key => $value)
				{
					$id = $value['id'];
					if($value['status']==1)
					{
						$st = "<a style='color:lime'  title='Unpublish User'
										href='".base_url()."library/update_status/0/".$id."/hoa_resource_category'>
										<i class='entypo-check'></i>
									</a>";
					}
					else
					{
						$st = "<a style='color:red' href='".base_url()."library/update_status/1/".$id."/hoa_resource_category'>
										<i class='entypo-block'></i>
									</a>";
					}
					?>
						<tr>
							<td><?=$value['cat_name'];?></td>
							<td>
								<?php
									$comm = get_community($value['community']);
									echo $comm['name'];
								?>
							</td>
							<td>
								<?php
									$from = get_user($value['created_by']);
									echo $from['firstname']." ( ".$from['email']." )";
								?>
							</td>
							<td>
								<a href="<?=base_url()."library/manage_documents/".$id;?>" style="text-decoration:underline;color:blue;">
									<?=$value['docs'];?> Docs
								</a>
							</td>
							<td><?=$st;?></td>
							<td>
								<a href="<?=base_url()."library/create_category/".$id;?>">
									<i class="entypo-pencil"></i>
								</a>&nbsp;&nbsp;&nbsp;&nbsp;
								<a href="javascript:void(0);" data-toggle="modal" data-target="#modal-4" data-href="<?=base_url()."library/del_row/".$id."/id/hoa_resource_category";?>" >
									<i class="entypo-trash"></i>
								</a>
							</td>							
						</tr>
					<?php
				}
			}
			?>		
	</tbody>
</table>
<div class="modal fade" id="modal-4" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Confirm Delete</h4>
			</div>
			<div class="modal-body">
				Are you sure want to delete this message?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<a href="#" class="btn modal-delete btn-danger">Delete</a>

			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal-5" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="ajax-content">
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>