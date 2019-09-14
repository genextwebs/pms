    <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><i class="icon-speedometer"></i> Dashboard</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url().'Project/';?>">Home</a></li>
                            <li><a href="<?php echo base_url().'Project/';?>">Projects</a></li>
                        </ol>
                    </div>
                </div>
            </nav>

            <!-- contetn-wrap -->
            <div class="content-in">  
                <div class="row">
                    <div class="col-md-3">
                        <div class="stats-box bg-black pt-1 pb-1">
			                <h3 class="box-title text-white">Total Projects</h3>
			                <ul class="list-inline two-wrap">
			                    <li><i class="icon-layers text-white"></i></li>
			                    <li class="text-right"><span id="" class="counter text-white">18</span></li>
			                </ul>
			            </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-box bg-success pt-1 pb-1">
			                <h3 class="box-title text-white">Completed Projects</h3>
			                <ul class="list-inline two-wrap">
			                    <li><i class="icon-layers text-white"></i></li>
			                    <li class="text-right"><span id="" class="counter text-white">2</span></li>
			                </ul>
			            </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-box bg-info pt-1 pb-1">
			                <h3 class="box-title text-white">In Process Projects</h3>
			                <ul class="list-inline two-wrap">
			                    <li><i class="icon-layers text-white"></i></li>
			                    <li class="text-right"><span id="" class="counter text-white">16</span></li>
			                </ul>
			            </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-box bg-danger pt-1 pb-1">
			                <h3 class="box-title text-white">Overdue Projects</h3>
			                <ul class="list-inline two-wrap">
			                    <li><i class="icon-layers text-white"></i></li>
			                    <li class="text-right"><span id="" class="counter text-white">15</span></li>
			                </ul>
			            </div>
                    </div>

                    <div class="col-md-12">
		                <div class="stats-box">
		                	<div class="row">
		                		<div class="col-md-6">
		                			<div class="form-group">
			                            <a href="<?php echo base_url().'Project/addproject'?>" class="btn btn-outline-success btn-sm">Add New Project <i class="fa fa-plus" aria-hidden="true"></i></a>
			                            <a href="#project-category" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#project-category">Add Project Category <i class="fa fa-plus" aria-hidden="true"></i></a>
			                            <a href="<?php echo base_url().'Project/projecttemplate';?>" class="btn btn-outline-primary btn-sm">Project Templates <i class="fa fa-plus" aria-hidden="true"></i></a>
										 <a href="<?php echo base_url().'Project/viewarchiev';?>"  class="btn btn-outline btn-info btn-sm">View Archive <i class="fa fa-trash" aria-hidden="true"></i></a>
								   </div>
		                		</div>
		                	</div>
		                	<div class="row">
		                		<div class="col-lg-3 col-md-4">
		                			<div class="form-group">
            							<label class="control-label">Projects Status</label>
            							<select id="project_status" class="custom-select">
								            <option value='all'>All</option>          
								            <option value='1'>Complete</option>  
								            <option value='0'>Incomplete</option>   
								        </select> 
            						</div>
		                		</div>
		                		<div class="col-lg-3 col-md-4">
		                			<div class="form-group">
            							<label class="control-label">Client Name</label>
										<select id="clientname" class="custom-select" name="clientname">
								            <option value="">--Select--</option>
												<?php
													foreach($client as $row)
													{
														echo '<option value="'.$row->id.'" >'.$row->clientname.'</option>';
													}
												?>
										</select>
            						</div>
		                		</div>
		                		<div class="col-lg-3 col-md-4">
		                			<div class="form-group">
            							<label class="control-label">Project Category</label>
            							<select id="categoryname" class="custom-select" name="categoryname">
								            <option value="">--Select--</option>
											<?php
												foreach($category as $cat)
												{
													echo '<option value="'.$cat->id.'" >'.$cat->name.'</option>';
												}
											?>
								        </select> 
            						</div>
		                		</div>
		                	</div>
		                	<div class="table-responsive">
			                	<table class="table table-bordered table-hover" id="project">
								   	<thead>
								      	<tr role="row">
									         <th>Id</th>
									         <th>Project Name</th>
									         <th>Project Members</th>
									         <th>Deadline</th>
									         <th>Client</th>
									         <th>Completion</th>
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
			
			<div class="modal fade project-category" id="project-category" tabindex="-1" role="dialog" aria-labelledby="project-category" aria-hidden="true">
            	<div class="modal-dialog modal-lg" role="document">
            		<div class="modal-content br-0">
            			<div class="modal-header">
            				<h4 class="modal-title"> Project Category</h4>
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
					                    <th>Category Name</th>
					                    <th>Action</th>
					                </tr>
					                </thead>
					                <tbody>
					                    <tr id="cat-1">
					                        <td>1</td>
					                        <td>Laravel</td>
					                        <td><a href="javascript:;" data-cat-id="1" class="btn btn-sm btn-danger btn-rounded delete-category">Remove</a></td>
					                    </tr>
					                    <tr id="cat-2">
					                        <td>2</td>
					                        <td>Yii</td>
					                        <td><a href="javascript:;" data-cat-id="2" class="btn btn-sm btn-danger btn-rounded delete-category">Remove</a></td>
					                    </tr>
					                    <tr id="cat-3">
					                        <td>3</td>
					                        <td>Zend</td>
					                        <td><a href="javascript:;" data-cat-id="3" class="btn btn-sm btn-danger btn-rounded delete-category">Remove</a></td>
					                    </tr>
					                    <tr id="cat-4">
					                        <td>4</td>
					                        <td>CakePhp</td>
					                        <td><a href="javascript:;" data-cat-id="4" class="btn btn-sm btn-danger btn-rounded delete-category">Remove</a></td>
					                    </tr>
					                    <tr id="cat-5">
					                        <td>5</td>
					                        <td>Codeigniter</td>
					                        <td><a href="javascript:;" data-cat-id="5" class="btn btn-sm btn-danger btn-rounded delete-category">Remove</a></td>
					                    </tr>
					                </tbody>
					            </table>
					        </div>
					        <hr>
					        <form id="" class="" method="post">
						        <div class="form-body">
						            <div class="row">
						                <div class="col-md-12 ">
						                    <div class="form-group">
						                        <label>Category Name</label>
						                        <input type="text" name="category_name" id="category_name" class="form-control">
						                    </div>
						                </div>
						            </div>
						        </div>
						        <div class="form-actions">
						            <button type="button" id="save-category" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
						        </div>
							</form>
            			</div>
            		</div>
            	</div>
            </div>