<?php 		
        $email = $_GET['user'];
		include 'log.php';
		
        $staff = mysql_fetch_array(mysql_query("SELECT * from staffs_info where email = '$user'"));
		$oldimage = $staff['staff_image'];
		copy(site_url."/source/images/staffs/".$oldimage."",site_url."/source/images/staffs/garbage/".$oldimage."");		
		$res = mysql_fetch_array(mysql_query("SELECT * from staffs_info where email = '$email'"));
		
		$delete = mysql_query("DELETE from staffs_info where email ='$email'");
		if($delete)
		{	
			$action = "Delete_Staff";
			$item = $_SESSION['email'];
			$desc = "DATA=".getJSON($res);
			//logLogin($action,$item,$desc);
			logStaff($action,$item,$desc);			
			logAdmin($action,$item,$desc);
			logSystem($action,$item,$desc);							
			unlink(site_url."/source/images/staffs/".$oldimage."");		
        	$_SESSION['msg'] = 'User Deleted Successfully';
		    echo "<script> window.location =\"".site_url."/admin/index.php?page=staff-manager\"; </script>";
		}
		else
		{
	         unlink(site_url."/source/images/staffs/garbage/".$oldimage."");
			 $_SESSION['msg'] = 'User Delete Unsuccessfull';
	           echo "<script> window.location =\"".site_url."/admin/index.php?page=staff-manager\"; </script>";
		}
	
?>