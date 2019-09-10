            <!-- footer -->
            <footer>
                <p>2019 &copy; PMS</p>
            </footer>
            <!-- ends of footer -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.js"></script>
    <script src="<?php echo base_url();?>assets/js/validation.js"></script>

    <!-- sidebar -->
    <script type="text/javascript">
        $(document).ready(function() {
		    $('#users-table').DataTable();
		    CKEDITOR.replace( 'editor1' );
		});
    </script>
    <?php 
        $controller = strtolower($this->uri->segment(1));
        $function = strtolower($this->uri->segment(2));
        if(  $controller == 'leads' && $function == 'index') { ?>
            <script type="text/javascript">
                jQuery(document).ready(function() {
            var oTable = jQuery('#leads').DataTable({
                order: [[1, 'asc']],
                bServerSide: true,
                //"aoColumns": [{ "bSearchable": true }],
                sAjaxSource: "<?php echo base_url(); ?>Leads/lead_list",
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
                                var oTable = jQuery('#leads').dataTable();
                                var oLanguage = oTable.fnSettings().oLanguage;
                                if((json.estimateCount == true) && (json.iTotalDisplayRecords == json.limitCountQuery)){
                                    oLanguage.sInfo = '<b>_START_ to _END_</b> of more than _TOTAL_ (<small>' + json.iTotalRecordsFormatted + ' Leads</small>)';
                                }
                                else{
                                    oLanguage.sInfo = '<b>_START_ to _END_</b> of <b>_TOTAL_</b> (<small>' + json.iTotalRecordsFormatted + ' Leads</small>)';
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
    <?php } ?>
</body>
</html>



