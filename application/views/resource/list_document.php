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
			<h2 class="margin-zero padd-zero">Documents List</h2><br>
			<div class="col-md-12">
				<?php
					if($this->session->flashdata('del_cat'))
					{
						?>
							<div class="alert alert-success alert-dismissable">
								<button class="close" aria-hidden="true" data-dismiss="modal">x</button>
									<strong>Success!</strong>Document Deleted.
							</div>
						<?php
					}
				?>
				<table class="table table-hover table-responsive">
					<thead>
						<th>SNO</th>
						<th>Name</th>
						<th>Description</th>
						<th>Category</th>
						<th>Actions</th>
					</thead>
					<tbody>
					<?php
					if($document)
					{
						$i=1;
						foreach ($document as $key => $value) 
						{
							$id = $value['id'];
							?>
								<tr>
									<td><?=$i++;?></td>
									<td><?=$value['title'];?></td>
									<td><?=$value['description'];?></td>
									<td><?=$value['cat_name'];?></td>
									<td>
										<a href="#"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;&nbsp;
										<a href="javascript:void(0);" class="del_cat" data-href="<?=base_url();?>resource/delete_document/<?=$id;?>" data-target="#DeleteModal" data-toggle="modal">
											<i class="glyphicon glyphicon-remove"></i>
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
<div id="DeleteModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete Category</a></h4>
      </div>
      <div class="modal-body">
      	<p>Are you Sure want to delete this document.</p>
    </div>
    <div class="modal-footer">
    	<button class="btn btn-primary" data-dismiss="modal">Cancel</button>
    	<a href="#" class="btn btn-danger">Delete</a>
    </div>
  </div>
</div>