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
					ASSIGN LEAVE 
				</div>
				<div class="card-wrapper collapse show">
					<div class="card-body">
						<form id="creatleave" class="aj-form" name="creatleave" method="post" action="<?php echo base_url().'Leaves/insertleaves';?>">
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
							<!-- 	<h3 class="box-title">ASSIGN LEAVE</h3> -->
								<hr>
								<p id="succmsg" class="text-success"></p>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label">Choose Member</label>
											
											<select class="custom-select br-0" id="choose_mem" name="choose_mem">
											
												<?php
												foreach($employee as $emp){
													$str='';
													if(!empty($sessData['choose_mem'])){
														if($sessData['choose_mem'] == $emp->id){
															$str='selected';
														}
													}
													?>
													<option value="<?php echo $emp->id?>" <?php echo $str;?>><?php echo $emp->employeename;?></option>



													<?php
													} 
													?> 											
											</select>

										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group project-category">
											<label class="control-label" for="leave_type">
											Leave Type
											<a class="btn btn-sm btn-outline-success ml-1" href="javascript:;" data-toggle="modal" data-target="#leave_type1"><i class="fa fa-plus"></i> Add Leave Type</a></label>
											
											<select class="custom-select br-0" id="leave_type" name="leave_type">
											
												<?php
												foreach($leavecategory as $leave){
													$str='';
													if(!empty($sessData['leave_type'])){
														if($sessData['leave_type'] == $leave->id){
															$str='selected';
														}
													}
													?>
													<option value="<?php echo $leave->id?>" <?php echo $str;?>><?php echo $leave->name;?></option>
													<?php
													} 
													?> 											
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Select Duration
											</label>
											Single<input id="radio_group1" class="form-control" type="radio" name="duration_radio" value="0">
											
											 Multiple<input id="radio_group2" class="form-control" type="radio" name="duration_radio" value="1">
											Half Day<input id="radio_group3" class="form-control" type="radio" name="duration_radio" value="2"> 
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-2" id="deadlineBox">
										<div class="form-group">
											<label class="control-label">Date</label>
											<input type="date" name="date" id="date" autocomplete="off" class="form-control" value="<?php if(!empty($sessData['date'])){echo $sessData['date'];}else{ }?>" >
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Reason for absence</label>
											<textarea id="absence" class="form-control" name="absence" rows="5"><?php if(!empty($sessData['absence'])){echo $sessData['absence'];}else{ }?></textarea>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Status</label>
											<select id="" class="form-control" name="status">
												<option selected value="0" <?php if(!empty($sessData['status'])){
                                                            if($sessData['status'] == 0){
                                                                echo 'selected';    
                                                            }}
                                                            ?>>Approved</option>
												<option value="1" <?php if(!empty($sessData['status'])){
                                                            if($sessData['status'] == 1){
                                                                echo 'selected';    
                                                            }}
                                                            ?>>Pending</option>

											
											</select>
										</div>
									</div>
								</div>
							
							
						
                     
								<!-- action btn -->
								<div class="form-actions">
									<button type="submit" name="btnsave" id="save-form" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
									<!-- <i class="fa fa-check"><input type="submit" id="save-form" class="btn btn-success" name="btnsave" value="Save"> </i>  -->
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
<div class="modal fade project-category" id="leave_type1" tabindex="-1" role="dialog" aria-labelledby="leave_type" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content br-0">
			<div class="modal-header">
				<h4 class="modal-title"> Leave Type</h4>
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
							<th>Leave Type</th>
							<th>Action</th>
						</tr>
						</thead>
						 <tbody>
								<?php 	
									foreach($leavecategory as $leave) { ?>      
									  <tr>
										  <td><?php echo $leave->id; ?></td>
										  <td><?php echo $leave->name; ?></td>
										  <td><a href="javascript:;" data-cat-id="1" class="btn btn-sm btn-danger btn-rounded delete-category" id='deleteleave'>Remove</a></td>
									  </tr>
							   <?php } ?>
						</tbody>
					</table>
				</div>
				<hr>
				<form id="leave" class=""  name="leave" method="post" onsubmit="return checkName();">
					<div class="form-body">
						<div class="row">
							<div class="col-md-12 ">
								<div class="form-group">
									<label>Leave Type</label>
									<input type="text" name="leavename" id="leavename" class="form-control">
								</div>
							</div>
						</div>
					</div>
					<div class="form-actions">
						<input type="submit" id="save_leave" class="btn btn-success" value="Save"> <i class="fa fa-check"></i>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
