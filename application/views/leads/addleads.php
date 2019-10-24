<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="icon-layers"></i> Projects</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        	<ol class="breadcrumb">
                <li><a href="<?php echo base_url().'dashboard'?>">Home</a></li>
                <li><a href="<?php echo base_url().'leads'?>">Leads</a></li>
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
            		Add Lead Info
            	</div>
            	<div class="card-wrapper collapse show">
            		<div class="card-body">
            			<form id="creatclient" class="aj-form" name="leadss" method="post" action="<?php echo base_url().'Leads/insertleads'?>">
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
            					<h3 class="box-title">Company Details</h3>
            					<hr>
            					<div class="row">
            						<div class="col-md-6">
            							<div class="form-group">
            								<label class="control-label">Company Name</label>
            								<input id="company_name" class="form-control" type="text" name="company_name" value="<?php if(!empty($sessData['company_name'])){echo $sessData['company_name'];}?>">
            							</div>
            						</div>
            						<div class="col-md-6">
            							<div class="form-group">
            								<label class="control-label">Website</label>
            								<input id="website" class="form-control" type="text" name="website" value="<?php if(!empty($sessData['website'])){echo $sessData['website'];}else{ }?>">
            							</div>
            						</div>
            					</div>
            					<div class="row">
                            		<div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Address</label>
                                            <textarea name="address" id="address" class="form-control" rows="4"><?php if(!empty($sessData['address'])){echo $sessData['address'];}else{ }?></textarea>
                                        </div>
                                    </div>
                    			</div>
                    			<h3 class="box-title mt-4">Lead Details</h3>
                    			<hr>
            					<div class="row">
								    <div class="col-md-6">
								        <div class="form-group">
								            <label class="control-label">Client Name</label>
								            <input type="text" name="client_name" id="client_name" class="form-control" value="<?php if(!empty($sessData['client_name'])){echo $sessData['client_name'];}else{ }?>">
								        </div>
								    </div>
								    <div class="col-md-6">
								        <div class="form-group">
								            <label class="control-label">Client Email</label>
								            <input type="text" name="client_email" id="client_email" class="form-control" value="">
								            <span class="help-desk">Lead will login using this email.</span>
								        </div>
								    </div>
								</div>
								<div class="row">
									<div class="col-lg-4 col-md-6">
										<div class="form-group">
											<label class="control-label">Mobile</label>
											<input type="text" id="mobile" name="mobile" class="form-control" value="<?php if(!empty($sessData['mobile'])){echo $sessData['mobile'];}else{ }?>">
										</div>
									</div>
									<div class="col-lg-4 col-md-6">
										<div class="form-group">
											<label class="control-label">Next Follow Up</label>
											<select id="follow_up" name="follow_up" class="form-control">
												<option selected value="0" <?php if(!empty($sessData['follow_up'])){
                                                            if($sessData['follow_up'] == 0){
                                                                echo 'selected';    
                                                            }}
                                                            ?>>Yes</option>
												<option value="1" <?php if(!empty($sessData['follow_up'])){
                                                            if($sessData['follow_up'] == 1){
                                                                echo 'selected';    
                                                            }}
                                                            ?>>No</option>
											</select>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label">Note</label>
											<textarea id="note" name="note" class="form-control" rows="4"><?php if(!empty($sessData['note'])){echo $sessData['note'];}else{ }?></textarea>
										</div>
									</div>
								</div>
                    			
								<!-- action btn -->
                                <div class="form-actions">
                                    <button type="submit" name="btnsave" id="save-form" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
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