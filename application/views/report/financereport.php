<nav aria-label="breadcrumb" class="breadcrumb-nav">
	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title"><i class="icon-speedometer"></i> Finance Report</h4>
		</div>
		 <div class="col-lg-9 col-sm -8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url().'dashboard' ?>">Home</a></li>
				 <li class="active"> Finance Report</li>
			</ol>
		</div>
	</div> 
</nav>


<div class="content-in">
	<form id="creatleave=-" class="aj-form--" name="TimeLogRepor--t" method="post" action="<?php echo base_url().'TimeLogReport/getPostData';?>">
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
					<label class="control-label">Project</label>
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
					<label class="control-label">Client</label>
					<select id="projectData" class="custom-select" name="projectData">
						<option value="">--Select--</option>
							<?php 
								foreach($allClients as $client){
							?>
							<option value="<?php echo $client->id; ?>"><?php echo $client->clientname; ?></option>
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
	                <button type="submit" id="btnApplyTimeReport" class="btn btn-success col-lg-4 co-md-5"><i class="fa fa-check"></i> Apply</button>
	            </div>
	        </div>
	    </div>
	</form>
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
					<table class="table table-bordered table-hover" id="finanacereport">
						<thead>
							<tr role="row">
								 <th>Id</th>
								 <th>Project</th>
								 <th>Invoice</th> 
								 <th>Amount</th>
								 <th>Paid On</th>
								<th>Status</th>
								<!--  <th>Remark</th> -->
							</tr>
						</thead>
					</table>
				</div>