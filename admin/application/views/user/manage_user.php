<hr />
<ol class="breadcrumb bc-3">
	<li><a href="<?=base_url();?>home/"><i class="fa-home"></i>Home</a></li>
	<li><a href="<?=base_url();?>user/manage_user">Users</a></li>
	<li class="active"><strong>Manage Users</strong></li>
</ol>
					
<h2>User List</h2>
<?php
if($this->session->flashdata('user_add')==TRUE)
{
	?>
<div class="alert alert-success alert-dismissable">
	<button class="close" aria-hidden="true" data-dismiss="alert">x</button>
	<?=$this->session->flashdata('user_add');?>
</div>
<?php 
}
else if($this->session->flashdata('user_fail')==TRUE)
{
	?>
	<div class="alert alert-danger alert-dismissable">
		<button class="close" aria-hidden="true" data-dismiss="alert">x</button>
		<?=$this->session->flashdata('user_fail');?>
	</div>
	<?php
}
?>
<br />

<br />
<table class="table table-bordered datatable" id="table-3">
	<thead>
		<tr class="replace-inputs">
			<th>Firstname</th>
			<th>Email-ID</th>
			<th>Username</th>
			<th>Usertype</th>
		</tr>
		<tr>
			<th>Firstname</th>
			<th>Email-ID</th>
			<th>Username</th>
			<th>Usertype</th>
			<th>Status</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php
			if($all_users)
			{
				foreach ($all_users as $key => $value)
				{
					$id = $value['id'];
					if($value['usertype']=="1")
						$type = "Home Owners";
					else if($value['usertype']=="2")
						$type = "Management Company";
					else if($value['usertype']=="3")
						$type = "Vendor";
					else if($value['usertype']=="4")
						$type = "Area Manager";

					if($value['published']==1)
					{
						$st = "<a style='color:lime'  title='Unpublish User'
										href='".base_url()."user/update_status/0/".$id."'>
										<i class='entypo-check'></i>
									</a>";
					}
					else
					{
						$st = "<a style='color:red' href='".base_url()."user/update_status/1/".$id."'>
										<i class='entypo-block'></i>
									</a>";
					}
					?>
						<tr>
							<td><?=$value['firstname'];?></td>
							<td><?=$value['email'];?></td>
							<td><?=$value['username'];?></td>
							<td><?=$type;?></td>
							<td style='text-align: center;'><?=$st;?></td>
							<td>
								<a title="Edit User" href="<?=base_url();?>user/add_user/<?=$id;?>">
									<i class="entypo-pencil"></i>
								</a>
									&nbsp;&nbsp;&nbsp;
								<a title="Delete User" href="#modal-4" data-toggle="modal" 
									data-href="<?=base_url()."user/del_row/".$id."/id/hoa_users";?>" class="del-btn">
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
				Are you sure want to delete this user?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<a href="#" class="btn modal-delete btn-danger">Delete</a>

			</div>
		</div>
	</div>
</div>