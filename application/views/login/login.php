<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,900|Roboto:300,300i,400,400i,500,500i,700,700i,900&display=swap" rel="stylesheet"> 

	<title>Project Menagement - Login</title>

	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/themify-icons.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ie7.css">

    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/sidebar.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">

</head>
<body>

	<div id="login-wrapp" class="login-block">
		<div class="login-wrapp">
			<a class="logo" href="javascript:void(0);" style="padding: 25px 0px;">
				<img class="img-fluid" src="<?php echo base_url();?>assets/images/logo.png" alt="home" style="max-width: 280px;">
			</a>
			<div class="stats-box">
				<form id="loginform" method="post" class="form-material" action="<?php echo base_url().'login/checklogin'?>"> 
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<input type="email" id="email" class="form-control" name="email" placeholder="Email">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<input type="password" name="password" id="password" class="form-control" placeholder="password">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<div class="custom-control custom-checkbox my-1 mr-sm-2 float-left">
								    <input type="checkbox" class="custom-control-input" name="remember_me" id="remember_me">
								    <label class="custom-control-label" for="remember_me" style="padding-top: 2px;">Remember Me</label>
								</div>
								<a class="float-right forgot-link text-light-black" href="#"><i class="fa fa-lock m-r-5"></i> Forgot password?</a>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<input type="submit" name="btnlogin" class="btn btn-info btn-lg btn-block rounded-4" value="Log In">
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

    <script src="<?php echo base_url();?>assets/js/jquery-3.2.1.slim.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
	
    <script src="<?php echo base_url();?>assets/js/bootstrap.js"></script>
    <!-- sidebar -->
</body>
</html>







