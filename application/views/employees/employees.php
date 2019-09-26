 <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><i class="icon-user"></i> Employees</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url().'dashboard'?>">Home</a></li>
                            <li class="active">Employees</li>
                        </ol>
                    </div>
                </div>
            </nav>

            <!-- contetn-wrap -->
            <div class="content-in">  
                <div class="row">
                    <div class="col-md-3">
                        <div class="stats-box bg-black">
			                <h3 class="box-title text-white">Total Employees</h3>
			                <ul class="list-inline two-wrap">
			                    <li><i class="icon-user text-white"></i></li>
			                    <?php 
			                        $empArr = $this->common_model->getData('tbl_employee');
			                        $total_Emp = count($empArr);
			                    ?>
			                    <li class="text-right"><span id="" class="counter text-white"><?php echo $total_Emp;?></span></li>
			                </ul>
			            </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-box bg-danger">
			                <h3 class="box-title text-white">Not working on project</h3>
			                <ul class="list-inline two-wrap">
			                    <li><i class="icon-user text-white"></i></li>
			                    <li class="text-right"><span id="" class="counter text-white">41</span></li>
			                </ul>
			            </div>
                    </div>
                </div>
                <div class="row">
                	<div class="col-md-12">
                		<div class="stats-box">
                			<div class="row">
                				<div class="col-md-6">
                					<div class="form-group">
			                            <a href="<?php echo base_url().'employee/addemployee'?>" class="btn btn-outline-success btn-sm">Add New Employee <i class="fa fa-plus" aria-hidden="true"></i></a>

			                            <a href="javascript:;" id="toggle-filter" class="btn btn-outline-danger btn-sm toggle-filter"><i class="fa fa-sliders"></i> Filter Results</a>

			                            <a href="#" class="btn btn-outline-info btn-sm text-capitalize">Not working on project</a>
			                        </div>
                				</div>
                			</div>
		                	<div class="table-responsive">
			                	<table class="table table-bordered table-hover" id="employee">
								   	<thead>
								      	<tr role="row">
									         <th>Id</th>
									         <th>Name</th>
									         <th>Email</th>
									         <!--<th>User Role</th>-->
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
