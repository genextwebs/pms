<nav aria-label="breadcrumb" class="breadcrumb-nav">
	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title"><i class="ti-ticket"></i> Tickets</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url().'ticket' ?>">Home</a></li>
				 <li class="active">Tickets</li>
			</ol>
		</div>
	</div>
</nav>

<!-- contetn-wrap -->
<div class="content-in">  
	<div class="row">
		<div class="col-md-4">
			<div class="white-box p-b-0"> 
				<div class="form-group">
				    <label class="control-label">Start Date</label>
					    <input type="text" name="start_date" id="start_date" autocomplete="off" class="form-control" value="">
			    </div>
		    </div>
		</div> 
    
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
        			<div class="col-md-6">
        				<div class="form-group">
	                        <a class="btn btn-outline-success btn-sm"  href="<?php echo base_url().'Ticket/addticket'?>">Create Ticket <i class="fa fa-plus" aria-hidden="true"></i></a>
							<a href="javascript:;" id="toggle-filter" class="btn btn-outline-danger btn-sm toggle-filter"><i class="fa fa-sliders"></i> Filter Results</a>
						</div>
        			</div>
				</div>
				<!-- <div class="row filter-from" id="ticket-filters" style="display: none;">
	             	<div class="col-md-12">
	                    <h4>Filter by <a href="javascript:;" class="pull-right toggle-filter"><i class="fa fa-times-circle-o"></i></a></h4>
	               	</div>
	                <form action="" id="filter-form">
						<div class="row">
		                	<div class="col-md-4">
		                		<label class="control-label">Agent</label>
            					<div class="form-group">
            						<select id='status' class="select2 form-control" data-placeholder="Select Agent">
							            <option value='all'>All</option>       
							            <option value='0'>Waiting</option>  
							            <option value='1'>Accepted</option> 
							            <option value='2'>Declined</option>   
									</select> 
            					</div>
		                	</div>

		                	<div class="col-md-4">
		                		<label class="control-label">Status</label>
            					<div class="form-group">
            						<select id='status' class="select2 form-control" data-placeholder="Select Status">
							            <option value='all'>All</option>       
							            <option value='0'>Waiting</option>  
							            <option value='1'>Accepted</option> 
							            <option value='2'>Declined</option>   
										</select> 
            					</div>
		                	</div>

	                		<div class="col-md-4">
	                			<label class="control-label">Priority</label>
        						<div class="form-group">
        							<select id='status' class="select2 form-control" data-placeholder="Select Priority">
							            <option value='all'>All</option>       
							            <option value='0'>Waiting</option>  
							            <option value='1'>Accepted</option> 
							            <option value='2'>Declined</option>   
									</select> 
        						</div>
	                		</div>
	                		<div class="col-md-4">
	                			<label class="control-label">Channel Name</label>
        						<div class="form-group">
        							<select id='status' class="select2 form-control" data-placeholder="Select ChannelName">
							            <option value='all'>All</option>       
							            <option value='0'>Waiting</option>  
							            <option value='1'>Accepted</option> 
							            <option value='2'>Declined</option>   
									</select> 
        						</div>
	                		</div>
	                		<div class="col-md-4">
	                			<label class="control-label">Type</label>
        						<div class="form-group">
        							<select id='status' class="select2 form-control" data-placeholder="Select Type">
							            <option value='all'>All</option>       
							            <option value='0'>Waiting</option>  
							            <option value='1'>Accepted</option> 
							            <option value='2'>Declined</option>   
									</select> 
        						</div>
	                		</div>
		                	<div class="col-md-4">
		                        <div class="form-group m-t-10">
		                            <label class="control-label col-12 mb-3">&nbsp;</label>
		                            	<button type="button" id="btnApplyEstimates" class="btn btn-success col-lg-4 co-md-5"><i class="fa fa-check"></i> Apply</button>
		                            	<button type="button" id="reset-filters" class="btn btn-inverse col-lg-4 co-md-5 offset-md-1"><i class="fa fa-refresh"></i> Reset</button>
		                        </div>
		                    </div>
						</div>
					</form>
				</div> -->
			 
			
				<?php
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
					<table class="table table-bordered table-hover" id="tickets">
						<thead>
							<tr role="row">
								 <th>Id</th>
								 <th>Ticket Subject</th>
								<th>Requester Name</th>
								 <th>Requested On</th> 
								 <th>Others</th> 
								 <th>Action</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
			
<!-- ends of contentwrap -->

<!--For +add type-->

<div class="modal fade project-category" id="type1" tabindex="-1" role="dialog" aria-labelledby="project-category" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content br-0">
			<div class="modal-header">
				<h4 class="modal-title"> Project Category</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
					</button>
			</div>
			<div class="modal-body">
				<form class="" id="ticket" name="ticket" method="post" onsubmit="return checkName();">
					<div class="form-body">
						<div class="row">
							<div class="col-md-12 ">
								<div class="form-group">
									<label>Ticket Type</label>
									<input type="text" name="category_name" id="ticket_type" class="form-control">
								</div>
							</div>
						</div>
					</div>
					<div class="form-actions">
						<input type="submit" id="save_ticket" class="btn btn-success" value="Save"> <i class="fa fa-check"></i>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>