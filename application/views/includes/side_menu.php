<?php
$cid =  $this->session->userdata('login_data')['code'];
$id =  $this->session->userdata('login_data')['id'];
$usertype =  $this->session->userdata('login_data')['usertype'];
$inbox = get_counts($id,$usertype,'inbox')['inbox'];
$event = get_counts($cid,'','events')['event'];
$classified = get_counts('','','classifieds')['classified'];
$form = get_counts($cid,'','forms')['form'];
?>
<div class="col-md-3">
	<ul class="main-nav">
		<li><a href="<?=base_url();?>">Home</a></li>
		<li><a href="<?=base_url();?>invoices">Invoices</a></li>
		<li>
			<a href="<?=base_url();?>classifieds">Classifieds
				<span class="count"><?=$classified;?></span>
			</a>
		</li>
		<li>
			<a href="<?=base_url();?>events">Events 
				<span class="count"><?=$event;?></span>
			</a>
		</li>
		<li>
			<a href="<?=base_url();?>inbox">Inbox 
				<span class="count"><?=$inbox;?></span>
			</a>
		</li>
		<li><a href="<?=base_url();?>resource/">Resource Library</a></li>
		<li>
			<a href="<?=base_url();?>form">Dynamic Form
			<span class="count"><?=$form;?></span>
			</a>
		</li>
	</ul>
</div>