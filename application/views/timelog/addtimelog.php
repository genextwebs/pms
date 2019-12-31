<nav aria-label="breadcrumb" class="breadcrumb-nav">
	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title"><i class="icon-layers"></i> Timelog</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url().'Dashboard/';?>">Home</a></li>
				<li><a href="<?php echo base_url().'Timelog/';?>">Timelog</a></li>
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
					Add Timelog 
				</div>
				<div class="card-wrapper collapse show">
					<div class="card-body">
						<form id="creatclient" class="aj-form" name="creatclient" method="post" action="<?php echo base_url().'timelog/inserttimelog'?>">
							<?php
                                    $mess = $this->session->flashdata('message_name');
                                    if(!empty($mess)){
                                        //warning 
                                    ?>
            				<div class="submit-alerts">
            					<div class="alert alert-success" role="alert" style="display:block;">
								</div>
                            </div>
                            <div class="submit-alerts">
								<div class="alert alert-danger" role="alert" style="display:block;">
								 <?php echo $mess; ?>
								</div>
                            </div>
                            <?php  } ?>
                            <div class="submit-alerts">
								<div class="alert alert-warning" role="alert">
								  This is a warning alert
								</div>
            				</div>
                            
							<div class="form-body">
								<h3 class="box-title">Timelog Info</h3><hr>
									<p id="succmsg" class="text-success"></p>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label">Select Project</label>
														<select class="form-control" class="projectclass" name="projectname" id="projectname" onchange=getEmployee();>
															<option value="">--SELECT--</option>
															
															<?php 
																foreach($projectinfo as $project){
															?>
															<option value="<?php echo $project->id?>"><?php echo $project->projectname;?></option>
																<?php 
																}
															?>
														</select>
												</div>
											</div>
										</div>
										<div class="row" id="empdiv" style="display:none">
											<div class="col-md-4" >
												<div class="form-group">
													<label class="control-label"> Employee Name</label>
														<select  class="form-control" name="empname" id="empname">
															<option>--SELECT--</option>
															
														</select>
												</div>
											</div>
										
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label"> Start Date</label>
														<input type="text" class="start-date form-control br-0" id="start_date" name="start_date" value="" data-date-format='yyyy-mm-dd'>
												</div>
											</div>
										
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label">End Date</label>
														   <input type="text" class="end-date form-control br-0" id="deadline" name="deadline" value="" data-date-format='yyyy-mm-dd'>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-4">
												<div class="form-group" id="timeonly">
													<label class="control-label">Start Time</label>
														<input type="text" class="form-control" name="starttime" id="starttime">
														
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label"> End Time</label>
														<input type="text" class="form-control" name="endtime" id="endtime">
												</div>
											</div>
										
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label">Total Hours</label>
													<input type="text" name="hours" id="hours">
														<!--logic-->
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label"> Memo</label>
														<input type="text" class="form-control" name="memo" id="memo">
												</div>
											</div>
										</div>
									
										<div class="form-actions">
											<button type="submit" name="btnsavetime" id="save-form" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
										</div>


							</div>
					    </form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
