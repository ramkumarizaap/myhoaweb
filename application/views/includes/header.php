<header>
	<div class="col-md-12 head-nav">
		<div class="head-logo col-md-2">
			<a href="<?=base_url();?>">
				<img src="<?=base_url();?>assets/images/logo1.png" width="100">
			</a>
		</div>
    <?php 
    if($this->session->userdata('login_data')['id']=="")
    {
      ?>
		    <div class="col-md-3 pull-right user-panel">
			<a href="javascript:void(0);" data-target="#squarespaceModal" data-toggle="modal"  class="pull-right">
				<i class="glyphicon glyphicon-lock"></i>
				Sign In
			</a>
			<a href="<?=base_url();?>registration/account_type" class="pull-right">
				<i class="glyphicon glyphicon-user"></i>
				Create Account
			</a>
		    </div>
        <?php 
    }
    else
    {
      $users = get_user($this->session->userdata('login_data')['id']);
      ?>
        <div class="col-md-3 pull-right text-right white pad-top-10">
          <p>Hi <strong><?=$users['firstname'];?></strong>, <a href="<?=base_url();?>home/logout">Logout</a></p>
        </div>
      <?php
    }?>
	</div>
</header>
<div id="squarespaceModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Sign In or <a href="#">Create Account</a></h4>
      </div>
      <div class="modal-body">
      <span class="error red invalid"></span>
        <br>
        <div class="row">
          <div class="form-group">
            <label class="form-label col-md-12">Username</label>
            <div class="col-md-12">
              <input type="text" class="form-control" name="username" id="username">
              <span class="error username red"></span>
            </div>
          </div>
        </div><br>
        <div class="row">
          <div class="form-group">
            <label class="form-label col-md-12">Password</label>
            <div class="col-md-12">
              <input type="password" class="form-control" value="" name="password" id="password">
              <span class="error password red"></span>
            </div>
          </div>
        </div><br>
        <div class="row">
          <div class="form-group">
            <label class="form-label col-md-12">
              <input type="checkbox">&nbsp;&nbsp;Remember Me</label>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-1">
          <input type="button" class="btn no-border login-btn font-bold white theme-blue" value="Login">
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="form-group col-md-offset-1 login-modal-footer">
          <a href="<?=base_url();?>home/forgot/password/" class="col-md-12">Forgot your password?</a>
          <a href="<?=base_url();?>home/forgot/username/" class="col-md-12">Forgot your username?</a>
          <a href="#" class="col-md-12">Create account</a>
        </div>
      </div><br>
    </div>
  </div>
</div>