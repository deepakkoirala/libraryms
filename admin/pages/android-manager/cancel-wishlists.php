<?php 
$id = $_GET['id'];
include 'log.php';
$query = "UPDATE wishlists_info set availability = 0 where id = $id";
$res = mysql_fetch_array(mysql_query("SELECT * from wishlists_info where id = '$id'"));	
$result = mysql_query($query) or die(mysql_error());

if($result){
	$action = "Cancel_Notify";
		$item = $res['title'];
		$desc = "Notification Cancelled:DATA=".getJSON($res);
		//logLogin($action,$item,$desc);
		logStaff($action,$item,$desc);			
		logAdmin($action,$item,$desc);	
		logSystem($action,$item,$desc);	
	    $_SESSION['msg'] = 'Success : <font color="brown">Notification Cancelled to the Device</font>';
        echo "<script> window.location =\"".site_url."/admin/index.php?page=android-manager\"; </script>";
}
else{
    	$_SESSION['msg'] = 'Error :  <font color="pink">Could not Complete at the Moment. Try Later!</font>';
       echo "<script> window.location =\"".site_url."/admin/index.php?page=android-manager\"; </script>";
}
?>