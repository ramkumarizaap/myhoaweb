<div class="container pad-top-50">
	<div class="row pad-top-50 ">
		<?=$this->layout->getsidemenu();?>
		<div class="col-md-8">
			<h2 class="margin-zero padd-zero">Invoices</h2><br>
		</div>
		<div class="col-md-8">
			<table class="table table-responsive table-striped table-hover">
				<thead>
					<th>#</th>
					<th>SNO</th>
					<th>Date</th>
					<th>Amount</th>
					<th>Status</th>
					<th width="200">Actions</th>
				</thead>
				<tbody>
					<tr>
						<td><input type="checkbox"></td>
						<td>1</td>
						<td>2016-08-09</td>
						<td>$50.00</td>
						<td>
							<span class="inv_status due-st">due</span>
						</td>
						<td>
							<a href="#"><img src="<?=base_url();?>assets/images/pay-now.png"></a>
							<a href="#"><i class="glyphicon glyphicon-edit"></i></a>
						</td>
					</tr>
				</tbody>		
			</table>
		</div>
		<div class="col-md-8">
			<a href="<?=base_url();?>invoices/create" class="btn theme-blue white">Add Invoice</a>
		</div>
	</div>
</div>