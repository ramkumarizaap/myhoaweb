<hr />
<ol class="breadcrumb bc-3">
	<li><a href="<?=base_url();?>home/"><i class="fa-home"></i>Home</a></li>
	<li><a href="<?=base_url();?>home/user/manage_user">Community</a></li>
	<li class="active"><strong>Inactive Communities</strong></li>
</ol>
					
<h2>Inactive Community List</h2>
<br />		
<br />
<table class="table table-bordered datatable" id="table-3">
	<thead>
		<tr class="replace-inputs">
			<th>Community Name</th>
			<th>Community Code</th>
			<th>Created By</th>		
		</tr>
		<tr>
			<th>Community Name</th>
			<th>Community Code</th>
			<th>Created By</th>
			<th>Status</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php
			if($community)
			{
				foreach ($community as $key => $value)
				{
					$id = $value['id'];
					if($value['status']==0)
					{
						$st = "<a href='".base_url()."community/update_status/1/".$id."'>
										<i class='entypo-check'></i>
									</a>";
					}
					else
					{
						$st = "<a style='color:red' title='Publish User'
										href='".base_url()."community/update_status/0/".$id."'>
										<i class='entypo-block'></i>
									</a>";
					}
					?>
						<tr>
							<td><?=$value['name'];?></td>
							<td><?=$value['code'];?></td>
							<td><?=$value['firstname']." (".$value['usertype'].")";?></td>
							<td style='text-align: center;'><?=$st;?></td>
							<td>
								<a title="Edit Community" href="<?=base_url();?>community/add_community/<?=$id;?>">
									<i class="entypo-pencil"></i>
								</a>
									&nbsp;&nbsp;&nbsp;
								<a title="Delete Community" href="#modal-4" data-toggle="modal" 
									data-href="<?=base_url()."/community/del_row/".$id."/id/hoa_community";?>" class="del-btn">
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
				Are you sure want to delete this community?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<a href="#" class="btn modal-delete btn-danger">Delete</a>

			</div>
		</div>
	</div>
</div>