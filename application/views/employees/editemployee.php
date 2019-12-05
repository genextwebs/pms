<nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><i class="icon-user"></i>Employees</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url().'dashboard'?>">Home</a></li>
                            <li><a href="<?php echo base_url().'employee'?>">Employees</a></li>
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
		                		Add Employee Info
		                	</div>
		                	<div class="card-wrapper collapse show">
		                		<div class="card-body">
		                			<form  class="aj-form" enctype="multipart/form-data"  method="post">
		                				<div class="submit-alerts">
		                					<div class="alert alert-success" role="alert">
											  This is a success alert
											</div>
											<?php if(!empty($error_msg['error'])) { ?>
											<div class="alert alert-danger" role="alert" style="display: block;">
											  <?php
											  		echo $error_msg['error'];
												?>
											</div>
											<?php  } ?>
											<div class="alert alert-warning" role="alert">
											  This is a warning alert
											</div>
		                				</div>
		                				<div class="form-body">
		                					<div class="row">
		                						<div class="col-md-6">
		                							<div class="form-group">
		                								<label class="control-label">Employee Name</label>
		                								<input id="name" class="form-control" type="text" name="employee_name" value="<?php echo !empty($employee[0]->employeename) ?  $employee[0]->employeename : ' '?>">
		                							</div>
		                						</div>
		                						<div class="col-md-6">
		                							<div class="form-group">
		                								<label class="control-label">Employee Email</label>
		                								<input id="employee_email" class="form-control" type="email" name="employee_email" value="<?php echo !empty($user[0]->emailid) ?  $user[0]->emailid : ' '?>">
		                								<span class="help-desk">Employee will login using this email.</span>
		                							</div>
		                						</div>
		                					</div>
		                					<div class="row">
		                						<div class="col-md-4">
		                							<div class="form-group">
		                								<label class="control-label">Password</label>
		                								<input type="password" name="password" id="password" class="form-control">
		                								<span class="help-desk">Employee will login using this password. </span>
		                							</div>
		                						</div>
		                						<div class="col-md-4">
		                							<div class="form-group" style="padding-top: 25px;">
											            <div class="custom-control custom-checkbox my-1 mr-sm-2">
														    <input type="checkbox" class="custom-control-input" name="randompassword" id="randompassword" onclick="checkuncheck();">
														    <label class="custom-control-label" for="randompassword" style="padding-top: 2px;">Generate Random Password</label>
														</div>
											        </div>
		                						</div>
		                						<div class="col-md-4">
		                							<div class="form-group">
		                								<label class="control-label">Mobile</label>
		                								<input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo !empty($user[0]->mobile) ?  $user[0]->mobile : ' '?>">
		                							</div>
		                						</div>
		                					</div>
		                					<div class="row">
		                						<div class="col-lg-3">
		                							<div class="form-group">
		                								<label class="control-label" for="inlineFormInputGroup">Username</label>
			                							<div class="input-group">
													        <div class="input-group-prepend">
													          	<div class="input-group-text br-0">@</div>
													        </div>
													        <input type="text" class="form-control" id="inlineFormInputGroup" name="username" placeholder="Username" value="<?php echo !empty($employee[0]->slackusername) ?  $employee[0]->slackusername : ' '?>">
													    </div>
		                							</div>
		                						</div>
											    <div class="col-lg-3">
											        <div class="form-group">
											            <label class="control-label">Joining Date</label>
											            <input type="text" name="joining-date" id="startdate" autocomplete="off" class="form-control" data-date-format='yyyy-mm-dd' value="<?php echo !empty($employee[0]->joingdate) ?  $employee[0]->joingdate : ' '?>">
											        </div>
											    </div>
											    <div class="col-lg-3" id="deadlineBox">
											        <div class="form-group">
											            <label class="control-label">Last date</label>
											            <input type="text" name="last-date" id="enddate" autocomplete="off" class="form-control" data-date-format='yyyy-mm-dd' value="<?php echo !empty($employee[0]->lastdate) ?  $employee[0]->lastdate : ' '?>">
											        </div>
											    </div>
											    <div class="col-lg-3">
											        <div class="form-group">
											            <label class="control-label">Gender</label>
											            <select class="form-control" name="gender">
											            	<option value="0" <?php
																	if($employee[0]->gender == 0){
																		echo 'selected';	
															}?>>Male</option>
											            	<option value="1" <?php 
																	if($employee[0]->gender == 1){
																		echo 'selected';	
															}?>>Female</option>
											            	<option value="2" <?php 
																	if($employee[0]->gender == 2){
																		echo 'selected';	
															}?>>Others</option>
											            </select>
											        </div>
											    </div>
											</div>

											<div class="row">
                                        		<div class="col-md-12">
		                                            <div class="form-group">
		                                                <label class="control-label">Address</label>
		                                                <textarea name="address" class="form-control" rows="4"><?php 	?></textarea>
		                                            </div>
		                                        </div>
                                			</div>
                                			<div class="row">
                                				<div class="col-md-12">
											        <div class="form-group">
											            <label class="control-label">Skills</label>
											            <input type="text" contenteditable data-placeholder="Skills" class="form-control" id="skills" name="skills" id="skills" value="<?php echo !empty($employee[0]->skills) ?  $employee[0]->skills : ' '?>">
											        </div>
											    </div>
                                			</div>
                                			<div class="row">
                                				<div class="col-md-6">
											        <div class="form-group">
											            <label class="control-label">Designation</label>
											            <a href="javascript:;" id="tax-settings" data-toggle="modal" data-target="#data-designation">
											            	<i class="ti-settings text-info"></i>
											            </a>
											            <select class="form-control" id="designation" name="designation" >
											            	
											            	<option>--</option>
											            	<?php foreach($designation as $row){
											            		$str = '';
											            		if($row->id == $employee[0]->designation){
											            				$str = 'selected';
											            		}
											            	echo '<option value="'.$row->id.'" '.$str.'>'.$row->name.'</option>';
											            	}
											            	?>
											            </select>
											        </div>
											    </div>
											    <div class="col-md-6">
											        <div class="form-group">
											            <label class="control-label">Department</label>
											            <a href="javascript:;" id="tax-settings" data-toggle="modal" data-target="#data-department">
											            	<i class="ti-settings text-info"></i>
											            	</a>
											            <select class="form-control" id="department" name="department" id="department">
											            	<option>--</option>
											            	<?php foreach($department as $row){
											            		$str = '';
											            		if($row->id == $employee[0]->department){
											            				$str = 'selected';
											            		}
											            	echo '<option value="'.$row->id.'" '.$str.'>'.$row->name.'</option>';
											            	}
											            	?>
											            </select>
											            
											        </div>
											    </div>
                                			</div>
                                			<div class="row">
                                				<div class="col-md-6">
											        <div class="form-group">
											            <label class="control-label">Hourly Rate</label>
											            <input type="text" class="form-control" id="hourly-rate" name="hourly-rate" value="<?php echo !empty($employee[0]->hourlyrate) ?  $employee[0]->hourlyrate : ' '?>">
											        </div>
											    </div>
											    <div class="col-md-6">
											        <div class="form-group">
											            <label class="control-label">Status</label>
											            <select name="status" id="status" class="form-control">
			                                                <option value="0" <?php 
																	if($user[0]->status == 0){
																		echo 'selected';	
															}?>>Active</option>
			                                                <option value="1" <?php 
																	if($user[0]->status == 1){
																echo 'selected';	
															}?>>Inactive</option>
			                                            </select>
											        </div>
											    </div>
                                			</div>
                                			<div class="row">
			                                    <div class="col-md-6 ">
			                                        <div class="form-group">
			                                            <label>Log In</label>
			                                            <select name="login" id="login" class="form-control">
			                                                <option value="0" <?php 
																	if($user[0]->login == 0){
																		echo 'selected';	
															}?>>Enable</option>
			                                                <option value="1" <?php 
																	if($user[0]->login == 1){
																echo 'selected';	
															}?>>Disable</option>
			                                            </select>
			                                        </div>
			                                    </div>
			                                </div>
			                                
											<!-- action btn -->
			                                <div class="form-actions">
				                                <input type="submit" id="save-form" class="btn btn-success"> <i class="fa fa-check" value="Update"></i> 
				                                <button type="reset" class="btn btn-default">Reset</button>
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


<!-- Modal  for designation-->
			
			<div class="modal fade designation" id="data-designation" tabindex="-1" role="dialog" aria-labelledby="designation" aria-hidden="true">
            	<div class="modal-dialog modal-lg" role="document">
            		<div class="modal-content br-0">
            			<div class="modal-header">
            				<h4 class="modal-title">Designation</h4>
            				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
            					<span aria-hidden="true">×</span>
            				</button>
            			</div>
            			<div class="modal-body">
					        <form id="modeldesignation" class="" name="modeldesignation" method="post" >
						        <div class="form-body">
						            <div class="row">
						                <div class="col-md-12">
						                    <div class="form-group">
						                        <label>Name</label>
						                        <input type="text" name="designation_name" id="designation_name" class="form-control">
						                    </div>
						                </div>
						            </div>
						        </div>
						        
						        <div class="form-actions">
						            <input type="button" id="save-designation" class="btn btn-success" name="Save" value="Save"> <i class="fa fa-check"></i> 
						        </div>
							</form>
            			</div>
            		</div>
            	</div>
            </div>


  <!-- Modal  for department-->
			
			<div class="modal fade department" id="data-department" tabindex="-1" role="dialog" aria-labelledby="designation" aria-hidden="true">
            	<div class="modal-dialog modal-lg" role="document">
            		<div class="modal-content br-0">
            			<div class="modal-header">
            				<h4 class="modal-title">Department</h4>
            				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
            					<span aria-hidden="true">×</span>
            				</button>
            			</div>
            			<div class="modal-body">
					        <form id="modaldepartment" class="" name="modaldepartment" method="post" >
						        <div class="form-body">
						            <div class="row">
						                <div class="col-md-12">
						                    <div class="form-group">
						                        <label>Name</label>
						                        <input type="text" name="department_name" id="department_name" class="form-control">
						                    </div>
						                </div>
						            </div>
						        </div>
						        
						        <div class="form-actions">
						            <input type="button" id="save-department" class="btn btn-success" name="Save" value="Save"> <i class="fa fa-check"></i> 
						        </div>
							</form>
            			</div>
            		</div>
            	</div>
            </div>


