
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
						<form id="creatclient" class="aj-form" method="post" action="<?php echo base_url().'Project/editproject/'.base64_encode($editId);?>">
							<?php
								$mess = $this->session->flashdata('message_name');
								if(!empty($mess)){
									//warning 
                            ?>
							<div class="submit-alerts">
            					<div class="alert alert-success" role="alert" style="display:block;"></div>
                            </div>
                            <div class="submit-alerts">
								<div class="alert alert-danger" role="alert" style="display:block;">
									<?php echo $mess; ?>
								</div>
                            </div>
									<?php  } ?>
                            <div class="submit-alerts">
								<div class="alert alert-warning" role="alert"> This is a warning alert</div>
            				</div>
							<div class="form-body">
								<h3 class="box-title">Project Info</h3>
								<hr>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Project Name</label>
											<input id="project_name" class="form-control" type="text" name="project_name" value="<?php echo !empty($projectinfo[0]->projectname) ? $projectinfo[0]->projectname : '' ?>">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group project-category">
										<label class="control-label" for="project-category">Project Category
										<a href="#project-category1" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#project-category1">Add Project Category <i class="fa fa-plus" aria-hidden="true"></i></a>
										</label>
																										
											<select class="custom-select br-0" id="project-category" name="project-category">
							
												<?php
													foreach($category as $cat)
													{
														echo '<option value="'.$cat->id.'">'.$cat->name.'</option>';
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
											<input type="text" name="start_date" id="start_date" autocomplete="off" class="form-control" value="<?php echo !empty($projectinfo[0]->startdate) ? $projectinfo[0]->startdate : '' ?>">
										</div>
									</div>
									<div class="col-md-4" id="deadlineBox">
										<div class="form-group">
											<label class="control-label">Deadline</label>
											<input type="text" name="deadline" id="deadline" autocomplete="off" class="form-control" value="<?php echo !empty($projectinfo[0]->deadline) ? $projectinfo[0]->deadline : '' ?>">
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
												<input type="checkbox" class="custom-control-input" name="manual_timelog" id="manual_timelog" value="1" <?php if(($projectinfo[0]->manualtimelog)=='1'){ echo 'checked';}?>>
												<label class="custom-control-label" for="manual_timelog" style="padding-top: 2px;">Allow manual time logs?</label>
											</div>
										</div>
									</div>		
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label">Project Summary</label>
											<textarea name="editor1"><?php echo !empty($projectinfo[0]->projectsummary) ? $projectinfo[0]->projectsummary : '' ?></textarea>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label">Note</label>
											<textarea id="notes" class="form-control" name="notes" rows="5"><?php echo !empty($projectinfo[0]->note) ? $projectinfo[0]->note : '' ?></textarea>
										</div>
									</div>
								</div>
								
								<h3 class="box-title mb-3 mt-2">Client Info</h3>
                    			<div class="row">
                    				<div class="col-md-12">
                    					<div class="form-group">
                    						<label class="control-label" for="select-client">Select Client</label>
                    						<select class="custom-select" id="select-client" name="select-client" value="<?php echo !empty($projectinfo[0]->clientid) ? $projectinfo[0]->clientid : '' ?>">
                    							  
														<?php
															foreach($client as $row)
															{
																$str='';
																if($row->id==$projectinfo->clientid)
																{
																	$str='selected';
																	?>	
																	<?php
																}
																echo '<option value="'.$row->id.'"'.$str.'>'.$row->clientname.'</option>';
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
												<input type="checkbox" class="custom-control-input" name="client-view-tasks" id="client-view-tasks" onclick="viewtask()" value="1" <?php if(($projectinfo[0]->viewtask)=='1'){ echo 'checked';}?> >
												<label class="custom-control-label" for="client-view-tasks" style="padding-top: 2px;">Client can view tasks of this project</label>
											</div>
										</div>
									</div>	
									<div class="col-md-8">
										<?php
											if(($projectinfo[0]->viewtask)=='1'){
												$status= 'display:block;';
											}
											else{
												$status= 'display:none;';
											}
				
										?>
										<div class="form-group"  id="viewnotification" style="<?php echo $status;?>">
											<div class="custom-control custom-checkbox my-1 mr-sm-2">
												<input type="checkbox" class="custom-control-input" name="tasks-notification" id="tasks-notification" value="1" <?php if(($projectinfo[0]->tasknotification)=='1'){ echo 'checked';}?> >
												<label class="custom-control-label" for="tasks-notification" style="padding-top: 2px;">Send task notification to client?</label>
											</div>
										</div>
									</div>	
								</div>
								<h3 class="box-title mb-3 mt-2">Budget Info</h3>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Project Budget</label>
											<input type="text" class="form-control" name="project-budget" value="<?php echo !empty($projectinfo[0]->projectbudget) ? $projectinfo[0]->projectbudget : '' ?>">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Currency</label>
											<select id="" class="form-control" name="currency-id" value="<?php echo !empty($projectinfo[0]->currency) ? $projectinfo[0]->currency : '' ?>">
												
												<option value="1" <?php if($projectinfo[0]->currency=='1'){echo 'selected';}?>>Dollars (USD)</option>
												<option value="2" <?php if($projectinfo[0]->currency=='2'){echo 'selected';}?>>Pounds (GBP)</option>
												<option value="3" <?php if($projectinfo[0]->currency=='3'){echo 'selected';}?>>Euros (EUR)</option>
												<option value="4" <?php if($projectinfo[0]->currency=='4'){echo 'selected';}?>>Rupee (INR)</option>
											</select>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Hours Allocated</label>
											<input type="text" class="form-control" name="hours-allocated" value="<?php echo !empty($projectinfo[0]->hoursallocated) ? $projectinfo[0]->hoursallocated : '' ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
										<label class="control-label">Project Status</label>
											<select name="status" id="" class="form-control" name="status">
												<option value="0">Incomplete </option>
												<option value="1">Complete </option>
												<option value="2">In Progress </option>
												<option value="3">On Hold  </option>
												<option value="4">Canceled </option>
										   </select>
									   </div>
                                   </div>
                                </div>
								<!-- action btn -->
								<div class="form-actions">
									<button type="submit" name="btnsave" id="save-form" class="btn btn-success"> <i class="fa fa-check"></i> Update</button>
									<!-- <i class="fa fa-check"><input type="submit" id="save-form" class="btn btn-success" name="btnedit" value="Update"> </i>  -->
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
<?php 
	$this->load->view('common/projectcategory');
?>
<!--end category--> 
 