<?php
	if(isset($_GET['action']))
	{
		$action = $_GET['action'];
				
		include_once './db_functions.php';
		include_once './constants.php';
		include_once './log.php';
		
		$db = new db_functions();
		if($action == 'login')
		{
			
			if(isset($_GET['email']) and isset($_GET['password']))
			{

				$email = mysql_real_escape_string($_GET['email']);			
				$password = mysql_real_escape_string($_GET['password']);

				$user = $db->login($email,$password);

				$rows = array();
				$rows['status'] ='fail';

				while($r = mysql_fetch_assoc($user))
				{
					$rows['status'] = 'pass';
					$rows['data'][] = $r;					
				}
				if($rows['status']=='pass')
				{					
					$action = $action;
					$item = $email;
					$desc = 'Logged in Successfully.DATA='.json_encode($rows);					
					logMember($email,$action,$item,$desc);
					logSystem($action,$item,$desc);
					logLogin($email,$action,$item,$desc);
				}else
				{
					$action = $action;
					$item = $email;
					$desc = 'Login Unsuccessful using Password:'.$password;					
					logMember($email,$action,$item,$desc);
					logSystem($action,$item,$desc);
					logLogin($email,$action,$item,$desc);
				}
				echo json_encode($rows);				
			}	
		}
		else if($action == 'getbookbytas')
		{
			if(isset($_GET['title']) and isset($_GET['author']) and isset($_GET['subject']))
			{
				$email = mysql_real_escape_string($_GET['email']);
				$title = mysql_real_escape_string($_GET['title']);
				$author = mysql_real_escape_string($_GET['author']);
				$subject = mysql_real_escape_string($_GET['subject']);

				$info = $db->getBookByTAS($title,$author,$subject);
			
				$rows = array();
				$rows['status'] ='fail<font color="#6666CC"';
				while($r = mysql_fetch_assoc($info))
				{
					$rows['status'] = 'pass';
					$rows['data'][] = $r;
				}
				if($rows['status']=='pass')
				{
					$res = mysql_fetch_array($info);
					$action = 'Search:TAS';
					$item = $email;
					$desc = 'Searched Books Successfully.DATA='.json_encode($rows);
					logMember($email,$action,$item,$desc);
					logSystem($action,$item,$desc);
					
				}
				echo json_encode($rows);				
			}
			if(isset($_GET['author']))
			{
				$email = mysql_real_escape_string($_GET['email']);		
				$author = mysql_real_escape_string($_GET['author']);
				$info = $db->getBookByA($author);			
				$rows = array();
				$rows['status'] ='fail';
				while($r = mysql_fetch_assoc($info))
				{
					$rows['status'] = 'pass';
					$rows['data'][] = $r;
				}
				if($rows['status']=='pass')
				{
					$res = mysql_fetch_array($info);
					$action = 'Search:A';
					$item = $email;
					$desc = 'Searched Books Successfully.DATA='.json_encode($rows);
					logMember($email,$action,$item,$desc);
					logSystem($action,$item,$desc);
					
				}
				echo json_encode($rows);					
			}
			if(isset($_GET['title']))
			{	
				$email = mysql_real_escape_string($_GET['email']);			
				$title = mysql_real_escape_string($_GET['title']);
				$info = $db->getBookByT($title);			
				$rows = array();
				$rows['status'] ='fail';
				while($r = mysql_fetch_assoc($info))
				{
					$rows['status'] = 'pass';
					$rows['data'][] = $r;
				}
				if($rows['status']=='pass')
				{
					$res = mysql_fetch_array($info);
					$action = 'Search:T';
					$item = $email;
					$desc = 'Searched Books Successfully.DATA='.json_encode($rows);
					logMember($email,$action,$item,$desc);
					logSystem($action,$item,$desc);
					
				}
				echo json_encode($rows);					
			}
			if(isset($_GET['subject']))
			{	$email = mysql_real_escape_string($_GET['email']);			
				$subject = mysql_real_escape_string($_GET['subject']);
				$info = $db->getBookByT($subject);			
				$rows = array();
				$rows['status'] ='fail';
				while($r = mysql_fetch_assoc($info))
				{
					$rows['status'] = 'pass';
					$rows['data'][] = $r;
				}
				if($rows['status']=='pass')
				{
					$res = mysql_fetch_array($info);
					$action = 'Search:S';
					$item = $email;
					$desc = 'Searched Books Successfully.DATA='.json_encode($rows);
					logMember($email,$action,$item,$desc);
					logSystem($action,$item,$desc);
					
				}
				echo json_encode($rows);					
			}		
			
		}	
		else if($action == 'add_new_wishlist')
		{
			if(isset($_GET['email']) and isset($_GET['title']) and isset($_GET['author']) and isset($_GET['desc']) and isset($_GET['notify']))
			{
				$email = mysql_real_escape_string($_GET['email']);
				$title = mysql_real_escape_string($_GET['title']);
				$author = mysql_real_escape_string($_GET['author']);
				$desc = mysql_real_escape_string($_GET['desc']);
				$notify = mysql_real_escape_string($_GET['notify']);
				
				$info = $db->add_new_wishlist($email,$title,$author,$desc,$notify);
			
				$rows = array();
				$rows['status'] ='fail';
				if($info)
				{
					$rows['status'] = 'pass';					
				}
				if($rows['status']=='pass')
				{
					$res = mysql_fetch_array($info);
					$action = 'Wishlist:Add';
					$item = $email;
					$desc = 'Added Successfully.DATA='.json_encode($rows);
					logMember($email,$action,$item,$desc);
					logSystem($action,$item,$desc);
					
				}
				echo json_encode($rows);				
			}
		}
		else if($action == 'delete_all_wishlist')
		{
			if(isset($_GET['email']))
			{
				$email = mysql_real_escape_string($_GET['email']);
				
				$info = $db->delete_all_wishlist($email);
			
				$rows = array();
				$rows['status'] ='fail';
				if($info)
				{					
					$rows['status'] = 'pass';					
				}
				if($rows['status']=='pass')
				{
					$res = mysql_fetch_array($info);
					$action = 'Wishlist:Delete';
					$item = $email;
					$desc = 'Deleted Successfully.DATA='.json_encode($rows);
					logMember($email,$action,$item,$desc);
					logSystem($action,$item,$desc);
					
				}
				echo json_encode($rows);				
			}
		}
		else if($action == 'get_wishlist')
		{
			if(isset($_GET['email']))
			{
				$email = mysql_real_escape_string($_GET['email']);				
				$info = $db->get_wishlist($email);
			
				$rows = array();
				$rows['status'] ='fail';
				while($r = mysql_fetch_assoc($info))
				{
					$rows['status'] = 'pass';
					$rows['data'][] = $r;
				}
				if($rows['status']=='pass')
				{				
					$action = 'Get:Wishlist';
					$item = $email;
					$desc = 'Sent Wishlists Successfully.DATA='.json_encode($rows);
					logMember($email,$action,$item,$desc);
					logSystem($action,$item,$desc);
					
				}
				echo json_encode($rows);							
				
			}
		}
		else if($action == 'get_mybooks')
		{
			if(isset($_GET['email']))
			{
				$email = mysql_real_escape_string($_GET['email']);				
				$info = $db->get_mybooks($email);
			
				$rows = array();
				$rows['status'] ='fail';
				while($r = mysql_fetch_assoc($info))
				{
					$rows['status'] = 'pass';
					$rows['data'][] = $r;
				}
				if($rows['status']=='pass')
				{
					$res = mysql_fetch_array($info);
					$action = 'Get:Issues';
					$item = $email;
					$desc = 'Sent Issues Successfully.DATA='.json_encode($rows);
					logMember($email,$action,$item,$desc);
					logSystem($action,$item,$desc);
					
				}
				echo json_encode($rows);							
				
			}
		}		
		else if($action == 'get_allBooks')
		{		
				
				$info = $db->get_allBooks();
			
				$rows = array();
				$rows['status'] ='fail';
				while($r = mysql_fetch_assoc($info))
				{
					$rows['status'] = 'pass';
					$rows['data'][] = $r;
				}
				if($rows['status']=='pass')
				{
					$res = mysql_fetch_array($info);
					$action = 'Get:Books';
					$item = $email;
					$desc = 'Sent All Books Successfully.DATA='.json_encode($rows);				
					logMember($email,$action,$item,$desc);
					logSystem($action,$item,$desc);					
				}
				echo json_encode($rows);							
				
			
		}	
		else if($action == 'recover_account')
		{			
			if(isset($_GET['email']))
			{
				$email = mysql_real_escape_string($_GET['email']);				
				$info = $db->recover_account($email);	
				$rows = array();
				$rows['status'] ='fail';
				if(mysql_num_rows($info) > 0)
				{
					$pass = mysql_fetch_array($info);
					$header = "From:thapasujan5@gmail.com\n";
		 		    $header.= "Cc:sujan_digitaldivider@yahoo.com \r\n";
					$subject ="Library Account Recovery Response";
					$password = $pass['password'];
					$body = "Dear Member,<br> Your password is: $password";
					$sendPass = mail($email,$subject,$body,$headers);
					$rows['status'] = 'pass';					
				}
				if($rows['status']=='pass')
				{
					$res = mysql_fetch_array($info);
					$action = 'Recover';
					$item = $email;
					$desc = 'Sent Email Successfully.DATA='.json_encode($rows);				
					logMember($email,$action,$item,$desc);
					logSystem($action,$item,$desc);
					
				}
				echo json_encode($rows);							
			}		
			
		}	
		else if($action == 'change_password')
		{			
			if(isset($_GET['email']) && isset($_GET['newpassword']))
			{
				$email = mysql_real_escape_string($_GET['email']);				
				$newpassword = mysql_real_escape_string($_GET['newpassword']);				
				$info = $db->change_password($email);	
				$rows = array();
				$rows['status'] ='fail';
				if(mysql_num_rows($info) > 0)
				{
					$changepassword = mysql_query("UPDATE members_info set password = '$newpassword' where email = '$email'");						
		 			$header = "From:thapasujan5@gmail.com\n";
		 		    $header.= "Cc:sujan_digitaldivider@yahoo.com \r\n";
				    $header.= "MIME-Version: 1.0\r\n";
				    $header.= "Content-type: text/html\r\n";					
					$to = $email;						
					$subject = "Library Account Password Changed";					
					$newPW = gettext($newpassword);
					$body = "Dear Member,<br> Your password has been changed to :<b><strong><font size=\"15\" color=\"#0000ff\"> $newPW </font></b></strong> if this was not initiated by you. Please contact to the Library to recover again !";
					$sendPass = mail($email,$subject,$body,$header);
					$rows['status'] = 'pass';					
				}
				if($rows['status']=='pass')
				{
					$res = mysql_fetch_array($info);
					$action = 'Change:PW';
					$item = $email;
					$desc = 'Changed Successfully.DATA='.json_encode($rows);				
					logMember($email,$action,$item,$desc);
					logSystem($action,$item,$desc);					
				}
				echo json_encode($rows);							
			}
		}	
	}

?>