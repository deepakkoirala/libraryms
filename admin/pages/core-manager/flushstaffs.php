<?php
require 'includes/login-check.php';

if(mysql_query("delete from staffs_info where email not in('".$_SESSION['email']."')")){
	
	$_SESSION['flush'] = 'true';
	$action = "Flush_Staffs";
	$item = $_SESSION['email'];
	$desc = "Deleted All Other Staffs";
	logSystem($action,$item,$desc);
	logAdmin($action,$item,$desc);
	logStaff($action,$item,$desc);
	$_SESSION['msg'] = "All Staffs Removed Successfully";
	 echo "<script> window.location =\"".site_url."/admin/index.php?page=core-manager\"; </script>";	
}

?>
