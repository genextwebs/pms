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
			                    <li class="text-right"><span id="" class="counter text-white">31</span></li>
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
