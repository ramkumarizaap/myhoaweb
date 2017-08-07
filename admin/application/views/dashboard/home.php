<body class="page-body  page-fade" data-url="http://neon.dev">
	<hr />
		<div class="row">
			<div class="col-sm-3 col-xs-6">
				<a href="<?=base_url();?>user/manage_user">
					<div class="tile-stats tile-red">
						<div class="icon"><i class="entypo-users"></i></div>
						<div class="num" data-start="0" data-end="<?=get_counts('hoa_users','0')['count'];?>" data-postfix="" 
							data-duration="1500" data-delay="0"></div>
							<h3>Registered users</h3>
					</div>
				</a>
			</div>
		
			<div class="col-sm-3 col-xs-6">
				<div class="tile-stats tile-green">
					<a href="<?=base_url();?>events/manage_events">
						<div class="icon"><i class="entypo-calendar"></i></div>
						<div class="num" data-start="0" data-end="<?=get_counts('hoa_events')['count'];?>" data-postfix="" 	
							data-duration="1500" data-delay="600">0</div>
							<h3>Events</h3>
					</a>
				</div>
			</div>
			<div class="col-sm-3 col-xs-6">
				<div class="tile-stats tile-aqua">
					<a href="<?=base_url();?>classifieds/manage_classifieds">
						<div class="icon"><i class="entypo-sound"></i></div>
						<div class="num" data-start="0" data-end="<?=get_counts('hoa_classifieds')['count'];?>" data-postfix="" 
							data-duration="1500" data-delay="1200">0</div>
							<h3>Classifieds</h3>
					</a>
				</div>
			</div>
			<div class="col-sm-3 col-xs-6">
				<div class="tile-stats tile-blue">
					<a href="<?=base_url();?>community/manage_community">
						<div class="icon"><i class="entypo-globe"></i></div>
						<div class="num" data-start="0" data-end="<?=get_counts('hoa_community')['count'];?>" data-postfix="" 
							data-duration="1500" data-delay="1800">0</div>
							<h3>Community</h3>
						</div>
					</a>
				</div>
			</div>
