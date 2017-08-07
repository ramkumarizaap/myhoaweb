<div class="container">
	<div class="row pad-top-50">
	<?php 
	?>
		<?php if($this->session->flashdata('class_succ'))
		{
			
			?>
			<div class="alert alert-info alert-dismissable text-center">
				<button class="close" data-dismiss="alert" aria-hidden="true">x</button>
					<strong>Success! Classifieds Added Successfully.</strong>
			</div>
			<?php 
		}
		?>
	</div>
	<div class="row pad-top-50 ">
		<?=$this->layout->getsidemenu();?>
		<div class="col-md-8">
			<h2 class="margin-zero padd-zero">Classifieds</h2><br>
			<div class="col-md-12">
				<div class="row">
					<form action="<?=base_url();?>classifieds" method="post">
						<div class="input-group input-group-sm">
	            <input class="form-control" placeholder="Search Classifieds"
	            		 type="text" name="search" value="<?=set_value('search');?>">
	            <span class="input-group-btn">
	                <button class="btn theme-blue white" type="submit">
	                	<i class="glyphicon glyphicon-search"></i>
	                </button>
	            </span>
		        </div>
		       </form>
				</div><br>
				<div class="row">
					<div class="col-md-3 pull-right">
						<a href="<?=base_url();?>classifieds/create_classifieds" class="btn theme-blue white">Create Classifieds</a>
					</div>
				</div>
				<div class="row pad-top-50">
					<?php 
					if($classifieds)
					{
						?>
						<ul class="classified-ul">
							<?php
							foreach ($classifieds as $key => $value)
							{
								$img = explode(",",$value['photos']);
								$id = $value['id'];
								?>
								<li>
									<a href="<?=base_url();?>classifieds/view/<?=$id;?>">
										<div class="col-md-2" style="border:1px solid #aaa;padding:0;">
											<img src="<?=base_url()."assets/images/classifieds/".$img[0];?>" style="width:99px;height:70px;">
										</div>
										<div class="col-md-8">
											<span class="title"><?=$value['ad_name'];?></span><br>
											<span class="address">
												<i class="glyphicon glyphicon-map-marker"></i>
												<?=$value['street1'].", ".$value['city'].", ".$value['state'].", ".$value['country'];?>
											</span>
										</div>
										<div class="col-md-2 text-right">
											<span class="posted">Posted By<br>
											<?=$value['firstname'];?>
											</span>
										</div>
									</a>
								</li>
								<?php
							}
							?>
						</ul>
						<?php
					}
					else
					{
						echo "No Classifieds Found.";
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>