<div class="container">
	<div class="row pad-top-20 text-center"><br><br>
		<h1>Choose Account Type</h1>
		<hr class="border-bottom-blue">
	</div>
	<div class="pad-top-20"></div>
	<div class="row">
		<div class="col-md-12 avatar-list text-center">
		<?php 
			if($accounts)
			{
				foreach ($accounts as $key => $value) 
				{
					?>
						<div class="col-md-4 pad-top-20">
							<a href="<?=base_url();?>registration/details/<?=$value['id'];?>">
								<div class="col-md-12">
									<img src="<?=base_url().$value['image'];?>">
								</div>
								<div class="col-md-12 account-title">
									<h3><?=$value['name'];?></h3>	
								</div>
							</a>
						</div>
					<?php 
				}
			}
			?>
		</div>
	</div>
</div>