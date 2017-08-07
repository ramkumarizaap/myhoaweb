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
	<div class="row pad-top-50">
		<?=$this->layout->getsidemenu();?>
		<div class="col-md-9">
			<h2 class="margin-zero">Create Events</h2><br><br>
			<form action="<?=base_url();?>events/add_events" method="post">
				<div class="row">
				<div class="col-md-12">
					<div class="row margin-bottom-30">
						<div class="form-group">
							<label class="col-md-3 control-label">Event Name <span class="red">*</span></label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="name" value="<?=set_value('name');?>">
								<span class="error red"><?=form_error('name');?></span>
							</div>
						</div>
					</div>
					<div class="row margin-bottom-30">
						<div class="form-group ">
							<label class="col-md-3 control-label">Description <span class="red">*</span></label>
							<div class="col-md-9">
								<textarea class="form-control" rows="10" name="desc"></textarea>
								<span class="error red"><?=form_error('desc');?></span>
							</div>
						</div>
					</div>
					<div class="row margin-bottom-30">
						<div class="form-group ">
							<label class="col-md-3 control-label">Address <span class="red">*</span></label>
							<div class="col-md-9">
								<textarea class="form-control" rows="5" name="address" value="<?=set_value('address');?>"></textarea>
								<span class="error red"><?=form_error('address');?></span>
							</div>
						</div>
					</div>
					<div class="row margin-bottom-30">
						<div class="form-group ">
							<label class="col-md-3 control-label">From Date <span class="red">*</span></label>
							<div class="col-md-9">
								<input type="text" class="form-control ip_date" name="from_date" value="<?=set_value('from_date');?>">
								<span class="error red"><?=form_error('from_date');?></span>
							</div>
						</div>
					</div>
					<div class="row margin-bottom-30">
						<div class="form-group ">
							<label class="col-md-3 control-label">To Date</label>
							<div class="col-md-9">
								<input type="text" class="form-control ip_date" name="to_date" value="<?=set_value('to_date');?>">
								<span class="error red"><?=form_error('to_date');?></span>
							</div>
						</div>
					</div>
					<div class="row margin-bottom-30">
						<div class="form-group ">
							<label class="col-md-3 control-label">Community</label>
							<div class="col-md-9">
								<select name="community[]" multiple="">
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
								<span class="error red"><?=form_error('community');?></span>
							</div>
						</div>
					</div>
					<div class="row margin-bottom-30">
						<div class="form-group col-md-12 col-md-offset-3">
							<input type="submit" name="submit" class="btn theme-blue white" value="Create Event">
						</div>
					</div>		

				</div>
				</div>
			</form>
		</div>
	</div>
</div>