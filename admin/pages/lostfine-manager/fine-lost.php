<?php
        $id = mysql_real_escape_string($_GET['id']);
        $query = "select * from lostbooks where id = '$id' ";		
        $result = mysql_query($query) or die(mysql_error());
        $row = mysql_fetch_assoc($result);
		$book = mysql_fetch_array(mysql_query("SELECT accession_no,title from books_info where accession_no = '".$row['book']."'"));
		$member = mysql_fetch_array(mysql_query("SELECT fname,lname,member_image,lib_id from members_info where lib_id = '".$row['member']."' "));
        ?>

<div >
  <h3 class="manager_sub_title">
    Fine Charing for Lost Book:
    <font color="green">
    	<a href="<?php echo site_url;?>/index.php?action=bookstatus&an=<?php echo $book['accession_no'];?>">
	    	<?php echo $book['title'].'('.$row[book].')';?>
        </a>
    </font>
	  	by
    <font color="green">
	<a href="<?php echo site_url;?>/index.php?action=memberstatus&libid=<?php echo $member['lib_id'];?>">
		<?php echo $member['fname'].' '.$member['lname'].'('.$member['lib_id'].')';?></font>
    </a>
	<a class="fancybox" title="View" href="<?php echo site_url;?>/source/images/members/<?php echo $member['member_image'];?>">
	    <img id="member_image" src="<?php echo site_url;?>/source/images/members/<?php echo $member['member_image'];?>" width="60" height="80" />
    </a>
  </h3>
<?php
echo'<div class="fineForm">';
			echo"<form  role = \"form\" name=\"signup\" method=\"POST\" action=".site_url."/admin/actions.php?id=".$id.">";
					echo "<table  align=\"center\" border=\"2px\" bgcolor=\"white\">						
						<tr>
							<th>
								Amount
							</th>
							<td>
								<input  type=\"number\" name=\"fine\"  class=\"form-control\" required autofocus placeholder=\"Fine Amount (Rs.)\"> </td>
						</tr>
						<tr>						
							<td colspan=\"2\">
								<input class=\"btn btn-primary\" type=\"submit\" name=\"finelost\" value=\"Charge\">
							</td>
						</tr>";			
						
		echo '</div>';
?>
</div>