<?php 
	error_reporting(0);
	include 'includes/login-check.php';
	include('includes/header.php');
	include"includes/operations.php";
?>
<div class="main">
<?php

if(isset($_REQUEST['action']))
{
	$action = $_REQUEST['action'];
		
	
	if($action == "staffdetails")
	{
		if($_REQUEST['email'])
		{
			include'staffdetails.php';
		}
	}
	
	if($action == "memberstatus")
	{
		if($_REQUEST['libid'])
		{
			include'memberstatus.php';
		}
	}
		
	if($action == "bookstatus")
	{
		if($_REQUEST['an'])
		{
			
			$an = $_REQUEST['an'];

			include 'bookStatus.php';
		}
	}
		
	if($action == "del")
	{		
		if($_REQUEST['lib_id'])
		{
			deletemember(mysql_real_escape_string($_REQUEST['lib_id']));		
		}
		if($_REQUEST['an'])
		{
			deletebook(mysql_real_escape_string($_REQUEST['an']));
		}
		if($_REQUEST['user'])
		{
			$result = deleteuser(mysql_real_escape_string($_REQUEST['user']));
			if($result)
			{
			echo ' <h3 class = "alert alert-info"> <center>Deleted Successfully !<br>';	
			echo '<center><input type="button" value = "Login" class="btn btn-primary" onclick="Javascript:history.go(-1)"></center></h3>';
			}
			else
			{
				echo  '<h3 class ="alert alert-info"><center>Error Deleting</center>';
			}
			
		}
	} 
	if($action == "refreshLibrary")
	{
		header("Location: index.php");
	}
	if($action == "DeleteBooks")
	{
		$callno = mysql_real_escape_string($_GET['callno']);
		deleteBooks($callno);
	} 
	if($action == "viewAllIssues")
	{
		viewAllIssues();
	} 
	if($action == "ViewMember")
	{		
		if($_REQUEST['lib_id'])
		{
			search_member(mysql_real_escape_string($_REQUEST['lib_id']));		
		}		
	} 
	if($action == "edit")
	{	
		if($_REQUEST['lib_id'])
		{		
			searchedmember_form(mysql_real_escape_string($_REQUEST['lib_id']));
		}
		if($_REQUEST['next']){
			$real_an = mysql_real_escape_string($_REQUEST['an']);
			$_SESSION['go'] = $_REQUEST['next'];
			//echo $_SESSION['go'];exit;			
			searchedbook_form($real_an);
			
		}
		if($_REQUEST['an'])
		{
			$real_an = mysql_real_escape_string($_REQUEST['an']);
			searchedbook_form($real_an);
		}
		if($_REQUEST['user'])
		{
			$email = mysql_real_escape_string($_REQUEST['user']);
			edituser($email);
		}
		
	}
	if($action == "issue")
	{
		if($_REQUEST['AccessionNumber'])
		{
			issued_form(mysql_real_escape_string($_REQUEST['AccessionNumber']));
		}
	}	
	if($action == "return")
	{
		$an = mysql_real_escape_string($_REQUEST['an']);		
		$libid = mysql_real_escape_string($_REQUEST['libid']);
		return_book($an,$libid);	
	}
	if($action == "ReturnAll")
	{		
		$libid = mysql_real_escape_string($_REQUEST['libid']);
		return_AllBooks($libid);	
	}	
	if($action == "lost")
	{
		$an = mysql_real_escape_string($_REQUEST['an']);
		$libid = mysql_real_escape_string($_REQUEST['libid']);	
		if(markLost($an,$libid)){
		 echo '<h3 class="alert alert-info" ><center>The Book has been Marked as Lost !
		 <br><br> <a class = "btn btn-primary" href="javascript: history.go(-1);" title = "Go Back">Go Back</a></center></h3>';
		}else{
			echo '<h3 class="alert alert-info" ><center>Something\'s not right. Try Later !
		 <br><br> <a class = "btn btn-primary" href="javascript: history.go(-1);" title = "Go Back">Go Back</a></center></h3>';
		}
	}	
	if($action == "signup")
	{
		include 'includes/signup_form.php';
	}	
	if($action == "addbook")
	{
		$real_an = mysql_real_escape_string($_REQUEST['an']);
		$query = mysql_query("SELECT * from books_info WHERE accession_no = '$real_an'");		 	
		while($res = mysql_fetch_array($query))
		{
			include 'includes/addbookdetails_form.php';			
		}		
	}	
}
// All actions Ended @ here

	if(isset($_POST['edituser']))
	{
		$fname = mysql_real_escape_string($_POST['fname']);
		$lname = mysql_real_escape_string($_POST['lname']);
		$email = mysql_real_escape_string($_POST['email']);
		$password = mysql_real_escape_string($_POST['password']);
		$phone = mysql_real_escape_string($_POST['phone']);
		$sex = mysql_real_escape_string($_POST['sex']);
		$add1 = mysql_real_escape_string($_POST['add1']);
		$add2 = mysql_real_escape_string($_POST['add2']);
		$position = mysql_real_escape_string($_POST['position']);

		$time = time();

		edituserdetails($fname,$lname,$email,$password,$phone,$sex,$add1,$add2,$position,$time);
	}
	if(isset($_POST['adduser']))
	{
		$fname = mysql_real_escape_string($_POST['fname']);
		$lname = mysql_real_escape_string($_POST['lname']);
		$email = mysql_real_escape_string($_POST['email']);
		$password = mysql_real_escape_string($_POST['password']);
		$phone = mysql_real_escape_string($_POST['phone']);
		$sex = mysql_real_escape_string($_POST['sex']);
		$add1 = mysql_real_escape_string($_POST['add1']);
		$add2 = mysql_real_escape_string($_POST['add2']);
		$position = mysql_real_escape_string($_POST['position']);	
		$time = time();

		adduser($fname,$lname,$email,$password,$phone,$sex,$add1,$add2,$position,$time);

	}

	// Operations : search, add/delete book/member, edit boook/member starts from here:	


	
	if(isset($_POST["search_member"]))
	{
		$string = mysql_real_escape_string($_POST["txtsearch"]);		
		include'search_member.php';
	}	

	if(isset($_POST["search_book"]))
	{
		$string = mysql_real_escape_string($_POST["txtsearch"]);
		include 'search_book.php';		
	}

	if(isset($_POST["btn_IssueBook"]))
	{
		 include "includes/issue_form.php";
	}
	if(isset($_POST['issue']))
	{
		$an = parseNum(trim(mysql_real_escape_string($_POST['txtan'])));
		$libid = parseNum(trim(mysql_real_escape_string($_POST['txtlibid'])));
		$duedate = mysql_real_escape_string($_POST['txtduedate']);
		issuebook($an,$libid,$duedate);
	}
	if(isset($_POST["btn_ReturnBook"]))
	{
		include "includes/returnbook_form.php";
	}
	if(isset($_POST['return']))
	{
		$an = parseNum(trim(mysql_real_escape_string($_POST['txtan'])));
		//$libid = parseNum(trim(mysql_real_escape_string($_POST['txtlibid'])));
		return_book($an);
	}

	if(isset($_POST["btn_AddBook"]))
	{
		include "includes/addbook_form.php";
	}
	if(isset($_POST["addbook"]))
	{
		$an = mysql_real_escape_string($_POST['txtan']);
		$callno = mysql_real_escape_string($_POST['txtcallno']);
		$authors = mysql_real_escape_string($_POST['txtauthors']);
		$title = mysql_real_escape_string($_POST['txttitle']);
		$p = mysql_real_escape_string($_POST['txtpublisher']);
		$pd = mysql_real_escape_string($_POST['txtpublisheddate']);
		$pp = mysql_real_escape_string($_POST['txtpublishedplace']);
		$edition = mysql_real_escape_string($_POST['txtedition']);
		$price = mysql_real_escape_string($_POST['txtprice']);
		$page = mysql_real_escape_string($_POST['txtpages']);
		$volume = mysql_real_escape_string($_POST['txtvolume']);
		$source = mysql_real_escape_string($_POST['txtsource']);
		$billno = mysql_real_escape_string($_POST['txtbillno']);
		$sub = mysql_real_escape_string($_POST['txtsubject']);
		$category = mysql_real_escape_string($_POST['txtcategory']);
		$type = mysql_real_escape_string($_POST['txttype']);
		$remark = mysql_real_escape_string($_POST['txtremark']);
		$count = mysql_real_escape_string($_POST['txtcount']);
		
		if (!empty($_FILES["uploadedimage"]["name"])) 
		{	 
	    $file_name=$_FILES["uploadedimage"]["name"];
	    $temp_name=$_FILES["uploadedimage"]["tmp_name"];
	    $imgtype=$_FILES["uploadedimage"]["type"];
	    $ext= GetImageExtension($imgtype);
	    $imagename= $an."_".$callno."_".date("d-m-Y")."_".time().$ext;
	    $target_path = "source/images/books/".$imagename;	 
		if(move_uploaded_file($temp_name, $target_path)){
		addbook($an,$callno,$authors,$title,$p,$pd,$pp,$edition,$price,$page,$volume,$source,$billno,$sub,$category,$type,$remark,$count,$imagename,$ext,$temp_name);
		}else{
			echo 'Error Uploading Cover !';
		}

	}				
	else {
			echo"Book Cover Photo not Selected !";
	}	
}
//addbook finished
	
	if(isset($_POST["btn_EditBook"]))
	{
		include 'includes/editbook_form.php';
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
		
		if (!empty($_FILES["uploadedimage"]["name"])) 
	{	 

	    $file_name=$_FILES["uploadedimage"]["name"];
	    $temp_name=$_FILES["uploadedimage"]["tmp_name"];
	    $imgtype=$_FILES["uploadedimage"]["type"];
	    $ext= GetImageExtension($imgtype);
	    $imagename= $an."_".$callno."_".date("d-m-Y")."_".time().$ext;
	    $target_path = "source/images/books/".$imagename;

		if(move_uploaded_file($temp_name, $target_path)) 
		{	 
		   editbook($an,$callno,$authors,$title,$p,$pd,$pp,$edition,$price,$page,$volume,$source,$billno,$sub,$category,$type,$remark,$imagename);
		}else
		{
			echo "Error in Upload: Try Later";
		}
	}
	else 
	{
		echo"Cover Photo not Selected !";
	}
		
		
	}
	if(isset($_POST['searchbooks']))
	{
		$real_an = parseNum(trim(mysql_real_escape_string($_POST["txtan"])));		
		searchedbook_form($real_an);
		
	}	
	if(isset($_POST['btn_DeleteBook']))
	{
		include 'includes/deletebook_form.php';
	} 			
	if(isset($_POST['deletebook']))
	{				 
		$an = parseNum(trim(mysql_real_escape_string($_POST["txtan"])));
		deletebook($an);
	}
	if(isset($_POST["btn_AddMember"]))
	{			
		include 'includes/addmember_form.php';				
	}	
	if(isset($_POST["addmem"]))
	{		
		$fname = mysql_real_escape_string($_POST['txtfname']);
		$lname = mysql_real_escape_string($_POST['txtlname']);
		$libid = mysql_real_escape_string($_POST['txtlibid']); 				
		$mobile = mysql_real_escape_string($_POST['txtmobile']);
		$email = mysql_real_escape_string($_POST['txtemail']);
		$password = $fname;
		$add1 = mysql_real_escape_string($_POST['txtadd1']);
		$add2 = mysql_real_escape_string($_POST['txtadd2']);
		$father = mysql_real_escape_string($_POST['txtfather']);
		$batch = mysql_real_escape_string($_POST['txtbatch']);
		$cat = mysql_real_escape_string($_POST['category']);
		$department = mysql_real_escape_string($_POST['txtdepartment']);
		
	if (!empty($_FILES["uploadedimage"]["name"])) 
	{	 
	    $file_name=$_FILES["uploadedimage"]["name"];
	    $temp_name=$_FILES["uploadedimage"]["tmp_name"];
	    $imgtype=$_FILES["uploadedimage"]["type"];
	    $ext= GetImageExtension($imgtype);
	    $imagename=$fname."_".$lname."_".$libid."_".date("d-m-Y")."_".time().$ext;
	    $target_path = "source/images/members/".$imagename;
	 
		if(move_uploaded_file($temp_name, $target_path)) 
		{
	 
		   addmember($fname,$lname,$libid,$mobile,$email,$password,$add1,$add2,$father,$batch,$cat,$department,$imagename);	     
		}	 
	}				
	else {echo"Member Photo not Selected !";}
}		
	if(isset($_POST["btn_EditMember"]))
	{		

		include 'includes/editmember_form.php';			
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
		$department = mysql_real_escape_string($_POST['txtdepartment']);
		

	if (!empty($_FILES["uploadedimage"]["name"])) 
	{	 

	    $file_name=$_FILES["uploadedimage"]["name"];
	    $temp_name=$_FILES["uploadedimage"]["tmp_name"];
	    $imgtype=$_FILES["uploadedimage"]["type"];
	    $ext= GetImageExtension($imgtype);

	    $imagename=$fname."_".$lname."_".$libid."_".date("d-m-Y")."_".time().$ext;
	    $target_path = "source/images/members/".$imagename;

		if(move_uploaded_file($temp_name, $target_path)) 
		{
			 
		   editmember($fname,$lname,$libid,$mobile,$email,$password,$add1,$add2,$father,$batch,$cat,$department,$imagename);
		}else
		{
			echo "Error in Upload: Try Later";
		}
	}
	else {echo"Member Photo not Selected !";}
}
	if(isset($_POST['searchmember']))
	{		
		$txtlibid = parseNum(trim(mysql_real_escape_string($_POST['txtlibid'])));
		$txtlibid = trim($txtlibid);		
		searchedmember_form($txtlibid);		
	} 	
	if(isset($_POST['btn_DeleteMember']))
	{
		include 'includes/deletemember_form.php';
	}
	if(isset($_POST['deletemember']))
	{
		$libid = parseNum(trim(mysql_real_escape_string($_POST["txtlibid"])));				
        deletemember($libid);
	}	
?>
  </div> <!-- end of Main div -->
  <div class="clear"></div>
	</body> 
 </html>
  