<!doctype html>
<html lang="en">
    
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Udemy :: Learn</title>
	<link href="<?=base_url()?>public/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?=base_url()?>public/css/bootstrap-responsive.css" rel="stylesheet" />
        <link href="<?=base_url()?>public/css/style.css" rel="stylesheet" />
        <script src="<?=base_url()?>public/js/jquery.js"></script>
	<script src="<?=base_url()?>public/js/bootstrap.min.js"></script>
	<link rel="shortcut icon" href="<?php echo base_url();?>public/ico/favicon.png">
</head>
<body>
<header>
<nav class="navbar">
	<div class="navbar-inner">
	<span class="brand">Udemy - Learn - CI</span>
		<ul class="nav">
			<li><a href="#"><i class="icon-home"></i> Dashoard</a></li>
			<li><a href="#"><i class="icon-user"></i> User</a></li>
			<li><a href="#"><i class="icon-info-sign"></i> Issues</a></li>
			<li><a href="#"><i class="icon-adjust"></i> Profile</a></li>
			<li><a href="<?=site_url('dashboard/logout')?>"><i class="icon-remove-circle"></i> Logout</a></li>
		</ul>
		<div class="btn-group">
  <a class="btn btn-warning dropdown-toggle" data-toggle="dropdown" href="#">
    Action
    <span class="caret"></span>
  </a>
  <ul class="dropdown-menu">
    	<li><a href="#"><i class="icon-home"></i> Dashoard</a></li>
			<li><a href="#"><i class="icon-user"></i> User</a></li>
			<li><a href="#"><i class="icon-info-sign"></i> Issues</a></li>
  </ul>
</div>
	</div>
	
</nav>
</header>
<div class="wrapper">
<!-- Start: Wrapper -->