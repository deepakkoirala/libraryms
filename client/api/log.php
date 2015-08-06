<?php
error_reporting(0);
include_once './constants.php';
include_once './database.php';
//************************************************************************************************************************************************
function getJSON($res){
	$data = array();	
	array_push($data,$res);
	return json_encode($data);
}
//end of getJSON
//************************************************************************************************************************************************

function logMember($email,$action,$item,$desc){
	
	if($email==''or$action==''or$item==''or$desc==''){		
		exit;
	}else{
		date_default_timezone_set("Asia/Kolkata"); 
		$time = date('l,jS F Y,h:i:s A',time()+900);
		//$staff = $_SESSION['email'];	
		
		$now = date('l, jS F Y',time()+900);
		if($now!=date('l, jS F Y',time()+900)){
			
			$now = date('l, jS F Y',time()+900);
			$file = "$email@".$now.".txt";		
			$createFile = fopen("logs/clients/".$file, 'w');
		}
		$file = "logs/clients/$email@".$now.".txt";	
		if(file_exists($file)){	
			$new ="No";
			$createFile = fopen($file, 'a');	
		}else{			
			$createFile = fopen($file, 'w');	
		}		
		if(mysql_query("INSERT into logs set date_added = '$time',action = '$action',item = '$item',description = '$desc',staff = '',file = '$file'")){
			$count = mysql_fetch_array(mysql_query("SELECT count(file) from logs where file = '$file'"));
			$sn = $count['count(file)']++;
			if($new == "No"){				
				fwrite($createFile,"$sn\t$time\t$action\t\t$item\t\t\t$desc".PHP_EOL);
			}else{
				$intro = "Auto-Generated File: Do not Modify".PHP_EOL."@Copyright: Company Name".PHP_EOL;
				fwrite($createFile,$intro);
				fwrite($createFile,"--------------------------------------------------------------------------------------------------------------------------------------------------------------------".PHP_EOL);
				fwrite($createFile,"SN\t\t\tDate\t\t\tAction\t\t\tItem\t\t\t\tDescription".PHP_EOL);
				fwrite($createFile,"--------------------------------------------------------------------------------------------------------------------------------------------------------------------".PHP_EOL);
				fwrite($createFile,"$sn\t$time\t$action\t\t$item\t\t\t$desc".PHP_EOL);
			}			
		}
		fclose($createFile);			
	}	
}
//end of logMember()

	function logSystem($action,$item,$desc){
	
	if($action==''or$item==''or$desc==''){		
		exit;
	}else{
		date_default_timezone_set("Asia/Kolkata"); 
		$time = date('l,jS F Y,h:i:s A',time()+900);
		//$staff = $_SESSION['email'];	
		
		$now = date('l, jS F Y',time()+900);
		if($now!=date('l, jS F Y',time()+900)){
			
			$now = date('l, jS F Y',time()+900);
			$file = "System@".$now.".txt";		

			$createFile = fopen("logs/system/".$file, 'w');
		}
		$file = "logs/system/System@".$now.".txt";	
		if(file_exists($file)){	
			$new ="No";
			$createFile = fopen($file, 'a');	
		}else{			
			$createFile = fopen($file, 'w');	
		}		
		if(mysql_query("INSERT into logs set date_added = '$time',action = '$action',item = '$item',description = '$desc',staff = '',file = '$file'")){
			$count = mysql_fetch_array(mysql_query("SELECT count(file) from logs where file = '$file'"));
			$sn = $count['count(file)']++;
			
			if($new == "No"){				
				fwrite($createFile,"$sn\t$time\t$action\t\t$item\t\t$desc".PHP_EOL);
			}else{
				$intro = "Auto-Generated File: Do not Modify".PHP_EOL."@Copyright: Company Name".PHP_EOL;
				fwrite($createFile,$intro);
				fwrite($createFile,"--------------------------------------------------------------------------------------------------------------------------------------------------------------------".PHP_EOL);
				fwrite($createFile,"SN\t\t\tDate\t\t\tAction\t\t\tItem\t\t\t\tDescription".PHP_EOL);
				fwrite($createFile,"--------------------------------------------------------------------------------------------------------------------------------------------------------------------".PHP_EOL);
				fwrite($createFile,"$sn\t$time\t$action\t\t$item\t\t$desc".PHP_EOL);
			}			
		}
		fclose($createFile);		
	}	
}
//end of logSystem()
function logLogin($email,$action,$item,$desc){
	
	if($email == '' or $action==''or$item==''or$desc==''){		
		exit;
	}else{
		date_default_timezone_set("Asia/Kolkata"); 
		$time = date('l,jS F Y,h:i:s A',time()+900);
		//$staff = $_SESSION['email'];	
		
		$now = date('l, jS F Y',time()+900);
		if($now!=date('l, jS F Y',time()+900)){
			
			$now = date('l, jS F Y',time()+900);
			$file = "Logins@".$now.".txt";		
			$createFile = fopen("logs/logins/".$file, 'w');
		}
		$file = "logs/logins/Logins@".$now.".txt";	
		if(file_exists($file)){	
			$new ="No";
			$createFile = fopen($file, 'a');	
		}else{			
			$createFile = fopen($file, 'w');	
		}		
		if(mysql_query("INSERT into logs set date_added = '$time',action = '$action',item = '$item',description = '$desc',staff = '',file = '$file'")){
			$count = mysql_fetch_array(mysql_query("SELECT count(file) from logs where file = '$file'"));
			$sn = $count['count(file)']++;
			
			if($new == "No"){				
				fwrite($createFile,"$sn\t$time\t$action\t\t$item\t\t$desc".PHP_EOL);
			}else{
				$intro = "Auto-Generated File: Do not Modify".PHP_EOL."@Copyright: Company Name".PHP_EOL;
				fwrite($createFile,$intro);
				fwrite($createFile,"--------------------------------------------------------------------------------------------------------------------------------------------------------------------".PHP_EOL);
				fwrite($createFile,"SN\t\t\tDate\t\t\tAction\t\t\tItem\t\t\t\tDescription".PHP_EOL);
				fwrite($createFile,"--------------------------------------------------------------------------------------------------------------------------------------------------------------------".PHP_EOL);
				fwrite($createFile,"$sn\t$time\t$action\t\t$item\t\t$desc".PHP_EOL);
			}			
		}
		fclose($createFile);		
	}
	
}
//end of logLogin()
?>