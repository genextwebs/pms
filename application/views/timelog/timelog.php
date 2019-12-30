<nav aria-label="breadcrumb" class="breadcrumb-nav">
	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title"><i class="ti-ticket"></i> Timelog</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url().'ticket' ?>">Home</a></li>
				 <li class="active">Timelog</li>
			</ol>
		</div>
	</div>
</nav>

<!-- contetn-wrap -->
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
				<select id="categoryname" class="custom-select" name="categoryname">
							<option value="">--Select--</option>
							
				</select> 
			    
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">Select Employee</label>
				<select id="categoryname" class="custom-select" name="categoryname">
							<option value="">--Select--</option>
							
				</select> 
			    
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
            <div class="form-group m-t-10">
                <label class="control-label col-12 mb-3">&nbsp;</label>
                <button type="button" id="btnApplyLogs" class="btn btn-success col-lg-4 co-md-5"><i class="fa fa-check"></i> Apply</button>
            </div>
        </div>
    </div>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="form-group custom-action">
			<a href="<?php echo base_url().'timelog/addtimelog'?>" class="btn btn-outline-success btn-sm">Add New Project <i class="fa fa-plus" aria-hidden="true"></i></a>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="stats-box"> 
			<div class="table-responsive">
				<table class="table table-bordered table-hover" id="timelog">
					<thead>
						<tr role="row">
							 <th>Id</th>
							 <th>Project</th>
							<th>Employee Name</th>
							 <th>Start Date</th> 
							 <th>End Date</th> 
							 <th>Total Hours</th>
							 <th>Earnings</th>
							 <th>Action</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>
			
<!-- ends of contentwrap -->

<div class="modal fade project-category" id="timelog-popup" tabindex="-1" role="dialog" aria-labelledby="project-category" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content br-0">
			
			<div class="modal-body">
				<div class="table-responsive" id="timelogpreview">

				</div>
			</div>
		</div>
	</div>
</div>
