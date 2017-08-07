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
				<div class="panel with-nav-tabs panel-primary">
	        <div class="panel-heading">
	          <ul class="nav nav-tabs">
	            <li class="active"><a href="#tab1primary" data-toggle="tab">Inbox</a></li>
	            <?php
	            if($this->session->userdata('login_data')['usertype']=="1")
	            {
	            	?>
	            		<li><a href="#tab2primary" data-toggle="tab">Compose</a></li>
	            		<?php
	             }
	            ?>
	          </ul>
	        </div>
          <div class="panel-body">
            <div class="tab-content">
              <div class="tab-pane fade in active" id="tab1primary">
              	<table class="table table-hover table-responsive inbox-table">
              		<thead>
              			<th width="250">Name</th>
              			<th width="250">Subject</th>
              			<th width="250">Date</th>
              		</thead>
              		<tbody>
              			<?php 
              			if($messages)
              			{
              				foreach ($messages as $key => $value) 
              				{
              					$class="";
              					if($this->session->userdata('login_data')['usertype']=="2")
              					{
              						if($value['admin_read']==0)
              							$class = "unread";
              					}
              					else if($this->session->userdata('login_data')['usertype']=="1")
              					{
              						if($value['user_read']==0)
              							$class = "unread";
              					}
	              				?>
	              				<tr class="<?=$class;?>" data-href="<?=base_url()."inbox/message/".$value['reply_id']."/".$value['id'];?>">
	              					<td><?=$value['firstname'];?></td>
	              					<td><?=$value['subject'];?></td>
	              					<td><?=date("m-d-Y h:i:s A",strtotime($value['created_date']));?></td>
	              				</tr>
	              				<?php
	              			}
              			}
              			else
              			{
              				echo "<tr><td><strong>No Messages Found!</strong></td></tr>";
              			}
              			?>
              		</tbody>
              	</table>
              </div>
              <div class="tab-pane fade in" id="tab2primary">
               	<form role="form" action="<?=base_url();?>inbox/create_message" enctype="multipart/form-data" method="post">
               		<div class="row">
	               		<div class="col-md-12">
	               			<div class="form-group">
	               				<label class="control-label">Subject</label>
	               				<select class="form-control" name="subject">
	               					<option value="Violation">Report for Violation</option>
	               					<option value="Emergency">Emergency</option>
	               					<option value="Help">Need Help</option>
	               				</select>
               				</div>
               				<div class="form-group">
               					<label class="control-label">Message</label>
               					<textarea class="form-control" name="message" rows="6">Hi</textarea>
               				</div>
               				<div class="form-group">
               					<label class="control-label">Attach Files</label>
               					<input type="file" class="form-control" name="userfile">
               				</div>
               				<div class="form-group">
               					<input type="submit" class="btn theme-blue white" value="Send Message">
               				</div>
               			</div>
               		</div>
               	</form>               
               </div>
            </div>
          </div>
        </div>
			</div>
		</div>
	</div>