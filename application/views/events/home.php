<div class="container">
	<div class="row pad-top-50">
	</div>
	<div class="row pad-top-50 ">
		<?=$this->layout->getsidemenu();?>
		<div class="col-md-8">
			<h2 class="margin-zero padd-zero">Events</h2><br>
			<div class="col-md-12">
				<div class="input-group">
            <input type="text" class="form-control" placeholder="Search Events">
            <span class="input-group-btn">
                <button class="btn white theme-blue" type="button">Search</button>
            </span>
        </div><br>
        <div class="form-group pull-right">
        	<a href="<?=base_url();?>events/create_events" class="btn theme-blue white">
        		<i class="glyphicon glyphicon-plus"></i>&nbsp;&nbsp;Create Events</a>
        </div>
        <div class="row pad-top-50">
        	<ul class="event-list  padd-zero">
        	<?php 
        	if($events)
        	{
        		foreach ($events as $key => $value)
        		{
        			$id = $value['id'];
        			?>
	        		<li class="event-row">
	        			<div class="event-date bord-radius-4">
	        				<span class="month">AUG</span>
	        				<span class="date">26</span>
	        				<span class="year">2016</span>
	        			</div>
	        			<div class="col-md-7">
	        				<span class="title"><?=$value['name'];?></span><br>
	        				<span><i class="glyphicon glyphicon-map-marker"></i>&nbsp;&nbsp;<?=$value['address'];?></span><br><br>
	        				<div class="btn-group margin-bottom-10">
		                <a class="btn theme-blue white" href="javascript:;" data-toggle="dropdown" aria-expanded="false">
		                    Respond
		                    <i class="glyphicon glyphicon-chevron-down"></i>
		                </a>
		                <ul class="dropdown-menu eve-respond">
	                    <li><a href="<?=base_url();?>events/respond/<?=$id;?>/1"><i class="glyphicon glyphicon-ok"></i> Yes </a></li>
	                    <li><a href="<?=base_url();?>events/respond/<?=$id;?>/2"><i class="glyphicon glyphicon-remove"></i> No </a></li>
	                    <li><a href="<?=base_url();?>events/respond/<?=$id;?>/3"><i class="glyphicon glyphicon-refresh"></i> May be </a></li>
		                </ul>
		            </div>
                  <br><br>
	        				<span><i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;<?=$value['attendee'];?> Attendee</span>&nbsp;&nbsp;&nbsp;&nbsp;
	        				<span><i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;<?=$value['no'];?>  No</span>&nbsp;&nbsp;&nbsp;&nbsp;
	        				<span><i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;<?=$value['maybe'];?>  May Be</span>&nbsp;&nbsp;&nbsp;&nbsp;
	        			</div>
	        			<div class="col-md-3 pull-right text-right font-bold">
	        				<span><i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;Posted By</span><br>
	        				<?=$value['firstname'];?>
	        			</div>
	        		</li>
	        		<?php
	        	}
	        }
	        ?>
        	</ul>
        </div>
			</div>
		</div>
	</div>
</div>