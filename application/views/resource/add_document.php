<div class="container">
	<div class="row pad-top-50">
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
			<h2 class="margin-zero padd-zero">Add Documents</h2><br>
			<div class="col-md-12">
				<a href="<?=base_url();?>resource/list_document" class="btn theme-blue white">List Documents</a>
				<form class="form-horizontal" method="post" action="<?=base_url();?>resource/add_document">
					<div class="row pad-top-30">
						<div class="form-group">
							<label class="col-md-2 control-label">Title :</label>
							<div class="col-md-10">
								<input type="text" class="form-control" name="title">
								<span class="error"><?=form_error('title');?></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Document :</label>
							<div class="col-md-10">
								<input type="file" class="form-control" name="document">
								<span class="error"><?=form_error('document');?></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Description :</label>
							<div class="col-md-10">
								<textarea class="form-control" rows="6" name="description"></textarea>
								<span class="error"><?=form_error('description');?></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Category :</label>
							<div class="col-md-10">
								<select class="form-control" name="category">
								<?php
									if($category)
									{
										foreach ($category as $key => $value) 
										{
											?>
												<option value="<?=$value['id'];?>"><?=$value['cat_name'];?></option>
											<?php
										}
									}
									?>
								</select>
								<span class="error"><?=form_error('category');?></span>
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