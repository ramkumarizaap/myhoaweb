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
			<h2 class="margin-zero padd-zero"><?=ucwords($category);?></h2><br>
			<div class="col-md-12">
				<ul class="library-doc">
					<?php
					if($documents)
					{
						foreach ($documents as $key => $value) 
						{
							$id=$value['id'];
							$title = str_replace(" ","_",strtolower($value['title']));
							?>
								<li>
									<a href="<?=base_url()."resource/libraries/".$title."/".$id;?>">
										<h3><?=$value['title'];?></h3>
										<span>Published on <?=date("d M Y",strtotime($value['created_date']));?></span>
										<p><?=$value['description'];?></p>
									</a>
								</li>
							<?php
						}
					}
					?>
				</ul>
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