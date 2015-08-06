<?php 
$id = $_GET['id'];
include 'log.php';

$query = "DELETE from constants where depid = '$id'";
$res = mysql_fetch_array(mysql_query("SELECT * from constants where depid = '$id'"));
$result = mysql_query($query) or die(mysql_error());

if($result){

		$action = "Delete_Dpt";
		$item = $res['department'];
		$desc = "Department: Deleted Successfully.DATA=".getJSON($res);
		//logLogin($action,$item,$desc);
		logStaff($action,$item,$desc);			
		logAdmin($action,$item,$desc);
		logSystem($action,$item,$desc);	
		
	   $_SESSION['msg'] = '<font color="red">Department Deleted Successfully</font>';
       echo "<script> window.location =\"".site_url."/admin/index.php?page=libcons-manager\"; </script>";
}

else{
     $_SESSION['msgDptDel'] = 'Department Delete Unsuccessfull';
       echo "<script> window.location =\"".site_url."/admin/index.php?page=libcons-manager\"; </script>";
}
?>