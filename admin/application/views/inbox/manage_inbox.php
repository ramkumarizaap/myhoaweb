<hr />
<ol class="breadcrumb bc-3">
	<li><a href="<?=base_url();?>home/"><i class="fa-home"></i>Home</a></li>
	<li><a href="<?=base_url();?>inbox/manage_inbox">Inbox</a></li>
	<li class="active"><strong>Manage Inbox</strong></li>
</ol>
					
<h2>Inbox List</h2>
<br />

<br />
<table class="table table-bordered datatable" id="table-3">
	<thead>
		<tr class="replace-inputs">
			<th width="250">From Name</th>
			<th width="250">To Name</th>
			<th>Subject</th>
			<th width="160">Date</th>
		</tr>
		<tr>
			<th>From Name</th>
			<th>To Name</th>
			<th>Subject</th>
			<th>Date</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php
			if($inbox)
			{
				foreach ($inbox as $key => $value)
				{
					$id = $value['id'];
					?>
						<tr>
							<td>
								<?php
									$from = get_user($value['from_id']);
									echo $from['firstname']." ( ".$from['email']." )";
								?>
							</td>
							<td>
							<?php
									$from = get_user($value['to_id']);
									echo $from['firstname']." ( ".$from['email']." )";
								?>
							</td>
							<td><?=$value['subject'];?></td>
							<td><?=date("d M Y h:i:s a",strtotime($value['created_date']));?></td>
							<td>
								<a href="javascript:void(0);" data-toggle="modal" data-target="#modal-5" class="view-msg" data-id="<?=$id;?>" >
									<i class="entypo-eye"></i>
								</a>&nbsp;&nbsp;&nbsp;&nbsp;
								<a href="javascript:void(0);" data-toggle="modal" data-target="#modal-4" data-href="<?=base_url()."inbox/del_row/".$id."/id/hoa_messages";?>" >
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