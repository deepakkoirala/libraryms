<?php
require 'includes/login-check.php';
//include 'log.php';
$query = mysql_query("SELECT member_image from members_info");
while($photos = mysql_fetch_array($query)){
	//echo $photos['member_image'];
	unlink(site_url.'/source/images/members/'.$photos['member_image'].'');	
}
if(mysql_num_rows(mysql_query("select * from members_info"))>0)
{
	if(mysql_query("truncate members_info"))
	{	
		$_SESSION['flush'] = 'true';
		$action = "Flush_Members";
		$item = $_SESSION['email'];
		$desc = "Deleted All Members";
		logSystem($action,$item,$desc);
		logAdmin($action,$item,$desc);
		logStaff($action,$item,$desc);
		$_SESSION['msg'] = "All Members Deleted Successfully";
		 echo "<script> window.location =\"".site_url."/admin/index.php?page=core-manager\"; </script>";
	}
}else
{
	$_SESSION['msg'] = " No Members in the System !";
	 echo "<script> window.location =\"".site_url."/admin/index.php?page=core-manager\"; </script>";	
}
?>
