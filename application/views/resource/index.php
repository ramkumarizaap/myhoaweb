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
			<h2 class="margin-zero padd-zero">Resource Library</h2><br>
			<div class="col-md-12">
				<?php 
				if($this->session->userdata('login_data')['usertype']=="2")
					{
						?>
						<a href="<?=base_url();?>resource/category" class="btn theme-blue white">Add Category</a>
						<a href="<?=base_url();?>resource/document" class="btn theme-blue white">Add Documents</a>
						<?php 
					}
					?>
				<div class="row">
					<h3>Categories</h3>
					<ul class="resource_list">
						<?php 
						if($category)
						{
							foreach ($category as $key => $value)
							{
								$catname = str_replace(" ","",strtolower($value['cat_name']));
								$id = $value['id'];
								?>
									<li>
										<a href="<?=base_url();?>resource/library/<?=$catname."/".$id;?>"><img src="<?=base_url().$value['cat_img'];?>" width="30">&nbsp;&nbsp;<?=$value['cat_name'];?>
											<p><?=$value['cat_desc'];?></p>
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