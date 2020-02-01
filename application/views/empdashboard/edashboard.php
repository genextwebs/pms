<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="icon-speedometer"></i> Dashboard</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Dashboard</li>
                <li><!-- <a href="javascript:;">Start Timer <i class="fa fa-check-circle text-success"></i> --></a>

                 <a href="javascript:;" id="holiday" data-toggle="modal" data-target="#data-holiday1"><b>Start Timer</b><i class="fa fa-plus" aria-hidden="true"></i></a></li> 
            </ol>
        </div>
    </div>
</nav>

<!-- contetn-wrap -->
<div  class="row">
<div id=n1 style="z-index: 2; position: relative; right: 0px; top: 10px; background-color: #00cc33;
 width: 100px; padding: 10px; color: white; font-size:20px; border: #0000cc 2px dashed; "> </div>
 <div><input type="button" name="btn" id='btn' value="Start" onclick="to_start()"; class="btn btn-success"></div>
</div>

<div class="content-in">  
    <div class="row db-stats">
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
                            <span class="widget-title"> Total Projects</span><br>
                            <span class="counter"><?php if(!empty($totalProject)) { echo $totalProject; } ?></span>
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
                            <span class="widget-title"> Pending Tasks</span><br>
                            <span class="counter">15</span>
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
                            <span class="counter">13</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        
    </div>
    <div class="row">
        <!-- <div class="col-md-6">
            <div class="row">
                
              
              
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
                
            </div>
        </div> -->
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="stats-box">
                        <h3 class="box-title mb-0">Recent Earnings</h3>
                        <div id="myfirstchart" style="height: 205px;"></div>
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
                            <li class="list-group-item" data-role="task">
                                1. <a class="text-danger" href="#"> Gryphon. '--you advance twice--' 'Each with a deep voice, 'are done.</a> <i>2 Months Ago</i>
                            </li>
                            <li class="list-group-item" data-role="task">
                                2. <a class="text-danger" href="#"> However, when they hit her; and the executioner went off like an.</a> <i>4 Days From Now</i>
                            </li>
                            <li class="list-group-item" data-role="task">
                                3. <a class="text-danger" href="#"> WHAT?' said the Gryphon, half to itself, 'Oh dear! Oh dear! I'd.</a> <i>6 Months Ago</i>
                            </li>
                            <li class="list-group-item" data-role="task">
                                4. <a class="text-danger" href="#"> Alice was not quite know what a dear quiet thing,' Alice went on.</a> <i>11 Months Ago</i>
                            </li>
                            <li class="list-group-item" data-role="task">
                                5. <a class="text-danger" href="#"> Mouse, frowning, but very politely: 'Did you say things are worse.</a> <i>1 Day From Now</i>
                            </li>
                            <li class="list-group-item" data-role="task">
                                6. <a class="text-danger" href="#"> And the muscular strength, which it gave to my right size: the next.</a> <i>2 Days From Now</i>
                            </li>
                            <li class="list-group-item" data-role="task">
                                7. <a class="text-danger" href="#"> At last the Mouse, who was peeping anxiously into its eyes were.</a> <i>4 Days From Now</i>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
</div>
<!-- ends of contentwrap -->


<div id="data-holiday1" class="modal fade defaultholiday" id="data-defaultholiday" tabindex="-1" role="dialog" aria-labelledby="holiday" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content br-0">
                        <div class="modal-header">
                            <h4 class="modal-title"><i class=" ti-plus"></i>Start Timer</h4>
                            <button type="button" class="closedata" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="modeldefaultholiday" class="" name="modeldefaultholiday" method="post">
                                <div class="form-body">
                                <div id="dynamic">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                               <h4>select Project</h4>
                                               <select class="select2 form-control" id="clientname">
                                        <option value="">Select</option>
                                        <?php
                                            foreach($projectDetail as $row)
                                            {
                                                if(!empty($row->projectname)){
                                                    echo '<option value="'.$row->id.'" >'.$row->projectname.'</option>';
                                                }
                                            }
                                        ?>
                                    </select>   
                                            </div>
                                        </div>
                                        <div class="col-md-12">  
                                            <div class="form-group">
                                                <label>Memo</label>
                                                <input type="text" name="memo">
                                            </div>
                                        </div>
                                        <div><input type="button" name="btn" id='btn' value="Start" onclick="to_start()"; class="btn btn-success"></div>
                                    </div>

                                </div>
                               
                                </div>
                                
                                <!-- a -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>