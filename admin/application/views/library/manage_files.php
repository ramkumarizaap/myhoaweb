<hr />
<ol class="breadcrumb bc-3">
	<li><a href="<?=base_url();?>home/"><i class="fa-home"></i>Home</a></li>
	<li><a href="<?=base_url();?>library/manage_files">Category</a></li>
	<li class="active"><strong>Manage Category</strong></li>
</ol>
					
<h2>Files List</h2>
<br />
<a href="<?=base_url();?>library/create_files" class="btn btn-primary">Add Files</a>
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
			<th width="200">File</th>
			<th width="200">Size</th>
			<th width="110">Downloads</th>
			<th>Last Modified</th>
		</tr>
		<tr>
			<th>File</th>
			<th>Size</th>
			<th>Downloads</th>
			<th>Last Modified</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php
			if($files)
			{
				foreach ($files as $key => $value)
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
						<td><?=str_replace("assets/docs/","",$value['document']);?></td>
						<td><?=getSize(filesize("../".$value['document']))	;?></td>
							<td><?=$value['downloads'];?></td>
							<td><?=date("d M Y",strtotime($value['created_date']));?></td>
							<td>
								<a href="<?=base_url();?>library/download/<?=$id;?>" title="Download Document" data-id="<?=$id;?>" >
									<i class="entypo-download"></i>
								</a>&nbsp;&nbsp;&nbsp;&nbsp;
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