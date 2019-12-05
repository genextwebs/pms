<html>
<head>

<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 <script>
	function countamount(counter)
	{
        var f1 = $('#qty'+counter).val();
		var f2 = $('#price'+counter).val();
		var mul = eval(f1)*eval(f2);
		$('#amount'+counter).val(mul);
		totalamount();
	}		
	function counttax(counter)
	{
		var f3 = $('#tax'+counter).val();
		if(f3 != '')
		{
			var f = $('#amount'+counter).val();
			var amount=f;
			var fa=(eval(amount)*eval(f3))/100;
			var finalamount =eval(amount)+(fa);
			$('#amount'+counter).val(eval(finalamount));
		}
			totalamount();
	}
	function totalamount()
	{
		var counter=$('#counter').val();
		var totalAmount=0;
		for(var i=1;i<=counter;i++)
		{
			var finalamount=$('#amount'+i).val();
			totalAmount=eval(totalAmount) + eval(finalamount);
		}
			document.getElementById("p").innerHTML = totalAmount;
					$('#txttotal').val(totalAmount);

	}
</script>
<style>
			label.error
			{
				color:red;
			}
			
</style>

<script>
$(function() {
  $("form[name='estimate']").validate({
      rules: {
      txtclient: "required",
      txtcurrency: "required",
	  txtvalidtill:"required",
	  txtnote:"required"
      },
    submitHandler: function(form) {
      form.submit();
    }
  });
});

</script>

</head>
<body>

		<form method="post" action="<?php echo  base_url('Estimates/insertestimaterecord') ?>" name="estimate">
			<div>
				<label>Client</label>
				<select name="txtclient">
				<option value="">select</option>
					<?php
						foreach($client as $row)
						{
							echo '<option value="'.$row->clientname.'">'.$row->clientname.'</option>';
						}
					?>
				</select>
				<label>Currency</label>
				<select name="txtcurrency">
						<option value="">select</option>
						<option value="1">$(USD)</option>
						<option value="2">R(IND)</option>
					</select>
				</label>Valid Till</label>
				<input type="date" name="txtvalidtill">
			</div>
			<div id="dynamic">
				<label>Item</label>
				<input type="text" name="txtitem[]">
				<label>Qty/Hrs</label>
				<input type="number" name="txtqtyhrs[]" id="qty1">
		
				<label>Unit Price</label>
				<input type="text" name="txtunitprice[]" id="price1" onblur="countamount(1)">
			
				<label>Tax</label><a href="<?php echo base_url('Estimates/viewtax') ?>">Add Tax</a>
				<select name="txttax[]" id="tax1" onchange="counttax(1);">
						<option value=" ">select</option>
						<?php
						foreach($tax as $row1)
						{
							echo '<option value="'.$row1->rate.'">'.$row1->taxname."(".$row1->rate."%)".'</option>';
						}
						?>
					</select>
				</label>Amount</label>
				<input type="text" name="txtamount[]" id="amount1">
		
				<label>Description</label>
				<textarea rows="7" cols="10" name="txtdescription[]"></textarea>
	
				<button type="button" id="btn" name="btn">ADD ITEM</button>
		</div>
			<input type="hidden" id="counter" value="1">
		<div>			
			<label>Total</label>
			<p id="p"></p>
			<input type="hidden" id="txttotal" name="txttotal">
			
			
			<label>Note</label>
			<textarea rows="7" cols="10" name="txtnote"></textarea>
		</div>
				<input type="submit" value="Save" name="btnsubmit">
				<input type="reset" value="Reset" name="btnreset">
		
	</form>
</body>
</html>
<script>
	$('#btn').click(function(){
			var counter=$('#counter').val();
			counter++;
			$('#counter').val(eval(counter));

		
			//('#counter').val=	counter++;
			$('#dynamic').append('<div id="row'+counter+'"><label>Item</label><input type="text" name="txtitem[]"><label>Qty/Hrs</label><input type="number" name="txtqtyhrs[]" id="qty'+counter+'"><label>Unit Price</label><input type="text" name="txtunitprice[]" id="price'+counter+'"  onblur="countamount('+counter+')"><label>Tax</label><a href="<?php echo base_url('Estimates/viewtax') ?>">Add Tax</a><select name="txttax[]" id="tax'+counter+'" onchange="counttax('+counter+');"><option value=" ">select</option><?php foreach($tax as $row1){ echo '<option value="'.$row1->rate.'">'.$row1->taxname."(".$row1->rate."%)".'</option>'; } ?></select><label>Amount</label><input type="text" name="txtamount[]" id="amount'+counter+'">Description<textarea rows="7" cols="10" name="txtdescription[]"></textarea><button type="button" name="remove" id="'+counter+'" class="remove">X</button></div>');
		});
		
		$(document).on('click','.remove',function(){
		
		var btn_id=$(this).attr("id");
		$("#row"+btn_id+'').remove();
	});

</script>