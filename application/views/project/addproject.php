
 <nav aria-label="breadcrumb" class="breadcrumb-nav">
	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title"><i class="icon-layers"></i> Projects</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url().'Dashboard/';?>">Home</a></li>
				<li><a href="<?php echo base_url().'Project/';?>">Projects</a></li>
				<li class="active">Add New</li>
			</ol>
		</div>
	</div>
</nav>
 <!-- contetn-wrap -->
<div class="content-in">  
	<div class="row">
		<div class="col-md-12">
			<div class="card br-0">
				<div class="card-header br-0 card-header-inverse">
					Add Project 
				</div>
				<div class="card-wrapper collapse show">
					<div class="card-body">
						<form id="creatclient" class="aj-form" name="creatclient" method="post" action="<?php echo base_url().'Project/insertproject';?>">
							<div class="submit-alerts">
								<div class="alert alert-success" role="alert">
								  This is a success alert
								</div>
								<div class="alert alert-danger" role="alert">
								  This is a danger alert
								</div>
								<div class="alert alert-warning" role="alert">
								  This is a warning alert
								</div>
							</div>
							<div class="form-body">
								<h3 class="box-title">Project Info</h3>
								<hr>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Project Name</label>
											<input id="project_name" class="form-control" type="text" name="project_name" value="">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group project-category">
											<label class="control-label" for="project-category">Project Category <a class="btn btn-sm btn-outline-success ml-1" href="javascript:;" data-toggle="modal" data-target="#project-category1"><i class="fa fa-plus"></i> Add Project Category</a></label>
											<select class="custom-select br-0" id="project-category" name="project-category">
											
												<?php
												foreach($category as $cat){
													echo '<option value="'.$cat->id.'">'.$cat->name.'</option> ';
												}
												?>
											
											</select>
										</div>
							</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Start Date</label>
											<input type="date" name="start_date" id="start_date" autocomplete="off" class="form-control">
										</div>
									</div>
									<div class="col-md-4" id="deadlineBox">
										<div class="form-group">
											<label class="control-label">Deadline</label>
											<input type="date" name="deadline" id="deadline" autocomplete="off" class="form-control">
										</div>
									</div>
									<div class="col-md-4" >
										<div class="form-group" style="padding-top: 25px;">
											<div class="custom-control custom-checkbox my-1 mr-sm-2">
												<input type="checkbox" class="custom-control-input" name="without_deadline" id="without_deadline" onclick="checkUncheck()">
												<label class="custom-control-label" for="without_deadline" style="padding-top: 2px;">Add project without deadline?</label>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<div class="custom-control custom-checkbox my-1 mr-sm-2">
												<input type="checkbox" class="custom-control-input" name="manual_timelog" id="manual_timelog">
												<label class="custom-control-label" for="manual_timelog" style="padding-top: 2px;">Allow manual time logs?</label>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<div class="custom-control custom-checkbox my-1 mr-sm-2">
												<input type="checkbox" class="custom-control-input" name="project_member" id="project_member" checked>
												<label class="custom-control-label" for="project_member" style="padding-top: 2px;">Add me as a project member</label>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label">Project Summary</label>
											<textarea name="editor1"></textarea>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label">Note</label>
											<textarea id="notes" class="form-control" name="notes" rows="5"></textarea>
										</div>
									</div>
								</div>
								<h3 class="box-title mb-3 mt-2">Client Info</h3>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<select class="custom-select" id="select-client" name="select_client">
													  <option value="">--Select--</option>
															<?php
																foreach($client as $row)
																{
																	echo '<option value="'.$row->id.'" >'.$row->clientname.'</option>';
																}
															?>
												</select>
											</div>
										</div>
									</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<div class="custom-control custom-checkbox my-1 mr-sm-2">
												<input type="checkbox" class="custom-control-input" name="client-view-tasks" id="client-view-tasks" onclick="viewtask()">
												<label class="custom-control-label" for="client-view-tasks" style="padding-top: 2px;">Client can view tasks of this project</label>
											</div>
										</div>
									</div>	
									<div class="col-md-8">
										<div class="form-group"  id="viewnotification" style="display:none;">
											<div class="custom-control custom-checkbox my-1 mr-sm-2">
												<input type="checkbox" class="custom-control-input" name="tasks-notification" id="tasks-notification">
												<label class="custom-control-label" for="tasks-notification" style="padding-top: 2px;">Send task notification to client?</label>
											</div>
										</div>
									</div>	
								</div>
								</div>
								<h3 class="box-title mb-3 mt-2">Budget Info</h3>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Project Budget</label>
											<input type="text" class="form-control" name="project-budget">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Currency</label>
											<select id="" class="form-control" name="currency-id">
												<option selected>--</option>
												<option>Dollars (USD)</option>
												<option>Pounds (GBP)</option>
												<option>Euros (EUR)</option>
												<option>Rupee (INR)</option>
											</select>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Hours Allocated</label>
											<input type="text" class="form-control" name="hours-allocated">
										</div>
									</div>
									
								</div>

                     
								<!-- action btn -->
								<div class="form-actions">
									<i class="fa fa-check"><input type="submit" id="save-form" class="btn btn-success" name="btnsave" value="Save"> </i> 
									<input type="reset" class="btn btn-default" value="Reset">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- ends of contentwrap -->
<!--project category--!-->
<div class="modal fade project-category" id="project-category1" tabindex="-1" role="dialog" aria-labelledby="project-category" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content br-0">
			<div class="modal-header">
				<h4 class="modal-title"> Project Category</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table">
						<thead>
						<tr>
							<th>#</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
						</thead>
						 <tbody>
								<?php foreach ($category as $row) { ?>      
									  <tr>
										  <td><?php echo $row->id; ?></td>
										  <td><?php echo $row->name; ?></td>
										  <td><a href="javascript:;" data-cat-id="1" class="btn btn-sm btn-danger btn-rounded delete-category">Remove</a></td>
									  </tr>
							   <?php } ?>
						</tbody>
					</table>
				</div>
				<hr>
				<form id="category" class="" name="category" method="post">
					<div class="form-body">
						<div class="row">
							<div class="col-md-12 ">
								<div class="form-group">
									<label>Category Name</label>
									<input type="text" name="category_name" id="category_name" class="form-control">
								</div>
							</div>
						</div>
					</div>
					<div class="form-actions">
						<input type="submit" id="save-category" class="btn btn-success" value="Save"> <i class="fa fa-check"></i>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--end category--> 
 <script type="text/javascript">

	function checkUncheck(){ 

		var checkBox = document.getElementById("without_deadline");
        if (checkBox.checked) {
            $('#deadlineBox').hide().checked;
        }
		else{
			 $('#deadlineBox').show();
		}	
	}
	function viewtask(){ 

		var checkBox = document.getElementById("client-view-tasks");
        if (checkBox.checked) {
            $('#viewnotification').show().checked;
        }
		else{
			 $('#viewnotification').hide();
		}	
	}
	
	     /*   $(document).ready(function(){
            // Initialize select2
            $('#project-category').select2();
            // Read selected option
            $('#save-category').click(function(){
                var username = $('#project_categ option:selected').text();
                var userid = $('#project_categ').val();
           
                $('#result').html("id : " + userid + ", name : " + username);
            });
        });*/
</script>
