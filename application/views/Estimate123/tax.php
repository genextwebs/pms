

<html>
<head>
</head>
<body>
	<form name="myform" method="post" action="<?php echo base_url().'Estimates/inserttaxrecord'?>">
	<h3>PRODUCTS DETAILS</h3>
		<table>
			<tr>
				<td>Tax Name</td>
				<td><input type="text" name="txttaxname"></td>
			</tr>
			<tr>
				<td>Rate %</td>
				<td><input type="text" name="txtrate"></td>
			</tr>
			<tr>
				<td><input type="submit" name="btnsave" value="Save"></td>
				<td><input type="reset" name="btnreset" value="Reset"></td>
			</tr>
		</table>
	</form>
</body>
</html>
tax.php
Displaying Products.php.