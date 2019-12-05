<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
	var i=1;
	$('#add').click(function(){
		i++;
		m="<tr id="row'+i+'"><td><input type="text" name="name[]" id="name"></td><td><button name="remove" id="'+i+'" class="remove">Remove Item</button></td></tr>";
		tableBody.append(m); 

	});
	$(document).on('click','.remove',function(){
		var btn_id=$(this).attr("id");
		$("#row"+btn_id+'').remove();
	});
});
</script>
</head>
<body>
	<form>
	<table id="tbl1">
	<tbody>
		<tr>
			<td><input type="text" name="name[]" id="name"></td>
			<td><button name="add" id="add">Add Item</button></td>
		</tr>
	</tbody>
	</table>
	</form>
</body>
</html>
