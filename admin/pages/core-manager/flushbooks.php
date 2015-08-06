<?php
require 'includes/login-check.php';
if(mysql_num_rows(mysql_query("select * from books_info"))>0){
if(mysql_query("truncate books_info")){
	
	$_SESSION['flush'] = 'true';
	$action = "Flush_Books";
	$item = $_SESSION['email'];
	$desc = "Deleted All Books";
	logSystem($action,$item,$desc);
	logAdmin($action,$item,$desc);
	logStaff($action,$item,$desc);
	$_SESSION['msg'] = "All Books Deleted Successfully";
	 echo "<script> window.location =\"".site_url."/admin/index.php?page=core-manager\"; </script>";	
}}else{$_SESSION['msg'] = "No Books in the System !";
	 echo "<script> window.location =\"".site_url."/admin/index.php?page=core-manager\"; </script>";	}

?>
