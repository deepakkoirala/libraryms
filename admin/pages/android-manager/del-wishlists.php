<?php 
$id = $_GET['id'];
include 'log.php';

$query = "DELETE from wishlists_info where id = '$id'";
$res = mysql_fetch_array(mysql_query("SELECT * from wishlists_info where id = '$id'"));	
$result = mysql_query($query) or die(mysql_error());

if($result){

		$action = "Delete_Wishlist";
		$item = $res['title'];
		$desc = "Notification Sent:DATA=".getJSON($res);
		//logLogin($action,$item,$desc);
		logStaff($action,$item,$desc);			
		logAdmin($action,$item,$desc);	
		logSystem($action,$item,$desc);	
		
	   $_SESSION['msg'] = '<font color="red">Wishlist Deleted Successfully</font>';
       echo "<script> window.location =\"".site_url."/admin/index.php?page=android-manager\"; </script>";
}

else{
     $_SESSION['msg'] = 'Wishlist Delete Unsuccessfull';
       echo "<script> window.location =\"".site_url."/admin/index.php?page=android-manager\"; </script>";
}
?>