<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="icon" href="favicon.ico" type="image/icon" sizes="16x16">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<title> Sim Solutions CBT</title>
<link  rel="stylesheet" href="css/bootstrap.min.css"/>
 <link  rel="stylesheet" href="css/bootstrap-theme.min.css"/>    
 <link rel="stylesheet" href="css/main.css">
 <link  rel="stylesheet" href="css/font.css">
 <script src="js/jquery.js" type="text/javascript"></script>

  <script src="js/bootstrap.min.js"  type="text/javascript"></script>
  <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
  <style>
    .card{
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
      -webkit-transition: 0.3; 
      -moz-transition: 0.3; 
      transition: 0.3;
    
    }
  </style>
<script>
$(function () {
    $(document).on( 'scroll', function(){
        console.log('scroll top : ' + $(window).scrollTop());
        if($(window).scrollTop()>=$(".logo").height())
        {
             $(".navbar").addClass("navbar-fixed-top");
        }

        if($(window).scrollTop()<$(".logo").height())
        {
             $(".navbar").removeClass("navbar-fixed-top");
        }
    });
});</script>
</head>

<body  style="background:#eee;">
<div class="header">
<div class="row">
<div class="col-lg-6">
<span class="logo">BLOSSOM FOUNT SCHOOLS</span></div>
<?php
include_once 'dbConnection.php';
error_reporting(0);
session_start();
if (!(isset($_SESSION['username']))  || ($_SESSION['key']) != '65585c506829293a2d4c3b68543b316e2e7a2d277858545a36362e5f39') {
    session_destroy();
    header("location:index.php");
} else {
    $name     = $_SESSION['name'];
    $username = $_SESSION['username'];
    
    include_once 'dbConnection.php';
    echo '<span class="pull-right top title1" ><span style="color:white"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;Hello,</span> <span class="log log1" style="color:lightyellow">' . $name . '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="logout.php?q=account.php" style="color:lightyellow"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;Logout</button></a></span>';
}
?>

</div></div>
<nav class="navbar navbar-default title1">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="dashboard_teacher.php?q=0"><b>Dashboard</b></a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li <?php
if (@$_GET['q'] == 0)
    echo 'class="active"';
?>><a href="dashboard_teacher.php?q=0">Home<span class="sr-only">(current)</span></a></li>
     <!-- Best added this for teachers-->
 <li class="dropdown <?php if(@$_GET['q']==1 || @$_GET['q']==2) echo'active"'; ?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Notes<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="dashboard_teacher.php?q=1">Create Note</a></li>
            <li><a href="dashboard_teacher.php?q=2">View/Remove Note</a></li>
            
          </ul>
        </li>
 <!-- ends here-->

      </ul>
          </div>
  </div>
</nav>
<div class="container">
<div class="row">
<div class="col-md-12">
<?php
    if (@$_GET['q'] == 0){
         require_once 'teacher_course.php';
    }
     if (@$_GET['q'] == 1){
         require_once 'create_note.php';
    }
     if (@$_GET['q'] == 2 && !isset($_GET['n'])){
         require_once 'teacher_view_note.php';
    }
     if (@$_GET['q'] == 2 && isset($_GET['n'])){
        //
        //echo 'im with you';
    $id = $_GET['n'];
    require_once 'note.php';
    
    }
?>

</div>
</div></div>
</body>
</html>
