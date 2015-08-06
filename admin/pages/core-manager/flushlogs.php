<?php
require 'includes/login-check.php';
//include 'log.php';

if(mysql_query("truncate logs")){
	
	$_SESSION['flush'] = 'true';
	$action = "Flush_Logs";
	$item = $_SESSION['email'];
	$desc = "Cleaned All Logs";
	logSystem($action,$item,$desc);
	logAdmin($action,$item,$desc);
	logStaff($action,$item,$desc);
	$_SESSION['msg'] = "All Logs Cleaned Successfully";
	 echo "<script> window.location =\"".site_url."/admin/index.php?page=core-manager\"; </script>";	
}

?>
