<hr />
<ol class="breadcrumb bc-3">
	<li><a href="<?=base_url();?>home/"><i class="fa-home"></i>Home</a></li>
	<li><a href="<?=base_url();?>form/manage_form">Form</a></li>
	<li class="active"><strong>Enteries</strong></li>
</ol>
					
<h2>List Enteries</h2>
<a href="<?=base_url();?>form/manage_form" class="btn btn-primary">Back</a>
<br>
<div class="col-md-12">
	<h3><?=$form['form_name'];?></h3>
	<a href="<?=base_url();?>form/export/<?=$form['id'];?>" class="pull-right btn btn-info">Export to Excel</a>
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