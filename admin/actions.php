<?php
	include('includes/login-check.php');
	include 'log.php';
//fine-lost
	if(isset($_POST['finelost']))
	{
    $id = $_GET['id'];
   
    foreach($_POST as $key=>$val)
    {
        $$key = $val;
    }
	date_default_timezone_set("Asia/Kolkata"); 
	$time = date('l, jS F Y, h:i:s A',time()+900);
	
    $update_lostbook = "update lostbooks set action = 'Fined', fine_amount = '$fine' where id = '$id'";
	//$update_issued =  "delete from issued where accession_no = (Select book from lostbooks where id = '$id')";


    if(mysql_query($update_lostbook))
    {
		$res = mysql_fetch_array(mysql_query("SELECT book,member,action,fine_amount from lostbooks where id = '$id'"));

		$action = "Fined_Lost";
		$item = $res['member']."_".$res['book'];
		$desc = "Fine Charged:Transaction ID = $id with data DATA=".getJSON($res);
		//logLogin($action,$item,$desc);
		logStaff($action,$item,$desc);			
		logAdmin($action,$item,$desc);
		logSystem($action,$item,$desc);	
		
        $_SESSION['msg'] = 'Operation Successful';
        header('Location:'.site_url.'/admin/index.php?page=lostfine-manager');
    }
    else
    {
        $_SESSION['msg'] = 'Oops! Something is not Right. Try Later !';
        header('Location:'.site_url.'/admin/index.php?page=lostfine-manager');
    }
    
}
	
	
//department add area
if(isset($_POST['adddepartment']))
	{
    
    foreach($_POST as $key=>$val)
    {
        $$key = $val;
    }
	
    $query = "insert into constants set department = '$txtdepartment',numbooks = '$txtnumbooks'";
    $result = mysql_query($query) or die(mysql_error());
    if($result)
    {
		$res = mysql_fetch_array(mysql_query("SELECT * from constants where department = '$txtdepartment'"));
		$action = "Add_Dept";
		$item = "$txtdepartment";
		$desc = "Department: $txtdepartment added Successfully.DATA=".getJSON($res);
		//logLogin($action,$item,$desc);
		logStaff($action,$item,$desc);			
		logAdmin($action,$item,$desc);
		logSystem($action,$item,$desc);		
			
        $_SESSION['msg'] = 'Department Added Successfully';
        header('Location:'.site_url.'/admin/index.php?page=libcons-manager');
    }
    else
    {
        $_SESSION['msg'] = 'Department adding unsuccessfull';
        header('Location:'.site_url.'/admin/index.php?page=libcons-manager');
    }    
}
// new staff add area	
	
	if(isset($_POST['addstaff']))
	{    
    foreach($_POST as $key=>$val)
    {
        $$key = $val;
    }
	date_default_timezone_set("Asia/Kolkata"); 
	$time = date('l, jS F Y, h:i:s A',time()+900);
    $query = "insert into staffs_info set fname = '$fname',lname = '$lname', email = '$email',phone = '$phone', password = '$password', 
	sex = '$sex',temporary_address = '$add1',permanent_address = '$add2', position = '$position',date_joined = '$time'";
    $result = mysql_query($query) or die(mysql_error());
    if($result)
    {
		$res = mysql_fetch_array(mysql_query("SELECT * from staffs_info where email = '$email'"));		
		$action = "Add_Staff";
		$item = "$email";
		$desc = "Staff: $fname $lname added Successfully.DATA=".getJSON($res);
		//logLogin($action,$item,$desc);
		logStaff($action,$item,$desc);			
		logAdmin($action,$item,$desc);
		logSystem($action,$item,$desc);				
        $_SESSION['msg'] = 'User Added Successfully';
        header('Location:'.site_url.'/admin/index.php?page=staff-manager');
    }
    else
    {
        $_SESSION['msg'] = 'User adding unsuccessfull';
        header('Location:'.site_url.'/admin/index.php?page=staff-manager');
    }    
	}
	
	//department edit area 
	if(isset($_POST['editdepartment']))
	{
    $id = $_GET['depid'];
   
    foreach($_POST as $key=>$val)
    {
        $$key = $val;
    }
	date_default_timezone_set("Asia/Kolkata"); 
	$time = date('l, jS F Y, h:i:s A',time()+900);
    $query = "update constants set  department = '$txtdepartment',numbooks = '$txtnumbooks' where depid = '$id'";
	$updatemembers = mysql_query("UPDATE members_info set department = '$txtdepartment' where department = (SELECT department from constants where depid = '$id')");
    $result = mysql_query($query) or die(mysql_error());
    if($result)
    {
		$res = mysql_fetch_array(mysql_query("SELECT * from constants where depid = '$id'"));
		$action = "Edit_Dept";
		$item = $res['department'];
		$desc = "Department: $txtdepartment edited Successfully.DATA=".getJSON($res);
		//logLogin($action,$item,$desc);
		logStaff($action,$item,$desc);			
		logAdmin($action,$item,$desc);
		logSystem($action,$item,$desc);		
		
        $_SESSION['msg'] = 'Department Updated Successfully';
        header('Location:'.site_url.'/admin/index.php?page=libcons-manager');
    }
    else
    {
        $_SESSION['msg'] = 'Department Update Unsuccessfull';
        header('Location:'.site_url.'/admin/index.php?page=libcons-manager');
    }
    
}
//edit staff	
	if(isset($_POST['editstaff']))
	{
    $id = $_GET['user'];
   
    foreach($_POST as $key=>$val)
    {
        $$key = $val;
    }
	date_default_timezone_set("Asia/Kolkata"); 
	$time = date('l, jS F Y, h:i:s A',time()+900);
    $query = "update staffs_info set  fname = '$fname',lname = '$lname', email = '$email',phone = '$phone', password = '$password', 
	sex = '$sex',temporary_address = '$add1',permanent_address = '$add2', position = '$position',date_joined = '$time' where email = '$id'";
    $result = mysql_query($query) or die(mysql_error());
    if($result)
    {
		$res = mysql_fetch_array(mysql_query("SELECT * from staffs_info where email = '$id'"));	
		$action = "Edit_Staff";
		$item = "$id";
		$desc = "Staff: $fname $lname edited Successfully.DATA=".getJSON($res);
		//logLogin($action,$item,$desc);
		logStaff($action,$item,$desc);			
		logAdmin($action,$item,$desc);
		logSystem($action,$item,$desc);
				
        $_SESSION['msg'] = 'User Updated Successfully';
        header('Location:'.site_url.'/admin/index.php?page=staff-manager');
    }
    else
    {
        $_SESSION['msg'] = 'User Update Unsuccessfull';
        header('Location:'.site_url.'/admin/index.php?page=staff-manager');
    }
    
}
?>