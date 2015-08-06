<?php
	error_reporting(1);
	include 'includes/login-check.php';
	include 'log.php';
	
	session_start();
	if(!($_SESSION['fname'])) 
	{
		header('Location:'.site_url.'/login.php');
	}
//*****************************************************************************************************************************************
function markLost($an,$libid){
	$update_book = "UPDATE books_info set status = 'lost' where accession_no = '$an'";
	$update_issue = "UPDATE issued set status = 'lost' where accession_no = '$an'";
	
	date_default_timezone_set("Asia/Kolkata"); 
	$time = date('l, jS F Y, h:i:s A',time()+900);		
	$staff = $_SESSION['email'];
	
	$mark_lost = "INSERT into lostbooks set book ='$an', member ='$libid',date_reported = '$time',staff = '$staff', action = '',fine_amount=''";
	if(mysql_query($update_book) and mysql_query($update_issue) and mysql_query($mark_lost)){
		$res = mysql_fetch_array(mysql_query("SELECT * from lostbooks where book = '$an'"));
		$data = array();
		array_push($data,$res);
		$action = "Mark_Lost";
		$item = "AN:($an)";
		$desc = "Marked as Lost: DATA=".json_encode($data);
		//logLogin($action,$item,$desc);
		logStaff($action,$item,$desc);			
		logAdmin($action,$item,$desc);
		logSystem($action,$item,$desc);	
		return true;
	}else{
	return false;
	}
}

function updateCover($an,$imagename)
	{
		$data = mysql_fetch_array(mysql_query("SELECT * from books_info where accession_no = '$an'"));
		$update = mysql_query("UPDATE books_info set cover = '$imagename' where accession_no = '$an'");		
		$oldimage =	$data['cover'];
		
		copy("source/images/books/".$oldimage,"source/images/books/garbage/".$oldimage);		
		
		if($update){
		//$res = mysql_fetch_array(mysql_query("SELECT * from books_info where accession_no = '$an' "));
		$action = "Cover_Updated";
		$item = "$an";
		$desc = "Book Cover Updated:DATA=OldCover:$oldimage;NewCover:$imagename";
		//logLogin($action,$item,$desc);
		logStaff($action,$item,$desc);		
		logSystem($action,$item,$desc);	
			$_SESSION['msgUpload']="Updated Successfully !";			
			if(!unlink("source/images/books/".$oldimage)){
				$_SESSION['msgUpload']="Updated Successfully !";			
				}
			return true;
			}
		else{
			$_SESSION['msgUpload']="Error in Upload !";
			return false;				
		}
	}	

function updatePhoto($lib_id,$imagename)
	{
		$data = mysql_fetch_array(mysql_query("SELECT member_image,fname,lname from members_info where lib_id = '$lib_id'"));
		$update = mysql_query("UPDATE members_info set member_image = '$imagename' where lib_id = '$lib_id'");		
		$oldimage =	$data['member_image'];
		$libid = $lib_id;
		copy("source/images/members/".$oldimage,"source/images/members/garbage/".$oldimage);		
		
		if($update){
				$action = "Update_Photo";
				$item = "$lib_id";
				$desc = "Update Success:DATA=OldPhoto:$oldimage;NewPhoto:$imagename";
				logMember($libid,$action,$item,$desc);
				logSystem($action,$item,$desc);
			$_SESSION['msgUpload']="Updated Successfully !";			
			if(!unlink("source/images/members/".$oldimage)){
				$_SESSION['msgUpload']="Updated Successfully !";			
				}
			return true;
			}
		else{
			$_SESSION['msgUpload']="Error in Upload !";
			return false;				
		}
	}	
	
	function updateStaffPhoto($email,$imagename)
	{		
		$update = mysql_query("UPDATE staffs_info set staff_image = '$imagename' where email = '$email'");			
		if($update){	
		$action = "Update_StaffPhoto";
				$item = "$email";
				$desc = "Update Success:NewPhoto:$imagename";
				//logMember($libid,$action,$item,$desc);
				logStaff($action,$item,$desc);
				logSystem($action,$item,$desc);		
			$_SESSION['msgUpload']="Updated Successfully !";			
			return true;
			}
		else{
			$_SESSION['msgUpload']="Error in Upload !";
			return false;				
		}
	}	
	
	function GetImageExtension($imagetype)
    {
	       if(empty($imagetype)) return false;
	       switch($imagetype)
	       {
	           case 'image/bmp': return '.bmp';
	           case 'image/gif': return '.gif';
	           case 'image/jpeg': return '.jpg';
	           case 'image/png': return '.png';
			   
			   case 'image/BMP': return '.BMP';
	           case 'image/GIF': return '.GIF';
	           case 'image/JPEG': return '.JPG';
	           case 'image/PNG': return '.PNG';
	           default: return false;
	       }	 
     }
	function recycleCover($src,$dest){
		copy($src,$dest);
	}
	function deleteCover($src){
		unlink($src);
	}
	function deleteBooks($callno)
	{
		$query = mysql_query("SELECT cover from books_info where call_no = '$callno' and flag = 1");		
		while($cover = mysql_fetch_array($query))
			{
				$file = $cover['cover'];
				copy("source/images/books/$file","source/images/books/garbage/$file");
				unlink("source/images/books/".$cover['cover']."");
			}
		$res = mysql_query("SELECT * from books_info where call_no = '$callno' and flag = 1");
		$query = mysql_query("Delete from books_info where call_no = '$callno' and flag = 1");		
		if($query)
		{					
			$action = "Delete_Books";
			$item = "Books:$callno";
			$desc = "Deleted Successfully all Availables Books Data=".getJSON($res);				
			logStaff($action,$item,$desc);
			logSystem($action,$item,$desc);	
			echo '<center><h3 class="alert alert-info">All Available Books with Call Number : '.$callno.' Deleted !</center>';
		}
		else
		{
			exit;
		}
	}
	function controlBook($libid)
	{
		$query = mysql_query("SELECT numbooks from constants where department = (SELECT department from members_info where lib_id = '$libid')");
		$count = mysql_fetch_array($query);
		return $count['numbooks'];	
	}

	function parseNum($string)
	{
		if(!filter_var($string, FILTER_VALIDATE_INT)) 
		{
			$r1 = explode("(",$string);		
			$result = explode(")",$r1[1]);
			return $result[0];
		}else
		return $string;		
	}
			

	function generate_libid()
	{
	$rand = rand();													
	$query = mysql_query("SELECT * from members_info WHERE lib_id = $rand"); 
	if(mysql_num_rows($query)>0) 
	{
		generate_rand(); }else return $rand;
	}
	function generate_randan()
	{
		//$rand = rand();													
		//$query = mysql_query("SELECT max(accession_no) from books_info "); 
		$an = mysql_fetch_array(mysql_query("SELECT max(accession_no) from books_info ")); 
		/*if(mysql_num_rows($query)>0) 
		{
			 generate_randan(); 
		}
		else*/
		
		return (($an[0])+1);
	}
	
	
//***********************************Functions of Operations***********************************************************************************
function viewAllIssues()
{

	include('includes/viewAllIssues.php');
}
function totalMembers()
{
	$mems = mysql_fetch_array(mysql_query("select count(lib_id) from members_info"));
	return $mems['count(lib_id)'];					
}
function totalLost()
{
	$lost = mysql_fetch_array(mysql_query("select count(id) from lostbooks"));
	return $lost['count(id)'];					
}
function totalBooks()
{
	$books = mysql_fetch_array(mysql_query("select count(accession_no) from books_info where status not in('lost')"));
	return $books['count(accession_no)'];				
}
function totalIssues()
{
	$issues = mysql_fetch_array(mysql_query("select count(id) from issued where status not in ('lost')"));
	return $issues['count(id)'];					
}	

function checkAdmin()
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

	function adduser($fname,$lname,$email,$password,$phone,$sex,$add1,$add2,$position,$time)
	{
		date_default_timezone_set("Asia/Kolkata"); 
		$time = date('l, jS F Y, h:i:s A',time()+900);		
		$insert = mysql_query("INSERT INTO `staffs_info`(`fname`, `lname`, `email`, `password`, `phone`, `sex`, `temporary_address`, `permanent_address`, `position`, `date_joined`) VALUES ('$fname','$lname','$email','$password','$phone','$sex','$add1','$add2','$position','$time') ");
		if($insert)	
		{
					$res = mysql_query("SELECT * from staffs_info where email = '$email'");
					$action = "Add_Staff";
					$item = "Staff";
					$desc = "Added Successfully:Data=".getJSON($res);
					
					//$libid = $rowmember['lib_id'];
					//logMember($libid,$action,$item,$desc);
					logStaff($action,$item,$desc);
					logSystem($action,$item,$desc);	
			
			echo ' <h3 class = "alert alert-info"> <center>New Staff <font color = "purple">'.$fname.' '.$lname.'</font> added Successfully! ';	
			echo '<br><br><center><a class="btn btn-primary" href = "'.site_url.'">Done</a></center></h3>';	
			echo '<center><input type="button" value = "Add More..." class="btn btn-primary" onclick="Javascript:history.go(-1)"></center></h3>';	
					
		}
		else			
		{
			$check1 = mysql_query("SELECT * from staffs_info where email = '$email'");
			$check = mysql_fetch_array($check1);
			if($check1)
			{
				echo ' <h3 class = "alert alert-info"> <center><font color = "purple"><font color="red">Error!</font> : '.$check['fname'].' '.$check['lname'].' </font> is already associated with <a title ="E-mail to '.$check['fname'].'"href="mailto:'.$check['email'].'"><font color = "purple"> '.$check['email'].'</font></a>';
				echo '<br><br><center><input type="button" value = "Try with New Email" class="btn btn-primary" onclick="Javascript:history.go(-1)"></center></h3>';
			}
		}
	}
	function edituserdetails($fname,$lname,$email,$password,$phone,$sex,$add1,$add2,$position,$time)
	{
		$update = mysql_query("UPDATE  staffs_info set fname = '$fname',lname = '$lname' , email = '$email', password = '$password',phone = '$phone',sex = '$sex',temporary_address = '$add1',permanent_address = '$add2',position = '$position',date_joined = '$time' where email = '$email'");
		
		if($update)	
		{
					$res = mysql_query("SELECT * from staffs_info where email = '$email'");
					$action = "Edit_Staff";
					$item = "Staff";
					$desc = "Edited Successfully:Data=".getJSON($res);
					
					//$libid = $rowmember['lib_id'];
					//logMember($libid,$action,$item,$desc);
					logStaff($action,$item,$desc);
					logSystem($action,$item,$desc);	
			echo ' <h3 class = "alert alert-info"> <center>Staff<a href="index.php?action=staffdetails&email=$email"><font color ="blue"> '.$fname.' '.$lname.' </font></a>updated Successfully! ';	
			echo '<br><br><center><input type="button" value = "Back" class="btn btn-primary" onclick="Javascript:history.go(-2)"></center></h3>';	
		}
	}
	function deleteuser($user)
	{
		$staff = mysql_fetch_array(mysql_qyery("SELECT * from staffs_info where email = '$user'"));
		$delete = mysql_query("DELETE from staffs_info where email ='$user'");
		if($delete)
		{
					$res = mysql_query("SELECT * from staffs_info where email = '$user'");
					
					$action = "Delete_Staff";
					$item = "Staff";
					$desc = "Deleted Successfully:Data=".getJSON($res);
					
					//$libid = $rowmember['lib_id'];
					//logMember($libid,$action,$item,$desc);
					logStaff($action,$item,$desc);
					logSystem($action,$item,$desc);	
			echo ' <h3 class = "alert alert-info"> <center>Deleted Successfully !<br>';	
			echo '<center><input type="button" value = "Login" class="btn btn-primary" onclick="Javascript:history.go(-1)"></center></h3>';
			$oldimage = $staff['staff_image'];
			copy("source/images/staffs/".$oldimage."","source/images/staffs/garbage/".$oldimage."");
			unlink("source/images/staffs/".$oldimage."");
		}
		else
		{
			echo  '<h3 class ="alert alert-info"><center>Error Deleting</center>';
		}
	}
	function edituser($email)
	{
		
		include 'includes/edituser_form.php';
	}
	function issued_form($AccessionNumber)
	{
		
		include 'includes/issue_form.php';
	}
	function searchedbook_form($real_an)
	{		
		if($real_an=="")
		{
            echo'<h3 class="alert alert-danger"><center><span style="color:red;">No Such Book Found !</span><center></h3>';
			exit();            	   
        }
		$query = mysql_query("SELECT * from books_info WHERE accession_no = '$real_an'");		 	
		while($res = mysql_fetch_array($query))
		{					

			include 'includes/editbookdetails_form.php';
			exit();
		}
				echo " <h3 class=\"alert alert-info\"><center>Book not Found (Accession Number) :<font color=\"red\"> ".$real_an."</font><center></h3>";
				// search book ends here...(for edit)		
	}
	
	
		
	function searchedmember_form($txtlibid)	
	{
		if($txtlibid== "")
		{
      		echo'<center><b><span style="color:red;">Error:</span> </b><h3 class="alert alert-danger">No such Member Found !</h3><center>';
			exit();            	   
       	}	
			$query = mysql_query("SELECT * from members_info WHERE lib_id = '$txtlibid'");
			
			if(mysql_num_rows($query)>0)
			{
				while($res = mysql_fetch_array($query))
				{
					include 'includes/editmemberdetails_form.php';
					exit();
				}				
			}
			else
			{			
				echo "<h3 class=\"alert alert-info\"> <center>Member not found (Library ID) : <font color=\"red\">".$txtlibid."</font></h3><center>";
			}
	}
	
	function deletemember($libid)
	{
		if($libid == "")
				{
        	      echo'<center><h3 class="alert alert-danger">Invalid Library ID or  Name</h3><center>';
				  exit();            	   
             	}
				else
				{
					$checkmem = mysql_query("SELECT * FROM members_info where lib_id = '$libid'");
					$res = $checkmem;
					$data = getJSON($res);
					$mem = mysql_fetch_array($checkmem);
					if(mysql_num_rows($checkmem) == 0)
					{				
						echo "<h3 class = \"alert alert-info\"><center>Member with ID<font color=\"red\"> $libid </font>doesn't exist in our Database !</center>";
						echo '<br><center><a class ="btn btn-primary" href="'.site_url.'">Back</a></center></h3>';
						exit();
					}
					$checkIssue = mysql_fetch_array(mysql_query("SELECT * from issued where lib_id = '$libid'"));										
					if(count($checkIssue)==1)
					{
						echo"<h3 class = \"alert alert-info\"><center>Deleted Successfully Member <font color=\"blue\">$mem[1] $mem[2]</font> with Id:<font color=\"red\">".$libid."</font></center>";	
						echo '<br>';
						echo '<center><a class = "btn btn-primary" href="'.site_url.'">Okay</a></center></h3>';
						//$del_issue = mysql_query("DELETE FROM issued where lib_id ='$libid'");
						$delete = mysql_query("Delete from members_info WHERE lib_id = '$libid'");	
						if($delete){							
							$action = "Delete_Member";
							$item = "($libid)";
							$desc = "Deleted Successfully:Data=$data";
							logMember($libid,$action,$item,$desc);
							logStaff($action,$item,$desc);
							logSystem($action,$item,$desc);	
							$oldimage = $mem['member_image'];
							copy("source/images/members/".$oldimage."","source/images/members/garbage/".$oldimage."");
							unlink("source/images/members/".$oldimage."");
						}
					}else
					{
						echo"<h3 class = \"alert alert-info\"><center><font color=\"red\">Error:</font> Member
						 <a href = \"index.php?action=memberstatus&libid=".$libid."\">
						 $mem[1] $mem[2]</a>(<font color=\"purple\">".$libid.")</font> has books to be returned back to library.<br><br>
						 <a class = \"btn btn-primary\" href = \"index.php?action=memberstatus&libid=".$libid."\">Check Books</a></center></h3>";
					 }	
					
				mysql_close($connect);
			}
	}
	function editmember($fname,$lname,$libid,$mobile,$email,$password,$add1,$add2,$father,$batch,$cat,$department,$imagename)
	{
		if($imagename == "" or $fname == "" or $lname == "" or $mobile == "" or $email == "" or $password == "" or $add1 == "" or $cat == "" or $department == "")
				{
					echo "<center><span style=\"color:red;text-align:center;\">Not Enough Values to Update.<br>(Note: * fields are Compulsory !)</span></center>";
					exit();
				}
				else
				{	updatePhoto($libid,$imagename);
					$query_addmember = mysql_query("UPDATE members_info SET `fname` = '$fname',`lname` = '$lname',`mobile_number` = '$mobile',`email` = '$email',`password`='$password',`temporary_address` = '$add1',`permanent_address` = '$add2',
`father_name` = '$father',`batch` = '$batch',`category` = '$cat',`department` = '$department' WHERE `members_info`.`lib_id` ='$libid'");
				
				if($query_addmember)		
				{
					$res = mysql_query("SELECT * from members_info where lib_id = '$libid'");
					$action = "Edit_Member";
					$item = "$fname($libid)";
					$desc = "Edited Successfully:Data=".getJSON($res);
					logMember($libid,$action,$item,$desc);
					logStaff($action,$item,$desc);
					logSystem($action,$item,$desc);					
					echo"<h3 class = \"alert alert-info\"<br><center>Member <a href = \"index.php?action=memberstatus&libid=$libid\"><span style=\"color:blue;text-align:center;\">$fname $lname</span></a>"." Updated Successfully !</center>";
					echo '<br><br><center><a class = "btn btn-primary" href="'.site_url.'">Okay</a></center></h3>';
					exit();
				}
				else
				{
					unlink("source/images/members/garbage/".$data['member_image']);
					echo"<center><span style=\"color:red;position:fixed;left:210px;top:107px;\">Error Updating <span style=\"color:blue;text-align:center;\">$fname $lname !</span></span></center>";
					exit();
				}				
			}
	}
	function addmember($fname,$lname,$libid,$mobile,$email,$password,$add1,$add2,$father,$batch,$cat,$department,$imagename)
	{
		if($fname == "" or $lname == "" or $mobile == "" or $email == "" or $add1 == "" or $cat == "" or $department == "" or $imagename == "")
		{
			echo "<center><span style=\"color:black;text-align:center;\">Not Enough Values to Add Member.<br><span 
			style=\"color:red;text-align:center;\">(Note: * fields are Compulsory !)</span></span></center>";
			exit();
		}
		else
		{		
			$query_addmember = mysql_query("INSERT INTO `members_info`(`id`, `fname`, `lname`, `lib_id`, `mobile_number`, `email`, `password`,`temporary_address`, `permanent_address`, `father_name`, `batch`, `category`,`department`,`member_image`) VALUES ('','$fname','$lname','$libid','$mobile','$email','$fname','$add1','$add2','$father','$batch','$cat','$department','$imagename')");
		
			if($query_addmember)		
			{
				echo"<center><h3 class=\"alert alert-info\"> 
					Added Successfully. Libraray ID = <span style=\"color:black;text-align:center;\">$libid</span>
					<br> <br>
				<span style=\"color:blue;text-align:center;\">
					<a class=\"btn btn-primary\" href=\"index.php?action=memberstatus&libid=".$libid."\" target=\"_top\">
						$fname $lname
					</a>
				</span>	"." "."</h3></center>";
				
				$res = mysql_query("SELECT * from members_info where lib_id = '$libid'");
				$action = "New_Member";
				$item = "$fname($libid)";
				$desc = "Added Successfully:Data=".getJSON($res);
				logMember($libid,$action,$item,$desc);
				logStaff($action,$item,$desc);
				logSystem($action,$item,$desc);
				exit();
			}
			else
			{
				echo"<center><h3 class=\"alert alert-info\"><span style=\"color:red;\">Error adding member !</span></h3></center></h3>";
				exit();
			}
		}
}

function checkIssued($an)
{
	$check = mysql_query("SELECT * from issued where accession_no = $an");
	if($check){return true;}else{return false;}
}
	
	function deletebook($an)
	{
		if($an=="")
		{
             echo'<center>Not Enough Information to Perform Book Deletion !<center>';
			 exit();            	   
        }
		else
		{
			$checkBook =mysql_fetch_array( mysql_query("SELECT * FROM books_info where accession_no = '$an' "));	
			$oldimage = $checkBook['cover'];	
			if(!$checkBook)
			{
				echo "<center><h3 class=\"alert alert-info\">Warning:No such Book with Accession Number:<span style=\"color:red;\"> $an </span>found in the Database !<br><br>
					<a href=\"".site_url."\" class = \"btn btn-primary\">Okay</a></center><h3>";						
				exit();
			}
			$checkIssue=mysql_fetch_array(mysql_query("SELECT * from issued where accession_no = '$an'"));
			if($checkIssue)
			{				
				echo "<center><h3 class=\"alert alert-info\">Warning:Issued Book<span style=\"color:red;\"> $an </span>cannot be deleted !<br><br>
					<a href=\"".site_url."\" class = \"btn btn-primary\">Dismiss</a></center><h3>";						
				exit();
			}
			else
			{
				
				$res = mysql_query("SELECT * from books_info where accession_no = '$an'");
				$deletebook = mysql_query("Delete from books_info WHERE accession_no = '$an'");
				echo'<h3 class ="alert alert-info"><center>Deleted Successfully Book <font color="blue">'.$checkBook['title'].'</font> by <font color="blue">'.$checkbook['authors'].'
				</font>.<br>Accession Number:<font color="blue">'.$an."</font><br><br>
				<a class=\"btn btn-primary\" href=\"".site_url."\">Refresh Page !</a></center></h3>";
				if($deletebook){
					
					$action = "Delete_Book";
					$item = "AN:($an)";
					$desc = "Deleted Successfully:Data=".getJSON($res);
					//$libid = $rowmember['lib_id'];
					//logMember($libid,$action,$item,$desc);
					logStaff($action,$item,$desc);
					logSystem($action,$item,$desc);	
							
							copy("source/images/books/".$oldimage."","source/images/books/garbage/".$oldimage."");
							unlink("source/images/books/".$oldimage."");
						}
				exit();	
			}					
			mysql_close($connect);
		}
	}
	function editbook($an,$callno,$authors,$title,$p,$pd,$pp,$edition,$price,$page,$volume,$source,$billno,$sub,$category,$type,$remark,$imagename)
	{		
		if($imagename == "" or $an == "" or $callno == "" or $authors == "" or $title == "" or $p == "" or $edition == "" or $source == "" or $sub == "" or 
		$category == "" or $type == "")
		{
			echo "<h3 class = \"alert alert-info\"> <center><span style=\"color:red;text-align:center;\">Not Enough Values to Update Book.<br>(Note: * fields are 
			Compulsory!)</span></center><h3>";
			exit();
		}
		else
		{
			$sql = mysql_fetch_array(mysql_query("SELECT flag from books_info where accession_no ='$an'"));
			$flag = $sql['flag'];				 
			$update = mysql_query("UPDATE books_info set flag = '$flag',call_no = '$callno',authors='$authors',title='$title',publisher='$p',published_date='$pd',published_place='$pp',edition='$edition',price='$price',pages='$page',volume='$volume',source='$source',bill_no='$billno',subject='$sub',category='$category',type='$type', remark='$remark' where accession_no = '$an'");					
			if($update)
			{
					$res = mysql_query("SELECT * from books_info where accession_no = '$an'");
					$action = "Edit_Book";
					$item = "AN:($an)";
					$desc = "Edited Successfully:Data=".getJSON($res);
					//$libid = $rowmember['lib_id'];
					//logMember($libid,$action,$item,$desc);
					logStaff($action,$item,$desc);
					logSystem($action,$item,$desc);	
					
		if(updateCover($an,$imagename)){

				
			if(isset($_SESSION['go'])){				
				$action = "Replace_Book";
				$item = "$an";
				$desc = "Replace Success:DATA=".getJSON($res);
				//logMember($libid,$action,$item,$desc);
				logStaff($action,$item,$desc);
				logSystem($action,$item,$desc);
//							echo "reched";exit;
				
				 echo "<script> window.location =\"".site_url."/".$_SESSION['go']."\"; </script>";
				 exit;
				}
					}
			echo"<h3 class =\"alert alert-info\"><center>Book <span style=\"color:blue;text-align:center;\">$title</span> by <font color=\"blue\">$authors</font>"." 
			Updated Successfully !<br><br><a class =\"btn btn-primary\" href=\"index.php?action=bookstatus&an=".$an."\">Okay</a></center></h3>";
			exit();
			}
			else
			{
			echo"<center><span style=\"color:red;position:fixed;left:210px;top:107px;\">Error Updating <span 
			style=\"color:blue;text-align:center;\">$title </span></span></center>";
			echo $update;
			exit();
			}
		}
	}
	//****editbook starts****//
	

function addbook($an,$callno,$authors,$title,$p,$pd,$pp,$edition,$price,$page,$volume,$source,$billno,$sub,$category,$type,$remark,$count,$imagename,$ext,$temp_name)
	{				
		if($ext == "" or $imagename == "" or $an == "" or $callno == "" or $authors == "" or $title == "" or $p == "" or $edition == ""or $source == 
				"" or $sub == "" or $category == "" or $type == "" or $count == "")
				{
					echo "<h3 class =\"alert alert-info\"><center><span style=\"color:black;text-align:center;\">Not Enough Values to Add Book.<br><span style=\"color:red;text-align:center;\">(Note: * fields are Compulsory !)</span></span></center></h3>";
					exit();
				}
				else
				{								
					$i = 0;
					while($i != ($count-1))
					{		
						$typeSaved = $type;
						date_default_timezone_set("Asia/Kolkata"); 
						$time = date('l, jS F Y, h:i:s A',time()+900);						
						
						if($i == 0)
						{
							$an = generate_randan();     						
							$type = "Reference";
							$query_addbook = mysql_query("insert into books_info 
						values(1,'$an','$callno','$authors','$title','$p','$pd','$pp','$edition','$price','$page',
						'$volume','$source','$billno','$sub','$category','$type','$remark','$time','$imagename','')");	
							
							$res = mysql_query("SELECT * from books_info where accession_no = '$an'");
					
							$action = "Add_Book";
							$item = "$an";
							$desc = "Added Successfully:Data=".getJSON($res);
						
							//$libid = $rowmember['lib_id'];
							//logMember($libid,$action,$item,$desc);
							logStaff($action,$item,$desc);
							logSystem($action,$item,$desc);	
							}	
							if($count == 1)
							{
								echo"<h3 class=\"alert alert-info\"><center><font color=\"purple\">$title</font> by  <font color=\"purple\">$authors</font>"." Added Successfully !<br><br>";
					echo '<a href = "index.php?action=addbook&an='.$an.'" class = "btn btn-warning" title = "Click to Add More Books Same">Add More Same</a>
						  <a href = "'.site_url.'" class = "btn btn-info" >Done</a></center>';		
								exit;
								
							}
						
						$type = $typeSaved;
						$an = generate_randan();
						$precover = $imagename;
						$imagename= $an."_".$callno."_".date("d-m-Y")."_".time().$ext;
						//echo $imagename;exit;
						
						if(copy("source/images/books/".$precover,"source/images/books/".$imagename)){						
												
						$query_addbook = mysql_query("insert into books_info 
						values(1,'$an','$callno','$authors','$title','$p','$pd','$pp','$edition','$price','$page',
						'$volume','$source','$billno','$sub','$category','$type','$remark','$time','$imagename','')");
						
						$res = mysql_query("SELECT * from books_info where accession_no = '$an'");					
						$action = "Add_Book";
						$item = "$an";
						$desc = "Added Successfully:Data=".getJSON($res);
						logStaff($action,$item,$desc);
						logSystem($action,$item,$desc);	
						$i++;
					}else{
						echo "Main Cover:$imagename<br>";
						echo "Cover Formation  Error"; exit;
						}
					}				
				if($query_addbook)		
				{
					
					echo"<h3 class=\"alert alert-info\"><center><font color=\"purple\">$title</font> by  <font color=\"purple\">$authors</font>"." Added Successfully !<br><br>";
					echo '<a href = "index.php?action=addbook&an='.$an.'" class = "btn btn-warning" title = "Click to Add More Books Same">Add More Same</a>
						  <a href = "'.site_url.'" class = "btn btn-info" >Done</a></center>';					
				}
				else
				{
					echo"<center><font color = \"red\">Error adding Book !</font></center></h3>";
					
				}				
			}				

	}
	function return_AllBooks($libid)
	{			

		$sqlmem = mysql_query("SELECT * from members_info where lib_id = '$libid'"); //search valid member availiabilty			
		$rowmember = mysql_fetch_array($sqlmem); //fetch member data
		if(!$rowmember) 
		{
			echo 'No Member with ID : '.$libid.' !';
			 exit;			
		}
		if($rowmember)		
		{		
			$allan = mysql_query("SELECT accession_no from  issued where lib_id = '$libid'");
			$books =  array();
			
			while($ans  = mysql_fetch_array($allan))
			{			
				$an = $ans['accession_no'];				
				$books['book'] = $an;
				$bookreturn = mysql_query("UPDATE `books_info` SET `flag` = '1' WHERE `books_info`.`accession_no` = '$an'");
			}
			$clearbook = mysql_query("DELETE from issued where lib_id = '$libid'");		
			if($clearbook){
				
					$data = json_encode($books);
					$action = "Delete_Books";
					$item = "Books";
					$desc = "Deleted Successfully:Books:$data";
					
					//$libid = $rowmember['lib_id'];
					//logMember($libid,$action,$item,$desc);
					logStaff($action,$item,$desc);
					logSystem($action,$item,$desc);	
			echo '<center><h3 class="alert alert-info">All Books returned Back by : <a href="index.php?action=memberstatus&libid='.$rowmember['lib_id'].'"><font 
			color="blue">'.$rowmember['fname']." ".$rowmember['lname'].'('.$libid.')'.'</a></font><br></font><br><br><input class ="btn btn-info" type="button" onclick="Javascript: history.go(-1)" value="Go Back" 
			name="back"></h3></center>';							
			exit;
			}
		}else
		{
			echo '<center><h3 class="alert alert-info"><font color="red">Error:</font>  No  Book issued by <font color="blue"><a href="memberstatus.php?libid='.$rowmember['lib_id'].'">'.$rowmember['fname']." ".$rowmember['lname'].' ('.$libid.')'.'</a></font></center></h3>';					
			exit;
		}	
			
	}
	function return_book($an)
	{	
		$sqlbook = mysql_query("SELECT * from books_info where accession_no = '$an'"); // search book in db
		$sqlmem = mysql_query("SELECT * from members_info where lib_id = (select lib_id from issued where accession_no = '$an') "); //search valid member availiabilty	
		$rowbook = mysql_fetch_array($sqlbook); //fetch book data
		$rowmember = mysql_fetch_array($sqlmem); //fetch member data
		$libid = $rowmember['lib_id'];
		if(!$rowmember) 
		{
			
			echo '<center><h3 class="alert alert-danger">Oops ! Something Wrong here ! </h3></center>';
			exit();
			
		}
		$checkbook = mysql_query("SELECT * from issued where lib_id = ".$rowmember['lib_id']." and accession_no = '$an'");		
		if($checkbook)
		{		
			$bookreturn = mysql_query("UPDATE  `books_info` SET `flag` = '1' WHERE `books_info`.`accession_no` = '$an'");
			$clearbook = mysql_query("DELETE from issued where accession_no = '$an'");		
			if($bookreturn and $clearbook){
				
					$res = mysql_query("SELECT * from books_info where accession_no = '".$rowbook['accession_no']."'");
					$action = "Return_Book";
					$item = "AN:(".$rowbook['accession_no'].")";
					$desc = "Returned:Data=".getJSON($res);					
					logMember($libid,$action,$item,$desc);
					logStaff($action,$item,$desc);
					logSystem($action,$item,$desc);	
						
			echo '<center><h3 class="alert alert-info">Book : <font color="purple">'.$rowbook['title'].'</font> Returned By : <a href="index.php?action=memberstatus&libid='.$rowmember['lib_id'].'"><font color="blue">'.$rowmember['fname']." ".$rowmember['lname'].'('.$libid.')'.'</a></font><br></font> 
			<br><br>
			<a class ="btn btn-primary" href="'.site_url.'/index.php?action=viewAllIssues">Okay</a></h3></center>';			
			}
		}
		else
		{
			echo '<center><h3 class="alert alert-info"><font color="red">Error:</font>  No  Book titled with <font color="purple">'.$rowbook['title'].'
			</font>  issued by <font color="blue"><a href="index.php?action=memberstatus&libid='.$rowmember['lib_id'].'">'.$rowmember['fname']." ".$rowmember['lname'].' ('.$libid.')'.'</a></font></center></h3>';	
			
		}	
	}
	function checkReferene($an)
	{
		$query = mysql_query("SELECT type from books_info where accession_no = '$an' and flag = 1"); //search availaibe book
		$type = mysql_fetch_array($query);
		if($type['type'] == 'Reference'){
			return false;
		}else
		return true;
	}		
	
	function issuebook($an,$libid,$duedate)
	{	

		$sqlbook = mysql_query("SELECT * from books_info where accession_no = '$an' and flag = 1"); //search availaibe book
		$sqlbook1 = mysql_query("SELECT * from books_info where accession_no = '$an' and flag = 0"); //check book status
		$sqlmem = mysql_query("SELECT * from members_info where lib_id = '$libid'"); //search member availiabilty	
		$rowbook = mysql_fetch_array($sqlbook); //get book data
		$rowbook1 = mysql_fetch_array($sqlbook1); 
		$rowmember = mysql_fetch_array($sqlmem); //get member data
		
		if(!checkAdmin())
		{
			if(!checkReferene($an))
			{
				echo '<center><h3 class="alert alert-danger">Reference Book cannot be issued under ordinary Circumstances ! Contact Head Librarian.</h3>
				</center>';
				exit;
			}
		}
			$countBooks = mysql_fetch_array(mysql_query("select count(id) from issued where lib_id='$libid'"));		
			$no = $countBooks[0];				
			if($no >= controlBook($libid))
			{
				echo '<h3 class="alert alert-info"><center>Member <font color="purple">'.$rowmember['fname']." ".$rowmember['lname'].' </font>\'s maximum  permissible number of books(Current Count : <font color="purple">'.$countBooks[0].'</font> / <font color="purple">'.$no.'</font> ) 
					occupied ! <br>Cannot Issue !';			
				echo '<br><br><a class="btn btn-primary" href = "index.php?action=memberstatus&libid='.$libid.'" >Veiw Issues</a>';
				exit;
			}		
		
		if(!$rowbook and !$rowbook1)
		{
			echo '<h3 class="alert alert-info"><center>Book  with Accession Number:<font color="purple">'.$an.' </font> is not in the Library !';			
			exit;
		}	
		if(!$rowbook and $rowbook1)
		{
			echo '<h3 class="alert alert-info"><center>Book  with Accession Number:<font color="purple"> '.$an.' </font>is already Issued. !';			
			exit;
		}	
		if(!$rowmember)
		{
			echo '<h3 class="alert alert-info"><center>No Member with ID :<font color="purple"> '.$libid.'</font> !</h3>';			
			exit;
		}	
		$staff = $_SESSION['fname']." ".$_SESSION['lname']; //get issuer name
		date_default_timezone_set("Asia/Kolkata"); 
		$time = date('l, jS F Y, h:i:s A',time()+900);
		$callno = $rowbook['call_no']; //book code 
		$title = $rowbook['title'];
				
		$issue = mysql_query("INSERT INTO `issued`(`id`,`title`, `accession_no`, `call_no`, `lib_id`, `issued_date`, `due_date`, `issued_by`,`status`) VALUES ('','$title', '$an','$callno','$libid','$time','$duedate','$staff','')");
		if(!$issue)
		{
			echo '<h3 class ="alert alert-info"><center><font color="red">Warning :</font><a  href="index.php?action=bookstatus&an='.$an.'" title="View All Issues of '.$rowbook['title'].'"> <font color="purple">
			'.$rowbook['title'].'</font></a>  is already issued by <font color="purple">'.$rowmember['fname']." ".$rowmember['lname'].' ('.$libid.')';	
			echo '<br><br>Policy</font> :  One copy per Member. <br><br>
				<a class ="btn btn-primary"  href = "index.php?action=memberstatus&libid='.$libid.'">View '.$rowmember['fname'].' \'s Issues</a></center></h3>';

			exit;
		}
		else
		{
			$sql = mysql_query("UPDATE books_info SET flag = '0' WHERE `books_info`.`accession_no` = '$an'");
			
					$res = mysql_query("SELECT * from books_info where accession_no = '".$rowbook['accession_no']."'");
					$action = "Issue_Book";
					$item = "AN:(".$rowbook['accession_no'].")";
					$desc = "Issued Successfully:Data=".getJSON($res);
					$libid = $rowmember['lib_id'];
					logMember($libid,$action,$item,$desc);
					logStaff($action,$item,$desc);
					logSystem($action,$item,$desc);		
			
		echo '<center><h3 class="alert alert-info">Book :<a href="index.php?action=bookstatus&an='.$an.'" title="View All '.$rowbook['title'].' Books"> <font color="purple">'.$rowbook['title'].'</font></a> Issued To :<a href="index.php?action=memberstatus&libid='.$rowmember['lib_id'].'"><font color="blue">'.$rowmember['fname']." ".$rowmember['lname'].'</a>('.$libid.')'.'</font><br><br>Return Date:<font color="purple">'.$duedate.'</font>
		<br><br><input class ="btn btn-primary" type="button" onclick="Javascript: window.print()" value="Print" name="print"></h3></center>';
		}			
			
	}

?>
