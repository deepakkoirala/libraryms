<?php
require 'includes/login-check.php';
//include 'log.php';
if(mysql_num_rows(mysql_query("select * from wishlists_info"))>0){
if(mysql_query("truncate logs")){
	
	$_SESSION['flush'] = 'true';
	$action = "Flush_Wishlists";
	$item = $_SESSION['email'];
	$desc = "Cleaned All Android Wishlists";
	logSystem($action,$item,$desc);
	logAdmin($action,$item,$desc);
	logStaff($action,$item,$desc);
	$_SESSION['msg'] = "All Android Requests Flushed Successfully";
	 echo "<script> window.location =\"".site_url."/admin/index.php?page=core-manager\"; </script>";	
}}else{$_SESSION['msg'] = "There are no Requests Submitted Yet !";
	 echo "<script> window.location =\"".site_url."/admin/index.php?page=core-manager\"; </script>";	}

?>
