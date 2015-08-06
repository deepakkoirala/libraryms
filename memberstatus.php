<?php 	
	require 'includes/login-check.php';
	$lib_id = $_REQUEST['libid'];
	$sql = mysql_query("SELECT * from members_info where lib_id = '$lib_id';");	
	$member = mysql_fetch_array($sql);
	$mem = "Member : <a  href=\"index.php?lib_id=$lib_id&action=edit\"title =\"Click to Edit Info\"><font color=\"purple\">".$member['fname']." ".$member['lname']. " 
	</a>
	</font>
	 Library ID :
	 <a  href=\"index.php?lib_id=$lib_id&action=edit\"title =\"Click to Edit Info\"><font color=\"purple\">".$lib_id."</a>";			
?>
<?php
	 echo "<center><font color=\"blue\">".$_SESSION['msgUpload']."</font></center>";		
	 unset($_SESSION['msgUpload']);	 
?>
<div class="memberstatus">
	<?php	
	if($lib_id==""){echo '<script>window.location = "index.php"; </script>';}
	$check =mysql_query("SELECT * from issued where lib_id = '$lib_id'");	
	if($check)			
	{
		$totalIssues = mysql_num_rows($check);
		
		if($totalIssues > 1)
		{
			$moreBooks = true;
		}		
	}
	$i = 1;	
		echo"";	
		echo'<table border="1px" align="center">';
			
			echo'
				<tr>
					<td colspan="7">
						<h2 class=\"alert alert-info\" align=\"center\">'.$mem.'</h2>
					</td>
				</tr>
				<tr>
					<th>
						Count
					</th>									
					<th>';
					if($moreBooks)
					{
						echo '<a class = "btn btn-primary" onclick ="return returnAllBook()" title = "Click to Return all the  Books" href = "index.php?action=ReturnAll&libid='.$lib_id.'"><font color="white">Return All</font></a>';
					}
					else
					{
						echo 'Action';
					}
					echo'
					</th>
					<th>
						Book Title
					</th>
					<th>
						Book Number
					</th>
					<th>
						Due Date
					</th>
					<th>
						Issued Date
					</th>					
					<th>
						Issuing Staff
					</th>
				</tr>';
				$issues = mysql_query("SELECT * from issued where lib_id = '$lib_id'");
				while($data =mysql_fetch_array($issues))
				{
					$flag = true;
								
				echo 
					'<tr>
						<td>
							'.$i.'
						</td>
						<td>';
						
				
	if(!($data['status']=='lost')){		
				echo'<div class="dropdown">
  <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
    Action
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">

    <li role="presentation"><b>Action</b></li>
    <li role="presentation" class="divider"></li>	
    <li style="float:left;" role="presentation">		
	<a title = "Click to Return Book" id="edit" onclick="return del_mem()"  href = "index.php?action=return&libid='.$lib_id.'&an='.$data['accession_no'].'">
	
	<span>Return Book
	</a>
	</li>

    <li style="float:left;" role="presentation">	  
	<a title = "Click if the Book is Lost or Something !" id="edit"  href = "index.php?action=lost&libid='.$lib_id.'&an='.$data['accession_no'].'">
		Mark Lost
	</a>
	</li>
	</ul>
	</div>';
	}else{
		echo '<font color="red">Book is reported Lost</font>';
		}
						echo '</td>
						<td>
							'.$data['title'].'
						</td>
						<td>
							'.$data['accession_no'].'
						</td>						
						<td>
							'.$data['due_date'].'
						</td>
						<td>
							'.$data['issued_date'].'
						</td>
						<td>
							'.$data['issued_by'].'
						</td>';
						$i++;			
				}
			if($flag!=true)
				
			{
				echo "<tr><td colspan=7><span style=\"color:green\">No Books Issued! </span></td></tr>";
				echo "</table>";			
			}				
?>
</div>
<div class="memberPhoto">
    
	<?php if(($member['member_image']!="") and file_exists("source/images/members/".$member['member_image'])){?>
    <a class="fancybox"  target="_self" href="source/images/members/<?php echo $member['member_image'];?>">
    
	<img id="member_image" alt="Photo of <?php echo $member['fname']." ".$member['lname'];?>" title="Click to Enlarge #Photo of :  <?php echo $member['fname']." ".$member['lname'] ?>" src="source/images/members/<?php echo $member['member_image']; ?>"  width="250" height="250" />
        </a>    
	<?php }else{?>   					
    
    <img id="member_image" alt="Photo not Uploaded Yet for <?php echo $member['fname']." ".$member['lname'];?>" title="Member Photo yet not Uploaded  for :
    
    <?php echo $member['fname']." ".$member['lname'] ?>" src="source/images/members/default.jpg"  width="250" height="250" />	    
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
	    $imagename=$member['fname']."_".$member['lname']."_".$member['libid']."_".date("d-m-Y")."_".time().$ext;
	    $target_path = "source/images/members/".$imagename;

		if(move_uploaded_file($temp_name, $target_path)) 
		{	 
		  if(updatePhoto($lib_id,$imagename));
		   {			  
				echo "
				<script>
					 window.location =\"index.php?action=memberstatus&libid=$lib_id\";
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
