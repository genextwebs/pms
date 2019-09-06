 <!-- sidebar -->
            <nav class="navbar navbar-expand-lg navbar-light top-bar" id="stic-nav">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse2" class="btn btn-toggle float-right">
                        <i class="fa fa-bars"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    	<ul class="search-add">
						    <li class="">
						        <form role="search" class="app-search hidden-xs">
						            <input type="text" name="search_key" value=""  placeholder="Search..." class="form-control">
						            <a href="#" class="submit-search"><i class="fa fa-search"></i></a>
						        </form>
						    </li>
						    <li class="dropdown">
						        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
						            <span>Add</span> <i class="ti-plus"></i>
						        </a>
						        <ul class="dropdown-menu">
						            <li class="dropdown-item">
						                <a href="add-project.html"><span class=" m-0">Add Project</span></a>
						            </li>
						            <li class="dropdown-item">
						                <a href="add-task.html" ><span class=" m-0">Add Task</span></a>
						            </li>
						            <li class="dropdown-item">
						                <a href="add-client.html" class="active"><span class=" m-0">Add Client</span></a>
						            </li>
						            <li class="dropdown-item">
						                <a href="add-employee.html"><span class=" m-0">Add Employee</span></a>
						            </li>
						            <li class="dropdown-item">
						                <a href="add-payment.html"><span class=" m-0">Add Payment</span></a>
						            </li>
						            <li class="dropdown-item">
						                <a href="add-ticket.html"><span class=" m-0">Add Ticket</span> </a>
						            </li>
						        </ul>
						    </li>
						</ul>
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item"> 
                                <a class="btn btn-rounded btn-light timer-modal" href="#">Active Timers 
                                    <span class="label label-danger" id="activeCurrentTimerCount"> 0 </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#"><i class="fa fa-power-off"></i> Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- ends of sidebar -->
