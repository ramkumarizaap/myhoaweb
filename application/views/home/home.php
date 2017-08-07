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
			<h2 class="margin-zero padd-zero">Home</h2><br>
			<div class="col-md-12">
				<?=$this->layout->gettoolbar();?>
				<br>
			</div>
			<div class="col-md-12">
				<div class="col-md-3 pull-right text-right margin-zero padd-zero">
					<a href="<?=base_url();?>community/create" class="btn theme-blue white">
						Create Community
					</a>
				</div><br><br>
				<?php
				if($this->session->flashdata("comm_succ")==TRUE)
				{
					?>
					<div class="col-md-12">
						<div class="alert alert-success">
							<button class="close" data-dismiss="alert" aria-hidden="true">x</button>
							<?=$this->session->flashdata("comm_succ");?>
						</div>
					</div>
					<?php 
				}
				?>
			</div>
			<div class="col-md-12 margin-top-20">
				<ul class="community-list">
				<?php 
				if($community)
				{
					foreach ($community as $key => $value)
					{
						$id = $value['id'];
					 ?>
						<li>
							<a href="<?=base_url();?>home/community/<?=$id;?>">
								<div class="col-md-2 padd-zero">
									<img src="<?=base_url();?>assets/images/classifieds/1.jpg">
								</div>
								<div class="col-md-8">
									<h4><?=$value['name'];?></h4><br>
									<div class="col-md-3 padd-zero font-11">
										<i class="glyphicon glyphicon-user"></i>
										<?=$value['members'];?> Members
									</div>
									<div class="col-md-3 padd-zero font-11">
										<i class="glyphicon glyphicon-calendar"></i>
										2 Events
									</div>
								</div>
								<div class="col-md-2 comm-code">
									<?=$value['code'];?>
								</div>
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