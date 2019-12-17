<?php
$loginName="";
if($this->session->userdata('login')){
    $login=$this->session->userdata('login');
    if($login->user_type==0){
        $loginName = substr($login->emailid,0,8);
    }else if($login->user_type == 1){
        $where = array('user_id'=>$login->id);
        $getClient = $this->common_model->getData('tbl_clients',$where);
        $loginName = trim($getClient[0]->companyname);
    }
}
?>
<div id="sidebar-scroll" class="slim-nav">
	<ul class="list-unstyled components user">
        <li>
            <a href="#user-ico" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">
                <img class="img-circle" src="<?php echo base_url();?>assets/images/default-profile-3.png" alt="user-img">
                <span><?php echo !empty($loginName)?$loginName:'User';?></span>
            </a>
            <ul class="collapse list-unstyled" id="user-ico">
                <!-- <li>
                    <a href="#"><i class="fas fa-sign-in-alt"></i> <span>Login As Employee</span></a>
                </li> -->
                <li>
                    <a href="<?php echo base_url().'Login/logout'; ?>"><i class="fa fa-power-off"></i> <span>Logout</span></a>
                </li>
            </ul>
        </li>
    </ul>
    <?php
    $controller = strtolower($this->uri->segment(1));
    $functionName = strtolower($this->uri->segment(2));
    ?>
    <ul class="list-unstyled components">
        <li>
            <a href="<?php echo base_url().'Dashboard'; ?>" class="nav-link-s">
                <i class="icon-speedometer"></i>
                <span>Dashbord</span>
            </a>
        </li>
        <li <?php if($controller == 'clients' && ($functionName == 'index' || $functionName == '')) { echo 'class="active"'; } ?>>
            <a href="<?php echo base_url().'clients'?>" class="nav-link-s">
                <i class="icon-people"></i>
                <span>Clients</span>
            </a>
        </li>
        <li <?php if($controller == 'leads' && ($functionName == 'index' || $functionName == '')) { echo 'class="active"'; } ?>>
            <a href="<?php echo base_url().'leads'?>" class="nav-link-s">
                <i class="ti-receipt"></i>
                <span>Leads</span>
            </a>
        </li>
        <li <?php if($controller == 'project' && ($functionName == 'project' || $functionName == '')) { echo 'class="active"'; } ?>>
            <a href="<?php echo base_url().'project'?>" class="nav-link-s">
                <i class="icon-layers"></i>
                <span>Projects</span>
            </a>
        </li>
        <li>
            <a href="#taskmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">
                <i class="ti-layout-list-thumb"></i>
                <span>Tasks</span>
            </a>
            <ul class="collapse list-unstyled" id="taskmenu">
                <li>
                    <a href="#">Tasks</a>
                </li>
                <li>
                    <a href="#">Task Board</a>
                </li>
                <li>
                    <a href="#">Task Calendar</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="<?php echo base_url().'products'?>" class="nav-link-s">
                <i class="icon-basket"></i>
                <span>Products</span>
            </a>
        </li>
        <li>
            <a href="#finance" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">
                <i class="fa fa-money"></i>
                <span>Finance</span>
            </a>
            <ul class="collapse list-unstyled" id="finance">
                <li>
                    <a href="<?php echo base_url().'finance' ?>">Estimates</a>
                </li>
                <li>
                    <a href="<?php echo base_url().'finance/invoice' ?>">Invoices</a>
                </li>
                <li>
                    <a href="#">Payments</a>
                </li>
                <li>
                    <a href="<?php echo base_url().'finance/expense' ?>">Expenses</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#" class="nav-link-s">
                <i class="icon-clock"></i>
                <span>Time Logs</span>
            </a>
        </li>
        <li>
            <a href="#" class="nav-link-s">
                <i class="ti-ticket"></i>
                <span>Tickets</span>
            </a>
        </li>
        <li>
            <a href="#employees" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">
               <i class="ti-user"></i>
               <span> Employees </span>
            </a>
            <ul class="collapse list-unstyled" id="employees">
                <li>
                    <a href="<?php echo base_url().'employee'?>">Employees List</a>
                </li>
                <li>
                    <a href="#">Teams</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="<?php echo base_url().'Attendance'?>" class="nav-link-s">
                <i class="icon-clock"></i>
                <span>Attendance</span>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url().'holiday'?>" class="nav-link-s">
                <i class="ti-calendar"></i>
                <span>Holiday</span>
            </a>
        </li>
        <li>
            <a href="#" class="nav-link-s">
                <i class="ti-envelope"></i>
                <span>Messages</span>
            </a>
        </li>
        <li>
            <a href="#" class="nav-link-s">
                <i class="icon-calender"></i>
                <span>Events</span>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url().'Leaves'?>" class="nav-link-s">
                <i class="icon-logout"></i>
                <span>Leaves</span>
            </a>
        </li>
        <li>
            <a href="#" class="nav-link-s">
                <i class="ti-layout-media-overlay"></i>
                <span>Notice Board</span>
            </a>
        </li>
        <li>
            <a href="#reports" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">
               <i class="ti-pie-chart"></i>
               <span> Reports </span>
            </a>
            <ul class="collapse list-unstyled" id="reports">
                <li>
                    <a href="#">Task Report</a>
                </li>
                <li>
                    <a href="#">Time Log Report</a>
                </li>
                <li>
                	<a href="#">Finance Report</a>
                </li>
                <li>
                	<a href="#">Income vs Expense Report</a>
                </li>
                <li>
                	<a href="#">Leave Report</a>
                </li>
            </ul>
        </li>
        <li>
        	<a href="#" class="nav-link-s">
        		<i class="ti-settings"></i> 
        		<span> Settings</span>
        	</a>
    	</li>
    </ul>
</div>