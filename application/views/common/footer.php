            <!-- footer -->
            <footer>
                <p>2019 &copy; PMS</p>
            </footer>
            <!-- ends of footer -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>
    <!-- <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> -->
    <script src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/responsive.bootstrap4.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/dataTables.responsive.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/search-dropdown.min.js"></script>
     <script src="<?php echo base_url();?>assets/js/datatables.bundle.min.js"></script>

    <script src="<?php echo base_url();?>assets/js/bootstrap.js"></script>
    <script src="<?php echo base_url();?>assets/js/custome.js"></script>

    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.js"></script>

    <script type="text/javascript">
        var controllerName = '<?php echo strtolower($this->uri->segment(1)); ?>';
        var functionName = '<?php echo strtolower($this->uri->segment(2)); ?>';
        $(document).ready(function() {
            $('#users-table').DataTable();
            CKEDITOR.replace( 'editor1' );
        });
    </script>

    <script src="<?php echo base_url();?>assets/js/varsha.js"></script>
    <script src="<?php echo base_url();?>assets/js/vaishali.js"></script>
    <!-- sidebar -->
    <?php 
        $controller = strtolower($this->uri->segment(1));
        $function = strtolower($this->uri->segment(2));
        if($controller == 'project' && $function == 'index' || $function == '') { 
		?>
		<script type="text/javascript">
                jQuery(document).ready(function() {
				var oTable = jQuery('#project').DataTable({
                order: [[1, 'asc']],
                bServerSide: true,
                //"aoColumns": [{ "bSearchable": true }],
                sAjaxSource: "<?php echo base_url(); ?>Project/projectlist",
                sServerMethod: "POST",
                fnServerData: function ( sSource, aoData, fnCallback, oSettings ) {
					aoData.push( { "name": "status1", "value": $('#project_status').val() } );
					aoData.push( { "name": "clientname1", "value": $('#clientname').val() } );
					aoData.push( { "name": "categoryname1", "value": $('#categoryname').val() } );
                    oSettings.jqXHR = $.ajax( {
                            "dataType": 'json',
                            "type": "POST",
                            "url": sSource,
                            "data": aoData,
                            "timeout": 60000, //1000 - 1 sec - wait one minute before erroring out = 30000
                            //"error": handleServerError,
                            "success": function(json) {
                                var oTable = jQuery('#project').dataTable();
                                var oLanguage = oTable.fnSettings().oLanguage;
                                if((json.estimateCount == true) && (json.iTotalDisplayRecords == json.limitCountQuery)){
                                    oLanguage.sInfo = '<b>_START_ to _END_</b> of more than _TOTAL_ (<small>' + json.iTotalRecordsFormatted + ' Project</small>)';
                                }
                                else{
                                    oLanguage.sInfo = '<b>_START_ to _END_</b> of <b>_TOTAL_</b> (<small>' + json.iTotalRecordsFormatted + ' Project</small>)';
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
		//for Search Dropdown 
		$('#clientname').change(function(){ //button filter event click
				var oTable = $('#project').DataTable();
					oTable.draw();
			});
			$('#categoryname').change(function(){ //button filter event click
				var oTable = $('#project').DataTable();
					oTable.draw();
			});
			$('#project_status').change(function(){ //button filter event click
				var oTable = $('#project').DataTable();
					oTable.draw();
			});
            </script>
    <?php } 
	 elseif($controller == 'clients' && $function == 'index') { ?>
            <script type="text/javascript">
                jQuery(document).ready(function() {
            var oTable = jQuery('#clients').DataTable({
                order: [[1, 'asc']],
                bServerSide: true,
                //"aoColumns": [{ "bSearchable": true }],
                sAjaxSource: "<?php echo base_url(); ?>Clients/client_list",
                sServerMethod: "POST",
                fnServerData: function ( sSource, aoData, fnCallback, oSettings ) {
                    oSettings.jqXHR = $.ajax( {
                            "dataType": 'json',
                            "type": "POST",
                            "url": sSource,
                            "data": aoData,
                            "timeout": 60000, //1000 - 1 sec - wait one minute before erroring out = 30000
                            //"error": handleServerError,
                            "success": function(json) {
                                var oTable = jQuery('#clients').dataTable();
                                var oLanguage = oTable.fnSettings().oLanguage;
                                if((json.estimateCount == true) && (json.iTotalDisplayRecords == json.limitCountQuery)){
                                    oLanguage.sInfo = '<b>_START_ to _END_</b> of more than _TOTAL_ (<small>' + json.iTotalRecordsFormatted + ' Clients</small>)';
                                }
                                else{
                                    oLanguage.sInfo = '<b>_START_ to _END_</b> of <b>_TOTAL_</b> (<small>' + json.iTotalRecordsFormatted + ' Clients</small>)';
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
            </script>
    <?php }else if($controller == 'project' && $function == 'viewarchiev') { 
		?>
		<script type="text/javascript">
		jQuery(document).ready(function() {
			var oTable = jQuery('#projecttemp').DataTable({
				order: [[1, 'asc']],
				bServerSide: true,
				sAjaxSource: "<?php echo base_url(); ?>Project/archivelist",
				sServerMethod: "POST",
				fnServerData: function ( sSource, aoData, fnCallback, oSettings ) {
					aoData.push( { "name": "projectstatus", "value": $('#project_status').val() } );
					aoData.push( { "name": "clientname1", "value": $('#clientname').val() } );
					
					
					oSettings.jqXHR = $.ajax( {
							"dataType": 'json',
							"type": "POST",
							"url": sSource,
							"data": aoData,
							"timeout": 60000, //1000 - 1 sec - wait one minute before erroring out = 30000
							//"error": handleServerError,
							"success": function(json) {
								var oTable = jQuery('#projecttemp').dataTable();
								var oLanguage = oTable.fnSettings().oLanguage;
								if((json.estimateCount == true) && (json.iTotalDisplayRecords == json.limitCountQuery)){
									oLanguage.sInfo = '<b>_START_ to _END_</b> of more than _TOTAL_ (<small>' + json.iTotalRecordsFormatted + ' status</small>)';
								}
								else{
									oLanguage.sInfo = '<b>_START_ to _END_</b> of <b>_TOTAL_</b> (<small>' + json.iTotalRecordsFormatted + ' status</small>)';
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
			$('#clientname').click(function(){ //button filter event click
				var oTable = $('#projecttemp').DataTable();
					oTable.draw();
			});
			$('#project_status').click(function(){ //button filter event click
				var oTable = $('#projecttemp').DataTable();
					oTable.draw();
			});
	
	
	<?php }else{} ?>

</body>
</html>



