<div class="container pad-top-20"><br>
	<div class="alert alert-success text-center alert-dismissable">
		<button class="close" data-dismiss="alert" aria-hidden="true">x</button>
		Your Current profile is <strong><?=$accounts[0]['name'];?></strong>, to change profile type 
			<a href="<?=base_url();?>registration/account_type">Click here</a>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div id="rootwizard">
				<div class="navbar">
					<div class="navbar-inner">					
							<ul class="nav nav-pills">
								<li class="active"><a href="#tab1" data-toggle="tab">Personal Details</a></li>
								<li><a href="#tab2" data-toggle="tab">Address</a></li>
							</ul>
					</div>
				</div>
				<form action="<?=base_url();?>registration/register" method="post">
				<input class="form-control" id="type" value="<?=$type;?>" name="type" type="hidden">
					<div class="tab-content">
						<div class="tab-pane active" id="tab1">
							<div class="progress">
								<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 30%;">
										30%
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<label for="name" class="col-md-2">First Name <span class="red">*</span></label>
									<div class="col-md-5">
										<input class="form-control" id="fname" name="fname" type="text">
										<span class="error fname red"></span>
									</div>
								</div>
							</div><br>
							<div class="row">
								<div class="form-group">
									<label for="name" class="col-md-2">Last Name <span class="red">*</span></label>
									<div class="col-md-5">
										<input class="form-control" id="lname" name="lname" type="text">
										<span class="error lname red"></span>
									</div>
								</div>
							</div><br>
							<div class="row">
								<div class="form-group">
									<label for="name" class="col-md-2">Username <span class="red">*</span></label>
									<div class="col-md-5">
										<input class="form-control" id="u_username" name="username" type="text">
										<span class="error username red"></span>
									</div>
								</div>
							</div><br>
							<div class="row">
								<div class="form-group">
									<label for="name" class="col-md-2">Email <span class="red">*</span></label>
									<div class="col-md-5">
										<input class="form-control" id="email" name="email" type="text">
										<span class="error email red"></span>
									</div>
								</div>
							</div><br>
							<div class="row">
								<div class="form-group">
									<label for="name" class="col-md-2">Password <span class="red">*</span></label>
									<div class="col-md-5">
										<input class="form-control" id="u_password" name="password" type="text">
										<span class="error password red"></span>
									</div>
								</div>
							</div><br>
							<div class="row">
								<div class="form-group">
									<label for="name" class="col-md-2">Verify Password <span class="red">*</span></label>
									<div class="col-md-5">
										<input class="form-control" id="v_password" name="v_password" type="text">
										<span class="error v_password red"></span>
									</div>
								</div>
							</div>				
						</div>
						<div class="tab-pane" id="tab2">
							<div class="progress">
								<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
										60%
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<label for="name" class="col-md-2">Community Code <span class="red">*</span></label>
									<div class="col-md-5">
										<input class="form-control pull-left" name="code" id="code" type="text">
										<span class="error comm_code red"></span>
									</div>
									<input type="button" class="btn theme-blue white verify_code pull-left" value="Verify">
								</div>
							</div><br>
							<div class="row">
								<div class="form-group">
									<label for="name" class="col-md-2">Address</label>
									<div class="col-md-5">
										<textarea class="form-control" name="address">
										</textarea>
									</div>
								</div>
							</div><br>
							<div class="row">
								<div class="form-group">
									<label for="name" class="col-md-2">Home Phone</label>
									<div class="col-md-5">
										<input class="form-control" name="phone" type="text">
									</div>
								</div>
							</div><br>
							<div class="row">
								<div class="form-group">
									<label for="name" class="col-md-2">Mobile Phone </label>
									<div class="col-md-5">
										<input class="form-control" name="mobile" type="text">
									</div>
								</div>
							</div><br>
							<div class="row">
								<div class="form-group">
									<label for="name" class="col-md-2">Introduce Yourself</label>
									<div class="col-md-5">
										<textarea class="form-control" name="yourself">
										</textarea>
									</div>
								</div>
							</div>				
						</div>
						<ul class="pager wizard">
							<li class="previous first disabled" style="display:none;"><a href="#">First</a></li>
							<!--<li class="previous disabled"><a href="#">Previous</a></li>
							<li class="next last" style="display:none;"><a href="#">Last</a></li>-->
							<li class="next col-md-offset-2 pull-left">
								<a href="#" class="btn next-btn no-border font-bold white theme-blue">Next</a>
							</li>
						</ul><br>
						<div class="register-btn form-group col-md-offset-2" style="display:none;">
							<button type="button" class="save-btn btn theme-blue white">Register</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

