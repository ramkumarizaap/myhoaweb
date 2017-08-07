<hr />
<ol class="breadcrumb bc-3">
	<li><a href="<?=base_url();?>home/"><i class="fa-home"></i>Home</a></li>
	<li><a href="<?=base_url();?>classifieds/manage_classifieds">Classifieds</a></li>
	<li class="active"><strong>Manage Classifieds</strong></li>
</ol>
					
<h2>Classifieds List</h2>
<?php
if($this->session->flashdata('classifieds_add')==TRUE)
{
	?>
<div class="alert alert-success alert-dismissable">
	<button class="close" aria-hidden="true" data-dismiss="alert">x</button>
	<?=$this->session->flashdata('classifieds_add');?>
</div>
<?php 
}
else if($this->session->flashdata('classifieds_fail')==TRUE)
{
	?>
	<div class="alert alert-danger alert-dismissable">
		<button class="close" aria-hidden="true" data-dismiss="alert">x</button>
		<?=$this->session->flashdata('classifieds_fail');?>
	</div>
	<?php
}
?>
<br />		
<br />
<table class="table table-bordered datatable" id="table-3">
	<thead>
		<tr class="replace-inputs">
			<th>Classified Name</th>
			<th>Address</th>
			<th>Created By</th>
		</tr>
		<tr>
			<th>Classified Name</th>
			<th>Address</th>
			<th>Created By</th>
			<th>Status</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php
			if($classifieds)
			{
				foreach ($classifieds as $key => $value)
				{
					$id = $value['id'];
					if($value['status']==1)
					{
						$st = "<a style='color:lime'  title='Unpublish User'
										href='".base_url()."classifieds/update_status/0/".$id."'>
										<i class='entypo-check'></i>
									</a>";
					}
					else
					{
						$st = "<a style='color:red' href='".base_url()."classifieds/update_status/1/".$id."'>
										<i class='entypo-block'></i>
									</a>";
					}
					?>
						<tr>
							<td><?=$value['ad_name'];?></td>
							<td>
								<?=$value['street1'];?>,<br>
								<?=$value['street2'];?>,<br>
								<?=$value['city'];?>,<br>
								<?=$value['state'];?>, <?=$value['country'];?>,<br>
								<?=$value['zipcode'];?>								
							</td>
							<td><?=$value['firstname']." ( ".$value['usertype']." )";?></td>
							<td style='text-align: center;'><?=$st;?></td>
							<td>
								<a title="Edit Classifieds" href="<?=base_url();?>classifieds/add_classifieds/<?=$id;?>">
									<i class="entypo-pencil"></i>
								</a>
									&nbsp;&nbsp;&nbsp;
								<a title="Delete Classifieds" href="#modal-4" data-toggle="modal" 
									data-href="<?=base_url()."classifieds/del_row/".$id."/id/hoa_classifieds";?>" class="del-btn">
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
				Are you sure want to delete this classified?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<a href="#" class="btn modal-delete btn-danger">Delete</a>

			</div>
		</div>
	</div>
</div>