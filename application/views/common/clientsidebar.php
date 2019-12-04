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
                 <li>
                    <a href="#"><i class="ti-user"></i> <span>Profile Settings</span></a>
                </li> 
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
        <li <?php if($controller == 'project' && ($functionName == 'project' || $functionName == '')) { echo 'class="active"'; } ?>>
            <a href="<?php echo base_url().'project'?>" class="nav-link-s">
                <i class="icon-layers"></i>
                <span>Projects</span>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url().'products'?>" class="nav-link-s">
                <i class="icon-basket"></i>
                <span>Products</span>
            </a>
        </li>
           <li>
            <a href="#" class="nav-link-s">
                <i class="ti-ticket"></i>
                <span>Tickets</span>
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
                    <a href="#">Invoices</a>
                </li>
               
            </ul>
        </li>
      
     	<li>
            <a href="#" class="nav-link-s">
                <i class="icon-calender"></i>
                <span>Events</span>
            </a>
        </li>
      
       
    </ul>
</div>