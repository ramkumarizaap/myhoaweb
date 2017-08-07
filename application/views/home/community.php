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
	<div class="row pad-top-50 comm-page">
		<?=$this->layout->getsidemenu();?>
		<?php
		if($community)
		{
			?>
			<div class="col-md-8">
				<h2 class="margin-zero padd-zero"><?=$community['name'];?></h2><br>
				<div class="col-md-12">
					<?=$this->layout->gettoolbar();?>
					<br>
				</div>
				<div class="col-md-12 padd-zero margin-top-20 comm-banner">	
					<img src="<?=base_url().$community['banner'];?>">
					<div class="col-md-4 comm-options">
						<div class="btn-group margin-bottom-10">
              <a class="btn btn-danger active red" href="javascript:;" data-toggle="dropdown" aria-expanded="false">
                  <i class="glyphicon glyphicon-user"></i> Settings
                  <i class="glyphicon glyphicon-chevron-down"></i>
              </a>
              <ul class="dropdown-menu">
                  <li>
                    <a href="javascript:;">
                    <i class="glyphicon glyphicon-edit"></i> Edit Community </a>
                  </li>
                  <li>
                    <a href="javascript:;">
                    <i class="glyphicon glyphicon-remove"></i> Unpublish Community </a>
                  </li>
                  <li>
                    <a href="javascript:;">
                    <i class="glyphicon glyphicon-ban-circle"></i> Ban Community </a>
                  </li>
              </ul>
          	</div>
					</div>
					<div class="col-md-4 comm-picture">
						<a href="javascript:void(0);" data-toggle="modal" data-target="#PicModal"
						 class="btn theme-blue white">
							Change Picture
						</a>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12 margin-top-30">
            <?php
            if($this->session->flashdata('notify_succ')==TRUE)
            {
              ?>
              <div class="row">
                <div class="alert alert-info">
                 <button class="close" data-dismiss="alert" aria-hidden="true">x</button>
                  Emergency Notification sent successfully!!!
                </div>
              </div>
              <?php
            }
            ?>
						<div class="tabbable-line">
              <ul class="nav nav-tabs ">
                <li class="active">
                  <a aria-expanded="true" href="#tab_15_1" data-toggle="tab"> Activity Stream </a>
                </li>
                <li class="">
                  <a aria-expanded="false" href="#tab_15_2" data-toggle="tab"> Info </a>
                </li>
                <li class="">
                  <a aria-expanded="false" href="#tab_15_3" data-toggle="tab"> Documents </a>
                </li>
                <li class="">
                  <a aria-expanded="false" href="#tab_15_4" data-toggle="tab"> Emergency Notifications </a>
                </li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_15_1">
                	<div class="tabbable-custom ">
                    <ul class="nav nav-tabs ">
                      <li class="active">
                        <a href="#tab_5_1" data-toggle="tab" aria-expanded="true"> Share </a>
                      </li>
                      <li class="">
                        <a href="#tab_5_2" data-toggle="tab" aria-expanded="false"> Photos </a>
                      </li>
                      <li>
                        <a href="#tab_5_3" data-toggle="tab"> Videos </a>
                      </li>
                    </ul>
                    <div class="tab-content">
                      <div class="tab-pane active" id="tab_5_1">
                      	<form class="form-horizontal" method="post" 
                      		action="<?=base_url();?>home/share_post">
                      		<input type="hidden" name="comm_id" value="<?=$id;?>">
                      		<div class="form-group">
                      			<div class="col-md-12">
                      				<textarea class="form-control" rows="5" placeholder="Say Something...." name="message">Hi</textarea>
                      			</div>
                      		</div>
                      		<div class="form-group">      
                      			<div class="col-md-2 pull-right">               			
                      				<input type="submit" class="btn theme-blue white"
                      					value="Share">
                      			</div>
                      		</div>
                    		</form>
                      </div>
                      <div class="tab-pane" id="tab_5_2">
                        <form class="form-horizontal" method="post" 
                      		action="<?=base_url();?>home/share_post"
                      		enctype="multipart/form-data">
                      		<input type="hidden" name="comm_id" value="<?=$id;?>">
                      		<div class="form-group">
                      			<div class="col-md-12">
                      				<input type="file" name="userfile1" class="form-control">
                      			</div>
                      		</div>
                      		<div class="form-group">      
                      			<div class="col-md-2 pull-right">               			
                      				<input type="submit" class="btn theme-blue white"
                      					value="Share">
                      			</div>
                      		</div>
                    		</form>
                      </div>
                      <div class="tab-pane" id="tab_5_3">
                        <form class="form-horizontal" method="post" 
                      		action="<?=base_url();?>home/share_post"
                      		enctype="multipart/form-data">
                      		<input type="hidden" name="comm_id" value="<?=$id;?>">
                      		<div class="form-group">
                      			<div class="col-md-12">
                      				<input type="file" name="userfile2" class="form-control">
                      			</div>
                      		</div>
                      		<div class="form-group">      
                      			<div class="col-md-2 pull-right">               			
                      				<input type="submit" class="btn theme-blue white"
                      					value="Share">
                      			</div>
                      		</div>
                    		</form>  
                      </div>
                    </div>
                    <div class="row margin-top-30">
											<ul class="stream-list">
												<?php
													if($streams)
													{
														foreach ($streams as $key => $value)
														{
															?>
																<li>
																	<span class="from">
																		<?=ucwords($value['firstname']);?>&nbsp;&nbsp;
																		<i class="glyphicon glyphicon-arrow-right"></i>
																		&nbsp;&nbsp;
																		<?=ucwords($value['name']);?>
																	</span>
                                  <p class="font-11">
                                    <?=date("d M Y h:i a",strtotime($value['created_date']));?>
                                  </p>
																	<p>
																		<?php
																			if($value['message']!='')
																				echo ucwords($value['message']);
																			else if($value['photo']!='')
																			{
																				?>
																					<div class="photo">
																						<img src="<?=base_url().$value['photo'];?>">
																					</div>
																				<?php
																			}
																			else if($value['video']!='')
																			{
																				?>
																					<div class="video">
																						<video height="240" controls>
																						  <source src="<?=base_url().$value['video'];?>" type="video/mp4">
																						  Your browser does not support the video tag.
																						</video>
																					</div>
																				<?php
																			}
																		?>
																	</p>
																	<!--<p>
																		<a href="javascript:void(0);" 
																			class="btn theme-blue white" title="sad">
																		 <i class="glyphicon glyphicon-heart"></i>
																		 Like
																		</a>
																	</p>-->
																</li>
															<?php
														}
													}
												?>
											</ul>
										</div>
                	</div>
                </div>
                <div class="tab-pane" id="tab_15_2">
                	<h4>Address</h4>
                	<p>
                		<?=$community['address'];?>
                	</p>
                	<div class="col-md-12 padd-zero">
										<?php echo $map['js']; ?>
										<?php echo $map['html']; ?>
									</div>
                </div>
                <div class="tab-pane" id="tab_15_3">
                	<form class="form-horizontal" method="post" 
                		action="<?=base_url();?>home/document"
                		enctype="multipart/form-data">
	                		<input type="hidden" name="comm_id" value="<?=$id;?>">
	                	<div class="form-group">
	                		<input type="file" name="userfile1" class="form-control">
	                	</div>
	                	<div class="form-group col-md-2">
	                		<input type="submit" name="submit"	value="Submit"
	                		class="form-control btn theme-blue white">
	                	</div>
	                </form>
                	<table class="table table-responsive table-hover">
                		<thead>
                			<th>SNO</th>
                			<th>Name</th>
                			<th>Actions</th>
                		</thead>
                		<tbody>
                			<?php
                			if($docs)
                			{
                				$i=1;
                				foreach ($docs as $key => $value)
                				{
                					?>
                						<tr>
                						<td><?=$i++;?></td>
                						<td>
                						<a href="<?=base_url().$value['doc'];?>" target="_blank">
                							<?=str_replace("assets/docs/","",$value['doc']);?>
                						</a>
                						</td>
                						<td>
                							<a href="javascript:void(0);" class="del-doc"
                								data-id="<?=$value['id'];?>" data-field="id"
                								data-table="hoa_community_docs" >
                								<i class="glyphicon glyphicon-remove"></i>
                							</a>
                						</td>
                						</tr>
                					<?php
                				}
                			}
                			else
                			{
                				?>
	                			<tr>
	                				<td colspan="3">No Records Found</td>
	                			</tr>
	                			<?php
	                		}
	                		?>
                		</tbody>
                	</table>
                </div>
                 <div class="tab-pane" id="tab_15_4">
                  <a href="<?=base_url();?>home/create_notification/<?=$id;?>" 
                  class="theme-blue btn white">Post Emergency Notification</a>
                  <div class="row margin-top-30">
                    <ul class="stream-list">
                        <?php
                          if($notify)
                          {
                            foreach ($notify as $key => $value)
                            {
                              $id = $value['id'];
                              ?>
                                <li>
                                  <a href="<?=base_url();?>home/send_notification/<?=$value['id'];?>" 
                                    style="text-decoration:none;color:#000;">
                                    <span class="from">
                                      <?=ucwords($value['title']);?>&nbsp;&nbsp;
                                    </span>
                                  </a>
                                  <p class="font-11">
                                    <?=date("d M Y h:i a",strtotime($value['created_date']));?>
                                  </p>
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
				</div>				
			</div>
			<?php
		}
		?>
	</div>
</div>
<div id="PicModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Change Banner</h4>
      </div>
      <div class="modal-body">
      <div class="alert hide alert-dismissable">
      	<button class="close" data-dismiss="alert" aria-hidden="true">x</button>
      	<div class="msg"></div>
      </div>
      <form class="form-horizontal banner-form" method="post" 
        		enctype="multipart/form-data">
        		<input type="hidden" name="comm_id" value="<?=$id;?>">
        <br>
        <div class="row col-md-12">
        	<div class="form-group">
	            <label class="form-label col-md-12">Choose Banner</label>
            <div class="col-md-12">
              <input type="file" class="form-control" name="userfile1">
              <span class="error banner red"></span>
            </div>
          </div>
        </div><br>
      	<div class="form-group">
        	<div class="col-sm-offset-1">
          	<input type="submit" class="btn no-border banner-btn font-bold white theme-blue" value="Change Banner">
        	</div>
      	</div>
       </form>
      <hr>
    </div>
  </div>
</div>