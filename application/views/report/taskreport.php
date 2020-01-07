<nav aria-label="breadcrumb" class="breadcrumb-nav">
	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title"><i class="icon-speedometer"></i> Task Report</h4>
		</div>
		 <div class="col-lg-9 col-sm -8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url().'dashboard' ?>">Home</a></li>
				 <li class="active"> Task Report</li>
			</ol>
		</div>
	</div> 
</nav>

<!-- contetn-wrap -->
<div class="content-in">  
	<div class="row">
		<div class="col-md-4">
			<div class="stats-box bg-black pt-1 pb-1">
				<h3 class="box-title text-white">Total Tasks</h3>
				<ul class="list-inline two-wrap">
					<li><i class="icon-layers text-white"></i></li>
					 <?php 
						$Totals = $this->common_model->getData('tbl_task');
						$total_Task = count($Totals);
					 ?>
					<li class="text-right"><span id="" class="counter text-white"><?php echo $total_Task;?></span></li>
				</ul>
			</div>
		</div>
		<div class="col-md-4">
			<div class="stats-box bg-black pt-1 pb-1">
				<h3 class="box-title text-white">Completed Tasks</h3>
				<ul class="list-inline two-wrap">
					<li><i class="icon-layers text-white"></i></li>
					 <?php 
					 	$whereArr=array('status'=>4);
						$Totals = $this->common_model->getData('tbl_task',$whereArr);
						$tbl_task = count($Totals);
					 ?>
					<li class="text-right"><span id="" class="counter text-white"><?php echo $tbl_task;?></span></li>
				</ul>
			</div>
		</div>
		<div class="col-md-4">
			<div class="stats-box bg-black pt-1 pb-1">
				<h3 class="box-title text-white">Pending Tasks</h3>
				<ul class="list-inline two-wrap">
					<li><i class="icon-layers text-white"></i></li>
					 <?php 
					 	$whereArr=array('status'=>1);
						$Totals = $this->common_model->getData('tbl_task',$whereArr);
						$tbl_task = count($Totals);
					 ?>
					<li class="text-right"><span id="" class="counter text-white"><?php echo $tbl_task;?></span></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="content-in">
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label">SELECT DATE RANGE</label>
			    		<div class="input-group input-daterange">
					  	    <input type="text" class="start-date form-control br-0" id="start_date" name="start_date" value="" data-date-format='yyyy-mm-dd'>
					   		<div class="input-group-prepend">
					        	<span class="input-group-text bg-info text-white">To</span>
				    		</div>
				  		    <input type="text" class="end-date form-control br-0" id="deadline" name="deadline" value="" data-date-format='yyyy-mm-dd'>
						</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label">Select Project</label>
					<select id="projectData" class="custom-select" name="projectData">
						<option value="">--Select--</option>
							<?php 
								foreach($allProjectData as $project){
							?>
							<option value="<?php echo $project->id; ?>"><?php echo $project->projectname; ?></option>
							<?php	
					
							}
							?>
					</select> 
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label">Select Employee</label>
					<select id="employeeData" class="custom-select" name="employeeData">
						<option value="">--Select--</option>
						<?php
							foreach($allEmpData as $emp){
						?>
							<option value="<?php echo $emp->id ;?>"><?php echo $emp->employeename;?></option>
						<?php 

							} 
						?>		
					</select> 
				</div>
			</div>
	</div>
	<div class="row">
		<div class="col-md-4">
            <div class="form-group m-t-10">
                <label class="control-label col-12 mb-3">&nbsp;</label>
                <button type="button" id="btnApplyReport" class="btn btn-success col-lg-4 co-md-5"><i class="fa fa-check"></i> Apply</button>
            </div>
        </div>
    </div>
</div>



<div class="row">
	<div class="col-md-12">
		<div class="stats-box"> 
			<div class="table-responsive">
				<table class="table table-bordered table-hover" id="taskreport">
					<thead>
						<tr role="row">
							 <th>Id</th>
							 <th>Project</th>
							<th>Title</th>
							 <th>Due Date</th> 
							 <th>Assign To</th> 
							 <th>Status</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>