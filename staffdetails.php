<?php
	if(checkAdmin()){
	$email = $_REQUEST['email'];
	}else
	{
		$email = $_SESSION['email'];
	}
	$sql = mysql_query("SELECT * from staffs_info where email = '$email';");	
	$member = mysql_fetch_array($sql);
	$mem = "Librarian : ".$member['fname']." ".$member['lname']."";			
	?>	
    
<?php
	 echo "<center><font color=\"blue\">".$_SESSION['msgUpload']."</font></center>";		
	 unset($_SESSION['msgUpload']);	 
?>

<div class="memberstatus">
	<?php
		if(checkAdmin()){
		echo "<a  href=\"index.php?action=edit&user=".$email."\"title =\"Click to Edit Info\">";
		}
		echo"<h2 class=\"alert alert-info\" align=\"center\">$mem</h2></a>";			
		echo'<table border="1px" align="center">';
			$i = 1;
		if(checkAdmin()){
			echo'
				<tr>
					<th>
						Modify
					</th>';
		}
			echo'	<th>
						Full Name
					</th>
					<th>
						Email Address
					</th>
					<th>
						Phone
					</th>
					<th>
						Sex
					</th>
					<th>
						Temporary Address
					</th>
					<th>
						Permanent Address
					</th>
					<th>
						Postiton
					</th>
					<th>
						Date Joined
					</th>
				</tr>';
			
			$info = mysql_query("SELECT * from staffs_info where email = '$email';");	
			while($data = mysql_fetch_array($info))			
			{
				if(checkAdmin()){
				echo 
					'<tr>
						<td>
							<a id="edit" href="index.php?action=edit&user='.$email.'" title ="Click to Edit Info">
								<span class="glyphicon glyphicon-edit"></span>
							</a>							
						</td>';
				}
						echo'
						<td>
							'.$data['fname'].' '.$data['lname'].'
						</td>
						<td>
							<a href="mailto:'.$data['email'].'?Subject=Message from Library">'.$data['email'].'</a>
						</td>
						<td>
							'.$data['phone'].'
						</td>
						<td>
							'.$data['sex'].'
						</td>
						<td>
							'.$data['temporary_address'].'
						</td>
						<td>
							'.$data['permanent_address'].'
						</td>
						<td>
							'.$data['position'].'
						</td>
						<td>
							'.$data['date_joined'].'
						</td></tr>';
			}
				
?>
</div>
<div class="memberPhoto">
    
	<?php if(($member['staff_image']!="") and file_exists("source/images/staffs/".$member['staff_image'])){?>
    <a class="fancybox"  target="_self" href="source/images/staffs/<?php echo $member['staff_image'];?>">
    
	<img id="member_image" alt="Photo of <?php echo $member['fname']." ".$member['lname'];?>" title="Click to Enlarge #Photo of :  <?php echo $member['fname']." ".$member['lname'] ?>" src="source/images/staffs/<?php echo $member['staff_image']; ?>"  width="250" height="250" />
        </a>    
	<?php }else{?>   					
    
    <img id="member_image" alt="Staff Photo not Uploaded Yet for <?php echo $member['fname']." ".$member['lname'];?>" title="Staff Photo yet not Uploaded  for :
    
    <?php echo $member['fname']." ".$member['lname'] ?>" src="source/images/staffs/default.jpg"  width="250" height="250" />	    
	<?php }?>

    <br/>Upload Photo <br />
		<form name="uploadedimage" method="post" enctype="multipart/form-data" action="">
          <a class="btn btn-primary" >
 	         <input type="file" name="uploadedimage" />
          </a>
          <br />
          <a title="Click to Upload new Photo" class="btn btn-primary">
          <input class="btn btn-default" type="submit" name="uploadimage"  value="Click to Upload"/>
          </a>
       </form>
</div>  
<?php 
if(isset($_POST['uploadimage'])) 
{		
	if (!empty($_FILES["uploadedimage"]["name"])) 
	{	 
	    $file_name=$_FILES["uploadedimage"]["name"];
	    $temp_name=$_FILES["uploadedimage"]["tmp_name"];
	    $imgtype=$_FILES["uploadedimage"]["type"];
	    $ext= GetImageExtension($imgtype);
	    $imagename=$member['fname']."_".$member['lname']."_".$member['email']."_".date("d-m-Y")."_".time().$ext;
	    $target_path = "source/images/staffs/".$imagename;	

		if(move_uploaded_file($temp_name, $target_path)) 
		{	 
			$oldimage = $member['staff_image'];
			copy("source/images/staffs/".$oldimage,"source/images/staffs/garbage/".$oldimage);
		  if(updateStaffPhoto($email,$imagename));		  
		   {
			    unlink("source/images/staffs/".$oldimage);			  		   		
				echo "
				<script>
					 window.location =\"index.php?action=staffdetails&email=$email\";
				 </script>
				 ";
		   }
		}else
		{
			echo "<font color=\"red\">Error: File Size Exceeded ! Try with Smaller File Size</font>";
		}
	}
	else
	 {
		 echo"<font color=\"red\">Error: Photo not Selected !</font>";
	 }
}
?>