<?php
include 'log.php';
session_start();
if(isset($_POST['btn_logout']))
{
	$action = "Logout";
	$item = $_SESSION['email'];
	$desc = "Staff:".$_SESSION['fname'].' '.$_SESSION['lname']." Logged out Successfully ";
	logLogin($action,$item,$desc);
	logStaff($action,$item,$desc);
	logSystem($action,$item,$desc);	
	if(checkAdmin1()){

		logAdmin($action,$item,$desc);
	}
	session_destroy();
	unset ($_SESSION['fname']);
	unset ($_SESSION['lname']);
	unset ($_SESSION['email']);

	header('Location:'.site_url.'/login.php');
} 
if(isset($_POST['btn_home']))
{
	header('Location:'.site_url);
}
header('Location:'.site_url);

?>