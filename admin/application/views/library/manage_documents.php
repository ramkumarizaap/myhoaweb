<hr />
<ol class="breadcrumb bc-3">
	<li><a href="<?=base_url();?>home/"><i class="fa-home"></i>Home</a></li>
	<li><a href="<?=base_url();?>category/manage_documents">Documents</a></li>
	<li class="active"><strong>Manage Documents</strong></li>
</ol>
					
<h2>Documents List</h2>
<br />
<a href="<?=base_url();?>library/create_document" class="btn btn-primary">Add Document</a>
<br>
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
			<th width="150">Document Title</th>
			<?php if($cat_id==''){?>
			<th width="150">Category</th><?php }?>
			<th  width="300" >Created By</th>
			<th  width="100" >Date</th>
			<th  width="100" >Status</th>
		</tr>
		<tr>
			<th>Document Title</th>
			<?php if($cat_id==''){?>
			<th>Category</th><?php }?>
			<th>Created By</th>
			<th>Date</th>
			<th>Status</th>
			<th>Downloads</th>
			<th  width="150">Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php
			if($documents)
			{
				foreach ($documents as $key => $value)
				{
					$id = $value['id'];
					if($value['status']==1)
					{
						$st = "<a style='color:lime'  title='Unpublish User'
										href='".base_url()."library/update_status/0/".$id."/hoa_resource_document'>
										<i class='entypo-check'></i>
									</a>";
					}
					else
					{
						$st = "<a style='color:red' href='".base_url()."library/update_status/1/".$id."/hoa_resource_document'>
										<i class='entypo-block'></i>
									</a>";
					}
					?>
						<tr>
							<td><?=$value['title'];?></td>
							<?php if($cat_id==''){?>
							<td><?=$value['cat_name'];?></td><?php }?>
							<td>
							<?php
									$from = get_user($value['created_by']);
									echo $from['firstname']." ( ".$from['email']." )";
								?>
							</td>
							<td><?=date("d M Y",strtotime($value['created_date']));?>
							<td><?=$st;?></td>
							<td><?=$value['downloads'];?></td>
							<td>
								<a href="<?=base_url();?>library/download/<?=$id;?>" title="Download Document" data-id="<?=$id;?>" >
									<i class="entypo-download"></i>
								</a>&nbsp;&nbsp;&nbsp;&nbsp;
								<a href="<?=base_url();?>library/create_document/<?=$id;?>" >
									<i class="entypo-pencil"></i>
								</a>&nbsp;&nbsp;&nbsp;&nbsp;
								<a href="javascript:void(0);" title="Delete Document"data-toggle="modal" data-target="#modal-4" data-href="<?=base_url()."library/del_row/".$id."/id/hoa_resource_document";?>" >
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