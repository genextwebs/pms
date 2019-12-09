<nav aria-label="breadcrumb" class="breadcrumb-nav">
	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title"><i class="icon-speedometer"></i> Projects</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url().'dashboard' ?>">Home</a></li>
				 <li class="active">Leaves</li>
			</ol>
		</div>
	</div>
</nav>

<!-- contetn-wrap -->
<div class="content-in">  
	<div class="row">
		<div class="col-md-2">
			<div class="white-box p-t-10 p-b-10 bg-warning"> 
				<h3 class="box-title text-white">Pending Leaves</h3>
				<ul class="list-inline two-wrap">
					<li><i class="icon-logout text-white"></i></li>
					 <?php 
						$Total = $this->common_model->getData('tbl_leaves');
						$total_leaves = count($Total);
					 ?>
					<li class="text-right"><span id="" class="counter text-white"><?php echo $total_leaves;?></span></li>
				</ul>
			</div>
		</div>
	
		<div class="col-md-12">
			<div class="stats-box">
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group custom-action">
							<a href="<?php echo base_url().'Project/addproject'?>" class="btn btn-outline-success btn-sm"> <i class="fa fa-list" aria-hidden="true"></i>All Leaves </a>
							
							<a href="javascript:;"  class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#project-category1"><i class="fa fa-calendar" aria-hidden="true"></i> Calendar View </a>
							
							<!--<a href="javascript:;" class="btn btn-outline-danger btn-sm hidden-xs hidden-sm"><i class="fa fa-bar-chart" aria-hidden="true"></i> Gantt Chart</a>-->
							
							<a href="<?php echo base_url().'Leaves/addleaves';?>"  class="btn btn-outline-primary btn-sm"><i class="ti-plus" aria-hidden="true"></i>Assign Leave </a>
							
							<!--<a href="<?php echo base_url().'Project/viewarchiev';?>"  class="btn btn-outline-info btn-sm">View Archive <i class="fa fa-trash" aria-hidden="true"></i></a>-->
							
							<!--<a href="javascript:;" onclick="exportData()" class="btn btn-info btn-sm"><i class="ti-export" aria-hidden="true"></i> Export To Excel</a>-->
					  </div>
				 </div>
			 </div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">SELECT DATE RANGE</label>
						<input type="text" class="form-control" id="start-date" placeholder="Start Date" value="30-11-2019">
						<span class="input-group-addon bg-info b-0 text-white">To</span>
						<input type="text" class="form-control" id="end-date" placeholder="End Date" value="06-01-2020">
				   </div>
				</div>
				<div class="col-lg-3 col-md-4">
					<div class="form-group">
						<label class="control-label">EMPLOYEE NAME
						</label>
						<select id="empname" class="custom-select" name="empname">
							<option value="">--Select--</option>
								<?php
									foreach($employee as $row)
									{
										echo '<option value="'.$row->empid.'" >'.$row->employeename.'</option>';
									}
								?>
						</select>
					</div>
				</div>
			</div>
				<?php
					$mess = $this->session->flashdata('message_name');
					if(!empty($mess)){
						//warning 
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
					<table class="table table-bordered table-hover" id="leaves">
						<thead>
							<tr role="row">
								 <th>Id</th>
								 <th>Employee</th>
								 <th>Leave Date</th>
								 <th>Leave Status</th>
								 <th>Leave Type</th>
								<!-- <th>Completion</th>-->
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
<?php 
	$this->load->view('common/projectcategory');
?>
