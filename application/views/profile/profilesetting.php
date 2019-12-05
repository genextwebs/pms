
<nav aria-label="breadcrumb" class="breadcrumb-nav">
	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title"><i class="icon-user"></i>Profile Settings</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a  href="<?php echo base_url().'Dashboard/';?>">Home</a></li>
				<li><a class="active" href="<?php echo base_url().'Project/';?>">Profile Settings</a></li>
				<!-- <li class="active">Add New</li> -->
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
					UPDATE PROFILE INFO
				</div>
				<div class="card-wrapper collapse show">
					<div class="card-body">
						<form id="creatclient" class="aj-form" name="" method="post" action=" " onsubmit="return changeDate();">
							
  

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
								<!-- <h3 class="box-title">Project Info</h3> -->
							<!-- 	<hr>
								<p id="succmsg" class="text-success"></p> -->
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Your Name</label>
											<input id="profile_name" class="form-control" type="text" name="profile_name" value="<?php echo !empty(
											$profile[0]->name) ? $profile[0]->name : '' ?>">
										</div>
									</div>

									<div class="col-md-6">
											<div class="form-group">
											<label class="control-label">Your Email</label>
											<input id="email_id" class="form-control" type="text" name="email_id" value="<?php echo !empty(
											$profile[0]->emailid) ? $profile[0]->emailid : '' ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Your Password</label>
											<input id="password" class="form-control" type="text" name="password" value="<?php echo !empty(
											$profile[0]->name) ? $profile[0]->name : '' ?>">
										</div>
									</div>

									<div class="col-md-6">
											<div class="form-group">
											<label class="control-label">Your Mobile Number</label>
											<input id="mobile_no" class="form-control" type="text" name="mobile_no" value="<?php echo !empty(
											$profile[0]->mobile) ? $profile[0]->mobile : '' ?>">
										</div>
									</div>
								</div>
							
								<div class="row">
			                                	<div class="col-md-6">
			                                		<div class="file-upload mb-5">
			                                			<label>Profile Picture</label>
			                                			<div class="image-upload-wrap">
			                                				<input class="file-upload-input" type='file' onchange="" accept="" />
			                                				<div class="drag-text">
			                                					<h3>Drag and drop <br>a file or select add Image</h3>
			                                				</div>
			                                			</div>
			                                			<div class="file-upload-content">
			                                				 <?php echo form_open_multipart('ProfileSetting/do_upload');?>
 
			                                				<img class="file-upload-image" src="#" alt="your image" />
			                                				<div class="image-title-wrap">
			                                					<!-- <button type="button" onclick="removeUpload()" class="remove-image">Remove
			                                						</button> -->

			                                					 <!-- <span class="image-title">Uploaded Image</span> -->			                                				</div>
			                                			</div>
			                                			<button class="file-upload-btn" type="button" onclick="">Select Image</button>
			                                		</div>
			                                	</div>
			                                </div>
								<!-- <div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Profile Picture</label>
											<input id="project_name" class="form-control" type="text" name="project_name" value="">
										</div>
									</div>
								</div>
								
								
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<button type="submit" name="btnsave" id="save-form" class="btn btn-success"> <i class="fa fa-check"></i>  Select Image </button>
										</div>
									</div>
								</div> -->
								
								<div class="form-actions">
									<div class="form-group">
										<button type="submit" name="btnsave" id="save-form" class="btn btn-success"> <i class="fa fa-check"></i> Update</button>
										<input type="reset" class="btn btn-default" value="Reset">
									</div>
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

