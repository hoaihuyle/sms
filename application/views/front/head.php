<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Trường Đại Học Kinh Tế- Huế HCE</title>
    <!-- bootstrap css -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
  <!-- boostrap theme -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap-theme.min.css') ?>">
  <!-- datatables css -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/datatables/media/css/jquery.dataTables.min.css') ?>">
  <!-- fileinput css -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/fileinput/css/fileinput.min.css') ?>">
  <!-- fullcalendar css -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/fullcalendar/fullcalendar.min.css') ?>">  
  <!-- keith calendar css -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/keith-calendar/jquery.calendars.picker.css') ?>"> 

  <!-- custom css -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('custom/css/custom.css') ?>"> 
  <link rel="stylesheet" href="<?php echo base_url('assets/media/schedule.css') ?>">

  <!-- jquery -->
  <script type="text/javascript" src="<?php echo base_url('assets/jquery/jquery.min.js') ?>"></script>

</head>

<body>

<input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
<nav class="navbar navbar-default navbar-static-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Chuyển đổi điều hướng</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo base_url('home?atd=report') ?>">Hệ thống quản lý trường học</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav">
      <li class="dropdown" id="topTimelineNav">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-time"></i> Lịch cá nhân <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li id="takeTimelineNav"><a href="<?php echo base_url('home?atd=add') ?>">Đăng kí lịch học</a></li>
          <li id="timelineReport"><a href="<?php echo base_url('home?atd=report') ?>">
            Xem lịch học</a>
          </li>
        </ul>
      </li>       
		</ul>      
      <ul class="nav navbar-nav navbar-right">        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-user"></i> <span class="caret"></span></a>
          <ul class="dropdown-menu">            
            <li><a href="<?php echo base_url('setting') ?>">Cài đặt</a></li>                       
            <li><a href="<?php echo base_url('users/logout'); ?>">Đăng xuất</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>