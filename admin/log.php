<?php
error_reporting(0);
include 'includes/constants.php';
include 'includes/database.php';
//************************************************************************************************************************************************

function checkAdmin1()
{				
	$email = $_SESSION['email'];
	$check = mysql_fetch_array(mysql_query("SELECT position from staffs_info where email = '$email'"));
	$position = $check['position'];			
	if($position == 'Head Librarian' or $position == 'Admin')					
	{
		return true;
	}
	return false;
}

function getJSON($res){
	$data = array();	
	array_push($data,$res);
	return json_encode($data);
}//end of getJSON
//************************************************************************************************************************************************

function logMember($libid,$action,$item,$desc){
	
	if($libid==''or$action==''or$item==''or$desc==''){		
		exit;
	}else{
		date_default_timezone_set("Asia/Kolkata"); 
		$time = date('l,jS F Y,h:i:s A',time()+900);
		$staff = $_SESSION['email'];	
		
		$now = date('l, jS F Y',time()+900);
		if($now!=date('l, jS F Y',time()+900)){
			
			$now = date('l, jS F Y',time()+900);
			$file = "$libid@".$now.".txt";		
			$createFile = fopen("source/logs/member/".$file, 'w');
		}
		$file = "source/logs/member/$libid@".$now.".txt";	
		if(file_exists($file)){	
			$new ="No";
			$createFile = fopen($file, 'a');	
		}else{			
			$createFile = fopen($file, 'w');	
		}		
		if(mysql_query("INSERT into logs set date_added = '$time',action = '$action',item = '$item',description = '$desc',staff = '$staff',file = '$file'")){
			$count = mysql_fetch_array(mysql_query("SELECT count(file) from logs where file = '$file'"));
			$sn = $count['count(file)']++;
			if($new == "No"){				
				fwrite($createFile,"$sn\t$time\t$action\t\t$item\t\t\t$staff\t\t$desc".PHP_EOL);
			}else{
				$intro = "Auto-Generated File: Do not Modify".PHP_EOL."@Copyright: Company Name".PHP_EOL;
				fwrite($createFile,$intro);
				fwrite($createFile,"--------------------------------------------------------------------------------------------------------------------------------------------------------------------".PHP_EOL);
				fwrite($createFile,"SN\t\t\tDate\t\t\tAction\t\t\tItem\t\t\t\tStaff\t\t\t\tDescription".PHP_EOL);
				fwrite($createFile,"--------------------------------------------------------------------------------------------------------------------------------------------------------------------".PHP_EOL);
				fwrite($createFile,"$sn\t$time\t$action\t\t$item\t\t\t$staff\t\t$desc".PHP_EOL);
			}			
		}
		fclose($createFile);			
	}	
}
//end of logMember()
	
function logStaff($action,$item,$desc){
	
	if($action==''or$item==''or$desc==''){		
		exit;
	}else{
		date_default_timezone_set("Asia/Kolkata"); 
		$time = date('l,jS F Y,h:i:s A',time()+900);
		$staff = $_SESSION['email'];	
		
		$now = date('l, jS F Y',time()+900);
		if($now!=date('l, jS F Y',time()+900)){
			
			$now = date('l, jS F Y',time()+900);
			$file = "$staff@".$now.".txt";		
			$createFile = fopen("source/logs/staff/".$file, 'w');
		}
		$file = "source/logs/staff/$staff@".$now.".txt";	
		if(file_exists($file)){	
			$new ="No";
			$createFile = fopen($file, 'a');	
		}else{			
			$createFile = fopen($file, 'w');	
		}		
		if(mysql_query("INSERT into logs set date_added = '$time',action = '$action',item = '$item',description = '$desc',staff = '$staff',file = '$file'")){
			$count = mysql_fetch_array(mysql_query("SELECT count(file) from logs where file = '$file'"));
			$sn = $count['count(file)']++;
			
			if($new == "No"){				
				fwrite($createFile,"$sn\t$time\t$action\t\t$item\t\t$desc".PHP_EOL);
			}else{
				$intro = "Auto-Generated File: Do not Modify".PHP_EOL."@Copyright: Company Name".PHP_EOL;
				fwrite($createFile,$intro);
				fwrite($createFile,"--------------------------------------------------------------------------------------------------------------------------------------------------------------------".PHP_EOL);
				fwrite($createFile,"SN\t\t\tDate\t\t\t\tAction\t\t\tItem\t\t\tDescription".PHP_EOL);
				fwrite($createFile,"--------------------------------------------------------------------------------------------------------------------------------------------------------------------".PHP_EOL);
				fwrite($createFile,"$sn\t$time\t$action\t\t$item\t\t$desc".PHP_EOL);
			}			
		}
		fclose($createFile);		
	}	
}
//end of logStaff()

	function logSystem($action,$item,$desc){
	
	if($action==''or$item==''or$desc==''){		
		exit;
	}else{
		date_default_timezone_set("Asia/Kolkata"); 
		$time = date('l,jS F Y,h:i:s A',time()+900);
		$staff = $_SESSION['email'];	
		
		$now = date('l, jS F Y',time()+900);
		if($now!=date('l, jS F Y',time()+900)){
			
			$now = date('l, jS F Y',time()+900);
			$file = "System@".$now.".txt";		

			$createFile = fopen("source/logs/system/".$file, 'w');
		}
		$file = "source/logs/system/System@".$now.".txt";	
		if(file_exists($file)){	
			$new ="No";
			$createFile = fopen($file, 'a');	
		}else{			
			$createFile = fopen($file, 'w');	
		}		
		if(mysql_query("INSERT into logs set date_added = '$time',action = '$action',item = '$item',description = '$desc',staff = '$staff',file = '$file'")){
			$count = mysql_fetch_array(mysql_query("SELECT count(file) from logs where file = '$file'"));
			$sn = $count['count(file)']++;
			
			if($new == "No"){				
				fwrite($createFile,"$sn\t$time\t$action\t\t$item\t\t$staff\t\t$desc".PHP_EOL);
			}else{
				$intro = "Auto-Generated File: Do not Modify".PHP_EOL."@Copyright: Company Name".PHP_EOL;
				fwrite($createFile,$intro);
				fwrite($createFile,"--------------------------------------------------------------------------------------------------------------------------------------------------------------------".PHP_EOL);
				fwrite($createFile,"SN\t\t\tDate\t\t\t\tAction\t\t\tItem\t\t\t\tStaff\t\t\t\tDescription".PHP_EOL);
				fwrite($createFile,"--------------------------------------------------------------------------------------------------------------------------------------------------------------------".PHP_EOL);
				fwrite($createFile,"$sn\t$time\t$action\t\t$item\t\t$staff\t\t$desc".PHP_EOL);
			}			
		}
		fclose($createFile);		
	}	
}
//end of logSystem()
function logLogin($action,$item,$desc){
	
	if($action==''or$item==''or$desc==''){		
		exit;
	}else{
		date_default_timezone_set("Asia/Kolkata"); 
		$time = date('l,jS F Y,h:i:s A',time()+900);
		$staff = $_SESSION['email'];	
		
		$now = date('l, jS F Y',time()+900);
		if($now!=date('l, jS F Y',time()+900)){
			
			$now = date('l, jS F Y',time()+900);
			$file = "Logins@".$now.".txt";		
			$createFile = fopen("source/logs/logins/".$file, 'w');
		}
		$file = "source/logs/logins/Logins@".$now.".txt";	
		if(file_exists($file)){	
			$new ="No";
			$createFile = fopen($file, 'a');	
		}else{			
			$createFile = fopen($file, 'w');	
		}		
		if(mysql_query("INSERT into logs set date_added = '$time',action = '$action',item = '$item',description = '$desc',staff = '$staff',file = '$file'")){
			$count = mysql_fetch_array(mysql_query("SELECT count(file) from logs where file = '$file'"));
			$sn = $count['count(file)']++;
			
			if($new == "No"){				
				fwrite($createFile,"$sn\t$time\t$action\t\t$item\t\t$desc".PHP_EOL);
			}else{
				$intro = "Auto-Generated File: Do not Modify".PHP_EOL."@Copyright: Company Name".PHP_EOL;
				fwrite($createFile,$intro);
				fwrite($createFile,"--------------------------------------------------------------------------------------------------------------------------------------------------------------------".PHP_EOL);
				fwrite($createFile,"SN\t\t\tDate\t\t\t\tAction\t\t\tItem\t\t\t\tDescription".PHP_EOL);
				fwrite($createFile,"--------------------------------------------------------------------------------------------------------------------------------------------------------------------".PHP_EOL);
				fwrite($createFile,"$sn\t$time\t$action\t\t$item\t\t$desc".PHP_EOL);
			}			
		}
		fclose($createFile);		
	}
	
}
//end of logLogin()
function logAdmin($action,$item,$desc){
	
	if($action==''or$item==''or$desc==''){		
		exit;
	}else{
		date_default_timezone_set("Asia/Kolkata"); 
		$time = date('l,jS F Y,h:i:s A',time()+900);
		$staff = $_SESSION['email'];	
		
		$now = date('l, jS F Y',time()+900);
		if($now!=date('l, jS F Y',time()+900)){
			
			$now = date('l, jS F Y',time()+900);
			$file = "$staff@".$now.".txt";		
			$createFile = fopen("source/logs/admin/".$file, 'w');
		}
		$file = "source/logs/admin/$staff@".$now.".txt";	
		if(file_exists($file)){	
			$new ="No";
			$createFile = fopen($file, 'a');	
		}else{			
			$createFile = fopen($file, 'w');	
		}		
		if(mysql_query("INSERT into logs set date_added = '$time',action = '$action',item = '$item',description = '$desc',staff = '$staff',file = '$file'")){
			$count = mysql_fetch_array(mysql_query("SELECT count(file) from logs where file = '$file'"));
			$sn = $count['count(file)']++;
			
			if($new == "No"){				
				fwrite($createFile,"$sn\t$time\t$action\t\t\t$item\t\t$desc".PHP_EOL);
			}else{
				$intro = "Auto-Generated File: Do not Modify".PHP_EOL."@Copyright: Company Name".PHP_EOL;
				fwrite($createFile,$intro);
				fwrite($createFile,"--------------------------------------------------------------------------------------------------------------------------------------------------------------------".PHP_EOL);
				fwrite($createFile,"SN\t\t\tDate\t\t\t\tAction\t\t\tItem\t\t\t\tDescription".PHP_EOL);
				fwrite($createFile,"--------------------------------------------------------------------------------------------------------------------------------------------------------------------".PHP_EOL);
				fwrite($createFile,"$sn\t$time\t$action\t\t\t$item\t\t$desc".PHP_EOL);
			}			
		}
		fclose($createFile);		
	}	
}
//end of logAdmin()
function logAndroid($email,$action,$item,$desc){
	
	if($action==''or$item==''or$desc==''){		
		exit;
	}else{
		date_default_timezone_set("Asia/Kolkata"); 
		$time = date('l,jS F Y,h:i:s A',time()+900);
		$staff = $_SESSION['email'];	
		
		$now = date('l, jS F Y',time()+900);
		if($now!=date('l, jS F Y',time()+900)){
			
			$now = date('l, jS F Y',time()+900);
			$file = "$email@".$now.".txt";		
			$createFile = fopen("source/logs/android/".$file, 'w');
		}
		$file = "source/logs/android/$email@".$now.".txt";	
		if(file_exists($file)){	
			$new ="No";
			$createFile = fopen($file, 'a');	
		}else{			
			$createFile = fopen($file, 'w');	
		}		
		if(mysql_query("INSERT into logs set date_added = '$time',action = '$action',item = '$item',description = '$desc',staff = '$staff',file = '$file'")){
			$count = mysql_fetch_array(mysql_query("SELECT count(file) from logs where file = '$file'"));
			$sn = $count['count(file)']++;
			
			if($new == "No"){				
				fwrite($createFile,"$sn\t$time\t$action\t\t\t$item\t\t$desc".PHP_EOL);
			}else{
				$intro = "Auto-Generated File: Do not Modify".PHP_EOL."@Copyright: Company Name".PHP_EOL;
				fwrite($createFile,$intro);
				fwrite($createFile,"--------------------------------------------------------------------------------------------------------------------------------------------------------------------".PHP_EOL);
				fwrite($createFile,"SN\t\t\tDate\t\t\t\tAction\t\t\tItem\t\t\t\tDescription".PHP_EOL);
				fwrite($createFile,"--------------------------------------------------------------------------------------------------------------------------------------------------------------------".PHP_EOL);
				fwrite($createFile,"$sn\t$time\t$action\t\t\t$item\t\t$desc".PHP_EOL);
			}			
		}
		fclose($createFile);		
	}	
}
//end of logAndroid()


?>