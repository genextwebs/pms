            <!-- footer -->
            <footer>
                <p>2019 &copy; PMS</p>
            </footer>
            <!-- ends of footer -->
        </div>
    </div>

    <script src="<?php echo base_url();?>assets/js/jquery-3.2.1.slim.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/responsive.bootstrap4.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/dataTables.responsive.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/search-dropdown.min.js"></script>

    <script src="<?php echo base_url();?>assets/js/bootstrap.js"></script>
    <script src="<?php echo base_url();?>assets/js/custome.js"></script>

    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.js"></script>
    <script src="<?php echo base_url();?>assets/js/validation.js"></script>

    <!-- sidebar -->
    <script type="text/javascript">
        $(document).ready(function() {
		    $('#users-table').DataTable();
		    CKEDITOR.replace( 'editor1' );
		});
	</script>
</body>
</html>



