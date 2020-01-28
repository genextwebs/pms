<nav aria-label="breadcrumb" class="breadcrumb-nav">
	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title"><i class="ti-ticket"></i> Tickets</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url().'EmpDashboard' ?>">Home</a></li>
				 <li class="active">Tickets</li>
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

						    <input type="text" class="start-date form-control br-0" id="start_date" name="start_date" value="<?php echo $s_date;?>" data-date-format='yyyy-mm-dd'>
						    <div class="input-group-prepend">
						      <span class="input-group-text bg-info text-white">To</span>
						    </div>
						    <input type="text" class="end-date form-control br-0" id="deadline" name="deadline" value="<?php echo $e_date;?>" data-date-format='yyyy-mm-dd'>

				</div>

			</div>
		</div>
		<div class="col-md-4">
            <div class="form-group m-t-10">
                <label class="control-label col-12 mb-3">&nbsp;</label>
                <button type="button" id="btnApply" class="btn btn-success col-lg-4 co-md-5"><i class="fa fa-check"></i> Apply</button>
            </div>
        </div>

	</div>
	<div class="row">
		<!--TOTAL TICKET-->
		<div class="col-sm-4">
			<div class="white-box p-t-10 p-b-10 bg-warning"> 
				<h3 class="box-title text-white">TOTAL TICKETS</h3>
				<ul class="list-inline two-wrap">
					<li><i class="icon-logout text-white"></i></li>
						<?php 
							$Total = $this->common_model->getData('tbl_ticket');
							$total_leaves = count($Total);
						?>
					<li class="text-right"><span id="" class="counter text-white"><?php echo $total_leaves;?></span></li>
				</ul>
			</div>
		</div>
		<!--CLOSED TICKETS-->
		<div class="col-sm-4">
			<div class="white-box p-t-10 p-b-10 bg-warning"> 
				<h3 class="box-title text-white">CLOSED TICKETS</h3>
				<ul class="list-inline two-wrap">
					<li><i class="icon-logout text-white"></i></li>
						<?php
							$whereArr = array('status'=>4); 
							$Total = $this->common_model->getData('tbl_ticket',$whereArr);

							$total_leaves = count($Total);
						?>
					<li class="text-right"><span id="" class="counter text-white"><?php echo $total_leaves;?></span></li>
				</ul>
			</div>
		</div>
	</div>  
	<div class="row">
		<div class="col-sm-4">
			 <div class="white-box p-t-10 p-b-10 bg-warning"> 
				<h3 class="box-title text-white">OPEN TICKETS</h3>
				<ul class="list-inline two-wrap">
					<li><i class="icon-logout text-white"></i></li>
						<?php 
							$whereArr =	array('status'=>1);
							$Total = $this->common_model->getData('tbl_ticket',$whereArr);
							$total_leaves = count($Total);
						?>
					<li class="text-right"><span id="" class="counter text-white"><?php echo $total_leaves;?></span></li>
				</ul>
			</div>
		</div>
		<div class="col-sm-4">
			 <div class="white-box p-t-10 p-b-10 bg-warning"> 
				<h3 class="box-title text-white">PENDING TICKETS</h3>
				<ul class="list-inline two-wrap">
					<li><i class="icon-logout text-white"></i></li>
						<?php 
							$whereArr =	array('status'=>2);
							$Total = $this->common_model->getData('tbl_ticket',$whereArr);
							$total_leaves = count($Total);
						?>
					<li class="text-right"><span id="" class="counter text-white"><?php echo $total_leaves;?></span></li> 
				</ul>
			</div>
		</div>
		<div class="col-sm-4">
			 <div class="white-box p-t-10 p-b-10 bg-warning"> 
				<h3 class="box-title text-white">RESOLVED TICKETS</h3>
				<ul class="list-inline two-wrap">
					<li><i class="icon-logout text-white"></i></li>
						<?php 
							$whereArr =	array('status'=>3);
							$Total = $this->common_model->getData('tbl_ticket',$whereArr);
							$total_leaves = count($Total);
						?>
					<li class="text-right"><span id="" class="counter text-white"><?php echo $total_leaves;?></span></li>
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
        				<?php if($this->user_type == 0) { ?>
	                        <a class="btn btn-outline-success btn-sm"  href="<?php echo base_url().'Ticket/addticket'?>">Create Ticket <i class="fa fa-plus" aria-hidden="true"></i></a>
	                     <?php } ?>
							<a href="javascript:;" id="toggle-filter" class="btn btn-outline-danger btn-sm toggle-filter"><i class="fa fa-sliders"></i> Filter Results</a>
						</div>
        			</div>
        		
				</div>
				<div class="row filter-from" id="ticket-filters" style="display: none;">
	             	<div class="col-md-12">
	                    <h4>Filter by <a href="javascript:;" class="pull-right toggle-filter"><i class="fa fa-times-circle-o"></i></a></h4>
	               	</div>
	                <form action="" id="filter-form">
						<div class="row">
		                	<div class="col-md-4">
		                		<label class="control-label">Agent</label>
            					<div class="form-group">
            						<select id='agent' class="select2 form-control" data-placeholder="Select Agent">
							            <option selected>Agent not assigned</option>
	            								<option>Kethi Oman[kethi@example.com]</option>
	            								<option>Obama Donald[donald77@example.com]</option>
	            								<option>Jequcy Trump[jequcy@example.com]</option>
	            								<option>herry Oman[Oman@example.com]</option>
	            								<option>Obama champ[Obama@example.com]</option>
	            								<option>maxo Trump[Trump@example.com]</option>  
									</select> 
            					</div>
		                	</div>

		                	<div class="col-md-4">
		                		<label class="control-label">Status</label>
            					<div class="form-group">
            						<select id='status' class="select2 form-control" data-placeholder="Select Status">
					            		<option value="">--Select--</option>
        								<option  value="1">Open</option>
        								<option value="2">Pending</option>
        								<option value="3">Resolved</option>
        								<option value="4">Close</option>
									</select> 
            					</div>
		                	</div>

	                		<div class="col-md-4">
	                			<label class="control-label">Priority</label>
        						<div class="form-group">
        							<select id='priority' class="select2 form-control" data-placeholder="Select Priority">
        								<option value="all">--Select--</option>
							           	<option value="1">Low</option>
        								<option value="2">High</option>
        								<option value="3">Medium</option>
        								<option value="4">Urgent</option>
									</select> 
        						</div>
	                		</div>
	                		<div class="col-md-4">
	                			<label class="control-label">Channel Name</label>
        						<div class="form-group">
        							<select id='channelname' class="select2 form-control" data-placeholder="Select ChannelName">
							            <option value="all">--Select--</option>
									
										 <?php
							            	foreach($ticketchannel as $channel){
							            		echo '<option value="'.$channel->id.'">
							            		'.$channel->name.'</option>';
							            	} 
							            ?> 
									</select> 
        						</div>
	                		</div>
	                		<div class="col-md-4">
	                			<label class="control-label">Type</label>
        						<div class="form-group">
        							<select id='tickettype' class="select2 form-control" data-placeholder="Select Type">
        								<option value="all">--Select--</option>
							           	<?php
											foreach($tickettype as $type)
											{
												echo '<option value="'.$type->id.'" >'.$type->name.'</option>';
											}
										?>
									</select> 
        						</div>
	                		</div>
		                	<div class="col-md-4">
		                        <div class="form-group m-t-10">
		                            <label class="control-label col-12 mb-3">&nbsp;</label>
		                            	<button type="button" id="btnApplyTicket" class="btn btn-success col-lg-4 co-md-5"><i class="fa fa-check"></i> Apply</button>
		                            	<button type="reset" id="btnreset" class="btn btn-inverse col-lg-4 co-md-5 offset-md-1"><i class="fa fa-refresh"></i> Reset</button>
		                        </div>
		                    </div>
						</div>
					</form>
				</div> 
			 
			
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


