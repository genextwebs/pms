     <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><i class="ti-file"></i> Estimates</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url().'dashboard'?>">Home</a></li>
                            <li class="active">Estimates</li>
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
			                            <a class="btn btn-outline-success btn-sm"  href="<?php echo base_url().'Finance/addestimates' ?>">Create Estimate <i class="fa fa-plus" aria-hidden="true"></i></a>
										<a href="javascript:;" id="toggle-filter" class="btn btn-outline-danger btn-sm toggle-filter"><i class="fa fa-sliders"></i> Filter Results</a>
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
									         <th>Client</th>
									         <th>Total</th>
									         <th>Created At</th>
											 <th>Valid Till</th>
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
