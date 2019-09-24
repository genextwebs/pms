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
		                			<form id="createemployee" class="aj-form" enctype="multipart/form-data">
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
		                					<div class="row">
		                						<div class="col-md-6">
		                							<div class="form-group">
		                								<label class="control-label">Employee Name</label>
		                								<input id="employee_name" class="form-control" type="text" name="employee_name" value="">
		                							</div>
		                						</div>
		                						<div class="col-md-6">
		                							<div class="form-group">
		                								<label class="control-label">Employee Email</label>
		                								<input id="employee_email" class="form-control" type="email" name="employee_email" value="">
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
														    <input type="checkbox" class="custom-control-input" name="generate-random-pass" id="randomepassword">
														    <label class="custom-control-label" for="randomepassword" style="padding-top: 2px;">Generate Random Password</label>
														</div>
											        </div>
		                						</div>
		                						<div class="col-md-4">
		                							<div class="form-group">
		                								<label class="control-label">Mobile</label>
		                								<input type="text" class="form-control" id="mobile" name="mobile">
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
													        <input type="text" class="form-control" id="inlineFormInputGroup" name="username" placeholder="Username">
													    </div>
		                							</div>
		                						</div>
											    <div class="col-lg-3">
											        <div class="form-group">
											            <label class="control-label">Joining Date</label>
											            <input type="text" name="joining-date" id="startdate" autocomplete="off" class="form-control" data-date-format='yyyy-mm-dd'>
											        </div>
											    </div>
											    <div class="col-lg-3" id="deadlineBox">
											        <div class="form-group">
											            <label class="control-label">Last date</label>
											            <input type="text" name="last-date" id="enddate" autocomplete="off" class="form-control" data-date-format='yyyy-mm-dd'>
											        </div>
											    </div>
											    <div class="col-lg-3">
											        <div class="form-group">
											            <label class="control-label">Gender</label>
											            <select class="form-control" name="gender">
											            	<option value="0">Male</option>
											            	<option value="1">Female</option>
											            	<option value="2">Others</option>
											            </select>
											        </div>
											    </div>
											</div>

											<div class="row">
                                        		<div class="col-md-12">
		                                            <div class="form-group">
		                                                <label class="control-label">Address</label>
		                                                <textarea name="address" class="form-control" rows="4"></textarea>
		                                            </div>
		                                        </div>
                                			</div>
                                			<div class="row">
                                				<div class="col-md-12">
											        <div class="form-group">
											            <label class="control-label">Skills</label>
											            <input type="text" contenteditable data-placeholder="Skills" class="form-control" id="skills" name="skills" id="skills">
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
											            <select class="form-control" id="designation" name="designation">
											            	<option>--</option>
											            	<?php foreach($designation as $row){
											            	?>
											            		<option value="<?php echo $row->id?>">	<?php echo $row->name;?></option>
											            	<?php
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
											            	?>
											            		<option value="<?php echo $row->id?>">	<?php echo $row->name;?></option>
											            	<?php
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
											            <input type="text" class="form-control" id="hourly-rate" name="hourly-rate">
											        </div>
											    </div>
                                			</div>
                                			<div class="row">
			                                    <div class="col-md-6 ">
			                                        <div class="form-group">
			                                            <label>Log In</label>
			                                            <select name="login" id="login" class="form-control">
			                                                <option value="0">Enable</option>
			                                                <option value="1">Disable</option>
			                                            </select>
			                                        </div>
			                                    </div>
			                                </div>
			                                <div class="row">
			                                	<div class="col-md-6">
			                                		<div class="file-upload mb-5">
			                                			<label>Profile Picture</label>
			                                			<div class="image-upload-wrap">
			                                				<input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" name="profilepicture"/>
			                                			</div>
			                                				<!--<div class="drag-text">
			                                					<h3>Drag and drop <br>a file or select add Image</h3>
			                                				</div>
			                                			</div>
			                                			<div class="file-upload-content">
			                                				<img class="file-upload-image" src="#" alt="your image" />
			                                				<div class="image-title-wrap">
			                                					<button type="button" onclick="removeUpload()" class="remove-image">Remove  <span class="image-title">Uploaded Image</span> </button>
			                                				</div>-->
			                                				<div id="errordiv" style="display:none">
			                                				</div>
															<div  id="imgdiv" name="imgdiv"></div>
																<input type="hidden" id="imagename" name="imagename">
		                                					</div>
			                                			<button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Select Image</button>
			                                		</div>
			                                	</div>
			                                </div>
											<!-- action btn -->
			                                <div class="form-actions">
				                                <input type="submit" id="save-form" class="btn btn-success"> <i class="fa fa-check" value="Save"></i> 
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