<div class="row">
	<!-- Profile Info and Notifications -->
	<div class="col-md-6 col-sm-8 clearfix">
		<ul class="user-info pull-left pull-none-xsm">
			<!-- Profile Info -->
			<li class="profile-info dropdown"><!-- add class "pull-right" if you want to place this from right -->
				<a href="<?=base_url();?>home/" class="dropdown-toggle" data-toggle="dropdown">
					<img src="<?=base_url();?>assets/images/thumb-1@2x.png" alt="" class="img-circle" width="44" />
					<?=$users['firstname']." ".$users['lastname'];?>
				</a>	
				<ul class="dropdown-menu">
					<!-- Reverse Caret -->
					<li class="caret"></li>
					<!-- Profile sub-links -->
					<li>
						<a href="<?=base_url();?>profile">
							<i class="entypo-user"></i>
							Edit Profile
						</a>
					</li>
					<!--<li>
						<a href="mailbox.html">
							<i class="entypo-mail"></i>
							Inbox
						</a>
					</li>
					<li>
						<a href="extra-calendar.html">
							<i class="entypo-calendar"></i>
							Calendar
						</a>
					</li>
					<li>
						<a href="#">
							<i class="entypo-clipboard"></i>
							Tasks
						</a>
					</li>-->
				</ul>
			</li>
		</ul>
	</div>
	<!-- Raw Links -->
	<div class="col-md-6 col-sm-4 clearfix hidden-xs">
		<ul class="list-inline links-list pull-right">
			<!-- Language Selector -->
			<li>
				<a href="<?=base_url();?>login/logout">
					Log Out <i class="entypo-logout right"></i>
				</a>
			</li>
		</ul>
	</div>
</div>