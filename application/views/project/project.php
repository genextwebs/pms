<nav aria-label="breadcrumb" class="breadcrumb-nav">
	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title"><i class="icon-speedometer"></i> Projects</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url().'dashboard' ?>">Home</a></li>
				 <li class="active">Projects</li>
			</ol>
		</div>
	</div>
</nav>

<!-- contetn-wrap -->
<div class="content-in">  
	<div class="row">
		<div class="col-md-2">
			<div class="stats-box bg-black pt-1 pb-1">
				<h3 class="box-title text-white">Total Projects</h3>
				<ul class="list-inline two-wrap">
					<li><i class="icon-layers text-white"></i></li>
					 <?php 
						$Totals = $this->common_model->getData('tbl_project_info');
						$total_Project = count($Totals);
					 ?>
					<li class="text-right"><span id="" class="counter text-white"><?php echo $total_Project;?></span></li>
				</ul>
			</div>
		</div>
		<div class="col-md-2">
			<div class="stats-box bg-black pt-1 pb-1">
				<h3 class="box-title text-white">Incomplete Projects</h3>
				<ul class="list-inline two-wrap">
					<li><i class="icon-layers text-white"></i></li>
					 <?php 
						$whereArr=array('status'=>0);
						$Total = $this->common_model->getData('tbl_project_info',$whereArr);
						$total_Project = count($Total);
					 ?>
					<li class="text-right"><span id="" class="counter text-white"><?php echo $total_Project;?></span></li>
				</ul>
			</div>
		</div>

		<div class="col-md-2">
			<div class="stats-box bg-success pt-1 pb-1">
				<h3 class="box-title text-white">Completed Projects</h3>
				<ul class="list-inline two-wrap">
					<li><i class="icon-layers text-white"></i></li>
					<?php 
						$whereArr=array('status'=>1);
						$Total = $this->common_model->getData('tbl_project_info',$whereArr);
						$total_Project = count($Total);
					 ?>
				   <li class="text-right"><span id="" class="counter text-white"><?php echo $total_Project;?></span></li>
				</ul>
			</div>
		</div>
		<div class="col-md-2">
			<div class="stats-box bg-info pt-1 pb-1">
				<h3 class="box-title text-white">In Process Projects</h3>
				<ul class="list-inline two-wrap">
					<li><i class="icon-layers text-white"></i></li>
					<?php 
						$whereArr=array('status'=>2);
						$Total = $this->common_model->getData('tbl_project_info',$whereArr);
						$total_Project = count($Total);
					 ?>
					<li class="text-right"><span id="" class="counter text-white"><?php echo $total_Project;?></span></li>
				</ul>
			</div>
		</div>
		<div class="col-md-2">
			<div class="stats-box bg-black pt-1 pb-1">
				<h3 class="box-title text-white">OnHold Projects</h3>
				<ul class="list-inline two-wrap">
					<li><i class="icon-layers text-white"></i></li>
					 <?php 
						$whereArr=array('status'=>3);
						$Total = $this->common_model->getData('tbl_project_info',$whereArr);
						$total_Project = count($Total);
					 ?>
					<li class="text-right"><span id="" class="counter text-white"><?php echo $total_Project;?></span></li>
				</ul>
			</div>
		</div>
		<div class="col-md-2">
			<div class="stats-box bg-danger pt-1 pb-1">
				<h3 class="box-title text-white">Cancelled Projects</h3>
				<ul class="list-inline two-wrap">
					<li><i class="icon-layers text-white"></i></li>
						<?php 
							$whereArr=array('status'=>4);
							$Total = $this->common_model->getData('tbl_project_info',$whereArr);
							$total_Project = count($Total);
						 ?>
					<li class="text-right"><span id="" class="counter text-white"><?php echo $total_Project;?></span></li>
				</ul>
			</div>
		</div>
		<div class="col-md-12">
			<div class="stats-box">
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group custom-action">
							<a href="<?php echo base_url().'Project/addproject'?>" class="btn btn-outline-success btn-sm">Add New Project <i class="fa fa-plus" aria-hidden="true"></i></a>
							
							<a href="javascript:;"  class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#project-category1">Add Project Category <i class="fa fa-plus" aria-hidden="true"></i></a>
							
							<!--<a href="javascript:;" class="btn btn-outline-danger btn-sm hidden-xs hidden-sm"><i class="fa fa-bar-chart" aria-hidden="true"></i> Gantt Chart</a>-->
							
							<a href="<?php echo base_url().'Project/projecttemplate';?>"  class="btn btn-outline-primary btn-sm">Project Templates <i class="fa fa-plus" aria-hidden="true"></i></a>
							
							<!--<a href="<?php echo base_url().'Project/viewarchiev';?>"  class="btn btn-outline-info btn-sm">View Archive <i class="fa fa-trash" aria-hidden="true"></i></a>-->
							
							<!--<a href="javascript:;" onclick="exportData()" class="btn btn-info btn-sm"><i class="ti-export" aria-hidden="true"></i> Export To Excel</a>-->
					  </div>
				 </div>
			 </div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
					<label class="control-label">Project Status</label>
						<select name="status" id="project_status" class="custom-select" name="status">
							<option value='all'>All</option> 
							<option value='0'>Incomplete </option>
							<option value='1'>Complete </option>
							<option value='2'>In Progress </option>
							<option value='3'>On Hold  </option>
							<option value='4'>Cancelled </option>
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
					<table class="table table-bordered table-hover" id="project">
						<thead>
							<tr role="row">
								 <th>Id</th>
								 <th>Project Name</th>
								 <th>Project Members</th>
								 <th>Deadline</th>
								 <th>Client</th>
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
