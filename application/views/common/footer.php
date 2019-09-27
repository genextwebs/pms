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
	 	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/js/bootstrap-datepicker.min.js"></script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.js"></script>
    <script src="<?php echo base_url();?>assets/js/custome.js"></script>

    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.js"></script>
    <script src="http://xoxco.com/examples/jquery.tagsinput.js"></script>
    <script type="text/javascript">
        var controllerName = '<?php echo strtolower($this->uri->segment(1)); ?>';
        var functionName = '<?php echo strtolower($this->uri->segment(2)); ?>';
        $(document).ready(function() {
            $('#users-table').DataTable();
            CKEDITOR.replace( 'editor1' );
        });
    </script>
	<!-- <script src="<?php echo base_url();?>assets/js/sejal.js"></script> -->
    <!-- <script src="<?php echo base_url();?>assets/js/varsha.js"></script> -->
    <script src="<?php echo base_url();?>assets/js/vaishali.js"></script>
   	
</body>
</html>



