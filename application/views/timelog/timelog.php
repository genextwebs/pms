<nav aria-label="breadcrumb" class="breadcrumb-nav">
	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title"><i class="ti-ticket"></i> Timelog</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url().'ticket' ?>">Home</a></li>
				 <li class="active">Timelog</li>
			</ol>
		</div>
	</div>
</nav>

<!-- contetn-wrap -->
<div class="content-in">
	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">SELECT DATE RANGE</label>
			    <div class="input-group input-daterange">
				    <input type="text" class="start-date form-control br-0" id="start_date" name="start_date" value="" data-date-format='yyyy-mm-dd'>
				    <div class="input-group-prepend">
				      <span class="input-group-text bg-info text-white">To</span>
				    </div>
				    <input type="text" class="end-date form-control br-0" id="deadline" name="deadline" value="" data-date-format='yyyy-mm-dd'>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">Select Project</label>
				<select id="projectData" class="custom-select" name="projectData">
					<option value="">--Select--</option>
					<?php 
						foreach($projectinfo as $project){
					?>
					<option value="<?php echo $project->id; ?>"><?php echo $project->projectname; ?></option>
						<?php	
				
						}
					?>
				</select> 
			    
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">Select Employee</label>
				<select id="employeeData" class="custom-select" name="employeeData">
					<option value="">--Select--</option>
					<?php
						foreach($empinfo as $emp){
					?>
						<option value="<?php echo $emp->id ;?>"><?php echo $emp->employeename;?></option>
					<?php 

						} 
					?>		
				</select> 
			    
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
            <div class="form-group m-t-10">
                <label class="control-label col-12 mb-3">&nbsp;</label>
                <button type="button" id="btnApplyLogs" class="btn btn-success col-lg-4 co-md-5"><i class="fa fa-check"></i> Apply</button>
            </div>
        </div>
    </div>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="form-group custom-action">
			<a href="<?php echo base_url().'timelog/addtimelog'?>" class="btn btn-outline-success btn-sm">Add New Project <i class="fa fa-plus" aria-hidden="true"></i></a>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="stats-box"> 
			<div class="table-responsive">
				<table class="table table-bordered table-hover" id="timelog">
					<thead>
						<tr role="row">
							 <th>Id</th>
							 <th>Project</th>
							<th>Employee Name</th>
							 <th>Start Date</th> 
							 <th>End Date</th> 
							 <th>Total Hours</th>
							 <th>Earnings</th>
							 <th>Action</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>
			
<!-- ends of contentwrap -->

<div class="modal fade project-category" id="timelog-popup" tabindex="-1" role="dialog" aria-labelledby="project-category" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content br-0">
			<div class="modal-body">
				<div class="table-responsive" id="timelogpreview">
					<div class="form-body">
						<h3 class="box-title">Timelog Info</h3><hr>
							<p id="succmsg" class="text-success"></p>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Select Project</label>
												
												<select name="projectname" id="projectname">
													<?php

													foreach($projectinfo as $project){
													?>
													<option value='<?php echo $project->id ?>'><?php echo $project->projectname; ?>
														
													</option>
													<?php

													}
													?> 
												</select>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											 <label for="date" class="control-label"> Start Date</label>
										   <input type="date" name="d1" id="d1" value=""  class="form-control"/>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">End Date</label>
											<input type="date" name="d2" id="d2" value="" class="form-control" />
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-4">
										<div class="form-group" id="timeonly">
											<label class="control-label">Start Time</label>
										    <input type="time" name="t1" id="t1" value=""  class="form-control"/>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label"> End Time</label>
											<input type="time" name="t2" id="t2" value="" class="form-control"/>
										</div>
									</div>
									<div class="col-md-4">
										<label  class="control-label">Total Hours</label>
											<div id="diff">
												<dl id="hours_mins">
														</dl>
											</div>
												<input type="hidden"  name="hours1" id="hours1" value="">
								 	</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label"> Employee Name</label>
												<input type="text" class="form-control" name="emp_name" id="emp_name">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label"> Memo</label>
												<input type="text" class="form-control" name="detail_memo" id="detail_memo">
										</div>
									</div>
								</div>
								<div class="form-actions">
									<button type="submit" name="btnsavetime" id="save-form" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
								</div>
							</div>
				</div>
			</div>
		</div>
	</div>
</div>
