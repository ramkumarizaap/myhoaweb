<div class="modal-header">
	<h4 class="modal-title"><?=$msg['subject'];?></h4>
</div>
<div class="modal-body">
	<?php
	 echo $msg['message']."<br><br><br>";
	 if($msg['file']!='')
	  echo "<img src='../../".$msg['file']."' style='height:200px;width:225px;'>";
	?>
</div>