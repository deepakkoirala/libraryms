<?php		
	$an = mysql_real_escape_string($_REQUEST['an']);	
	$sql = mysql_query("SELECT * from books_info where accession_no = '$an';");		
	$book = mysql_fetch_array($sql);	
	$callno = $book['call_no'];
	$cbook  = "All Books::<font color=\"purple\"> ".$book['title']."</font> - Author::<font color=\"purple\"> ".$book['authors']."</font><br>Call Number - <font color=\"purple\">".$book['call_no']."</font>";
?>
<?php
	 echo "<center><font color=\"blue\">".$_SESSION['msgUpload']."</font></center>";		
	 unset($_SESSION['msgUpload']);	 
	 
?>
<div class="bookstatus">

	<?php	
	echo"<h3  align=\"center\">$cbook</h3>";			
	$check =mysql_query("SELECT * from books_info where call_no = '$callno'");	
	if($check)			
	{
		$totalBooks = mysql_num_rows($check);
		
		if($totalBooks > 1)
		{
			$moreBooks = true;
		}		
	}
	$i = 1;	
		
		echo'<table border="1px" align="center">';
			$i = 1;
			echo'
				<tr>
					<th>
						Count
					</th>	
					<th>';
						if($moreBooks)
					{
						echo '<a class = "btn btn-warning" onclick ="return javascript: alert("Delete All Books?")" title = "Click to Delete all the Availabile Books" href = "index.php?action=DeleteBooks&callno='.$callno.'"><font color="white">Delete all Availables</font></a>';
					}
					else
					{
						echo 'Action';
					}
					echo'
					</th>
					<th>
						Accession-Number
					</th>
											
					<th>
						Availability
					</th>
					<th>
						 Issued-To
					</th>
					
					<th>
						Due-Date
					</th>
					<th>
						Issuing-Staff
					</th>
					<th>
						Date-Added
					</th>						
				</tr>';

			$allbooks = mysql_query("SELECT * from books_info where call_no = '$callno' and flag = 1 order by date_added");					
			while($rows=mysql_fetch_array($allbooks))
			{
				if($rows['flag'] == 0)
				{
				
					$flag = 'Issued';
				}
				else
					$flag = 'Available';
			echo '
				<tr>					
					<td>
						'.$i.'
					</td>';
				if($flag == 'Available')
				{
				echo'
					<td>

						<a class = "btn btn-primary" onclick="return edit_book()" href="index.php?an='.$rows['accession_no'].'&action=edit"><font color ="white">Edit</font></a>
						<a class = "btn btn-primary" onclick="return del_book()" href="index.php?an='.$rows['accession_no'].'&action=del"><font color ="white">Delete</font></a>
					</td>';
				}
				else
				{
				echo'
					<td>

						<a  class = "btn btn-primary" title ="Click to Edit Book Information" onclick="return edit_book()" href="index.php?an='.$rows['accession_no'].'&action=edit">
			<font color = "white">Edit</font></a>
						
					</td>';
				}
				if($flag == 'Available' )
				{
				echo'
					<td>
						'.$rows['accession_no'].'
					</td>';
				}
				else
				{
				echo'
					<td>
						'.$rows['accession_no'].'
					</td>';
				}
				echo'
				
					<td>
					<a class = "btn btn-primary" title = "Click to Issue" href = "index.php?action=issue&AccessionNumber='.$rows['accession_no'].
					'">
						<font color="white">'.$flag.'</font></a>
					</td>
					<td>
						-
					</td>
					<td>
						-
					</td>
					<td>
						-
					</td>					
					<td>
						'.$rows['date_added'].'
					</td>
				</tr>';
			$i++;
		}
$allIssued = mysql_query("select books_info.accession_no,books_info.date_added,issued.lib_id,issued.due_date,issued.issued_date,issued.issued_by,issued.status from books_info,issued where books_info.accession_no = issued.accession_no and issued.call_no = '$callno' order by date_added");
while($rows = mysql_fetch_array($allIssued))
{
	$flag = 'Issued';
	echo'<tr>
		<td>
			'.$i.'
		</td>';
	echo '<td>';
	if($rows['status'] == 'lost'){
		echo '<font color="red">Book is Reported Lost</font>';
	}else{

	echo '<a  class = "btn btn-primary" title ="Click to Edit Book Information" onclick="return edit_book()" href="index.php?an='.$rows['accession_no'].'&action=edit">
			<font color = "white">Edit</font></a>			
		</td>';
			
	}	
		echo '
		<td>
			'.$rows['accession_no'].'
		</td>
		<td>
			'.$flag.'						
		</td>
		<td>';
			$libid = $rows['lib_id'];
			$query1 = mysql_query("Select * from members_info where lib_id = '$libid'");
			$user = mysql_fetch_array($query1);
			echo'</a>
			<a class="fancybox" title = "Click to View Details" href = "source/images/members/'.$user['member_image'].'"">
				<img id="member_image" width="60" height="70" src="source/images/members/'.$user['member_image'].'"/>
			</a><br>';
			echo '<a id="link" title = "Click to View Details" href = "index.php?action=memberstatus&libid='.$rows['lib_id'].'">';
			echo $user['fname'].' '.$user['lname'];
		echo'
		</td>	
		<td>
			'.$rows['due_date'].'
		</td>
		<td>
			'.$rows['issued_by'].'
		</td>
		<td>
			'.$rows['date_added'].'
		</td>';
	$i++;
}
?>			
</div>
<div class="cover">
    
	<?php if(($book['cover']!="") and file_exists("source/images/books/".$book['cover'])){?>
    <a class="fancybox"  target="_self" href="source/images/books/<?php echo $book['cover'];?>">
    
	<img id="member_image" alt="Cover of <?php echo $book['title']." by ".$book['authors'];?>" title="<?php echo $book['title']." by ".$book['authors'] ?>" src="source/images/books/<?php echo $book['cover']; ?>"  width="250" height="250" />
        </a>    
	<?php }else{?>   					
    
    <img id="member_image" alt="Photo not yet  Uploaded  for <?php echo $book['title']." by ".$book['authors'];?>" title="Cover Photo not yet Uploaded  for :
    
    <?php echo $book['title']." by ".$book['authors'] ?>" src="source/images/books/default.jpg"  width="250" height="250" />	    
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
	    $imagename=$book['title']."_".$book['authors']."_".$book['accession_no']."_".date("d-m-Y")."_".time().$ext;
	    $target_path = "source/images/books/".$imagename;

		if(move_uploaded_file($temp_name, $target_path)) 
		{	 
		  if(updateCover($an,$imagename));
		   {			  
				echo "
				<script>
					 window.location =\"index.php?action=bookstatus&an=$an\";
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
