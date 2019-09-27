     <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><i class="ti-file"></i> Invoices</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url().'dashboard'?>">Home</a></li>
                            <li class="active">Invoices</li>
                        </ol>
                    </div>
                </div>
            </nav>

            <!-- contetn-wrap -->
            <div class="content-in">  
                <div class="row">
                    <div class="col-md-12">
		                <div class="stats-box">
							<div class="row">
                				<div class="col-md-6">
                					<div class="form-group">
			                            <a class="btn btn-outline-success btn-sm"  href="<?php echo base_url().'Finance/addinvoices' ?>">Add Invoice <i class="fa fa-plus" aria-hidden="true"></i></a>
										<a href="javascript:;" id="toggle-filter" class="btn btn-outline-danger btn-sm toggle-filter"><i class="fa fa-sliders"></i> Filter Results</a>
									</div>
                				</div>
							</div>
							
							<div class="row">
		                		<div class="col-lg-3 col-md-4">
		                			<div class="form-group">
            							<label class="control-label">Select Date Range</label>
											<input type="text" placehoder="Start Date" id="startdate" name="startdate" data-date-format='yyyy-mm-dd' /><spam>TO</spam>
											<input type="text" placehoder="End Date" id="enddate" name="enddate" data-date-format='yyyy-mm-dd'  />
									</div>
		                		</div>
								<div class="col-lg-3 col-md-4">
		                			<div class="form-group">
            							<label class="control-label">Project</label>
            							<select id='projectname' class="custom-select">
								         <option value="">select</option>
											<?php
												foreach($project as $row)
												{
													echo '<option value="'.$row->projectname.'" >'.$row->projectname.'</option>';
												}
											?>
										</select> 
            						</div>
		                		</div>
								<div class="col-lg-3 col-md-4">
		                			<div class="form-group">
            							<label class="control-label">Client</label>
            							<select id='clientname' class="custom-select">
								         <option value="">select</option>
											<?php
												foreach($clients as $row)
												{
													echo '<option value="'.$row->clientname.'" >'.$row->clientname.'</option>';
												}
											?>
										</select> 
            						</div>
		                		</div>
		                		<div class="col-lg-3 col-md-4">
		                			<div class="form-group">
            							<label class="control-label">Status</label>
            							<select id='status' class="custom-select">
								            <option value='all'>All</option>          
								            <option value='0'>Unpaid</option>  
								            <option value='1'>Paid</option> 
								            <option value='2'>Partial</option>   
											
								        </select> 
            						</div>
		                		</div>
		                		<div class="col-lg-3 col-md-4">
		                			<div class="form-group">
										<input type="button" value="Apply" name="btnapply" id="btnapply"> 
										<input type="reset" value="Reset">
									</div>
		                		</div>
							</div>
		                

							
							
								   <?php
										//warning 
										$mess = $this->session->flashdata('message_name');
										if(!empty($mess)){
									?>
						   <div class="col-md-12">
								<div class="submit-alerts">
									<div class="alert alert-success" role="alert" style="display:block;">
										<?php echo $mess; ?>
									</div>
								</div>
							</div>
                            <?php } ?>
   		                	
		                	<div class="table-responsive">
			                	<table class="table table-bordered" id="invoices">
								   	<thead>
								      	<tr role="row">
									         <th>Id</th>
									         <th>Invoice#</th>
									         <th>Project</th>
									         <th>Client</th>
											 <th>Total</th>
											 <th>Invoice Date</th>
											 <th>Status</th>
											 <th>Action</th>
								      	</tr>
								   	</thead>
								 </table>
							</div>
		                </div>
		            </div>
                </div>
            </div>
            <!-- ends of contentwrap -->
