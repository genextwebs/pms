<nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><i class="icon-user"></i> Employees</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url().'dashboard'?>
                            ">Home</a></li>
                            <li class="active">Employees</li>
                        </ol>
                    </div>
                </div>
            </nav>

            <!-- contetn-wrap -->
            <div class="content-in">  
                <div class="row">
                	<div class="col-md-5">
                		<div class="stats-box">
		                	<div class="user-bkg">
		                		<img src="images/default-profile-2.png" alt="user" class="img-circle">
		                		<div class="overlay-box">
				                    <div class="user-content"> <a href="javascript:void(0)">
				                        <img src="images/default-profile-2.png" alt="user" class="thumb-lg img-circle">
				                            </a>
				                        <h4 class="text-white"><?php echo !empty($employee[0]->employeename) ?  $employee[0]->employeename : ' ' ?></h4>
				                        <h5 class="text-white"><?php echo !empty($user[0]->emailid) ?  $user[0]->emailid : ' ' ?></h5>
				                    </div>
				                </div>
		                	</div>
		                	<div class="user-btm-box">
				                <div class="row row-in">
				                    <div class="col-md-6 b-r">
				                        <div class="col-in">
			                                <h3 class="box-title">Tasks Done</h3>
			                               	<div class="row">
				                                <div class="col-4"><i class="ti-check-box text-success"></i></div>
				                                <div class="col-8 text-right counter">1</div>
				                            </div>
				                        </div>
				                    </div>
				                    <div class="col-md-6 b-r-none">
				                        <div class="col-in">
				                            <h3 class="box-title">Hours Logged</h3>
				                           	<div class="row">
					                            <div class="col-sm-2"><i class="icon-clock text-info"></i></div>
					                            <div class="col-sm-10 text-right counter" style="font-size: 13px">763 hrs </div>
					                        </div>
				                        </div>
				                    </div>
				                </div>
				                <div class="row row-in">
				                    <div class="col-md-6 b-r row-in-br">
			                        	<div class="col-in">
			                                <h3 class="box-title">Leaves Taken</h3>
			                                <div class="row">
			                                	<div class="col-sm-4"><i class="icon-logout text-warning"></i></div>
			                                	<div class="col-sm-8 text-right counter">0</div>
			                                </div>
				                        </div>
				                    </div>
				                    <div class="col-md-6 row-in-br b-r-none">
				                        <div class="col-in">
				                            <h3 class="box-title">Remaining Leaves</h3>
				                            <div class="row">
					                            <div class="col-sm-4"><i class="icon-logout text-danger"></i></div>
					                            <div class="col-sm-8 text-right counter">15</div>
					                        </div>
				                        </div>
				                    </div>
				                </div>
				            </div>
		                </div>
                	</div>
                	<div class="col-md-7">
                		<div class="stats-box">
		                	<ul class="nav nav-tabs theme-tabsamp" id="myTab" role="tablist">
							  <li class="nav-item">
							    <a class="nav-link active" id="activity-tab" data-toggle="tab" href="#activity" role="tab" aria-controls="activity" aria-selected="true">Activity</a>
							  </li>
							  <li class="nav-item">
							    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
							  </li>
							  <li class="nav-item">
							    <a class="nav-link" id="projects-tab" data-toggle="tab" href="#projects" role="tab" aria-controls="projects" aria-selected="false">Project</a>
							  </li>

							  <li class="nav-item">
							    <a class="nav-link" id="tasks-tab" data-toggle="tab" href="#tasks" role="tab" aria-controls="tasks" aria-selected="true">Tasks</a>
							  </li>
							  <li class="nav-item">
							    <a class="nav-link" id="leaves-tab" data-toggle="tab" href="#leaves" role="tab" aria-controls="leaves" aria-selected="false">Leaves</a>
							  </li>
							  <li class="nav-item">
							    <a class="nav-link" id="timelogs-tab" data-toggle="tab" href="#timelogs" role="tab" aria-controls="timelogs" aria-selected="false">Time Logs</a>
							  </li>
							  <li class="nav-item">
							    <a class="nav-link" id="documents-tab" data-toggle="tab" href="#documents" role="tab" aria-controls="documents" aria-selected="false">Documents</a>
							  </li>
							</ul>
							<div class="tab-content mt-4" id="myTabContent">
								<!-- 1 -->
							  	<div class="tab-pane fade show active" id="activity" role="tabpanel" aria-labelledby="activity-tab">
						  			No activity by the user.
							  	</div>
							  	<!-- 2 -->
							  	<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
							  		<div class="row">
				                        <div class="col-sm-6 b-r"> <strong>Full Name</strong> <br>
				                            <p class="text-muted"><?php echo !empty($employee[0]->employeename) ?  $employee[0]->employeename : ' ' ?></p>
				                        </div>
				                        <div class="col-sm-6"> <strong>Mobile</strong> <br>
				                            <p class="text-muted"><?php echo !empty($user[0]->mobile) ?  $user[0]->mobile : ' ' ?></p>
				                        </div>
				                    </div>
				                    <hr>
				                    <div class="row">
				                        <div class="col-md-6 col-sm-6 b-r"> <strong>Email</strong> <br>
				                            <p class="text-muted"><?php echo !empty($user[0]->emailid) ?  $user[0]->emailid : ' ' ?></p>
				                        </div>
				                        <div class="col-md-3 col-sm-6"> <strong>Address</strong> <br>
				                            <p class="text-muted"><?php echo !empty($employee[0]->address) ?  $employee[0]->address : ' ' ?></p>
				                        </div>
				                    </div>
				                    <hr>
				                    <div class="row">
				                        <div class="col-md-6 col-sm-6 b-r"> <strong>Job Title</strong> <br>
				                            <p class="text-muted"><?php echo !empty($employee[0]->joingdate) ?  $employee[0]->joingdate : ' ' ?></p>
				                        </div>
				                        <div class="col-md-3 col-sm-6"> <strong>Hourly Rate</strong> <br>
				                            <p class="text-muted"><?php echo !empty($employee[0]->hourlyrate) ?  $employee[0]->hourlyrate : ' ' ?></p>
				                        </div>
				                    </div>
				                    <hr>
				                    <div class="row">
				                        <div class="col-md-6 col-xs-6 b-r"> <strong>Slack Username</strong> <br>
				                            <p class="text-muted"><?php echo !empty($employee[0]->slackusername) ?  $employee[0]->slackusername : ' ' ?></p>
				                        </div>
				                        <div class="col-md-6 col-xs-6"> <strong>Joining Date</strong> <br>
				                            <p class="text-muted"><?php echo !empty($employee[0]->joingdate) ?  $employee[0]->joingdate : ' ' ?></p>
				                        </div>
				                    </div>
				                    <hr>
				                    <div class="row">
				                        <div class="col-md-6 col-xs-6 b-r"> <strong>Gender</strong> <br>
				                            <p class="text-muted"><?php if($employee[0]->gender == 0){
																		echo 'Male';	
																	} 
																	else if($employee[0]->gender == 1){
																		echo 'Female';
																	}
																	else{
																		echo 'Others';
																	}
																	?>
											</p>
				                        </div>
				                        <div class="col-md-6 col-xs-6"> <strong>Skills</strong> <br>
				                        	<p class="text-muted"><?php echo !empty($employee[0]->skills) ?  $employee[0]->skills : ' '?></p>
				                        </div>
				                    </div>
				                    <hr>
							  	</div>
							  	<!-- 3 -->
							  	<div class="tab-pane fade" id="projects" role="tabpanel" aria-labelledby="projects-tab">
							  		<div class="table-responsive">
									    <table class="table">
									        <thead>
									            <tr>
									                <th>#</th>
									                <th>Project</th>
									                <th>Deadline</th>
									                <th>Completion</th>
									            </tr>
									        </thead>
									        <tbody>
									            <tr>
									                <td>1</td>
									                <td><a href="https://demo.worksuite.biz/admin/projects/4">Chat Application</a></td>
									                <td>02-09-2019 </td>
									                <td>

									                    <h5>Completed<span class="pull-right">76%</span></h5>
									                    <div class="progress hight-4px">
									                        <div class="progress-bar bg-success" role="progressbar" style="width: 76%" aria-valuenow="76" aria-valuemin="0" aria-valuemax="100"></div>
									                    </div>
									                </td>
									            </tr>
									            <tr>
									                <td>2</td>
									                <td><a href="https://demo.worksuite.biz/admin/projects/5">Cinema Ticket Booking System</a></td>
									                <td>02-07-2019 </td>
									                <td>

									                    <h5>Completed<span class="pull-right">73%</span></h5>
									                    <div class="progress hight-4px">
									                        <div class="progress-bar bg-warning" role="progressbar" style="width: 73%" aria-valuenow="73" aria-valuemin="0" aria-valuemax="100"></div>
									                    </div>
									                </td>
									            </tr>
									            <tr>
									                <td>3</td>
									                <td><a href="https://demo.worksuite.biz/admin/projects/13">Airline Reservation System</a></td>
									                <td>02-09-2019 </td>
									                <td>

									                    <h5>Completed<span class="pull-right">77%</span></h5>
									                    <div class="progress hight-4px">
									                        <div class="progress-bar bg-success" role="progressbar" style="width: 77%" aria-valuenow="77" aria-valuemin="0" aria-valuemax="100"></div>
									                    </div>
									                </td>
									            </tr>
									        </tbody>
									    </table>
									</div>
							  	</div>
							  	<!-- 4 -->
							  	<div class="tab-pane fade" id="tasks" role="tabpanel" aria-labelledby="tasks-tab">
							  		<div class="row">
				                        <div class="col-md-6">
				                            <div class="custom-control custom-checkbox checkbox-info">
				                                <input type="checkbox" class="custom-control-input" id="hide-completed-tasks">
				                                <label class="custom-control-label" for="hide-completed-tasks" margin-top: 2px;>Hide Completed Tasks</label>
				                            </div>
				                        </div>
				                    </div>
				                    <hr>
				                    <div class="table-responsive">
									    <table class="table table-bordered" id="emplo-tasks-table">
									        <thead>
									            <tr role="row">
									                 <th>Id</th>
									                 <th>Project</th>
									                 <th>Task</th>
									                 <th>Due Date</th>
									                 <th>Status</th>
									            </tr>
									        </thead>
									        <tbody>
									            <tr role="row" class="odd">
									                <td class="" tabindex="0">3</td>
									                <td><a href="#">Lemuel Padberg</a></td>
									                <td>MINE,' said the.</td>
									                <td><span class="text-danger">02-01-2019</span></td>
									                <td><label class="label label-danger">Incomplete</label></td>
									            </tr>
									            <tr role="row" class="odd">
									                <td class="" tabindex="0">3</td>
									                <td><a href="#">Live meeting</a></td>
									                <td>Please, Ma'am, is.</td>
									                <td><span class="text-danger">02-01-2019</span></td>
									                <td><label class="label label-danger">Incomplete</label></td>
									            </tr>
									        </tbody>
									    </table>
									</div>
							  	</div>
							  	<!-- 5 -->
							  	<div class="tab-pane fade" id="leaves" role="tabpanel" aria-labelledby="leaves-tab">
							  		<div class="row">
				                        <div class="col-md-6">
				                            <ul class="basic-list">
				                                <li>Casual
				                                    <span class="pull-right bg-success label">0</span>
				                                </li>
				                                <li>Sick
				                                    <span class="pull-right bg-danger label">0</span>
				                                </li>
				                                <li>Earned
				                                    <span class="pull-right bg-info label">0</span>
				                                </li>
				                           	</ul>
				                        </div>
				                    </div>
				                    <hr>
				                    <div class="table-responsive">
									    <table class="table table-bordered " id="emplo-tasks-table">
									        <thead>
									            <tr role="row">
									                 <th>Leave Type</th>
									                 <th>Date</th>
									                 <th>Reason for absence</th>
									            </tr>
									        </thead>
									        <tbody>
									            <tr>
									                <td></td>
									                <td></td>
									                <td></td>
									            </tr>
									        </tbody>
									    </table>
									</div>
							  	</div>
							  	<!-- 6 -->
							  	<div class="tab-pane fade" id="timelogs" role="tabpanel" aria-labelledby="timelogs-tab">
							  		<div class="table-responsive">
									    <table class="table table-bordered" id="timelogs-table">
									        <thead>
									            <tr role="row">
									               <th>Id</th>
									               <th>Project</th>
									               <th>Start Time</th>
									               <th>End Time</th>
									               <th>Total Hours</th>
									               <th>Memo</th>
									            </tr>
									        </thead>
									        <tbody>
									            <tr role="row" class="odd">
									               <td class="" tabindex="0">3</td>
									               <td><a href="#">Lemuel Padberg</a></td>
									               <td>16-08-2019 10:25am</td>
									               <td>22-08-2019 04:25pm</td>
									               <td>164hrs</td>
									               <td>working onet</td>
									            </tr>
									            <tr role="row" class="odd">
									               <td class="" tabindex="0">2</td>
									               <td><a href="#">Zemole Meeting</a></td>
									               <td>19-08-2019 10:00am</td>
									               <td>08-08-2019 08:22pm</td>
									               <td>159hrs</td>
									               <td>working onet</td>
									            </tr>
									            <tr role="row" class="odd">
									               <td class="" tabindex="0">1</td>
									               <td><a href="#">Lemuel Padberg</a></td>
									               <td>16-08-2019 10:25am</td>
									               <td>22-08-2019 04:25pm</td>
									               <td>121hrs</td>
									               <td>working onet</td>
									            </tr>
									            <tr role="row" class="odd">
									               <td class="" tabindex="0">4</td>
									               <td><a href="#">Zemole Tombaarg</a></td>
									               <td>19-12-2019 10:00am</td>
									               <td>08-11-2019 08:22pm</td>
									               <td>109hrs</td>
									               <td>working onet</td>
									            </tr>
									        </tbody>
									    </table>
									</div>
							  	</div>
							  	<!-- 7 -->
							  	<div class="tab-pane fade" id="documents" role="tabpanel" aria-labelledby="documents-tab">
							  		<button class="btn btn-sm btn-info addDocs" onclick="" data-toggle="modal" data-target="#emp-docs"><i class="fa fa-plus"></i> Add</button>
							  		<br><br>
							  		<div class="table-responsive">
				                        <table class="table">
				                            <thead>
				                            <tr>
				                                <th>#</th>
				                                <th width="70%">Name</th>
				                                <th>Action</th>
				                            </tr>
				                            </thead>
				                            <tbody id="employeeDocsList">
				                            	<tr>
											        <td>1</td>
											        <td>Mahesh</td>
											        <td>
											            <a href="javascript:;" data-toggle="tooltip" data-original-title="Download" class="btn btn-inverse btn-circle"><i class="fa fa-download"></i></a>
											            <a target="_blank" href="javascript:;" data-toggle="tooltip" data-original-title="View" class="btn btn-info btn-circle"><i class="fa fa-search"></i></a>
											            <a href="javascript:;" data-toggle="tooltip" data-original-title="Delete" data-file-id="1" data-pk="list" class="btn btn-danger btn-circle sa-params"><i class="fa fa-times"></i></a>
											        </td>
											    </tr>
											</tbody>
				                        </table>
                    				</div>
							  	</div>
							</div>
		                </div>
                	</div>
                </div>
            </div>
            <!-- ends of contentwrap -->