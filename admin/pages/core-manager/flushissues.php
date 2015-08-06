<?php
require 'includes/login-check.php';
//include 'log.php';
$an = mysql_query("SELECT accession_no from issued");
while($q1 = mysql_fetch_array($an)){
	$q2 = mysql_query("UPDATE books_info set flag = 1 where accession_no = '".$q1['accession_no']."'");
}
if($q2 and mysql_query("truncate issued")){
	
	$_SESSION['flush'] = 'true';
	$action = "Flush_Issues";
	$item = $_SESSION['email'];
	$desc = "Cleaned All Issued Items";
	logSystem($action,$item,$desc);
	logAdmin($action,$item,$desc);
	logStaff($action,$item,$desc);
	$_SESSION['msg'] = "All Issues Cleaned Successfully";
	 echo "<script> window.location =\"".site_url."/admin/index.php?page=core-manager\"; </script>";	
}

?>
