<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="icon-speedometer"></i> Dashboard</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li><a href="#">Leads</a></li>
            </ol>
        </div>
    </div>
</nav>

<!-- contetn-wrap -->
<div class="content-in">  
    <div class="row">
        <div class="col-md-3">
            <div class="stats-box bg-black">
                <h3 class="box-title text-white">Total Leads</h3>
                <ul class="list-inline two-wrap">
                    <li><i class="icon-docs text-white"></i></li>
                    <li class="text-right"><span id="" class="counter text-white">1</span></li>
                </ul>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-box bg-info">
                <h3 class="box-title text-white">Total Clients Convert</h3>
                <ul class="list-inline two-wrap">
                    <li><i class="icon-user text-white"></i></li>
                    <li class="text-right"><span id="" class="counter text-white">0</span></li>
                </ul>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-box bg-warning">
                <h3 class="box-title text-white">Total Pending Follow Up</h3>
                <ul class="list-inline two-wrap">
                    <li><i class="icon-calender text-white"></i></li>
                    <li class="text-right"><span id="" class="counter text-white">0</span></li>
                </ul>
            </div>
        </div>

        <div class="col-md-12">
            <div class="stats-box">
            	<div class="row">
            		<div class="col-md-6">
            			<div class="form-group">
                            <a href="<?php echo base_url().'Leads/addleads'?>" class="btn btn-outline-success btn-sm">Add New Lead <i class="fa fa-plus" aria-hidden="true"></i></a>
                        </div>
            		</div>
            	</div>
            	<div class="table-responsive">
                	<table class="table table-bordered table-hover" id="leads" >
					   	<thead>
					      	<tr role="row">
						         <th>Id</th>
						         <th>Client Name</th>
						         <th>Company Name</th>
						         <th>Created On</th>
						         <th>Next Follow Up</th>
						         <th>Status</th>
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