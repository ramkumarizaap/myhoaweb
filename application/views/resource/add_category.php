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
			<h2 class="margin-zero padd-zero">Add Category</h2><br>
			<div class="col-md-12">
				<a href="<?=base_url();?>resource/list_category" class="btn theme-blue white">List Category</a>
				<form class="form-horizontal" method="post" action="<?=base_url();?>resource/add_category">
					<div class="row pad-top-30">
						<div class="form-group">
							<label class="col-md-2 control-label">Category Name :</label>
							<div class="col-md-10">
								<input type="text" class="form-control" name="cat_name">
								<span class="error"><?=form_error('cat_name');?></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Category Icon :</label>
							<div class="col-md-10">
								<input type="file" class="form-control" name="cat_img">
								<span class="error"><?=form_error('cat_img');?></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Category Description :</label>
							<div class="col-md-10">
								<textarea class="form-control" rows="6" name="cat_desc"></textarea>
								<span class="error"><?=form_error('cat_desc');?></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Community :</label>
							<div class="col-md-10">
								<select class="form-control select2-select  select2-hidden-accessible" name="community[]" aria-hidden="true" multiple="">
								<?php
									if($community)
									{
										foreach ($community as $key => $value) 
										{
											?>
												<option value="<?=$value['id'];?>"><?=$value['name'];?></option>
											<?php
										}
									}
									?>
								</select>
								<span class="error"><?=form_error('community[]');?></span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-2 col-md-offset-2">
								<input type="submit" class="btn theme-blue white" value="Create">
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>