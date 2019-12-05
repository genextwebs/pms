<html>
<body>
<head>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/js/bootstrap-datepicker.min.js"></script>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">

	<script  type="text/javascript">
	
		$(document).ready(function()
		{
			$('#message').delay(2000).fadeOut();
		});

	</script>
	<script>
	$(document).ready(function(){
	  $("#startdate").datepicker({
		   todayBtn:  1,
			autoclose: true,
		   }).on('changeDate', function (selected) {
			
		});
		
			$("#enddate").datepicker();
	});

	</script>
</head>
<body>
		<div id="message">
		<?php echo $this->session->flashdata('messagename'); ?>
	</div>
	
	
<a href="<?php echo base_url().'Estimates/viewinvoice'?>">Add New Invoice</a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	<a href="<?php echo base_url().'Clients/viewfilterrecords'?>">Filter Result</a>
	
	<form method="post">

		<table>
			<tr>
				<td>Select Table Range</td>
				<td><input type="text" placehoder="Start Date" id="startdate" data-date-format='yyyy-mm-dd' /><spam>TO</spam>
				<input type="text" placehoder="End Date" id="enddate" data-date-format='yyyy-mm-dd'  /></td>
				
			</tr>
			<tr>
				<td>Project</td>
				<td><select name="txtproject" id="project">
				<option value="">select</option>
					<?php
						foreach($project as $row)
						{
							echo '<option value="'.$row->projectname.'">'.$row->projectname.'</option>';
						}
					?>
				</select>
				</td>
			</tr>
		
			<tr>
				<td>Status</td>
				<td><select id="status">
					
					<option value="All">All</option>
					<option value="1">Paid</option>
					<option value="0">Unpaid</option>
					<option value="2">Partial</option>

				</select></td>
			</tr>
			<tr>
				<td><input type="button" value="Apply" name="btnapply" id="btnapply"> 
				<input type="reset" value="Reset"></td>
			</tr>
		</table>
	</form>

	<table align="center" border="1" cellpadding="5spx" cellspacing="4px" id="example" class="display" style="margin-top:1%;">
		<thead>
			<tr style="background:#CCC">
				<th>Sr No</th>
				<th>Invoice#</th>
				<th>Project</th>
				<th> Total</th>
				<th>Invoice date</th>
				<th> Status</th>
				<th>Edit</th>
				<th>Delete</th>
			
			</tr>
		</thead>
	</table>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script src="<?php echo base_url('assets\datatables.bundle.min.js') ?>"></script>
	<script type="text/javascript">
		jQuery(document).ready(function() {
			var oTable = jQuery('#example').DataTable({
				order: [[1, 'asc']],
				bServerSide: true,
				sAjaxSource: "<?php echo base_url(); ?>Estimates/viewinvoicerecord",
				sServerMethod: "POST",
				fnServerData: function ( sSource, aoData, fnCallback, oSettings ) {
				aoData.push( { "name": "startdate", "value": $('#startdate').val() } );
				aoData.push( { "name": "enddate", "value": $('#enddate').val() } );
				aoData.push( { "name": "project", "value": $('#project').val() } );
				aoData.push( { "name": "status", "value": $('#status').val() } );

					oSettings.jqXHR = $.ajax( {
							"dataType": 'json',
							"type": "POST",
							"url": sSource,
							"data": aoData,
							"timeout": 60000, //1000 - 1 sec - wait one minute before erroring out = 30000
							//"error": handleServerError,
							"success": function(json) {
								var oTable = jQuery('#example').dataTable();
								var oLanguage = oTable.fnSettings().oLanguage;
								if((json.estimateCount == true) && (json.iTotalDisplayRecords == json.limitCountQuery)){
									oLanguage.sInfo = '<b>_START_ to _END_</b> of more than _TOTAL_ (<small>' + json.iTotalRecordsFormatted + ' clients</small>)';
								}
								else{
									oLanguage.sInfo = '<b>_START_ to _END_</b> of <b>_TOTAL_</b> (<small>' + json.iTotalRecordsFormatted + ' clients</small>)';
								}
								
								fnCallback(json);
							}
						});
				},
				fnRowCallback: function( nRow, aData, iDisplayIndex ){
						return nRow;
				},
				fnDrawCallback: function(oSettings, json) {
						//extra js code 
				},
			});
		});
		$('#btnapply').click(function(){ //button filter event click
				var oTable = $('#example').DataTable();
					oTable.draw();
			});
			
			/*var table;
			$(document).ready(function() {
				table = $('#example').dataTable({
					"ajax": {
					url : "<?php echo base_url(); ?>Clients/viewclientsrecord",
					type : 'POST',
					data:{'status1': $('#status').val(),
						'clientname1': $('#clientname').val()
						},
					}
				});
			});
			
			$('#btnapply').click(function(){ //button filter event click
			 $('#example').DataTable().fnReloadAjax;
				
			});*/
			</script>
</body>
</html>