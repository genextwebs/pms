<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="icon-layers"></i> Leads</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        	<ol class="breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li><a href="leads.html">Leads</a></li>
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
            		Edit Lead Info
            	</div>
            	<div class="card-wrapper collapse show">
            		<div class="card-body">
            			<form id="creatclient" class="aj-form" method="post">
                            <?php
                                    $mess = $this->session->flashdata('message_name');
                                    if(!empty($mess)){
                                        //warning 
                                    ?>
            				<div class="submit-alerts">
            					<div class="alert alert-success" role="alert">
                                    <?php echo $mess; ?>
								</div>
								<div class="alert alert-danger" role="alert">
								  This is a danger alert
								</div>
								<div class="alert alert-warning" role="alert">
								  This is a warning alert
								</div>
            				</div>
                            <?php } ?>
            				<div class="form-body">
            					<h3 class="box-title">Company Details</h3>
            					<hr>
                                <?php
                                if($this->session->flashdata('message_name')){?>
                                    <div class="alert alert-danger" role="alert">
                                        <?php echo $this->session->flashdata('message_name');?>
                                    </div>
                                <?php
                                }
                                ?>
                                
                                <input type="hidden" name="leadid" value="<?php echo $this->uri->segment(3);?>">
            					<div class="row">
            						<div class="col-md-6">
            							<div class="form-group">
            								<label class="control-label">Company Name</label>
            								<input id="company_name" class="form-control" type="text" name="company_name" value="<?php echo !empty($leads[0]->companyname)?$leads[0]->companyname:''?>">
            							</div>
            						</div>
            						<div class="col-md-6">
            							<div class="form-group">
            								<label class="control-label">Website</label>
            								<input id="website" class="form-control" type="text" name="website" value="<?php echo !empty($leads[0]->website)?$leads[0]->website:''?>">
            							</div>
            						</div>
            					</div>
            					<div class="row">
                            		<div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Address</label>
                                            <textarea name="address" id="address" class="form-control" rows="4"><?php echo !empty($leads[0]->address)?$leads[0]->address:''?></textarea>
                                        </div>
                                    </div>
                    			</div>
                    			<h3 class="box-title mt-4">Lead Details</h3>
                    			<hr>
            					<div class="row">
								    <div class="col-md-6">
								        <div class="form-group">
								            <label class="control-label">Client Name</label>
								            <input type="text" name="name" id="name" class="form-control" value="<?php echo !empty($leads[0]->clientname)?$leads[0]->clientname:''?>">
								        </div>
								    </div>
								    <div class="col-md-6">
								        <div class="form-group">
								            <label class="control-label">Client Email</label>
								            <input type="text" name="email" id="email" class="form-control" value="<?php echo !empty($leads[0]->clientemail)?$leads[0]->clientemail:''?>">
								            <span class="help-desk">Lead will login using this email.</span>
								        </div>
								    </div>
								</div>
								<div class="row">
									<div class="col-lg-4 col-md-6">
										<div class="form-group">
											<label class="control-label">Mobile</label>
											<input type="text" id="mobile" name="mobile" class="form-control allow-no" value="<?php echo !empty($leads[0]->mobile)?$leads[0]->mobile:''?>">
										</div>
									</div>
									<div class="col-lg-4 col-md-6">
										<div class="form-group">
											<label class="control-label">Next Follow Up</label>
											<select id="follow_up" name="follow_up" class="form-control">
												<option value="0" <?php if($leads[0]->nextfollowup=='0'){ echo 'selected'; }?>>Yes</option>
												<option value="1" <?php if($leads[0]->nextfollowup=='1'){ echo 'selected'; }?>>No</option>
											</select>
										</div>
									</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Status</label>
                                            <select id="status" name="status" class="form-control">
                                                <option value="0" <?php if($leads[0]->status=='0'){ echo 'selected'; }?>>Pending</option>
                                                <option value="1" <?php if($leads[0]->status=='1'){ echo 'selected'; }?>>Overview</option>
                                                <option value="2" <?php if($leads[0]->status=='2'){ echo 'selected'; }?>>Confirmed</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Source</label>
                                            <select id="source" name="source" class="form-control">
                                                <option value="0" <?php if($leads[0]->source=='0'){ echo 'selected'; }?>>Social Media</option>
                                                <option value="1" <?php if($leads[0]->source=='1'){ echo 'selected'; }?>>Google</option>
                                                <option value="2" <?php if($leads[0]->source=='2'){ echo 'selected'; }?>>Other</option>
                                            </select>
                                        </div>
                                    </div>
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label">Note</label>
											<textarea id="note" name="note" class="form-control" rows="4"><?php echo !empty($leads[0]->note) ?  $leads[0]->note : ' '?></textarea>
										</div>
									</div>
								</div>
                    			
								<!-- action btn -->
                                <div class="form-actions">
                                    <button type="submit" name="btnupdate" id="save-form" class="btn btn-success"> <i class="fa fa-check"></i> Update</button>
	                               <a href="<?php echo base_url().'leads'?>" class="btn btn-default">Back</a>
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