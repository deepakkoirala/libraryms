<?php
	require 'includes/login-check.php';
	$query = mysql_query("SELECT * from issued where status not in ('lost')");	

	if(mysql_num_rows($query)>0)
	{
?>
    <div class="viewAllIssues"><center><h3 class="alert alert-info">Current Issues </h3></center>
    <table align="center" border="1px"><tr><th>SN</th><th>Title</th><th>Accession Number</th><th>Call Number</th><th>Issued To</th><th>Issued Date</th><th>Due Date</th><th>Issuing Staff</th></tr>
   <?php
		$sn = 1;
		while($issues = mysql_fetch_array($query))
		{
	?>
    	<tr>
        	<td>
				<?php echo $sn;?>
            </td>
            <td>
            <?php
				$data = mysql_fetch_array(mysql_query("SELECT cover from books_info where accession_no = '".$issues['accession_no']."'"));
			?>
            <a class="fancybox" href="source/images/books/<?php echo $data['cover'];?>">
            	<img width="60" height="80" src="source/images/books/<?php echo $data['cover'];?>" />
            </a>
            <br />
				<a title="Click to View all <?php echo $issues['title'];?> Books" id="link" href="index.php?action=bookstatus&an=<?php echo $issues['accession_no'];?>"><?php echo $issues['title'];?></a>
            </td>
            <td>
				<?php echo $issues['accession_no'];?>
            </td>
            <td>
				<?php echo $issues['call_no'];?>
            </td>
            <td>
			
				<?php
				$libid = $issues['lib_id'];
				$query1 = mysql_query("Select * from members_info where lib_id = '$libid'");
				$user = mysql_fetch_array($query1);
				?>
                <a class="fancybox" href="source/images/members/<?php echo $user['member_image']; ?>">
				<img id="member_image" width="60" height="80" src="source/images/members/<?php echo $user['member_image']; ?>"/>
                </a>				
                <br />
				<a id="link" title="Click to View all Issues of  Member" href="index.php?action=memberstatus&libid=<?php echo $issues['lib_id'];?>">
				<?php echo $user['fname']." ".$user['lname']." (".$issues['lib_id'].")";?>
                 </a>
            </td>
             <td>
				<?php echo $issues['issued_date'];?>
            </td>
            <td>
				<?php echo $issues['due_date'];?>
            </td>
            <td>
				<?php echo $issues['issued_by'];?>
            </td>
        </tr>        
    <?php
	$sn++;			
		}		
	}else
	{
	?>
    	<center><h3 class="alert alert-info">No Books Issued Yet !</h3></center></table>
    <?php
	}
?>
</div>
