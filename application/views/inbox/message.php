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
			<h2 class="margin-zero padd-zero">Inbox</h2><br>
			<div class="col-md-12">
				<a href="<?=base_url();?>inbox/" class="btn theme-blue white">Back</a><br><br>
				<form action="<?=base_url();?>inbox/create_reply" method="post" enctype="multipart/form-data">
				<input type="hidden" name="msg_id" value="<?=$msg_id;?>">
				<input type="hidden" name="row_id" value="<?=$row_id;?>">
				<input type="hidden" name="from_id" value="<?=$from_id;?>">
				<input type="hidden" name="to_id" value="<?=$to_id;?>">
	        <div class="form-group">
	          <label class="control-label">Reply</label>
	          <textarea class="form-control" name="message" rows="4">Hi</textarea>
	        </div>
	        <div class="form-group">
	          <label class="control-label">Attach Files</label>
	          <input type="file" name="userfile" class="form-control">
	        </div>
	        <div class="form-group">
	          <input type="submit" class="btn theme-blue white" value="Send">
	        </div>
	       </form>
        <div class="row messages_div pad-top-20 pad-bottom-30" style="border:1px solid #ccc;">
        	<?php 
        	if($messages)
        	{
        		foreach ($messages as $key => $value) 
        		{
        			?>
			        <div class="row">
			        	<div class="col-md-12 pad-left-30 pad-right-30">
			        		<div class="form-group list-msg pad-bottom-30">
			        			<label class="control-label"><?=$value['to_name'];?></label>
			        			<span class="pull-right remove_message" data-id="<?=$value['id'];?>">x</span>
			        			<p><strong>Subject</strong> : <?=$value['subject'];?></p>
			        			<p><strong>Message</strong> : <?=$value['message'];?></p>
			        			<?php
			        			if($value['file']!='')
			        			{
			        				?>
			        					<img src="<?=base_url().$value['file'];?>" width="200" height="120">
			        				<?php 
			        			}
			        			?>
			        		</div>
			        	</div>
			        </div>
		      		<?php 
		      	}
		      }
		      ?>
        </div>	
			</div>
     
		</div>
	</div>