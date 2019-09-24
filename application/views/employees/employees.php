 <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><i class="icon-user"></i> Employees</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="#">Home</a></li>
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
			                    <li class="text-right"><span id="" class="counter text-white">61</span></li>
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
			                	<table class="table table-bordered table-hover" id="users-table">
								   	<thead>
								      	<tr role="row">
									         <th>Id</th>
									         <th>Name</th>
									         <th>Email</th>
									         <th>User Role</th>
									         <th>Status</th>
									         <th>Created At</th>
									         <th>Action</th>
								      	</tr>
								   	</thead>
								   	<tbody>
								      <tr role="row" class="odd">
								         <td class="" tabindex="0">39</td>
								         <td><a href="#1">
								         	<img src="images/default-profile-2.png" alt="user" class="img-circle" width="30">  Miss Jenifer Hodkiewicz Jr.</a>
								         	<br><br><label class="label label-danger">Admin</label>
								         </td>
								         <td>merle.ritchie@example.org</td>
								         <td>Role of this user cannot be changed.</td>
								         <td><label class="label label-success">Active</label></td>
								         <td>17-08-2019</td>
								         <td>
								            <a href="#" class="btn btn-info btn-circle" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
								            <a href="employee-view-details.html" class="btn btn-success btn-circle" data-toggle="tooltip" data-original-title="View Client Details"><i class="fa fa-search" aria-hidden="true"></i></a>
								            <a href="#" class="btn btn-danger btn-circle sa-params" data-toggle="tooltip" data-user-id="39" data-original-title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>
								         </td>
								      </tr>
								      <tr role="row" class="even">
								         <td class="" tabindex="0">40</td>
								         <td><a href="/projects/40"><img src="images/default-profile-2.png" alt="user" class="img-circle" width="30"> Prof. Austyn Dooley III</a>
								         	<br><br><label class="label bg-info">Manager</label>
								         </td>
								         <td>ignatius.crist@example.com</td>
								         <td>
								         	<div class="custom-control custom-radio radio-info">
                              					<input type="radio" class="custom-control-input" id="admin-radio1" name="radio-stacked" required>
    											<label class="custom-control-label" for="admin-radio1">Admin</label>
                  							</div>
                  							<div class="custom-control custom-radio radio-info">
                              					<input type="radio" class="custom-control-input" id="employee-radio1" name="radio-stacked" required>
    											<label class="custom-control-label" for="employee-radio1">Employee</label>
                  							</div>
                  							<div class="custom-control custom-radio radio-info">
                              					<input type="radio" class="custom-control-input" id="manager-radio1" name="radio-stacked" required>
    											<label class="custom-control-label" for="manager-radio1">Manager</label>
                  							</div>
								         </td>
								         <td><label class="label label-success">Active</label></td>
								         <td>17-08-2019</td>
								         <td>
								            <a href="#" class="btn btn-info btn-circle" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
								            <a href="employee-view-details.html" class="btn btn-success btn-circle" data-toggle="tooltip" data-original-title="View Client Details"><i class="fa fa-search" aria-hidden="true"></i></a>
								            <a href="#" class="btn btn-danger btn-circle sa-params" data-toggle="tooltip" data-user-id="40" data-original-title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>
								         </td>
								      </tr>
								      <tr role="row" class="odd">
								         <td class="" tabindex="0">41</td>
								         <td><a href="#"><img src="images/default-profile-2.png" alt="user" class="img-circle" width="30"> Margret Leannon V</a>
								         	<br><br><label class="label label-danger">Admin</label>
								         </td>
								         <td>emmanuelle99@example.org</td>
								         <td>
								         	<div class="custom-control custom-radio radio-info">
                              					<input type="radio" class="custom-control-input" id="admin-radio2" name="radio-stacked" required>
    											<label class="custom-control-label" for="admin-radio2">Admin</label>
                  							</div>
                  							<div class="custom-control custom-radio radio-info">
                              					<input type="radio" class="custom-control-input" id="employee-radio2" name="radio-stacked" required>
    											<label class="custom-control-label" for="employee-radio2">Employee</label>
                  							</div>
                  							<div class="custom-control custom-radio radio-info">
                              					<input type="radio" class="custom-control-input" id="manager-radio2" name="radio-stacked" required>
    											<label class="custom-control-label" for="manager-radio2">Manager</label>
                  							</div>
								         </td>
								         <td><label class="label label-success">Active</label></td>
								         <td>17-08-2019</td>
								         <td>
								            <a href="#" class="btn btn-info btn-circle" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
								            <a href="employee-view-details.html" class="btn btn-success btn-circle" data-toggle="tooltip" data-original-title="View Client Details"><i class="fa fa-search" aria-hidden="true"></i></a>
								            <a href="#" class="btn btn-danger btn-circle sa-params" data-toggle="tooltip" data-user-id="41" data-original-title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>
								         </td>
								      </tr>
								      <tr role="row" class="even">
								         <td class="" tabindex="0">42</td>
								         <td><a href="#"><img src="images/default-profile-2.png" alt="user" class="img-circle" width="30"> Ms. Albertha Anderson MD</a><br><br><label class="label label-danger">Admin</label>
								         </td>
								         <td>deja64@example.com</td>
								         <td>
								         	<div class="custom-control custom-radio radio-info">
                              					<input type="radio" class="custom-control-input" id="admin-radio3" name="radio-stacked" required>
    											<label class="custom-control-label" for="admin-radio3">Admin</label>
                  							</div>
                  							<div class="custom-control custom-radio radio-info">
                              					<input type="radio" class="custom-control-input" id="employee-radio3" name="radio-stacked" required>
    											<label class="custom-control-label" for="employee-radio3">Employee</label>
                  							</div>
                  							<div class="custom-control custom-radio radio-info">
                              					<input type="radio" class="custom-control-input" id="manager-radio3" name="radio-stacked" required>
    											<label class="custom-control-label" for="manager-radio3">Manager</label>
                  							</div>
								         </td>
								         <td><label class="label label-success">Active</label></td>
								         <td>17-08-2019</td>
								         <td>
								            <a href="#" class="btn btn-info btn-circle" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
								            <a href="employee-view-details.html" class="btn btn-success btn-circle" data-toggle="tooltip" data-original-title="View Client Details"><i class="fa fa-search" aria-hidden="true"></i></a>
								            <a href="#" class="btn btn-danger btn-circle sa-params" data-toggle="tooltip" data-user-id="42" data-original-title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>
								         </td>
								      </tr>
								   	</tbody>
								</table>
							</div>
		                </div>
                	</div>
                </div>
            </div>
            <!-- ends of contentwrap -->
