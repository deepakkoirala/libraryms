<?php 
//error_reporting(0);
include 'log.php';
session_start();

	$action = "Logout_Admin";
	$item = $_SESSION['email'];
	$desc = "Admin:".$_SESSION['fname'].' '.$_SESSION['lname']." Logged out Successfully ";
	logLogin($action,$item,$desc);
	logStaff($action,$item,$desc);
	logSystem($action,$item,$desc);				
	logAdmin($action,$item,$desc);
	
session_destroy();
unset($_SESSION['fname']);
unset($_SESSION['email']);
header('Location:'.site_url.'/admin/login_form.php');