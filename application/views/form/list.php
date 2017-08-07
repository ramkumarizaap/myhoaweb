 <div class="container">
 	<div class="row pad-top-50">
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
				<h3><?=$form['form_name'];?></h3>
				<a href="<?=base_url();?>form/export/<?=$form['id'];?>" class="pull-right btn white theme-blue">Export to Excel</a>
				<ul class="list-entry">
					<?php
						if($values)
						{
							foreach ($values as $key => $value) 
							{
								echo "<li>";
								$data = json_decode($value['data']);
								foreach ($data as $label => $value) 
								{
									echo "<strong>$label : </strong>$value<br>";
								}
								echo "</li>";
							}
						}
					?>
				</ul>
			</div>
	</div>
 </div>