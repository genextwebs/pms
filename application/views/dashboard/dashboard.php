<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="icon-speedometer"></i> Dashboard</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </div>
    </div>
</nav>

<!-- contetn-wrap -->
<div class="content-in">  
    <div class="row db-stats">
        <div class="col-md-3 col-sm-6">
            <a href="#">
                <div class="stats-box">
                    <div class="row">
                        <div class="col-sm-3">
                            <div>
                                <span class="bg-success-gradient"><i class="icon-user"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-9 text-right">
                            <span class="widget-title"> Total Clients</span><br>
                            <span class="counter"><?php echo $totalClient; ?></span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6">
            <a href="#">
                <div class="stats-box">
                    <div class="row">
                        <div class="col-sm-3">
                            <div>
                                <span class="bg-success-gradient"><i class="icon-people"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-9 text-right">
                            <span class="widget-title"> Total Employees</span><br>
                            <span class="counter"><?php echo $totalEmployee; ?></span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6">
            <a href="#">
                <div class="stats-box">
                    <div class="row">
                        <div class="col-sm-3">
                            <div>
                                <span class="bg-success-gradient"><i class="icon-layers"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-9 text-right">
                            <span class="widget-title">  Total Projects</span><br>
                            <span class="counter"><?php echo $totalproject; ?></span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6">
            <a href="#">
                <div class="stats-box">
                    <div class="row">
                        <div class="col-sm-3">
                            <div>
                                <span class="bg-success-gradient"><i class="icon-user"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-9 text-right">
                            <span class="widget-title"> Unpaid Invoices</span><br>
                            <span class="counter">131</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 col-sm-6">
            <a href="#">
                <div class="stats-box">
                    <div class="row">
                        <div class="col-sm-3">
                            <div>
                                <span class="bg-info-gradient"><i class="icon-clock"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-9 text-right">
                            <span class="widget-title"> Hours Logged</span><br>
                            <span style="font-size: 20px;">49490 hrs </span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6">
            <a href="#">
                <div class="stats-box">
                    <div class="row">
                        <div class="col-sm-3">
                            <div>
                                <span class="bg-warning-gradient"><i class="ti-alert"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-9 text-right">
                            <span class="widget-title">Pending Tasks</span><br>
                            <span class="counter"><?php echo $totalTaskPending; ?></span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6">
            <a href="#">
                <div class="stats-box">
                    <div class="row">
                        <div class="col-sm-3">
                            <div>
                                <span class="bg-success-gradient"><i class="ti-check-box"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-9 text-right">
                            <span class="widget-title"> Completed Tasks</span><br>
                            <span class="counter"><?php echo $totalTaskComplete; ?></span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6">
            <a href="#">
                <div class="stats-box">
                    <div class="row">
                        <div class="col-sm-3">
                            <div>
                                <span class="bg-danger-gradient"><i class="fa fa-percent" style="display: inherit;"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-9 text-right">
                            <span class="widget-title"> Today Attendance</span><br>
                            <span class="counter">18.75</span>% 
                            <span class="text-muted">(6/32)</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row">
    	<div class="col-md-6">
    		<div class="row">
    			<div class="col-md-6 col-sm-12 db-stats"> 
                	<a href="#">
                        <div class="stats-box">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div>
                                        <span class="bg-success-gradient"><i class="ti-ticket"></i></span>
                                    </div>
                                </div>
                                <div class="col-sm-9 text-right">
                                    <span class="widget-title"> Resolved Tickets</span><br>
                                    <span class="counter"><?php echo $totalticketResolved; ?></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-sm-12 db-stats"> 
                	<a href="#">
                        <div class="stats-box">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div>
                                        <span class="bg-success-gradient"><i class="ti-ticket"></i></span>
                                    </div>
                                </div>
                                <div class="col-sm-9 text-right">
                                    <span class="widget-title"> Unresolved Tickets</span><br>
                                    <span class="counter"><?php echo $totalticketPending; ?></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!--  -->
                <div class="col-md-12">
                	<div class="bg-theme-blue m-b-15">
                		<div id="carouselExampleIndicators" class="carousel slide p-3" data-ride="carousel">
							<h4 class="text-white p-t-0 p-b-0">Client Feedback</h4>
						  	<div class="carousel-inner">
							    <div class="carousel-item active">
							      	<h5 class="text-white">For anything tougher than suet; Yet you finished the first day,' said ...</h5>
							  		<div class="tws-user">
							  			<img class="" src="images/default-profile-2.png" alt="user">
							  			<h5 class="text-white mb-0">Willow Borer</h5>
							  			<p class="text-white">Airline Reservation System</p>
							  		</div>
							    </div>
							    <div class="carousel-item">
							      	<h5 class="text-white">Hatter said, turning to the Mock Turtle. 'And how do you know about th...</h5>
							  		<div class="tws-user">
							  			<img class="" src="images/default-profile-2.png" alt="user">
							  			<h5 class="text-white mb-0">Adella Auer</h5>
							  			<p class="text-white">User Management</p>
							  		</div>
							    </div>
							    <div class="carousel-item">
							      	<h5 class="text-white">For anything tougher than suet; Yet you finished the first day,' said ...</h5>
							  		<div class="tws-user">
							  			<img class="" src="images/default-profile-2.png" alt="user">
							  			<h5 class="text-white mb-0">Willow Borer</h5>
							  			<p class="text-white">Airline Reservation System</p>
							  		</div>
							    </div>
						  	</div>
						</div>
                	</div>
                </div>
                <!--  -->
    		</div>
    	</div>
    	<div class="col-md-6">
    		<div class="row">
    			<div class="col-md-12">
    				<div class="stats-box">
    					<h3 class="box-title mb-0">Recent Earnings</h3>
                        <?php
                            $str='';
                            $str1='';
                            foreach($finalTempArr as $key=>$value){
                                $str.= '"'.$key.'"'.',';
                                $str1.= $value['totalEarning'].',';
                            }
                        ?>
                        <div id="container" style="height: 400px"></div>
                        <script type="text/javascript">
                            Highcharts.chart('container', {
                                chart: {
                                    type: 'column'
                                },
                                title: {
                                    text: 'EARNINGS'
                                },
                              
                                xAxis: {
                                    categories: [<?php echo rtrim($str,',');?>],
                                    crosshair: true
                                },
                                yAxis: {
                                    min: 0,
                                    title: {
                                        text: ''
                                    }
                                },
                                   series: [{
                                    name: 'Total Earning',
                                    data: [<?php  echo rtrim($str1,',');?>]

                                }]
                            });
                        </script>                        
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
    <div class="row">
    	<div class="col-md-6">
    		<div class="card c-wrapp">
			    <div class="card-header">New Tickets</div>
			    <div class="card-wrapper collapse show">
			        <div class="card-body">
			            <ul class="list-task list-group border-none" data-role="tasklist">
                            <?php  foreach($ticketNew as $row){ ?>
                                <li class="list-group-item" data-role="task">
                                    <a class="text-danger" href="<?php echo base_url().'ticket/'?>"> <b><?php echo $row->ticketsubject;?></b></a><i><?php echo $row->created_at; ?></i>
                                </li>
                            <?php 
                            }
                        ?>  
			            </ul>
			        </div>
			    </div>
			</div>
    	</div>
    </div>
</div>
<!-- ends of contentwrap -->