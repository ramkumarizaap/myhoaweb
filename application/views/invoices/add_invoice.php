<div class="container pad-top-50">
	<div class="row pad-top-50 ">
		<?=$this->layout->getsidemenu();?>
		<div class="col-md-8">
			<h2 class="margin-zero padd-zero">Add Invoice</h2><br>
		</div>
		<div class="row">
			<br><br><br>
			<h4>Invoice Details</h4><br>
			<form class="form-horizontal" name="invoice">
				<div class="col-md-8">
					<div class="col-md-4">
					  <div class="form-group">
					    <label for="exampleInputName2">From Date</label>
					    <input type="text" name="from_date" class="form-control ip_date" placeholder="From Date">
					  </div>
					  <div class="form-group">
					    <label for="exampleInputName2">To Date</label>
					    <input type="text" name="to_date" class="form-control ip_date" placeholder="To Date">
					  </div>
					  <div class="form-group">
					    <label for="exampleInputEmail2">Status</label>
					    <select class="form-control" name="invoice_status">
					    	<option value="1">Draft</option>
					    	<option value="2">Open</option>
					    	<option value="3">Late</option>
					    	<option value="4">Paid</option>
					    	<option value="5">Processing</option>
					    </select>
					  </div><br>
					   <div class="form-group">
					    <a href="javascript:void(0);" data-target="#adduser" data-toggle="modal"
					    	class="btn theme-blue white">Add Home Owners</a>
					  </div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
						 	<table class="sel_results table table-responsive table-hover">
						 		<thead>
						 			<th>Name</th>
						 			<th>Address</th>
						 			<th>Email</th>
						 			<th>Actions</th>
						 		</thead>
						 	</table>
					  </div>
					</div>
					<div class="col-md-12">
						<h4>Items</h4>
						<a href="javascript:void(0);" class="add_item btn theme-blue white">Add New Item</a>
						<table class="item_table table table-hover table-responsive">
							<thead>
								<th width="70">Item ID</th>
								<th width="200">Item Name</th>
								<th width="30">Quantity</th>
								<th width="70">Price</th>
								<th width="70">Tax</th>
								<th>Total</th>
								<th>&nbsp;</th>
							</thead>
							<tbody>
								<tr name="line_items">
									<td><input type="text" name="item_id[]" class="form-control"></td>
									<td><input type="text" name="item_name[]" class="form-control"></td>
									<td><input type="text" name="qty[]" class="i_qty form-control"></td>
									<td><input type="text" name="price[]" class="i_price form-control"></td>
									<td><input type="text" name="tax[]" class="i_tax form-control"></td>
									<td><input type="text" name="item_total[]" class="form-control" 
											jAutoCalc="((({qty} * {price}) / 100) * {tax}) + ({qty} * {price})"></td>
									<td>&nbsp;</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="col-md-12">
						<div class="col-md-5">
							<div class="form-group">
								<label class="control-label">Description</label>
								<textarea class="form-control" name="description"></textarea>
							</div>
						</div>
						<div class="col-md-7 text-right">
								<label class="control-label">
									Sub Total:<input type="text" class="pull-right col-md-4"	jAutoCalc="SUM({item_total})" name="sub_total[]" >
								</label><br>
								<label class="control-label">
									Discount: 
									<input type="text" name="discount[]" class="pull-right col-md-3" value="0">
									</label>%<br>
								<label class="control-label">
									Total: 
									<input type="text" name="grand_total" jAutoCalc="(({sub_total} / 100) * {discount}) + {sub_total}"
										class="total_ip pull-right col-md-6">
								</label><br>
							</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<input type="submit" name="submit" value="Save Invoice" class="btn white
							theme-blue">
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<div id="adduser" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Home Owners</h4>
      </div>
      <div class="modal-body">
      	<div class="row">
      		<div class="col-md-12">
      			<div class="form-group">
      				<label class="control-label pull-left">Select Community</label>
      				<div class="col-md-4 pull-left">
      					<select class="form-control sel_community" name="sel_community">
      						<option value="">--Select Community--</option>
      						<?php 
      							if($community)
      							{
      								foreach ($community as $key => $value) 
      								{
      									?>
      										<option value="<?=$value['id'];?>"><?=$value['name'];?></option>
      									<?php 
      								}
      							}
      							?>
      					</select>
      				</div>
      			</div>
      		</div>
      	</div><br>
      	<div class="row refine_result hide">
      		<div class="col-md-12">
      			<a href="javascript:void(0);" class="btn sel_all_user theme-blue white">Select All</a>
      			<a href="javascript:void(0);" class="btn hide usel_all_user theme-blue white">Unselect All</a>
      			<a href="javascript:void(0);" class="btn theme-blue done_sel white">Done Selected</a>
      			<table class="ref_result table table-hover table-responsive">
      				<thead>
      					<th>#</th><th>Name</th><th>Address</th><th>Email</th>
      					<th>&nbsp;</th>
      				</thead>
      				<tbody>
      				</tbody>
      			</table>
      		</div>
      	</div>
      </div>
    </div>
  </div>
</div>