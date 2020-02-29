<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="icon-people"></i> Clients</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url().'dashboard'?>">Home</a></li>
                <li><a href="<?php echo base_url().'clients'?>">Clients</a></li>
                <li class="active">Edit</li>
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
            		 UPDATE CLIENT INFO
            	</div>
            	<div class="card-wrapper collapse show">
            		<div class="card-body">
            			<form id="creatclient" class="aj-form" method="post">
            				<div class="submit-alerts">
            					<div class="alert alert-success" role="alert">
								  This is a success alert
								</div>
                                
								<div class="alert alert-warning" role="alert">
								  This is a warning alert
								</div>
            				</div>
            				<div class="form-body">
            					<h3 class="box-title">Company Details</h3>
            					<hr>
                                <?php
                                if($this->session->flashdata('message_name')){?>
                                    <div class="alert alert-danger" role="alert">
                                     <?php echo $this->session->flashdata('message_name');?>
                                    </div>
                                <?php
                                }?>
                                <input type="hidden" name="clientid" value="<?php echo $this->uri->segment(3);?>">
            					<div class="row">
            						<div class="col-md-6">
            							<div class="form-group">
            								<label class="control-label">Company Name</label>
            								<input id="company_name" class="form-control" type="text" name="company_name" value="<?php echo !empty($clients[0]->companyname) ?  $clients[0]->companyname : ''?>">
            							</div>
            						</div>
            						<div class="col-md-6">
            							<div class="form-group">
            								<label class="control-label">Website</label>
            								<input id="website" class="form-control" type="text" name="website" value="<?php echo !empty($clients[0]->website) ?  $clients[0]->website : ''?>">
            							</div>
            						</div>
            					</div>
            					<div class="row">
            						<div class="col-md-12">
            							<div class="form-group">
            								<label class="control-label">Address</label>
            								<textarea name="address" id="address" rows="5"  class="form-control"><?php echo !empty($clients[0]->address) ?  $clients[0]->address : ''?></textarea>
            							</div>
            						</div>
            					</div>
            					<h3 class="box-title mt-4">Client Details</h3>
            					<hr>
            					<div class="row">
            						<div class="col-md-6">
            							<div class="form-group">
            								<label class="control-label">Client Name</label>
            								<input id="name" class="form-control" type="text" name="name" value="<?php echo !empty($clients[0]->clientname) ?  $clients[0]->clientname :''?>">
            							</div>
            						</div>
            						<div class="col-md-6">
            							<div class="form-group">
            								<label class="control-label">Client Email</label>
            								<input id="email" class="form-control" type="email" name="email" value="<?php echo !empty($user[0]->emailid) ?  $user[0]->emailid :''?>">
            								<span class="help-block">Client will login using this email.</span>
            							</div>
            						</div>
            					</div>
            					<div class="row">
            						<div class="col-md-4">
            							<div class="form-group">
            								<label>Password</label>
            								<input type="Password" style="display: none;">
            								<input id="password" type="Password" class="form-control" name="password">
            								<span class="help-block">Client will login using this password.</span>
            							</div>
            						</div>
            						<div class="col-md-4">
            							<div class="form-group">
            								<div class="form-group">
	                                            <label>Mobile</label>
	                                            <input type="tel" name="mobile" id="mobile" value="<?php echo !empty($user[0]->mobile) ?  $user[0]->mobile :''?>" class="form-control allow-no">
	                                       </div>
            							</div>
            						</div>
									<div class="col-md-4">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" id="status" class="form-control">
                                               <option value="1" <?php if($user[0]->status=='1'){ echo 'selected'; } ?>>Active</option>
												<option value="0" <?php if($user[0]->status=='0'){ echo 'selected'; }?>>DeActive</option>
											</select>
                                        </div>
                                    </div>
                               </div>
								<div class="row">
            						<div class="col-md-3">
            							<div class="form-group">
            								<label class="control-label">Skype</label>
            								<input id="skype" class="form-control" type="text" name="skype" value="<?php echo !empty($clients[0]->skype) ?  $clients[0]->skype :' '?>">
            							</div>
            						</div>
            						<div class="col-md-3">
            							<div class="form-group">
            								<label class="control-label">Linkedin</label>
            								<input id="linkedin" class="form-control" type="text" name="linkedin" value="<?php echo !empty($clients[0]->linkedin) ?  $clients[0]->linkedin : ''?>">
            							</div>
            						</div>
            						<div class="col-md-3">
            							<div class="form-group">
            								<label class="control-label">Twitter</label>
            								<input id="twitter" class="form-control" type="text" name="twitter" value="<?php echo !empty($clients[0]->twitter) ?  $clients[0]->twitter : ''?>">
            							</div>
            						</div>
            						<div class="col-md-3">
            							<div class="form-group">
            								<label class="control-label">Facebook</label>
            								<input id="facebook" class="form-control" type="text" name="facebook" value="<?php echo !empty($clients[0]->facebook) ?  $clients[0]->facebook : ''?>">
            							</div>
            						</div>
            					</div>
            					<div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="gst_number">GST Number</label>
                                            <input type="text" id="gst_number" name="gst_number" class="form-control" value="<?php echo !empty($clients[0]->gstnumber) ?  $clients[0]->gstnumber : ''?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Note</label>
                                        <div class="form-group">
                                            <textarea name="note" id="note" class="form-control" rows="5"><?php echo !empty($clients[0]->note) ?  $clients[0]->note : ' '?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 ">
                                        <div class="form-group">
                                            <label>Log In</label>
                                            <select name="login" id="login" class="form-control">
                                               <option value="1" <?php if($user[0]->login=='1'){ echo 'selected'; } ?>>Enable</option>
												<option value="0" <?php if($user[0]->login=='0'){ echo 'selected'; }?>>Disable</option>
											</select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
	                                <button type="submit" name="btnupdate" id="save-form" class="btn btn-success"> <i class="fa fa-check"></i> Update</button>
	                                <a href="<?php echo base_url().'Clients/index' ?>" class="btn btn-default">Back</a>
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
