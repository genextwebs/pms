<nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><i class="icon-speedometer"></i> Dashboard</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url().'dashboard'?>">Home</a></li>
                            <li><a href="<?php echo base_url().'project'?>">Projects</a></li>
                            <?php
                            $controller = $this->uri->segment(1);
                            $function = $this->uri->segment(2);
                            if($controller == 'Project' && $function == 'member'){
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
								    	<a class="nav-link" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
								  	</li>
								  	<li class="nav-item" >
								    	<a class="nav-link <?php if($controller == 'Project' && $function == 'member') { echo "active";}?>" id="members-tab"  href="<?php echo base_url().'Project/member/'.base64_encode($id)?>" role="tab" aria-controls="members" aria-selected="false">Members</a>
								  	</li>
								  	
								  	<li class="nav-item">
								    	<a class="nav-link <?php if($controller == 'Project' && $function == 'task') { echo "active";}?>" id="tasks-tab"  href="<?php echo base_url().'Project/task/'.base64_encode($id)?>" role="tab" aria-controls="tasks" aria-selected="false">Tasks</a>
								  	</li>
								  	<li class="nav-item">
								    	<a class="nav-link" id="files-tab" data-toggle="tab" href="#files" role="tab" aria-controls="files" aria-selected="false">Files</a>
								  	</li>
								  	<li class="nav-item">
								    	<a class="nav-link" id="invoices-tab" data-toggle="tab" href="#invoices" role="tab" aria-controls="invoices" aria-selected="false">Invoices</a>
								  	</li>
								  	<li class="nav-item">
								    	<a class="nav-link" id="timelogs-tab" data-toggle="tab" href="#timelogs" role="tab" aria-controls="timelogs" aria-selected="false">Time Logs</a>
								  	</li>
								</ul>
			                </div>
			                <div class="contetn-tab">
		            			<div id="" class="">
		            				<div class="tab-content" id="myTabContent">
		            					<!-- tab1 -->
									  	<div class="tab-pane fade section-1" id="overview" role="tabpanel" aria-labelledby="overview-tab">
					            			<div class="row">
					            				<div class="col-md-12">
					            					<div class="stats-box">
						            					<h3 class="b-b pb-2">Project #20 -<span class="font-bold">Server Installation</span> <a href="#" class="pull-right btn btn-outline-info btn-rounded edit-btn" style="font-size: small"><i class="icon-note"></i> Edit</a> </h3>
						            					<div style="max-height: 400px; overflow-y: auto;">
					                                        Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy.
					                                    </div>
							            			</div>
					            				</div>
					            				<div class="col-md-6">
					            					<div id="project-milestones" class="stats-box">
					            						<h3 class="box-title">
					            							<i class="fa fa-flag"></i> Milestones (0)

					            							<a href="#" class="text-success float-right"><i class="fa fa-plus"></i> Create Milestone</a>
					            						</h3>
					            						<div class="" style="max-height: 400px; overflow-y: auto;">
					            							No record found.
					            						</div>
					            					</div>
					            				</div>
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
					                                                    <h3 class="counter text-right m-t-15 text-success">3233</h3>
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
				                                                        <dd class="m-b-10">Kuhn, O'Kon and Bode</dd>
				                                                        
				                                                        <dt>Client Name</dt>
				                                                        <dd class="m-b-10">Calista Monahan</dd>

				                                                        <dt>Client Email</dt>
				                                                        <dd class="m-b-10">norris65@example.net</dd>
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
				                                                        <a href="#">
				                                                            <div class="user-img">
				                                                                <img src="images/user-avtar.png" alt="user" class="img-circle" width="40" height="40">
				                                                            </div>
				                                                            <div class="mail-contnet">
				                                                                <h5>Mr. Hans Pfannerstill Jr.</h5>
				                                                                <span class="mail-desc">sharon.effertz@example.com</span>
				                                                            </div>
				                                                        </a>
				                                                        <a href="#">
				                                                            <div class="user-img">
				                                                                <img src="images/user-avtar.png" alt="user" class="img-circle" width="40" height="40">
				                                                            </div>
				                                                            <div class="mail-contnet">
				                                                                <h5>Dr. Troy Franecki</h5>
				                                                                <span class="mail-desc">magali22@example.org</span>
				                                                            </div>
				                                                        </a>
				                                                        <a href="#">
				                                                            <div class="user-img">
				                                                                <img src="images/user-avtar.png" alt="user" class="img-circle" width="40" height="40">
				                                                            </div>
				                                                            <div class="mail-contnet">
				                                                                <h5>Mr. Hans Pfannerstill Jr.</h5>
				                                                                <span class="mail-desc">sharon.effertz@example.com</span>
				                                                            </div>
				                                                        </a>
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
									 	<div class="tab-pane section-2 <?php if($controller == 'Project' && $function == 'member') { echo "active show";}?>" id="members" role="tabpanel" aria-labelledby="members-tab">
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
															            <th>User Role</th>
															            <th>Action</th>
															        </tr>
															    </thead>
															    <tbody>
															    	<?php
															    		for($i=0 ; $i<$emp_count;$i++){
															    			$project_member_id = $member[$i]->memberid;
															    	?>
															        <tr id="<?php echo $project_member_id; ?>-tr">
															            <td>
															                <div class="row">
															                    <div class="col-sm-3 col-xs-4">
															                        <img src="images/user-avtar.png" alt="user" class="img-circle" width="40">
															                    </div>
															                    <div class="col-sm-9 col-xs-8">

															                        <?php echo $member[$i]->employeename?><br>
															                        <span class="text-muted font-12">Developer</span>
															                    </div>
															                </div>
															            </td>
															            <td>
															                <div class="custom-control custom-radio radio-info">
																			    <input type="radio" class="custom-control-input" id="pro-admin" name="radio-stacked" required>
																			    <label class="custom-control-label" for="pro-admin">Project Admin</label>
																			</div>
															            </td>
															            <td><a href="javascript:;" class="btn btn-sm btn-danger btn-rounded delete-members" onclick="deleteProjectM('<?php echo base64_encode($project_member_id); ?>')"><i class="fa fa-times"></i> Remove</a></td>
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
					            						<h3>Add Project Members</h3>
					            						<form method="post" action="<?php echo base_url().'project/insertProjectMember/'.base64_encode($id) ?>">
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
					            							<input type="hidden" value="<?php echo $id;?>" name="projectid">
					            							<div class="form-actions">
				                                                <input type="submit" value="submit" id="save-members" class="btn btn-success"><i class="fa fa-check"></i>
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
									  	<div class="tab-pane <?php if($controller == 'Project' && $function == 'task') { echo "active show";}?>" id="tasks" role="tabpanel" aria-labelledby="tasks-tab">
									  		<div class="row mb-2" style="display:none;" id="task_show">
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
													           	<form method="post" action="<?php echo base_url().'project/insertTask'?>" name="task_category">
													           		<div class="form-body">
													           			<div class="row">
													           				<div class="col-md-12">
									                							<div class="form-group">
										                							<label class="control-label">Title</label>
										                							<input type="text" class="form-control" id="title-task" name="title_task">
										                						</div>
									                						</div>
									                						<div class="col-md-12">
									                							<div class="form-group">
									                							 	<label class="control-label">Description</label>
									                							 	<textarea name="editor1"></textarea>
									                							</div>
									                						</div>
									                						<div class="col-md-12">
									                							<div class="form-group">
									                								<label class="control-label">start Date</label>
									                								<input id="start_date" type="text" class="form-control" name="startdate">
									                							</div>
									                						</div>
									                						<div class="col-md-12">
									                							<div class="form-group">
									                								<label class="control-label">Due Date</label>
									                								<input id="deadline" type="text" class="form-control" name="due_date">
									                							</div>
									                						</div>

									                						<div class="col-md-12">
									                							<div class="form-group sm-box">
									                								<label class="control-label">Assigned To</label>
									                							 	<select class="custom-select br-0" name="assignemp">
									                							 		>
										                								<?php foreach($employee as $row){
												            							?>
																	            		<option value="<?php echo $row->id?>"><?php echo $row->employeename;?></option>
																	            		<?php
																	            		}
																	            		?> 
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
										                							<select class="custom-select br-0" id="task-category" name="task-category">
										                							<?php
										                								foreach($taskCat as $catData){
										                							?>
										                								<option value="<?php echo $catData->id; ?>"><?php echo $catData->task_category_name; ?></option>
										                							<?php
										                								}
										                							?>	
										                							</select>
										                						</div>
										                					</div>
										                					<div class="col-md-12">
										                						<div class="form-group">
										                							<label class="control-label">Priority</label>
										                							<div class="custom-control custom-radio radio-danger">
																					    <input type="radio" class="custom-control-input" id="high-rad" name="radio-stacked" value="0"required="">
																					    <label class="custom-control-label text-danger" for="high-rad">High</label>
																					</div>
																					<div class="custom-control custom-radio radio-warning">
																					    <input type="radio" class="custom-control-input" id="medium-rad" name="radio-stacked" value="1"required="">
																					    <label class="custom-control-label text-warning" for="medium-rad">Medium</label>
																					</div>
																					<div class="custom-control custom-radio radio-success">
																					    <input type="radio" class="custom-control-input" id="low-rad" name="radio-stacked" value="2"required="">
																					    <label class="custom-control-label text-success" for="low-rad">Low</label>
																					</div>
																					<input type="hidden" value="<?php echo $id; ?>" name="projectid">
										                						</div>
										                					</div>
													           			</div>
													           		</div>
													           		<div class="form-actions">
													           			<button type="submit" id="save-task" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
													           		</div>
													           	</form>
													        </div>
													    </div>
									  				</div>
									  			</div>
									  		</div>
									  		<div class="row mb-2"  id="update_task_show" style="display: none;">
									  			<div id="new-tadk-panel" class="col-md-12">
									  				<div class="card">
									  					<div class="card-header">
									  						<i class="ti-pencil"></i> Update Task 
									  						<div class="card-action">
	                                                            <a href="javascript:;" id="hide-update-task-panel"><i class="ti-close"></i></a>
	                                                        </div>
									  					</div>
									  					<div class="card-wrapper collapse show">
													        <div class="card-body">
													           	<form method="post" name="task_category">
													           		<div class="form-body">
													           			<div class="row">
													           				<div class="col-md-12">
									                							<div class="form-group">
										                							<label class="control-label">Title</label>
										                							<input type="text" class="form-control" id="title_task" name="title_task" value="">
										                						</div>
									                						</div>
									                						<div class="col-md-12">
									                							<div class="form-group">
									                							 	<label class="control-label">Description</label>
									                							 	<textarea name="editor1" id="description"></textarea>
									                							</div>
									                						</div>
									                						<div class="col-md-12">
									                							<div class="form-group">
									                								<label class="control-label">start Date</label>
									                								<input id="start_date1" type="text" class="form-control" name="startdate" value="" readonly="">
									                							</div>
									                						</div>
									                						<div class="col-md-12">
									                							<div class="form-group">
									                								<label class="control-label">Due Date</label>
									                								<input id="deadline1" type="text" class="form-control" name="due_date" value="" readonly="">
									                							</div>
									                						</div>

									                						<div class="col-md-12">
									                							<div class="form-group sm-box">
									                								<label class="control-label">Assigned To</label>
									                							 	<select class="custom-select br-0" name="assignemp" id="assignemp">
										                								<?php foreach($employee as $row){
												            							?>
																	            		<option value="<?php echo $row->id?>"><?php echo $row->employeename;?></option>
																	            		<?php
																	            		}
																	            		?> 
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
										                							<select class="custom-select br-0" id="task-category" name="task-category">
										                							<?php
										                								foreach($taskCat as $catData){
										                							?>
										                								<option value="<?php echo $catData->id; ?>"><?php echo $catData->task_category_name; ?></option>
										                							<?php
										                								}
										                							?>	
										                							</select>
										                						</div>
										                					</div>
										                					<div class="col-md-12">
										                						<div class="form-group">
										                							<label class="control-label">Priority</label>
										                							<div class="custom-control custom-radio radio-danger">
																					    <input type="radio" class="custom-control-input" id="high-rad" name="radio-stacked" value="0"required="">
																					    <label class="custom-control-label text-danger" for="high-rad">High</label>
																					</div>
																					<div class="custom-control custom-radio radio-warning">
																					    <input type="radio" class="custom-control-input" id="medium-rad" name="radio-stacked" value="1"required="">
																					    <label class="custom-control-label text-warning" for="medium-rad">Medium</label>
																					</div>
																					<div class="custom-control custom-radio radio-success">
																					    <input type="radio" class="custom-control-input" id="low-rad" name="radio-stacked" value="2"required="">
																					    <label class="custom-control-label text-success" for="low-rad">Low</label>
																					</div>
																					<input type="hidden" value="<?php echo $id; ?>" name="projectid">
										                						</div>
										                					</div>
													           			</div>
													           		</div>
													           		<div class="form-actions">
													           			<button type="submit" id="save-task" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
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
												               <!-- <th>Client</th>-->
												                <th>Assigned To</th>
												               <!-- <th>Assigned By</th>-->
												                <th>Due Date</th>
												                <th>Status</th>
												                <th>Action</th>
												            </tr>
												        </thead>
												        <tbody>
												            <!--<tr>
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
												            </tr>-->
												        </tbody>
												    </table>
												</div>
					            			</div>
									  	</div>
									  	
									  	<!-- tab5 -->
									  	<div class="tab-pane fade" id="files" role="tabpanel" aria-labelledby="files-tab">
					            			<div class="stats-box">
					            				
					            			</div>
									  	</div>
									  	<!-- tab6 -->
									  	<div class="tab-pane fade" id="invoices" role="tabpanel" aria-labelledby="invoices-tab">
					            			<div class="stats-box">
					            				<h2>Invoices</h2>
					            				<ul class="list-group" id="invoices-list">
												    <li class="list-group-item">
												        <div class="row">
												            <div class="col-sm-5 col-xs-12 m-b-10">
												                14957057798
												            </div>
												            <div class="col-sm-2 col-xs-3 m-b-10">
												                $ 27066
												            </div>
												            <div class="col-sm-2 col-xs-3 m-b-10">
												                <label class="label label-danger">Unpaid</label>
												            </div>
												            <div class="col-sm-3 col-xs-12 m-b-10">
												                <span class="m-r-10">11-07-2019</span>
												                <a href="#" data-toggle="tooltip" data-original-title="Download" class="btn btn-inverse btn-circle"><i class="fa fa-download"></i></a>
												                &nbsp;&nbsp;
												                <a href="javascript:;" data-toggle="tooltip" data-original-title="Delete" data-invoice-id="400" class="btn btn-danger btn-circle sa-params"><i class="fa fa-times"></i></a>
												            </div>
												        </div>
												    </li>
												    <li class="list-group-item">
												        <div class="row">
												            <div class="col-sm-5 col-xs-12 m-b-10">
												                14957054757
												            </div>
												            <div class="col-sm-2 col-xs-3 m-b-10">
												                $ 41372
												            </div>
												            <div class="col-sm-2 col-xs-3 m-b-10">
												                <label class="label label-danger">Unpaid</label>
												            </div>
												            <div class="col-sm-3 col-xs-12 m-b-10">
												                <span class="m-r-10">17-07-2019</span>
												                <a href="#" data-toggle="tooltip" data-original-title="Download" class="btn btn-inverse btn-circle"><i class="fa fa-download"></i></a>
												                &nbsp;&nbsp;
												                <a href="javascript:;" data-toggle="tooltip" data-original-title="Delete" data-invoice-id="399" class="btn btn-danger btn-circle sa-params"><i class="fa fa-times"></i></a>
												            </div>
												        </div>
												    </li>
												    <li class="list-group-item">
												        <div class="row">
												            <div class="col-sm-5 col-xs-12 m-b-10">
												                14957053139
												            </div>
												            <div class="col-sm-2 col-xs-3 m-b-10">
												                $ 22254
												            </div>
												            <div class="col-sm-2 col-xs-3 m-b-10">
												                <label class="label label-danger">Unpaid</label>
												            </div>
												            <div class="col-sm-3 col-xs-12 m-b-10">
												                <span class="m-r-10">28-07-2019</span>
												                <a href="#" data-toggle="tooltip" data-original-title="Download" class="btn btn-inverse btn-circle"><i class="fa fa-download"></i></a>
												                &nbsp;&nbsp;
												                <a href="javascript:;" data-toggle="tooltip" data-original-title="Delete" data-invoice-id="390" class="btn btn-danger btn-circle sa-params"><i class="fa fa-times"></i></a>
												            </div>
												        </div>
												    </li>
												    <li class="list-group-item">
												        <div class="row">
												            <div class="col-sm-5 col-xs-12 m-b-10">
												                14957054053
												            </div>
												            <div class="col-sm-2 col-xs-3 m-b-10">
												                $ 26986
												            </div>
												            <div class="col-sm-2 col-xs-3 m-b-10">
												                <label class="label label-success">Paid</label>
												            </div>
												            <div class="col-sm-3 col-xs-12 m-b-10">
												                <span class="m-r-10">14-07-2019</span>
												                <a href="#" data-toggle="tooltip" data-original-title="Download" class="btn btn-inverse btn-circle"><i class="fa fa-download"></i></a>
												                &nbsp;&nbsp;
												                <a href="javascript:;" data-toggle="tooltip" data-original-title="Delete" data-invoice-id="389" class="btn btn-danger btn-circle sa-params"><i class="fa fa-times"></i></a>
												            </div>
												        </div>
												    </li>
												    <li class="list-group-item">
												        <div class="row">
												            <div class="col-sm-5 col-xs-12 m-b-10">
												                14957053502
												            </div>
												            <div class="col-sm-2 col-xs-3 m-b-10">
												                $ 20277
												            </div>
												            <div class="col-sm-2 col-xs-3 m-b-10">
												                <label class="label label-danger">Unpaid</label>
												            </div>
												            <div class="col-sm-3 col-xs-12 m-b-10">
												                <span class="m-r-10">09-07-2019</span>
												                <a href="#" data-toggle="tooltip" data-original-title="Download" class="btn btn-inverse btn-circle"><i class="fa fa-download"></i></a>
												                &nbsp;&nbsp;
												                <a href="javascript:;" data-toggle="tooltip" data-original-title="Delete" data-invoice-id="388" class="btn btn-danger btn-circle sa-params"><i class="fa fa-times"></i></a>
												            </div>
												        </div>
												    </li>
												    <li class="list-group-item">
												        <div class="row">
												            <div class="col-sm-5 col-xs-12 m-b-10">
												                14957054597
												            </div>
												            <div class="col-sm-2 col-xs-3 m-b-10">
												                $ 37280
												            </div>
												            <div class="col-sm-2 col-xs-3 m-b-10">
												                <label class="label label-success">Paid</label>
												            </div>
												            <div class="col-sm-3 col-xs-12 m-b-10">
												                <span class="m-r-10">21-07-2019</span>
												                <a href="#" data-toggle="tooltip" data-original-title="Download" class="btn btn-inverse btn-circle"><i class="fa fa-download"></i></a>
												                &nbsp;&nbsp;
												                <a href="javascript:;" data-toggle="tooltip" data-original-title="Delete" data-invoice-id="387" class="btn btn-danger btn-circle sa-params"><i class="fa fa-times"></i></a>
												            </div>
												        </div>
												    </li>
												    <li class="list-group-item">
												        <div class="row">
												            <div class="col-sm-5 col-xs-12 m-b-10">
												                14957053775
												            </div>
												            <div class="col-sm-2 col-xs-3 m-b-10">
												                $ 37770
												            </div>
												            <div class="col-sm-2 col-xs-3 m-b-10">
												                <label class="label label-success">Paid</label>
												            </div>
												            <div class="col-sm-3 col-xs-12 m-b-10">
												                <span class="m-r-10">15-07-2019</span>
												                <a href="#" data-toggle="tooltip" data-original-title="Download" class="btn btn-inverse btn-circle"><i class="fa fa-download"></i></a>
												                &nbsp;&nbsp;
												                <a href="javascript:;" data-toggle="tooltip" data-original-title="Delete" data-invoice-id="386" class="btn btn-danger btn-circle sa-params"><i class="fa fa-times"></i></a>
												            </div>
												        </div>
												    </li>
												    <li class="list-group-item">
												        <div class="row">
												            <div class="col-sm-5 col-xs-12 m-b-10">
												                14957053345
												            </div>
												            <div class="col-sm-2 col-xs-3 m-b-10">
												                $ 40524
												            </div>
												            <div class="col-sm-2 col-xs-3 m-b-10">
												                <label class="label label-success">Paid</label>
												            </div>
												            <div class="col-sm-3 col-xs-12 m-b-10">
												                <span class="m-r-10">27-07-2019</span>
												                <a href="#" data-toggle="tooltip" data-original-title="Download" class="btn btn-inverse btn-circle"><i class="fa fa-download"></i></a>
												                &nbsp;&nbsp;
												                <a href="javascript:;" data-toggle="tooltip" data-original-title="Delete" data-invoice-id="385" class="btn btn-danger btn-circle sa-params"><i class="fa fa-times"></i></a>
												            </div>
												        </div>
												    </li>
												    <li class="list-group-item">
												        <div class="row">
												            <div class="col-sm-5 col-xs-12 m-b-10">
												                14957053273
												            </div>
												            <div class="col-sm-2 col-xs-3 m-b-10">
												                $ 14709
												            </div>
												            <div class="col-sm-2 col-xs-3 m-b-10">
												                <label class="label label-success">Paid</label>
												            </div>
												            <div class="col-sm-3 col-xs-12 m-b-10">
												                <span class="m-r-10">26-07-2019</span>
												                <a href="#" data-toggle="tooltip" data-original-title="Download" class="btn btn-inverse btn-circle"><i class="fa fa-download"></i></a>
												                &nbsp;&nbsp;
												                <a href="javascript:;" data-toggle="tooltip" data-original-title="Delete" data-invoice-id="384" class="btn btn-danger btn-circle sa-params"><i class="fa fa-times"></i></a>
												            </div>
												        </div>
												    </li>
												</ul>
					            			</div>
									  	</div>
									  	<!-- tab7 -->
									  	<div class="tab-pane fade" id="timelogs" role="tabpanel" aria-labelledby="timelogs-tab">
					            			<div class="stats-box">
					            				<h2>Time Logs</h2>
					            				<div class="row">
					            					<div class="col-md-12">
					            						<form class="">
						            						<div class="form-body">
						            							<div class="row mt-3">
																    <div class="col-md-3">
																        <div class="form-group">
																            <label>Employee Name</label>
																            <select class="custom-select br-0

																            " name="user_id" id="user_id" data-style="form-control">
																                <option value="64">Tianna Franecki</option>
																            </select>
																        </div>
																    </div>
																    <div class="col-md-3">
																        <div class="form-group">
																            <label>Start Date</label>
																            <input id="start_date" name="start_date" type="text" class="form-control" value="31-08-2019">
																        </div>
																    </div>
																    <div class="col-md-3">
																        <div class="form-group">
																            <label>End Date</label>
																            <input id="end_date" name="end_date" type="text" class="form-control" value="31-08-2019">
																        </div>
																    </div>
																</div>
						            						</div>
						            						<div class="form-actions m-t-30">
			                                                    <button type="button" id="save-form" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
			                                                </div>
						            					</form>
						            					<hr>
					            					</div>
					            				</div>
					            				<div class="table-responsive">
												    <table class="table table-bordered" id="timelogs-table">
												        <thead>
												            <tr role="row">
												                <th>Id</th>
												                <th>Who Logged</th>
												                <th>Start Time</th>
												                <th>End Time</th>
												                <th>Total Hours</th>
												                <th>Memo</th>
												                <th>Last updated by</th>
												                <th>Action</th>
												            </tr>
												        </thead>
												        <tbody>
												          <tr role="row" class="odd">
												             <td class="" tabindex="0">3</td>
												             <td>Lemuel Padberg</td>
												             <td>07-09-2019 12:00 am</td>
												             <td>16-09-2019 04:15 pm</td>
												             <td>232 hrs</td>
												             <td>working ondolores</td>
												             <td></td>
												             <td>
												                <a href="#" class="btn btn-success btn-circle" data-toggle="tooltip" data-original-title="View Client Details"><i class="fa fa-search" aria-hidden="true"></i></a>
												                <a href="" class="btn btn-danger btn-circle sa-params" data-toggle="tooltip" data-user-id="3" data-original-title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>
												             </td>
												          </tr>
												          <tr role="row" class="odd">
												             <td class="" tabindex="0">3</td>
												             <td>Lemuel Padberg</td>
												             <td>07-09-2019 12:00 am</td>
												             <td>16-09-2019 04:15 pm</td>
												             <td>232 hrs</td>
												             <td>working ondolores</td>
												             <td></td>
												             <td>
												                <a href="#" class="btn btn-success btn-circle" data-toggle="tooltip" data-original-title="View Client Details"><i class="fa fa-search" aria-hidden="true"></i></a>
												                <a href="" class="btn btn-danger btn-circle sa-params" data-toggle="tooltip" data-user-id="3" data-original-title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>
												             </td>
												          </tr>
												          <tr role="row" class="odd">
												             <td class="" tabindex="0">3</td>
												             <td>Lemuel Padberg</td>
												             <td>07-09-2019 12:00 am</td>
												             <td>16-09-2019 04:15 pm</td>
												             <td>232 hrs</td>
												             <td>working ondolores</td>
												             <td></td>
												             <td>
												                <a href="#" class="btn btn-success btn-circle" data-toggle="tooltip" data-original-title="View Client Details"><i class="fa fa-search" aria-hidden="true"></i></a>
												                <a href="" class="btn btn-danger btn-circle sa-params" data-toggle="tooltip" data-user-id="3" data-original-title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>
												             </td>
												          </tr>
												          <tr role="row" class="odd">
												             <td class="" tabindex="0">3</td>
												             <td>Lemuel Padberg</td>
												             <td>07-09-2019 12:00 am</td>
												             <td>16-09-2019 04:15 pm</td>
												             <td>232 hrs</td>
												             <td>working ondolores</td>
												             <td></td>
												             <td>
												                <a href="#" class="btn btn-success btn-circle" data-toggle="tooltip" data-original-title="View Client Details"><i class="fa fa-search" aria-hidden="true"></i></a>
												                <a href="" class="btn btn-danger btn-circle sa-params" data-toggle="tooltip" data-user-id="3" data-original-title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>
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
					                <tbody id="taxCategory">
					                    <?php
					             			$i = 1; 
					                    	foreach($taskCat as $catData) { ?>
					                    		<tr id="taskCat_<?php echo $catData->id;?>">
					                    			<td><?php echo $i; ?></td>
					                    			<td><?php echo $catData->task_category_name?></td>
					                    			<td><a href="javascript:;" data-cat-id="1" class="btn btn-sm btn-danger btn-rounded delete-category" id='deletetaskCat' onclick="deletetaskCat('<?php echo $catData->id; ?>')">Remove</a></td>
					                    		</tr>
					                    <?php 
					                    	$i++;
					                    	}
					                    ?>
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
						                        <p id="errormsg" class="text-danger"></p>
						                    </div>
						                </div>
						            </div>
						        </div>
						        <div class="form-actions">
						            <button type="button" id="save-task-category" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
						        </div>
						    </form>
            			</div>
            		</div>
            	</div>
            </div>
            <!-- end add task category. -->
        </div>
    </div>

    







