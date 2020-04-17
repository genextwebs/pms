<nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><i class="icon-speedometer"></i> Dashboard</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url().'dashboard'?>">Home</a></li>
                            <li><a href="<?php echo base_url().'Project/projecttemplate'?>">Project Template</a></li>
                            <?php
                            $controller = $this->uri->segment(1);
                            $function = $this->uri->segment(2);
                            if($controller == 'Project' && $function == 'templateMember'){
                            ?>
                            <li><a>Members</a></li>
                        <?php } ?>
                        </ol>
                    </div>
                </div>
            </nav>

            <!-- contetn-wrap -->
            <div class="content-in">  
                <div class="row">
                    <div class="col-md-12">
	                    <section class="cview-detai seven-tab">
			                <div class="stats-box">
			                	<ul class="nav nav-tabs" id="myTab" role="tablist">
								  	<li class="nav-item">
								    	<a class="nav-link <?php if($controller == 'Project' && $function == 'templateOverView') { echo "active";}?>" id="overview-tab" data-toggle="tab" href="<?php echo base_url().'Project/templateOverView/'.base64_encode($id)?>" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
								  	</li>
								  	<li class="nav-item" >
								    	<a class="nav-link <?php if($controller == 'Project' && $function == 'templateMember') { echo "active";}?>" id="members-tab" data-toggle="tab" href="<?php echo base_url().'Project/templateMember/'.base64_encode($id)?>" role="tab" aria-controls="members" aria-selected="false">Members</a>
								  	</li>
								  	
								  	<li class="nav-item">
								    	<a class="nav-link " id="tasks-tab" data-toggle="tab" href="#tasks" role="tab" aria-controls="tasks" aria-selected="false">Tasks</a>
								  	</li>
								</ul>
			                </div>
			                <div class="contetn-tab">
		            			<div id="" class="">
		            				<div class="tab-content" id="myTabContent">
		            					<!-- tab1 -->
									  <div class="tab-pane fade section-1 <?php if($controller == 'Project' && $function == 'templateOverView') { echo "active show";}?>" id="overview" role="tabpanel" aria-labelledby="overview-tab">
					            			<div class="row">
					            				<div class="col-md-12">
					            					<div class="stats-box">
						            					<h3 class="b-b pb-2">Project #20 -<span class="font-bold"><?php echo $client[0]->projectname; ?></span> <a href="<?php echo base_url().'Project/editproject/'.base64_encode($id); ?>" class="pull-right btn btn-outline-info btn-rounded edit-btn" style="font-size: small"><i class="icon-note"></i> Edit</a> </h3>
						            					<div style="max-height: 400px; overflow-y: auto;">
					                                        Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy.
					                                    </div>
							            			</div>
					            				</div>
					            				<!-- <div class="col-md-6">
					            					<div id="project-milestones" class="stats-box">
					            						<h3 class="box-title">
					            							<i class="fa fa-flag"></i> Milestones (0)

					            							<a href="#" class="text-success float-right"><i class="fa fa-plus"></i> Create Milestone</a>
					            						</h3>
					            						<div class="" style="max-height: 400px; overflow-y: auto;">
					            							No record found.
					            						</div>
					            					</div>
					            				</div> -->
					            				<div class="col-md-6">
					            					<div id="active-timers" class="stats-box">
					            						<h3 class="box-title b-b"><i class="fa fa-clock-o"></i> Active Timers</h3>
					            						<div class="table-responsive">
					                                        <table class="table">
					                                            <thead>
					                                                <tr>
					                                                    <th>#</th>
					                                                    <th>Who's Working</th>
					                                                    <th>Active Since</th>
					                                                    <th>&nbsp;</th>
					                                                </tr>
					                                            </thead>
					                                            <tbody id="timer-list">
                           											<tr>
					                                                    <td colspan="3">No active timer.</td>
					                                                </tr>
                                          						</tbody>
					                                        </table>
					                                    </div>
					            					</div>
					            				</div>
					            			</div>
					            			<div class="row">
					            				<div class="col-md-12">
					            					<div class="stats-box">
					            						<div class="row row-ini">
					            							<div class="col-lg-3 col-md-6 row-ini-br">
					            								<div class="col-in row">
					                                                <div class="col-md-6 col-sm-6 col-xs-6"><i class="ti-layout-list-thumb"></i>
					                                                    <h5 class="text-muted vb">Open Tasks</h5>
					                                                </div>
					                                                <div class="col-md-6 col-sm-6 col-xs-6">
					                                                    <h3 class="counter text-right m-t-15 text-danger">0</h3>
					                                                </div>
					                                                <div class="col-md-12 col-sm-12 col-xs-12">
					                                                    <div class="progress hight-4px">
																		  	<div class="progress-bar bg-danger" style="width:0%;"></div>
																		</div>
					                                                </div>
					                                            </div>
					            							</div>
					            							<div class="col-lg-3 col-md-6 row-ini-br b-r-none">
					            								<div class="col-in row">
					                                                <div class="col-md-6 col-sm-6 col-xs-6"><i class="ti-calendar"></i>
					                                                    <h5 class="text-muted vb">Days Left</h5>
					                                                </div>
					                                                <div class="col-md-6 col-sm-6 col-xs-6">
					                                                    <h3 class="counter text-right m-t-15 text-info">0</h3>
					                                                </div>
					                                                <div class="col-md-12 col-sm-12 col-xs-12">
					                                                    <div class="progress hight-4px">
																		  	<div class="progress-bar bg-info" style="width:0%;"></div>
																		</div>
					                                                </div>
					                                            </div>
					            							</div>
					            							<div class="col-lg-3 col-md-6 row-ini-br">
					            								<div class="col-in row">
					                                                <div class="col-md-6 col-sm-6 col-xs-6"><i class="ti-alarm-clock"></i>
					                                                    <h5 class="text-muted vb">Hours Logged</h5>
					                                                </div>
					                                                <div class="col-md-6 col-sm-6 col-xs-6">
					                                                    <h3 class="counter text-right m-t-15 text-success"><?php echo $client[0]->hoursallocated; ?></h3>
					                                                </div>
					                                                <div class="col-md-12 col-sm-12 col-xs-12">
					                                                    <div class="progress hight-4px">
																		  	<div class="progress-bar bg-success" style="width:100%;"></div>
																		</div>
					                                                </div>
					                                            </div>
					            							</div>
					            							<div class="col-lg-3 col-md-6 b-0">
					            								<div class="col-in row">
					                                                <div class="col-md-6 col-sm-6 col-xs-6"><i class="ti-alert"></i>
					                                                    <h5 class="text-muted vb">Completion</h5>
					                                                </div>
				                                                    <div class="col-md-6 col-sm-6 col-xs-6">
			                                                            <h3 class="counter text-right m-t-15 text-warning">68%</h3>
			                                                        </div>
			                                                        <div class="col-md-12 col-sm-12 col-xs-12">
			                                                            <div class="progress hight-4px">
																		  	<div class="progress-bar bg-warning" style="width:68%;"></div>
																		</div>
			                                                        </div>
			                                            		</div>
					            							</div>
					            						</div>
					            					</div>
					            				</div>
					            			</div>
					            			<div class="row">
		            							<div class="col-md-3">
							                        <div class="stats-box bg-black pt-1 pb-1">
										                <h3 class="box-title text-white">Project Budget</h3>
										                <ul class="list-inline two-wrap">
										                    <li><i class="fa fa-money text-white"></i></li>
										                    <li class="text-right"><span id="" class="counter text-white">--</span></li>
										                </ul>
										            </div>
							                    </div>
							                    <div class="col-md-3">
							                        <div class="stats-box bg-success pt-1 pb-1">
										                <h3 class="box-title text-white">Earnings                                            <a href="javascript:void(0)"> <i class="fa fa-info-circle text-white"></i></a>
                                    					</h3>
										                <ul class="list-inline two-wrap">
										                    <li><i class="fa fa-money text-white"></i></li>
										                    <li class="text-right"><span id="" class="counter text-white">0</span></li>
										                </ul>
										            </div>
							                    </div>
							                    <div class="col-md-3">
							                        <div class="stats-box bg-info pt-1 pb-1">
										                <h3 class="box-title text-white">Hours Allocated</h3>
										                <ul class="list-inline two-wrap">
										                    <li><i class="ti-alarm-clock text-white"></i></li>
										                    <li class="text-right"><span id="" class="counter text-white">--</span></li>
										                </ul>
										            </div>
							                    </div>
							                    <div class="col-md-3">
							                        <div class="stats-box bg-warning pt-1 pb-1">
										                <h3 class="box-title text-white">Expenses <a href="javascript:void(0)"> <i class="fa fa-info-circle text-white"></i></a></h3>
										                <ul class="list-inline two-wrap">
										                    <li><i class="fa fa-money text-white"></i></li>
										                    <li class="text-right"><span id="" class="counter text-white">0</span></li>
										                </ul>
										            </div>
							                    </div>
		            						</div>
		            						<div class="row">
		            							<div class="col-lg-9 col-md-8">
		            								<div class="row">
		            									<div class="col-md-6">
		            										<div class="card br-0">
		            											<div class="card-header">
		            												Client Details
		            											</div>
		            											<div class="card-body">
		            												<dl>
                                                                        <dt>Company Name</dt>
				                                                        <dd class="m-b-10"><?php echo $client[0]->companyname;?></dd>
				                                                        
				                                                        <dt>Client Name</dt>
				                                                        <dd class="m-b-10"><?php echo $client[0]->clientname;?></dd>

				                                                        <dt>Client Email</dt>
				                                                        <dd class="m-b-10"><?php echo $clientEmail[0]->emailid;?></dd>
				                                                    </dl>
		            											</div>
		            										</div>
		            									</div>
		            									<div class="col-md-6">
		            										<div class="card br-0">
		            											<div class="card-header">
		            												Members
		            											</div>
		            											<div class="card-body">
		            												<div class="message-center">
		            													<?php foreach($projectMember as $pm) { ?>
				                                                        <a href="#">
				                                                            <div class="user-img">
				                                                                <img src="images/user-avtar.png" alt="user" class="img-circle" width="40" height="40">
				                                                            </div>
				                                                            <div class="mail-contnet">
				                                                                <h5><?php echo $pm->employeename;?></h5>
				                                                                <span class="mail-desc"><?php echo $pm->emailid; ?></span>
				                                                            </div>
				                                                        </a>
				                                                        <?php } ?>
				                                                    </div>
		            											</div>
		            										</div>
		            									</div>
		            								</div>
		            								<div class="row">
		            									<div class="col-md-6">
		            										<div class="card br-0">
		            											<div class="card-header">
		            												Open Tasks
		            											</div>
		            											<div class="card-body">
		            												<ul class="list-border-none list-task list-group" data-role="tasklist">
																	    <li class="list-group-item" data-role="task">
																	        <strong>Title</strong> <span class="pull-right"><strong>Due Date</strong></span>
																	    </li>
																	    <li class="list-group-item" data-role="task">
																	        <div class="row">
																	        	<div class="col-8">
																		            1. I beg your.
																		        </div>
																		        <label class="label label-danger pull-right col-4">09-08-2019</label>
																	        </div>
																	    </li>
																	</ul>
		            											</div>
		            										</div>
		            									</div>
		            									<div class="col-md-6">
		            										<div class="card br-0">
		            											<div class="card-header">
		            												Files
		            											</div>
		            											<div class="card-body">
		            												You have not uploaded any file. 
		            											</div>
		            										</div>
		            									</div>
		            								</div>
		            							</div>
		            							<div id="project-timeline" class="col-lg-3 col-md-4">
		            								<div class="card br-0">
            											<div class="card-header">
            												Activity Timeline
            											</div>
            											<div class="card-body">
            												<div class="time_line">
            													<div class="tl-grid">
            														<div class="tl-left">
            															<i class="fa fa-circle text-info"></i>
            														</div>
            														<div class="tl-right">
            															<div>
            																<h6>New member added to the Project.</h6>
            																<span class="tl-date">2 minutes ago</span>
            															</div>
            														</div>
            													</div>
            													<div class="tl-grid">
            														<div class="tl-left">
            															<i class="fa fa-circle text-info"></i>
            														</div>
            														<div class="tl-right">
            															<div>
            																<h6>New task add to the Project.</h6>
            																<span class="tl-date">2 minutes ago</span>
            															</div>
            														</div>
            													</div>
            													<div class="tl-grid">
            														<div class="tl-left">
            															<i class="fa fa-circle text-info"></i>
            														</div>
            														<div class="tl-right">
            															<div>
            																<h6>New member added to the Project.</h6>
            																<span class="tl-date">2 minutes ago</span>
            															</div>
            														</div>
            													</div>
            													<div class="tl-grid">
            														<div class="tl-left">
            															<i class="fa fa-circle text-info"></i>
            														</div>
            														<div class="tl-right">
            															<div>
            																<h6>New task add to the Project.</h6>
            																<span class="tl-date">2 minutes ago</span>
            															</div>
            														</div>
            													</div>
            													<div class="tl-grid">
            														<div class="tl-left">
            															<i class="fa fa-circle text-info"></i>
            														</div>
            														<div class="tl-right">
            															<div>
            																<h6>New member added to the Project.</h6>
            																<span class="tl-date">2 minutes ago</span>
            															</div>
            														</div>
            													</div>
            													<div class="tl-grid">
            														<div class="tl-left">
            															<i class="fa fa-circle text-info"></i>
            														</div>
            														<div class="tl-right">
            															<div>
            																<h6>New task add to the Project.</h6>
            																<span class="tl-date">2 minutes ago</span>
            															</div>
            														</div>
            													</div>
            													<div class="tl-grid">
            														<div class="tl-left">
            															<i class="fa fa-circle text-info"></i>
            														</div>
            														<div class="tl-right">
            															<div>
            																<h6>New member added to the Project.</h6>
            																<span class="tl-date">2 minutes ago</span>
            															</div>
            														</div>
            													</div>
            													<div class="tl-grid">
            														<div class="tl-left">
            															<i class="fa fa-circle text-info"></i>
            														</div>
            														<div class="tl-right">
            															<div>
            																<h6>New task add to the Project.</h6>
            																<span class="tl-date">2 minutes ago</span>
            															</div>
            														</div>
            													</div>
            												</div>
            											</div>
            										</div>
		            							</div>
		            						</div>
									  </div>
									  	<!-- tab2 -->
									 	<div class="tab-pane fade section-2 <?php if($controller == 'Project' && $function == 'templateMember') { echo "active show";}?>" id="members" role="tabpanel" aria-labelledby="members-tab">
					            			<div class="row">
					            				<div class="col-md-6">
					            					<div class="card">
					            						<div class="card-header">
					            							Members
					            						</div>
					            						<div class="card-body">
					            							<table class="table">
															    <thead>
															        <tr>
															            <th>Name</th>
															            
															            <th>Action</th>
															        </tr>
															    </thead>
															    <tbody>
															    	<?php
															    		for($i=0 ; $i<$emp_count;$i++){
															    			$temp_id = $temp_member[$i]->memberid;
															    	?>
															        <tr id="<?php echo $temp_id; ?>-tr">
															            <td>
															                <div class="row">
															                    <div class="col-sm-3 col-xs-4">
															                        <img src="images/user-avtar.png" alt="user" class="img-circle" width="40">
															                    </div>
															                    <div class="col-sm-9 col-xs-8">

															                        <?php echo $temp_member[$i]->employeename?><br>
															                        
															                    </div>
															                </div>
															            </td>
															            <td><a href="javascript:;" class="btn btn-sm btn-danger btn-rounded delete-members" onclick="deleteTemplateM('<?php echo base64_encode($temp_id); ?>')"><i class="fa fa-times"></i> Remove</a></td>
															        </tr>
															    <?php } ?>
															    </tbody>
															</table>
					            						</div>
					            					</div>
					            				</div>
					            				<div class="col-md-6">
					            					<?php
					                                    $mess = $this->session->flashdata('message_name');
					                                    if(!empty($mess)){
					                                        //warning 
					                                ?>
					                            <div class="submit-alerts">
													<div class="alert alert-danger" role="alert" style="display:block;">
													 <?php echo $mess; ?>
													</div>
					                            </div>
					                            <?php  } ?>
					            					<div class="stats-box">
					            						<h3>Add Template Members</h3>
					            						<form method="post" action="<?php echo base_url().'project/insertTemplateMember/'.base64_encode($id) ?>">
					            							<div class="form-group">
					            								<select multiple class="form-control" name="choose_member[]" placeholder="choose Members">
					            								<option value="">All</option>
							                                    <?php foreach($employee as $row){
												            	?>
												            	<option value="<?php echo $row->id?>"><?php echo $row->employeename;?></option>
												            	<?php
												            	}
												            	?> 
					            								</select>
					            							</div>
					            							<input type="hidden" value="<?php echo $id;?>" name="templateid">
					            							<div class="form-actions">
					            								<input type="submit" value="submit" id="save-members" class="btn btn-success"><i class="fa fa-check"></i>
					            								<!--<i class="fa fa-check"></i><a href="javascript:void();" onclick="" class="btn btn-success">Remove</a>-->
				                                                
				                                            </div>
					            						</form>
					            						<hr>
					            						<h3>Add Team</h3>
					            						<form>
					            							<div class="form-group">
					            								<input type="text" class="form-control" name="choose_team" placeholder="choose Team">
					            							</div>
					            							<div class="form-actions">
				                                                <button type="submit" id="save-members" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
				                                            </div>
					            						</form>
					            					</div>
					            				</div>
					            			</div>
									 	</div>
									 	<!-- tab3 -->
									  	
									  	<!-- tab4 -->
									  	<div class="tab-pane fade" id="tasks" role="tabpanel" aria-labelledby="tasks-tab">
									  		<div class="row mb-2">
									  			<div id="new-tadk-panel" class="col-md-12">
									  				<div class="card">
									  					<div class="card-header">
									  						<i class="ti-plus"></i> New Task 
									  						<div class="card-action">
	                                                            <a href="javascript:;" id="hide-new-task-panel"><i class="ti-close"></i></a>
	                                                        </div>
									  					</div>
									  					<div class="card-wrapper collapse show">
													        <div class="card-body">
													           	<form class="">
													           		<div class="form-body">
													           			<div class="row">
													           				<div class="col-md-12">
									                							<div class="form-group">
										                							<label class="control-label">Title</label>
										                							<input type="text" class="form-control" id="title-task" name="title-task">
										                						</div>
									                						</div>
									                						<div class="col-md-12">
									                							<div class="form-group">
									                							 	<label class="control-label">Description</label>
									                							 	<textarea name="editor3"></textarea>
									                							</div>
									                						</div>
									                						<div class="col-md-12">
									                							<div class="form-group">
									                								<label class="control-label">start Date</label>
									                								<input id="start_date" type="text" class="form-control" name="">
									                							</div>
									                						</div>
									                						<div class="col-md-12">
									                							<div class="form-group">
									                								<label class="control-label">Due Date</label>
									                								<input id="due_date" type="text" class="form-control" name="due_date">
									                							</div>
									                						</div>
									                						<div class="col-md-12">
									                							<div class="form-group sm-box">
									                								<label class="control-label">Milestones</label>
									                							 	<select class="custom-select br-0">
										                								<option selected="">--</option>
										                							</select>
									                							</div>
									                						</div>
									                						<div class="col-md-12">
									                							<div class="form-group sm-box">
									                								<label class="control-label">Assigned To</label>
									                							 	<select class="custom-select br-0">
										                								<option selected="">Choose Assignee</option>
										                								<option>Lian Morissette</option>
										                							</select>
									                							</div>
									                						</div>
									                						<div class="col-md-12">
									                							<div class="form-group">
									                								<label class="control-label">Assigned To</label>
									                							 	<select class="custom-select br-0">
										                								<option selected="">Choose Assignee</option>
										                								<option>Lian Morissette</option>
										                							</select>
									                							</div>
									                						</div>
									                						<div class="col-md-12">
										                						<div class="form-group">
										                							<label class="control-label">
										                								Task Category
										                								<a href="javascript:void(0);" class="btn btn-sm btn-outline-success ml-1" data-original-title="Edit" data-toggle="modal" data-target="#add-task-categ">
																			         		<i class="fa fa-plus"></i> Add Task Category</i>
																			         	</a>
										                							</label>
										                							<select class="custom-select br-0">
										                								<option selected="">No task category added.</option>
										                							</select>
										                						</div>
										                					</div>
										                					<div class="col-md-12">
										                						<div class="form-group">
										                							<label class="control-label">Priority</label>
										                							<div class="custom-control custom-radio radio-danger">
																					    <input type="radio" class="custom-control-input" id="high-rad" name="radio-stacked" required="">
																					    <label class="custom-control-label text-danger" for="high-rad">High</label>
																					</div>
																					<div class="custom-control custom-radio radio-warning">
																					    <input type="radio" class="custom-control-input" id="medium-rad" name="radio-stacked" required="">
																					    <label class="custom-control-label text-warning" for="medium-rad">Medium</label>
																					</div>
																					<div class="custom-control custom-radio radio-success">
																					    <input type="radio" class="custom-control-input" id="low-rad" name="radio-stacked" required="">
																					    <label class="custom-control-label text-success" for="low-rad">Low</label>
																					</div>
										                						</div>
										                					</div>
													           			</div>
													           		</div>
													           		<div class="form-actions">
													           			
													           		</div>
													           	</form>
													        </div>
													    </div>
									  				</div>
									  			</div>
									  		</div>
					            			<div class="stats-box">
					            				<h2>Tasks</h2>
					            				<div class="row mb-2">
												    <div class="col-md-6">
												        <a href="javascript:void(0);" id="show-new-task-panel" class="btn btn-outline-success btn-sm"> <i class="fa fa-plus"></i> New Task</a>
												        <a href="javascript:void(0);" class="btn btn-sm btn-outline-info ml-1" data-original-title="Edit" data-toggle="modal" data-target="#add-task-categ">
											         		<i class="fa fa-plus"></i> Add Task Category</i>
											         	</a>
												    </div>
												</div>
												<div class="table-responsive mt-5">
												    <table class="table table-bordered" id="tasks-table">
												        <thead>
												            <tr role="row">
												                <th>Id</th>
												                <th>Task</th>
												                <th>Client</th>
												                <th>Assigned To</th>
												                <th>Assigned By</th>
												                <th>Due Date</th>
												                <th>Status</th>
												                <th>Action</th>
												            </tr>
												        </thead>
												        <tbody>
												            <tr>
												                <td>69</td>
												                <td><a href="javascript:;">Gryphon said to.</a></td>
												                <td>Alice Gerlach</td>
												                <td><img src="https://demo.worksuite.biz/default-profile-2.png" alt="user" class="img-circle" width="30">  Lyric Blanda</td>
												                <td>-</td>
												                <td><span class="text-danger">01-08-2019</span></td>
												                <td><label class="badge badge-info" style="background-color: #d21010">Incomplete</label></td>
												                <td>
												                    <a href="javascript:;" class="btn btn-info btn-circle edit-task" data-toggle="tooltip" data-task-id="69" data-original-title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a> &nbsp;
												                    <a href="javascript:;" class="btn btn-danger btn-circle sa-params" data-toggle="tooltip" data-task-id="69" data-original-title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>
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
		            	</section>
		            </div>
                </div>
            </div>
            <!-- ends of contentwrap -->

            <!-- footer -->
            <footer>
                <p>2019 &copy; PMS</p>
            </footer>
            <!-- ends of footer -->
            <!-- add task category -->
            <div class="modal fade" id="add-task-categ" tabindex="-1" role="dialog" aria-labelledby="add-task-categtitle" aria-hidden="true">
            	<div class="modal-dialog modal-md" role="document">
            		<div class="modal-content">
            			<div class="modal-header">
            				<h4 class="modal-title">Task Category</h4>
            				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
            					<span aria-hidden="true">&times;</span>
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
					                    <tr>
					                        <td colspan="3">No task category found.</td>
					                    </tr>
					                </tbody>
					            </table>
					        </div>
					        <hr>
					        <form id="createTaskCategoryForm" class="">
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
						            <button type="button" id="save-category" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
						        </div>
						    </form>
            			</div>
            		</div>
            	</div>
            </div>
            <!-- end add task category. -->
        </div>
    </div>

    







