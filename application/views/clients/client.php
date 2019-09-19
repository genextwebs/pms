     <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><i class="icon-speedometer"></i> Dashboard</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="#">Home</a></li>
                            <li class="active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </nav>

            <!-- contetn-wrap -->
            <div class="content-in">  
                <div class="row">
                    <div class="col-md-3">
                        <div class="stats-box bg-black">
			                <h3 class="box-title text-white">Total Clients</h3>
			                <ul class="list-inline two-wrap">
			                    <li><i class="icon-user text-white"></i></li>
								<?php 
										$clientsArr = $this->common_model->getData('tbl_clients');
										$total_clients = count($clientsArr);
								?>
			                    <li class="text-right"><span id="" class="counter text-white"><?php echo  $total_clients; ?></span></li>
			                </ul>
			            </div>
                    </div>


                    <div class="col-md-12">
		                <div class="stats-box">
							<div class="row">
                				<div class="col-md-6">
                					<div class="form-group">
			                            <a class="btn btn-outline-success btn-sm"  href="<?php echo base_url().'Clients/addclients' ?>">Add New Client <i class="fa fa-plus" aria-hidden="true"></i></a>
										<a href="javascript:;" id="toggle-filter" class="btn btn-outline-danger btn-sm toggle-filter"><i class="fa fa-sliders"></i> Filter Results</a>
									</div>
                				</div>
							</div>
								<div class="row">
		                		<div class="col-lg-3 col-md-4">
		                			<div class="form-group">
            							<label class="control-label">Select Table Range</label>
											<input type="text" placehoder="Start Date" id="startdate" data-date-format='yyyy-mm-dd' /><spam>TO</spam>
											<input type="text" placehoder="End Date" id="enddate" data-date-format='yyyy-mm-dd'  />
									</div>
		                		</div>
		                		<div class="col-lg-3 col-md-4">
		                			<div class="form-group">
            							<label class="control-label">Status</label>
            							<select id='Status' class="custom-select">
								            <option value=''>All</option>          
								            <option value='1'>Active</option>  
								            <option value='0'>Deactive</option>   
								        </select> 
            						</div>
		                		</div>
		                		<div class="col-lg-3 col-md-4">
		                			<div class="form-group">
            							<label class="control-label">Client</label>
            							<select id='project_categ' class="custom-select">
								         <option value="">select</option>
											<?php
												foreach($client as $row)
												{
													echo '<option value="'.$row->clientname.'" >'.$row->clientname.'</option>';
												}
											?>
										</select> 
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
			                	<table class="table table-bordered" id="clients">
								   	<thead>
								      	<tr role="row">
									         <th>Id</th>
									         <th>Name</th>
									         <th>Company Name</th>
									         <th>Email</th>
									         <th>Status</th>
									         <th>Created At</th>
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
