<?php
	require 'includes/login-check.php';

	include ('includes/header.php');
	include('includes/operations.php');

	$fname = mysql_real_escape_string($_POST['fname']);
	$lname = mysql_real_escape_string($_POST['lname']);
	$sex = mysql_real_escape_string($_POST['sex']);
	$email = mysql_real_escape_string($_POST['email']);
	$add1 = mysql_real_escape_string($_POST['add1']);
	$add2 = mysql_real_escape_string($_POST['add2']);
	$position = mysql_real_escape_string($_POST['position']);

	if($fname == "" or $lname == "" or $sex == "" or $email == "" or $add2 == "" or $add1 == "" or $position == "")
	{
		echo '<center><h3 class="alert alert-info">All Values not Filled</h3>';
		echo '<input type="button" name="goback" value ="Go Back" class ="btn btn-danger" onclick="Javascript:history.go(-1)"></center>';
		exit;
	}
	$update = mysql_query("UPDATE  `staffs_info` SET `fname` = '$fname',`lname` ='$lname',`sex` = '$sex',`email` ='$email',`temporary_address` = '$add1',`permanent_address` ='$add2',`position` = '$position' WHERE `staffs_info`.`email` = '$email'");
	if($update)
	{
		echo '<center><h3 class="alert alert-info">Staff : '.$fname .$lname.' updated Successfully !</h3>';
		echo '<input type="button" name="goback" value ="Go Back" class ="btn btn-danger" onclick="Javascript:history.go(-2)"></center>';
	}
	
?>