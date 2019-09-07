<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,900|Roboto:300,300i,400,400i,500,500i,700,700i,900&display=swap" rel="stylesheet"> 

	<title>Project Menagement - Leads</title>

	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/fixedHeader.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/themify-icons.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ie7.css">

    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/sidebar.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/validate-error.css">
</head>
<body>
	<div class="wrapper">
	 <nav id="sidebar">
            <div class="sidebar-header">
                <h3 class="text-left logo-left"><img class="img-fluid img-logo" src="<?php echo base_url();?>assets/images/logo.png" alt="pecific school of engineering"></h3>
                <strong><img class="img-fluid" src="<?php echo base_url();?>assets/images/small-logo.png" alt="pecific school of engineering"></strong>
            </div>
            <div class="admin-panel">Admin Panel</div>
            <?php $this->load->view('common/sidebar'); ?>
        </nav>
        <!-- Page Content  -->
		 
		<div id="content" class="content">
		<?php $this->load->view('common/topheader'); ?>