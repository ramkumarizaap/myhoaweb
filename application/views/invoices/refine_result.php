<?php 
if($com_user)
{
	foreach ($com_user as $key => $value) 
	{
		?>
			<tr>
				<td><input type="checkbox"></td>
				<td><?=$value['firstname']." ".$value['lastname'];?>
				<input type="hidden" name="user_id[]" value="<?=$value['id'];?>"></td>
				<td><?=$value['address'];?></td>
				<td><?=$value['email'];?></td>
				<td><a href="javascript:void(0);" class="btn white rem_user sel_user theme-blue">Select</a>
			</tr>
		<?php
	}
}
else
{
	echo "Fail";
}
?>

<script type="text/javascript">
	$(".ref_result a.sel_user").click(function(){
		//alert();
	});
	$(".sel_results a.rem_user").click(function(){
		$(this).parent().parent().remove();
	});
</script>