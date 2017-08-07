<div class="container">
	<div class="row pad-top-50">
	<?php 
	?>
		<?php if($this->session->flashdata('class_succ'))
		{
			
			?>
			<div class="alert alert-info alert-dismissable text-center">
				<button class="close" data-dismiss="alert" aria-hidden="true">x</button>
					<strong>Success! Classifieds Added Successfully.</strong>
			</div>
			<?php 
		}
		?>
	</div>
	<div class="row pad-top-50">
		<?=$this->layout->getsidemenu();?>
		<?php 
		if($classifieds)
		{
			$img = explode(",",$classifieds['photos']);
			?>
			<div class="col-md-9">
				<h2 class="margin-zero"><?=$classifieds['ad_name'];?></h2><br>
				<span><i class="glyphicon glyphicon-map-marker"></i>
					<?=$classifieds['street1'].", ".$classifieds['street2'].", ".$classifieds['city'].", ".$classifieds['state'].", ".$classifieds['country'];?>
				</span>
				<div class="row">
					<div class="col-md-12 margin-top-30 padd-zero" style="cursor:pointer;">
						<div class="gallery">
          		<img src="<?=base_url();?>assets/images/classifieds/<?=$img[0];?>" onclick="lightbox(0)" style="width:auto; height:365px;" />
        		</div>
					</div>
					<div class="col-md-4 margin-top-20 pad-bottom-20 box-shadow margin-bottom-30">
						<h4 class="border-bottom-blue">Ad Details</h4>
						<span>
							<i class="glyphicon glyphicon-map-marker"></i>
							<?=$classifieds['street1'].", <br>".$classifieds['street2'].", <br>".$classifieds['city'].", <br>".$classifieds['state'].", ".$classifieds['country']." ".$classifieds['zipcode'] ;?>
						</span><br><br>
						<span>
							<i class="glyphicon glyphicon-time"></i>
							<?php
							 $c_date = date_create($classifieds['created_date']);
							 $date = date_create(date("Y-m-d H:i:s"));
							 $d=date_diff($c_date,$date);
							 echo $d->d. " days , ".$d->h." hours ago";
							?>
						</span><br><br>
						<span>
							<i class="glyphicon glyphicon-eye-open"></i>
							1 Views
						</span><br><br>
						<span>
							<i class="glyphicon glyphicon-print"></i>
							Print
						</span>
					</div>
					<div class="col-md-4 margin-top-20 pad-bottom-20 box-shadow margin-bottom-30 margin-left-60">
						<h4 class="border-bottom-blue">Advertiser Details</h4>
						<span>
							<?=$classifieds['firstname'];?>
						</span><br><br>
						<span>
							<i class="glyphicon glyphicon-envelope"></i>
							<?=$classifieds['email'];?>
						</span><br><br>
						<span>
							<i class="glyphicon glyphicon-phone"></i>
							+ <?=$classifieds['phone'];?>
						</span><br><br>
						<?php
						if($classifieds['user_id']!=$this->session->userdata('login_data')['id'])
						{
							?>
							<span>
								<a href="javascript:void(0);" data-target="#ContactAdvertiser"
									 class="btn theme-blue white" data-toggle="modal">
									Contact Advertiser
								</a>
							</span>
						<?php 
						}
						?>
					</div>
				</div>
				<div class="row margin-top-30 pad-bottom-20">
					<div class="col-md-12">
						<?php echo $map['js']; ?>
						<?php echo $map['html']; ?>
					</div>
				</div>
			</div>
			<div style="display:none;">
        <div id="ninja-slider">
          <div class="slider-inner">
            <ul>
            	<?php
            	foreach ($img as $key => $value)
            	{
            		?>
          			<li><a class="ns-img" href="<?=base_url();?>assets/images/classifieds/<?=$value;?>"></a></li>
          			<?php
          		}
          		?>
            </ul>
            <div id="fsBtn" class="fs-icon" title="Expand/Close"></div>
          </div>
        </div>
    </div>
			<?php
		}
		?>
	</div>
</div>
<div id="ContactAdvertiser" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Contact Advertiser</h4>
      </div>
      <div class="modal-body">
      <span class="error red invalid"></span>
        <br>
        <div class="row">
        	<div class="col-md-12 hide classified-msg">
         		<div class="alert alert-dismissable">
         			<button class="close" data-dismiss="alert" aria-hidden="true">x</button>
         			<div class="cl-msg"></div>
         		</div>
         	</div>
          <div class="form-group">
            <label class="form-label col-md-12">Email</label>
            <div class="col-md-12">
              <input type="email" class="form-control from_email" name="email" readonly value="<?=$this->session->userdata('login_data')['email'];?>">
              <span class="error username red"></span>
              <input type="hidden" class="to_email" value="<?=$classifieds['email'];?>">
            </div>
          </div>
        </div><br>
        <div class="row">
          <div class="form-group">
            <label class="form-label col-md-12">Message</label>
            <div class="col-md-12">
              <textarea class="form-control cl-desc" rows="5" name="desc"></textarea>
              <span class="error password red"></span>
            </div>
          </div>
        </div><br>
      </div>
      <div class="form-group">
        <div class="col-md-12">
          <input type="button" class="btn no-border classifieds-btn font-bold white theme-blue" value="Send">
        </div>
      </div>
      <hr>
    </div>
  </div>
</div>


<script type="text/javascript">
	/*Ninja Slider*/
function lightbox(idx)
 {
 	  //show the slider's wrapper: this is required when the transitionType has been set to "slide" in the ninja-slider.js
    var ninjaSldr = document.getElementById("ninja-slider");
    ninjaSldr.parentNode.style.display = "block";

    nslider.init(idx);

    var fsBtn = document.getElementById("fsBtn");
    fsBtn.click();
}
function fsIconClick(isFullscreen) { //fsIconClick is the default event handler of the fullscreen button
    var ninjaSldr = document.getElementById("ninja-slider");
    ninjaSldr.parentNode.style.display = isFullscreen ? "block" : "none";
}
/*Ninja Slider*/

</script>