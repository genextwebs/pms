<html>
<body>

<form method="post"  enctype="multipart/form-data">
		<div>
				<label>Choose member</label>
				<select name="txtmember">
				<option value="">select</option>
					<?php
						foreach($employee as $row)
						{
							$str="";
							if($row->employeename==$expense[0]->employee)
							{
								$str="selected";
							}
							echo '<option value="'.$row->employeename.'"'.$str.'>'.$row->employeename.'</option>';
						}
					?>
				</select>
		</div>
		<div>
					<label>Project</label>
				<select name="txtproject">
				<option value="">select</option>
					<?php
						foreach($project as $row)
						{
							$str="";
							if($row->projectname==$expense[0]->project)
							{
								$str="selected";
							}
							
							echo '<option value="'.$row->projectname.'"'.$str.'>'.$row->projectname.'</option>';
						}
					?>
				</select>
		</div>
		<div>
				<label>Currency</label>
				<select name="txtcurrency">
						<option value="">select</option>
				<option value="0" <?php if($expense[0]->status=='0'){ echo 'selected'; } ?>>Dollar</option>
				<option value="1" <?php if($expense[0]->status=='1'){ echo 'selected'; } ?>>Pound</option>
				<option value="2" <?php if($expense[0]->status=='2'){ echo 'selected'; } ?>>Rupee</option>
				<option value="3" <?php if($expense[0]->status=='3'){ echo 'selected'; } ?>>Europs</option>
				</select>
		</div>
		<div>
				<label>Item Name</label>
				<input type="text" name="txtitem" value="<?php echo !empty($expense[0]->item) ? $expense[0]->item : '' ?>">
		</div>
		<div>
				<label>Price</label>
				<input type="text" name="txtprice" value="<?php echo !empty($expense[0]->price) ? $expense[0]->price : '' ?>">
		</div>
		<div>
				<label>Purchased form</label>
				<input type="text" name="txtpurchaseform" value="<?php echo !empty($expense[0]->purchasedform) ? $expense[0]->purchasedform : '' ?>">
		</div>
		<div>
				<label>Purchase Date</label>
				<input type="text" name="txtpurchasedate" value="<?php echo !empty($expense[0]->purchasedate) ? $expense[0]->purchasedate : '' ?>">
		</div>
		<div>
				<label>Invoice</label>
				<input type="file" name="file" id="file">
				<input type="hidden" name="image_name" >
				<label><?php echo !empty($expense[0]->invoicefile) ? $expense[0]->invoicefile : '' ?></label>

		</div>
		<div>
			<label>Status</label>
				<select name="txtstatus">
				<option ="">select</option>
				<option value="0" <?php if($expense[0]->status=='0'){ echo 'selected'; } ?>>Pending</option>
				<option value="1" <?php if($expense[0]->status=='1'){ echo 'selected'; } ?>>Approved</option>
				<option value="2" <?php if($expense[0]->status=='2'){ echo 'selected'; } ?>>Rejected</option>
				</select>
		</div>

		<div>
				<input type="submit" name="btnupdate" value="Update">
				<input type="reset" name="btnreset" value="Reset">

		</div>
</form>
</body>
</html>		