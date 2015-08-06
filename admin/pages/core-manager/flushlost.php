<?php
require 'includes/login-check.php';
//include 'log.php';
if(mysql_num_rows(mysql_query("select * from lostbooks"))>0){
if(mysql_query("truncate lostbooks")){
	
	$_SESSION['flush'] = 'true';
	$action = "Flush_Lost";
	$item = $_SESSION['email'];
	$desc = "Deleted All Lost Books Entries";
	logSystem($action,$item,$desc);
	logAdmin($action,$item,$desc);
	logStaff($action,$item,$desc);
	$_SESSION['msg'] = "All Lost Books Deleted Successfully";
	 echo "<script> window.location =\"".site_url."/admin/index.php?page=core-manager\"; </script>";	
}
}else{
	$_SESSION['msg'] = "There are no Entries for Lost Book Yet !";
	 echo "<script> window.location =\"".site_url."/admin/index.php?page=core-manager\"; </script>";	
	
	}
?>
