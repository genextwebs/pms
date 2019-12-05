<html>
<head>
<style>
			label.error
			{
				color:red;
			}
			
</style>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
</head>
<script>
$(function() {
  $("form[name='expense']").validate({
      rules: {
      txtmember: "required",
      txtproject: "required",
	  txtcurrency:"required",
	  txtitem:"required",
      txtprice:"required",
	  txtpurchaseform:"required",
	  file:"required"
	  },
    submitHandler: function(form) {
      form.submit();
    }
  });
});

</script>

<body>
<form method="post" name="expense" action="<?php echo  base_url('Estimates/insertexpenserecord') ?>" enctype="multipart/form-data" >
		<div>
				<label>Choose member</label>
				<select name="txtmember">
				<option value="">select</option>
					<?php
						foreach($employee as $row)
						{
							echo '<option value="'.$row->employeename.'">'.$row->employeename.'</option>';
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
							echo '<option value="'.$row->projectname.'">'.$row->projectname.'</option>';
						}
					?>
				</select>
		</div>
		<div>
				<label>Currency</label>
				<select name="txtcurrency">
						<option value="">select</option>
						<option value="0">Dollars</option>
						<option value="1">Pounds</option>
						<option value="2">Rupee</option>
						<option value="3">Europs</option>
				</select>
		</div>
		<div>
				<label>Item Name</label>
				<input type="text" name="txtitem">
		</div>
		<div>
				<label>Price</label>
				<input type="text" name="txtprice">
		</div>
		<div>
				<label>Purchased form</label>
				<input type="text" name="txtpurchaseform">
		</div>
		<div>
				<label>Purchase Date</label>
				<input type="text" name="txtpurchasedate"  value="<?php echo date('Y-m-d'); ?>">
		</div>
		<div>
				<label>Invoice</label>
				<input type="file" name="file" id="file">
		</div>
		<div>
				<input type="submit" name="btnsubmit" value="Save">
				<input type="reset" name="btnreset" value="Reset">

		</div>
</form>
</body>
</html>		