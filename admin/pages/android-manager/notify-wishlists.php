<?php 
$id = $_GET['id'];
include 'log.php';

$query = "UPDATE wishlists_info set availability = 1 where id = $id";
$result = mysql_query($query) or die(mysql_error());

if($result){
		$res = mysql_fetch_array(mysql_query("SELECT * from wishlists_info where id = '$id'"));	
		$action = "Send_Notify";
		$item = $res['title'];
		$desc = "Notification Sent:DATA=".getJSON($res);
		logStaff($action,$item,$desc);			
		logAdmin($action,$item,$desc);
		logSystem($action,$item,$desc);	
	
	    $_SESSION['msg'] = 'Success : <font color="brown">Notification Pushed to the Device</font>';
        header('Location:'.site_url.'/admin/index.php?page=android-manager');
echo "<script> window.location =\"".site_url."/admin/index.php?page=android-manager\"; </script>";
}

else{
    	$_SESSION['msg'] = 'Error :  <font color="pink">Notification could not be Pushed at the Mement. Try Later!</font>';
        echo "<script> window.location =\"".site_url."/admin/index.php?page=android-manager\"; </script>";
}
?>