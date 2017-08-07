<hr />
<ol class="breadcrumb bc-3">
	<li><a href="<?=base_url();?>home/"><i class="fa-home"></i>Home</a></li>
	<li><a href="<?=base_url();?>form/manage_form">Form</a></li>
	<li class="active"><strong>Manage Form</strong></li>
</ol>
					
<h2>Forms List</h2>
<?php
if($this->session->flashdata('form_add')==TRUE)
{
	?>
<div class="alert alert-success alert-dismissable">
	<button class="close" aria-hidden="true" data-dismiss="alert">x</button>
	<?=$this->session->flashdata('events_add');?>
</div>
<?php 
}
else if($this->session->flashdata('form_fail')==TRUE)
{
	?>
	<div class="alert alert-danger alert-dismissable">
		<button class="close" aria-hidden="true" data-dismiss="alert">x</button>
		<?=$this->session->flashdata('events_fail');?>
	</div>
	<?php
}
?>
<br />		
<br />
<table class="table table-bordered datatable" id="table-3">
	<thead>
		<tr class="replace-inputs">
			<th>Form Name</th>
			<th>Community Name</th>
			<th>Created By</th>
		</tr>
		<tr>
			<th>Form Name</th>
			<th>Community Name</th>
			<th>Created By</th>
			<th>Status</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php
			if($forms)
			{
				foreach ($forms as $key => $value)
				{
					$id = $value['id'];
					if($value['status']==1)
					{
						$st = "<a style='color:lime'  title='Unpublish User'
										href='".base_url()."events/update_status/0/".$id."'>
										<i class='entypo-check'></i>
									</a>";
					}
					else
					{
						$st = "<a style='color:red' href='".base_url()."events/update_status/1/".$id."'>
										<i class='entypo-block'></i>
									</a>";
					}
					?>
						<tr>
							<td><?=$value['form_name'];?></td>
							<td><?=$value['community_name'];?></td>
							<td><?=$value['firstname']." ( ".$value['usertype']." )";?></td>
							<td style='text-align: center;'><?=$st;?></td>
							<td>
								<a title="View Form" target="_blank"
										href="<?=base_url();?>form/view_form/<?=$id;?>">
									<i class="entypo-eye"></i>
								</a>
									&nbsp;&nbsp;&nbsp;
								<a title="List Enteries" href="<?=base_url();?>form/list_enteries/<?=$id;?>">
								<i class="entypo-menu"></i>
								</a>
									&nbsp;&nbsp;&nbsp;
								<a title="Edit Form" href="<?=base_url();?>form/add_form/<?=$id;?>">
									<i class="entypo-pencil"></i>
								</a>
									&nbsp;&nbsp;&nbsp;
								<a title="Delete Form" href="#modal-4" data-toggle="modal" 
									data-href="<?=base_url()."form/del_row/".$id."/id/hoa_form";?>" class="del-btn">
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
				Are you sure want to delete this form?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<a href="#" class="btn modal-delete btn-danger">Delete</a>

			</div>
		</div>
	</div>
</div>