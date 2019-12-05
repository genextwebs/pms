<html>
<head>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

</head>
<body>

		<table id="dynamic">
			<tr>
				<td>Client</td>
				<td><select name="txtclient">
				<option value="">select</option>
					<?php
						foreach($client as $row)
						{
							echo '<option value="'.$row->id.'">'.$row->clientname.'</option>';
						}
					?>
				</select></td>
			</tr>
			<tr>
				<td>Currency</td>
				<td><select name="txtcurrency">
						<option>select</option>
						<option>$(USD)</option>
						<option>R(IND)</option>
					</select></td>
			</tr>
			<tr>
				<td>Valid Till</td>
				<td><input type="date" name="txtvalidtill"></td>
			</tr>
			<tr>
				<td>Item</td>
				<td><input type="text" name="txtitem"></td>
			</tr>
			<tr>
				<td>Qty/Hrs</td>
				<td><input type="number" name="txtqtyhrs"></td>
			</tr>
			<tr>
				<td>Unit Price</td>
				<td><input type="text" name="txtunitprice"></td>
			</tr>
			<tr>
				<td>Tax</td>
				<td><select name="txttax">
						<option>select</option>
					</select></td>
			</tr>
			<tr>
				<td>Amount</td>
				<td><input type="text" name="txtamount"></td>
			</tr>
			<tr>
				<td>Description</td>
				<td><textarea rows="7" cols="10" name="txtdescription"></textarea></td>
			</tr>
			<tr>
				<td><button type="button" name="btn" id="btn">ADD ITEM</button></td>
			</tr>
			
			<tr>
				<td>Note</td>
				<td><textarea rows="7" cols="10" name="txtnote"></textarea></td>
			</tr>
			<tr>
				<td><input type="submit" value="Save" name="btnsubmit" onclick="<?php echo base_url ('Estimates/insertrecord'); ?>"></td>
				<td><input type="reset" value="Reset" name="btnreset"></td>
			</tr>
		</table>

</body>
</html>
<script>
$(document).ready(function(){
	var i=1;
	$('#btn').click(function(){
			i++;
			$('#dynamic').append('<tr id="row'+i+'"><td>Item</td><td><input type="text" name="txtitem[]"></td></tr><tr id="row'+i+'"><td>Qty/Hrs</td><td><input type="number" name="txtqtyhrs[]"></td></tr><tr id="row'+i+'"><td>Unit Price</td><td><input type="text" name="txtunitprice[]"></td></tr><tr id="row'+i+'"><td>Tax</td><td><select name="txttax[]"><option>select</option></select></td></tr><tr id="row'+i+'"><td>Amount</td><td><input type="text" name="txtamount[]"></td></tr><tr id="row'+i+'"><td>Description</td><td><textarea rows="7" cols="10" name="txtdescription[]"></textarea></td></tr><tr><td><button type="button" name="remove" id="'+i+'" class="remove">X</button></td></tr>');
		});
		
		$(document).on('click','.remove',function(){
		var btn_id=$(this).attr("id");
		$("#row"+btn_id+'').remove();
	});

	});
</script>