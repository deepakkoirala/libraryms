<?php
	include('includes/constants.php');
	include('includes/database.php');
	session_start();
	error_reporting(1);	
	if(!checkAdmin())
	{
		header('location:'.site_url.'/admin/login_form.php');	
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
		$rand = rand(1,50000);													
		$query = mysql_query("SELECT * from books_info WHERE accession_no = $rand"); 
		if(mysql_num_rows($query)>0) 
		{
			 generate_randan(); 
		}
		else return $rand;
	}
//***********************************Functions of Operations***********************************************************************************

function totalMembers()
{
	$mems = mysql_fetch_array(mysql_query("select count(lib_id) from members_info"));
	return $mems[0];					
}
function totalBooks()
{
	$books = mysql_fetch_array(mysql_query("select count(accession_no) from books_info"));
	return $books[0];				
}
function totalIssues()
{
	$issues = mysql_fetch_array(mysql_query("select count(id) from issued"));
	return $issues[0];					
}	

function checkAdmin()
{				
	session_start();
	$email = $_SESSION['email'];
	if(!$email){return false;exit;}
	$check = mysql_fetch_array(mysql_query("SELECT position from staffs_info where email = '$email'"));
	$position = $check[0];			
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
			echo ' <h3 class = "alert alert-info"> <center>New Staff <font color = "purple">'.$fname.' '.$lname.'</font> added Successfully! ';	
			echo '<br><br><center><a class="btn btn-primary" href = "index.php">Done</a></center></h3>';	
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
		date_default_timezone_set("Asia/Kolkata"); 
		$time = date('l, jS F Y, h:i:s A',time()+900);
		$update = mysql_query("UPDATE  staffs_info set fname = '$fname',lname = '$lname' , email = '$email', password = '$password',phone = '$phone',sex = '$sex',temporary_address = '$add1',permanent_address = '$add2',position = '$position',date_joined = '$time' where email = '$email'");
		
		if($update)	
		{
			echo ' <h3 class = "alert alert-info"> <center>Staff<a href="Staffdetails.php?Username=$fname"><font color ="blue"> '.$fname.' '.$lname.' </font></a>updated Successfully! ';	
			echo '<br><br><center><input type="button" value = "Back" class="btn btn-primary" onclick="Javascript:history.go(-2)"></center></h3>';	
		}
	}
	function deleteuser($user)
	{
		$delete = mysql_query("DELETE from staffs_info where email ='$user'");
		if($delete)
		{
			echo ' <h3 class = "alert alert-info"> <center>Deleted Successfully !<br>';	
			echo '<center><input type="button" value = "Login" class="btn btn-primary" onclick="Javascript:history.go(-1)"></center></h3>';
			header("location:login.php");
			session_destroy();

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
            echo'<center><span style="color:red;">Not enough information to search Book!</span><center>';
			exit();            	   
        }
		$query = mysql_query("SELECT * from books_info WHERE accession_no = '$real_an'");		 	
		while($res = mysql_fetch_array($query))
		{					

			include 'includes/editbookdetails_form.php';
			exit();
		}
				echo " <center>Book not Found (Accession Number) :<font color=\"red\">".$real_an."</font><center>";
				// search book ends here...(for edit)		
	}
	
	if(isset($_POST['updatebook']))
	{			
		$an = mysql_real_escape_string($_POST['txtan']);
		$callno = mysql_real_escape_string($_POST['txtcallno']);
		$authors = mysql_real_escape_string($_POST['txtauthors']);
		$title = mysql_real_escape_string($_POST['txttitle']);
		$p = mysql_real_escape_string($_POST['txtp']);
		$pd = mysql_real_escape_string($_POST['txtpd']);
		$pp = mysql_real_escape_string($_POST['txtpp']);
		$edition = mysql_real_escape_string($_POST['txtedition']);
		$price = mysql_real_escape_string($_POST['txtprice']);
		$page = mysql_real_escape_string($_POST['txtpage']);
		$volume = mysql_real_escape_string($_POST['txtvolume']);
		$source = mysql_real_escape_string($_POST['txtsource']);
		$billno = mysql_real_escape_string($_POST['txtbillno']);
		$sub = mysql_real_escape_string($_POST['txtsubject']);
		$category = mysql_real_escape_string($_POST['txtcategory']);
		$type = mysql_real_escape_string($_POST['txttype']);
		$remark = mysql_real_escape_string($_POST['txtremark']);
		
		editbook($an,$callno,$authors,$title,$p,$pd,$pp,$edition,$price,$page,$volume,$source,$billno,$sub,$category,$type,$remark);
	}
		
	function searchedmember_form($txtlibid)	
	{
		if($txtlibid== "")
		{
      		echo'<center><span style="color:red;">Error:</span> Library ID not Entered to search Member !<center>';
			exit();            	   
       	}				
			$query = mysql_query("SELECT * from members_info WHERE lib_id = '$txtlibid'");			 	
			if($query)
			{
				while($res = mysql_fetch_array($query))
				{
					include 'includes/editmemberdetails_form.php';
				}				
			}
			else
			{			
				echo " <center>Member not found (Library ID) : <font color=\"red\">".$txtlibid."</font><center>";
			}
	}
	if(isset($_POST['update']))
	{
		$fname = mysql_real_escape_string($_POST['txtfname']);
		$lname = mysql_real_escape_string($_POST['txtlname']);
		$libid = mysql_real_escape_string($_POST['txtlibid']);
		$mobile = mysql_real_escape_string($_POST['txtmobile']);
		$email = mysql_real_escape_string($_POST['txtemail']);
		$password = mysql_real_escape_string($_POST['txtpass']);
		$add1 = mysql_real_escape_string($_POST['txtadd1']);
		$add2 = mysql_real_escape_string($_POST['txtadd2']);
		$father = mysql_real_escape_string($_POST['txtfather']);
		$batch = mysql_real_escape_string($_POST['txtbatch']);
		$cat = mysql_real_escape_string($_POST['category']);
		
		editmember($fname,$lname,$libid,$mobile,$email,$password,$add1,$add2,$father,$batch,$cat);
	}
	function deletemember($libid)
	{
		if($libid == null)
				{
        	      echo'<center>Not Enough Information to Perform Deletion !<center>';
				  exit();            	   
             	}
				else
				{
					$checkmem = mysql_query("SELECT * FROM members_info where lib_id = '$libid'");
					$mem = mysql_fetch_array($checkmem);
					if(mysql_num_rows($checkmem) == 0)
					{				
						echo "<h3 class = \"alert alert-info\"><center>Member with ID<font color=\"red\"> $libid </font>doesn't exist in our Database !</center>";
						echo '<br><center><a class ="btn btn-primary" onclick ="Javascript:history.go(-1);">Back</a></center></h3>';
						exit();
					}
					$checkIssue = mysql_fetch_array(mysql_query("SELECT * from issued where lib_id = '$libid'"));										
					if(count($checkIssue)==1)
					{
						echo"<h3 class = \"alert alert-info\"><center>Deleted Successfully Member <font color=\"blue\">$mem[1] $mem[2]</font> with Id:<font color=\"red\">".$libid."</font></center>";	
						echo '<br>';
						echo '<center><a class = "btn btn-primary" href="index.php">Okay</a></center></h3>';
						//$del_issue = mysql_query("DELETE FROM issued where lib_id ='$libid'");
						$delete = mysql_query("Delete from members_info WHERE lib_id = '$libid'");	
					}else
					{
						echo"<h3 class = \"alert alert-info\"><center><font color=\"red\">Error:</font> Member
						 <a href = \"memberstatus.php?libid=".$libid."\">
						 $mem[1] $mem[2]</a>(<font color=\"purple\">".$libid.")</font> has books to be returned back to library.<br><br>
						 <a class = \"btn btn-primary\" href = \"memberstatus.php?libid=".$libid."\">Check Books</a></center></h3>";
					 }	
					
				mysql_close($connect);
			}
	}
	function editmember($fname,$lname,$libid,$mobile,$email,$password,$add1,$add2,$father,$batch,$cat)
	{
		if($fname == "" or $lname == "" or $mobile == "" or $email == "" or $password == "" or $add1 == "" or $cat == "")
				{
					echo "<center><span style=\"color:red;text-align:center;\">Not Enough Values to Update.<br>(Note: * fields are Compulsory !)</span></center>";
					exit();
				}
				else
				{	
					
					$query_addmember = mysql_query("UPDATE members_info SET `fname` = '$fname',`lname` = '$lname',`mobile_number` = '$mobile',`email` = '$email',`password`='$password',`temporary_address` = '$add1',`permanent_address` = '$add2',
`father_name` = '$father',`batch` = '$batch',`category` = '$cat' WHERE `members_info`.`lib_id` ='$libid'");
				
				if($query_addmember)		
				{
					echo"<h3 class = \"alert alert-info\"<br><center>Member <a href = \"index.php?action=ViewMember&lib_id=$libid\"><span style=\"color:blue;text-align:center;\">$fname $lname</span></a>"." Updated Successfully !</center>";
					echo '<br><br><center><a class = "btn btn-primary" href="index.php">Okay</a></center></h3>';
					exit();
				}
				else
				{
					echo"<center><span style=\"color:red;position:fixed;left:210px;top:107px;\">Error Updating <span style=\"color:blue;text-align:center;\">$fname $lname !</span></span></center>";
					exit();
				}				
			}
	}
	function addmember($fname,$lname,$libid,$mobile,$email,$password,$add1,$add2,$father,$batch,$cat)
	{
		if($fname == "" or $lname == "" or $mobile == "" or $email == "" or $add1 == "" or $cat == "")
		{
			echo "<center><span style=\"color:black;text-align:center;\">Not Enough Values to Add Member.<br><span 
			style=\"color:red;text-align:center;\">(Note: * fields are Compulsory !)</span></span></center>";
			exit();
		}
		else
		{	
			$query_addmember = mysql_query("INSERT INTO `members_info`(`id`, `fname`, `lname`, `lib_id`, `mobile_number`, `email`, `password`,`temporary_address`, `permanent_address`, `father_name`, `batch`, `category`) VALUES ('','$fname','$lname','$libid','$mobile','$email','$fname','$add1','$add2','$father','$batch','$cat')");
		
			if($query_addmember)		
			{
				echo"<center><span style=\"color:blue;text-align:center;\">
				<a href=\"memberstatus.php?libid=".$libid."\" target=\"_top\">$fname $lname</a></span>"." Added Successfully !</center>"
				;
				echo"<center>Libraray ID = <span style=\"color:blue;text-align:center;\">$libid</span>"."</center>";
				exit();
			}
			else
			{
				echo"<center><span style=\"color:red;\">Error adding member !</span></center>";
				exit();
			}
		}
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
			if(!$checkBook)
			{
				echo "<center><h3 class=\"alert alert-info\">Warning:No such Book with Accession Number:<span style=\"color:red;\"> $an </span>found in the Database !<br><br>
					<a href=\"index.php\" class = \"btn btn-primary\">Okay</a></center><h3>";						
				exit();
			}
			$checkIssue=mysql_fetch_array(mysql_query("SELECT * from issued where accession_no = '$an'"));
			if($checkIssue)
			{				
				echo "<center><h3 class=\"alert alert-info\">Warning:Issued Book<span style=\"color:red;\"> $an </span>cannot be deleted !<br><br>
					<a href=\"Javascript:history.go(-1)\" class = \"btn btn-primary\">Go Back</a></center><h3>";						
				exit();
			}
			else
			{
				$book = mysql_fetch_row($checkbook);
				$deletebook = mysql_query("Delete from books_info WHERE accession_no = '$an'");
				echo'<h3 class ="alert alert-info"><center>Deleted Successfully Book <font color="blue">'.$book[3].'</font> by <font color="blue">'.$book[2].'
				</font>.<br>Accession Number:<font color="blue">'.$an."</font><br>
				<a class=\"btn btn-primary\" href=\"index.php\">Refresh Page !</a></center></h3>";
				exit();	
			}					
			mysql_close($connect);
		}
	}
	//****editbook starts****//
	function editbook($an,$callno,$authors,$title,$p,$pd,$pp,$edition,$price,$page,$volume,$source,$billno,$sub,$category,$type,$remark)
	{	
		
		if($an == "" or $callno == "" or $authors == "" or $title == "" or $p == "" or $edition == "" or $source == "" or $sub == "" or 
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
			echo"<h3 class =\"alert alert-info\"><center>Book <span style=\"color:blue;text-align:center;\">$title</span> by <font color=\"blue\">$authors</font>"." 
			Updated Successfully !<br><br><a class =\"btn btn-primary\" href=\"bookstatus.php?AccessionNumber=".$an."\">Okay</a></center></h3>";
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

	function addbook($an,$callno,$authors,$title,$p,$pd,$pp,$edition,$price,$page,$volume,$source,$billno,$sub,$category,$type,$remark,$count)
	{				
				if($an == "" or $callno == "" or $authors == "" or $title == "" or $p == "" or $edition == ""or $source == 
				"" or $sub == "" or $category == "" or $type == "" or $count == "")
				{
					echo "<h3 class =\"alert alert-info\"><center><span style=\"color:black;text-align:center;\">Not Enough Values to Add Book.<br><span style=\"color:red;text-align:center;\">(Note: * fields are Compulsory !)</span></span></center></h3>";
					exit();
				}
				else
				{				
					 
					$searchan= mysql_query("SELECT * FROM books_info where accession_no = '$an'"); //searching if the book already exists
					$row = mysql_fetch_array($searchan);
					if(mysql_num_rows($searchan) > 0)
					{
						echo "<h3 class = \"alert alert-info\"><center>Book with Accession Number <font color=\"purple\">$an</font> and Title <font color=\"purple\">'".$row['title']."'</font>
						 by <span style=\"color:purple\">".$row['authors']."</span> already exists !<br>
						Duplicate Entry is not Allowed !</center></h3>";
						exit();
					}
					$i = 0;
					while($count>$i){		
					$typeSaved = $type;
					date_default_timezone_set("Asia/Kolkata"); 
					$time = date('l, jS F Y, h:i:s A',time()+900);
					$an = generate_randan();
					if($i == 0)
					{
						$type = "Reference";
						$query_addbook = mysql_query("insert into books_info 
					values('',1,'$an','$callno','$authors','$title','$p','$pd','$pp','$edition','$price','$page',
					'$volume','$source','$billno','$sub','$category','$type','$remark','$time')");	
					}
					date_default_timezone_set("Asia/Kolkata"); 
					$time = date('l, jS F Y, h:i:s A',time()+900);
					$type = $typeSaved;
					$query_addbook = mysql_query("insert into books_info 
					values('',1,'$an','$callno','$authors','$title','$p','$pd','$pp','$edition','$price','$page',
					'$volume','$source','$billno','$sub','$category','$type','$remark','$time')");					
					

					$i++;
				}
				
				if($query_addbook)		
				{
					echo"<h3 class=\"alert alert-info\"><center><font color=\"purple\">$title</font> by  <font color=\"purple\">$authors</font>"." Added Successfully !<br><br>";
					echo '<a href = "index.php?action=addbook&an='.$an.'" class = "btn btn-warning" title = "Click to Add More Books Same">Add More Same</a>
						  <a href = "index.php" class = "btn btn-info" >Done</a></center>';					
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
			while($ans  = mysql_fetch_array($allan))
			{			
				$an = $ans['accession_no'];				
				$bookreturn = mysql_query("UPDATE  `books_info` SET `flag` = '1' WHERE `books_info`.`accession_no` = '$an'");
			}
			$clearbook = mysql_query("DELETE from issued where lib_id = '$libid'");		
			
			echo '<center><h3 class="alert alert-info">All Books returned Back by : <a href="memberstatus.php?libid='.$rowmember['lib_id'].'"><font 
			color="blue">'.$rowmember['fname']." ".$rowmember['lname'].'('.$libid.')'.'</a></font><br></font><br><br><input class ="btn btn-info" type="button" onclick="Javascript: history.go(-1)" value="Go Back" 
			name="back"></h3></center>';				
			exit;
		}else
		{
			echo '<center><h3 class="alert alert-info"><font color="red">Error:</font>  No  Book issued by <font color="blue"><a href="memberstatus.php?libid='.$rowmember['lib_id'].'">'.$rowmember['fname']." ".$rowmember['lname'].' ('.$libid.')'.'</a></font></center></h3>';					
			exit;
		}	
			
	}
	function return_book($an,$libid)
	{	
		$sqlbook = mysql_query("SELECT * from books_info where accession_no = '$an'"); // search book in db
		$sqlmem = mysql_query("SELECT * from members_info where lib_id = '$libid'"); //search valid member availiabilty	
		$rowbook = mysql_fetch_array($sqlbook); //fetch book data
		$rowmember = mysql_fetch_array($sqlmem); //fetch member data
		if(!$rowmember) 
		{
			echo 'No Member with ID : '.$libid.' !'; exit();
			
		}
		$checkbook = mysql_fetch_array(mysql_query("SELECT * from issued where lib_id = '$libid' and accession_no = '$an'"));		
		if($checkbook)
		{		
			$bookreturn = mysql_fetch_array(mysql_query("UPDATE  `books_info` SET `flag` = '1' WHERE `books_info`.`accession_no` = '$an'"));
			$clearbook = mysql_fetch_array(mysql_query("DELETE from issued where accession_no = '$an'"));		
						
			echo '<center><h3 class="alert alert-info">Book : <font color="purple">'.$rowbook['title'].'</font> Returned Back by : <a href="memberstatus.php?libid='.$rowmember['lib_id'].'"><font 
			color="blue">'.$rowmember['fname']." ".$rowmember['lname'].'('.$libid.')'.'</a></font><br></font><br><br><input class ="btn btn-info" type="button" onclick="Javascript: history.go(-1)" value="Go Back" 
			name="back"></h3></center>';			
		}
		else
		{
			echo '<center><h3 class="alert alert-info"><font color="red">Error:</font>  No  Book titled with <font color="purple">'.$rowbook['title'].'
			</font>  issued by <font color="blue"><a href="memberstatus.php?libid='.$rowmember['lib_id'].'">'.$rowmember['fname']." ".$rowmember['lname'].' ('.$libid.')'.'</a></font></center></h3>';	
			
		}	
	}
	
	
	function issuebook($an,$libid,$duedate)
	{	
		$sqlbook = mysql_query("SELECT * from books_info where accession_no = '$an' and flag = 1"); //search availaibe book
		$sqlbook1 = mysql_query("SELECT * from books_info where accession_no = '$an' and flag = 0"); //check book status
		$sqlmem = mysql_query("SELECT * from members_info where lib_id = '$libid'"); //search member availiabilty	
		$rowbook = mysql_fetch_array($sqlbook); //get book data
		$rowbook1 = mysql_fetch_array($sqlbook1); 
		$rowmember = mysql_fetch_array($sqlmem); //get member data

		//date.timezone(Nepal);
		$countBooks =mysql_fetch_array(mysql_query("select count(id) from issued where lib_id='$libid'"));		
		$no = $countBooks[0];				
		if($no==6)
		{
			echo '<h3 class="alert alert-info"><center>Member <font color="purple">'.$rowmember['fname']." ".$rowmember['lname'].' </font> has already maximum number of books(Count = <font color="purple">'.$countBooks[0].'</font>) issued !';			
			echo '<br><br><a class="btn btn-primary" href = "memberstatus.php?libid='.$libid.'" >Veiw Issued Books</a>';
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
		$time = date('l, jS F Y, h:i:s A',time()+900);			// time of issue
		$callno = $rowbook['call_no']; //book code 
		$title = $rowbook['title'];
				
		$issue = mysql_query("INSERT INTO `issued`(`id`,`title`, `accession_no`, `call_no`, `lib_id`, `issued_date`, `due_date`, `issued_by`) VALUES ('','$title', '$an','$callno','$libid','$time','$duedate','$staff')");
		if(!$issue)
		{
			echo '<h3 class ="alert alert-info"><center><font color="red">Warning :</font> <font color="purple">
			'.$rowbook['title'].'</font>  is already issued by <font color="purple">'.$rowmember['fname']." ".$rowmember['lname'].' ('.$libid.')';	
			echo '!<br><br>Policy</font> :  One copy per Member. <br><br>
				<a class ="btn btn-warning"  href = "index.php" title = "Go Home">Okay</a></center></h3>';

			exit;
		}
		else
		{
			$sql = mysql_query("UPDATE  `books_info` SET `flag` = '0' WHERE `books_info`.`accession_no` = '$an'");
			
		echo '<center><h3 class="alert alert-info">Book : <font color="purple">'.$rowbook['title'].'</font> Issued To :<a href="memberstatus.php?libid='.$rowmember['lib_id'].'"><font color="blue">'.$rowmember['fname']." ".$rowmember['lname'].'</a>('.$libid.')'.'</font><br><br>Return Date:<font color="purple">'.$duedate.'</font>
		<br><br><input class ="btn btn-info" type="button" onclick="Javascript: window.print()" value="Print Info" name="print"></h3></center>';
		}			
			
	}
	

	function search_book($string)	
	{	
		echo '<center><font color = "purple">All Availaible Books</font></center>';
					echo"<table class=\"bookajax\" border=\"01px\"align=\"center\">";				
					echo"
						<tr>
							<th>
								Modify
							</th>
							<th>
								ID
							</th>
							<th>
								AN
							</th>
							<th>
								Book Code
							</th>
							<th>
								Authors
							</th>
							<th>
								Title
							</th>
							<th>
								Publisher
							</th>
							<th>
								Date Published
							</th>
							<th>
								Place Published
							</th>
							<th>
								Edition
							</th>
							<th>
								Price
							</th>
							<th>
								Pages
							</th>
							<th>
								Volume
							</th>
							<th>
								Source
							</th>
							<th>
								Bill No
							</th>
							<th>
								Subject
							</th>
							<th>
								Category
							</th>
							<th>
								Type
							</th>
							<th>
								Remark
 							</th>
						</tr>";
						
			$findbook = mysql_query("SELECT * from books_info where flag = 1 and title like '$string%' or accession_no like '$string'   order by title"); 
			$j = 1;
			while($fb = mysql_fetch_array($findbook))
			 {
				
			 	echo"<tr>
						<td>
						<a onclick=\"return edit_book()\" href=\"index.php?an=$fb[2]&action=edit\">Edit</a>
						<a onclick=\"return del_book()\" href=\"index.php?an=$fb[2]&action=del\">Delete</a>
						</td>
						<td>".$j;
					for($i = 0; $i < 17 ; $i++)
					{
						
						echo"<td>";
						if($i==3)
						{
							echo "<a target=\"_top\" href=\"bookstatus.php?AccessionNumber=$fb[2]\" title=\"Click to View Book Details\" id=\"bookdetails\">";							
						}
						if($i==0)
						{
							echo "<a target=\"_top\" href=\"index.php?action=issue&AccessionNumber=$fb[2]\" title=\"Click to Issue\" id=\"bookdetails\">";							
						}
						echo $fb[$i+2];
						echo "</td>";								
					}
					echo "</tr>";
					$j++;
					
			 }
							
		if(mysql_num_rows($findbook) == 0)
		{
			echo "<tr><td colspan=19 align=\"center\"><span style=\"color:green;\">No Such Book Exists !</span></td></tr>";
			echo "</table>";
			
		}	
	}
	
	function search_member($string)	
	{	
		//$string = mysql_real_escape_string($_POST["txtsearch"]);			
			
			//echo"<h1 align=\"center\">Information of Members</h1>";	 
			echo"<table  class=\"memberajax\" border=\"1px\"align=\"center\">";
			$i = 1;
				echo"<thead>
						<tr>
							<th>
								Modify
							</th>
							<th>
								ID
							</th>
							<th>
								First Name
							</th>
							<th>
								Last Name
							</th>
							<th>
								Library ID
							</th>
							<th>
								Mobile
							</th>
							<th>
								Email
							</th>
							<th>
								Password
							</th>							
							<th>
								Address-1
							</th>
							<th>
								Address-2
							</th>
							<th>
								Father
							</th>
							<th>
								Batch
							</th>
							<th>
								Category
							</th>
						</tr></thead>";
			$query = mysql_query("SELECT * from members_info WHERE fname like '$string%' or lib_id like '$string' order by fname");			
			while($result = mysql_fetch_array($query))
			 {													
					echo"<tbody>			
						<tr>
							<td>
								<a onclick=\"return edit_mem()\" href=\"index.php?lib_id=".$result['lib_id']."&action=edit\">Edit</a><a  onclick=\"return del_mem()\" href=\"index.php?lib_id=".$result['lib_id'
								]."&action=del\"> Delete</a>
							</td>
							<td>
								".$i++."</a>
							</td>
							<td> <a targer=\"_top\" title=\"View Details of $result[1]\"href=\"memberstatus.php?libid=$result[3]\">
								".$result['fname']."
							</td></a>
							<td>
								".$result['lname']."
							</td>
							<td>
								".$result['lib_id']."
							</td>
							<td>							
								".$result['mobile_number']."
							</td>
							<td><a title=\"Send Email to $result[1]\"href=\"mailto:$result[5]?Subject=Message From Librarian\">
								".$result['email']."
							</td>
							<td>
								".$result['password']."
							</td>
							<td>
								".$result['temporary_address']."
							</td>					
							<td>
								".$result['permanent_address']."
							</td>
							<td>
								".$result['father_name']."
							</td>
							<td>
								".$result['batch']."
							</td>
							<td>
								".$result['category']."
							</td>
						</tr></tbody>";											
		}
		if(!mysql_num_rows($query))
		{
			echo "<tr><td colspan=13><span style=\"color:green\">No Such Member Exists !</span></td></tr></tbody>";
			echo "</table>";
			
		}			
	}			
?>