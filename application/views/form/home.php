<div class="container">
	<div class="row pad-top-50">
	<?php 
	?>
		<?php if($this->session->flashdata('succ'))
		{
			
			?>
			<div class="alert alert-info alert-dismissable text-center">
				<button class="close" data-dismiss="alert" aria-hidden="true">x</button>
					Welcome <strong><?=$users['firstname'];?>!</strong>
			</div>
			<?php 
		}
		?>
	</div>
	<div class="row pad-top-50 ">
		<?=$this->layout->getsidemenu();?>
		<div class="col-md-8">
			<h2 class="margin-zero padd-zero">Form</h2><br>
			<div class="col-md-12">
				<div class="col-md-3 pull-right">
					<a href="javascript:void(0);" data-target="#FormModal" data-toggle="modal" class="btn theme-blue white">
						<i class="glyphicon glyphicon-plus"></i> Create Form
					</a>
				</div><br><br>
				<div class="row">
					<h4>List Forms</h4>
					<table class="table table-hover table-responsive">
						<thead>
							<th>SNO</th>
							<th width="400">Form Name</th>
							<th>Actions</th>
						</thead>
						<tbody>
							<?php
							if($forms)
							{
								$i=1;
								foreach($forms as $key => $value) 
								{
									$id = $value['id'];
									?>
										<tr>
											<td><?=$i++;?></td>
											<td><?=$value['form_name'];?></td>
											<td>
												<a href="<?=base_url();?>form/list_enteries/<?=$id;?>" title="List Enteries">
													<i class='glyphicon glyphicon-list'></i>
												</a>&nbsp;&nbsp;&nbsp;
												<a href='<?=base_url();?>form/view_form/<?=$id;?>' target="_blank" title="View Form">
													<i class='glyphicon glyphicon-eye-open'></i>
												</a>&nbsp;&nbsp;&nbsp;
												<a href="<?=base_url();?>form/home/<?=$id;?>"
													title="Edit Form">
													<i class='glyphicon glyphicon-edit'></i>
												</a>&nbsp;&nbsp;&nbsp;
												<a href="javascript:void(0);" data-id="<?=$id;?>" 
														class="del_form" title="Delete Form">
													<i class='glyphicon glyphicon-remove'></i>
												</a>
											</td>
										</tr>
									<?php
								}
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="FormModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Form Title</h4>
      </div>
      <div class="modal-body">
      	<form action="<?=base_url();?>form/create" method="post">
	      	<span class="error red invalid"></span>
	        <br>
	        <div class="row">
	          <div class="form-group">
	            <label class="form-label col-md-12">Form Name</label>
	            <div class="col-md-12">
	              <input type="text" class="form-control" name="form_name" id="form_name">
	              <span class="error form_name red"></span>
	            </div>
	          </div>
	        </div><br>
	     		<div class="form-group">
	        	<div class="col-md-12">
	          	<input type="submit" class="btn no-border login-btn font-bold white theme-blue" value="Create">
	        	</div>
	      	</div>
	      	<hr>
      	</form>
    	</div>
  	</div>
	</div>
</div>