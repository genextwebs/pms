<html>
<head>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
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

</head>
<body>

		<form method="post">
			<div>
				<label>Client</label>
				<select name="txtclient">
				<option value="">select</option>
					<?php
						foreach($client as $row)
						{
							$str='';
							if($row->clientname==$estimate[0]->client)
							{
								$str="selected";
							
							}
							echo '<option value="'.$row->clientname.'"'.$str.'>'.$row->clientname.'</option>';
						}
					?>
				</select>
				<label>Currency</label>
				<select name="txtcurrency">
				<option>select</option>
				<option value="1" <?php if($estimate[0]->currency=='1'){ echo 'selected'; } ?>>$(USD)</option>
				<option value="2" <?php if($estimate[0]->currency=='2'){ echo 'selected'; } ?>>R(IND)</option>
				

				</select>
				<label>Valid Till</label>
				<input type="date" name="txtvalidtill" value="<?php echo !empty($estimate[0]->validtill) ? $estimate[0]->validtill : '' ?>">
				<label>Status</label>
				<select name="txtstatus">
					<option value="1" <?php if($estimate[0]->status=='1'){ echo 'selected'; } ?>>Accepted</option>
					<option value="0" <?php if($estimate[0]->status=='0'){ echo 'selected'; } ?>>Waiting</option>
					<option value="2" <?php if($estimate[0]->status=='2'){ echo 'selected'; } ?>>Declined</option>
				</select>

			</div>	
			<div id="dynamic">

	
				<?php
				
					$j=0;
				for($i=0;$i<count($product);$i++)
				{	
					$j++;
				?>
				<label>Item</label>
				<input type="text" name="txtitem[]" value="<?php echo !empty($product[$i]->item) ? $product[$i]->item : '' ?>">
				<label>Qty/Hrs</label>
				<input type="number" name="txtqtyhrs[]" id="qty<?php echo $j; ?>"  value="<?php echo !empty($product[$i]->qtyhrs) ? $product[$i]->qtyhrs : '' ?>">
		
				<label>Unit Price</label>
				<input type="text" name="txtunitprice[]" id="price<?php echo $j; ?>"  value="<?php echo !empty($product[$i]->unitprice) ? $product[$i]->unitprice : '' ?>" onblur="countamount(<?php echo $j ?>)" >
			
				<label>Tax</label><a href="<?php echo base_url('Estimates/viewtax') ?>">Add Tax</a>
				<select name="txttax[]" id="tax<?php echo $j; ?>" onchange="counttax(<?php echo $j ?>);">
						<option value=" ">select</option>
						<?php
						foreach($tax as $row1)
						{
							$str="";
							if($row1->rate==$product[$i]->tax)
							{
								$str="selected";
							}
							echo '<option value="'.$row1->rate.'"'.$str.'>'.$row1->taxname."(".$row1->rate."%)".'</option>';
						}
						?>
					</select>
				</label>Amount</label>
				<input type="text" name="txtamount[]" id="amount<?php echo $j ?>"  value="<?php echo !empty($product[$i]->amount) ? $product[$i]->amount : '' ?>">
		
				<label>Description</label>
				<textarea rows="7" cols="12" name="txtdescription[]"><?php echo !empty($product[$i]->description) ? $product[$i]->description : '' ?></textarea>
				<?php } ?>

	
		</div>
							<button type="button" id="btn" name="btn">ADD ITEM</button>

						<input type="hidden" id="counter" value="<?php echo count($product) ?>">

		<div>			
			<label>Total</label>
			<p id="p" ><?php echo !empty($estimate[0]->total) ? $estimate[0]->total : '' ?></p>
			<input type="hidden" id="txttotal" name="txttotal">
			
			
			<label>Note</label>
			<textarea rows="7" cols="12" name="txtnote"><?php echo !empty($estimate[0]->note) ? $estimate[0]->note : '' ?>"</textarea>
		</div>
				<input type="submit" value="Update" name="btnupdate">
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
			$('#dynamic').append('<div id="row'+counter+'"><label>Item</label><input type="text" name="txtitem[]"><label>Qty/Hrs</label><input type="number" name="txtqtyhrs[]" id="qty'+counter+'"><label>Unit Price</label><input type="text" name="txtunitprice[]" id="price'+counter+'"  onblur="countamount('+counter+')"><label>Tax</label><a href="<?php echo base_url('Estimates/viewtax') ?>">Add Tax</a><select name="txttax[]" id="tax'+counter+'" onchange="counttax('+counter+');"><option value=" ">select</option><?php foreach($tax as $row1){ echo '<option value="'.$row1->rate.'">'.$row1->rate.'</option>'; } ?></select><label>Amount</label><input type="text" name="txtamount[]" id="amount'+counter+'">Description<textarea rows="7" cols="12" name="txtdescription[]"></textarea><button type="button" name="remove" id="'+counter+'" class="remove">X</button></div>');
		});
		
		$(document).on('click','.remove',function(){
		
		var btn_id=$(this).attr("id");
		$("#row"+btn_id+'').remove();
	});

</script>