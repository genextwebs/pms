
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
											<div class="col-md-4" >
												<div class="row" id="empdiv" style="display:none">
													<div class="form-group">
													<label class="control-label"> Employee Name</label>
														<select  class="form-control" name="empname" id="empname">
															<option>--SELECT--</option>
															
														</select>
													</div>
												</div>
											</div>
										</div>
									
										<div class="row">
											<div class="col-md-4">
												<div class="block">
												  <label for="date" class="control-label"> Start Date</label>
												  <input type="date" name="d1" id="d1" value=""  class="form-control"/>
												  <label for="time" class="control-label">Start Time</label>
												  <input type="time" name="t1" id="t1" value=""  class="form-control"/>
												</div>
											</div>
											<div class="col-md-4">
												<div class="block">
												  <label for="date" class="control-label">End Date</label>
												  <input type="date" name="d2" id="d2" value="" class="form-control" />
												  <label for="time" class="control-label">End Time</label>
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
											<div class="col-md-12">
												<div class="form-group">
													<label class="control-label"> Memo</label>
														 <input type="text" class="form-control" name="memo" id="memo"/> 
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

