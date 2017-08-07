<div class="sidebar-menu">
	<div class="sidebar-menu-inner">
		<header class="logo-env">
			<!-- logo -->
			<div class="logo">
				<a href="<?=base_url();?>home/">
					<img src="<?=base_url();?>assets/images/logo1.png" width="120" alt="" />
				</a>
			</div>
			<!-- logo collapse icon -->
			<div class="sidebar-collapse">
				<a href="#" class="sidebar-collapse-icon"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
					<i class="entypo-menu"></i>
				</a>
			</div>				
			<!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
			<div class="sidebar-mobile-menu visible-xs">
				<a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
					<i class="entypo-menu"></i>
				</a>
			</div>
		</header>
		<ul id="main-menu" class="main-menu">
			<li class="user">
				<a href="<?=base_url();?>users/">
					<i class="entypo-user"></i>
					<span class="title">Users</span>
				</a>
				<ul>
					<li>
						<a href="<?=base_url();?>user/add_user/">
							<span class="title">Add User</span>
						</a>
					</li>
					<li>
						<a href="<?=base_url();?>user/manage_user">
							<span class="title">Manage User</span>
						</a>
					</li>
					<li>
						<a href="<?=base_url();?>user/inactive_user">
							<span class="title">Inactive Users</span>
						</a>
					</li>
				</ul>
			</li>
			<li class="community">
				<a href="<?=base_url();?>community/">
					<i class="entypo-globe"></i>
					<span class="title">Community</span>
				</a>
				<ul>
					<li>
						<a href="<?=base_url();?>community/add_community/">
							<span class="title">Add Community</span>
						</a>
					</li>
					<li>
						<a href="<?=base_url();?>community/manage_community">
							<span class="title">Manage Community</span>
						</a>
					</li>
					<li>
						<a href="<?=base_url();?>community/inactive_community">
							<span class="title">Inactive Community</span>
						</a>
					</li>
				</ul>
			</li>

			<li class="classifieds">
				<a href="<?=base_url();?>classifieds/">
					<i class="entypo-sound"></i>
					<span class="title">Classifieds</span>
				</a>
				<ul>
					<li>
						<a href="<?=base_url();?>classifieds/add_classifieds/">
							<span class="title">Add Classifieds</span>
						</a>
					</li>
					<li>
						<a href="<?=base_url();?>classifieds/manage_classifieds">
							<span class="title">Manage Classifieds</span>
						</a>
					</li>
				</ul>
			</li>
			<li class="events">
				<a href="<?=base_url();?>events/">
					<i class="entypo-calendar"></i>
					<span class="title">Events</span>
				</a>
				<ul>
					<li>
						<a href="<?=base_url();?>events/add_events/">
							<span class="title">Add Events</span>
						</a>
					</li>
					<li>
						<a href="<?=base_url();?>events/manage_events">
							<span class="title">Manage Events</span>
						</a>
					</li>
				</ul>
			</li>
			<li class="form">
				<a href="<?=base_url();?>form/">
					<i class="entypo-doc-text-inv"></i>
					<span class="title">Dynamic Form</span>
				</a>
				<ul>
					<li>
						<a href="<?=base_url();?>form/add_form/">
							<span class="title">Add Form</span>
						</a>
					</li>
					<li>
						<a href="<?=base_url();?>form/manage_form">
							<span class="title">Manage Form</span>
						</a>
					</li>
				</ul>
			</li>
			<li class="inbox">
				<a href="<?=base_url();?>inbox/">
					<i class="entypo-mail"></i>
					<span class="title">Inbox</span>
				</a>
				<ul>
					<!--<li>
						<a href="<?=base_url();?>inbox/compose">
							<span class="title">Compose</span>
						</a>
					</li>-->
					<li>
						<a href="<?=base_url();?>inbox/manage_inbox">
							<span class="title">Inbox</span>
						</a>
					</li>
				</ul>
			</li>
				<li class="library">
				<a href="<?=base_url();?>library/">
					<i class="entypo-book"></i>
					<span class="title">Resource Library</span>
				</a>
				<ul>
					<li>
						<a href="<?=base_url();?>library/manage_category">
							<span class="title">Categories</span>
						</a>
					</li>
					<li>
						<a href="<?=base_url();?>library/manage_documents">
							<span class="title">Documents</span>
						</a>
					</li>
					<!--<li>
						<a href="<?=base_url();?>library/manage_files">
							<span class="title">Files</span>
						</a>
					</li>-->
				</ul>
			</li>
		</ul>
	</div>
</div>