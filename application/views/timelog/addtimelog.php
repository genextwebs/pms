<nav aria-label="breadcrumb" class="breadcrumb-nav">
	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title"><i class="icon-layers"></i> Timelog</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url().'Dashboard/';?>">Home</a></li>
				<li><a href="<?php echo base_url().'Timelog/';?>">Timelog</a></li>
				<li class="active">Add New</li>
			</ol>
		</div>
	</div>
</nav>

 <!-- contetn-wrap -->
<div class="content-in">  
	<div class="row">
		<div class="col-md-12">
			<div class="card br-0">
				<div class="card-header br-0 card-header-inverse">
					Add Timelog 
				</div>
				<div class="card-wrapper collapse show">
					<div class="card-body">
						<form id="creatclient" class="aj-form" name="creatclient" method="post" action="<?php echo base_url().'ticket/addtimelog'?>">
							<?php
                                    $mess = $this->session->flashdata('message_name');
                                    if(!empty($mess)){
                                        //warning 
                                    ?>
            				<div class="submit-alerts">
            					<div class="alert alert-success" role="alert" style="display:block;">
								</div>
                            </div>
                            <div class="submit-alerts">
								<div class="alert alert-danger" role="alert" style="display:block;">
								 <?php echo $mess; ?>
								</div>
                            </div>
                            <?php  } ?>
                            <div class="submit-alerts">
								<div class="alert alert-warning" role="alert">
								  This is a warning alert
								</div>
            				</div>
                            
							<div class="form-body">
								<h3 class="box-title">Timelog Info</h3><hr>
									<p id="succmsg" class="text-success"></p>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">Project Name</label>
														<input id="project_name" class="form-control" type="text" name="project_name" value="">
												</div>
											</div>
										</div>	
							</div>
					    </form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
